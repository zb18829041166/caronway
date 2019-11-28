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
		<h1>我的余额</h1>
		<div class="desc">您当前的余额<span class="green">￥<?php echo isset($PW['memberlogin']['amount'])?$PW['memberlogin']['amount']:'';?></span>元，积分<span class="red"><?php echo isset($PW['memberlogin']['credits'])?$PW['memberlogin']['credits']:'';?></span>分</div>
		<?php if($data) { ?>
		<table class="table-list-css" cellpadding="1" cellspacing="1">
			<tr>
				<th>余额变动时间</th>
				<th>余额变动数量</th>
				<th>详情	</th>
			</tr>
			<?php $no=1;if(is_array($data))foreach($data as $r){?>
			<tr>
				<td><?php echo date('Y-m-d H:i:s',$r['amounttime']);?></td>
				<td><?php echo $r['inc']>0?'<font style="color:#009933;">增加</font>':'<font style="color:#FF3300;">减少</font>';?> <font style="color:#009933; font-weight:bold"><?php echo isset($r['amount'])?$r['amount']:'';?></font> 元</td>
				<td><?php echo isset($r['desc'])?$r['desc']:'';?></td>
			</tr>
			<?php $no++;}?>
		</table>
		<div class="page">
			<div class="wrap">
				<?php echo Member::$mPageString;?>
			</div>
		</div>
		<?php }else{ ?>
		<h2>暂无余额变动记录</h2>
		<?php }?>
	</div>
</div>

<?php include template('footer');?>
</body>
</html>
