<?php
/**
 * Created by PhpStorm.
 * User: hezlong
 * Date: 2019/5/1
 * Time: 11:58
 */
namespace wechat\Usedcarmall;
use phpWeChat\MySql;

use phpWeChat\Area;

use phpWeChat\CaChe;

use phpWeChat\Config;

use phpWeChat\Member;

use phpWeChat\Module;

use phpWeChat\Order;
class Secondcar
{
    public static $mPageString='';
    public static $mTotalPage=0;
    public static $carparaTable='car_para';
    public static $secCarTable='car';
    public static $car_class='car_class';

    public static function getAllList()
    {
        return MySql::fetchAll("SELECT p.id,
                                            c.carType AS classid,
                                            p.model,
                                            p.classes,
                                            p.energyType,
                                            p.timemarket,
                                            p.motor,
                                            p.maxkw,
                                            p.maxtorque,
                                            p.gearbox,
                                            p.outline,
                                            p.structure,
                                            p.maxspeed,
                                            p.fuelcsption,
                                            p.hot,
                                            p.placepro,
                                            p.realprice,
                                            p.newprice,
                                            p.fromtype FROM pw_car_para p,pw_car_class c where 	p.classid = c.id ORDER BY `id` ASC");
    }
    public static function getParaInfoById($id)
    {
        return MySql::fetchOne("SELECT p.id,
                                            p.classid,
                                            p.classcid,
                                            p.model,
                                            p.classes,
                                            p.energyType,
                                            p.timemarket,
                                            p.motor,
                                            p.maxkw,
                                            p.maxtorque,
                                            p.gearbox,
                                            p.outline,
                                            p.structure,
                                            p.maxspeed,
                                            p.fuelcsption,
                                            p.hot,
                                            p.placepro,
                                            p.realprice,
                                            p.newprice,
                                            p.fromtype FROM pw_car_para p where p.id=".$id );
    }
    public static function upateParaInfo($info,$id)
    {
        return MySql::update(DB_PRE.self::$carparaTable,$info,'`id`='.intval($id));
    }

    public static function carClassParentList()
    {
        return Mysql::fetchAll("select * from pw_car_class where pid is NULL");
    }

    public static function carClassChildrenList($id)
    {
        $id=intval($id);
        return Mysql::fetchAll("SELECT id,carType FROM pw_car_class  where pid =(select classid from pw_car_para WHERE id=".$id.")");
    }
    public static function carClassChildrenListByPid($pid)
    {
        $pid =intval($pid);
        return Mysql::fetchAll("select * from pw_car_class where pid=".$pid);
    }
    public static function addcarParaInfo($info)
    {
        return MySql::insert(DB_PRE.self::$carparaTable,$info,true);
    }
    public static function setcarParaPassed($id)
    {
       return  Mysql::query("update pw_car_para set fromtype = 1 where id=".$id);
    }
    public static function getCarInfoByUserId($userid)
    {
        //
        return Mysql::fetchAll("SELECT
                                    car.id,
                                       car.classid ,
                                       car.classcid ,
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
                                        car.rightside
                                    FROM
                                        pw_car car,
                                        pw_car_para pa
                                    WHERE
                                        pa.id = car.paraid
                                    AND car.userid =".$userid);
    }

    public static function insertCarInfoByUser($info)
    {
        MySql::insert(DB_PRE.self::$secCarTable,$info,true);
        return true;
    }
    public static function deleteCarInfoByUser($id)
    {
        return Mysql::query("delete from pw_car where id=".$id);
    }
    public static function updateCarInfoByUser($info,$id)
    {
        return MySql::update(DB_PRE.self::$secCarTable,$info,'`id`='.intval($id));
    }
    public static function getCarInfoById($id)
    {
        return Mysql::fetchOne("SELECT * FROM pw_car car WHERE id =".$id);
    }
    public static function createFirstClass($info)
    {
        $result = array();
        $result['code'] = 0;
        $result['message'] = "创建成功";

        if(!$info['carClassName'])
        {
            $result['code'] = 2001;
            $result['message'] = "名字不能为空";
            return $result;
        }
        $data = MySql::fetchOne("select * from pw_car_class where carClassName='".$info['carClassName']."'");
        if($data)
        {
            $result['code'] = 2001;
            $result['message'] = "该名字已存在";
            return $result;
        }
        $info['carType'] = $info['carClassName'];
        $pid = -1;
        MySql::query("insert into pw_car_class (`carClassName`,`carType`,`pid`)values ('".$info['carClassName']."','".$info['carType']."',".$pid.")");
        return $result;
    }
    public static function getFirstClass()
    {
        $data =  Mysql::fetchAll("select *  from pw_car_class where pid= -1");
        return $data;
    }

    public static function getSecondClassByPid($info)
    {
        if(!$info['pid'])
        {
            $result = array();
            $result['code'] = 2001;
            $result['message'] = "pid 为空";
            return $result;
        }
        $pid = intval($info['pid']);
        $data =  Mysql::fetchAll("select *  from pw_car_class where pid=".$pid);
        return $data;
    }
    public static function createSecondClassByPid($info)
    {
        $result = array();
        $result['code'] = 0;
        $result['message'] = "创建成功";

        if(!$info['carClassName'])
        {
            $result['code'] = 2001;
            $result['message'] = "名字不能为空";
            return $result;
        }
        $data = MySql::fetchOne("select * from pw_car_class where carClassName='".$info['carClassName']."'");
        if($data)
        {
            $result['code'] = 2001;
            $result['message'] = "该名字已存在";
            return $result;
        }
        if(!$info['pid'])
        {
            $result['code'] = 2001;
            $result['message'] = "pid不能为空";
            return $result;
        }
        $pid = intval($info['pid']);
        $data = MySql::fetchOne("select * from pw_car_class where pid = ".$pid." and carClassName='".$info['carClassName']."'");
        if($data)
        {
            $result['code'] = 2001;
            $result['message'] = "该名字已存在";
            return $result;
        }
        $info['carType'] = $info['carClassName'];
        MySql::insert(DB_PRE.self::$car_class,$info,true);
        return $result;
    }
    public static function checkCarStatusByUserId($info)
    {
        $result = array();
        $result['code'] = -1;
        $result['meaasge'] = 'userid不能为空';

        if(!$info['userid'])
        {
            return $result;
        }
        $data = MySql::fetchOne("select status from pw_car where `type` = 1 and userid=".$info['userid']);
        return $data;
    }
}