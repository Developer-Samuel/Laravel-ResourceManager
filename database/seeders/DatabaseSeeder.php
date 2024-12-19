<?php

declare(strict_types=1);

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

use App\Models\Enum;
use App\Models\ResourceType;
use App\Models\User;
use App\Models\Project;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $user = ResourceType::query()
            ->create([
                'collection_name' => 'users',
                'singular_name' => 'user',
            ]);

        $project = ResourceType::query()
            ->create([
                'collection_name' => 'projects',
                'singular_name' => 'project',
            ]);

        Enum::query()
            ->insert([
                [
                    'name' => 'active',
                ],
                [
                    'name' => 'inactive',
                ],
                [
                    'name' => 'completed',
                ],
            ]);

        $user->fields()
            ->createMany([
                [
                    'name' => 'name',
                    'type' => 'text',
                    'options' => [],
                    'validations' => ['required', 'string'],
                ],
                [
                    'name' => 'email',
                    'type' => 'text',
                    'options' => [],
                    'validations' => ['required', 'email'],
                ],
                [
                    'name' => 'password',
                    'type' => 'password',
                    'options' => [],
                    'validations' => ['required', 'string', 'confirmed'],
                ],
                [
                    'name' => 'is_active',
                    'type' => 'boolean',
                    'options' => [],
                    'validations' => ['required', 'boolean'],
                ],
            ]);

        $project->fields()
            ->createMany([
                [
                    'name' => 'name',
                    'type' => 'text',
                    'options' => [],
                    'validations' => ['required', 'string'],
                ],
                [
                    'name' => 'url',
                    'type' => 'url',
                    'options' => [],
                    'validations' => ['required', 'string'],
                ],
                [
                    'name' => 'status',
                    'type' => 'enum',
                    'options' => ['values' => [1, 2, 3]],
                    'validations' => ['required'],
                ],
            ]);

        User::factory()->count(10)->create();

        User::create([
            'name' => 'user',
            'email' => 'user@example.com',
            'password' => Hash::make('12345678'),
            'role' => 'user',
        ]);

        User::create([
            'name' => 'admin',
            'email' => 'admin@example.com',
            'password' => Hash::make('12345678'),
            'role' => 'admin',
        ]);

        $projects = [];
        for ($i = 1; $i <= 10; $i++) {
            $userId = rand(1, 11);
            $enum = Enum::inRandomOrder()->value('name');

            $projects[] = [
                'user_id' => $userId,
                'name' => fake()->sentence(3),
                'url' => Str::random(60),
                'status' => $enum,
                'created_at' => now(),
                'updated_at' => null,
            ];
        }

        DB::table('projects')->insert($projects);
    }
}
