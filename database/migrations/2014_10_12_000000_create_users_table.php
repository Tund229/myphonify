<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('identifiant')->unique();
            $table->string('password');
            $table->boolean('status')->default(0);
            $table->boolean('is_admin')->default(0);
            $table->enum('role', ['user', 'super-admin','admin'])->default('user');
            $table->integer('parent_id')->nullable();
            $table->integer('account_balance')->default(0);
            $table->integer('affiliate_exarnings')->default(0);
            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
};
