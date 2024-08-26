<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFotoToMerchFotos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('merch_fotos', function (Blueprint $table) {
            $table->string('name', 100);
            $table->integer('urutan');
            $table->text('foto')->nullable();
            $table->integer('created_by')->nullable();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('merch_fotos', function (Blueprint $table) {
            //
        });
    }
}
