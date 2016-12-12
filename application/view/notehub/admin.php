<?php
/**
 * Created by PhpStorm.
 * User: wlr
 * Date: 16/12/11
 * Time: 上午10:19
 */
?>
<div class="row fafafa" xmlns="http://www.w3.org/1999/html">
<div class="container">
    <div class="row marbot20">
        <h3 class="pull-left">&nbsp;<?php echo $session['username'];?>&nbsp;/&nbsp;<?php echo $info['name'];?></h3>

        <div class="btn-group pull-right martop20 marleft10">
            <div class="btn-group">
                <button type="button" class="btn btn-default">
                    <span class="glyphicon glyphicon-star"></span>
                    加星
                </button>
            </div>
            <button type="button" class="btn btn-default">1</button>
        </div>

        <div class="btn-group pull-right martop20">
            <div class="btn-group">
                <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                    <span class="glyphicon glyphicon-eye-open"></span>
                    关注
                    <span class="caret"></span>
                </button>
                <ul class="dropdown-menu" role="menu">
                    <li><a href="#">关注该笔记</a></li>
                    <li><a href="#">取消关注</a></li>
                    <li><a href="#">关注但不提醒</a></li>
                </ul>
            </div>
            <button type="button" class="btn btn-default">1</button>
        </div>
    </div>

    <ul class="nav text-lalign">
        <li><a class="reponav-item selected" href="#"><span class="glyphicon glyphicon-book"></span>&nbsp;内容</a></li>
        <li><a class="reponav-item" href="#"><span class="glyphicon glyphicon-cog"></span>&nbsp;设置</a></li>
    </ul>


</div>
</div>
<div class="container martop20">
    <div class="overall-summary overall-summary-bottomless">
        <div class="stats-switcher-viewport js-stats-switcher-viewport">
            <div class="stats-switcher-wrapper">
                <ul class="numbers-summary">
                    <li class="commits"><a href=""><span class="glyphicon glyphicon-wrench"></span>&nbsp;<span class="text-emphasized">21</span>&nbsp;修改</a></li>
                    <li class="commits"><a href=""><span class="glyphicon glyphicon-user"></span>&nbsp;<span class="text-emphasized">1</span>&nbsp;贡献者</a></li>
                </ul>

            </div>
        </div>
    </div>

    <div class="martop20">
        <div class="pull-left">
            <button type="button" class="btn btn-default">查看笔记</button>
        </div>

        <div class="pull-left">
            <ol class="breadcrumb">
                <li><a href="/adminnote?id=<?php echo $info['id'];?>"><?php echo $info['name'];?></a></li>
                <?php foreach ($bread_array as $v): ?>
                    <li class="<?php if ($cur_box_id == $v['id'])echo 'active';?>">
                        <a href="/adminnote?id=<?php echo $info['id'];?>&blackbox_id=<?php echo $v['id'];?>"><?php echo $v['name'];?></a>
                    </li>
                <?php endforeach; ?>
            </ol>
        </div>


        <div class="btn-group pull-right">
          <button type="button" class="btn btn-default" id="create_new_bbox">创建新note</button>
          <button type="button" class="btn btn-default">下载笔记</button>
        </div>
    </div>
    <div>
        <table class="table table-bordered table-hover">
             <!--新建节点 -->
            <tr class="new-blackbox hide">
                <td colspan="4">
                    <div style="position: relative">
                        <form id="add_blackbox_form" action="/addbox" method="post" class="form-horizontal" role="form" >
                            <div class="form-group pull-left marbot0">
                                <div class="col-sm-offset-2 col-sm-10">
                                    <input type="text" name="name" id="name" class="form-control" id="inputEmail2" placeholder="请输入名称">
                                    <input type="hidden" name="notehub_id" value="<?php echo $info['id'];?>"/>
                                    <input type="hidden" name="parent_id" value="<?php echo $cur_box_id;?>"/>
                                    <span class="glyphicon"></span>
                                </div>
                            </div>
                            <div class="form-group pull-left marbot0">
                                <div class="col-sm-offset-2 col-sm-10 pull-left">
                                    <!--submit_btn样式防多次提交-->
                                    <button type="button" id="add_blackbox_btn" autocomplete="off" data-loading-text="Loading..." class="ui-bz-btn-p-15 submit_btn">确认</button>
                                </div>

                            </div>
                             <div class="col-sm-8 pull-left">
                                 <a href="javascript:;" id="cancel-create">
                                     <b class="lineh31">取消</b>
                                 </a>
                            </div>
                        </form>
                    </div>
                </td>
            </tr>
            <?php foreach ($blackboxes as $v):?>
            <tr>
                <td><a href="/adminnote?id=<?php echo $info['id'];?>&blackbox_id=<?php echo $v['id'];?>"><?php echo $v['name'];?></a></td>
                <td>刚刚</td>
                <td>
                    <a href=""><span class="glyphicon glyphicon-edit"></span></a>
                    <a href=""><span class="glyphicon glyphicon-trash"></span></a>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
    </div>
</div>
