<?php

namespace App\Http\Controllers;

use App\Models\ChargesType;
use Illuminate\Http\Request;
use DataTables;
use Illuminate\Validation\ValidationException;

class ChargesTypeController extends Controller
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
            return Datatables::eloquent(ChargesType::query())->make(true);
        }
        return view('admin.charges_type.index');
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
            ChargesType::create($data);
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
     * @param  \App\Models\ChargesType  $chargesType
     * @return \Illuminate\Http\Response
     */
    public function show(ChargesType $chargesType)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ChargesType  $chargesType
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = ChargesType::find($id);
        return response()->json($data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ChargesType  $chargesType
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try{
            $this->validate($request, [
                'name' => 'required'
            ]);
            $data = $request->all();
            $charges_type = ChargesType::find($id);
            $charges_type->fill($data)->save();
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
     * @param  \App\Models\ChargesType  $chargesType
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // try{
        //     $charges_type = ChargesType::find($id);
        //     $charges_type->delete();
        //     return ['code' => '200', 'message' => 'success'];
        // }
        // catch(\Exception $e){
        //     return ['code' => '400', 'error_message' => $e->getMessage()];
        // }
    }
}
