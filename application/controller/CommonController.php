<?php
// | Author: wanlr
// +----------------------------------------------------------------------
// | DateTime: 2016-12-02 11:18
// +----------------------------------------------------------------------
namespace App\Controller;
use FreedomPHP\Core\Controller;
use FreedomPHP\Core\Library\Session;
use App\Model\UserModel;

class CommonController extends Controller{

    protected $view_data                        = array(
        'seo'   => array(
            'title'         => 'freedomphp',
            'keywords'      => '一款普通的php框架',
            'description'   => '一款普通的php框架'
        )
    );

    protected $static_files                     = array(
        'css'   =>  array('css/bootstrap.min.css','css/common.css'),
        'js'    =>  array('js/jquery-1.7.min.js','js/bootstrap-modal.js','js/common.js')
    );

    public function __construct()
    {
        parent::__construct();
        //数据统计相关
        $this->user_session = isset($_SESSION['user']) ? $_SESSION['user'] : array();;

        $this->setProperty('UserModel', function () {
            return new UserModel();
        });

        $this->setProperty('Session',function (){
            return new Session();
        });
    }

    /**
     * 渲染模板
     *
     * @param bool $view_tpl
     * @param array $data
     */
    protected function display($view_tpl = false, $data = array())
    {
        if ($data) {
            $this->view_data = array_merge($this->view_data, $data);
        }
        $this->view_data['static_files']        = $this->static_files;
        $this->view_data['user_session']          = $this->user_session;

        $body_content                           = $this->view($view_tpl, $this->view_data, false);

        $this->view_data['body_content']        = $body_content;
        $this->view('iframe', $this->view_data);
    }

    /**
     * 返回数据处理方法
     *
     * @param int $code
     * @param null $msg
     * @param null $data
     */
    public function ajaxReturn($code = AJ_RET_SUCC, $msg = null, $data = null)
    {
        //输出正确的json格式
        header('Content-type:text/json');
        $result["code"]         = $code;
        $result["msg"]          = $msg;

        if(empty($data['forward'])){//判断是否有跳转操作
            $data['forward']    = '';
        }

        $result['data']         = $data;

        echo json_encode($result);
        exit;
    }
}