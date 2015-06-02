<?php namespace App\Http\Controllers\Api;

use App\Http\Requests\FridgeRequest;

use App\Http\Transformers\FridgeTransformer;
use App\Models\Fridge;
use Illuminate\Http\Request;
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
        return $this->response->withCollection($fridges, new FridgeTransformer);
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

        $validation = Validator::make($request->all(), $rules);

        if($validation->fails())
        {
            $response = $this->response->errorInternalError($validation->errors());
        }else{
            $fridge = new Fridge();
            $fridge->name = $request->get('name');
            $fridge->save();

            $response = $this->response->withItem($fridge, new FridgeTransformer);
        }

        return $response;
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
        $response = '';
        $fridge = Fridge::find($id);

        if($fridge)
        {
            $response = $this->response->withItem($fridge, new FridgeTransformer);
        }else
        {
            $response = $this->response->errorNotFound('Frigo non trouvé');
        }

        return $response;
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update(Request $request, $id)
	{
        $fridge = Fridge::find($id);
        if( ! $fridge )
        {
            return $this->response->errorNotFound('Frigo non trouvé');
        }

        $rules = [
            'name'      => 'required',
        ];

        $response = '';

        $validation = Validator::make($request->all(), $rules);

        if($validation->fails())
        {
            $response = $this->response->errorInternalError($validation->errors());
        }else{
            $fridge->name = $request->get('name');
            $fridge->save();

            $response = $this->response->withItem($fridge, new FridgeTransformer);
        }

        return $response;
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
        $fridge = Fridge::find($id);

        $response = '';

        if( ! $fridge)
        {
            $response = $this->response->errorNotFound('Frigo non trouvé');
        }else
        {
            $fridge->delete();
        }

        return $response;
	}

}
