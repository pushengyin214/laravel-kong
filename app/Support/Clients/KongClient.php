<?php
/**
 * Created by PhpStorm.
 * User: mac
 * Date: 2018/6/29
 * Time: 下午2:08
 */

namespace App\Support\Clients;

use App\Core\Enums\ErrorCode;
use App\Core\Http\Exception\InitException;
use App\Core\InstanceTrait;
use GuzzleHttp\Exception\ClientException;
use Illuminate\Support\Arr;

/**
 * Class KongClient
 * @package App\Common\Clients
 * @method addService($params = [])
 * @method services($params = [])
 * @method updateService($idOrName, $params)
 * @method getService($idOrName)
 * @method deleteService($idOrName)
 * @method pluginsByService($idOrName)
 *
 * @method addRoute($params)
 * @method routes($params = [])
 * @method getRoute($id)
 * @method updateRoute($id, $params)
 * @method deleteRoute($id)
 *
 * @method addApi($params)
 * @method getApi($idOrName)
 * @method deleteApi($idOrName)
 * @method apis($params = [])
 * @method updateApi($idOrName, $params)
 *
 * @method addConsumer($params)
 * @method getConsumer($idOrName)
 * @method consumers($params = [])
 * @method updateConsumer($idOrName, $params)
 * @method deleteConsumer($idOrName)
 *
 * @method addPlugin($params)
 * @method getPlugin($id)
 * @method plugins($params = [])
 * @method updatePlugins($id, $params)
 * @method deletePlugins($idOrName)
 * @method pluginsEnabled()
 */
class KongClient
{
    use InstanceTrait;

    protected $handler;

    /**
     * @param $name
     * @param $arguments
     * @return mixed
     * @throws \App\Core\Http\Exception\InitException
     */
    public function __call($name, $arguments)
    {
        $handler = KongHandler::getInstance();
        try {
            return $handler->$name(...$arguments);
        } catch (ClientException $ex) {
            dump($ex->getMessage());
            $json = json_decode($ex->getResponse()->getBody()->getContents(), true);
            $message = Arr::get($json, 'message');
            throw new InitException($message, ErrorCode::$ENUM_KONG_API_FAIL);
        }
    }
}