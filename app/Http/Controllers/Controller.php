<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

use Request, Redirect;
use Aws\S3\S3Client;

class Controller extends BaseController
{
	use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

	//public page data
	protected $page_attributes;
	protected $page_datas;

	function __construct() 
	{
		// sets params
		$this->page_attributes 			= new \Stdclass;
		$this->page_datas 				= new \Stdclass;

		// auto getter helper
		$this->getSearch();
		$this->getFilter();
		$this->getSorting();
	}   

	public function generateView(){
		return $this->view
			->with('page_attributes', $this->page_attributes)
			->with('page_datas', $this->page_datas)
			;
	} 

	public function generateRedirect($route_to){
		if(isset($this->page_attributes->msg['error'])){
			if(count($this->page_attributes->msg['error']) > 0){
				// return Redirect::back()
				return Redirect::back()
						->withInput(Request::all())
						->withErrors($this->page_attributes->msg['error'])
						;
			}
		}

		if(isset($this->page_attributes->msg['warning'])){
			return Redirect::to($route_to)
					->with('msg', $this->page_attributes->msg)
					;
		}

		if(isset($this->page_attributes->msg['info'])){
			return Redirect::to($route_to)
					->with('msg', $this->page_attributes->msg)
					;
		}

		if(isset($this->page_attributes->msg['success'])){
			return Redirect::to($route_to)
					->with('msg', $this->page_attributes->msg)
					;
		}

		// no message
		return Redirect::to($route_to);
	} 

	//pagination
	public function paginate($route = null, $count = null, $current = null, $take = 15){
		//README
		//$route : route current page. $route = route('admin.product.index')
		//$count : number of data. $count = count($data)
		//$current : current page. $current = input::get($page)

		$this->page_attributes->paging = new LengthAwarePaginator($count, $count, $take, $current);
		$this->page_attributes->paging->setPath($route);
	}

	//search
	private function getSearch(){
		$this->page_datas->search    = Request::input('search');
	}
	private function getFilter(){
		$this->page_datas->filter    = Request::input('filter');
	}
	private function getSorting(){
		$this->page_datas->sorting   = Request::input('sorting');
	} 

	protected function upload($file, $folder = null, $filename = null){

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
            'SourceFile' => $file,
            'ACL'        => 'public-read',
        ));

        // return url
        return 'https://sgp1.digitaloceanspaces.com/basilhotel/kontena/' . $folder .  '/' . $filename.'.'.$file->getClientOriginalExtension();
    }

}
