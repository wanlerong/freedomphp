<?php
// | Author: wanlr
// +----------------------------------------------------------------------
// | DateTime: 2016-12-05 15:05
// +----------------------------------------------------------------------

?>
<div class="container canvas">

    <div class="span7 pull-left">
        <div>
            <img height="100" src="" alt="">
        </div>
    </div>

    <div class="span5 pull-right">
        <h1>注册</h1>
        <div class="">
            <form action="<?php echo site_url('user','reg')?>" method="post" id="user_register_form">
                <div class="clearfix">
                    <input type="text" class="xlarge" id="username" name="username" placeholder="用户名"/>
                </div>

                <div class="clearfix">
                    <input type="text" class="xlarge" id="email" name="email" placeholder="邮箱"/>
                </div>

                <div class="clearfix">
                    <input type="password" class="xlarge" id="password" name="password" placeholder="密码"/>
                </div>

                <div class="canvas">
                    <button id="user_register_btn" class="btn primary">注册</button>
                </div>
            </form>
        </div>
    </div>

</div>
