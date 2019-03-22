<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>

	<head>
		<meta charset="UTF-8">
		<title></title>
		<link rel="stylesheet" type="text/css" href="/theme/home/css/index.css"/>
	</head>

	<body>
		<div class="app">
			<!--头部-->
			
<div class="nav">
    <div class="nav-warp">
        <div class="nav-left">
            <p>欢迎来到<?php echo ($site_name); ?>~</p>
        </div>
        <div class="nav-right">
            <img src="/theme/home/img/DH.png" />
            <p><a href="javascript:" onclick="setHome(this,window.location);">设为首页</a></p>
            <img src="/theme/home/img/收藏.png" />
            <p><a href="javascript:" onclick="shoucang(document.title,window.location);">加入收藏</a></p>
            <img src="/theme/home/img/wx.png" />
            <p><a href="">关注微信</a></p>
        </div>
    </div>
</div>

<!--logo-->
<div class="logo">
    <div class="logo-warp">
        <div class="logo-warp-left"><img src="<?php echo attach($logo, 'logo');?>" /></div>
        <div class="logo-warp-right">
            <p>欢迎来到<?php echo ($site_name); ?>，你是第<span><?php echo ($number["number"]); ?></span>个访问我们网站的人哦！</p>
        </div>
    </div>
</div>

<!--导航栏-->
<div class="navigation">
    <div class="navigation-warp">
<ul>
        <?php if(is_array($ar_cate)): $i = 0; $__LIST__ = $ar_cate;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li>
            <a href=""><?php echo ($vo["name"]); ?></a>
            <ul>
                <?php if(is_array($article_erji)): $i = 0; $__LIST__ = $article_erji;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i; if($vo['id'] == $v['pid']): ?><li>
                    <a href="#"><?php echo ($v["name"]); ?></a>
                </li><?php endif; endforeach; endif; else: echo "" ;endif; ?>
            </ul>
        </li><?php endforeach; endif; else: echo "" ;endif; ?>
</ul>
    </div>
