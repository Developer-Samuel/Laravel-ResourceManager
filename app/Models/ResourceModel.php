<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

abstract class ResourceModel extends Model
{
    protected string $singular;

    protected ResourceType $resourceType;

    public function getSingular(): string
    {
        return $this->singular;
    }

    public function getResourceType(): ResourceType
    {
        return $this->resourceType;
    }

    public function setSingular(string $singular): static
    {
        $this->singular = $singular;

        return $this;
    }

    public function setResourceType(ResourceType $resourceType): static
    {
        $this->resourceType = $resourceType;

        return $this;
    }
}