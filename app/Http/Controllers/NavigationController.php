<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Navigation;
use App\Permission;

class NavigationController extends Controller
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
        $model = Navigation::where('parent',NULL)->orderBy('sort','ASC')->get();
        if($search){
            $model = Navigation::where([
                ['parent',NULL],
                ['name','like','%'.$request->search.'%']
            ])
            ->orWhere([
                ['parent',NULL],
                ['route','like','%'.$request->search.'%']
            ])
            ->get();
        }
        return view('navigation.index',compact('model','search'));
    }

      /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function history(Request $request)
    {
        $search = $request->search;
        $model = Navigation::onlyTrashed()->paginate(10);
        if($search){
            $model = Navigation::onlyTrashed()->where('name','like','%'.$request->search.'%')
            ->orWhere('route','like','%'.$request->search.'%')
            ->paginate(10);
        }
        return view('navigation.history',compact('model','search'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $model = new Navigation();
        return view('navigation.form',compact('model'));
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
            'name' => 'required',
            'route' => 'required',
            'type' => 'required',
            'sort' => 'required|numeric',
            'icon' => 'required',
        ]);

        $permission = Permission::where('id',$request->route)->orWhere('name',$request->route)->first();

        $model = Navigation::create(array_merge($request->all(),['route'=>$permission->name]));

        if($model){
            return redirect('/navigation')->with('success', 'Data has been saved successfully');
        }

        return redirect('/navigation')->with('danger', 'Data cannot be saved');
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
        $model = Navigation::findOrFail($id);
        return view('navigation.form',compact('model'));
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
            'name' => 'required',
            'route' => 'required',
            'type' => 'required',
            'sort' => 'required|numeric',
            'icon' => 'required',
        ]);
        
        $request->request->remove('_token');
        $request->request->remove('_method');


        $permission = Permission::where('id',$request->route)->orWhere('name',$request->route)->first();


        $model = Navigation::where('id', $id)->update(array_merge($request->all(),['route'=>$permission->name]));
  
        if($model){
            return redirect('/navigation')->with('success', 'Data has been saved successfully');
        }

        return redirect('/navigation')->with('danger', 'Data cannot be saved');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $model = Navigation::find($id);
    	$model->delete();
 
        return back()->with('success', 'Navigation removed!');
    }

    public function recover($id)
    {
        $model = Navigation::onlyTrashed()->where('id',$id)->restore();
        return back()->with('success', 'Navigation recovered!');
    }

    public function routes(Request $request)
    {
        $model = Permission::select(DB::raw('id as id, name as text'))->where('name','like','%'.$request->q.'%')->limit(5)->get();
        return response()->json(['results'=>$model]);
    }

    public function parents(Request $request)
    {
        $model = Navigation::select(DB::raw('id, name as text'))->where('name','like','%'.$request->q.'%')->limit(5)->get();
        return response()->json(['results'=>$model]);
    }

}
