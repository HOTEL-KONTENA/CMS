<?php

namespace App\Observers;
use App\Models\Article;
use Validator;


class articleObserver extends Article
{
    public static function saving($model){
        $ori = $model->getOriginal();

        // validate
		$v = Validator::make($model->attributes, $model->rules);

		// check for failure
		if ($v->fails())
		{
            // set errors and return false
            $model->setError($v->errors());
            return false;
		}

		return true;
    }
}
