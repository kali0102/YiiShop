<script type="text/javascript" charset="utf-8">
    wx.config(<?php echo $js->config(['onMenuShareTimeline'], false) ?>);
</script>
<div class="wechat-default-index">
    <h1><?= $this->context->action->uniqueId ?></h1>
    <p>
        This is the view content for action "<?= $this->context->action->id ?>".
        The action belongs to the controller "<?= get_class($this->context) ?>"
        in the "<?= $this->context->module->id ?>" module.
    </p>
    <p>
        You may customize this page by editing the following file:<br>
        <code><?= __FILE__ ?></code>
    </p>
</div>


<div> <i id="sale-price">100</i> 元</div>

<script type="text/javascript">
    wx.ready(function () {
        wx.onMenuShareTimeline({
            title: '测试的标题', // 分享标题
            link: 'http://www.baidu.com', // 分享链接
            imgUrl: 'https://res.wx.qq.com/mpres/htmledition/images/bg/bg_logo2491a6.png', // 分享图标
            success: function () {
                // 用户确认分享后执行的回调函数
//                alert('share ok');
                $("#sale-price").html(90);
            },
            cancel: function () {
                // 用户取消分享后执行的回调函数
                alert('share cancel');
            }
        });
    });
</script>