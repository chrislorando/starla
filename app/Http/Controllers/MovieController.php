<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Movie;

class MovieController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $search = $request->search;
        $model = Movie::paginate(10);
        if($search){
            $model = Movie::where('title','like','%'.$request->search.'%')
            ->orWhere('overview','like','%'.$request->search.'%')
            ->paginate(10);
        }
      
        return view('movie.index',compact('model','search'));
    }

      /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function history(Request $request)
    {
        $search = $request->search;
        $model = Movie::onlyTrashed()->paginate(10);
        if($search){
            $model = Movie::onlyTrashed()->where('title','like','%'.$request->search.'%')
            ->orWhere('overview','like','%'.$request->search.'%')
            ->paginate(10);
        }
        return view('movie.history',compact('model','search'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $model = new Movie();
        return view('movie.form',compact('model'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
            'category' => 'required',
            'overview' => 'required',
            'release_date' => 'required',
        ]);

        $model = Movie::create($request->all());
        return redirect('/movie');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $model = Movie::findOrFail($id);
        return view('movie.form',compact('model'));
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
        $request->validate([
            'title' => 'required|max:255',
            'category' => 'required',
            'overview' => 'required',
            'release_date' => 'required',
        ]);

        
        $request->request->remove('_token');
        $request->request->remove('_method');

        $request->release_date = date('Y-m-d',strtotime($request->release_date));

        $model = Movie::where('id', $id)->update($request->all());
        return redirect('/movie');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $model = Movie::find($id);
    	$model->delete();
 
    	return redirect('/movie');
    }

    public function recover($id)
    {
        $model = Movie::onlyTrashed()->where('id',$id)->restore();
        return redirect('/movie/history');
    }
}
