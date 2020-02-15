<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Promotion extends Model
{
    use SoftDeletes;

	protected $guarded 				= array();
	protected $table 				= 'CMS_promotions';
    protected $primaryKey 			= 'id';
    protected $fillable = [
        'title', 'cover_image', 'start_at', 'end_at', 'description', 'user_id',
    ];
    protected $rules = array(
        'user_id'       => 'bail|required',
        'title'         => 'bail|required|max:255',
        'start_at'      => 'bail|required|date',
        'cover_image'   => 'bail|required',
    );
    protected $hidden = [
    ];
    protected $errors 				= [];
    protected $dates                = ['start_at', 'end_at'];

    // Error handling
    function getErrors(){
		return $this->errors;
    }
    function setError($msg){
		$this->errors = $msg;
		return true;
	}
}
