<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('companies', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('industry');
            $table->string('city');
            $table->bigInteger('zip');
            $table->string('country');
            $table->string('website');
            $table->string('phone');
            $table->integer('number_employees');
            $table->bigInteger('annual_revenue');
            $table->text('description');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('companies');
    }
};
