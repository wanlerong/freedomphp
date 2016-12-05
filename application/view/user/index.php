<?php
// | Author: wanlr
// +----------------------------------------------------------------------
// | DateTime: 2016-12-05 17:50
// +----------------------------------------------------------------------

?>

<div class="container-fluid">
    <div class="row">
      <div class="span12">
        欢迎来到主页
        <div class="row">
          <div class="span6">
            用户名：<?php echo $session['username'];?>
          </div>
          <div class="span6">
            id: <?php echo $session['id'];?>
          </div>
        </div>
      </div>
    </div>
</div>
