<?php namespace App\Http\Controllers\Api;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Http\Transformers\CustomListTranformer;
use App\Models\CustomList;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class CustomListController extends ApiController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
        $fridges = CustomList::all();
        return $this->response->withCollection($fridges, new CustomListTranformer);
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
            $customList = new CustomList();
            $customList->name = $request->get('name');
            $customList->user()->associate(Auth::user());
            $customList->save();

            $response = $this->response->withItem($customList, new CustomListTranformer);
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
        $customList = CustomList::find($id);

        if($customList)
        {
            $response = $this->response->withItem($customList, new CustomListTranformer);
        }else
        {
            $response = $this->response->errorNotFound('Liste personnalisée non trouvée');
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
        $customList = CustomList::find($id);
        if( ! $customList )
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
            $customList->name = $request->get('name');
            $customList->save();

            $response = $this->response->withItem($customList, new CustomListTranformer);
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

        $customList = CustomList::find($id);

        $response = '';

        if( ! $customList)
        {
            $response = $this->response->errorNotFound('Liste personnalisée non trouvée');
        }else
        {
            $customList->delete();
        }

        return $response;
	}

}
