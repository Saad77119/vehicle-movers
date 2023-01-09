<?php

namespace App\Http\Controllers;

use DataTables;
use App\Models\Customer;
use App\Models\Vehicle;
use App\Models\CarModel;
use App\Models\Make;
use App\Models\City;
use App\Models\Country;
use App\Models\Port;
use App\Models\Driver;
use App\Models\CustomerType;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware(['auth','permission:customers']);
    }
    public function index(Request $request)
    {
        if($request->ajax()){
            return Datatables::eloquent(Customer::query())->make(true);
        }
        $customer_types = CustomerType::get();
        return view('admin.customer.index', compact('customer_types'));
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
                $attach_file_path = $attach_file->move('Profile_Pic',$attach_file_name);
                $data['image'] = $attach_file_path;
            }
                Customer::create($data);
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
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function show(Customer $customer)
    {
        $customers = Customer::leftjoin('customer_types', 'customers.customer_type_id', '=', 'customer_types.id')
        ->select('customers.*','customer_types.type')
        ->where('customers.id', '=', $customer->id)->first();        
        $customer_vehicles = Customer::leftJoin('vehicles', 'vehicles.customer_id' ,'=', 'customers.id')
        ->leftjoin('makes', 'vehicles.make', '=', 'makes.id')
        ->leftjoin('car_models', 'vehicles.model', '=', 'car_models.id')
        ->leftjoin('drivers', 'vehicles.driver_id', '=', 'drivers.id')
        ->leftjoin('ports', 'vehicles.port', '=', 'ports.id')
        ->leftjoin('countrys', 'vehicles.country', '=', 'countrys.id')
        ->leftjoin('citys', 'vehicles.city', '=', 'citys.id')
        ->select('vehicles.*','makes.name','car_models.model','drivers.name','ports.port','countrys.country','citys.city')
        ->where('vehicles.customer_id', '=', $customer->id)
        ->get();
        return view('admin.profile_view_customer.index', compact('customers','customer_vehicles'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $customer = Customer::find($id);
        return response()->json($customer);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Customer  $customer
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
            $customer = Customer::find($id);
            if($request->hasfile('image')){
                unlink($customer->image);
                $attach_file = $request->file('image');
                $attach_file_name = rand().'.'. $attach_file->getClientOriginalExtension();
                $attach_file_path = $attach_file->move('Profile_Pic',$attach_file_name);
                $data['image'] = $attach_file_path;
            }
                $customer->fill($data)->save();
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
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try{
            $data = Customer::find($id);
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
        $customer = Customer::find($id);
        $customer->status = $request->status;
        $customer->save();
        return view('admin.customer.index');
    }
}
