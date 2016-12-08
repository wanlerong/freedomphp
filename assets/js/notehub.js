// +----------------------------------------------------------------------
// | Copyright (c) 2010-2013 http://www.YiiSpace.com All rights reserved.
// +----------------------------------------------------------------------
// | Author: Micheal Chen <shilong.chen2012@gmail.com>
// +----------------------------------------------------------------------
// | FileName: 
// +----------------------------------------------------------------------
// | DateTime: 2016-12-08 16:26
// +----------------------------------------------------------------------


$(function () {
    //防止表单重复提交
    $('#notehub_add_btn').formTodo({
        callback:function(url, method, data){
            //手动验证表单bootstrapValidator方法
            $('#notehub_add_form').data('bootstrapValidator').validate();
            if ($('#notehub_add_form').data('bootstrapValidator').isValid()){
                return true;
            }
        }
    });
})

$(function () {
    // Generate a simple captcha
    function randomNumber(min, max) {
        return Math.floor(Math.random() * (max - min + 1) + min);
    };
    $('#captchaOperation').html([randomNumber(1, 100), '+', randomNumber(1, 200), '='].join(' '));

    //用户注册表单验证
    $('#notehub_add_form').bootstrapValidator({
        message: 'This value is not valid',
        feedbackIcons: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
            name: {
                message: '笔记无效',
                validators: {
                    notEmpty: {
                        message: '笔记名称不能为空'
                    },
                    stringLength: {
                        min: 2,
                        max: 45,
                        message: '笔记名称必须在2~45字符之间'
                    }
                }
            },
            desc: {
                validators: {
                    stringLength: {
                        max: 200,
                        message: '笔记描述必须在小于200字符'
                    }
                }
            },
        }
    });

});