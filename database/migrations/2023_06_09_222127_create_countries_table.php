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
        Schema::create('countries', function (Blueprint $table) {
            $table->id();
            $table->string('name', 80);
            $table->string('en_name', 90)->nullable();
            $table->integer('phonecode');
            $table->char('country_iso', 3);
            $table->integer("id_whatsapp")->nullable();
            $table->integer("id_telegram")->nullable();
            $table->integer("id_facebook")->nullable();
            $table->integer("id_gmail")->nullable();
            $table->integer("price_whatsapp");
            $table->integer("price_telegram");
            $table->integer("price_facebook");
            $table->integer("price_gmail");
            $table->integer("price_TikTok");
            $table->integer("price_Viber");
            $table->integer("price_Signal");
            $table->text("comment")->nullable();
            $table->boolean("state")->default(true);
            $table->boolean("Mta")->default(true);  //move  to another => Mta
            $table->unsignedBigInteger('api_id');
            $table->foreign('api_id')->references('id')->on('apis');
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
        Schema::dropIfExists('countries');
    }
};
