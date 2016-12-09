<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
  <title><?php echo $seo['title']?></title>
<?php foreach ($static_files['css'] as $v): ?>
    <link rel="stylesheet" href="<?php echo ASSETS_PATH.$v;?>"/>
<?php endforeach;?>
</head>
<body>
<nav class="navbar fb navbar-fixed-top" role="navigation">
  <div class="container">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand project-name" href="/">Notehubs</a>
    </div>

    <div id="navbar" class="navbar-collapse collapse pull-right">
      <ul class="nav navbar-nav">
        <li>
          <form class="navbar-form navbar-right" role="form">
            <div class="form-group">
              <input type="text" placeholder="搜索" class="form-control">
            </div>
          </form>
        </li>
        <?php if (!empty($session)&&$session['id']&&$session['username']): ?>
        <li class="dropdown user-dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">
            <span style="color: #fff" class="glyphicon glyphicon-user"></span><span style="color: #fff" class="caret"></span>
          </a>
          <ul class="dropdown-menu" role="menu">
            <li class="dropdown-header">以<?php echo $session['username'];?>用户登录</li>
            <li class="divider"></li>
            <li><a href="/addnote">创建Notehub</a></li>
            <li><a href="#">个人中心</a></li>
            <li class="divider"></li>
            <li><a href="/user/logout">退出登录</a></li>
          </ul>
        </li>
        <?php else: ?>
        <li><a href="/login" type="submit" class="btn btn-primary user-login-btn">登录</a></li>
        <?php endif; ?>
      </ul>
    </div><!--/.nav-collapse -->

  </div>
</nav>

<?php echo $body_content;?>
</body>
<?php foreach ($static_files['js'] as $v): ?>
    <script src="<?php echo ASSETS_PATH.$v;?>"></script>
<?php endforeach; ?>
</html>


