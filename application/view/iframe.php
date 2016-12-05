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
<div class="container canvas">
  <div class="topbar">
    <div class="topbar-inner">
      <div class="container canvas">
        <a class="brand" href="#">Notehubs</a>
        <ul class="nav">
        </ul>
        <form action="" class="pull-right">
          <input class="input-small" type="text" placeholder="Email">
          <input class="input-small" type="password" placeholder="Password">
          <button class="btn" type="submit">登录</button>
        </form>
      </div>
    </div>
  </div>

<?php echo $body_content;?>

</div>
</body>
<?php foreach ($static_files['js'] as $v): ?>
    <script src="<?php echo ASSETS_PATH.$v;?>"></script>
<?php endforeach; ?>
</html>