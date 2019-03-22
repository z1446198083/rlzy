//移入清除定时器
$('.swipe').mouseenter(function() {
	clearInterval(timer);
});
$('.swipe').mouseleave(function() {
	timer = setInterval(function() {
		index++;
		if(index > 3) {
			index = 0;
		}
		$('.item').eq(index).fadeIn().siblings().fadeOut();
		$('.tab-btn .btn').eq(index).addClass('active').siblings().removeClass('active');
	}, 2000)
})

var index = 0;
//小圆点事件
$('.tab-btn .btn').click(function() {
	index = $(this).index();
	$(this).addClass('active').siblings().removeClass('active');
	$('.item').eq(index).fadeIn().siblings().fadeOut();
});
//箭头点击事件
$('.lr-tab .you-btn').click(function() {
	index++;
	if(index > 3) {
		index = 0;
	}
	$('.item').eq(index).fadeIn().siblings().fadeOut();
	$('.tab-btn .btn').eq(index).addClass('active').siblings().removeClass('active');
});
//左点击事件
$('.lr-tab .zuo-btn').click(function() {
	index--;
	if(index < 0) {
		index = 3;
	}
	$('.item').eq(index).fadeIn().siblings().fadeOut();
	$('.tab-btn .btn').eq(index).addClass('active').siblings().removeClass('active');
});

//定时器
var timer = setInterval(function() {
	index++;
	if(index > 4) {
		index = 0;
	}
	$('.item').eq(index).fadeIn().siblings().fadeOut();
	$('.tab-btn .btn').eq(index).addClass('active').siblings().removeClass('active');
}, 2000)

//关闭广告
$('.advertising-p').click(function(){
	$('.advertising').hide();
});

//屏蔽f12
//document.onkeydown = function(){
//
//  if(window.event && window.event.keyCode == 123) {
//      alert("F12被禁用");
//      event.keyCode=0;
//      event.returnValue=false;
//  }
//  if(window.event && window.event.keyCode == 13) {
//      window.event.keyCode = 505;
//  }
//  if(window.event && window.event.keyCode == 8) {
//      alert(str+"\n请使用Del键进行字符的删除操作！");
//      window.event.returnValue=false;
//  }
//
//}

