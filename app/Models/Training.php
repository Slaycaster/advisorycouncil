<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Training extends Model
{
   	protected $table = "Training";
    protected $primaryKey = "ID";
    public $timestamps = true;

    

    public function policetraining()
    {
        return $this->belongsTo('App\Models\Police_Advisory', 'police_id', 'ID'); 
    }

    public function lecturer()
    {
        return $this->hasMany('App\Models\Lecturer', 'training_id');
    }

    
}
