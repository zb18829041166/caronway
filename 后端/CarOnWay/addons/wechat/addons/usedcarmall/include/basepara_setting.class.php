<?php
/**
 * Created by PhpStorm.
 * User: hezlong
 * Date: 2019/4/28
 * Time: 15:24
 */
namespace wechat\Usedcarmall;

use phpWeChat\MySql;
class Basepara_setting
{
    public static $mPageString='';
    public static $mTotalPage=0;
    public static $spotTable='car_spot';
    public static $discountTable="car_discount";

    public static function viewBaseSpotCount()
    {
        $data =  MySql::fetchAll("SELECT * FROM `pw_car_basespot`");//shopid,basespot,maxspot,appedspot
        return $data;
    }
    public static function setBaseSpotCount($info)
    {
        $result = array();
        $result['code'] = 0;
        $result['message'] = "设置成功";
        if(!$info['basespot'])
        {
            $result['code'] = 2001;
            $result['message']="基础展位数为空";
            return $result;
        }
        if(!$info['maxspot'])
        {
            $result['code'] = 2002;
            $result['message']="最大展位数为空";
            return $result;
        }
        Mysql::query("delete from pw_car_basespot");
        MySql::query("insert into pw_car_basespot (`basespot`,`maxspot`) VALUES (".intval($info['basespot']).", ".intval($info['maxspot']).")");
        return $result;
    }

    public static function modifyBaseSpotCount($info)
    {
        $result = array();
        $result['code'] = 0;
        $result['message'] = "更新成功";
        if(!$info['basespot'])
        {
            $result['code'] = 2001;
            $result['message']="基础展位数为空";
            return $result;
        }
        if(!$info['maxspot'])
        {
            $result['code'] = 2002;
            $result['message']="最大展位数为空";
            return $result;
        }
        MySql::query("update pw_car_basespot set basespot = ".intval($info['basespot']).", maxspot = ".intval($info['maxspot']));
        Mysql::query("update pw_car_spot set basespot=".intval($info['basespot']));
        return $result;
    }

    public static function addDiscountArrayInfo($info)
    {
        $result = array();
        $result['code'] = 0;
        $result['message'] = "添加成功";
        if(!$info['seasons'])
        {
            $result['code'] = 2001;
            $result['message']="季度数为空";
            return $result;
        }
        if(!$info['discount'])
        {
            $result['code'] = 2002;
            $result['message']="折扣为空";
            return $result;
        }
        if(!$info['price'])
        {
            $result['code'] = 2002;
            $result['message']="价格为空";
            return $result;
        }
        MySql::query("insert into pw_car_discount (`seasons`,`discount`,`price`) VALUES (".intval($info['seasons']).",".intval($info['discount']).",".$info['price'].")");
        return $result;
    }
    public static function modifyDiscountInfoBySeason($info)
    {
        $result = array();
        $result['code'] = 0;
        $result['message'] = "修改成功";
        if(!$info['seasons'])
        {
            $result['code'] = 2001;
            $result['message']="季度数为空";
            return $result;
        }
        if(!$info['discount'])
        {
            $result['code'] = 2002;
            $result['message']="折扣为空";
            return $result;
        }
        if(!$info['price'])
        {
            $result['code'] = 2002;
            $result['message']="价格为空";
            return $result;
        }
        MySql::query("update pw_car_discount set `price`=".$info['price']." , `discount`= ".intval($info['discount'])." where `seasons`=".intval($info['seasons']));
        return $result;
    }
    public static function applySpotByCount($info)
    {
        $result = array();
        $result['code'] = 0;
        $result['message']="可申请";
        $shopid = $info['shopid'];
        $appcount = $info['appcount'];
        if(!$shopid)
        {
            $result['code'] = 2001;
            $result['message']="店铺id为空";
        }
        if(!$appcount)
        {
            $result['code'] = 2001;
            $result['message']="申请数量为空";
        }
        $data = Mysql::fetchOne("select basespot,appedspot,maxspot from pw_car_spot where shopid = ".intval($shopid));
        $hadbasespot = intval($data['basespot']);
        $hadappedspot = intval($data['appedspot']);
        $maxspot = intval($data['maxspot']);
        if($maxspot==($hadbasespot + $hadappedspot))
        {
            $result['code'] = 2002;
            $result['message']="申请数量已达最大量：".($hadbasespot + $hadappedspot)."，不能再申请";
            return $result;
        }
        if($maxspot<($hadbasespot + $hadappedspot + $appcount))
        {
            $maxapp = $maxspot-($hadbasespot + $hadappedspot);
            $result['code'] = 2003;
            $result['message']="申请数量超出最大可申请数，最多申请数为：".$maxapp;
            return $result;
        }
     //   $appedspot = $hadappedspot + $appcount;
//        Mysql::query("update pw_car_spot set `appedspot` =".$appedspot);
        return $result;
    }

