<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Police_Advisory extends Model
{
    protected $table = "Police_Advisory";
    protected $primaryKey = "ID";
    public $timestamps = true;

    public function policetraining()
    {
        return $this->hasMany('App\Models\Training', 'police_id');
    }

    public function unitoffice()
    {
        return $this->belongsTo('App\Models\unit_office', 'unit_id', 'id');
    }

    public function secondaries()
    {
        return $this->belongsTo('App\Models\unit_office_secondaries', 'second_id', 'id');
    }

    public function tertiary()
    {
        return $this->belongsTo('App\Models\unit_office_tertiary', 'tertiary_id', 'id');
    }

    public function quaternary()
    {
        return $this->belongsTo('App\Models\unit_office_quaternaries', 'quaternary_id', 'id');
    }

    public function policeposition()
    {
        return $this->belongsTo('App\Models\Police_Position', 'police_position_id', 'id');
    }

    public  function rank()
    {
        return $this->belongsTo('App\Models\ranks', 'rank_id', 'id');
    }

}
