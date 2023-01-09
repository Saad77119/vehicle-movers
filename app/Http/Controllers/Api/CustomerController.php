<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\Vehicle;
use App\Models\VehicleImages;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    
 public function __construct()
    {
        // $this->middleware('auth');
    }
   public function deliveries(Request $request)
    {
        $data = Vehicle::join('makes','vehicles.make','=','makes.id')
        ->join('car_models','vehicles.model', '=', 'car_models.id')
        ->join('countrys', 'vehicles.country', '=', 'countrys.id')
        ->join('citys', 'vehicles.city', '=', 'citys.id')
        ->join('ports', 'vehicles.port', '=', 'ports.id')
        ->join('customers', 'vehicles.customer_id', '=', 'customers.id')
        ->join('drivers', 'vehicles.driver_id', '=', 'drivers.id')
        ->select('vehicles.*','countrys.country','citys.city','car_models.model','drivers.contact_no as driver_no','drivers.image as driver_img','makes.company','ports.port','customers.name AS customer_name','drivers.name AS driver_name')
        ->where('customers.id', $request->id)
        ->get();
        return $data;
    }
    public function delverydetails(Request $request)
    {
        $data = Vehicle::join('makes','vehicles.make','=','makes.id')
        ->join('car_models','vehicles.model', '=', 'car_models.id')
        ->join('countrys', 'vehicles.country', '=', 'countrys.id')
        ->join('citys', 'vehicles.city', '=', 'citys.id')
        ->join('ports', 'vehicles.port', '=', 'ports.id')
        ->join('customers', 'vehicles.customer_id', '=', 'customers.id')
        ->join('drivers', 'vehicles.driver_id', '=', 'drivers.id')
        ->select('vehicles.*','countrys.country','citys.city','car_models.model','drivers.contact_no as driver_no','drivers.image as driver_img','makes.company','ports.port','customers.name AS customer_name','drivers.name AS driver_name')
        ->where('vehicles.id', $request->id)
        ->get();
        return $data;
    }
    public function delvery_on_driverid(Request $request)
    {
        $data = Vehicle::join('makes','vehicles.make','=','makes.id')
        ->join('car_models','vehicles.model', '=', 'car_models.id')
        ->join('countrys', 'vehicles.country', '=', 'countrys.id')
        ->join('citys', 'vehicles.city', '=', 'citys.id')
        ->join('ports', 'vehicles.port', '=', 'ports.id')
        ->join('customers', 'vehicles.customer_id', '=', 'customers.id')
        ->join('drivers', 'vehicles.driver_id', '=', 'drivers.id')
        ->select('vehicles.*','countrys.country','citys.city','car_models.model','makes.company','ports.port','customers.name AS customer_name')
        ->where('vehicles.driver_id', $request->id)
        ->get();
        return $data;
    }   
}

?>
