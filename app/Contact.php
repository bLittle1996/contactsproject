<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
	//manually set table, since laravel looks for a table named 'contacts' by default.
	protected $table = 'addresses'; 
	//set manual primary key, defaults to 'id'.
	protected $primaryKey = 'addr_id';
	//disable timestamps, since I cannot modify the schema :(
	public $timestamps = false;
	//add our custom accessor method (getFullNameAttribute), so it appears in our JSON when serialized
	protected $appends = ['full_name'];

	//saves me having to do this in javascript, effectively makes a fake field on the model that can be accessed via $model->full_name.
	public function getFullNameAttribute() {
		return $this->addr_first_name . " " . $this->addr_last_name;
	}

	//set up a one to many relationship with the users table, this will allow us to query the Contact's associated user!
	public function user() {
		return $this->belongsTo('App\User');
	}
}
