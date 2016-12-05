<?php
// | Author: wanlr
// +----------------------------------------------------------------------
// | DateTime: 2016-12-05 15:05
// +----------------------------------------------------------------------

?>
<div class="container-fluid">
    <div class="row">
        <form action="<?php echo site_url('user','reg')?>" method="post" id="user_register_form">
            <div class="clearfix">
                <label for="username">用户名</label>
                <div class="input">
                    <input type="text" class="xlarge" id="username" name="username"/>
                </div>
            </div>

            <div class="clearfix">
                <label for="phone">电话</label>
                <div class="input">
                    <input type="text" class="xlarge" id="phone" name="phone"/>
                </div>
            </div>

            <div class="clearfix">
                <label for="password">密码</label>
                <div class="input">
                    <input type="text" class="xlarge" id="password" name="password"/>
                </div>
            </div>

            <div class="actions">
                <button id="user_register_btn" class="btn primary">注册</button>
            </div>
        </form>
    </div>
</div>
