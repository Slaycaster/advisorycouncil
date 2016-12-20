<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class unit_office_tertiaries extends Model
{
    protected $table = "unit_office_tertiaries";
    protected $primaryKey = "id";
    public $timestamps = true;

    public function sercond()
    {
    	return $this->belongsTo('App\Models\unit_office_secondaries', 'UnitOfficeSecondaryID', 'id');
    }

    public function quaternary()
    {
        return $this->hasMany('App\Models\unit_office_quaternaries', 'UnitOfficeTertiaryID');
    }
}
