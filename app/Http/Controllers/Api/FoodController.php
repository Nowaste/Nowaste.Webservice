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
            $rules['food_fridge.out_of_date'] = 'required';
            $rules['food_fridge.quantity'] = 'required|integer';
            $rules['food_fridge.visible'] = 'required|boolean';
            $rules['food_fridge.open'] = 'required|boolean';

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

        $this->validate($request, $rules);
        $response = '';

        if($method)
        {
            $food = $this->$method($request);
            $response = response()->json($food);

        }
//        }
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
        $food = Food::findOrFail($id);

        $rules = [
            'name'      => 'required',
        ];

        $method = null;

        if($request->has('fridge_id'))
        {
            /**
             * Rules for fridges
             */
            $rules['food_fridge.out_of_date'] = 'required';
            $rules['food_fridge.quantity'] = 'required|integer';
            $rules['food_fridge.visible'] = 'required|boolean';
            $rules['food_fridge.open'] = 'required|boolean';

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

        $this->validate($request, $rules);
        $response = '';


        if($method)
        {
            $food = $this->$method($request, $id);
            $response = response()->json($food);
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
        $ff = $request->get('food_fridge');

        $foodFridge->out_of_date = $ff['out_of_date'];
        $foodFridge->quantity = $ff['quantity'];
        $foodFridge->visible =$ff['visible'];
        $foodFridge->open = $ff['open'];

        $foodFridge->save();


        $food->food_fridge_id = $foodFridge->id;
        $food->user()->associate(Auth::user());
        $food->save();

        return $food;
    }

    private function _processCustomList($request, $id = null)
    {
        /**
         * Get custom list
         */
        $customList = Fridge::findOrFail($request->get('custom_list_id'));

        /**
         * Set food
         */
        if($id)
        {
            $food = Food::findOrFail($id);
        }else{
            $food = new Food();
        }

        $food->name = $request->get('name');
        $food->customList()->associate($customList);
        $food->save();


        return $food;
    }

}
