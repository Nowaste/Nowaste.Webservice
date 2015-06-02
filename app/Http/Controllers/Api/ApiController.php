<?php
/**
 * Created by PhpStorm.
 * User: quentin
 * Date: 02/06/15
 * Time: 16:20
 */

namespace App\Http\Controllers\Api;


use EllipseSynergie\ApiResponse\Laravel\Response;
use Illuminate\Foundation\Bus\DispatchesCommands;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller;

class ApiController extends Controller
{

    use DispatchesCommands, ValidatesRequests;

    protected $response;

    public function __construct(Response $response)
    {
        $this->response = $response;
    }

} 