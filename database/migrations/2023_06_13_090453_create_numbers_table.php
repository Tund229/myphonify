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
        Schema::create('numbers', function (Blueprint $table) {
            $table->id();
            $table->string("service");
            $table->string("amount");
            $table->string("country");
            $table->string("phone")->nullable();
            $table->string("country_name");
            $table->string("state")->default("en cours"); //en cours, echoué, validé
            $table->string("tzip")->nullable();
            $table->text("message")->nullable();
            $table->text("comment")->nullable();
            $table->integer("user_id");
            $table->string("api_name")->nullable();
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
        Schema::dropIfExists('numbers');
    }
};
