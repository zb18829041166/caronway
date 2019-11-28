<?php
use phpWeChat\Member;
use phpWeChat\Area;
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
	$.ajaxSetup ({ 
	cache: false //关闭AJAX相应的缓存 
	});
	
	$(document).ready(function(){
		$('#address_save_btn').click(function(){
			$('.loading').show();
			$.post('<?php echo U(MOD,'myaddress_save');?>', $("#address_save_form").serialize(), function(data) {
				data = jQuery.parseJSON(data);
				
				if(data.errcode)
				{
					alert(data.errstr);
					$('.loading').hide();
					return false;
				}
				
				$("#datalist").load("<?php echo format_url(get_current_url());?> #datalist"); //局部刷新
				
				$('.loading').hide();
				return true;
			});
		});
		
		$('#province').val(<?php echo isset($modifydata['province'])?$modifydata['province']:'';?>);
		$('#city').val(<?php echo isset($modifydata['city'])?$modifydata['city']:'';?>);
		$('#area').val(<?php echo isset($modifydata['area'])?$modifydata['area']:'';?>);
	});
	
	function myaddress_delete(id)
	{
		$('.loading').show();
		$.get('<?php echo U(MOD,'myaddress_delete');?>&id='+id, function(data) {
			data = jQuery.parseJSON(data);
			
			if(data.errcode)
			{
				alert(data.errstr);
				$('.loading').hide();
				return false;
			}

			$("#datalist").load("<?php echo format_url(get_current_url());?> #datalist"); //局部刷新
			$('.loading').hide();
		});
	}
	
	function myaddress_default(id)
	{
		$('.loading').show();
		
		$.get('<?php echo U(MOD,'myaddress_default');?>&id='+id, function(data) {
			data = jQuery.parseJSON(data);
			
			if(data.errcode)
			{
				alert(data.errstr);
				$('.loading').hide();
				return false;
			}

			$("#datalist").load("<?php echo format_url(get_current_url());?> #datalist"); //局部刷新
			$('.loading').hide();
		});
	}
</script>
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
		<h1 onClick="test()">地址管理</h1>
		<span id="datalist">
		<?php if($data) { ?>
		
		<table class="table-list-css" cellpadding="1" cellspacing="1">
			<tr>
				<th>收件人</th>
				<th>手机号码</th>
				<th>详细地址</th>
				<th>是否默认地址</th>
				<th>管理</th>
			</tr>
			<?php $no=1;if(is_array($data))foreach($data as $r){?>
			<tr>
				<td><?php echo isset($r['realname'])?$r['realname']:'';?></td>
				<td><?php echo isset($r['telephone'])?$r['telephone']:'';?></td>
				<td><?php echo Area::getPro($r['province'],'name');?> <?php echo Area::getCity($r['city'],'name');?> <?php echo Area::getArea($r['area'],'name');?> <?php echo isset($r['address'])?$r['address']:'';?></td>
				<td><?php echo $r['default']?'默认地址':'-';?></td>
				<td>
				<a href="<?php echo U(MOD,'myaddress_post',array('id'=>$r['id']));?>">编辑</a> | 
				<?php if($r['default']) { ?>
				<font style="color:#CCCCCC">删除</font>
				<?php }else{ ?>
				<a href="javascript:void(0);" onClick="myaddress_delete(<?php echo isset($r['id'])?$r['id']:'';?>);">删除</a>
				<?php }?>
				<br>
				<?php if($r['default']) { ?>
				<font style="color:#CCCCCC">设为默认地址</font>
				<?php }else{ ?>
				<a href="javascript:void(0);" onClick="myaddress_default(<?php echo isset($r['id'])?$r['id']:'';?>);">设为默认地址</a>
				<?php }?>
				</td>
			</tr>
			<?php $no++;}?>
		</table>
		
		<?php }?>
		</span>
		<h1><?php if($id) { ?>编辑<?php }else{ ?>新增<?php }?>地址</h1>
		<form action="" method="post" name="address_save_form" id="address_save_form">
		<input type="hidden" name="id" id="address_save_id" value="<?php echo isset($id)?$id:'';?>">
		<table class="tablecss" cellpadding="1" cellspacing="1">
			<tr>
				<td width="15%">收件人： </td>
				<td><input type="text" name="info[realname]" placeholder="请输入收件人" autocomplete="off" required value="<?php echo isset($modifydata['realname'])?$modifydata['realname']:'';?>" size="24"></td>
			</tr>
			<tr>
				<td width="15%">手机号码： </td>
				<td><input type="text" name="info[telephone]" placeholder="请输入手机号码" autocomplete="off" required value="<?php echo isset($modifydata['telephone'])?$modifydata['telephone']:'';?>" size="24"></td>
			</tr>
			<tr>
				<td width="15%">详细地址： </td>
				<td>
				<select name="info[province]" id="province" onChange="getCityOption('province','city');" required>
					<option value="0">省份</option>
					<?php $no=1;if(is_array(Area::proList()))foreach(Area::proList() as $r){?>
					<option value="<?php echo isset($r['id'])?$r['id']:'';?>"><?php echo isset($r['name'])?$r['name']:'';?></option>
					<?php $no++;}?>
				</select>
				<select name="info[city]" id="city" onChange="getAreaOption('city','area');" required>
					<option value="0">城市</option>
					<?php if($id) { ?>
					<?php $no=1;if(is_array(Area::cityList($modifydata['province'])))foreach(Area::cityList($modifydata['province']) as $r){?>
                    <option value="<?php echo isset($r['id'])?$r['id']:'';?>"><?php echo isset($r['name'])?$r['name']:'';?></option>
                    <?php $no++;}?>
					<?php }?>
				</select>
				<select name="info[area]" id="area" required>
					<option value="0">区域</option>
					<?php if($id) { ?>
					<?php $no=1;if(is_array(Area::areaList($modifydata['city'])))foreach(Area::areaList($modifydata['city']) as $r){?>
                    <option value="<?php echo isset($r['id'])?$r['id']:'';?>"><?php echo isset($r['name'])?$r['name']:'';?></option>
                    <?php $no++;}?>
					<?php }?>
				</select>
				<input type="text" name="info[address]" placeholder="请输入详细地址" autocomplete="off" required value="<?php echo isset($modifydata['address'])?$modifydata['address']:'';?>" size="32"></td>
			</tr>
			<tr>
				<td width="15%">邮政编码： </td>
				<td><input type="text" name="info[postcode]" placeholder="请输入邮政编码" autocomplete="off" required value="<?php echo isset($modifydata['postcode'])?$modifydata['postcode']:'';?>" size="24"></td>
			</tr>
			<tr>
				<td width="15%">&nbsp;</td>
				<td><input type="button" class="btn" id="address_save_btn" value="保存我的地址"> &nbsp;&nbsp;&nbsp;&nbsp;<input type="reset" class="cancel-btn" value="取消">
			</tr>
		</table>
		</td>
	</div>
</div>

<?php include template('footer');?>
</body>
</html>
