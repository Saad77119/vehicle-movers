<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\Vehicle;
use App\Models\VehicleImages;
use App\Models\Driver;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth:api');
    }
   function users(){

    $vehicle = Vehicle::join('makes','vehicles.make','=','makes.id')
        ->join('car_models','vehicles.model', '=', 'car_models.id')
        ->join('countrys', 'vehicles.country', '=', 'countrys.id')
        ->join('citys', 'vehicles.city', '=', 'citys.id')
        ->join('ports', 'vehicles.port', '=', 'ports.id')
        ->join('customers', 'vehicles.customer_id', '=', 'customers.id')
        ->join('drivers', 'vehicles.driver_id', '=', 'drivers.id')
        ->select('vehicles.*','countrys.country','citys.city','car_models.model','makes.company','ports.port','customers.name AS customer_name','drivers.name AS driver_name')->get();

        $customers = Customer::all();
        $drivers = Driver::all();
        $data["vehicle"] = $vehicle;
        $data["customers"] = $customers;
        $data["drivers"] = $drivers;
        return response()->json([
            'status' => 200,
            'success' => true,
            'data' =>  $data,
            'message'=> 'Vehicle , Customers and Drivers are returned'
        ]);
}

   function vehicleImages(Request $request){


   $vehicle = VehicleImages::query();
    if(!empty($request->vehicle_id)){
    $vehicle = VehicleImages::where('vehicle_id',$request->vehicle_id);
        }
    if(!empty($request->customer_id)){
    $vehicle = $vehicle->where('customer_id',$request->customer_id);
    }   

    if(!empty($request->driver_id)){
        $vehicle = $vehicle->where('driver_id',$request->driver_id);
    }    

    if(!empty($request->image_type)){
         $vehicle = $vehicle->where('image_type',$request->image_type);
    }   
    $vehicle =  $vehicle->get();  
        
        if(!$vehicle->isEmpty()){
            return response()->json([
            'status' => 200,
            'success' => true,
            'data' =>  $vehicle,
            'message'=> 'Vehicle iamges'
            ]);
    }    else{
       return response()->json([
        'status' => 404,
        'success' => false,
        'data' => '' ,
        'message'=> 'No Vehicle is present'
    ])  ;
    }
}
  function telleysheet(Request $request){
    $vehicle = Vehicle::select('tally_sheet');
    if(!empty($request->vehicle_id)){
    $vehicle = VehicleImages::where('vehicle_id',$request->vehicle_id);
        }
    if(!empty($request->customer_id)){
    $vehicle = $vehicle->where('customer_id',$request->customer_id);
    }   

    if(!empty($request->driver_id)){
        $vehicle = $vehicle->where('driver_id',$request->driver_id);
    }      
    $vehicle =  $vehicle->get();  
    

    $tally_sheet = [];
    foreach($vehicle as $singlevehicle){
        if(!empty($singlevehicle->tally_sheet)){
            $tally_sheet[] = explode(",",$singlevehicle->tally_sheet);
        }
    } 
       
    if(!empty($tally_sheet)){
            return response()->json([
            'status' => 200,
            'success' => true,
            'data' =>  $tally_sheet,
            'message'=> 'Vehicle iamges'
            ]);
    }    else{
       return response()->json([
        'status' => 404,
        'success' => false,
        'data' => '' ,
        'message'=> 'No Vehicle is present'
    ])  ;
    }



  }


}

?>