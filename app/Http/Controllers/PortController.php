<?php

namespace App\Http\Controllers;

use App\Models\Port;
use App\Models\City;
use App\Models\Country;
use Illuminate\Http\Request;
use DataTables;
use Illuminate\Validation\ValidationException;


class PortController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->ajax()){
            $data = Port::join('countrys','ports.country_id','=','countrys.id')
            ->join('citys','ports.city_id', '=', 'citys.id')
            ->select('ports.id','ports.port','ports.city_id','ports.country_id','countrys.country','citys.city');
            return Datatables::of($data)->make(true);
        }
        $city = City::all();
        $country = Country::all();
        return view('admin.port.index', compact('city', 'country'));
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
                'port' => 'required'
            ]);
            $data = $request->all();
            Port::create($data);
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
     * @param  \App\Models\Port  $port
     * @return \Illuminate\Http\Response
     */
    public function show(Port $port)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Port  $port
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Port::find($id);
        return response()->json($data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Port  $port
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try{
            $this->validate($request, [
                'port' => 'required'
            ]);
            $data = $request->all();
            $port = Port::find($id);
            $port->fill($data)->save();
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
     * @param  \App\Models\Port  $port
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try{
            $port = Port::find($id);
            $port->delete();
            return ['code' => '200', 'message' => 'success'];
        }
        catch(\Exception $e){
            return ['code' => '400', 'error_message' => $e->getMessage()];
        }
    }
}
