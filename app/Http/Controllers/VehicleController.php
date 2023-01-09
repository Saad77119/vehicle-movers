<?php

namespace App\Http\Controllers;

use App\Models\Vehicle;
use App\Models\CarModel;
use App\Models\Make;
use App\Models\City;
use App\Models\Country;
use App\Models\Port;
use App\Models\Driver;
use App\Models\Customer;
use App\Models\AddPayment;
use App\Models\ChargesType;
use Illuminate\Http\Request;
use DataTables;
use DB;
use Illuminate\Validation\ValidationException;

class VehicleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware(['auth','permission:vehicle']);
    }
    public function index(Request $request)
    {
        if($request->ajax()){
            $data = Vehicle::join('makes','vehicles.make','=','makes.id')
            ->join('car_models','vehicles.model', '=', 'car_models.id')
            ->join('countrys', 'vehicles.country', '=', 'countrys.id')
            ->join('citys', 'vehicles.city', '=', 'citys.id')
            ->join('ports', 'vehicles.port', '=', 'ports.id')
            ->join('customers', 'vehicles.customer_id', '=', 'customers.id')
            ->join('drivers', 'vehicles.driver_id', '=', 'drivers.id')
            ->select('vehicles.id','vehicles.year_of_manufacture','vehicles.port','vehicles.address','vehicles.pickup_address','vehicles.customer_id','vehicles.driver_id','vehicles.estimate_pickup_time','vehicles.estimate_delivery_time','vehicles.vin','countrys.country','citys.city','car_models.model','makes.name','ports.port','customers.name AS customer_name','drivers.name AS driver_name');
            return Datatables::of($data)->make(true);
        }
        return view('admin.vehicle.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $make = Make::all();
        $city = City::all();
        $country = Country::all();
        $port = Port::all();
        $drivers = Driver::all();
        $customers = Customer::all();
        return view('admin.vehicle.create', compact('make','city','country','port', 'drivers','customers'));
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
                'make' => 'required',
                'model' => 'required',
                'year_of_manufacture' => 'required',
                'vin' => 'required',
                'year_of_manufacture' => 'required',
                'country' => 'required',
                'city' => 'required',
                'port' => 'required',
                'customer_id' => 'required',
                'port_manager' => 'required',
                'route' => 'required',
                'address' => 'required',
                'pickup_address' => 'required',
                // 'images[]' => 'required|mimes:jpeg,png,jpg|max:2048',
                'tally_sheet' => 'required|mimes:jpeg,png,jpg,doc,docx,pdf',
                'attachments' => 'required|mimes:doc,docx,pdf'
            ]);
            $data = $request->all();
            if(!empty($data['images'])){
                $data['images']=Vehicle::multiImage($data['images']);
            }
            if($request->hasfile('attachments')){
                $attach_file = $request->file('attachments');
                $attach_file_name = rand().'.'. $attach_file->getClientOriginalExtension();
                $attach_file_path = $attach_file->move('Vehicle-Attachments',$attach_file_name);
                $data['attachments'] = $attach_file_path;
            }
            if($request->hasfile('tally_sheet')){
                $attach_file = $request->file('tally_sheet');
                $attach_file_name = rand().'.'. $attach_file->getClientOriginalExtension();
                $attach_file_path = $attach_file->move('Vehicle-TallySheet',$attach_file_name);
                $data['tally_sheet'] = $attach_file_path;
            }

                Vehicle::create($data);
                return ['code'=> '200', 'message' => 'success'];
        }
        catch(\Exception | ValidationException $e){
            if($e instanceof ValidationException){
                return ['code' => '300', 'errors' => $e->errors()];
            }
            else{
                return ['code' => '500', 'error_message' => $e->getMessage()];
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Vehicle  $vehicle
     * @return \Illuminate\Http\Response
     */
    public function show(Vehicle $vehicle)
    {
        $vehicle_data = Vehicle::join('makes','vehicles.make','=','makes.id')
            ->join('car_models','vehicles.model', '=', 'car_models.id')
            ->join('countrys', 'vehicles.country', '=', 'countrys.id')
            ->join('citys', 'vehicles.city', '=', 'citys.id')
            ->join('ports', 'vehicles.port', '=', 'ports.id')
            ->join('customers', 'vehicles.customer_id', '=', 'customers.id')
            ->join('drivers', 'vehicles.driver_id', '=', 'drivers.id')
            ->select('vehicles.*','countrys.country','citys.city','car_models.model','makes.name','ports.port','customers.name AS customer_name','drivers.name AS driver_name')
            ->where('vehicles.id', '=', $vehicle->id)->first();
        $vehicles = Vehicle::join('makes','vehicles.make','=','makes.id')
        ->join('car_models','vehicles.make', '=', 'car_models.id')
        ->select('vehicles.*','makes.name','car_models.model')->get();
        $customers = Customer::all();
        $charges_type = ChargesType::all();
        $payment_details = DB::table('add_payments')->join('payment_details', 'payment_details.add_payments_id', '=', 'add_payments.id')
        ->join('charges_types', 'payment_details.charges_type', '=', 'charges_types.id')
        ->select('payment_details.*', 'charges_types.name')
        ->where('add_payments.vehicle_id', $vehicle->id)->get();
        return view('admin.vehicle.profile_vehicle', get_defined_vars());
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Vehicle  $vehicle
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
        $data = Vehicle::find($id);
        $makes = Make::all();
        $carModels = CarModel::where('make', $data->make)->get();
        $cities = City::where('country_id', $data->country)->get();
        $countries = Country::get();
        $drivers = Driver::get();
        $customers = Customer::get();
        $ports = Port::where('city_id', $data->city)->get();
        return view('admin.vehicle.edit', get_defined_vars());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Vehicle  $vehicle
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try{
            $this->validate($request, [
                'make' => 'required',
                'model' => 'required',
                'year_of_manufacture' => 'required',
                'vin' => 'required',
                'year_of_manufacture' => 'required',
                'country' => 'required',
                'city' => 'required',
                'port' => 'required',
                'port_manager' => 'required',
                'route' => 'required',
                'address' => 'required',
                'pickup_address' => 'required'
            ]);
            $data = $request->all();
            $vehicle = Vehicle::find($id);
            if(!empty($data['images']))
            {
                $vehicle->deletMultiimg();
                $data['images']=Vehicle::multiImage($data['images']);
            }
            if($request->hasfile('attachments')){
                unlink($vehicle->attachments);
                $attach_file = $request->file('attachments');
                $attach_file_name = rand().'.'. $attach_file->getClientOriginalExtension();
                $attach_file_path = $attach_file->move('Vehicle-Attachments',$attach_file_name);
                $data['attachments'] = $attach_file_path;
            }
            if($request->hasfile('tally_sheet')){
                unlink($vehicle->tally_sheet);
                $attach_file = $request->file('tally_sheet');
                $attach_file_name = rand().'.'. $attach_file->getClientOriginalExtension();
                $attach_file_path = $attach_file->move('Vehicle-TallySheet',$attach_file_name);
                $data['tally_sheet'] = $attach_file_path;
            }
                $vehicle->fill($data)->save();
                return ['code'=> '200', 'message' => 'success'];
        }
        catch(\Exception | ValidationException $e){
            if($e instanceof ValidationException){
                return ['code' => '300', 'errors' => $e->errors()];
            }
            else{
                return ['code' => '500', 'error_message' => $e->getMessage()];
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Vehicle  $vehicle
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try{
            $data = Vehicle::find($id);
            if(!empty($data['images']))
            {
                $data->deletMultiimg();
            }
            if($data->attachments){
                unlink($data->attachments);
            }
            if($data->tally_sheet){
                unlink($data->tally_sheet);
            }
            $data->delete();
            return ['code' => '200','message'=>'success'];
        }
        catch(\Exception $e){
            return ['code' => '500','error_message'=>$e->getMessage()];
        }
    }
    public function getModels($id)
    {
        $models = CarModel::where('make_id', $id)->get();
        return response()->json($models);
    }
    public function getCity($id)
    {
        $city = City::where('country_id', $id)->get();
        return response()->json($city);
    }
    public function getPort($id)
    {
        $port = Port::where('city_id', $id)->get();
        return response()->json($port);
    }
}
