<?php
/**
 * Created by PhpStorm.
 * User: hezlong
 * Date: 2019/4/27
 * Time: 22:41
 */
namespace wechat\Usedcarmall;
header('Content-Type:application/json; charset=utf-8');
header('Access-Control-Allow-Origin:*');
header("Access-Control-Allow-Credentials:true");
header("Access-Control-Allow-Methods:*");
header("Access-Control-Allow-Headers:Access-Token,Origin, X-Requested-With, Content-Type, Accept,Authorization");
header("Access-Control-Expose-Headers:*");
use wechat\Usedcarmall\Usedcarmall;
use wechat\Usedcarmall\Seconduser;
use wechat\Usedcarmall\Secondcar;
use wechat\Usedcarmall\Currentuserinfo;

use phpWeChat\MySql;

use phpWeChat\Area;

use phpWeChat\CaChe;

use phpWeChat\Config;

use phpWeChat\Member;

use phpWeChat\Module;

use phpWeChat\Order;

class Secondhandcar
{
    public static $mPageString='';

    public static $mTotalPage=0;
    private static $mProTable='province';
    private static $mCityTable='city';
    private static $mAreaTable='area';
   public static function register($info)
   {
       $result=array();
       $result['code']=0;
       $result['message']='注册成功';
       $username = $info['username'];
       if(!trim($username))
       {
           $result['code']=2000;
           $result['message']='用户名为空';
           return $result;
       }
       $telephone = $info['telephone'];
       if(!trim($telephone) || !is_telephone($telephone))
       {
           $result['code']=2001;
           $result['message']='手机号格式不正确';
           return $result;
       }
       $userpwd = $info['userpwd'];
       if(strlen($userpwd)<6)
       {
           $result['code']=2002;
           $result['message']='密码长度不得小于6';
           return $result;
       }
       $repassword = $info['reuserpwd'];
       if($userpwd!=$repassword)
       {
           $result['code']=2003;
           $result['message']='两次密码不一致';
           return $result;
       }
       $mem=Member::getUserByTelephone($telephone);
       if($mem)
       {
           $result['code']=2004;
           $result['message']='该手机号已注册';
           return $result;
       }
       $openid = $_POST['openid'];
       $mem=Currentuserinfo::getUserByOpenId($openid);
       if($mem)
       {
           $result['code']=2005;
           $result['message']='该用户已注册';
           return $result;
       }

       //根据unionid判断用户是否已注册
       $unionid = $_POST['unionid'];

       $memm = Currentuserinfo::getUserByUnionId($unionid);
       if($memm)
       {
           $result['code']=2006;
           $result['message']='该用户已注册';
           return $result;
       }
       $info['roleid']=5;
       $info['userpwd']= md5($info['userpwd']);

       Seconduser::register($info);
       return $result;
   }

   public static function login($info)
   {
       $result=array();
       $result['code']=0;
       $result['message']='登陆成功';
       $telephone = $info['telephone'];
       $mem=Member::getUserByTelephone($telephone);
       if(!$mem)
       {
           $result['code']= -1;
           $result['message']='改手机号不存在';
           return $result;
       }
       $password = $info['userpwd'];
       if($mem['userpwd'] != md5($password))
       {
           $result['code']= -2;
           $result['message']='密码错误';
           return $result;
       }
       return  $result;
   }

   public static function createShop($info)
   {
       $result=array();
       $result['code']=0;
       $result['message']='提交成功';


       if(!$info['userid'])
       {
           $result['code']=2002;
           $result['message']='用户ID不能为空';
           return $result;
       }
       $userid = $info['userid'];

       $had = Mysql::fetchOne("select * from pw_carsecond_user where userid=".$userid);

       if($had)
       {
           $result['code']=2002;
           $result['message']='该用户已申请过';
           return $result;
       }
       if(!$info['telephone'] || !is_telephone($info['telephone']))
       {
           $result['code']=2003;
           $result['message']='手机号码格式不正确';
           return $result;
       }
       if(!$info['realname'])
       {
           $result['code']=2002;
           $result['message']='姓名不能为空';
           return $result;
       }

       if(!$info['longitude'])
       {
           $result['code']=2004;
           $result['message']='经度不能为空';
           return $result;
       }
       if(!$info['latitude'])
       {
           $result['code']=2004;
           $result['message']='纬度不能为空';
           return $result;
       }
       if(!$info['licimg'])
       {
           $result['code']=2005;
           $result['message']=('请上传店铺工商执照图');
           return $result;
       }
       if(!$info['innimg'])
       {
           $result['code']=2006;
           $result['message']=('请上传店铺店铺内景图');
           return $result;
       }
       if(!$info['outimg'])
       {
           $result['code']=2007;
           $result['message']=('请上传店铺店铺外景图');
           return $result;
       }
       if(!$info['logoori'])
       {
           $result['code']=2008;
           $result['message']=('请上传店铺logo图');
           return $result;
       }
       Seconduser::appInfoAdd($info);
       return $result;
   }

