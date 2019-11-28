<?php !defined('IN_MANAGE') && exit('Access Denied!');use phpWeChat\Member;use phpWeChat\MySql;use phpWeChat\Ip;?>

<!doctype html>

<html>

<head>

    <meta charset="UTF-8">

    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

    <title>phpWeChat后台管理</title>

    <link rel="stylesheet" type="text/css" href="<?php echo defined('PW_PATH')?PW_PATH:'{__PW_PATH__}';?>admin/template/css/common.css"/>

    <link rel="stylesheet" type="text/css" href="<?php echo defined('PW_PATH')?PW_PATH:'{__PW_PATH__}';?>admin/template/css/main.css"/>

    <link rel="stylesheet" type="text/css" href="<?php echo defined('PW_PATH')?PW_PATH:'{__PW_PATH__}';?>statics/core.css"/>

    <link rel="stylesheet" type="text/css" href="<?php echo defined('PW_PATH')?PW_PATH:'{__PW_PATH__}';?>statics/reveal/reveal.css"/>
  	<script language="javascript" type="text/javascript">
		var PW_PATH='<?php echo defined('PW_PATH')?PW_PATH:'{__PW_PATH__}';?>';

	</script>
	<script src="<?php echo defined('PW_PATH')?PW_PATH:'{__PW_PATH__}';?>statics/jquery/jquery-1.12.2.min.js" language="javascript"></script>

    <script src="<?php echo defined('PW_PATH')?PW_PATH:'{__PW_PATH__}';?>statics/reveal/jquery.reveal.js" language="javascript"></script>

	<script src="<?php echo defined('PW_PATH')?PW_PATH:'{__PW_PATH__}';?>statics/core.js" language="javascript"></script>

    <script type="text/javascript" src="<?php echo defined('PW_PATH')?PW_PATH:'{__PW_PATH__}';?>admin/template/js/libs/modernizr.min.js"></script>

  

</head>

