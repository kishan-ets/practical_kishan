<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\City;
use App\Http\Requests\CitiesRequest;
use App\Http\Resources\CitiesCollection;
use App\Http\Resources\CitiesResource;

class CitiesAPIController extends Controller
{
    //
    public function index(Request $request){
        $query = User::commonFunctionMethod(City::class,$request);
        return new CitiesCollection(CitiesResource::collection($query),CitiesResource::class);
    }

    public function store(CitiesRequest $request){
        return new CitiesResource(City::create($request->all()));
    }

    public function update(CitiesRequest $request, City $city)
    {
        $city->update($request->all());

        return new CitiesResource($city);
    }

    public function show(City $city)
    {
        return new CitiesResource($city->load([]));
    }

    public function destroy(Request $request, City $city)
    {
        $city->delete();

        return new CitiesResource($city);
    }

    public function deleteAll(Request $request)
    {
        return City::deleteAll($request);
    }
}