   public static function createMyCarInfo($info)
   {
       $data=array();
       $data['errcode']=0;
       $data['errstr']='保存成功';
       if(!$info['userid'])
       {
           $data['errcode']=3002;
           $data['errstr']='用户id不能为空';
           return $data;
       }
       if(!$info['hadkm'])
       {
           $data['errcode']=3003;
           $data['errstr']='已有行程数不能为空';
           return $data;
       }
       if(!$info['regtime'])
       {
           $data['errcode']=3004;
           $data['errstr']='注册日期不能为空';
           return $data;
       }
       if(!$info['times'])
       {
           $data['errcode']=305;
           $data['errstr']='过户次数不能为空';
           return $data;
       }
       if(!$info['age'])
       {
           $data['errcode']=3006;
           $data['errstr']='车龄不能为空';
           return $data;
       }
       if(!$info['instime'])
       {
           $data['errcode']=3007;
           $data['errstr']='交强险日期不能为空';
           return $data;
       }
       if(!$info['paraid'])
       {
           $data['errcode']=3008;
           $data['errstr']='车辆参数id不能为空';
           return $data;
       }
       if(!$info['frontpic'])
       {
           $data['errcode']=3009;
           $data['errstr']='车脸前图不能为空';
           return $data;
       }
       if(!$info['rightside'])
       {
           $data['errcode']=3010;
           $data['errstr']='车右侧图不能为空';
           return $data;
       }
       if(!$info['rearview'])
       {
           $data['errcode']=3011;
           $data['errstr']='车尾图不能为空';
           return $data;
       }
       if(!$info['leftside'])
       {
           $data['errcode']=3012;
           $data['errstr']='车左侧图不能为空';
           return $data;
       }
       if(!$info['frontcover'])
       {
           $data['errcode']=3013;
           $data['errstr']='车前盖图不能为空';
           return $data;
   }
       if(!$info['interior1'])
       {
           $data['errcode']=3014;
           $data['errstr']='车箱内饰图1不能为空';
           return $data;
       }
       if(!$info['interior2'])
       {
           $data['errcode']=3015;
           $data['errstr']='车箱内饰图2不能为空';
           return $data;
       }
       if(!$info['interior3'])
       {
           $data['errcode']=3016;
           $data['errstr']='车箱内饰图3不能为空';
           return $data;
       }

       if(!$info['type'])
       {
           $info['type']=1;
       }
       Secondcar::insertCarInfoByUser($info);
       return $data;
   }

