<?php namespace App\Http\Controllers\Api;

use App\Http\Requests;

use App\Models\Food;
use App\Http\Transformers\FoodTransformer;
use App\Models\FoodFridge;
use App\Models\Fridge;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class FoodController extends ApiController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
        $foods = Food::all();
        return $this->response->withCollection($foods, new FoodTransformer);
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

        $method = null;

        if($request->has('fridge_id'))
        {
            /**
             * Rules for fridges
             */
            $rules['out_of_date'] = 'required';
            $rules['quantity'] = 'required|integer';
            $rules['visible'] = 'required|boolean';
            $rules['open'] = 'required|boolean';

            $method = '_processFridge';

        }else if($request->has('custom_list_id'))
        {
            /**
             * Rules for custom lists
             */
            $method = '_processCustomList';

        }else
        {
            return $this->response->errorWrongArgs();
        }

        $response = '';


        $validation = Validator::make($request->all(), $rules);

        if($validation->fails())
        {
            $response = $this->response->errorInternalError($validation->errors());
        }else{
            if($method)
            {
                $food = $this->$method($request);
                $response = $this->response->withItem($food, new FoodTransformer);

            }
        }
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
        $food = Food::find($id);

        if($food)
        {
            $response = $this->response->withItem($food, new FoodTransformer);
        }else
        {
            $response = $this->response->errorNotFound('Aliment non trouvé');
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
        $food = Food::find($id);
        if( ! $food )
        {
            return $this->response->errorNotFound('Aliment non trouvé');
        }

        $rules = [
            'name'      => 'required',
        ];

        $method = null;

        if($request->has('fridge_id'))
        {
            /**
             * Rules for fridges
             */
            $rules['out_of_date'] = 'required';
            $rules['quantity'] = 'required|integer';
            $rules['visible'] = 'required|boolean';
            $rules['open'] = 'required|boolean';

            $method = '_processFridge';

        }else if($request->has('custom_list_id'))
        {
            /**
             * Rules for custom lists
             */
            $method = '_processCustomList';

        }else
        {
            return $this->response->errorWrongArgs();
        }

        $response = '';

        $validation = Validator::make($request->all(), $rules);

        if($validation->fails())
        {
            $response = $this->response->errorInternalError($validation->errors());
        }else{
            if($method)
            {
                $food = $this->$method($request, $id);
                $response = $this->response->withItem($food, new FoodTransformer);
            }
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
        $food = Food::find($id);

        $response = '';

        if( ! $food)
        {
            $response = $this->response->errorNotFound('Aliment non trouvé');
        }else
        {
            $food->delete();
        }

        return $response;
	}

    private function _processFridge($request, $id = null)
    {

        /**
         * Get fridge
         */
        $fridge = Fridge::findOrFail($request->get('fridge_id'));

        /**
         * Set food
         */
        if($id)
        {
            $food = Food::findOrFail($id);
            $foodFridge = $food->foodFridge;
        }else{
            $food = new Food();
            $foodFridge = new FoodFridge();
        }

        $food->name = $request->get('name');
        $food->fridge()->associate($fridge);
        $food->save();

        /**
         * Set info food
         */
        $foodFridge->out_of_date = $request->get('out_of_date');
        $foodFridge->quantity = $request->get('quantity');
        $foodFridge->visible = $request->get('visible');
        $foodFridge->open = $request->get('open');

        $foodFridge->save();


        $food->food_fridge_id = $foodFridge->id;
        $food->user()->associate(Auth::user());
        $food->save();

        return $food;
    }

    private function _processCustomList($request, $id = null)
    {

    }

}
