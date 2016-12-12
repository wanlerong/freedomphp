//新建note
$(function () {
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
//新建note 表单验证
$(function () {
    // Generate a simple captcha
    function randomNumber(min, max) {
        return Math.floor(Math.random() * (max - min + 1) + min);
    };
    $('#captchaOperation').html([randomNumber(1, 100), '+', randomNumber(1, 200), '='].join(' '));

    //新建note 表单验证
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

//新建blackbox
$(function () {
    $('#create_new_bbox').click(function () {
        $('.new-blackbox').removeClass('hide');
    })

    $('#cancel-create').click(function () {
        $('.new-blackbox').addClass('hide');
    })

    $('#add_blackbox_btn').formTodo({
        callback:function(url, method, data){
            //手动验证表单bootstrapValidator方法
            $('#add_blackbox_form').data('bootstrapValidator').validate();
            if ($('#add_blackbox_form').data('bootstrapValidator').isValid()){
                return true;
            }
        }
    });
})

//新建blackbox 表单验证
$(function () {
    // Generate a simple captcha
    function randomNumber(min, max) {
        return Math.floor(Math.random() * (max - min + 1) + min);
    };
    $('#captchaOperation').html([randomNumber(1, 100), '+', randomNumber(1, 200), '='].join(' '));

    //新建blackbox 表单验证
    $('#add_blackbox_form').bootstrapValidator({
        message: 'This value is not valid',
        feedbackIcons: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
            name: {
                message: 'note无效',
                validators: {
                    notEmpty: {
                        message: 'note名称不能为空'
                    },
                    stringLength: {
                        min: 2,
                        max: 45,
                        message: 'note名称必须在2~45字符之间'
                    }
                }
            },
        }
    });

});

