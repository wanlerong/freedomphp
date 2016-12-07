<?php
// | Author: wanlr
// +----------------------------------------------------------------------
// | DateTime: 2016-12-07 10:37
// +----------------------------------------------------------------------
?>
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


<?php echo $body_content;?>
</body>
<?php foreach ($static_files['js'] as $v): ?>
    <script src="<?php echo ASSETS_PATH.$v;?>"></script>
<?php endforeach; ?>
</html>