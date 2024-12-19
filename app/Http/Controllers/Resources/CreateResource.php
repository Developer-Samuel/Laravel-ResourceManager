<?php

declare(strict_types=1);

namespace App\Http\Controllers\Resources;

use App\Http\Controllers\Controller;
use Inertia\Inertia;

use App\Enums\Status;

class CreateResource extends Controller
{
    public function __invoke(string $collectionName)
    {
        if ($collectionName === 'users') {
            return Inertia::render('Profile/Create');
        }

        if ($collectionName === 'projects') {
            $statuses = Status::getStatusOptions();

            return Inertia::render('Projects/Create', [
                'statuses' => $statuses,
            ]);
        }
    }
}
