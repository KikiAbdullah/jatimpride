<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddUrlToSponsor extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('sponsors', function (Blueprint $table) {
            $table->text('url')->nullable();
        });

        Schema::table('fg_supports', function (Blueprint $table) {
            $table->text('url')->nullable();
        });

        Schema::table('team_supports', function (Blueprint $table) {
            $table->text('url')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('sponsor', function (Blueprint $table) {
            //
        });
    }
}
