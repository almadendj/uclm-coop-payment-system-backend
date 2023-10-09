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
            $table->addColumn('string', 'username', ['length' => 255]);
            $table->addColumn('string', 'first_name', ['length' => 255])->nullable();
            $table->addColumn('string', 'last_name', ['length' => 255])->nullable();
            $table->addColumn('string', 'usergroup', ['length' => 255])->nullable();
            $table->addColumn('string', 'profile_pic_src', ['length' => 255])->nullable();
            $table->addColumn('string', 'status', ['length' => 255]); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->removeColumn('name');
        });
    }
};
