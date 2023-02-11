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
        Schema::create('dispositions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('code')->nullable();
            $table->date('date')->nullable();
            $table->bigInteger('id_message');
            $table->string('id_instruction')->nullable();
            $table->integer('received')->nullable();
            $table->integer('from')->nullable();
            $table->text('other_instruction')->nullable();
            $table->enum('nature', ['penting', 'rahasia', 'biasa', 'segera', 'sangat_segera']);
            $table->string('received_position')->nullable(); //waka waka punya turunan
            $table->string('from_position')->nullable(); //waka waka punya turunan
            $table->date('max_date')->nullable();
            $table->tinyInteger('status')->default(1);
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
        Schema::dropIfExists('dispositions');
    }
};