    public static function setappedspot($info)
    {
        $result = array();
        $result['code'] = 0;
        $result['message']="申请成功";
        $shopid = $info['shopid'];
        $appcount = $info['appcount'];
        if(!$shopid)
        {
            $result['code'] = 2001;
            $result['message']="店铺id为空";
        }
        if(!$appcount)
        {
            $result['code'] = 2001;
            $result['message']="申请数量为空";
        }
        $data = Mysql::fetchOne("select basespot,appedspot,maxspot from pw_car_spot where shopid = ".intval($shopid));
        $hadbasespot = intval($data['basespot']);
        $hadappedspot = intval($data['appedspot']);
        $maxspot = intval($data['maxspot']);
        if($maxspot==($hadbasespot + $hadappedspot))
        {
            $result['code'] = 2002;
            $result['message']="申请数量已达最大量：".($hadbasespot + $hadappedspot)."，已不能再申请";
            return $result;
        }
        if($maxspot<($hadbasespot + $hadappedspot + $appcount))
        {
            $maxapp = $maxspot-($hadbasespot + $hadappedspot);
            $result['code'] = 2003;
            $result['message']="申请数量超出最大可申请数，最多申请数为：".$maxapp;
            return $result;
        }
        $appedspot = $hadappedspot + $appcount;
        Mysql::query("update pw_car_spot set `appedspot` =".$appedspot);
        return $result;
    }


    public static function sendInformationToOne($info)
    {
        $result = array();
        $result['code'] = 0;
        $result['meaasge'] = '通知发出成功';
        if(!$info['secuserid'])
        {
            $result['code'] = 2001;
            $result['meaasge'] = '被通知人为空';
            return $result;
        }
        if(!$info['userid'])
        {
            $result['code'] = 2002;
            $result['meaasge'] = '专员id为空';
            return $result;
        }
        if(!$info['content'])
        {
            $result['code'] = 2003;
            $result['meaasge'] = '通知内容为空';
            return $result;
        }
        Mysql::query("insert into pw_car_inform (userid,secuserid,content,toOne)values (".$info['userid'].",".$info['secuserid'].",'".$info['content']."',0 )");
        return $result;
    }public static function sendInformationTocarMembers($info)
    {
        $result = array();
        $result['code'] = 0;
        $result['meaasge'] = '通知发出成功';

        if(!$info['userid'])
        {
            $result['code'] = 2002;
            $result['meaasge'] = '专员id为空';
            return $result;
        }
        if(!$info['content'])
        {
            $result['code'] = 2003;
            $result['meaasge'] = '通知内容为空';
            return $result;
        }
        Mysql::query("insert into pw_car_inform (userid,content,toOne)values (".$info['userid'].",'".$info['content']."',1 )");
        return $result;
    }
    public static function sendInformationToALL($info)
    {
        $result = array();
        $result['code'] = 0;
        $result['meaasge'] = '通知发出成功';

        if(!$info['userid'])
        {
            $result['code'] = 2002;
            $result['meaasge'] = '专员id为空';
            return $result;
        }
        if(!$info['content'])
        {
            $result['code'] = 2003;
            $result['meaasge'] = '通知内容为空';
            return $result;
        }
        Mysql::query("insert into pw_car_inform (userid,content,toOne)values (".$info['userid'].",'".$info['content']."',2 )");
        return $result;
    }
    public static function sendInformationToMembers($info)
    {
        $result = array();
        $result['code'] = 0;
        $result['meaasge'] = '通知发出成功';

        if(!$info['userid'])
        {
            $result['code'] = 2002;
            $result['meaasge'] = '专员id为空';
            return $result;
        }
        if(!$info['content'])
        {
            $result['code'] = 2003;
            $result['meaasge'] = '通知内容为空';
            return $result;
        }
        Mysql::query("insert into pw_car_inform (userid,content,toOne)values (".$info['userid'].",'".$info['content']."',3)");
        return $result;
    }
    public static function MyInformation($info)
    {
        $result = array();
        $result['code'] = 0;
        $result['meaasge'] = '获取通知失败';
        if(!$info['secuserid'])
        {
            $result['code'] = 0;
            $result['meaasge'] = 'secuserid为空';
        }
        //	0 对个人 1 全部会员 2 全部车商 3 全部普通会员
        //根据userid获取角色类型获取通知类型
//        $roleid = Mysql::fetchOne("select * from pw_member where userid='".$info['userid']."'");
//
//        if($roleid)
//        {
//            if($roleid['roleid']==5)//普通会员
//            {
//                $type = 3;
//            }
//            if($roleid['roleid']==6)//车商
//            {
//                $type = 2;
//            }
//            if($roleid['roleid']==7)//所有会员
//            {
//                $type = 1 ;
//            }
//            $data  = Mysql::fetchAll("select * from pw_car_inform where toOne = '".$type."' and secuserid='".$info['userid']."'  ORDER BY `time` DESC");
//            return $data;
//        }
//        else{
            $data  = Mysql::fetchAll("select * from pw_car_inform where   secuserid='".$info['secuserid']."' and `status`=0  ORDER BY `time` DESC");
            return $data;
//        }
    }