</div>

			<!--头部-->
			<!--轮播-->
			<div class="swipe">
				<div class="swipe-warp">
					<ul>
						<?php if(is_array($banner)): $i = 0; $__LIST__ = $banner;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li class="item" style="display: block;">
							<img src="<?php echo attach($vo['content'], 'banner');?>" />
						</li><?php endforeach; endif; else: echo "" ;endif; ?>
					</ul>
				</div>

				<!--左右点击事件-->
				<div class="lr-tab">
					<img src="/theme/home/img/zuo1.png" alt="" class="zuo-btn">
					<img src="/theme/home/img/you1.png" alt="" class="you-btn">
				</div>

				<!--小圆点-->
				<div  class="tab-btn">
					<ul>
						<li class="btn active"></li>
						<?php $__FOR_START_10101__=1;$__FOR_END_10101__=$count_banner;for($i=$__FOR_START_10101__;$i < $__FOR_END_10101__;$i+=1){ ?><li class="btn"></li><?php } ?>
					</ul>
				</div>

				<!--广告-->
				<div class="advertising">
					<!--<p style="float: right;margin-right: 10px;" class="advertising-p">X</p>-->
					<div class="advertising-warp">
						<img src="<?php echo attach($qr, 'logo');?>" />
						<span>扫码关注微信号</span>
					</div>
					<div class="advertising-bottom">
						<ul>
							<li><img src="/theme/home/img/qq(1).png" />
								<p><a href="tencent://message/?uin=<?php echo ($qq); ?>&Site=qq&Menu=yes">QQ在线</a></p>
							</li>
							<li><img src="/theme/home/img/dianh.png" />
								<p><?php echo ($tel); ?></p>
							</li>
						</ul>
					</div>
				</div>
			</div>

			<!--网上报名-->
			<div class="registration">
				<div class="registration-warp">
					<div class="registration-title">
						<p style="background-color: #ff8284;"></p>
						<p style="background-color: #db3a4e;"></p>
						<h2><?php echo ($wsbm["name"]); ?></h2>
						<p style="background-color: #db3a4e;"></p>
						<p style="background-color: #ff8284;"></p>
						<span><?php echo ($wsbm["description"]); ?></span>
					</div>
					<div class="registration-introduce">
						<ul>
							<?php if(is_array($wsbm_ad)): $i = 0; $__LIST__ = $wsbm_ad;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li>
								<img src="<?php echo attach($vo['content'], 'banner');?>" />
								<h2><?php echo ($vo["name"]); ?></h2>
								<button><a href="">去报名</a></button>
							</li><?php endforeach; endif; else: echo "" ;endif; ?>
						</ul>
					</div>
				</div>
			</div>

			<!--名师团队-->
			<div class="Teacherteam">
				<div class="Teacherteam-warp">
					<div class="registration-title">
						<p style="background-color: #ff8284;"></p>
						<p style="background-color: #db3a4e;"></p>
						<h2><?php echo ($mstd["name"]); ?></h2>
						<p style="background-color: #db3a4e;"></p>
						<p style="background-color: #ff8284;"></p>
						<span><?php echo ($mstd["description"]); ?></span>
					</div>
					<div class="Teacherteam-team">
						<ul>
							<?php if(is_array($mstd_ad)): $i = 0; $__LIST__ = $mstd_ad;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li>
								<img src="<?php echo attach($vo['content'], 'banner');?>" <?php if($vo['extval'] == null): else: ?>  class="imgs"<?php endif; ?> >
								<p <?php if($vo['extval'] == null): else: ?>  class="images" style="top: 350px; background-color:#ca1635 ;;"<?php endif; ?>><?php echo ($vo["name"]); ?></p>
							</li><?php endforeach; endif; else: echo "" ;endif; ?>
						</ul>
					</div>
				</div>
			</div>

			<!--特色课程-->
			<div class="featurecourse">
				<div class="featurecourse-warp">
					<div class="registration-title">
						<p style="background-color: #ff8284;"></p>
						<p style="background-color: #db3a4e;"></p>
						<h2><?php echo ($tske["name"]); ?></h2>
						<p style="background-color: #db3a4e;"></p>
						<p style="background-color: #ff8284;"></p>
						<span><?php echo ($tske["description"]); ?></span>
					</div>
					<div class="featurecourse-course">
						<ul>
							<?php if(is_array($tskc_ad)): $i = 0; $__LIST__ = $tskc_ad;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li><img src="<?php echo attach($vo['content'], 'banner');?>" /></li><?php endforeach; endif; else: echo "" ;endif; ?>
						</ul>
					</div>
				</div>
			</div>

			<!--提交课程-->
				<div class="Submicourse">
					<div class="Submicourse-warp">
						<div class="Submicourse-title">
							<h2>还没有找到合适的课程？</h2>
							<p>赶快告诉我，让我们顾问马上联系您！省时又省力！</p>
						</div>
						<div class="Submicourse-input">
							<input type="text" name="" id="name" placeholder="*您的称呼" />
							<input type="text" name="" id="course" placeholder="*您的意向课程" />
							<input type="text" name="" id="mobile" placeholder="*您的手机号" />
							<input type="text" name="" id="content" placeholder="留言信息" />
							<button id="lytj">立即提交</button>
						</div>
					</div>
				</div>

			<!--新闻中心-->
			<div class="presscenter">
				<div class="presscenter-warp">
					<div class="registration-title">
						<p style="background-color: #ff8284;"></p>
						<p style="background-color: #db3a4e;"></p>
						<h2><?php echo ($xwzx["name"]); ?></h2>
						<p style="background-color: #db3a4e;"></p>
						<p style="background-color: #ff8284;"></p>
						<span><?php echo ($xwzx["alias"]); ?></span>
					</div>

					<div class="presscenter-genre">
						<ul>
							<?php if(is_array($xwzx_wz)): $i = 0; $__LIST__ = $xwzx_wz;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li>
								<img src="<?php echo attach($vo['img'], 'article');?>" />
								<div class="presscenter-genre-title">
									<p><?php echo ($vo["title"]); ?></p>
									<h4><?php echo date('Y-m-d',$vo['last_time']); ?></h4>
									<span><?php echo ($vo["intro"]); ?></span>
									<div class="presscenter-genre-border"></div>
								</div>
							</li><?php endforeach; endif; else: echo "" ;endif; ?>
						</ul>
					</div>
					<div class="presscenter-button">
						<button><a href="">查看更多</a></button>
					</div>
				</div>
			</div>
		</div>

		<!--尾部-->
		<div class="tail">
    <div class="tail-warp">
        <div class="tail-img">
            <img src="/theme/home/img/新职业培训网校.png" />
        </div>
        <div class="tail-title">
            <?php if(is_array($ar_cate)): $i = 0; $__LIST__ = $ar_cate;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><dl>
                <dt><a href=""><?php echo ($vo["name"]); ?></a></dt>
                <p>|</p>
            </dl><?php endforeach; endif; else: echo "" ;endif; ?>
            <div class="tail-right">
                <ul>
                    <li>
                        <img src="<?php echo attach($qr, 'logo');?>" />
                        <p>微信公众号</p>
                    </li>
                    <li>
                        <img src="/theme/home/img/wewm.png" />
                        <p>手机网站</p>
                    </li>
                </ul>

            </div>
            <div class="tail-tail">
                <p>地址：<?php echo ($address); ?></p>
                <p>电话：<?php echo ($tel); ?>    <?php echo ($mobile); ?></p>
                <p>邮编：330029  <?php echo ($title); ?>   <?php echo ($site_icp); ?> </p>
                <p>技术支持：嘉瑞科技</p>
            </div>





        </div>

    </div>