   public static function createCarParameter($info)
   {
       $data=array();
       $data['errcode']=0;
       $data['errstr']='保存成功';
       if($info['calssid'])
       {
           $data['errcode']=2001;
           $data['errstr']='请选择车款';
           return $data;
       }
       if($info['calsscid'])
       {
           $data['errcode']=2002;
           $data['errstr']='请选择车系';
           return $data;
       }
       if(!$info['model'])
       {
           $data['errcode']=2003;
           $data['errstr']='请输入车型';
           return $data;
        }
       if(!$info['classes'])
       {
           $data['errcode']=2004;
           $data['errstr']='请输入级别';
           return $data;
       }
       if(!$info['energyType'])
       {
           $data['errcode']=2005;
           $data['errstr']='请输入能源类别';
           return $data;
       }
       if(!$info['timemarket'])
       {
           $data['errcode']=2006;
           $data['errstr']='请输入上市时间';
           return $data;
       }
       if(!$info['motor'])
       {
           $data['errcode']=2007;
           $data['errstr']='请输入发动机';
           return $data;
       }
       if(!$info['maxkw'])
       {
           $data['errcode']=2008;
           $data['errstr']='请输入最大功率';
           return $data;
       }
       if(!$info['maxtorque'])
       {
           $data['errcode']=2009;
           $data['errstr']='请输入最大扭矩';
           return $data;
       }
       if(!$info['gearbox'])
       {
           $data['errcode']=2010;
           $data['errstr']='请输入变速箱';
           return $data;
       }
       if(!$info['outline'])
       {
           $data['errcode']=2011;
           $data['errstr']='请输入车外廓';
           return $data;
       }
       if(!$info['structure'])
       {
           $data['errcode']=2012;
           $data['errstr']='请输入身体结构';
           return $data;
       }
       if(!$info['maxspeed'])
       {
           $data['errcode']=2013;
           $data['errstr']='请输入最大车速';
           return $data;
       }
       if(!$info['fuelcsption'])
       {
           $data['errcode']=2014;
           $data['errstr']='请输入综合能耗';
           return $data;
       }
       if(!$info['realprice'])
       {
           $data['errcode']=2015;
           $data['errstr']='请输入实际销售价';
           return $data;
       }
       if(!$info['newprice'])
       {
           $data['errcode']=2016;
           $data['errstr']='请输入新车销售价';
           return $data;
       }
       Secondcar::addcarParaInfo($info);
       return $data;
   }
   public static function addCarPosition($info)
   {
       $data=array();
       $data['errcode']=0;
       $data['errstr']='保存成功';
       return $data;
   }
   public static function cajdvud($info)
   {
       $data=array();
       $data['errcode']=0;
       $data['errstr']='保存成功';
       if(!$info['uid'])
       {
           $data['errcode']=2001;
           $data['errstr']='用户id不能为空';
           return $data;
       }
       if(!$info['carid'])
       {
           $data['errcode']=2002;
           $data['errstr']='车辆id不能为空';
           return $data;
       }
       if(!$info['userid'])
       {
           $data['errcode']=2003;
           $data['errstr']='被投诉人id不能为空';
           return $data;
       }
       if(!$info['content'])
       {
           $data['errcode']=2004;
           $data['errstr']='投诉内容不能为空';
           return $data;
       }
       Seconduser::insertTouSuInfo($info);
       return $data;
   }

    public static function getAllCarByCondition($info)
    {

       if($info['genplace'])
       {
           $condition0 = "and para.classid like '%".$info['genplace']."%'";
       }
       if($info['realname'])
       {
           $condition0 = $condition0."and para.classid like '%".$info['realname']."%'";
       }
        if($info['model'])
        {
            $condition0 = $condition0."and para.classid like '%".$info['model']."%'";
        }
        if($info['classes'])
        {
            $condition0 = $condition0."and para.classid like '%".$info['classes']."%'";
        }
        if($info['realprice'])
        {
            $condition0 = $condition0."and para.classid like '%".$info['realprice']."%'";
        }
        if($info['classid'])
        {
            $condition0 = $condition0."and para.classid like '%".$info['classid']."%'";
        }

        $sql  = "select * from pw_car car , pw_car_para para ,pw_carsecond_user u where car.paraid = para.id  and u.userid = car.userid and u.`lock`=0 and 1=1 ".$condition0;

        $data = Mysql::fetchAll($sql);
        return $data;
    }

