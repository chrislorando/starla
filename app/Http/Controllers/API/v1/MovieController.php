<?php

namespace App\Http\Controllers\API\v1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\Movie as MovieResource;
use App\Movie;
use App\User;
use Validator;

class MovieController extends Controller
{
    public $token;

    public function __construct(Request $request)
    {
        $rawToken = $request->header('Authorization');
        $user = new User();
        $this->token = $user->extractToken($rawToken);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $model = Movie::paginate(10);
        
        return MovieResource::collection($model);
    }


      /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function history()
    {
        $model = Movie::onlyTrashed()->paginate(10);

        return MovieResource::collection($model);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|max:255',
            'category' => 'required',
            'overview' => 'required',
            'release_date' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'result'=>[
                    'error'=>true,'message'=>$validator->errors()->first()
                ]
            ], 401);
        } 

        $request->release_date = date('Y-m-d',strtotime($request->release_date));

        $model = Movie::create($request->all());

        return new MovieResource($model);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|max:255',
            'category' => 'required',
            'overview' => 'required',
            'release_date' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'result'=>[
                    'error'=>true,'message'=>$validator->errors()->first()
                ]
            ], 401);
        } 
        
        $request->request->remove('_method');

        $request->release_date = date('Y-m-d',strtotime($request->release_date));

        $model = Movie::where('id', $id);

        $model->update($request->all());

        $result = $model->first();

        return new MovieResource($result);
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
 
    	return new MovieResource($model);
    }

    public function restore($id)
    {
        $restore = Movie::onlyTrashed()->where('id',$id)->restore();
        $model = Movie::find($id);

        return new MovieResource($model);
    }
}
