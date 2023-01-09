<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\Vehicle;
use App\Models\VehicleImages;
use App\Models\VehicleLocation;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class DriverController extends Controller
{
	 public function __construct()
    {
        // $this->middleware('auth');
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
            ->select('vehicles.*','countrys.country','citys.city','car_models.model','makes.company','ports.port','customers.name AS customer_name')
            ->where('vehicles.driver_id', $request->driver_id)
            ->where('vehicles.id', $request->id)
            ->get();
            return $data;
    }

    public function upload_tellysheet(Request $request)
    {
        $id = $request->id;
        $vehicle = Vehicle::find($id);
        $images = $request->file('images');
        if($vehicle != null && $vehicle->count() > 0){
            foreach($images as $key => $image){
                $fileOrignalName = $image->getClientOriginalName();
                $image_path = '/tellysheets';
                $path = public_path() . $image_path;
                $filename = time().'_'.rand(000 ,999).'.'.$image->getClientOriginalExtension();
                $image->move($path, $filename);
                $paths[] = $image_path.'/'.$filename;
             }
             $data['images']= implode(',',$paths);
             $vehicle->fill($data)->save();
             return response()->json([
                'status' => 200,
                'success' => true,
                'data' =>  $vehicle,
                'message'=> 'Telly Sheet Uploaded '
            ]);
        }
        else{
            return response()->json([
                'status' =>404 ,
                'success' => true,
                'data' =>  '',
                'message'=> 'Vehicle is not found '
            ]);
        }
    }
    public function confirm_pickup(Request $request)
    {

         $vehicle_id = $request->vehicle_id;
        $vehicle = VehicleImages::where('vehicle_id','=', $vehicle_id , '&&' , 'image_type' , '=' , 'pickups' )->get();
        if($vehicle != null && $vehicle->count() > 0){
             return response()->json([
                'status' => 200,
                'success' => false,
                'data' =>  '',
                'message'=> 'Vehicle is Picked'
            ]);
        }else{
            return response()->json([
                'status' => 400,
                'success' => false,
                'data' =>  '',
                'message'=> 'Vehicle is not present'
            ]);
        }

    }
    public function confirm_dropof(Request $request)
    {
        $vehicle_id = $request->vehicle_id;
        $vehicle = VehicleImages::where('vehicle_id','=', $vehicle_id , '&&' , 'image_type' , '=' ,'dropof' )->get();
        if($vehicle != null && $vehicle->count() > 0){
             return response()->json([
                'status' => 200,
                'success' => false,
                'data' =>  '',
                'message'=> 'Vehicle is Dropof'
            ]);
        }else{
            return response()->json([
                'status' => 400,
                'success' => false,
                'data' =>  '',
                'message'=> 'Vehicle is not present'
            ]);
        }

    }

       public function update_images(Request $request)
    {
        if((!empty($request->car_front) || !empty($request->car_back) || !empty($request->car_top) || !empty($request->car_left) || !empty($request->car_right)) && !empty($request->vehicle_id) && !empty($request->driver_id) && !empty($request->image_type) && !empty($request->customer_id)){
                
                if(!empty($request->file('front_images'))){
                     foreach($request->file('front_images') as $key => $image){
                        $fileOrignalName = $image->getClientOriginalName();
                        $image_path = '/Vehicle-Images';
                        $path = public_path() . $image_path;
                        $filename = time().'_'.rand(000 ,999).'.'.$image->getClientOriginalExtension();
                        $image->move($path, $filename);
                        $paths[] = $image_path.'/'.$filename;
                 }
                 $data['car_front']= implode(',',$paths);
                }
                if(!empty($request->file('car_back'))){
                     foreach($request->file('car_back') as $key => $image){
                        $fileOrignalName = $image->getClientOriginalName();
                        $image_path = '/Vehicle-Images';
                        $path = public_path() . $image_path;
                        $filename = time().'_'.rand(000 ,999).'.'.$image->getClientOriginalExtension();
                        $image->move($path, $filename);
                        $paths[] = $image_path.'/'.$filename;
                 }
                 $data['car_back']= implode(',',$paths);
                }

                if(!empty($request->file('car_top'))){
                     foreach($request->file('car_top') as $key => $image){
                        $fileOrignalName = $image->getClientOriginalName();
                        $image_path = '/Vehicle-Images';
                        $path = public_path() . $image_path;
                        $filename = time().'_'.rand(000 ,999).'.'.$image->getClientOriginalExtension();
                        $image->move($path, $filename);
                        $paths[] = $image_path.'/'.$filename;
                 }
                 $data['car_top']= implode(',',$paths);
                }

                if(!empty($request->file('car_left'))){
                     foreach($request->file('car_left') as $key => $image){
                        $fileOrignalName = $image->getClientOriginalName();
                        $image_path = '/Vehicle-Images';
                        $path = public_path() . $image_path;
                        $filename = time().'_'.rand(000 ,999).'.'.$image->getClientOriginalExtension();
                        $image->move($path, $filename);
                        $paths[] = $image_path.'/'.$filename;
                 }
                 $data['car_left']= implode(',',$paths);
                }

                if(!empty($request->file('car_right'))){
                     foreach($request->file('car_right') as $key => $image){
                        $fileOrignalName = $image->getClientOriginalName();
                        $image_path = '/Vehicle-Images';
                        $path = public_path() . $image_path;
                        $filename = time().'_'.rand(000 ,999).'.'.$image->getClientOriginalExtension();
                        $image->move($path, $filename);
                        $paths[] = $image_path.'/'.$filename;
                 }
                 $data['car_right']= implode(',',$paths);
                }
                if(!empty( $request->description)){
                    $data['description'] =  $request->description;
                }
                $data['vehicle_id'] =  $request->vehicle_id;
                $data['customer_id'] =  $request->customer_id;
                $data['driver_id'] =  $request->driver_id;
                $data['image_type'] =  $request->image_type ;
                VehicleImages::create($data);
                return response()->json([
                    'status' => 200,
                    'success' => true,
                    'data' =>  '',
                    'message'=> 'Images are Updated'
               ]);

        }
        else {
            return response()->json([
                'status' => 500,
                'success' => false,
                'data' =>  '',
                'message'=> 'Please fill complete data'
            ]);
        }

    }
     public function location_tracking(Request $request)
     {
        if( !empty($request->driver_id) && !empty($request->vehicle_id)  && !empty($request->customer_id) && !empty($request->current_location)){
                $data = $request->all();
                 VehicleLocation::create($data);
                 return response()->json([
                'status' => 200,
                'success' => true,
                'data' =>  "",
                'message'=> 'location is tracked'
            ]);
        }
        else
        {
            return response()->json([
            'status' => 500,
            'success' => false,
            'data' =>  "",
            'message'=> 'missing parameters'
        ]);
        }

     }



}

	?>