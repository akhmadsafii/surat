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
        Schema::create('messages', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('code')->nullable();
            $table->bigInteger('no_agenda')->nullable();
            $table->enum('nature_letter', ['biasa', 'terbatas', 'rahasia', 'sangat_rahasia']);
            $table->enum('urgency_letter', ['biasa', 'segera', 'sangat_segera']);
            $table->string('type');
            $table->string('number');
            $table->date('date');
            $table->string('from');
            $table->text('address_sender')->nullable();
            $table->enum('classification', ['eksternal', 'internal']);
            $table->string('to_user')->nullable();  //opsional
            $table->string('to_position')->nullable(); //opsional
            $table->string('regard')->nullable();
            $table->text('content')->nullable();
            $table->text('description')->nullable();
            $table->string('copy_of_letter')->nullable();
            $table->string('doc_1')->nullable();
            $table->string('doc_2')->nullable();
            $table->string('doc_3')->nullable();
            $table->string('original_file')->nullable();
            $table->integer('ttd')->nullable();
            $table->integer('verificator')->nullable();
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
        Schema::dropIfExists('messages');
    }
};
