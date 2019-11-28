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
            function member_set(id)
            {
                $.get('<?php echo U(MOD,member_set);?>&userid='+id, function(data) {
                    showToast('设置成功');
                    $("#datalist").load("<?php echo format_url(get_current_url());?> #datalist"); //局部刷新
                });
            }

            function member_concel(id)
            {
                $.get('<?php echo U(MOD,member_concel);?>&userid='+id, function(data) {
                    showToast('设置成功');
                    $("#datalist").load("<?php echo format_url(get_current_url());?> #datalist"); //局部刷新
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
        <h1 onClick="test()">会员管理</h1>
        <span id="datalist">
		<?php if($member) { ?>
		<table class="table-list-css" cellpadding="1" cellspacing="1">
			<tr>
				<th>名称</th>
				<th>手机号码</th>
				<th>会员类型</th>
				<th>设置成为专员</th>
			</tr>
			<?php $no=1;if(is_array($member))foreach($member as $r){?>
			<tr>
				<td><?php echo isset($r['username'])?$r['username']:'';?></td>
				<td><?php echo isset($r['telephone'])?$r['telephone']:'';?></td>
				<td><?php echo $r['roleid']==7?'专员':'普通会员';?></td>
				<td>
				<?php if($r['roleid']==7) { ?>
				<a href="javascript:void(0);" onClick="member_concel(<?php echo isset($r['userid'])?$r['userid']:'';?>);">取消专员</a>
				<?php }else{ ?>
				<a href="javascript:void(0);" onClick="member_set(<?php echo isset($r['userid'])?$r['userid']:'';?>);">设为专员</a>
				<?php }?>
				</td>
			</tr>
			<?php $no++;}?>
		</table>
		<?php }?>
		</span>
    </div>
</div>
<?php include template('footer');?>
</body>
</html>
