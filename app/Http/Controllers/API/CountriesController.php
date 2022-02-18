<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Country;
use App\Http\Requests\CountriesRequest;
use App\Http\Resources\CountriesCollection;
use App\Http\Resources\CountriesResource;

class CountriesController extends Controller
{
    //
    public function index(Request $request){
        $query = User::commonFunctionMethod(Country::class,$request);
        return new CountriesCollection(CountriesResource::collection($query),CountriesResource::class);
    }

    public function store(CountriesRequest $request)
    {
        return new CountriesResource(Country::create($request->all()));
    }

    public function update(CountriesRequest $request, Country $country)
    {
        $country->update($request->all());

        return new CountriesResource($country);
    }

    public function show(Country $country)
    {
        return new CountriesResource($country->load([]));
    }

    public function destroy(Request $request, Country $country)
    {
        $country->delete();

        return new CountriesResource($country);
    }

    public function deleteAll(Request $request)
    {
        return Country::deleteAll($request);
    }
}
