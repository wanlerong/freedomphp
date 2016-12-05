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
            if(data.username.isEmpty()){
                $('#username').addClass('error');$('#user_name').parent().addClass('error');
                return false;
            }

            if(data.email.isEmpty()){
                $('#email').addClass('error');$('#email').parent().addClass('error');
                return false;
            }

            if(data.password.isEmpty()){
                $('#password').addClass('error');$('#password').parent().addClass('error');
                return false;
            }

            return true;
        }
    });
})