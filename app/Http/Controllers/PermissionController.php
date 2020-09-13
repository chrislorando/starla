<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Permission;

class PermissionController extends Controller
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

    public function generate()
    {
        $ctrl = [];
        foreach (glob(app_path()."/Http/Controllers/*.php") as $key=>$controller) {
            $controllername = basename($controller, '.php');

                $class = 'App\Http\Controllers\\'.$controllername;

                if (strlen($controllername) > 10) {
                    $array1 = get_class_methods($class);

                    if ($parent_class = get_parent_class($class)) {
                        $array2 = get_class_methods($parent_class);
                        $array3 = array_diff($array1, $array2);
                    } else {
                        $array2 = [];
                        $array3 = $array1;
                    }

                    $ctrl[$controllername] = $array3;
                }
           
        }

        foreach($ctrl as $k=>$row){
            $cName = substr($k, 0, -10); 

            $permissionC = '/'.strtolower($cName);

            $existsC = Permission::where('name',$permissionC)->first();

            if(!$existsC){
                Permission::create([
                    'name' => $permissionC,
                    'controller'=> $cName,
                    'action'=> 'index',
                    'method'=> 'get',
                    'params'=> '',
                    'alias'=> '' 
                ]);
            }
            
            foreach($row as $r){
                
                if($r!='__construct'){

                    if(preg_match('(index|create|edit|show|history)', $r) === 1) { 
                        $method = 'get';
                    }else if(preg_match('(store|post)', $r) === 1) { 
                        $method = 'post';
                    }else if(preg_match('(update|put)', $r) === 1) { 
                        $method = 'put';
                    }else if(preg_match('(delete|remove|destroy)', $r) === 1) { 
                        $method = 'delete';
                    }else if(preg_match('(recover|change|patch)', $r) === 1) { 
                        $method = 'patch';
                    }else{
                        $method = 'get';
                    } 

                    if(preg_match('(edit|show|update|delete|destroy|remove|recover|change|put|patch)', $r) === 1) { 
                        $params = '{id}';
                    }else{
                        $params = '';
                    } 

                    if(preg_match('(store|post)', $r) === 1) { 
                        $alias = 'create-'.strtolower($cName);
                    }else if(preg_match('(update|put)', $r) === 1) { 
                        $alias = 'edit-'.strtolower($cName);
                    }else{
                        $alias = '';
                    } 
  
                    $permission = '/'.strtolower($cName).'/'.$r;

                    $exists = Permission::where('name',$permission)->first();

                    if(!$exists){
                        Permission::create([
                            'name' => $permission,
                            'controller'=> $cName,
                            'action'=> $r,
                            'method'=> $method,
                            'params'=> $params,
                            'alias'=> $alias 
                        ]);
                    }

                }
                
            }  
        }

        return redirect('/permission')->with('message', 'Routes added!');
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $search = $request->search;
        $model = Permission::paginate(15);
        if($search){
            $model = Permission::where('name','like','%'.$request->search.'%')
            ->orWhere('controller','like','%'.$request->search.'%')
            ->orWhere('action','like','%'.$request->search.'%')
            ->paginate(10);
        }
        return view('permission.index',compact('model','search'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $model = new Permission();
        return view('permission.form',compact('model'));
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
            'controller' => 'required',
            'action' => 'required',
            'method' => 'required',
        ]);

        $model = Permission::create($request->all());

        if($model){
            return redirect('/permission')->with('success', 'Data has been saved successfully');
        }

        return redirect('/permission')->with('danger', 'Data cannot be saved');
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
        $model = Permission::findOrFail($id);
        return view('permission.form',compact('model'));
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
            'controller' => 'required',
            'action' => 'required',
            'method' => 'required',
        ]);
        
        $request->request->remove('_token');
        $request->request->remove('_method');

        $model = Permission::where('id', $id)->update($request->all());

        if($model){
            return redirect('/permission')->with('success', 'Data has been saved successfully');
        }

        return redirect('/permission')->with('danger', 'Data cannot be saved');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $model = Permission::find($id);
    	$model->delete();
 
        return back()->with('message', 'Permission has been removed');
    }
}