<body>

    <div class="ifame-main-wrap">

        <div class="crumb-wrap">

            <div class="crumb-list"><i class="icon-font"></i><a href="<?php echo defined('PW_PATH')?PW_PATH:'{__PW_PATH__}';?><?php echo defined('ADMIN_FILE')?ADMIN_FILE:'{__ADMIN_FILE__}';?>?file=index&action=main">管理首页</a><span class="crumb-step">&gt;</span><span class="crumb-name">会员管理</span></div>

        </div>

        <div class="result-wrap">
				<div class="admin-nav">

					<h2>会员管理</h2>

					<div class="nav">
						<a href="<?php echo defined('PW_PATH')?PW_PATH:'{__PW_PATH__}';?><?php echo defined('ADMIN_FILE')?ADMIN_FILE:'{__ADMIN_FILE__}';?>?mod=<?php echo isset($mod)?$mod:'';?>&file=<?php echo isset($file)?$file:'';?>&action=<?php echo isset($action)?$action:'';?>" class="hover">会员管理</a>
					</div>

				</div>
                <div class="config-items">

					<div style="border: 1px solid #F3F3F3; padding:8px; margin:8px 0px">

					  <form name="seatchform" method="post" action="<?php echo defined('PW_PATH')?PW_PATH:'{__PW_PATH__}';?><?php echo defined('ADMIN_FILE')?ADMIN_FILE:'{__ADMIN_FILE__}';?>?mod=<?php echo isset($mod)?$mod:'';?>&file=<?php echo isset($file)?$file:'';?>&action=<?php echo isset($action)?$action:'';?>">

						按会员名检索：

						<input type="text" class="common-text" name="username" size="32" />

						<input type="submit" value="搜 索" class="common_btn">

					  </form>

					</div>

                    <div class="result-content">

                        <table class="result-tab" width="100%">

						  <tr>

							<th>UserID</th>

							<th>会员账号</th>

							<th>会员等级</th>

							<th>积分/余额</th>

							<th>注册邮箱</th>

							<th>注册手机</th>

							<th>注册信息</th>

                            <th>登录信息</th>
							<th>管理</th>
						  </tr>

						  <?php $no=1;if(is_array($data))foreach($data as $r){?>

							<tr>

								<td><?php echo isset($r['userid'])?$r['userid']:'';?></td>

								<td><?php echo isset($r['username'])?$r['username']:'';?>
								
								<br>
								<?php echo isset($r['openid'])?$r['openid']:'';?>
								</td>

								<td><?php echo Member::levelGet($r['levelid'],'name');?></td>

								<td style="text-align:left"><a style="float:right" href="<?php echo defined('PW_PATH')?PW_PATH:'{__PW_PATH__}';?><?php echo defined('ADMIN_FILE')?ADMIN_FILE:'{__ADMIN_FILE__}';?>?mod=<?php echo isset($mod)?$mod:'';?>&file=<?php echo isset($file)?$file:'';?>&action=credits_log&userid=<?php echo isset($r['userid'])?$r['userid']:'';?>"><i class="icon-font">&#xe022;</i> 积分日志</a>积分：<font style="color:#FF3300; font-weight:bold"><?php echo isset($r['credits'])?$r['credits']:'';?></font> 分 <br> <a style="float:right" href="<?php echo defined('PW_PATH')?PW_PATH:'{__PW_PATH__}';?><?php echo defined('ADMIN_FILE')?ADMIN_FILE:'{__ADMIN_FILE__}';?>?mod=<?php echo isset($mod)?$mod:'';?>&file=<?php echo isset($file)?$file:'';?>&action=amount_log&userid=<?php echo isset($r['userid'])?$r['userid']:'';?>"><i class="icon-font">&#xe064;</i> 余额日志</a>余额：<font style="color:#009933; font-weight:bold"><?php echo isset($r['amount'])?$r['amount']:'';?></font> 元</td>

								<td><?php if($r['email']) { ?><?php echo isset($r['email'])?$r['email']:'';?><?php }else{ ?>-<?php }?></td>

								<td><?php echo isset($r['telephone'])?$r['telephone']:'';?></td>

								<td><?php echo date('Y-m-d H:i:s',$r['regtime']);?><br>注册IP：<a href="http://www.ip138.com/ips138.asp?ip=<?php echo isset($r['regip'])?$r['regip']:'';?>&action=2" target="_blank"><?php echo isset($r['regip'])?$r['regip']:'';?></a></td>

                                <td style="text-align:left"><a style="float:right" href="<?php echo defined('PW_PATH')?PW_PATH:'{__PW_PATH__}';?><?php echo defined('ADMIN_FILE')?ADMIN_FILE:'{__ADMIN_FILE__}';?>?mod=<?php echo isset($mod)?$mod:'';?>&file=<?php echo isset($file)?$file:'';?>&action=login_log&userid=<?php echo isset($r['userid'])?$r['userid']:'';?>"><i class="icon-font">&#xe060;</i> 登录日志</a><?php echo date('Y-m-d H:i:s',$r['logintime']);?><br><a href="http://www.ip138.com/ips138.asp?ip=<?php echo isset($r['loginip'])?$r['loginip']:'';?>&action=2" target="_blank"><?php echo isset($r['loginip'])?$r['loginip']:'';?></a></td>
								<td>
									<a href="<?php echo defined('PW_PATH')?PW_PATH:'{__PW_PATH__}';?><?php echo defined('ADMIN_FILE')?ADMIN_FILE:'{__ADMIN_FILE__}';?>?mod=<?php echo isset($mod)?$mod:'';?>&file=<?php echo isset($file)?$file:'';?>&action=member_pwd&userid=<?php echo isset($r['userid'])?$r['userid']:'';?>"><i class="icon-font">&#xe002;</i> 重置密码</a>
									
									
								</td>
							</tr>

						 <?php $no++;}?>

						 <tr>

							<td colspan="9">

								<?php echo Member::$mPageString;?>

							</td>

						 </tr>

					  </table>

                    </div>

                </div>

        </div> 

    </div>

    <div class="statics-footer"> Powered by phpWeChat V<?php echo defined('PHPWECHAT_VERSION')?PHPWECHAT_VERSION:'{__PHPWECHAT_VERSION__}';?><?php echo defined('PHPWECHAT_RELEASE')?PHPWECHAT_RELEASE:'{__PHPWECHAT_RELEASE__}';?> © , Processed in <?php echo microtime()-$PW['time_start'];?> second(s) , <?php echo MySql::$mQuery;?> queries <a href="#">至顶端↑</a></div>

</body>

</html>