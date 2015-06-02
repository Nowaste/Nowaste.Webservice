<?php namespace App\Http\Controllers\Api;

use App\Http\Requests\FridgeRequest;

use App\Models\Fridge;
use Illuminate\Http\Request;

class FridgeController extends ApiController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
        $fridges = Fridge::all();
//        return $this->responseArrayJson($fridges);
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(FridgeRequest $request)
	{
        $fridge = null;
        $message = '';
        $statusCode = 200;

        try{
            $fridge = Fridge::create($request->all());
        }catch (\Exception $e){
            $statusCode = 500;
            $message = 'Une erreur est survenue';
        }

//        return $this->responseItemJson($fridge, $message, $statusCode);
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}
