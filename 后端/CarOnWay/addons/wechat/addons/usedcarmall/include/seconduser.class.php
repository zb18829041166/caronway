<?php
/**
 * Created by PhpStorm.
 * User: hezlong
 * Date: 2019/4/27
 * Time: 22:41
 */
namespace wechat\Usedcarmall;
use phpWeChat\MySql;

use phpWeChat\Area;

use phpWeChat\CaChe;

use phpWeChat\Config;

use phpWeChat\Member;

use phpWeChat\Module;

use phpWeChat\Order;
class Seconduser
{
    public static $mPageString='';
    public static $mTotalPage=0;
    public static $usertable='carsecond_user';
    public static $membertable='member';
    public static $Tousutable='car_litigation';

    public static function getAppInfo($id,$f='*')
    {
        $r=MySql::fetchOne("SELECT * FROM `".DB_PRE.self::$usertable."` WHERE `id`=".intval($id));
        return $f=='*'?$r:$r[$f];
    }

    public static function appInfoEdit($info,$id)
    {
        $info['status']=intval($info['status']);

        if($info['status'])
        {
            $r=self::getAppInfo($id);
            MySql::query("UPDATE ".DB_PRE.self::$usertable." SET `status`=0 WHERE id=".intval($r['userid']));
        }

        return MySql::update(DB_PRE.self::$usertable,$info,'`id`='.intval($id));
    }

    public static function appInfoAdd($info)
    {
        MySql::insert(DB_PRE.self::$usertable,$info,true);
        return true;
    }
    public static function deleteAppInfo($ids)
    {
        $ids=is_array($ids)?array_map('intval',$ids):array(intval($ids));
        if(!$ids)
        {
            return -1;
        }
        return MySql::mysqlDelete(DB_PRE.self::$usertable,$ids,'id');
    }

    public static function myAppList($userid=0)
    {
        return MySql::fetchAll("SELECT * FROM `".DB_PRE.self::$usertable."` WHERE `userid`=".intval($userid)." ORDER BY `id` ASC");
    }

    public static function concelAppInfo($id)
    {
        return  MySql::query("UPDATE ".DB_PRE.self::$usertable." SET `status`=3 WHERE id=".intval($id));
    }
    public static function submitAppInfo($id)
    {
        return  MySql::query("UPDATE ".DB_PRE.self::$usertable." SET `status`=0 WHERE id=".intval($id));
    }

    public static function onineAppInfo($id)
    {
        return  MySql::query("UPDATE ".DB_PRE.self::$usertable." SET `linestat`= 1 WHERE id=".intval($id));
    }
    public static function offineAppInfo($id)
    {
        return  MySql::query("UPDATE ".DB_PRE.self::$usertable." SET `linestat`= 2 WHERE id=".intval($id));
    }
    public static function getApprefuseReason($id,$f='*')
    {
        $r=MySql::fetchOne("SELECT * FROM `".DB_PRE.self::$usertable."` WHERE status=2 and  `id`=".intval($id));
        return $f=='*'?$r:$r[$f];
    }
    public static function getuserShopDataById($userid)
    {
        return MySql::fetchOne("SELECT * FROM `".DB_PRE.self::$usertable."` WHERE  `userid`=".intval($userid));
    }

    public static function register($info)
    {
        MySql::insert(DB_PRE.self::$membertable,$info,true);
        return true;
    }
    public  static function getUserInfoByPwd($userpwd,$telephone)
    {
        $userpwd = md5($userpwd);
        $data = Mysql::fetchOne("select * from ".DB_PRE.self::$membertable." where userpwd=".$userpwd." and telephone = ".$telephone);
        return $data;
    }
    public static function insertTouSuInfo($info)
    {
        MySql::insert(DB_PRE.self::$Tousutable,$info,true);
        return true;
    }
}