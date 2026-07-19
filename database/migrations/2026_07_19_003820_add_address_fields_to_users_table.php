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
        Schema::table('users', function (Blueprint $table) {
            $table->foreignId('country_id')->nullable()->after('password')->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('state_id')->nullable()->after('country_id')->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('city_id')->nullable()->after('state_id')->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->string('address')->nullable()->after('city_id');
            $table->string('postal_code')->nullable()->after('address');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropConstrainedForeignId('country_id');
            $table->dropConstrainedForeignId('state_id');
            $table->dropConstrainedForeignId('city_id');
            $table->dropColumn(['address', 'postal_code']);
        });
    }
};
