<?php namespace App\Http\Controllers\Api;

use App\Http\Requests\FridgeRequest;

use App\Http\Transformers\FridgeTransformer;
use App\Models\Fridge;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class FridgeController extends ApiController {

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $fridges = Fridge::all();

        $fridges->each(function($fridge){
            $fridge->foods;
        });
        return response()->json($fridges);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request)
    {
        $rules = [
            'name'      => 'required',
        ];

        $response = '';


        $this->validate($request, $rules);

        $fridge = new Fridge();
        $fridge->name = $request->get('name');
        $fridge->user()->associate(Auth::user());
        $fridge->save();

        return response()->json($fridge);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        $fridge = Fridge::findOrFail($id);

        return response()->json($fridge);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {

        $fridge = Fridge::findOrFail($id);

        $rules = [
            'name'      => 'required',
        ];

        $this->validate($request, $rules);

        $fridge->name = $request->get('name');
        $fridge->save();

        return response()->json($fridge);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        $fridge = Fridge::findOrFail($id);

        $fridge->delete();

        return $fridge;
    }


    public function getFoods(Request $request, $id)
    {
        $fridge = Fridge::findOrFail($id);

        $foods = $fridge->foods;

        return $foods;
    }
}
