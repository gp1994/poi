<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Utama extends Model
{
    protected $table = "info_utama";
    protected $fillable = ['id','nama','latitude','longitude','last_updated_by'];
}
