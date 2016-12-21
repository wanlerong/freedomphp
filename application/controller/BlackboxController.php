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
        $this->static_files['css'][] = 'css/notehub.css';
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
            //安静模式,不弹窗提示
            $this->ajaxReturn(AJ_RET_SUCC,'quiet',array('forward'=>'reload'));
        }
    }

    /**
     * ajax删除blackbox
     */
    public function delete(){
        $id = $this->Input->post('id');
        //如果该box存在子级
        if (!empty($this->BlackboxModel->builder->where(array('parent_id'=>$id))->first()))
        {
            $data = array(
                'code' => AJ_RET_FAIL,
                'msg'=>'该note存在子级,不能删除',
            );
        }else{
            $this->BlackboxModel->updateInfo(array('status'=>-1),array('id'=>$id));
            $data = array(
                'code' => AJ_RET_SUCC,
                'msg' => '删除成功',
                'id' => $id
            );
        }
        echo json_encode($data);
        exit;
    }


    /**
     * 回收站
     */
    public function recycle(){
        $act = $this->Input->post('act');
        /**
         * 判断ajax的行为
         */
        switch ($act)
        {
            case 'getlist':
                $notehub_id = $this->Input->post('notehub_id');
                $boxes = $this->BlackboxModel->builder->where(array('notehub_id'=>$notehub_id,'status'=>-1))->get();
                $data = array(
                    'code'=>AJ_RET_SUCC,
                    'data'=>$boxes
                );
                echo json_encode($data);
                break;
            case 'recycle':
                $rebox_id = $this->Input->post('rebox_id');
                if (empty($rebox_id))
                    $this->ajaxReturn(AJ_RET_FAIL,'quiet',array('forward'=>'stop'));

                $data = $this->BlackboxModel->builder->whereIn('id',$rebox_id)->update(array('status'=>0));
                //返回影响的记录条数
                if ($data>0){
                    $this->ajaxReturn(AJ_RET_SUCC,'quiet',array('forward'=>'reload'));
                }
                break;
        }
        exit;
    }

    /**
     * 编辑blackbox
     */
    public function edit(){
        $data = array();

        //接收box的id
        $id = $this->Input->get('id');

        $data['info'] = $this->BlackboxModel->getInfo(array('id'=>$id));

        $data['notehub'] = $this->NotehubModel->builder->where(array('id'=>$data['info']['notehub_id']))->first();

        $data['bread_array'] = $this->BlackboxModel->get_up_levels($id);

//        p($data);die;

        $this->display('blackbox/edit',$data);
    }
}