<?php
// | Author: wanlr
// +----------------------------------------------------------------------
// | DateTime: 2016-12-12 14:38
// +----------------------------------------------------------------------


namespace App\Controller;


class BlackboxController extends CommonController
{
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * ajax添加blackbox
     */
    public function add(){
        $name = $this->Input->post('name');
        $notehub_id = $this->Input->post('notehub_id');
        $parent_id = $this->Input->post('parent_id');
        $data = array(
            'name'       =>$name,
            'notehub_id' =>$notehub_id,
            'parent_id'  =>$parent_id
        );
        if($id = $this->BlackboxModel->addInfo($data))
        {
            $this->ajaxReturn(AJ_RET_SUCC,$name,array('forward'=>'stop'));
        }
    }
}