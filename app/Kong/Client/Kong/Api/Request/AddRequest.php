<?php
/**
 * Created by PhpStorm.
 * User: mac
 * Date: 2018/7/7
 * Time: 下午8:14
 */

namespace App\Kong\Client\Kong\Api\Request;

use Lin\Src\Basic\Request;

class AddRequest extends Request
{
    public function getUri()
    {
        return '/apis/';
    }

    public function getMethod()
    {
        return "POST";
    }

    public function getName()
    {
        return 'apis.add';
    }
}