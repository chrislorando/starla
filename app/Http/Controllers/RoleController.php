<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\PermissionRole;
use App\Permission;
use App\Role;

class RoleController extends Controller
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
        $model = Role::paginate(15);
        if($search){
            $model = Role::where('name','like','%'.$request->search.'%')->paginate(10);
        }
        return view('role.index',compact('model','search'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $model = new Role();
        return view('role.form',compact('model'));
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
        ]);

        $model = Role::create($request->all());

        if($model){
            return redirect('/role')->with('success', 'Data has been saved successfully');
        }

        return redirect('/role')->with('danger', 'Data cannot be saved');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $model = Role::findOrFail($id);

        $types = Permission::select('controller')->groupBy('controller')->get();
        $permissions = [];
        $pr = [];

        $items = PermissionRole::where('role_id', $id)->get();

        foreach ($items as $it) {
            $pr[$it->permission_id] = $it->permission_id;
        }

        foreach ($types as $t) {
            $actions = Permission::where('controller', $t->controller)->orderBy('controller', 'ASC')->get();
            foreach ($actions as $a) {
                $checked = false;
                $can = array_key_exists($a->id, $pr);
                if ($can) {
                    $checked = 'checked';
                }
                $permissions[$t->controller][] = ['id'=>$a->id,'name'=>$a->name,'can'=>$checked];
            }
        }

        return view('role.show', compact('model', 'permissions'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $model = Role::findOrFail($id);
        return view('role.form',compact('model'));
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
        ]);
        
        $request->request->remove('_token');
        $request->request->remove('_method');

        $model = Role::where('id', $id)->update($request->all());
        
        if($model){
            return redirect('/role')->with('success', 'Data has been saved successfully');
        }

        return redirect('/role')->with('danger', 'Data cannot be saved');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $model = Role::find($id);

        DB::beginTransaction();

        try {
            $model->delete();

            DB::commit();

            return back()->with('success', 'Role has been removed');
        } catch (\Exception $e) {
            DB::rollback();

            return back()->with('danger', 'Role cannot be removed. This role attached to a user.');
        }
    	
 
        
    }

    public function permission($id)
    {
        $decode = base64_decode($id);
        $raw = explode('|', $decode);
        $role_id = $raw[0];
        $permission_id = $raw[1];
        $msg = '';

        $isExists = PermissionRole::where('role_id', $role_id)->where('permission_id', $permission_id)->first();
        $role = Role::find($role_id);
        if (!$isExists) {
            $rs = $role->permissions()->attach($permission_id);
            $msg = 'Permission added';
        } else {
            $rs = $role->permissions()->detach($permission_id);
            $msg = 'Permission removed';
        }

        echo json_encode($msg);
    }

}
