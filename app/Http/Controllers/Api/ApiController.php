<?php
/**
 * Created by PhpStorm.
 * User: quentin
 * Date: 02/06/15
 * Time: 16:20
 */

namespace App\Http\Controllers\Api;


use Chrisbjr\ApiGuard\Http\Controllers\ApiGuardController;
use Illuminate\Foundation\Bus\DispatchesCommands;
use Illuminate\Foundation\Validation\ValidatesRequests;

class ApiController extends ApiGuardController
{

    use DispatchesCommands, ValidatesRequests;


} 