<?php
use phpWeChat\Member;
?>
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
<script language="javascript" type="text/javascript">
	$(document).ready(function(){
		
	});
</script>
</head>

<body>
<?php include template('header');?>
<div class="common-width" style="overflow:auto;">
	<div class="left-nav">
		<ul>
			<li class="hover"><a href="<?php echo U(MOD,'i');?>">账号管理</a></li>
			<li><a href="<?php echo U(MOD,'myaddress');?>">我的地址</a></li>
		</ul>
	</div>
	<div class="right-nav">
		<h1>我的登录历史</h1>
		<?php if($data) { ?>
		<table class="table-list-css" cellpadding="1" cellspacing="1">
			<tr>
				<th>登录时间</th>
				<th>登录IP</th>
				<th>登录环境</th>
			</tr>
			<?php $no=1;if(is_array($data))foreach($data as $r){?>
			<tr>
				<td><?php echo date('Y-m-d H:i:s',$r['logintime']);?></td>
				<td><?php echo isset($r['loginip'])?$r['loginip']:'';?></td>
				<td><?php echo isset($r['loginenv'])?$r['loginenv']:'';?></td>
			</tr>
			<?php $no++;}?>
		</table>
		<div class="page">
			<div class="wrap">
				<?php echo Member::$mPageString;?>
			</div>
		</div>
		<?php }else{ ?>
		<h2>暂无登录日志</h2>
		<?php }?>
	</div>
</div>

<?php include template('footer');?>
</body>
</html>
