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
        $customLists = CustomList::all();

        $customLists->each(function($customList){
            $customList->foods;
        });
        return response()->json($customLists);
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

        $customList = new CustomList();
        $customList->name = $request->get('name');
        $customList->user()->associate(Auth::user());
        $customList->save();

        return response()->json($customList);
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
    {
        $customList = CustomList::findOrFail($id);

        return response()->json($customList);
    }

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update(Request $request, $id)
	{
        $customList = CustomList::findOrFail($id);


        $rules = [
            'name'      => 'required',
        ];

        $this->validate($request, $rules);

        $customList->name = $request->get('name');
        $customList->save();

        return response()->json($customList);
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{

        $customList = CustomList::findOrFail($id);

        $customList->delete();

        return response()->json($customList);
	}

}
