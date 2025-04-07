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
            $table->string("surname")->nullable()->after("name");
            $table->string("phone")->unique()->after("email");
            $table->string("role")->default("user")->after("password");
            $table->softDeletes()->after("updated_at");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropColumns("users", ["surname", "phone", "role", "deleted_at"]);
    }
};
