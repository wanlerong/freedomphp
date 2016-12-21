<?php
// | Author: wanlr
// +----------------------------------------------------------------------
// | DateTime: 2016-12-12 17:04
// +----------------------------------------------------------------------
namespace App\Library;

class Html
{
    /**
     * 封装弹窗方法
     * @param $id
     * @param $btn
     * @param $btn_id
     * @param $title
     * @param $form_id
     * @param $url
     * @param $act
     * @param string $form_method
     */
    public static function modal($id,$btn,$btn_id,$title,$form_id,$url,$act,$form_method='post'){
        $str = <<<HTML
                    <div class="modal fade" id="{$id}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        <form action="{$url}" id="{$form_id}" method="{$form_method}">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                    <h4 class="modal-title" id="myModalLabel">{$title}</h4>
                                </div>
                                <div class="modal-body">
                                    
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
                                    <button type="button" id="{$btn_id}" class="btn btn-primary submit_btn">{$btn}</button>
                                    <input type="hidden" name="act" value="{$act}">
                                </div>
                            </div>
                        </div>
                        </form>
                    </div>
HTML;
        echo $str;
    }

}