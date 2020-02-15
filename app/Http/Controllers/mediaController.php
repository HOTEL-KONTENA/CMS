<?php

namespace App\Http\Controllers;

// use Response;
use Illuminate\Http\Request;
use Response, Input, AWS;
use Aws\S3\S3Client;

class mediaController extends Controller
{
    private function upload($file, $folder = null, $filename = null){

        // S3: Do Space uploader
        $s3     = new S3Client([
            'version'           => 'latest',
            'region'            => 'sgp1',
            'endpoint'          => 'https://sgp1.digitaloceanspaces.com',
            'credentials'       => [
                'key'    => env('DO_ACCESS_KEY_ID'),
                'secret' => env('DO_SECRET_ACCESS_KEY'),
            ],
        ]);

        $s3->putObject(array(
            'Bucket'     => 'basilhotel',
            'Key'        => "kontena/" . $folder .  "/" . $filename.'.'.$file->getClientOriginalExtension(),
            'Body'       => $file,
            'ACL'        => 'public-read',
        ));

        // return url
        return 'https://sgp1.digitaloceanspaces.com/basilhotel/kontena/' . $folder .  '/' . $filename.'.'.$file->getClientOriginalExtension();
    }

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
