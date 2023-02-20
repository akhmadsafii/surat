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
        Schema::create('inboxes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('code')->nullable();
            $table->enum('nature_letter', ['biasa', 'terbatas', 'rahasia', 'sangat_rahasia']);
            $table->enum('urgency_letter', ['biasa', 'segera', 'sangat_segera']);
            $table->integer('type');
            $table->string('number');
            $table->date('date');
            $table->string('from');
            $table->text('address_sender')->nullable();
            $table->string('to_user')->nullable();  //opsional
            $table->string('to_position')->nullable(); //opsional
            $table->string('regard')->nullable();
            $table->text('content')->nullable();
            $table->string('copy_of_letter')->nullable();
            $table->json('doc')->nullable();
            $table->json('original_file')->nullable();
            $table->tinyInteger('status')->default(3);
            $table->tinyInteger('status_disposition')->default(0);
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
        Schema::dropIfExists('inboxes');
    }
};
