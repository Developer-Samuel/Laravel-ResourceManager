<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Field extends Model
{
    protected function casts(): array
    {
        return [
            'options' => 'array',
            'validations' => 'array',
        ];
    }
}