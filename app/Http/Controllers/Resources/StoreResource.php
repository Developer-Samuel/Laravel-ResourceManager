<?php

declare(strict_types=1);

namespace App\Http\Controllers\Resources;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use App\Models\Field;

class StoreResource extends Controller
{
    public function __invoke(Request $request, string $collectionName, ?int $id = null)
    {
        $userId = Auth::id();
        $fields = Field::where('resource_type_id', $collectionName === 'users' ? 1 : 2)->get();
        $rules = $this->getValidationRules($fields, $userId);

        $validator = $request->validate($rules);

        if ($collectionName === 'users') {
            return $this->handleUser($validator, $userId);
        }

        if ($collectionName === 'projects') {
            return $this->handleProject($validator, $userId, $id);
        }

        return response()->json([
            'success' => false,
            'message' => 'Invalid collection name.',
        ], 400);
    }

    private function getValidationRules($fields, $userId)
    {
        return $fields->mapWithKeys(function ($field) use ($userId) {
            $validations = is_string($field->validations)
                ? json_decode($field->validations, true)
                : (is_array($field->validations) ? $field->validations : []);

            if ($userId) {
                if ($field->name === 'password') {
                    return [$field->name => 'nullable'];
                }
                if ($field->name === 'is_active') {
                    return [$field->name => 'nullable'];
                }
            }
            return [$field->name => implode('|', $validations)];
        })->toArray();
    }

    private function handleUser($validator, $userId)
    {
        $existingUser = DB::table('users')->where('id', $userId)->first();

        if ($existingUser) {
            $data = [
                'name' => $validator['name'],
                'email' => $validator['email'],
                'updated_at' => now(),
            ];

            DB::table('users')->where('id', $userId)->update($data);
            $message = 'Your profile updated successfully!';
        } else {
            $data = [
                'name' => $validator['name'],
                'email' => $validator['email'],
                'password' => Hash::make($validator['password']),
                'is_active' => $validator['is_active'],
                'created_at' => now(),
            ];

            DB::table('users')->insert($data);
            $message = 'Registration successful! You can Log in.';
        }

        return response()->json([
            'success' => true,
            'message' => $message,
        ], 200);
    }

    private function handleProject($validator, $userId, $id)
    {
        $existingProject = DB::table('projects')->where('id', $id)->first();

        if ($existingProject) {
            DB::table('projects')->where('id', $id)->update([
                'name' => $validator['name'],
                'status' => $validator['status'],
                'updated_at' => now(),
            ]);
            $message = 'Project updated successfully!';
        } else {
            DB::table('projects')->insert([
                'user_id' => $userId,
                'name' => $validator['name'],
                'url' => $validator['url'],
                'status' => $validator['status'],
                'created_at' => now(),
            ]);
            $message = 'Project created successfully!';
        }

        return response()->json([
            'success' => true,
            'message' => $message,
        ], 200);
    }
}
