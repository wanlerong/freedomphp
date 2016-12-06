<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
  <meta charset="utf-8">
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
      <a class="navbar-brand project-name" href="#">Notehubs</a>
    </div>
    <div id="navbar" class="navbar-collapse collapse">
      <form class="navbar-form navbar-right" role="form">
        <div class="form-group">
          <input type="text" placeholder="邮箱" class="form-control">
        </div>
        <div class="form-group">
          <input type="password" placeholder="密码" class="form-control">
        </div>
        <button type="submit" class="btn btn-primary">登录</button>
      </form>
    </div><!--/.navbar-collapse -->
  </div>
</nav>

<?php echo $body_content;?>
</body>
<?php foreach ($static_files['js'] as $v): ?>
    <script src="<?php echo ASSETS_PATH.$v;?>"></script>
<?php endforeach; ?>
</html>






