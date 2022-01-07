<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('nama_lengkap');
            $table->string('username');
            $table->string('avatar')->nullable();
            $table->enum('asal_prodi', ['Teknik Informatika', 'Sistem Informasi', 'Bisnis Digital']);
            $table->string('pekerjaan')->nullable();;
            $table->string('angkatan')->nullable();;
            $table->string('tahun_masuk')->nullable();;
            $table->string('tahun_lulus')->nullable();;
            $table->string('alamat_kantor')->nullable();;
            $table->string('linkedin')->nullable();;
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
