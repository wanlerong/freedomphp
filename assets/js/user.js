// +----------------------------------------------------------------------
// | Copyright (c) 2010-2013 http://www.YiiSpace.com All rights reserved.
// +----------------------------------------------------------------------
// | Author: Micheal Chen <shilong.chen2012@gmail.com>
// +----------------------------------------------------------------------
// | FileName: 
// +----------------------------------------------------------------------
// | DateTime: 2016-12-05 16:45
// +----------------------------------------------------------------------

$(function () {
    $('#user_register_btn').formTodo({
        callback:function(url, method, data){
            //手动验证表单bootstrapValidator方法
            $('#user_register_form').data('bootstrapValidator').validate();
            if ($('#user_register_form').data('bootstrapValidator').isValid()){
                return true;
            }
        }
    });

    $('#user_login_btn').formTodo({
        callback:function(url, method, data){
            //手动验证表单bootstrapValidator方法
            $('#login_form').data('bootstrapValidator').validate();
            if ($('#login_form').data('bootstrapValidator').isValid()){
                return true;
            }
        }
    })
})

$(function () {
    // Generate a simple captcha
    function randomNumber(min, max) {
        return Math.floor(Math.random() * (max - min + 1) + min);
    };
    $('#captchaOperation').html([randomNumber(1, 100), '+', randomNumber(1, 200), '='].join(' '));

    //用户注册表单验证
    $('#user_register_form').bootstrapValidator({
        message: 'This value is not valid',
        feedbackIcons: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
            username: {
                message: '昵称无效',
                validators: {
                    notEmpty: {
                        message: '昵称不能为空'
                    },
                    stringLength: {
                        min: 6,
                        max: 30,
                        message: '昵称必须在6~30位之间'
                    },
                    regexp: {
                        regexp: /^[a-zA-Z0-9_\.]+$/,
                        message: '昵称必须由字母数字，下划线，小数点组成'
                    },
                    remote:{
                        url: '/user/ckusername',     //后台处理程序
                        type: "post",               //数据发送方式
                        dataType: "json",           //接受数据格式
                        data: {                     //要传递的数据
                            username: function() {
                                return $("#username").val();
                            }
                        },
                        message:'昵称已存在'
                    }
                }
            },
            email: {
                validators: {
                    notEmpty: {
                        message: '邮件地址不能为空'
                    },
                    emailAddress: {
                        message: '无效的邮件地址'
                    },
                    remote:{
                        url: '/user/ckemail',     //后台处理程序
                        type: "post",               //数据发送方式
                        dataType: "json",           //接受数据格式
                        data: {                     //要传递的数据
                            email: function() {
                                return $("#email").val();
                            }
                        },
                        message:'邮箱已存在'
                    }
                }
            },
            password: {
                validators: {
                    notEmpty: {
                        message: '密码不能为空'
                    },
                    different: {
                        field: 'username',
                        message: '密码不能和用户名一致'
                    }
                }
            },
        }
    });


    //用户注册表单验证
    $('#login_form').bootstrapValidator({
        message: 'This value is not valid',
        feedbackIcons: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
            email: {
                validators: {
                    notEmpty: {
                        message: '邮件地址不能为空'
                    },
                    emailAddress: {
                        message: '无效的邮件地址'
                    }
                }
            },
            password: {
                validators: {
                    notEmpty: {
                        message: '密码不能为空'
                    },
                }
            },
        }
    });


});