    public static function getCardetailsById($info)
    {
        if(!$info['id'])
        {
            $data=array();
            $data['errcode']=-1;
            $data['errstr']='汽车id为空';
            return $data;
        }
        $id = $info['id'];
        $sql = "SELECT  car.id,
                        pa.classid ,
                        pa.classcid ,
                        car.age,
                        (select name from pw_province where id = car.provinceid) provinceid ,
                        (select name from pw_city where id = car.cityid) cityid ,
                         car.frontcover,
                        car.frontpic,
                        car.hadkm,
                        car.times,
                        car.instime,
                        car.interior1,
                        car.interior2,
                        car.interior3,
                        car.leftside,
                        car.rearview,
                        car.regtime,
                        car.rightside,
                        pa.prdFactory,
                        pa.classcid,
                        pa.classid,
                        pa.model,
                        pa.classes,
                        pa.energyType,
                        pa.timemarket,
                        pa.motor,
                        pa.maxkw,
                        pa.maxtorque,
                        pa.gearbox,
                        pa.outline,
                        pa.structure,
                        pa.maxspeed,
                        pa.fuelcsption,
                        pa.hot,
                        pa.placepro,
                        pa.realprice,
                        pa.newprice,
                        pa.fromtype
              FROM
                        pw_car car,
                        pw_car_para pa
              WHERE
                        pa.id = car.paraid
              AND 
                        car.id =".$id;
        $data = Mysql::fetchOne($sql);
        return $data;
    }
    public static function getCardetailsByUserId($info)
    {
        if(!$info['userid'])
        {
            $data=array();
            $data['errcode']=-1;
            $data['errstr']='userid为空';
            return $data;
        }
        $id = $info['userid'];
        $sql = "SELECT  car.id,
                        pa.classid ,
                        pa.classcid ,
                        car.age,
                        (select name from pw_province where id = car.provinceid) provinceid ,
                        (select name from pw_city where id = car.cityid) cityid ,
                        car.frontcover,
                        car.frontpic,
                        car.hadkm,
                        car.times,
                        car.instime,
                        car.interior1,
                        car.interior2,
                        car.interior3,
                        car.leftside,
                        car.rearview,
                        car.regtime,
                        car.rightside,
                        pa.prdFactory,
                        pa.classcid,
                        pa.classid,
                        pa.model,
                        pa.classes,
                        pa.energyType,
                        pa.timemarket,
                        pa.motor,
                        pa.maxkw,
                        pa.maxtorque,
                        pa.gearbox,
                        pa.outline,
                        pa.structure,
                        pa.maxspeed,
                        pa.fuelcsption,
                        pa.hot,
                        pa.placepro,
                        pa.realprice,
                        pa.newprice,
                        pa.fromtype,car.status
              FROM
                        pw_car car,
                        pw_car_para pa
              WHERE
                        pa.id = car.paraid
              AND 
                        car.userid =".$id;
        $data = Mysql::fetchAll($sql);
        return $data;
    }
    public static function getCarsByUserId($info)
    {
        if(!$info['id'])
        {
            $data=array();
            $data['errcode']=-1;
            $data['errstr']='用户id为空';
            return $data;
        }
        $id = $info['id'];
        $sql = "SELECT  car.id,
                        pa.classid ,
                        pa.classcid ,
                        car.age,
                        (select name from pw_province where id = car.provinceid) provinceid ,
                        (select name from pw_city where id = car.cityid) cityid ,
                       car.frontcover,
                        car.frontpic,
                        car.hadkm,
                        car.times,
                        car.instime,
                        car.interior1,
                        car.interior2,
                        car.interior3,
                        car.leftside,
                        car.rearview,
                        car.regtime,
                        car.rightside,
                        pa.prdFactory,
                        pa.classcid,
                        pa.classid,
                        pa.model,
                        pa.classes,
                        pa.energyType,
                        pa.timemarket,
                        pa.motor,
                        pa.maxkw,
                        pa.maxtorque,
                        pa.gearbox,
                        pa.outline,
                        pa.structure,
                        pa.maxspeed,
                        pa.fuelcsption,
                        pa.hot,
                        pa.placepro,
                        pa.realprice,
                        pa.newprice,
                        pa.fromtype
              FROM
                        pw_car car,
                        pw_car_para pa
              WHERE
                        pa.id = car.paraid
              AND 
                        car.userid =".$id;
        $data = Mysql::fetchAll($sql);
        return $data;
    }
    public static function getShopDetailsInfoByShopId($info)
    {
        if(!$info['id'])
        {
            $data=array();
            $data['errcode']=-1;
            $data['errstr']='店铺id为空';
            return $data;
        }
        $id = $info['id'];
        $sql = "select * from pw_carsecond_user where id =".$id;
        $data = Mysql::fetchOne($sql);
        return $data;
    }
    public static function getShopDetailsInfoByUserId($info)
    {
        if(!$info['userid'])
        {
            $data=array();
            $data['errcode']=-1;
            $data['errstr']='用户id为空';
            return $data;
        }
        $id = $info['userid'];
        $sql = "select * from pw_carsecond_user where userid =".$id;
        $data = Mysql::fetchOne($sql);
        return $data;
    }
    public static function checkPassUserShopByShopId($info)
    {
        $data=array();
        $data['errcode']=0;
        $data['errstr']='审核通过';
        if(!$info['id'])
        {
            $data['errcode']=2001;
            $data['errstr']='店铺id为空';
            return $data;
        }
        $id = $info['id'];
        $s = MySql::fetchOne("select * from pw_car_basespot");
        $basespot = $s['basespot'];
        $maxspot = $s['maxspot'];
        if(!$basespot)
        {
            $data['errcode']=2002;
            $data['errstr']='基础展位数为空';
            return $data;
        }
        if(!$maxspot)
        {
            $data['errcode']=2003;
            $data['errstr']='最大基础数为空';
            return $data;
        }
        $userid = $info['userid'];
        if(!$userid)
        {
            $data['errcode']=2004;
            $data['errstr']='用户ID为空';
            return $data;
        }
        Mysql::query("insert into pw_car_spot (`shopid`, `basespot`, `maxspot`) VALUES ('".$id."', '".$basespot."', '".$maxspot."') ");
        MySql::query("update pw_carsecond_user set `status`= 1 ,`linestat` = 0 ,`isfirst` = 0 ,`lock` = 0 WHERE id=".intval($id));
        Mysql::query("update pw_member set roleid= 6 where userid=".$userid);
        return $data;
    }
    public static function checkRefuseUserShopByShopId($info)
    {
        $data=array();
        $data['errcode']=0;
        $data['errstr']='已拒绝';
        if(!$info['id'])
        {
            $data=array();
            $data['errcode']=2001;
            $data['errstr']='店铺id为空';
            return $data;
        }
        if(!$info['checker'])
        {
            $data=array();
            $data['errcode']=2002;
            $data['errstr']='审核人为空';
            return $data;
        }
        $checkphone = $info['checkphone'];
        if(!$info['checkphone'] ||  !is_telephone($checkphone))
        {
            $data=array();
            $data['errcode']=2003;
            $data['errstr']='审核人联系方式为空';
            return $data;
        }
        if(!$info['refusereason'])
        {
            $data=array();
            $data['errcode']=2004;
            $data['errstr']='拒绝理由为空';
            return $data;
        }
        $id = $info['id'];
        $checker = $info['checker'];
        $refusereason = $info['refusereason'];
        $sql  ="update pw_carsecond_user set `status`=2 , `lock` = 0 , `checker`='".$checker."' , `checkphone` ='".$checkphone."' , `refusereason`='".$refusereason."' where `id`=".$id;
        Mysql::query($sql);
        return $data;
    }
    public static function setShopOfflineByShopId($info)
    {
        $data=array();
        $data['errcode']=0;
        $data['errstr']='店铺已下线';
        if(!$info['id'])
        {
            $data=array();
            $data['errcode']=-1;
            $data['errstr']='店铺id为空';
            return $data;
        }
        $id = $info['id'];
        $sql = "update pw_carsecond_user set `status`=0 ,`linestat` = 2 , `lock` = 1 where id=".$id;
        Mysql::query($sql);
        $sql1 = "update pw_car set status = 0 where userid=".$info["userid"];
        Mysql::query($sql1);
        return $data;
    }
    public static function submitShopInfoByShopId($info)
    {
        $data=array();
        $data['code']=0;
        $data['message']='提交成功';
        $id = $info['id'];
        if(!$id)
        {
            $data['code']=2001;
            $data['message']='id为空';
            return $data;
        }
        $info['status'] = 0;
        $info['linestat'] = 0;
        $info['lock'] = 0;
        $info['checker'] = '';
        $info['checkphone'] = '';
        $info['refusereason'] = '';
        $info['isfirst'] = 1;
        MySql::update("pw_carsecond_user",$info,'`id`='.intval($id));
        return $data;
    }
    public static function setShopOnlineByShopId($info)
    {
        $data=array();
        $data['errcode']=0;
        $data['errstr']='店铺已上线';
        if(!$info['id'])
        {
            $data=array();
            $data['errcode']=-1;
            $data['errstr']='店铺id为空';
            return $data;
        }
        $id = $info['id'];
        $q = "select * from pw_carsecond_user where  id=".$id;
        $shop = Mysql::fetchOne($q);

        if($shop['status']!='1')
        {
            $data=array();
            $data['errcode']=-2;
            $data['errstr']='店铺尚未审核';
            return $data;
        }

        $sql = "update pw_carsecond_user set `status`=0 ,`linestat` = 1 , `lock` = 0 where id=".$id;
        Mysql::query($sql);
        return $data;
    }
    public static function setMyShopOfflineByShopId($info)
    {
        $data=array();
        $data['errcode']=0;
        $data['errstr']='店铺已下线';
        $userid = $info['userid'];
        $lockStat = Mysql::fetchOne("select * from pw_carsecond_user where userid=".$userid);
        if(intval($lockStat['lock'])==1)
        {
            $data=array();
            $data['errcode']=-1;
            $data['errstr']='您的店铺已被强制下线无法进行此操作';
            return $data;
        }
        if(!$info['id'])
        {
            $data=array();
            $data['errcode']=-1;
            $data['errstr']='店铺id为空';
            return $data;
        }
        $id = $info['id'];
        $sql = "update pw_carsecond_user set `status`=0 ,`linestat` = 2 , `lock` = 1 where id=".$id;
        Mysql::query($sql);
        return $data;
    }
    public static function setMyShopOnlineByShopId($info)
    {
        $data=array();
        $data['errcode']=0;
        $data['errstr']='店铺已上线';
        $userid = $info['userid'];
        $lockStat = Mysql::fetchOne("select * from pw_carsecond_user where userid=".$userid);
        if(intval($lockStat['lock'])==1)
        {
            $data=array();
            $data['errcode']=-1;
            $data['errstr']='您的店铺已被强制下线无法上线店铺';
            return $data;
        }
        if(!$info['id'])
        {
            $data=array();
            $data['errcode']=-1;
            $data['errstr']='店铺id为空';
            return $data;
        }
        $id = $info['id'];
        $q = "select * from pw_carsecond_user where  id=".$id;
        $shop = Mysql::fetchOne($q);

        if($shop['status']!='1')
        {
            $data=array();
            $data['errcode']=-2;
            $data['errstr']='店铺尚未审核';
            return $data;
        }

        $sql = "update pw_carsecond_user set `status`=0 ,`linestat` = 1 , `lock` = 0 where id=".$id;
        Mysql::query($sql);
        return $data;
    }

