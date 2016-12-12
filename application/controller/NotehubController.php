<?php

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

    /**
     * notehub管理页面
     */
    public function admin(){
        $data = array();
        $data['blackboxes'] = array();
        $id = $this->Input->get('id');
        //接收当前blackbox的id
        $blackbox_id = empty($this->Input->get('blackbox_id')) ? 0 : $this->Input->get('blackbox_id');
        $data['cur_box_id'] = $blackbox_id; //对于创建的box来说，当前box_id即为父级id

        //获取当前blackbox下的所有子集
        if ($blackbox_id === 0 ){
            //获取该notehub的所有顶级的blackbox
            $data['blackboxes'] = $this->BlackboxModel->builder->where(array('notehub_id'=>$id,'parent_id'=>0))->get();
        }else{
            $data['blackboxes'] = $this->BlackboxModel->builder->where(array('notehub_id'=>$id,'parent_id'=>$blackbox_id))->get();
        }


        $data['info'] = $this->NotehubModel->builder->where(array('id'=>$id))->first();
        //面包屑导航
        $data['bread_array'] = $this->BlackboxModel->get_up_levels($blackbox_id);

        $this->display('notehub/admin',$data);
    }

}