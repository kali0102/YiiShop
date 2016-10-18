<?php $this->registerJs('wx.config(' . $js->config(['onMenuShareTimeline']) . ',false)', \yii\web\View::POS_HEAD); ?>
<?php $this->beginBlock('wx-share') ?>
wx.ready(function () {
wx.onMenuShareTimeline({
title: '苹果7 Apple iPhone7 Plus 手机 玫瑰金色 移动联通电信4G 128GB ROM', // 分享标题
link: 'http://yiishop.fansye.com.cn/wechat', // 分享链接
imgUrl: 'http://img14.360buyimg.com/n1/s450x450_jfs/t3049/155/2035526566/192308/e352e450/57d8dd86N2c4b358a.jpg', // 分享图标
success: function () {
// 用户确认分享后执行的回调函数
$(".sale-price").text(6660);
},
cancel: function () {
// 用户取消分享后执行的回调函数
alert('取消分享');
}
});
});
<?php $this->endBlock() ?>
<?php $this->registerJs($this->blocks['wx-share'], \yii\web\View::POS_END); ?>

<br/>
<div class="row">
    <div class="col-sm-12">
        <div class="col-sm-12 col-md-12">
            <div class="thumbnail">
                <img data-src="holder.js/100%x200" alt="100%x200"
                     src="http://img14.360buyimg.com/n1/s450x450_jfs/t3049/155/2035526566/192308/e352e450/57d8dd86N2c4b358a.jpg"
                     data-holder-rendered="true" style="height: 240px; width: 100%; display: block;">
                <div class="caption">
                    <h3>苹果7 Apple iPhone7 Plus 手机 玫瑰金色 移动联通电信4G 128GB ROM</h3>
                    <p>现货销售！支持货到付款！苹果产品拆包与激活后，不支持七天无理由退换货！</p>
                    <p>
                    <h4>
                        <small>售价</small>
                        <span class="sale-price" style="color: red">7660</span>元 （<i style="color: red">分享立减1000元</i>）
                    </h4>
                    </p>
                    <p><a href="#" class="btn btn-default" role="button">立即购买</a></p>
                </div>
            </div>
        </div>
    </div>
</div>
