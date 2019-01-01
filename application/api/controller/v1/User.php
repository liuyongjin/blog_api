<?php
namespace app\api\controller\v1;
use app\api\controller\BaseController;

class User extends BaseController
{
    public function login()
    {
    	$data=input('post.');
    	// var_dump($data);
        return json($data);
    }
}