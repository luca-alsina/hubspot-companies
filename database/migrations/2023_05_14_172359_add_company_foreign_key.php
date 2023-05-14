<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('contacts', static function (Blueprint $table) {
//            $table->dropColumn('company_id');
            $table->foreignId('company_id')->change()->constrained('companies');
        });
    }

    public function down(): void
    {
        Schema::table('contacts', static function (Blueprint $table) {
            $table->dropForeign(['company_id']);
            $table->integer('company_id')->change();
        });
    }
};
