<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;

class User extends ResourceModel implements AuthorizableContract, AuthenticatableContract
{
    use Authenticatable;
    use Authorizable;
    use HasFactory;
    use Notifiable;

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function getSingular(): string
    {
        return 'user';
    }

    public function getResourceType(): ResourceType
    {
        return ResourceType::query()
            ->firstWhere('singular_name', $this->getSingular());
    }

    protected function casts(): array
    {
        return [
            'password' => 'hashed',
        ];
    }
}
