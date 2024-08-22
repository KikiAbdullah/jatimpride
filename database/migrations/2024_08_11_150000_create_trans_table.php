<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trans', function (Blueprint $table) {
            $table->id();
            $table->string('no')->nullable();
            $table->date('tanggal')->nullable();
            $table->bigInteger('customer_id')->nullable();
            $table->bigInteger('jenis_pengiriman_id')->nullable();
            $table->bigInteger('payment_id')->nullable();
            $table->bigInteger('provinsi_id')->nullable();
            $table->bigInteger('kabupaten_id')->nullable();
            $table->bigInteger('kecamatan_id')->nullable();
            $table->bigInteger('kelurahan_id')->nullable();
            $table->text('alamat')->nullable();
            $table->text('bukti')->nullable()->comment('bukti pembayaran');
            $table->string('noresi')->nullable();

            $table->integer('confirm_by')->nullable();
            $table->dateTime('confirm_at')->nullable();

            $table->integer('closed_by')->nullable();
            $table->dateTime('closed_at')->nullable();

            $table->integer('rejected_by')->nullable();
            $table->dateTime('rejected_at')->nullable();

            $table->text('text')->nullable();
            $table->text('text_reject')->nullable();

            $table->string('status')->nullable();
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
        Schema::dropIfExists('trans');
    }
}
