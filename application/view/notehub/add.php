<?php
// | Author: wanlr
// +----------------------------------------------------------------------
// | DateTime: 2016-12-08 16:07
// +----------------------------------------------------------------------
?>

<div class="container">
    <div class="row">
        <div class="col-sm-8 col-sm-offset-2">
            <div class="Subhead">
                <h2>创建一个新的笔记</h2>
                <p>一个Notehub用于永久保存你所有的笔记，信息碎片，以及关于这个主题的重要知识。</p>
            </div>
            <form role="form" id="notehub_add_form" action="/addnote" method="post">
              <div class="form-group">
                <label for="name">笔记名称</label>
                <input type="text" name="name" class="form-control" id="name" placeholder="请输入笔记名称">
              </div>
              <div class="form-group">
                <label for="desc">简介</label>
                <input type="text" name="desc" class="form-control" id="desc" placeholder="可以为空">
              </div>
              <div class="form-group">
                <div class="radio">
                  <label>
                    <input type="radio" name="is_public" id="optionsRadios1" value="1" checked>
                    <b>公开</b>（每个人都可以看到这个笔记，你可以选择谁有权限修改）
                  </label>
                </div>
                <div class="radio">
                  <label>
                    <input type="radio" name="is_public" id="optionsRadios2" value="0">
                    <b>私密</b>（你选择谁有权限查看和修改该笔记）
                  </label>
                </div>
              </div>
              <button type="submit" id="notehub_add_btn" class="btn btn-default submit_btn">创建</button>
            </form>
        </div>
    </div>
</div>
