<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UtamaLog extends Model
{
    protected $table = "log_utama";
    protected $fillable = ['id','nama_admin','olokasi','lokasi','olatitude','latitude','olongitude','longitude','action'];
}
