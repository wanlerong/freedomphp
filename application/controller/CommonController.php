<?php
// | Author: wanlr
// +----------------------------------------------------------------------
// | DateTime: 2016-12-02 11:18
// +----------------------------------------------------------------------
namespace App\Controller;
use FreedomPHP\Core\Controller;
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
        'css'   =>  '',
        'js'    =>  ''
    );

    public function __construct()
    {
        parent::__construct();
        //数据统计相关
        $this->setProperty('UserModel', function () {
            return new UserModel();
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

        $body_content                           = $this->view($view_tpl, $this->view_data, false);

        $this->view_data['body_content']        = $body_content;
        $this->view('iframe', $this->view_data);
    }
}