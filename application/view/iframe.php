<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
<title><?php echo $seo['title']?></title>
<?php foreach ($static_files['css'] as $v): ?>
    <link rel="stylesheet" href="<?php echo ASSETS_PATH.$v;?>"/>
<?php endforeach;?>
  <style>body{padding-top: 60px;}</style>
</head>
<body>
<div class="topbar">
  <div class="topbar-inner">
    <div class="container-fluid">
      <a class="brand" href="#">Notehubs</a>
      <ul class="nav">
        <li class="active"><a href="#">Home</a></li>
        <li><a href="#about">About</a></li>
        <li><a href="#contact">Contact</a></li>
      </ul>
      <p class="pull-right">Logged in as <a href="#">username</a></p>
    </div>
  </div>
</div>

<?php echo $body_content;?>
</body>
<?php foreach ($static_files['js'] as $v): ?>
    <script src="<?php echo ASSETS_PATH.$v;?>"></script>
<?php endforeach; ?>
</html>