    public static function MyInformationCounts($info)
    {
        $result = array();
        $result['code'] = 0;
        $result['meaasge'] = '获取通知失败';
        if(!$info['userid'])
        {
            $result['code'] = 0;
            $result['meaasge'] = 'userid为空';
        }
//        //根据userid获取角色类型获取通知类型
//        $roleid = Mysql::fetchOne("select * from pw_member where userid=".!$info['userid']);
//
//        if($roleid)
//        {
//            if($roleid['roleid']==5)//普通会员
//            {
//                $type = 3;
//            }
//            if($roleid['roleid']==6)//车商
//            {
//                $type = 2;
//            }
//            if($roleid['roleid']==7)//所有会员
//            {
//                $type = 1 ;
//            }
          //  $data=Mysql::query("SELECT *  FROM `pw_car_inform` where status= 0 and toOne = ".$type." and   secuserid=".$info['userid']);
            $data=Mysql::query("SELECT *  FROM `pw_car_inform` where status= 0  and   secuserid=".$info['userid']);
            $number = mysql_num_rows($data);
            if($data)
            {
                return 0;
            }
            return $number;
  //      }

    }
    public static function checkMyInformation($info)
    {
        $result = array();
        $result['code'] = 0;
        $result['meaasge'] = '查看通知成功';
        if(!$info['id'])
        {
            $result['code'] = 0;
            $result['meaasge'] = 'id为空';
        }
        Mysql::query("update pw_car_inform set status = 1 where id=".$info['id']);
        return $result;
    }

    public static function findDiscountArrayInfo($info)
    {
        return Mysql::fetchAll("select * from pw_car_discount");
    }
    public static function paymentNoticeList($info)
    {
        return Mysql::fetchAll("select * from pw_car_discount");
    }
    public static function isOKtoUploadCarInfoByShopId($info)
    {
        $shopid = $info['shopid'];
        $data = MySql::fetchOne("select * from pw_car_spot where shopid=".intval($shopid));
        if(!$data)
        {
            $result = array();
            $result['code'] = -1;
            $result['meaasge'] = 'shopid无效';
            return $result;
        }
        $base = $data['basespot'];
        $apped = $data['appedspot'];
        $max = $data['maxspot'];
        if($max == $base+ $apped)
        {
            return false;
        }
        return ture;
    }
}