<?php
/**
 * Created by PhpStorm.
 * User: wlr
 * Date: 16/12/13
 * Time: 下午10:35
 */
?>
<div class="row fafafa" xmlns="http://www.w3.org/1999/html">
    <div class="container">
        <div class="row marbot20">

            <div class="pull-left">
                <ol class="breadcrumb">
                    <li><a href="<?php echo furl('adminnote',['id'=>$notehub['id']]);?>"><?php echo $notehub['name'];?></a></li>
                    <?php foreach ($bread_array as $v): ?>
                        <li class="<?php if ($info['id'] == $v['id'])echo 'active';?>">
                            <a href="<?php echo ($info['id'] == $v['id'])? 'javascript:;' :furl('adminnote',['id'=>$notehub['id'],'blackbox_id'=>$v['id']]);?>"><?php echo $v['name'];?></a>
                        </li>
                    <?php endforeach; ?>
                </ol>
            </div>
        </div>

        <ul class="nav text-lalign">
            <li><a class="reponav-item selected" href="#"><span class="glyphicon glyphicon-book"></span>&nbsp;文章</a></li>
            <li><a class="reponav-item" href="#"><span class="glyphicon glyphicon-road"></span>&nbsp;思维</a></li>
        </ul>


    </div>
</div>
