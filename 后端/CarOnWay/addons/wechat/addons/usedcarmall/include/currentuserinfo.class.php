<?php
/**
 * Created by PhpStorm.
 * User: hezlong
 * Date: 2019/4/28
 * Time: 15:24
 */
namespace wechat\Usedcarmall;
use phpWeChat\Mysql;

class Currentuserinfo
{

    public static $mPageString='';
    public static $mTotalPage=0;
    public static $mMemberTable='member';
    public static $telAndCodeTable='telAndCode'; //表名

    //保存电话和验证码
    public static function   insertTelAndMessCode($input){
        $result=array();

        $result['resultCode']=1000;
        $result["flag"]=false;
        $result["message"]="保存成功";
        if(!$input["telphone"]){
            $result['resultCode']=1001;
            $result["message"]="telphone:手机号码不能为空";
            return $result;

        }
        if(!$input["code"]){
            $result['resultCode']=1002;
            $result["message"]="code:验证码不能为空";
            return $result;
        }
        $input["time"]=date('Y-m-d h:i:s', time());
        Mysql::insert(DB_PRE.self::$telAndCodeTable,$input,true);
        $result["flag"]=true;
        return $result;

    }

    //t通过手机号获取验证码
    public static  function  getMessCodeByTel($input){
        $result=array();

        $result['resultCode']=2000;
        $result["flag"]=false;
        $result["message"]="请求成功";
        if(!$input["telphone"]){
            $result['resultCode']=2001;
            $result["message"]="telphone:手机号码不能为空";
            return $result;
        }
        $sql="select a.code from (select  * from pw_telAndCode  where telphone='{$input['telphone']}') a   ORDER BY id DESC  limit 1 ";
        $result=Mysql::fetchAll($sql);
        return $result;


    }
     public static function getCurUserInfo($info)

    {
        $openid = $info['openid'];
        $unionid = $info['unionid'];
        if($openid)
        {
            $data = MySql::fetchOne("SELECT * FROM `".DB_PRE.self::$mMemberTable."` WHERE `openid`='".trim($openid)."'");
            return $data;
        }
        if($unionid)
        {
            $data = MySql::fetchOne("SELECT * FROM `".DB_PRE.self::$mMemberTable."` WHERE `unionid`='".trim($unionid)."'");
            return $data;
        }
       
    }

    public static function getUserIndentify($info)
    {
        $result = array();
        $result['code'] = 0;
        $result['message'] = '用户id不能为空';
        if(!$info['userid'])
        {
            return $result;
        }
        $data = Mysql::fetchOne("select ro.type from pw_car_role ro ,pw_member m where m.roleid = ro.id ");
        if(!$data)
        {
            $result['code'] = 0;
            $result['message'] = '无身份';
            return $data;
        }
        return $data;
    }
    public static function getUserInfoByUserid($info)
    {
        $userid = $info['userid'];
        if(!$userid)
        {
            $result = array();
            $result['code'] = 0;
            $result['message'] = '用户id不能为空';
            return $result;
        }

        $data = MySql::fetchOne("SELECT * FROM `".DB_PRE.self::$mMemberTable."` WHERE `userid`='".trim($userid)."'");
        return $data;
    }
    public static function getUserByOpenId($openid)
    {
        return Mysql::fetchOne("select * from pw_member where openid='".$openid."'");
    }

    public static function getUserByUnionId($unionid)
    {
        return Mysql::fetchOne("select * from pw_member where unionid='".$unionid."'");
    }
}