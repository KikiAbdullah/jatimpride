<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransLinesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trans_lines', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('trans_id')->nullable();
            $table->bigInteger('merch_id')->nullable();
            $table->string('size')->nullable();
            $table->text('text')->nullable();
            $table->integer('qty')->nullable();
            $table->decimal('harga', 10, 2)->nullable();
            $table->softDeletes();
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
        Schema::dropIfExists('trans_lines');
    }
}