    public static function setMyCarOnlineByCarId($info)
    {
        $data=array();
        $data['errcode']=0;
        $data['errstr']='车辆已上线';
        if(!$info['userid'])
        {
            $data['errcode']=-2;
            $data['errstr']='用户id为空';
            return $data;
        }
        $userid = $info['userid'];
        $lockStat = Mysql::fetchOne("select * from pw_carsecond_user where userid=".$userid);
        if(intval($lockStat['lock'])==1)
        {
            $data['errcode']=-3;
            $data['errstr']='您的店铺已下线无法进行车辆上线';
            return $data;
        }
        if(!$info['id'])
        {
            $data['errcode']=-1;
            $data['errstr']='汽车id为空';
            return $data;
        }
        $id = $info['id'];
        $sql = "update pw_car set `status` = 1 where id =".$id;
        Mysql::query($sql);
        return $data;
    }

    public static function setMyCarOfflineByCarId($info)
    {
        $data=array();
        $data['errcode']=0;
        $data['errstr']='车辆已下线';
        if(!$info['id'])
        {
            $data['errcode']=-1;
            $data['errstr']='汽车id为空';
            return $data;
        }
        $id = $info['id'];
        $sql = "update pw_car set `status` = 0 where id =".$id;
        Mysql::query($sql);
        return $data;
    }

