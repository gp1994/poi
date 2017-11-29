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
            $table->string('olokasi', 30)->nullable();
            $table->string('lokasi', 30);
            $table->decimal('olatitude',10,7)->nullable();
            $table->decimal('latitude',10,7);
            $table->decimal('olongitude',10,7)->nullable();
            $table->decimal('longitude',10,7);
            $table->timestamps();
            $table->string('last_updated_by',30);        
        });

        Schema::create('info_detail', function (Blueprint $table) {
            $table->increments('id');
            $table->longtext('oketerangan')->nullable();
            $table->longtext('keterangan')->nullable();
            $table->string('oimage',480)->nullable();
            $table->string('image',480)->nullable();
            $table->string('oimage2',480)->nullable();
            $table->string('image2',480)->nullable();
            $table->string('oimage3',480)->nullable();
            $table->string('image3',480)->nullable();
            $table->string('oimage4',480)->nullable();
            $table->string('image4',480)->nullable();
            $table->string('oimage5',480)->nullable();
            $table->string('image5',480)->nullable();
            $table->string('oimage6',480)->nullable();
            $table->string('image6',480)->nullable();
            $table->string('oimage7',480)->nullable();
            $table->string('image7',480)->nullable();
            $table->string('oimage8',480)->nullable();
            $table->string('image8',480)->nullable();
            $table->string('oimage9',480)->nullable();
            $table->string('image9',480)->nullable();
            $table->string('oimage10',480)->nullable();
            $table->string('image10',480)->nullable();
            $table->string('ovideos',480)->nullable();
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

        Schema::create('log', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nama_admin',30)->nullable();
            $table->string('tipe',15);
            $table->string('action',10);
            $table->integer('poi_id')->unsigned()->nullable();
            $table->string('object',19);
            $table->integer('object_id')->unsigned()->nullable();
            $table->longtext('before')->nullable();
            $table->longtext('after')->nullable();
            $table->timestamps();         
        });

         Schema::table('log', function (Blueprint $table){
            
            $table->foreign('poi_id')->references('id')->on('info_utama')->onDelete('cascade')->onUpdate('cascade');
           
        });
          Schema::table('log', function (Blueprint $table){
            
            $table->foreign('object_id')->references('id')->on('info_utama')->onDelete('cascade')->onUpdate('cascade');
           
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
