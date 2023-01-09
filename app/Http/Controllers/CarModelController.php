<?php

namespace App\Http\Controllers;

use App\Models\CarModel;
use App\Models\Make;
use Illuminate\Http\Request;
use DataTables;
use Illuminate\Validation\ValidationException;

class CarModelController extends Controller
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
            $data = CarModel::join('makes','car_models.make_id','=','makes.id')
            ->select('car_models.id','car_models.model','makes.name');
            return Datatables::of($data)->make(true);
        }
        $make = Make::all();
        return view('admin.car_model.index', compact('make'));
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
                'model' => 'required',
                'make_id' => 'required'
            ]);
            $data = $request->all();
            CarModel::create($data);
            return ['code' => '200', 'message' => 'success'];
        }
        catch(\Exception | ValidateException $e){
            if($e instanceof ValidateException){
                return ['code' => '400', 'error' => $e->errors()];
            }
            else{
                return ['code' => '400', 'error_message' => $e->getMessage()];
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CarModel  $carModel
     * @return \Illuminate\Http\Response
     */
    public function show(CarModel $carModel)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CarModel  $carModel
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = CarModel::find($id);
        return response()->json($data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\CarModel  $carModel
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try{
            $this->validate($request, [
                'model' => 'required',
                'make_id' => 'required'
            ]);
            $data = $request->all();
            $model = CarModel::find($id);
            $model->fill($data)->save();
            return ['code' => '200', 'message' => 'success'];
        }
        catch(\Exception | ValidateException $e){
            if($e instanceof ValidateException){
                return ['code' => '400', 'error' => $e->errors()];
            }
            else{
                return ['code' => '400', 'error_message' => $e->getMessage()];
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CarModel  $carModel
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try{
            $model = CarModel::find($id);
            $model->delete();
            return ['code' => '200', 'message' => 'success'];
        }
        catch(\Exception $e){
            return ['code' => '400', 'error_message' => $e->getMessage()];
        }
    }
}
