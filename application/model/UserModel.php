<?php
// | Author: wanlr
// +----------------------------------------------------------------------
// | DateTime: 2016-12-02 13:13
// +----------------------------------------------------------------------

namespace App\Model;

use FreedomPHP\Core\Library\DB;

class UserModel extends CommonModel{

    public function __construct()
    {
        parent::__construct();
        $this->builder = DB::builder('app.users');
    }

}