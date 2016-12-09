<?php
// | Author: wanlr
// +----------------------------------------------------------------------
// | DateTime: 2016-12-08 15:12
// +----------------------------------------------------------------------


namespace App\Controller;


class NotehubController extends CommonController
{
    public function __construct()
    {
        parent::__construct();
        $this->static_files['css'][] = 'css/notehub.css';
        $this->static_files['js'][] = 'js/notehub.js';
    }

    public function add()
    {
//        $data = $this->NotehubModel->builder->find(10);
//        p($data);die;

        if (IS_POST){
            $name = $this->Input->post('name');
            $desc = $this->Input->post('desc');
            $is_public = $this->Input->post('is_public');

            $data=array(
                'name'=>$name,
                'user_id'=>$this->session['id'],
                'contributor_id'=>'',
                'create_at'=>time(),
                'desc'=>$desc,
                'is_public'=>$is_public
            );


            if ($id = $this->NotehubModel->addInfo($data)){
                $this->ajaxReturn(AJ_RET_SUCC,'创建成功',array('forward'=>BASE_URL));
            }else{
                $this->ajaxReturn(AJ_RET_FAIL,'创建失败',array('forward'=>BASE_URL.'/addnote'));
            }


        }
        $data = array();
        $this->display('notehub/add',$data);
    }
}