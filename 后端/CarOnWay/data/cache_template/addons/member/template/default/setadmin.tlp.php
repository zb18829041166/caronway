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
               $('#checkeid').click(function(){
                   $.post('<?php echo U(MOD,'setadministor');?>', $("#setadministor").serialize(), function(data) {
                       if(data=='success')
                       {
                           showToast('验证已成功,请刷新网页');
                       }
                       else
                       {
                           showToast('验证成功');
                       }
                   });
                });
            });
    </script>
</head>

<body>
<?php include template('header');?>
<form class="common-width" style="overflow:auto;">
    <div class="left-nav">
        <ul>
            <li class="hover"><a href="<?php echo U(MOD,'i');?>">账号管理</a></li>
            <li><a href="<?php echo U(MOD,'myaddress');?>">我的地址</a></li>
            <li class="hover"><a href="<?php echo U(MOD,'setadmin');?>">我是专员</a></li>
            <?php if($userinfo['roleid']==7) { ?>
            <li><a href="<?php echo U(MOD,'managermember');?>">会员管理</a></li>
            <?php }?>
        </ul>
    </div>
    <div class="right-nav">
        <h1>我是专员</h1>
        <form action="<?php echo U(MOD,'setadministor');?>" name="setadministor" id="setadministor" method="post">
            <div class="form_text_ipt">
                <input name="telephone" id="telephone"  type="text" readonly value="<?php echo isset($userinfo['telephone'])?$userinfo['telephone']:'';?>">
            </div>
            <div class="form_text_ipt">
                <input name="username" id="username" type="text" readonly value="<?php echo isset($userinfo['username'])?$userinfo['username']:'';?>">
            </div>
            <div class="form_text_ipt">
                <input name="employeeID" id="employeeID" msg="工号" type="text" placeholder="工号">
            </div>
            <div class="form_btn">
                <input type="button" class="btn" id="checkeid" value="验证">
            </div>
        </form>
</div>

<?php include template('footer');?>
</body>
</html>
