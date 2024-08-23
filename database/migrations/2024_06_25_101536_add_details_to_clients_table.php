<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('clients', function (Blueprint $table) {
            $table->string('role')->nullable();
        $table->string('mobile')->nullable();
        $table->string('etat')->nullable();
        $table->string('photo_profil')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('clients', function (Blueprint $table) {
            $table->dropColumn('role');
        $table->dropColumn('mobile');
        $table->dropColumn('etat');
        $table->dropColumn('photo_profil');
        });
    }
};
