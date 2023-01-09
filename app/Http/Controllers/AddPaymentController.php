<?php

namespace App\Http\Controllers;

use App\Models\AddPayment;
use App\Models\Vehicle;
use App\Models\Customer;
use App\Models\ChargesType;
use Illuminate\Http\Request;
use DataTables;
use DB;
use Illuminate\Validation\ValidationException;

class AddPaymentController extends Controller
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
        // if($request->ajax()){
        //     return Datatables::eloquent(AddPayment::query())->make(true);
        // }
        $vehicles = Vehicle::join('makes','vehicles.make','=','makes.id')
        ->join('car_models','vehicles.make', '=', 'car_models.id')
        ->select('vehicles.*','makes.name','car_models.model')->get();
        $customers = Customer::all();
        $charges_type = ChargesType::all();
        return view('admin.add_payment.index', get_defined_vars());
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
                'vehicle' => 'required',
                'customer' => 'required'
            ]);

            $data = new AddPayment;
            $data->vehicle_id = $request->vehicle;
            $data->customer_id = $request->customer;
            $data->save();

            foreach ($request->charges as $charge){
                DB::table('payment_details')->insert([
                    'add_payments_id' => $data->id,
                    'charges_type' => $charge['charges_type'],
                    'amount' => $charge['amount'],
                    'remarks' => $charge['remarks'],
                ]);
            }

            return ['code' => '200', 'message' => 'success'];
        }
        catch(\Exception | ValidateException $e){
            if($e instanceof ValidateException){
                dd($e->errors());
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
     * @param  \App\Models\AddPayment  $addPayment
     * @return \Illuminate\Http\Response
     */
    public function show(AddPayment $addPayment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\AddPayment  $addPayment
     * @return \Illuminate\Http\Response
     */
    public function edit(AddPayment $addPayment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\AddPayment  $addPayment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, AddPayment $addPayment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\AddPayment  $addPayment
     * @return \Illuminate\Http\Response
     */
    public function destroy(AddPayment $addPayment)
    {
        //
    }
}
