<?php
/**
 * Created by PhpStorm.
 * User: quentin
 * Date: 02/06/15
 * Time: 16:20
 */

namespace App\Http\Controllers\Api;


use App\Models\Configuration;
use EllipseSynergie\ApiResponse\Laravel\Response;
use Illuminate\Foundation\Bus\DispatchesCommands;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Str;

class ApiController extends Controller
{

    use DispatchesCommands, ValidatesRequests;

    protected $response;

    public function __construct(Response $response)
    {
        $this->response = $response;
    }

    public function sync(Request $request)
    {
        $this->validate($request, [
            'userId'   => 'required',
            'lastSync' => 'required',
        ]);

        $user_id = $request->input('userId');
        $last_sync = $request->input('lastSync');

        $classes = [
            '\App\Models\Configuration',
            '\App\Models\Fridge',
            '\App\Models\CustomList',
            '\App\Models\Food',
            '\App\User',
        ];

        $return = [];


        foreach($classes as $class)
        {
            if(!class_exists($class))
                continue;

            $model = app($class);

            $return[$model::getTableName()] = $model::where('updated_at', '>', $last_sync)->get()->toArray();
        }

        return response()->json($return);

    }

} 