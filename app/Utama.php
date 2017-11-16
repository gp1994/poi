<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Utama extends Model
{
    protected $table = "info_utama";
    protected $fillable = ['id','olokasi','lokasi','olatitude','latitude','olongitude','longitude','last_updated_by'];
}
