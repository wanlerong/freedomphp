<?php
// | Author: wanlr
// +----------------------------------------------------------------------
// | DateTime: 2016-12-08 17:44
// +----------------------------------------------------------------------


namespace App\Model;

use FreedomPHP\Core\Library\DB;

class NotehubModel extends CommonModel
{
    public function __construct()
    {
        parent::__construct();
        $this->builder = DB::builder('app.notehubs');
    }

}