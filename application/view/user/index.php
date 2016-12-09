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
            <div class="col-md-4 col-md-3d5 col-sm-offset-1 col-sm-offset-1d5">

                <!-- Nav tabs -->
                <div class="boxed-group">
                    <div class="boxed-group-head">
                        <h3>你的笔记
                            <span class="badge">13</span>
                        </h3>
                        <div>
                            <a href="/addnote" class="pull-right"><button class="btn btn-success pull-right new-note-btn">新建笔记</button></a>
                        </div>
                    </div>
                    <div class="boxed-group-inner">
                        <div class="filter-repos filter-bar">
                            <input type="text" class="resp-input" placeholder="寻找笔记"/>
                            <ul class="repo-filterer">
                                <li role="presentation" class="active"><a class="text-small text-gray" href="#note-all" role="tab" data-toggle="tab">全部</a></li>
                                <li role="presentation"><a class="text-small text-gray" href="#note-pub" role="tab" data-toggle="tab">公开</a></li>
                                <li role="presentation"><a class="text-small text-gray" href="#note-pri" role="tab" data-toggle="tab">私密</a></li>
                            </ul>
                        </div>

                                        <!-- Tab panes -->
                        <div class="tab-content tab-content-notes">
                          <div role="tabpanel" class="tab-pane active" id="note-all">
                              <ul>
                                  <?php foreach ($my_notes as $k=>$v): ?>
                                <li class="public_note"><a href=""><?php echo $v['name'];?></a></li>
                                  <?php endforeach; ?>
                              </ul>
                          </div>
                          <div role="tabpanel" class="tab-pane" id="note-pub">
                                <ul>
                                    <?php foreach ($my_public_notes as $v): ?>
                                <li class="public_note"><a href=""><?php echo $v['name'];?></a></li>
                                    <?php endforeach; ?>
                              </ul>
                          </div>
                          <div role="tabpanel" class="tab-pane" id="note-pri">
                                <ul>
                                    <?php foreach ($my_private_notes as $v): ?>
                                <li class="public_note"><a href=""><?php echo $v['name'];?></a></li>
                                    <?php endforeach; ?>
                              </ul>
                          </div>
                        </div>
                    </div>
                  </div>
            </div>
        </div>
    </div>
</div>