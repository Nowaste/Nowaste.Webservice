<?php namespace App\Http\Controllers\Api;

use App\Http\Requests\UserRequest;
use App\Http\Controllers\Controller;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index(Request $request)
	{
        $users = User::all();
        return $this->responseArrayJson($users);
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(UserRequest $request)
	{
        $user = null;
        $message = '';
        $statusCode = 200;

        try{
            $user = User::create($request->all());
        }catch (\Exception $e){
            $statusCode = 500;
            $message = 'Une erreur est survenue';
        }

        return $this->responseItemJson($user, $message, $statusCode);
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show(Request $request, $id)
	{
        $returnModel = $this->findModel('User', $id);
        return $this->responseItemJsonWithArray($returnModel);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update(UserRequest $request, $id)
	{
        $user = User::findOrFail($id);
        $message = '';
        $statusCode = 200;

        try{
            $user->update($request->all());
        }catch (\Exception $e){
            $statusCode = 500;
            $message = 'Une erreur est survenue';
        }

        return $this->responseItemJson($user, $message, $statusCode);
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy(Request $request, $id)
	{
        $message = 'L\utilisateur a bien été supprimé';
        $statusCode = 200;
        try
        {
            User::findOrFail($id)->delete();
        }catch(\Exception $e)
        {
            $message = 'L\utilisateur n\'a pas pu être supprimé';
            $statusCode = 500;
        }

        return $this->responseItemJson(null, $message, $statusCode);

	}

    /**
     * @param Request $request
     */
    public function login(Request $request)
    {

    }

    /**
     * @param Request $request
     */
    public function logout(Request $request)
    {

    }
}
