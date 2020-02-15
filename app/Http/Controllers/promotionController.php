<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Promotion;
use Input, Auth, Carbon\Carbon;

class promotionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // init : page attributes
		$this->page_attributes->title       = 'Promotion';
		$this->page_attributes->sub_title   = 'Index';
        $this->page_attributes->filter      =  null;

        $this->page_datas->datas            = Promotion::paginate();

        // views
        $this->view                         = view('pages.backend.promotion.index');
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
		$this->page_attributes->title       = 'Promotion';
		$this->page_attributes->sub_title   = $id ? "Edit Data" : "New Data";
        $this->page_attributes->filter      = null;

        $this->page_datas->datas            = $id ? Promotion::findOrFail($id) : [];
        if($this->page_datas->datas){
            $this->page_datas->datas['client'] = json_decode($this->page_datas->datas['client'], true);
        }

        $this->page_datas->id               = $id;

        // views
        $this->view                         = view('pages.backend.promotion.create');
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
        $promotion = Promotion::findOrNew($id);

        // fill input
        $s_at = Input::get('start_at') ? Carbon::createFromFormat('d-m-Y H:i', Input::get('start_at')) : null;
        $e_at = Input::get('end_at') ? Carbon::createFromFormat('d-m-Y H:i', Input::get('end_at')) : null;

        $promotion['user_id'] = Auth::user()['id'];
        $promotion['title'] = Input::get('title');
        $promotion['start_at'] = $s_at;
        $promotion['end_at'] = $e_at;
        $promotion['cover_image'] = Input::get('photo_url');
        $promotion['description'] = Input::get('description');

        // save data
        try{
            $promotion->save();
            $this->page_attributes->msg['error'] = $promotion->getErrors();
        }catch(\Illuminate\Database\QueryException $ex){
            $this->page_attributes->msg['error'] = [$ex->getMessage()];
        }

        // return view
        $this->page_attributes->msg['success'] = 'Data successfully saved';

        if($id){
            return $this->generateRedirect(route('backend.promotion.show', ['id' => $id]));
        }

        return $this->generateRedirect(route('backend.promotion.index'));
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
		$this->page_attributes->title       = 'Promotion';
		$this->page_attributes->sub_title   = 'Detail';
        $this->page_attributes->filter      =  null;

        $this->page_datas->datas            = Promotion::findOrFail($id);

        $this->page_datas->id               = $id;

        // views
        $this->view                         = view('pages.backend.promotion.show');
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
        //
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
        $user = Promotion::findOrFail($id);
        $user->delete();

        // return view
        $this->page_attributes->msg['success'] = 'Data Successfully Deleted';

        return $this->generateRedirect(route('backend.promotion.index'));
    }
}
