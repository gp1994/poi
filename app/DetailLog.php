<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetailLog extends Model
{
   protected $table = "log_detail";
    protected $fillable = ['id','nama_admin','nama_poi','oketerangan','keterangan','oimage','image','oimage2','image2','oimage3','image3','oimage4','image4','oimage5','image5','oimage6','image6','oimage7','image7','oimage8','image8','oimage9','image9','oimage10','image10','ovideos','videos','action'];
}
