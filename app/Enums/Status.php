<?php

namespace App\Enums;

use Illuminate\Support\Facades\DB;

enum Status: string
{
    public static function getStatuses(): array
{
    $statuses = DB::table('enums')->select('name')->get()->toArray();

    return array_map(function ($status) {
        return [
            'value' => $status->name,
            'label' => ucfirst($status->name),
        ];
    }, $statuses);
}

    public static function toLabel(string $status): string
    {
        return ucfirst($status);
    }

    public static function toValue(string $status): string
    {
        return $status;
    }

    public static function getStatusOptions(): array
    {
        $statuses = self::getStatuses();

        return $statuses;
    }
}
