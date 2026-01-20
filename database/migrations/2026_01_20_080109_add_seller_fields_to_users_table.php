<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('phone')->nullable()->after('email');
            $table->boolean('is_seller')->default(false)->after('password');
            $table->boolean('is_verified')->default(false);
            $table->timestamp('phone_verified_at')->nullable();
            $table->string('verification_code')->nullable();
            $table->boolean('is_blocked')->default(false);
            $table->text('blocked_reason')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'phone',
                'is_seller',
                'is_verified',
                'phone_verified_at',
                'verification_code',
                'is_blocked',
                'blocked_reason'
            ]);
        });
    }
};