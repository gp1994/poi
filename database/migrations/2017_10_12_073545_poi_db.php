<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class PoiDb extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('info_utama', function (Blueprint $table) {
            $table->increments('id');
            $table->string('lokasi', 30);
            $table->decimal('latitude',10,7);
            $table->decimal('longitude',10,7);
            $table->timestamps();
            $table->string('last_updated_by',30);        
        });

        Schema::create('info_detail', function (Blueprint $table) {
            $table->increments('id');
            $table->longtext('keterangan');
            $table->string('image',480)->nullable();
            $table->string('image2',480)->nullable();
            $table->string('image3',480)->nullable();
            $table->string('image4',480)->nullable();
            $table->string('image5',480)->nullable();
            $table->string('image6',480)->nullable();
            $table->string('image7',480)->nullable();
            $table->string('image8',480)->nullable();
            $table->string('image9',480)->nullable();
            $table->string('image10',480)->nullable();
            $table->string('videos',480)->nullable();
            $table->integer('update_count')->default(0);
            $table->timestamps();
            $table->string('last_created_by',30);        
        });

        Schema::create('pengguna', function (Blueprint $table) {
          $table->increments('id');
          $table->string('peng', 32);
          $table->string('usrn', 32);
          $table->string('roles',5);
          $table->string('email', 320);
          $table->string('pwd', 64);
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
        //
    }
}
