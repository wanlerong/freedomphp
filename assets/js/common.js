;$.xy = {
    version: '0.0.1',
    success: '操作成功',
    failed: '操作失败，请刷新页面后重试!',
    current_domain:document.domain,//window.location.host
    current_url : window.location.pathname,
    default_logo_bg: 'http://pic.xyzs.com/v3/dev/image/logo_bg.jpg',
    statusCode: {success:200, failed:201, warn:300, nologin:900},
    keys: {code:"code", msg:"msg"},
    _set:{//debug 设置
        debug:false
    },
    debug:function(msg){//debug 输出调试信息
        if (this._set.debug) {
            if (typeof(console) != "undefined"){
                console.log("%c*----------*----------*----------*----------*----------*----------*","color:red");
                console.log(msg);
            }else{
                alert(msg);
            }
        }
    },
    /**
     * ajax 异步 请求方法封装
     *
     * 注：使用参数，参数对应上，不然错误无法定位
     */
    request: function(url, data, type, async, dataType, timeout, successfn, errorfn) {
        async       = (async==null || async=="" || typeof(async)=="undefined")? "true" : async;
        type        = (type==null || type=="" || typeof(type)=="undefined")? "post" : type;
        dataType    = (dataType==null || dataType=="" || typeof(dataType)=="undefined")? "json" : dataType;
        data        = (data==null || data=="" || typeof(data)=="undefined")? {"date": new Date().getTime()} : data;
        timeout     = (timeout==null || timeout=="" || typeof(timeout)=="undefined") ? 10000 : timeout;
        successfn   = successfn || function(){};
        errorfn     = errorfn || function(){};
        $.ajax({
            type: type,
            cache:false,//不会从浏览器缓存中获取信息
            async: async,
            data: data,
            url: url,// + "?_t=" + new Date().getTime()
            dataType: dataType,
            timeout:timeout,
            success: function(d){
                successfn(d);
            },
            error: function(err){
                errorfn(err);
            }
        });
    },

    /**
     * 字符串转数组
     *
     * @param str
     * @returns {Array}
     */
    str2arr: function (str, is_int) {
        var arr = [];

        if(typeof str == 'string'){
            var str_arr = str.split(',');

            for(var i in str_arr){
                arr.push((is_int ? parseInt(str_arr[i]) : str_arr[i]));
            }
        }

        return arr;
    },
    /**
     * 获取表单json数组
     *
     * @param form
     * @returns {{}}
     */
    obj2json: function(form_obj){
        var o = {};

        $.each(form_obj, function () {
            if (o[this.name] !== undefined) {
                if (!o[this.name].push) {
                    o[this.name] = [o[this.name]];
                }
                o[this.name].push(this.value || '');
            } else {
                o[this.name] = this.value || '';
            }
        });
        return o;
    },

    /**
     * json to string
     *
     * @param o
     * @returns {*}
     */
    obj2str:function(o) {
        var r = [];
        if(typeof o =="string") return "\""+o.replace(/([\'\"\\])/g,"\\$1").replace(/(\n)/g,"\\n").replace(/(\r)/g,"\\r").replace(/(\t)/g,"\\t")+"\"";
        if(typeof o == "object"){
            if(!o.sort){
                for(var i in o)
                    r.push(i+":"+$.xy.obj2str(o[i]));
                if(!!document.all && !/^\n?function\s*toString\(\)\s*\{\n?\s*\[native code\]\n?\s*\}\n?\s*$/.test(o.toString)){
                    r.push("toString:"+o.toString.toString());
                }
                r="{"+r.join()+"}"
            }else{
                for(var i =0;i<o.length;i++) {
                    r.push($.xy.obj2str(o[i]));
                }
                r="["+r.join()+"]"
            }
            return r;
        }
        return o.toString();
    },
    /**
     * json 字符串转换
     *
     * @param data
     * @returns {*}
     */
    jsonEval:function(data) {
        try{
            if ($.type(data) == 'string'){
                return eval('(' + data + ')');
            }else{
                return data;
            }
        } catch (e){
            $.xy.debug('上传配置信息错误');
            return {};
        }
    },
    /**
     * ajax 统一错误方法
     * @param xhr
     * @param ajaxOptions
     * @param thrownError
     */
    ajaxError:function(xhr, ajaxOptions, thrownError){
        //阻塞结束,释放disabled
        $('.submit_btn').button('reset');
        alert("Http status: " + xhr.status + " " + xhr.statusText + "\najaxOptions: " + ajaxOptions + "\nthrownError:"+thrownError + "\n" +xhr.responseText);
    },
    /**
     * ajax 统一完成提交方法
     *
     * @param json
     */
    ajaxDone:function(json){
        //阻塞结束,释放disabled
        $('.submit_btn').button('reset');
        $.xy.debug(json);
        if(json[$.xy.keys.code] == $.xy.statusCode.failed) {

            if(json[$.xy.keys.msg] != 'quiet') {
                alert('提示：' + json[$.xy.keys.msg]);
            }

            if(json.data){
                if(json.data['forward'] == 'reload'){
                    window.location.href    = window.location.href;
                }else{
                    if(json.data['forward'] != 'stop' && json.data['forward'] != ''){
                        window.location.href    = json.data['forward'];
                    }
                }
            }

        } else if (json[$.xy.keys.code] == $.xy.statusCode.nologin) {
            alert('登录失效，请先登录！');
            window.location.href = '/user/login';
        } else if (json[$.xy.keys.code] == $.xy.statusCode.warn) {
            alert('警告：'+json[$.xy.keys.msg]);

            if(json.data){
                if(json.data['forward'] == 'reload'){
                    window.location.href    = window.location.href;
                }else{
                    if(json.data['forward'] != 'stop' && json.data['forward'] != ''){
                        window.location.href    = json.data['forward'];
                    }
                }
            }
        }else if (json[$.xy.keys.code] == $.xy.statusCode.success){
            $.xy.debug(json);

            //是否开启安静模式,成功不弹窗直接跳转。
            if(json[$.xy.keys.msg] != 'quiet'){
                alert(json[$.xy.keys.msg]);
            }

            if(json.data){
                if(json.data['forward'] == 'reload'){
                    window.location.href    = window.location.href;
                }else{
                    if(json.data['forward'] != 'stop' && json.data['forward'] != ''){
                        window.location.href    = json.data['forward'];
                    }
                }
            }else{
                window.location.href    = "/";
            }
        };
    },

    /**
     * 上传插件
     */
    uploadifyInit: function () {
        $(":file[uploaderOption]").each(function () {
            var $this = $(this);

            var options = {
                fileObjName: $this.attr("name") || "file",
                auto: true,
                multi: true,
                // debug: true,
                onUploadError: uploadifyError
            };
            var uploaderOption = $.xy.jsonEval($this.attr("uploaderOption"));

            $.extend(options, uploaderOption);

            $this.uploadify(options);
        });
    },
    /**
     * 编辑器插件 初始化
     */
    ueditorInit: function () {
        $("[id^='ueditor']").each(function () {
            var id          = $(this).attr('id');

            var toolbars_id = $(this).attr('toolbars_id');
            var toolbars    = ['fullscreen', 'source', 'undo', 'redo', 'bold'];
            switch (toolbars_id){
                case 'image':
                    toolbars    = ['FullScreen', 'Source', 'Undo', 'Redo', 'Bold', 'simpleupload', 'insertvideo', 'justifyleft', 'justifyright', 'justifycenter', 'justifyjustify', 'forecolor', 'backcolor', 'test', 'indent'];
                    break;
            }

            var ue = UE.getEditor(id, {
                toolbars: [
                    toolbars
                ],
                autoHeightEnabled: true,
                autoFloatEnabled: true
            });

            if (toolbars_id == 'image'){
                UE.Editor.prototype._bkGetActionUrl = UE.Editor.prototype.getActionUrl;

                UE.Editor.prototype.getActionUrl = function (action) {
                    if (action == 'uploadimage') {
                        return 'http://'+$.xy.current_domain+'/Upload/httpUpload?type=ueditor';
                    } else {
                        return this._bkGetActionUrl.call(this, action);
                    }
                }
            }

            ue.ready(function() {
                //设置编辑器的内容
            });
        });
    },
    /**
     * 时间控件 初始化
     */
    WdatepickerInit: function () {
        $("input[id^='WdatePicker']").each(function () {
            var format      = $(this).attr('data-format');
            var min_date    = $(this).attr('data-min');
            var max_date    = $(this).attr('data-max');

            var data        = {};

            var time_str    = '';

            if(format){
                format  = format.replace('Y','yyyy');
                format  = format.replace('m','MM');
                format  = format.replace('d','dd');
                format  = format.replace('H','HH');
                format  = format.replace('i','mm');
                format  = format.replace('s','ss');

                data.dateFmt    = format;
            }

            if(min_date){
                data.minDate    = min_date;
            }

            if(max_date){
                data.maxDate    = max_date;
            }

            $(this).click(function () {
                WdatePicker(data);
            });
        });
    },
    /**
     * 动态图表控件 初始化
     */
    highchartsInit: function () {
        $("div[id^=Highcharts]").each(function () {

            var id      = $(this).attr('id');
            var title   = $(this).attr('data-title');

            var x       = $.xy.str2arr($(this).attr('data-x'), false) || [];

            var y       =  $.xy.str2arr($(this).attr('data-y'), true) || [];

            var series  =  $.xy.str2arr($(this).attr('data-series'), true) || [];

            $.xy.debug(x);
            $.xy.debug(y);
            $.xy.debug(series);

            if(id){
                if($(this).attr('data-series')){
                    $('#'+id).highcharts({
                        title: {text: title,x: -20},
                        subtitle: {text: '',x: -20},
                        xAxis: {categories: x},
                        yAxis:[
                            {title: {text:title},min:0, plotLines: [{value: 0,width: 1,color: '#808080'}]},
                            {min:0, title: {text:title},opposite: true}
                        ],
                        legend: {layout: 'vertical',align: 'right',verticalAlign: 'middle', borderWidth: 0},
                        credits: {enabled:true,text:'xyzs.com',href:'http://dev.xyzs.com'},
                        series: series
                    });
                }else{
                    $('#'+id).highcharts({
                        title: {text: title,x: -20},
                        subtitle: {text: '',x: -20},
                        xAxis: {categories: []},
                        yAxis: {
                            title: {text: title},
                            plotLines: [{value: 0,width: 1,color: '#808080'}]
                        },
                        legend: {layout: 'vertical',align: 'right',verticalAlign: 'middle',borderWidth: 0},
                        credits: {enabled: true,text: 'xyzs.com',href: 'http://dev.xyzs.com'},
                        series: [{name: title,data: []}]
                    });

                    var chart = $('#'+id).highcharts();
                    chart.series[0].setData(y);
                    chart.xAxis[0].setCategories(x);
                }
            }
        });
    },
    /**
     * 引入静态文件
     */
    includePath: 'http://pic.xyzs.com/v3/dev/plug/',
    include: function(file, callback)
    {
        var callback    = callback || function(){};

        var files = typeof file == "string" ? [file] : file;
        for (var i = 0; i < files.length; i++)
        {
            var name = files[i].replace(/^\s|\s$/g, "");
            var att = name.split('.');
            var ext = att[att.length - 1].toLowerCase();

            if(ext == 'css'){
                $.xy.includeCss($.xy.includePath + name, (i==files.length - 1 ? callback : null));
            }

            if(ext == 'js'){
                $.xy.includeJs($.xy.includePath + name,  (i==files.length - 1 ? callback : null));
            }
        }
    },
    /**
     *
     * 判断参数类型
     * createTime: 2013/9/18
     *
     */
    includeCallBackType: function (obj) {
        var classTypes, objectTypes;
        if ( obj == null ) {
            return String(obj);
        }
        classTypes = {};
        objectTypes = ('Boolean Number String Function Array Date RegExp Object Error').split(' ');
        for ( var i = 0, len = objectTypes.length; i < len; i++ ) {
            classTypes[ '[object ' + objectTypes[i] + ']' ] = objectTypes[i].toLowerCase();
        }
        if ( typeof obj === 'object' || typeof obj === 'function' ) {
            var key = Object.prototype.toString.call(obj);
            return classTypes[key];
        }
        return typeof obj;
    },

    /**
     * css按需加载
     *
     * @param cssUrl
     * @param callback
     * @returns {string|String}
     */
    includeCss: function (cssUrl, callback) {
        var elem, bl,
            isExecuted = false; // 防止在ie9中，callback执行两次
        if ( cssUrl == null ) {
            return String(cssUrl);
        }
        elem = document.createElement('link'),
            elem.rel = 'stylesheet';
        if ( $.xy.includeCallBackType(callback) === 'function' )  {
            bl = true;
        }
        // for ie
        function handle() {
            if ( elem.readyState === 'loaded' || elem.readyState === 'complete' ) {
                if (bl && !isExecuted) {
                    callback();
                    isExecuted = true;
                }
                elem.onreadystatechange = null;
            }
        }
        elem.onreadystatechange = handle;
        // for 非ie
        if (bl && !isExecuted) {
            elem.onload = callback;
            isExecuted = true;
        }
        elem.href = cssUrl;
        document.getElementsByTagName('head')[0].appendChild(elem);
    },
    /**
     * js按需加载
     *
     * @param scriptUrl
     * @param callback
     * @returns {string|String}
     */
    includeJs: function (scriptUrl, callback) {
        var elem, bl,
            isExecuted = false; // 防止在ie9中，callback执行两次
        if (scriptUrl == null) {
            return String(fn);
        }
        elem = document.createElement('script');
        if ( $.xy.includeCallBackType(callback) === 'function' )  {
            bl = true;
        }
        // for ie
        function handle(){
            var status = elem.readyState;
            if (status === 'loaded' || status === 'complete') {
                if (bl && !isExecuted) {
                    callback();
                    isExecuted = true;
                }
                elem.onreadystatechange = null;
            }
        }
        elem.onreadystatechange = handle;
        // for 非ie
        if (bl && !isExecuted) {
            elem.onload = callback;
            isExecuted = true;
        }
        elem.src = scriptUrl;
        document.getElementsByTagName('head')[0].appendChild(elem);
    },
    /**
     * 引入 Ueditor
     */
    includeUeditor: function () {
        if($("[id^='ueditor']").length > 0){
            $.xy.include(['ueditor-utf8/ueditor.config.js','ueditor-utf8/ueditor.all.js'], function () {
                $.xy.ueditorInit();
            });//,'lang/zh-cn/zh-cn.js'
        }
    },
    /**
     * 引入 Wdatepicker
     */
    includeWdatepicker: function () {
        if($("input[id^='WdatePicker']").length > 0){
            $.xy.include('datepicker/Wdatepicker.js', function () {
                $.xy.WdatepickerInit();
                $.xy.include('datepicker/common.css',function () {});//加载修改时间选择框样式
            });
        }
    },
    /**
     * 引入 uploadify
     */
    includeUploadify: function () {
        if($(":file[uploaderOption]").length > 0){
            $.xy.include(['uploadify/uploadify.css', 'uploadify/common.css', 'uploadify/jquery.uploadify.js'], function(){
                $.xy.uploadifyInit();
            });
        }
    },
    /**
     * 引入 uploadify
     */
    includeHighcharts: function () {
        if($("div[id^=Highcharts]").length > 0){
            $.xy.include(['highcharts/js/highcharts.js'], function(){
                $.xy.include(['highcharts/js/modules/exporting.js'], function () {
                    $.xy.highchartsInit();
                });
            });
        }
    },
    /**
     * 初始化 设置
     *
     * @param options
     */
    init:function(options){
        var op = $.extend({
            callback:null,
            debug:false,
            statusCode:{},
            keys:{}
        }, options);

        this._set.debug = op.debug;

        $.extend($.xy.statusCode, op.statusCode);
        $.extend($.xy.keys, op.keys);

        if (jQuery.isFunction(op.callback)) op.callback();
    }
};

;(function($){
    var defaultSettings = {
        version         : '0.0.1'
    };
    /**
     * 公用插件开发
     */
    $.fn.extend({
        /**
         * 表单验证提交
         *
         * @param options
         * @returns {*}
         */
        formTodo: function(options){
            var functionSettings = {};

            var settings = $.extend({}, defaultSettings, functionSettings, options || {});

            return this.each(function(){

                var obj                 = $(this);
                var form                = obj.parents('form');
                var callback            = settings.callback || function(){return true};
                var submitCallback      = settings.submitCallback || $.xy.ajaxDone;

                obj.click(function(e){
                    var url     = form.attr('action');
                    var method  = form.attr('method');
                    var data    = $.xy.obj2json($('#'+form.attr('id')).serializeArray());

                    $.xy.debug(url);
                    $.xy.debug(method);
                    $.xy.debug(data);

                    if(url.isEmpty()){
                        alert('请求地址不能为空');return false;
                    }

                    if(method.isEmpty()){
                        alert('请求方式不能为空');return false;
                    }


                    if(callback(url, method, data)){

                        $.xy.debug(url);
                        $.xy.debug(method);
                        $.xy.debug(data);

                        //防止表单重复提交
                        $('.submit_btn').button('loading');
                        $.xy.request(url, data, method, null, null,null,
                            submitCallback,
                            $.xy.ajaxError
                        );
                    }
                    e.preventDefault();
                });
                return false;
            });
        },

        /**
         * a 标签 点击提交
         *
         * @param options
         * @returns {*}
         */
        ajaxTodo: function (options) {
            var functionSettings = {};

            var settings = $.extend({}, defaultSettings, functionSettings, options || {});

            return this.each(function(){

                var obj                 = $(this);

                var submitCallback      = settings.submitCallback || $.xy.ajaxDone;

                obj.click(function(e){
                    var url         = obj.attr('href') || null;

                    if(url == null || url == '' || url == undefined){
                        $.xy.debug('请求地址不能为空');
                        return false;
                    }

                    if (confirm("您确定要提交当前操作吗？"))  {
                        $.xy.request(url, {}, 'get', null, null,null,
                            submitCallback,
                            $.xy.ajaxError
                        );
                    }

                    return false;
                });
            });
        }
    });

    /**
     * 扩展String方法
     * str.isEmpty();
     */
    $.extend(String.prototype, {
        isEmpty:function () {
            if(this == undefined){
                return true;
            }
            return (new RegExp(/^\s*$/g).test(this));
        },
        isPositiveInteger:function(){
            return (new RegExp(/^[1-9]\d*$/).test(this));
        },
        isInteger:function(){
            return (new RegExp(/^\d+$/).test(this));
        },
        isNumber: function() {
            return (new RegExp(/^-?(?:\d+|\d{1,3}(?:,\d{3})+)(?:\.\d+)?$/).test(this));
        },
        trim:function(){
            return this.replace(/(^\s*)|(\s*$)|\r|\n/g, "");
        },
        startsWith:function (pattern){
            return this.indexOf(pattern) === 0;
        },
        endsWith:function(pattern) {
            var d = this.length - pattern.length;
            return d >= 0 && this.lastIndexOf(pattern) === d;
        },
        replaceSuffix:function(index){
            return this.replace(/\[[0-9]+\]/,'['+index+']').replace('#index#',index);
        },
        trans:function(){
            return this.replace(/&lt;/g, '<').replace(/&gt;/g,'>').replace(/&quot;/g, '"');
        },
        encodeTXT: function(){
            return (this).replaceAll('&', '&amp;').replaceAll("<","&lt;").replaceAll(">", "&gt;").replaceAll(" ", "&nbsp;");
        },
        replaceAll:function(os, ns){
            return this.replace(new RegExp(os,"gm"),ns);
        },
        replaceTm:function($data){
            if (!$data) return this;
            return this.replace(RegExp("({[A-Za-z_]+[A-Za-z0-9_]*})","g"), function($1){
                return $data[$1.replace(/[{}]+/g, "")];
            });
        },
        replaceTmById:function(_box){
            var $parent = _box || $(document);
            return this.replace(RegExp("({[A-Za-z_]+[A-Za-z0-9_]*})","g"), function($1){
                var $input = $parent.find("#"+$1.replace(/[{}]+/g, ""));
                return $input.val() ? $input.val() : $1;
            });
        },
        isFinishedTm:function(){
            return !(new RegExp("{[A-Za-z_]+[A-Za-z0-9_]*}").test(this));
        },
        skipChar:function(ch) {
            if (!this || this.length===0) {return '';}
            if (this.charAt(0)===ch) {return this.substring(1).skipChar(ch);}
            return this;
        },
        isValidPwd:function() {
            return (new RegExp(/^([_]|[a-zA-Z0-9]){6,32}$/).test(this));
        },
        isValidMail:function(){
            return(new RegExp(/^\w+((-\w+)|(\.\w+))*\@[A-Za-z0-9]+((\.|-)[A-Za-z0-9]+)*\.[A-Za-z0-9]+$/).test(this.trim()));
        },
        isSpaces:function() {
            for(var i=0; i<this.length; i+=1) {
                var ch = this.charAt(i);
                if (ch!=' '&& ch!="\n" && ch!="\t" && ch!="\r") {return false;}
            }
            return true;
        },
        isPhone:function() {
            return (new RegExp(/^(((13[0-9]{1})|(15[0-9]{1})|(18[0-9]{1})|170|176|177|178|145|147)+\d{8})$/).test(this));
        },
        isUrl:function(){
            return (new RegExp(/^[a-zA-z]+:\/\/([a-zA-Z0-9\-\.]+)([-\w .\/?%&=:]*)$/).test(this));
        },
        isQQ:function(){
            return (new RegExp(/^[1-9]\d{4,12}$/).test(this));
        },
        isExternalUrl:function(){
            return this.isUrl() && this.indexOf("://"+document.domain) == -1;
        }
    });

    //ajax submit 操作
    $('._ajax_submit').ajaxTodo({
        submitCallback:function(ret){
            if(ret.code == 200){
                alert(ret.msg);
                if(ret.data){
                    if(ret.data.forward){
                        window.location.href=ret.data.forward;
                    }
                }else{
                    window.location.href= "/";
                }
            }else{
                alert(ret.msg);
            }
        }
    });
})(jQuery);

/**
 * uploadify 开始上传前的方法
 *
 * @param file
 */
function uploadifyStart(file){
    //console.log(file)
}

/**
 * uploadify 上传完成方法
 *
 * @param queueData
 */
function uploadifyQueueComplete(queueData){

    var msg = "The total number of files uploaded: "+queueData.uploadsSuccessful+"<br/>"
        + "The total number of errors while uploading: "+queueData.uploadsErrored+"<br/>"
        + "The total number of bytes uploaded: "+queueData.queueBytesUploaded+"<br/>"
        + "The average speed of all uploaded files: "+queueData.averageSpeed;

    //console.log(msg)
}

/**
 * uploadify 上传成功方法
 *
 * @param file
 * @param data
 * @param response
 */
function uploadifySuccess(file, data, response){
    // console.log(file)
    var json    = $.xy.jsonEval(data);
    $.xy.debug(json);
    if(json[$.xy.keys.code] == $.xy.statusCode.success){
        var obj     = $('input[name='+json['data']['input_name']+']');

        var pObj    = obj.parents('.result')

        var old_src = obj.val();

        obj.val(json.data.url);

        pObj.find('.red_tips').css({'color':'green'}).text('已上传成功').fadeOut("slow");

        //图片上传
        pObj.find('img').attr('src', json.data.url);

        pObj.find('.zhizhao_box').find('._to_back').attr('data-src', old_src);

        pObj.find('.zhizhao_box').show();
    }else{
        alert(json.msg);
    }
    // console.log(response)
}

/**
 * uploadify 上传错误方法
 *
 * @param event
 * @param queueId
 * @param fileObj
 * @param errorObj
 */
function uploadifyError(event, queueId, fileObj, errorObj){
    console.log("event:" + event + "\nqueueId:" + queueId + "\nfileObj.name:"
        + fileObj.name + "\nerrorObj.type:" + errorObj.type + "\nerrorObj.info:" + errorObj.info);
}
