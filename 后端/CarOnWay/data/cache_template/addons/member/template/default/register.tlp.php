<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>注册</title>
		<link rel="stylesheet" href="<?php echo defined('TLP')?TLP:'{__TLP__}';?>css/reset.css" />
		<link rel="stylesheet" href="<?php echo defined('TLP')?TLP:'{__TLP__}';?>css/common.css" />
		<script language="javascript" type="text/javascript">
			var PW_PATH='<?php echo defined('PW_PATH')?PW_PATH:'{__PW_PATH__}';?>';
		</script>
		<script src="<?php echo defined('PW_PATH')?PW_PATH:'{__PW_PATH__}';?>statics/jquery/jquery-1.12.2.min.js" language="javascript"></script>
		<script src="<?php echo defined('PW_PATH')?PW_PATH:'{__PW_PATH__}';?>statics/core.js" language="javascript"></script>
		<script language="javascript" type="text/javascript">
			<?php if(intval($PW['member_register_checktype'])) { ?>
			var wait=30; 
	
			function time() {  
	
				if (wait == 0) {  
	
					$('#djs').removeClass('r_inp_b_dis');
	
					$('#djs').attr("disabled",false);            
	
					$('#djs').text("获取验证码");  
	
					wait = 30;  
	
				} else {  
	
					$('#djs').attr("disabled", true);  
	
					$('#djs').text("重新发送(" + wait + ")");  
	
					wait--;  
	
					setTimeout(function() {  
	
						time();  
	
					},  
	
					1000) 
	
				}  
	
			}  
	
			<?php }?>
		
			$(document).ready(function(){
				<?php if(intval($PW['member_register_checktype'])) { ?>
				$('#djs').click(function(){
	
					if($('#djs').attr("disabled"))
	
					{
	
						return false;
	
					}
	
					else
	
					{
	
						$.post('<?php echo defined('SITE_URL')?SITE_URL:'{__SITE_URL__}';?>api/sms/index.php?telephone='+$("#telephone").val(), function(data) {
	
							if(data=='2')
	
							{
	
								$('#djs').addClass('r_inp_b_dis');
	
								time();
	
							}
	
							else
	
							{
	
								alert('短信发送失败，请重试['+data+']');
								return false;
							}
	
						});
	
						
	
					}
	
				});
	
				<?php }?>
			
				$('#dosubmit').click(function(){
					
					$.post('<?php echo U(MOD,'register');?>', $("#register").serialize(), function(data) {

						if(data=='success')
						{
							showToast('注册成功','<?php echo U(MOD,'login');?>');
						}
						else if(data<0)
						{
							if(data==-2 || data==-7)
							{
								alert('该手机号已注册');
								return false;
							}
							else
							{
								alert('错误异常，注册失败['+data+']');
								return false;
							}
						}
						else
						{
							msg=$("#"+data).attr("msg");
							alert(msg);
							return false;
						}
					});
				});
			});
		</script>
		
		<style type="text/css">
		.r_inp_b_dis{color:#999999 !important}
		</style>
	</head>
	<body>
		<div class="wrap login_wrap">
			<div class="content">
				
				<div class="logo"></div>
				
				<div class="login_box">	
					
					<div class="login_form">
						<div class="login_title">
							注册
						</div>
						<form action="<?php echo U(MOD,'register');?>" name="register" id="register" method="post">
							<input type="hidden" value="1" name="dosubmit">
							<input type="hidden" value="<?php echo urlencode($redirect);?>" name="redirect">
							<div class="form_text_ipt">
								<input name="telephone" id="telephone" msg="手机号不正确或已被注册" type="text" placeholder="手机号">
							</div>
							<div class="form_text_ipt">
								<input name="password" id="password" msg="密码由6-32位字符组成" type="password" placeholder="密码">
							</div>
							<div class="form_text_ipt">
								<input name="repassword" id="repassword" msg="两次密码输入不一致" type="password" placeholder="重复密码">
							</div>
							<?php if(intval($PW['member_register_checktype'])) { ?>
							<div class="form_text_ipt">
								<a style="float:right; cursor:pointer; margin-right:3px; margin-top:12px" href="javascript:void(0);" id="djs">获取验证码</a> 
								<input name="checkcode" id="checkcode" msg="验证码不正确" type="text" placeholder="验证码" style="width:180px;">
							</div>
							<?php }else{ ?>
							<div class="form_text_ipt">
								<img src="<?php echo defined('PW_PATH')?PW_PATH:'{__PW_PATH__}';?>api/captcha/index.php?t=<?php echo mt_rand();?>" id="captchaimg"  onClick="getCaptcha('captchaimg')" style="float:right; cursor:pointer; margin-right:3px; margin-top:3px">
								<input name="checkcode" id="checkcode" msg="验证码不正确" type="text" placeholder="验证码" style="width:180px;">
							</div>
							<?php }?>
							<div class="form_btn">
								<button type="button" id="dosubmit">注册</button>
							</div>
							<div class="form_reg_btn">
								<span>已有帐号？</span><a href="<?php echo U(MOD,'login',array('redirect'=>urlencode($redirect)));?>">马上登录</a>
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
