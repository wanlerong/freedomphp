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
                alert('登录账号不能为空');return false;
            }

            if(data.password.isEmpty()){
                alert('登录密码不能为空');return false;
            }

            return true;
        }
    });
})