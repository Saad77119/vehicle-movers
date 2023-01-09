<?php

namespace App\Http\Controllers;

use App\Models\Make;
use Illuminate\Http\Request;
use DataTables;
use Illuminate\Validation\ValidationException;

class MakeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(Request $request)
    {
        if($request->ajax()){
            return Datatables::eloquent(Make::query())->make(true);
        }
        return view('admin.make.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try{
            $this->validate($request, [
                'name' => 'required'
            ]);
            $data = $request->all();
            Make::create($data);
            return ['code' => '200', 'message' => 'success'];
        }
        catch(\Exception | ValidationException $e){
            if($e instanceof ValidationException){
                return ['code' => '400', 'errors' => $e->errors() ];
            }
            else{
                return ['code' => '400', 'error_message' => $e->getMessage()];
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Make  $make
     * @return \Illuminate\Http\Response
     */
    public function show(Make $make)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Make  $make
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Make::find($id);
        return response()->json($data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Make  $make
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try{
            $this->validate($request, [
                'name' => 'required'
            ]);
            $data = $request->all();
            $name = Make::find($id);
            $name->fill($data)->save();
            return ['code' => '200', 'message' => 'success'];
        }
        catch(\Exception | ValidationException $e){
            if($e instanceof ValidationException){
                return ['code' => '400', 'errors' => $e->errors() ];
            }
            else{
                return ['code' => '400', 'error_message' => $e->getMessage()];
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Make  $make
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try{
            $name = Make::find($id);
            $name->delete();
            return ['code' => '200', 'message' => 'success'];
        }
        catch(\Exception $e){
            return ['code' => '400', 'error_message' => $e->getMessage()];
        }
    }
}
