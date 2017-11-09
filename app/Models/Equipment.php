<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Equipment extends Model {
	//specify the table to be used to store the equipment
	protected $table = "equipment";
	//specify the fields that must be filled
    protected $fillable = [
        'facilityid', 'type','hubid', 'enginenumber', 'chasisnumber', 'modelnumber', 'brand', 'yearofmanufacture', 'enginecapacity', 'insurance', 'numberplate', 'color', 'maintenanceschedule'
    ];
	
	public static $rules = [
		'facilityid' => 'required',
		'hubid' => 'required',
		'enginenumber' => 'required',
		'chasisnumber'=>'required'
	];
		/**
	* Relationship with districts
	*/
	public function hub()
	{
		return $this->belongsTo('App\Models\Hub', 'hubid','id');
	}
}
