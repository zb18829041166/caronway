<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>登录</title>
		<link rel="stylesheet" href="<?php echo defined('TLP')?TLP:'{__TLP__}';?>css/reset.css" />
		<link rel="stylesheet" href="<?php echo defined('TLP')?TLP:'{__TLP__}';?>css/common.css" />
		<script language="javascript" type="text/javascript">
			var PW_PATH='<?php echo defined('PW_PATH')?PW_PATH:'{__PW_PATH__}';?>';
		</script>
		<script src="<?php echo defined('PW_PATH')?PW_PATH:'{__PW_PATH__}';?>statics/jquery/jquery-1.12.2.min.js" language="javascript"></script>
		<script src="<?php echo defined('PW_PATH')?PW_PATH:'{__PW_PATH__}';?>statics/core.js" language="javascript"></script>
		<script language="javascript" type="text/javascript">
			$(document).ready(function(){
				$('#dosubmit').click(function(){
					
					$.post('<?php echo U(MOD,'login');?>', $("#login").serialize(), function(data) {
						if(data=='success')
						{
							showToast('登陆成功','<?php echo U(MOD,'i');?>');
						}
						else
						{
							msg=$("#"+data).attr("msg");
							
							showToast(msg,false);
						}
					});
				});
			});
		</script>
	</head>
	<body>
		<div class="wrap login_wrap">
			<div class="content">
				
				<div class="logo"></div>
				
				<div class="login_box">	
					
					<div class="login_form">
						<div class="login_title">
							登录
						</div>
						<form action="<?php echo U(MOD,'login');?>" name="login" id="login" method="post">
							<input type="hidden" value="1" name="dosubmit">
							<input type="hidden" value="<?php echo urlencode($redirect);?>" name="redirect">
							<div class="form_text_ipt">
								<input name="telephone" type="text" id="telephone" msg="请输入正确的手机号" placeholder="手机号">
							</div>
							<div class="form_text_ipt">
								<input name="password" type="password" id="password" msg="请输入正确的密码" placeholder="密码">
							</div>
							<!--<div class="form_text_ipt">-->
								<!--<img src="<?php echo defined('PW_PATH')?PW_PATH:'{__PW_PATH__}';?>api/captcha/index.php?t=<?php echo mt_rand();?>" id="captchaimg"  onClick="getCaptcha('captchaimg')" style="float:right;cursor:pointer; margin-right:3px; margin-top:3px">-->
								<!--<input name="checkcode" type="text" id="checkcode" msg="验证码不正确" placeholder="验证码" style="width:180px;">-->
							<!--</div>-->
							<div class="form_check_ipt">
								<div class="left check_left">
									<label><input name="autologin" type="checkbox"> 下次自动登录</label>
								</div>
								<div class="right check_right">
									<a href="<?php echo U(MOD,'getpwd');?>" target="_blank">忘记密码</a>
								</div>
							</div>
							<div class="form_btn">
								<button type="button" id="dosubmit">登录</button>
							</div>
							<div class="form_reg_btn">
								<span>还没有帐号？</span><a href="<?php echo U(MOD,'register',array('redirect'=>urlencode($redirect)));?>">马上注册</a>
							</div>
						</form>
						<div class="other_login">

						</div>
					</div>
				</div>
			</div>
		</div>
	</body>
</html>
