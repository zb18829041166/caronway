<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8"/>
<meta http-equiv="X-UA-Compatible" content="IE=edge, chrome=1" />
<title>会员中心</title>
<link href="<?php echo defined('TLP')?TLP:'{__TLP__}';?>css/i.css" type="text/css" rel="stylesheet" />

<script language="javascript" type="text/javascript">
	var PW_PATH='<?php echo defined('PW_PATH')?PW_PATH:'{__PW_PATH__}';?>';
</script>
<script src="<?php echo defined('PW_PATH')?PW_PATH:'{__PW_PATH__}';?>statics/jquery/jquery-1.12.2.min.js" language="javascript"></script>
<script src="<?php echo defined('PW_PATH')?PW_PATH:'{__PW_PATH__}';?>statics/core.js" language="javascript"></script>

</head>

<body>
<?php include template('header');?>
<div class="common-width" style="overflow:auto;">
	<div class="left-nav">
		<ul>
			<li><a href="<?php echo U(MOD,'i');?>">账号管理</a></li>
			<li class="hover"><a href="<?php echo U(MOD,'myaddress');?>">我的地址</a></li>
			<li><a href="<?php echo U(MOD,'setadmin');?>">我是专员</a></li>
			<?php if($userinfo['roleid']==7) { ?>
			<li><a href="<?php echo U(MOD,'managermember');?>">会员管理</a></li>
			<?php }?>
		</ul>
	</div>
	<div class="right-nav">
		<h1>账号管理</h1>
		<div class="desc">您当前的余额<span class="green">￥<?php echo isset($PW['memberlogin']['amount'])?$PW['memberlogin']['amount']:'';?></span>元，积分<span class="red"><?php echo isset($PW['memberlogin']['credits'])?$PW['memberlogin']['credits']:'';?></span>分</div>
		<table class="tablecss" cellpadding="1" cellspacing="1">
			<?php if($PW['memberlogin']['telephone']) { ?>
			<tr>
				<td width="15%">手机号码： </td>
				<td><?php echo isset($PW['memberlogin']['telephone'])?$PW['memberlogin']['telephone']:'';?></td>
			</tr>
			<?php }?>
			<?php if($PW['memberlogin']['email']) { ?>
			<tr>
				<td width="15%">邮箱： </td>
				<td><?php echo isset($PW['memberlogin']['email'])?$PW['memberlogin']['email']:'';?></td>
			</tr>
			<?php }?>
			<?php if($PW['memberlogin']['openid']) { ?>
			<tr>
				<td width="15%">微信OpenID： </td>
				<td><?php echo isset($PW['memberlogin']['openid'])?$PW['memberlogin']['openid']:'';?></td>
			</tr>
			<?php }?>
			<tr>
				<td>登录密码： </td>
				<td> ********** <a href="<?php echo U(MOD,'account');?>">修改密码</a></td>
			</tr>
			<tr>
				<td>上次登录： </td>
				<td> <?php if($PW['memberlogin']['logintime']) { ?><?php echo date('Y-m-d H:i:s',$PW['memberlogin']['logintime']);?><?php }else{ ?><?php echo date('Y-m-d H:i:s',$PW['memberlogin']['regtime']);?><?php }?> <a href="<?php echo U(MOD,'mylogin');?>">我的登录历史</a></td>
			</tr>
		</table>
	</div>
</div>

<?php include template('footer');?>
</body>
</html>
