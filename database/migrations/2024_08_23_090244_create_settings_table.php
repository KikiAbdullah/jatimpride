<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->text('icon')->nullable();
            $table->text('logo')->nullable();
            $table->text('event_logo')->nullable();
            $table->text('event_gmaps')->nullable();
            $table->dateTime('event_date')->nullable();
            $table->text('about_foto')->nullable();
            $table->string('about_name')->nullable();
            $table->string('about_jabatan')->nullable();
            $table->text('about_text')->nullable();
            $table->string('contact_name')->nullable();
            $table->text('contact_alamat')->nullable();
            $table->string('contact_whatsapp')->nullable();
            $table->string('contact_email')->nullable();
            $table->string('contact_instagram')->nullable();
            $table->string('contact_tiktok')->nullable();
            $table->string('contact_youtube')->nullable();
            $table->softDeletes(); // Adds a deleted_at column for soft deletes
            $table->timestamps();  // Adds created_at and updated_at columns
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('settings');
    }
}
