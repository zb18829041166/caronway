<script language="javascript" type="text/javascript">
	$(document).ready(function(){
		$('#nav-account').hover(function(){
			$('#nav-select').show();
		}).mouseleave(function(){
			$('#nav-select').hide();
		});
		
		$('#ewm-li').hover(function(){
			$('.ewm').show();
		}).mouseleave(function(){
			$('.ewm').hide();
		});
	});
</script>
<div class="header">
	<div class="common-width">
		<div class="logo"><img src="<?php echo defined('TLP')?TLP:'{__TLP__}';?>img/logo.png" align="bottom"> <span>会员中心</span></div>
		<div class="nav">
		<ul>
			<li><a href="<?php echo U(MOD,'i');?>">首页</a></li>
			<li id="nav-account"><a href="<?php echo U(MOD,'i');?>"><?php echo isset($PW['memberlogin']['username'])?$PW['memberlogin']['username']:'';?><em></em></a>
				<div id="nav-select">
					<p><a href="<?php echo U(MOD,'myamount');?>">我的余额</a></p>
					<p><a href="<?php echo U(MOD,'mycredits');?>">我的积分</a></p>
					<p><a href="<?php echo U(MOD,'account');?>">修改密码</a></p>
					<p><a href="<?php echo U(MOD,'logout');?>">退出</a></p>
				</div>
			</li>
			<?php $no=1;if(is_array($uc_module_list))foreach($uc_module_list as $r){?>
			<li><a href="<?php echo U($r['folder'],'i');?>"><?php echo isset($r['name'])?$r['name']:'';?></a></li>
			<?php $no++;}?>
			<?php if(phpWeChat\Module::isModuleInstalled('wechat') && $PW['wechat_qr']) { ?>
			<li id="ewm-li"><a href="javascript:void(0);"><img src="<?php echo defined('TLP')?TLP:'{__TLP__}';?>img/iphone_icon.png"> 微信公众号</a><img src="<?php echo isset($PW['wechat_qr'])?$PW['wechat_qr']:'';?>" class="ewm"></li>
			<?php }?>
		</ul>
		</div>
	</div>
</div>