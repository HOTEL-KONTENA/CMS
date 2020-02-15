<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Article extends Model
{
    use SoftDeletes;

	protected $guarded 				= array();
	protected $table 				= 'CMS_articles';
    protected $primaryKey 			= 'id';
    protected $fillable = [
        'title', 'published_at', 'cover_image', 'content', 'user_id',
    ];
    protected $rules = array(
        'user_id'       => 'bail|required',
        'title'         => 'bail|required|max:255',
        'published_at'  => 'bail|required|date',
        'cover_image'   => 'bail|required',
        'external_link' => 'bail|required|url',
    );
    protected $hidden = [
    ];
    protected $errors 				= [];
    protected $dates                = ['published_at'];

    // Error handling
    function getErrors(){
		return $this->errors;
    }
    function setError($msg){
		$this->errors = $msg;
		return true;
	}
}
