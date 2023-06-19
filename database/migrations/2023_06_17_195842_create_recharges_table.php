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
        Schema::create('recharges', function (Blueprint $table) {
            $table->id();
            $table->integer("user_id");
            $table->string('name')->nullable(); // nom de l'utilisateur
            $table->float("amount")->default(0);
            $table->string("state")->default("en cours"); // en cours, echoué, validé
            $table->text('comment')->nullable();
            $table->enum('paiement', ['pm','local-pay'])->default('local-pay');
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
        Schema::dropIfExists('recharges');
    }
};
