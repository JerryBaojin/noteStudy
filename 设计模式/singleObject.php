<?php
!isset($_GET['openid'])?header("location:index.php"):$openid=$_GET['openid'];
require_once "jssdk.php";
$jssdk = new JSSDK("wx6f1fa092a4f5e263","51eb6b33ee16bfa2e213c037f9d4c4f8");
$signPackage = $jssdk->GetSignPackage();
?>
<!doctype html>
<html style="height:100%;">
<head>
<meta charset="utf-8">
<title>确认订单</title>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
<meta name="format-detection" content="telephone=no">
<meta name="renderer" content="webkit">
<meta http-equiv="Cache-Control" content="no-siteapp" />
<link rel="stylesheet" href="css/amazeui.min.css"/>
<link rel="stylesheet" href="css/style.css"/>
<script src="js/jquery.min.js"></script>
<script src="js/amazeui.min.js"></script>
<script>
var datas=sessionStorage.getItem("purchaseItems");
datas==null?location.href="index.php":sessionStorage.removeItem("purchaseItems");
datas=JSON.parse(datas);
</script>
</head>

<body style="height:100%;">
<div class="container">
    <div class="am-cf cart-panel">
    	<div class="cart-list-panel">
            <ul class="am-avg-sm-1 cart-panel-ul">

                 <li>
                	<div class="imgpanel"><a href="#"><img src="img/2.jpg" class="am-img-responsive" /></a></div>
                	<div class="infopanel">
                    	<h3><a href="#">内江日报</a><span class="am-fr"><a class="am-badge am-badge-danger am-round">删除</a></span></h3>
                        <p>价格：<span class="red2 bold">32</span> 元  X <input id="ribao" class="am-input-sm txt-qty" type="number" data-p="32" value="1" min="0"/> 月
                							X <input id="Cribao" class="am-input-sm txt-qty" type="number"  value="1" min="1"/> 份
                						</p>
                        <!-- <p>运费：<span class="red2 bold">3</span> 元</p> -->
                    </div>
                </li>

                 <li>
                	<div class="imgpanel"><a href="#"><img src="img/3.jpg" class="am-img-responsive" /></a></div>
                	<div class="infopanel">
                    	<h3><a href="#">内江晚报</a><span class="am-fr"><a class="am-badge am-badge-danger am-round">删除</a></span></h3>
                        <p>价格：<span class="red2 bold">24</span> 元  X <input id="wanbao" class="am-input-sm txt-qty" type="number" min="0" data-p="24" value="1" />月
                							X <input id="Cwanbao" class="am-input-sm txt-qty" type="number"  value="1" min="1"/> 份
                						</p>
                      <p>运费：<span class="red2 bold">3</span> 元</p>
                    </div>
                </li>
            </ul>
        </div>
    </div>
    <div class="am-u-sm-12">
    <div class="cart_foot" style="font-size: 20px;">
	<!-- 共选中<span class="red2 bold" id="total_good">2</span>种商品 -->
	总价：<span class="red2 bold" id="total_amount">62</span>元</div>
    <div class="cart-tool">
    	<!-- <a class="am-btn am-btn-sm am-btn-success" href="index.php">
    	          <i class="am-icon-chevron-left"></i>
    	          返回
    	        </a> -->
        <span id="confirm" class="am-btn am-btn-sm am-btn-warning" >
          <i  class="am-icon-shopping-cart"></i>
          结账
        </span>
    </div>
    </div>
</div>
<style>
	#confirm{
	margin: 0 auto;
    display: block;
    width: 65%;

    height: 47px;
    line-height: 31px;
	}
</style>
<script>
$(function(){
	if(parseInt($(window).width())<400){
    	$(".imgpanel").css(
    		{
    		"padding":"12px 5px 0 0",
    			"width":"100px"
    	}
    	);
      $(".cart-panel").css("padding","0");
}

	$("footer").css("top",$(window).height()*0.95+"px");
		$("#ribao").val(datas.infos.ribao.times);
		$("#wanbao").val(datas.infos.wanbao.times);
		redate();
	$(".am-badge-danger").on("click",function(){
		$(this).parent("span").parent("h3").parent("div").parent("li").remove();
		$("#total_good").html($(".cart-list-panel li").length);
		redate();
	})

	$(".cart-list-panel input").on("keyup",function(){

    if($(this).val().split(".").length>1){
      $(this).val(1);
    }
		$(this).val()<=-1?$(this).val(1):null;
		redate();

	})
	var types="内江日报,内江晚报";

	function redate(){
		var total=0;
		$(".infopanel").map(function(v,k){
			 total+=parseInt($(this).find("p input")[0].value)*parseInt($(this).find("p span")[0].innerHTML)*parseInt($(this).find("p input")[1].value);
		})

		if(!isNaN(total)){
			$("#total_amount").html(total);
		}
	}

	$("#confirm").on("click",function(){

		if($("#ribao").length==0){
			datas.infos.ribao.counts=0;
			datas.infos.ribao.money=0;
			datas.infos.ribao.times=0;
		}else{
			datas.infos.ribao.counts=parseInt($("#Cribao").val());
			datas.infos.ribao.times=parseInt($("#ribao").val());
			datas.infos.ribao.money=parseInt($("#ribao").val())*parseInt($("#Cribao").val())*32;
		}


		if($("#wanbao").length==0){
			datas.infos.wanbao.counts=0;
			datas.infos.wanbao.money=0;
			datas.infos.wanbao.times=0;
		}else{
			datas.infos.wanbao.counts=parseInt($("#Cwanbao").val());
			datas.infos.wanbao.times=parseInt($("#wanbao").val());
			datas.infos.wanbao.money=parseInt($("#wanbao").val())*parseInt($("#wanbao").val())*24;
		}
		delete datas.ribao;
		delete datas.wanbao;
		delete datas.types;
		/*
		var datas={
		"openid":"<?php echo $openid;?>",
		"types":types,
		"ribao":r,
		"wanbao":w,
		"countsMoney":$("#total_amount").html()
		};
		*/
		console.log(datas);

		if($("#total_amount").html()=='0'){
			return false;
		}
		window.sessionStorage.setItem("purchaseItems",JSON.stringify(datas));

		location.href="confirm.php";
	})
})
</script>
<footer style="text-align:center;">技术支持:内江日报融媒应用部</footer>
<style>
body{
	position:relative;
}
footer{

    left: 0;
    right: 0;
	position:absolute;
	}
</style>
<script src="http://res.wx.qq.com/open/js/jweixin-1.2.0.js"></script>
<script>
	wx.config({
		debug: false,
		appId: '<?php echo $signPackage["appId"];?>',
		timestamp: <?php echo $signPackage["timestamp"];?>,
		nonceStr: '<?php echo $signPackage["nonceStr"];?>',
		signature: '<?php echo $signPackage["signature"];?>',
		jsApiList: [
			'onMenuShareTimeline',
			'onMenuShareAppMessage',
			'onMenuShareQQ',
			'onMenuShareWeibo',
			'onMenuShareQZone'
		]
	});
	var sharelink = "http://weixin.scnjnews.com/dailyPaper" ;//分享跳转地址
</script>
<script src="js/share.js"></script>
</body>
</html>
