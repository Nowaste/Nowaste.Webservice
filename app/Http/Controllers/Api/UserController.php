<?php namespace App\Http\Controllers\Api;

use App\Http\Requests\UserRequest;

use App\User;
use Chrisbjr\ApiGuard\Http\Controllers\ApiGuardController;
use App\Http\Transformers\UserTransformer;
use App\Http\Controllers\Api\ApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UserController extends ApiController {


    /**
     * @return mixed
     */
    public function index()
    {
        $users = User::all();
        return $this->response->withCollection($users, new UserTransformer);
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
            'email'     => 'required|email|unique:users',
            'password'  => 'required',
        ];

        $response = '';

        $validation = Validator::make($request->all(), $rules);

        if($validation->fails())
        {
            $response = $this->response->errorInternalError($validation->errors());
        }

        try{
            $user = User::create($request->all());
        }catch (\Exception $e){
            $response = $this->response->errorInternalError($e->getMessage());
        }

        $response = $this->response->withItem($user, new UserTransformer);
        return $response;

	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show(Request $request, $id)
	{
        $response = '';
        $user = User::find($id);

        if($user)
        {
            $response = $this->response->withItem($user, new UserTransformer);
        }else
        {
            $response = $this->response->errorNotFound('Utilisateur non trouvé');
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
        $user = User::find($id);
        if( ! $user )
        {
            return $this->response->errorNotFound('Utilisateur non trouvé');
        }

        $rules = [
            'name'      => 'required',
//            'email'     => 'required|email|unique:users',
            'password'  => 'required',
        ];

        $response = '';

        $validation = Validator::make($request->all(), $rules);

        if($validation->fails())
        {
            $response = $this->response->errorInternalError($validation->errors());
        }


        try{
            $user->name = $request->get('name');
            $user->password = $request->get('password');

            $user->save();
            $response = $this->response->withItem($user, new UserTransformer);

        }catch (\Exception $e){
            $response = $this->response->errorInternalError($e->getMessage());
        }

        return $response;
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy(Request $request, $id)
	{
        $user = User::find($id);

        $response = '';

        if( ! $user)
        {
            $response = $this->response->errorNotFound('Utilisateur non trouvé');
        }else
        {
            $user->delete();
        }

        return $response;
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
