<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\State;
use App\Http\Requests\StatesRequest;
use App\Http\Resources\StatesCollection;
use App\Http\Resources\StatesResource;

class StatesAPIController extends Controller
{
    //
    public function index(Request $request){
        $query = User::commonFunctionMethod(State::class,$request);
        return new StatesCollection(StatesResource::collection($query),StatesResource::class);
    }

    public function store(StatesRequest $request)
    {
        return new StatesResource(State::create($request->all()));
    }

    public function show(State $state)
    {
        return new StatesResource($state->load([]));
    }

    public function update(StatesRequest $request, State $state)
    {
        $state->update($request->all());

        return new StatesResource($state);
    }

    public function destroy(Request $request, State $state)
    {
        $state->delete();

        return new StatesResource($state);
    }

    public function deleteAll(Request $request)
    {
        return State::deleteAll($request);
    }

}
