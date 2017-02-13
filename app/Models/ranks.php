<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ranks extends Model
{
    protected $table = "ranks";
    protected $primaryKey = "id";
    public $timestamps = true;

    public function rankpolice()
    {
    	return $this->hasMany('App\Models\Police_Advisory', 'rank_id');
    }
}
