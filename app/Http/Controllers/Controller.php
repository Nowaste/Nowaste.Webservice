<?php namespace App\Http\Controllers;

use App\Models\Model;
use Illuminate\Foundation\Bus\DispatchesCommands;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Support\Collection;
use Symfony\Component\Routing\Exception\InvalidParameterException;

abstract class Controller extends BaseController {

	use DispatchesCommands, ValidatesRequests;

    private $_modelsNamespace = 'App\\Models\\';

    protected function responseArrayJson(Collection $data, $message = '', $statusCode = 200)
    {
        return response()->json(['items' => $data, 'count' => count($data), 'message' => $message], $statusCode);
    }


    protected function responseItemJson($model, $message = '', $statusCode = 200)
    {
        return response()->json($this->_modelJsonFormat($model, $message, $statusCode), $statusCode);
    }

    protected function responseItemJsonWithArray($array)
    {
        $this->_handleItemArrayFormat($array);

        return response()->json($array, $array['statusCode']);
    }

    protected function findModel($class, $id)
    {
        $model = null;
        $message = '';
        $statusCode = 200;
        $className = $this->_modelsNamespace.$class;
        if(class_exists($className))
        {
            $model = $className::find($id);
            if( ! $model )
            {
                $message = 'Entité non trouvée';
                $statusCode = 404;
            }else
            {
                $message = 'Entité trouvée';
            }
        }else
        {
            $statusCode = 500;
            $message = 'Classe non trouvée';
        }

        return $this->_modelJsonFormat($model, $message, $statusCode);
    }

    private function _handleItemArrayFormat($array)
    {
        if(! (is_array($array) && array_key_exists('item',$array) && array_key_exists('message', $array)
            && array_key_exists('statusCode', $array)))
        {
            throw new InvalidParameterException;
        }
    }

    private function _modelJsonFormat($model, $message, $statusCode)
    {
        return ['item' => $model, 'message' => $message, 'statusCode' => $statusCode];
    }
}
