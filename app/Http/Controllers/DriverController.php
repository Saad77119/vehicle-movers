<?php

namespace App\Http\Controllers;

use App\Models\Driver;
use Illuminate\Http\Request;
use DataTables;
use Illuminate\Validation\ValidationException;


class DriverController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware(['auth','permission:drivers']);
    }
    public function index(Request $request)
    {
        if($request->ajax()){
            return Datatables::eloquent(Driver::query())->make(true);
        }
        return view('admin.driver.index');
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
                'name' => 'required',
                'contact_no' => 'required',
                'address' => 'required',
                'cnic' => 'required'
            ]);
            $data = $request->all();
            if($request->hasfile('image')){
                $attach_file = $request->file('image');
                $attach_file_name = rand().'.'. $attach_file->getClientOriginalExtension();
                $attach_file_path = $attach_file->move('Driver_Profile_Pic',$attach_file_name);
                $data['image'] = $attach_file_path;
            }
                Driver::create($data);
                return ['code'=> '400', 'message' => 'success'];
        }
        catch(\Exception | ValidationException $e){
            if($e instanceof ValidationException){
                return ['code' => '200', 'errors' => $e->errors()];
            }
            else{
                return ['code' => '200', 'error_message' => $e->getMessage()];
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Driver  $driver
     * @return \Illuminate\Http\Response
     */
    public function show(Driver $driver)
    {
        $driver_vehicles = Driver::leftJoin('vehicles', 'vehicles.driver_id' ,'=', 'drivers.id')
        ->leftjoin('makes', 'vehicles.make', '=', 'makes.id')
        ->leftjoin('car_models', 'vehicles.model', '=', 'car_models.id')
        ->leftjoin('customers', 'vehicles.driver_id', '=', 'customers.id')
        ->leftjoin('ports', 'vehicles.port', '=', 'ports.id')
        ->leftjoin('countrys', 'vehicles.country', '=', 'countrys.id')
        ->leftjoin('citys', 'vehicles.city', '=', 'citys.id')
        ->select('vehicles.*','makes.name','car_models.model','customers.name','ports.port','countrys.country','citys.city')
        ->where('vehicles.driver_id', '=', $driver->id)
        ->get();
        // dd($driver_vehicles);
        return view('admin.profile_view_driver.index', compact('driver','driver_vehicles'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Driver  $driver
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $driver = Driver::find($id);
        return response()->json($driver);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Driver  $driver
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try{
            $this->validate($request, [
                'name' => 'required',
                'contact_no' => 'required',
                'address' => 'required',
                'cnic' => 'required'
            ]);
            $data = $request->all();
            $driver = Driver::find($id);
            if($request->hasfile('image')){
                unlink($customer->image);
                $attach_file = $request->file('image');
                $attach_file_name = rand().'.'. $attach_file->getClientOriginalExtension();
                $attach_file_path = $attach_file->move('Profile_Pic',$attach_file_name);
                $data['image'] = $attach_file_path;
            }
                $driver->fill($data)->save();
                return ['code'=> '200', 'message' => 'success'];
        }
        catch(\Exception | ValidationException $e){
            if($e instanceof ValidationException){
                return ['code' => '400', 'errors' => $e->errors()];
            }
            else{
                return ['code' => '400', 'error_message' => $e->getMessage()];
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Driver  $driver
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try{
            $data = Driver::find($id);
            if($data->image){
                unlink($data->image);
            }
            $data->delete();
            return ['code' => '200','message'=>'success'];
        }
        catch(\Exception $e){
            return ['code' => '200','error_message'=>$e->getMessage()];
        }
    }
    public function status(Request $request, $id)
    {
        $driver = Driver::find($id);
        $driver->status = $request->status;
        $driver->save();
        return view('admin.customer.index');
    }
}