</div>
		<!--尾部-->
		<script type="text/javascript" src="/theme/home/js/jquery-1.8.3.min.js"></script>
		<script type="text/javascript" src="/theme/home/js/index.js"></script>
	</body>
<script type="text/javascript">
	$(function () {
		$('#lytj').click(function () {
		var name=$('#name').val(),
			course=$('#course').val(),
			mobile=$('#mobile').val(),
			content=$('#content').val();
			if (name == '') { //验证称呼不为空
				alert("请输入您的称呼");
				return false;
			} else if (course == '') { //验证课程不为空
				alert("请输入您的意向课程");
				return false;
			}else if (mobile == '') { //验证手机号不为空
				alert("请输入您的手机号");
				return false;
			}
				$.ajax({
				url: "<?php echo U('Index/index');?>",
				data: {name:name,course:course,mobile:mobile,content:content},
				type: "POST",
				dataType: "json",
				success:function(data) {
					if(data=='留言成功'){
						alert('留言成功,稍后我们将与您联系');
					}else if(data=='留言失败'){
						alert('留言失败,请联系在线客服');
					}
				}
			});
		});
	});
</script>
	<script>
		//设为首页
	function setHome(obj,vrl){
	try{
	obj.style.behavior='url(#default#homepage)';obj.setHomePage(vrl);
	}
	catch(e){
	if(window.netscape) {
	try {
	netscape.security.PrivilegeManager.enablePrivilege("UniversalXPConnect");
	}
	catch (e) {
	alert("此操作被浏览器拒绝！\n请在浏览器地址栏输入“about:config”并回车\n然后将 [signed.applets.codebase_principal_support]的值设置为'true',双击即可。");
	}
	var prefs = Components.classes['@mozilla.org/preferences-service;1'].getService(Components.interfaces.nsIPrefBranch);
	prefs.setCharPref('browser.startup.homepage',vrl);
	}else{
	alert("您的浏览器不支持，请按照下面步骤操作：1.打开浏览器设置。2.点击设置网页。3.输入："+vrl+"点击确定。");
	}
	}
	};
	//加入收藏
	function shoucang(sTitle,sURL) {
		try
		{
			window.external.addFavorite(sURL, sTitle);
		}
		catch (e)
		{
			try
			{
				window.sidebar.addPanel(sTitle, sURL, "");
			}
			catch (e)
			{
				alert("加入收藏失败，请使用Ctrl+D进行添加");
			}
		}
	}
	</script>
</html>