    public static function getAllUncheckedShop($info)
    {
        $data = Mysql::fetchAll("select * from pw_carsecond_user where `status` = 0 and `lock` = 0");
        return $data;
    }
    public static function getAllShopInfo($info)
    {
        $sql = "select * from pw_carsecond_user where status !=0 ";
        $data = Mysql::fetchAll($sql);
        return $data;
    }

    public static function getAllProvinceInfo()
    {
        return MySql::fetchAll("SELECT * FROM `".DB_PRE.self::$mProTable."` ORDER BY `".DB_PRE.self::$mProTable."`.`id` ASC");
    }
    public static function getAllCityInfo($info)
    {

        $proid=intval($info['proid']);
        if(!$proid)
        {
            return MySql::fetchAll("SELECT * FROM `".DB_PRE.self::$mCityTable."` ORDER BY `".DB_PRE.self::$mCityTable."`.`proid` ASC,`".DB_PRE.self::$mCityTable."`.`id` ASC");
        }
        else
        {
            return MySql::fetchAll("SELECT * FROM `".DB_PRE.self::$mCityTable."` WHERE `".DB_PRE.self::$mCityTable."`.`proid`=$proid ORDER BY `".DB_PRE.self::$mCityTable."`.`id` ASC");
        }
    }
    public static function getAllAreaInfo($info)
    {

        $cityid=intval($info['cityid']);
        $parentid=intval($info['proid']);

        if(!$cityid)
        {
            return MySql::fetchAll("SELECT * FROM `".DB_PRE.self::$mAreaTable."` WHERE	`".DB_PRE.self::$mAreaTable."`.`parentid`=$parentid ORDER BY `".DB_PRE.self::$mAreaTable."`.`id` ASC");
        }
        else
        {
            return MySql::fetchAll("SELECT * FROM `".DB_PRE.self::$mAreaTable."` WHERE `".DB_PRE.self::$mAreaTable."`.`parentid`=$parentid AND `".DB_PRE.self::$mAreaTable."`.`cityid`=$cityid ORDER BY `".DB_PRE.self::$mAreaTable."`.`id` ASC");
        }
    }

