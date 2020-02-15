<?php

namespace App\Http\Controllers;

use Input, Auth;
use App\Models\Article;
use Illuminate\Http\Request;

class blogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
		$this->page_attributes->title       = 'Article';
		$this->page_attributes->sub_title   = 'Index';
        $this->page_attributes->filter      =  null;

        $this->page_datas->datas            = Article::OrderBy('updated_at', 'desc')
                                                ->paginate();

        // views
        $this->view                         = view('pages.backend.blog.index');
        return $this->generateView();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id = null)
    {
        // init : page attributes
		$this->page_attributes->title       = 'Article';
		$this->page_attributes->sub_title   = $id ? "Edit Post" : "New Post";
        $this->page_attributes->filter      = null;

        $this->page_datas->datas            = $id ? Article::findOrFail($id) : [];

        $this->page_datas->id               = $id;

        // views
        $this->view                         = view('pages.backend.blog.create');
        return $this->generateView();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id = null)
    {
        // Database
        $blog = Article::findOrNew($id);

        // fill input
        $blog['user_id'] = Auth::user()->id;
        $blog['title'] = Input::get('title');
        $blog['cover_image'] = Input::get('photo_url');
        $published_at = date_create(Input::get('published_at'));
        $blog['published_at'] = date_format($published_at,"Y-m-d H:i:s");
        // $blog['content'] = Input::get('content');
        $blog['content'] = 'EXTERNAL LINK';
        $blog['external_link'] = Input::get('external_link');

        // save data
        try{
            $blog->save();
            $this->page_attributes->msg['error'] = $blog->getErrors();
        }catch(\Illuminate\Database\QueryException $ex){
            $this->page_attributes->msg['error'] = [$ex->getMessage()];
        }

        // return view
        $this->page_attributes->msg['success'] = 'Data successfully saved';

        if($id){
            return $this->generateRedirect(route('backend.blog.show', ['id' => $id]));
        }

        return $this->generateRedirect(route('backend.blog.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // init : page attributes
		$this->page_attributes->title       = 'Article';
		$this->page_attributes->sub_title   = 'Detail';
        $this->page_attributes->filter      =  null;

        $this->page_datas->datas            = Article::findOrFail($id);
        if($this->page_datas->datas){
            $this->page_datas->datas['client'] = json_decode($this->page_datas->datas['client'], true);
        }
        $this->page_datas->id               = $id;

        // views
        $this->view                         = view('pages.backend.blog.show');
        return $this->generateView();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        return $this->create($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        return $this->store($request, $id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $user = Article::findOrFail($id);
        $user->delete();

        // return view
        $this->page_attributes->msg['success'] = 'Data Successfully Deleted';

        return $this->generateRedirect(route('backend.blog.index'));
    }
}
