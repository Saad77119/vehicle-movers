<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Country;
use Illuminate\Http\Request;
use DataTables;
use Illuminate\Validation\ValidationException;

class CityController extends Controller
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
        if ($request->ajax()) {
            $data = City::join('countrys', 'citys.country_id', '=', 'countrys.id')
                ->select('citys.id', 'citys.city', 'country_id', 'countrys.country');
            return Datatables::of($data)->make(true);
        }
        $country = Country::all();
        return view('admin.city.index', compact('country'));
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
        try {
            $this->validate($request, [
                'city' => 'required',
                'country_id' => 'required'
            ]);
            $data = $request->all();
            City::create($data);
            return ['code' => '200', 'message' => 'success'];
        } catch (\Exception | ValidateException $e) {
            if ($e instanceof ValidateException) {
                return ['code' => '400', 'error' => $e->errors()];
            } else {
                return ['code' => '400', 'error_message' => $e->getMessage()];
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\City  $city
     * @return \Illuminate\Http\Response
     */
    public function show(City $city)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\City  $city
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = City::find($id);
        return response()->json($data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\City  $city
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            $this->validate($request, [
                'city' => 'required',
                'country_id' => 'required'
            ]);
            $data = $request->all();
            $city = City::find($id);
            $city->fill($data)->save();
            return ['code' => '200', 'message' => 'success'];
        } catch (\Exception | ValidationException $e) {
            if ($e instanceof ValidationException) {
                return ['code' => '400', 'errors' => $e->errors()];
            } else {
                return ['code' => '400', 'error_message' => $e->getMessage()];
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\City  $city
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $city = City::find($id);
            $city->delete();
            return ['code' => '200', 'message' => 'success'];
        } catch (\Exception $e) {
            return ['code' => '400', 'error_message' => $e->getMessage()];
        }
    }
}
