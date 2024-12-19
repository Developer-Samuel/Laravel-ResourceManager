<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('fields', static function (Blueprint $table) {
            $table->id();
            $table->foreignId('resource_type_id')->constrained()->cascadeOnDelete();
            $table->string('name');
            $table->string('type');
            $table->jsonb('options');
            $table->jsonb('validations');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('fields');
    }
};
