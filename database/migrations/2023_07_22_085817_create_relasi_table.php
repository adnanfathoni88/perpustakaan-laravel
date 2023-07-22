<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasColumn('buku', 'kategori_id')) {
            Schema::table('buku', function (Blueprint $table) {
                $table->unsignedBigInteger('kategori_id');
                $table->foreign('kategori_id')->references('id')->on('kategori')->onDelete('restrict')->onUpdate('cascade');
            });
        }
        if (!Schema::hasColumn('users', 'role_id')) {
            Schema::table('users', function (Blueprint $table) {
                $table->unsignedBigInteger('role_id');
                $table->foreign('role_id')->references('id')->on('role')->onDelete('restrict')->onUpdate('cascade');
            });
        }
        if (!Schema::hasColumn('buku', 'user_id')) {
            Schema::table('buku', function (Blueprint $table) {
                $table->unsignedBigInteger('user_id');
                $table->foreign('user_id')->references('id')->on('users')->onDelete('restrict')->onUpdate('cascade');
            });
        }
    }

    public function down(): void
    {
        Schema::table('buku', function (Blueprint $table) {
            $table->dropForeign(['kategori_id']);
            $table->dropColumn(['kategori_id']);
        });

        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['role_id']);
            $table->dropColumn(['role_id']);
        });

        Schema::table('buku', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropColumn(['user_id']);
        });
    }
};
