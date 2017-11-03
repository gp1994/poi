<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Detil extends Model
{
    protected $table = "info_detail";
    protected $fillable = ['id','keterangan','image','update_count','last_created_by'];
}
