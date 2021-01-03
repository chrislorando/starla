<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Role;

class UserController extends Controller
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
        $model = User::paginate(15);
        if($search){
            $model = User::where('username','like','%'.$request->search.'%')
            ->orWhere('email','like','%'.$request->search.'%')
            ->paginate(10);
        }
        return view('user.index',compact('model','search'));
    }

      /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function history(Request $request)
    {
        $search = $request->search;
        $model = User::onlyTrashed()->paginate(10);
        if($search){
            $model = User::onlyTrashed()->where('username','like','%'.$request->search.'%')
            ->orWhere('email','like','%'.$request->search.'%')
            ->paginate(10);
        }
        return view('user.history',compact('model','search'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $model = new User();
        $role = Role::all();
        return view('user.form',compact('model','role'));
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
            'username' => 'required|alpha_num|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:8|confirmed',
            // 'role_id' => 'required',
        ]);

        $password = Hash::make($request->password);

        $model = User::create(array_merge(
            $request->all(),
            [
                'password'=>$password,
            ]
        ));

        if($model){
            return redirect('/user')->with('success', 'Data saved succesfully.');
        }

        return redirect('/user')->with('danger', 'Data cannot be saved.');
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
        $model = User::findOrFail($id);
        $role = Role::all();
        return view('user.form',compact('model','role'));
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
            'username' => 'required|alpha_num|max:255',
            'email' => 'required|email|max:255|unique:users,email,'.$id,
            'password' => 'required|min:8|confirmed',
            // 'role_id' => 'required',
        ]);
        
        $request->request->remove('_token');
        $request->request->remove('_method');
        $request->request->remove('password_confirmation');

        $model = User::where('id', $id);

        $user = $model->first();

        if($request->password=='********'){
            $password = $user->password;
        }else{
            $password = Hash::make($request->password);
        }

        $user->username = $request->username;
        $user->password = $password;
        $user->email = $request->email;
        $user->role_id = $request->role_id;

        // $save = $model->update(array_merge(
        //     $request->all(),
        //     [
        //         'password'=>$password,
        //         // 'updated_by'=> Auth::user()->username
        //     ]
        // ));

        if($user->save()){
            return redirect('/user')->with('success', 'Data saved succesfully.');
        }

        return redirect('/user')->with('danger', 'Data cannot be saved.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $model = User::find($id);
    	$model->delete();
 
        return back()->with('success', 'User removed!');
    }

    public function recover($id)
    {
        $model = User::onlyTrashed()->where('id',$id)->restore();
        return back()->with('success', 'User recovered!');
    }
}