    public static function findCajdvudList($info)
    {
        return Mysql::fetchAll("select * from pw_car_litigation where status=0");
    }
    public static function setCajdvudList($info)
    {
        return Mysql::query("update  pw_car_litigation set status= 1 where carid=".$info['carid']);
    }
    public static function findAllCarParameter($info)
    {
        if($info['classID'])
        {
            $condition = "where classid = '".$info['classID']."'";
        }
        else
            $condition="";
        return Mysql::fetchAll("select * from pw_car_para ".$condition);
    }

    public static function modifyCarInfoByUserId($info)
    {
        $result = array();
        $result['code'] = 0;
        $result['message'] = "修改成功";
        if(!$info['userid'])
        {
            $result['code'] = 2001;
            $result['message'] = "userid为空";
            return $result;
        }
        $userid = $info['userid'];
        $data  = MySql::fetchAll("select * from pw_car where userid=".$userid);
        if(!$data)
        {
            $result['code'] = 2002;
            $result['message'] = "userid无效";
            return $result;
        }
         MySql::update("pw_car",$info,'`userid`='.intval($userid));
         return $result;
    }
    public static function modifyCarParameterDetails($info)
    {
        $result = array();
        $result['code'] = 0;
        $result['message'] = "修改成功";
        if(!$info['id'])
        {
            $result['code'] = 2001;
            $result['message'] = "id为空";
            return $result;
        }
        $id = $info['id'];
        $data  = MySql::fetchOne("select * from pw_car_para where id=".$id);
        if(!$data)
        {
            $result['code'] = 2002;
            $result['message'] = "id无效";
            return $result;
        }
        MySql::update("pw_car_para",$info,'`id`='.intval($id));
        return $result;
    }
    public static function modifyCarInfoByCarId($info)
    {
        $result = array();
        $result['code'] = 0;
        $result['message'] = "修改成功";
        if(!$info['id'])
        {
            $result['code'] = 2001;
            $result['message'] = "id为空";
            return $result;
        }
        $id = $info['id'];
        $data  = MySql::fetchOne("select * from pw_car where id=".$id);
        if(!$data)
        {
            $result['code'] = 2002;
            $result['message'] = "id无效";
            return $result;
        }
        MySql::update("pw_car",$info,'`id`='.intval($id));
        return $result;
    }
    public static function isHadShopApplicationByUserid($info)
    {
        $result = array();
        if(!$info['userid'])
    {
        $result['code'] = -1;
        $result['message'] = "userid无效";
        return $result;
    }

        $userid = $info['userid'];
        $userinfo = Mysql::fetchOne("select * from pw_member where userid=".$userid);
        if(!$userinfo)
        {
            $result['code'] = -1;
            $result['message'] = "userid无效";
            return $result;
        }

        $roleid = $userinfo['roleid'];
        if($roleid==7)
        {
            $result['code'] = 0;
            $result['message'] = "您是非会员用户";
            return $result;
        }
        $data = MySql::fetchOne("select * from pw_carsecond_user where userid=".$userid);
        if($data)
        {
            $result['code'] = 1;
            $result['message'] = "您已开二手车店";
            return $result;
        }
        else{
            $result['code'] = 2;
            $result['message'] = "您还未开二手车店";
            return $result;
        }

    }
    public static function updatePhoneNumberByShopId($info)
    {
        $result = array();
        $result['code'] = 0;
        $result['message'] = "修改成功";
        if(!$info['shopid'])
        {
            $result['code'] = 2002;
            $result['message'] = "shopid无效,修改失败";
            return $result;
        }
        if(!$info['telephone'] || !is_telephone($info['telephone']))
        {
            $result['code']=2003;
            $result['message']='手机号码格式不正确';
            return $result;
        }
        MySql::query("update  pw_carsecond_user set `telephone`='".info['telephone']."' where `id`=".intval($info['shopid']));

        return $result;
    }

