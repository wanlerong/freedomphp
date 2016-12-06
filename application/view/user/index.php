<?php
// | Author: wanlr
// +----------------------------------------------------------------------
// | DateTime: 2016-12-05 17:50
// +----------------------------------------------------------------------

?>
<!--首页-->
<div class="jumbotron">
    <div class="container">
        <div class="row">
            <div class="col-md-7">
              <h2>欢迎使用Notehubs</h2>
              <p>拒绝信息爆炸，享受优质知识。大量工程师使用Notehubs来打造个人的终身资料库，获取更优质的信息，总结整理思绪, 并且一起维护更好的技术知识</p>
            </div>
            <div class="col-md-4 col-sm-offset-1">
                <form id="user_register_form" class="form-horizontal" role="form" action="<?php echo site_url('user','reg');?>" method="post">
                    <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                      <input type="text" name="username" id="username" class="form-control" id="inputEmail3" placeholder="请输入昵称">
                      <span class="glyphicon"></span>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                      <input type="email" name="email" id="email" class="form-control" id="inputEmail3" placeholder="请输入邮箱">
                      <span class="glyphicon"></span>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                      <input type="password" name="password" id="password" class="form-control" id="inputPassword3" placeholder="请输入密码">
                      <span class="glyphicon"></span>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                      <button type="button" id="user_register_btn" class="btn btn-block btn-primary btn-lg">注册 Notehubs</button>
                    </div>
                  </div>
                </form>
            </div>
        </div>
    </div>
</div>