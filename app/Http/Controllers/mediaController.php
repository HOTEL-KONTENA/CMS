<?php

namespace App\Http\Controllers;

// use Response;
use Illuminate\Http\Request;
use Response, Input, AWS;

class mediaController extends Controller
{
    //
    public function uploadImagePromotion(Request $request){
        // $request->validate([
        //     'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        // ]);
        $result = $this->upload($request->file('image'), "promotion", date("Y/m/d/") .time());

        return Response::json([
            'url' => $result
        ], 200);
    }

    public function uploadImageArticle(Request $request){
        // $request->validate([
        //     'image' => 'required|image|mimes:png|max:2048',
        // ]);
        $result = $this->upload($request->file('image'), 'article', date("Y/m/d/") .time());

        return Response::json([
            'url' => $result
        ], 200);
    }
}
