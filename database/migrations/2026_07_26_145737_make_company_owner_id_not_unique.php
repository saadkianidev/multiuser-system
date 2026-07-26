<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('companies', function (Blueprint $table) {
            $table->dropForeign('companies_owner_id_foreign');
        });

        Schema::table('companies', function (Blueprint $table) {
            $table->dropUnique('companies_owner_id_unique');
            $table->index('owner_id', 'companies_owner_id_index');
        });

        Schema::table('companies', function (Blueprint $table) {
            $table->foreign('owner_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::table('companies', function (Blueprint $table) {
            $table->dropForeign('companies_owner_id_foreign');
        });

        Schema::table('companies', function (Blueprint $table) {
            $table->dropIndex('companies_owner_id_index');
            $table->unique('owner_id');
        });

        Schema::table('companies', function (Blueprint $table) {
            $table->foreign('owner_id')->references('id')->on('users')->onDelete('cascade');
        });
    }
};