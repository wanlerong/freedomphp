<?php
/**
 * Created by PhpStorm.
 * User: wlr
 * Date: 16/11/26
 * Time: 下午6:40
 */
namespace App\Controller;

use FreedomPHP\Core\Controller;

class UserController extends Controller {

    public $username;

    public function __construct()
    {
        echo "this is userController<br>";
    }

    public function aa(){
        echo "<br>asdsad";
    }

    public function index()
    {
        echo 'hello index';
    }
    public function login(){
        echo 'login';
    }
    public function reg(){
        echo 'reg';
    }
}