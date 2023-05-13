<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('companies', static function (Blueprint $table) {
            $table->string('industry')->nullable()->change();
            $table->string('city')->nullable()->change();
            $table->bigInteger('zip')->nullable()->change();
            $table->string('country')->nullable()->change();
            $table->string('website')->nullable()->change();
            $table->string('phone')->nullable()->change();
            $table->integer('number_employees')->nullable()->change();
            $table->bigInteger('annual_revenue')->nullable()->change();
            $table->text('description')->nullable()->change();
        });
    }

    public function down(): void
    {
        Schema::table('companies', static function (Blueprint $table) {
            $table->string('industry')->change();
            $table->string('city')->change();
            $table->bigInteger('zip')->change();
            $table->string('country')->change();
            $table->string('website')->change();
            $table->string('phone')->change();
            $table->integer('number_employees')->change();
            $table->bigInteger('annual_revenue')->change();
            $table->text('description')->change();
        });
    }
};
