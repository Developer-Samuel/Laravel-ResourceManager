<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ResourceType extends Model
{
    public function fields(): HasMany
    {
        return $this->hasMany(Field::class, 'resource_type_id');
    }
}