    public static function updateShopInfoByShopId($info)
    {
        $result = array();
        $result['code'] = 0;
        $result['message'] = "修改成功";
        $shopid = $info['shopid'];
        $data = MySql::fetchOne("select * from pw_carsecond_user where `id`=".intval($shopid));
        $apptime = date('Y-m-d',strtotime($data['apptime']));
        $now_time= date("y-m-d",time());
        $mdtime = MySql::fetchAll("select * from pw_car_mdtime ");
        if($now_time - $apptime <= $mdtime['mdtime'])
        {
            $result['code']=2001;
            $result['message']='规定时间内不可修改';
            return $result;
        }

        if(!$info['shopid'])
        {
            $result['code'] = 2002;
            $result['message'] = "shopid无效,修改失败";
            return $result;
        }
        if(!$info['telephone'] || !is_telephone($info['telephone']))
        {
            $result['code']=2003;
            $result['message']='手机号码格式不正确';
            return $result;
        }

        MySql::update("pw_carsecond_user",$info,'`id`='.intval($shopid));

        //设置点铺下线,且待审核
        MySql::query("update pw_carsecond_user set `linestat`=2,`status`=0");

        return $result;
    }
    public static function setModifyDaysAndCost($info)
    {
        $result = array();
        $result['code'] = 0;
        $result['message'] = '设置成功';
        if(!$info['mdtime'])
        {
            $result['code'] = 2001;
            $result['message'] = '可修改时长为空';
        }
        if(!$info['cost'])
        {
            $result['code'] = 2002;
            $result['message'] = '审核费用为空';
        }
        Mysql::query("delete from pw_car_mdtime");
        Mysql::query("insert into pw_car_mdtime(`mdtime`,`cost`) values (".$info['mdtime'].",".$info['cost'].")");
        return $result;
    }
    public static function getModifyDaysAndCost()
    {
        return Mysql::fetchOne("select * from pw_car_mdtime ");

    }

    public static function getStatusByUserId($info)
    {
        $userid = $info['userid'];
        $data = Mysql::fetchOne("select `status` from pw_carsecond_user where userid=".intval($userid));
        if($data)
        {
            return $data;
        }
       return false;//数据不存在
    }

    public static function setMessageReaded($info)
    {
        $userid = $info['userid'];
        $data = Mysql::query("update pw_car_inform set `status`=1 where secuserid=".intval($userid));
        if($data)
        {
            return $data;
        }
        return false;//数据不存在
    }

    public static function isModifyhopInfoByShopid($info)
    {
        $shopid = $info['shopid'];

        $data = Mysql::fetchOne("select * from pw_carsecond_user where id=".$shopid);
        if(!data)
        {
            return ;
        }
        $time = $data['apptime'];
        $days = Mysql::fetchOne("select * from pw_car_mdtime ");
        $day = $days['mdtime'];
        $mday = date('Y-m-d H:i:s',strtotime("-".$day." day"));
        if($mday > $time)
        {
            return true;//可修改
        }
        return false;//不能修改
    }
}