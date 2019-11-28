<?php

// +----------------------------------------------------------------------

// | phpWeChat usedcarmall 操作类 Last modified 2019-04-29 08:07:35

// +----------------------------------------------------------------------

// | Copyright (c) 2009-2016 phpWeChat http://www.phpwechat.com All rights reserved.

// +----------------------------------------------------------------------

// | Author: 骑马的少年 <phpwechat@126.com> <http://www.phpwechat.com>

// +----------------------------------------------------------------------

namespace wechat\Usedcarmall;


use phpWeChat\Area;

use phpWeChat\CaChe;

use phpWeChat\Config;

use phpWeChat\DataInput;

use phpWeChat\DataList;

use phpWeChat\Member;

use phpWeChat\Module;

use phpWeChat\MySql;

use phpWeChat\Order;

use phpWeChat\Upload;



class Usedcarmall

{

    public static $mPageString=''; // 这个静态成员是系统自带，请勿删除
    public static $mTotalPage=0; // 这个静态成员是系统自带，请勿删除
    public static $secCarTable='car';
    /*
     * 车辆模糊搜索,显示基本信息
     * data:传入参数数组
     * result:返回的数据
     */
    public static function queryUsedCarBaseInfo($data){
        $condition=$data["condition"];
        if(!$data['start']){
            $data['start']=0;
        }
        if(!$data['end']){
            $data['end']=6;
        }
        $sql="SELECT
                    *
                FROM
                    (
                        SELECT
                            pw_car.id,
                            pw_car.age,
                            pw_car.userid,
                            pw_car.frontpic,
                            pw_car_para.realprice,
                            pw_car_para.gearbox,
                            pw_car.hadkm,
                            pw_carsecond_user.realname,
                            concat(
                                pw_province.`name`,
                                pw_city.`name`
                            ) AS place,
                            concat(
                                            pw_car_para.classid,
                                            pw_car_para.classcid
                                        ) AS carName
                        FROM
                            pw_car,
                            pw_car_para,
                            pw_city,
                            pw_province,
                            pw_carsecond_user
                        WHERE
                            pw_car.paraid = pw_car_para.id
                        AND pw_city.id = pw_car.cityid
                        AND pw_province.id = pw_car.provinceid
                AND	pw_car.userid=pw_carsecond_user.userid
                AND pw_car.type='1'
                    ) temp
                WHERE
                    CONCAT(
                        IFNULL(hadkm, ''),
                        IFNULL(gearbox, ''),
                        IFNULL(realprice, ''),
                        IFNULL(place, ''),
                        IFNULL(realname, ''),
                        IFNULL(age,''),
                        IFNULL(carName,'')
                    ) LIKE '%$condition%'  LIMIT {$data['start']},{$data['end']}";
        $result=Mysql::fetchAll($sql);
        return $result;
    }

    /*
        * 个人会员车辆模糊搜索,显示基本信息
        * data:传入参数数组
        * result:返回的数据
        */
    public static function queryPersonCarBaseInfo($data){
        $condition=$data["condition"];
        $sql="SELECT
                    *
                FROM
                    (
                        SELECT
                            pw_car.id AS carid,
                            pw_car.userid,
                            pw_car.hadkm,
                            CONCAT(
                                pw_province.`name`,
                                pw_city.`name`
                            ) AS place,
                            pw_car.regtime,
                            pw_car.instime,
                            pw_car.age,
                            pw_car.times,
                            pw_car.frontpic,
                            pw_car.rightside,
                            pw_car.rearview,
                            pw_car.leftside,
                            pw_car.frontcover,
                            pw_car.interior1,
                            pw_car.interior2,
                            pw_car.interior3,
                            pw_car_para.*
                        FROM
                            pw_car,
                            pw_car_para,
                            pw_province,
                            pw_city
                        WHERE
                            pw_car.paraid = pw_car_para.id
                        AND pw_car.type = 1
                        AND pw_car.provinceid = pw_province.id
                        AND pw_car.cityid = pw_city.id
                    ) temp
                WHERE
                    temp.userid NOT IN (
                        SELECT
                            userid
                        FROM
                            pw_carsecond_user
                    )
                AND CONCAT(
                    IFNULL(hadkm, ''),
                    IFNULL(gearbox, ''),
                    IFNULL(realprice, ''),
                    IFNULL(place, ''),
                    IFNULL(age, ''),
                    IFNULL(classcid, ''),
                    IFNULL(classid, '')
                ) LIKE '%$condition%'";

        $result=Mysql::fetchAll($sql);
        return $result;
    }



    //获取二手车基本信息
    public static function getUsedCarBaseInfo($data){
        $condition=$data;
        if(!(array_key_exists("start",$data)||array_key_exists("end",$data))){
            $condition=array("start"=>0,"end"=>6);
        }
        //echo $condition["start"].$condition["end"];
        $sql="SELECT
                    *
                FROM
                    (
                        SELECT
                            pw_car.id,
                            pw_car.userid,
                            pw_car.age,
                            pw_carsecond_user.realname,
                            pw_car.frontpic,
                            pw_car_para.realprice,
                            pw_car_para.gearbox,
                            pw_car.hadkm,
                            concat(
                                pw_province.`name`,
                                pw_city.`name`
                            ) AS place,
                            concat(
                                pw_car_para.classid,
                                pw_car_para.classcid
                            ) AS carName
                        FROM
                            pw_car,
                            pw_car_para,
                            pw_city,
                            pw_province,
                            pw_carsecond_user
                        WHERE
                            pw_car.paraid = pw_car_para.id
                        AND pw_city.id = pw_car.cityid
                        AND pw_province.id = pw_car.provinceid
                        AND pw_car.type = 1
                        AND	pw_car.userid=pw_carsecond_user.userid 
                    ) a where userid  in (select userid from pw_carsecond_user) 
                LIMIT {$condition['start']},{$condition['end']}";
        $result=Mysql::fetchAll($sql);
        //echo  $sql;
        return $result;
    }



    //获取个人车主车辆基本信息
    public static function getPersonUsedCarBaseInfo($data){
        if(!$data['userid'])
        {
            $result = array();
            $result['code'] = -1;
            $result['message'] = "userid 为空";
            return $result;
        }
        $sql="SELECT
                *
            FROM
                (
                    SELECT
                        pw_car.id AS carid,
                        pw_car.userid,
                        pw_car.hadkm,
                        CONCAT(pw_province.`name`, pw_city.`name`) as place,
                        pw_car.regtime,
                        pw_car.instime,
                        pw_car.age,
                        pw_car.times,
                        pw_car.frontpic,
                        pw_car.rightside,
                        pw_car.rearview,
                        pw_car.leftside,
                        pw_car.frontcover,
                        pw_car.interior1,
                        pw_car.interior2,
                        pw_car.interior3,
                        pw_car_para.*
                    FROM
                        pw_car,
                        pw_car_para,
                        pw_province,
                        pw_city
                    WHERE
                        pw_car.paraid = pw_car_para.id
                    AND pw_car.type = 1
                    AND pw_car.provinceid = pw_province.id
                    AND pw_car.cityid = pw_city.id
                ) temp
            WHERE
                temp.userid =".$data['userid'];
        if($data["carid"]){
            $sql=$sql."  and carid={$data['carid']}";
        }
        $data=Mysql::fetchAll($sql);
        return $data;
    }


    //获取车商信息的logo图片和名称
    public static function getCarMallLogoAndName($data){
        if(!$data["start"]){
            $data["start"]=0;
        }
        if(!$data["end"]){
            $data["end"]=10;
        }

        $condition=$data;
        $sql="select userid,realname,logoori from pw_carsecond_user  LIMIT {$condition['start']},{$condition['end']}";
        $data=Mysql::fetchAll($sql);
        return $data;
    }

    //获取广告信息
    public static function getAdvInfo(){
        $sql="";
        $data=Mysql::fetchAll($sql);
        return $data;
    }


    //获取车辆详细信息
    public static function getUsedCarDetailInfo($data){
        $carid=$data["carid"];
        $sql="SELECT
			pw_car.id AS carid,
			pw_car.userid,
			pw_car.hadkm,
			CONCAT(pw_province.`name`, pw_city.`name`) as place,
			pw_car.regtime,
			pw_car.instime,
			pw_car.age,
			pw_car.times,
			pw_car.frontpic,
			pw_car.rightside,
			pw_car.rearview,
			pw_car.leftside,
			pw_car.frontcover,
			pw_car.interior1,
			pw_car.interior2,
			pw_car.interior3,
			pw_car_para.*
		FROM
			pw_car,
			pw_car_para,
			pw_province,
			pw_city
		WHERE
			pw_car.paraid = pw_car_para.id
		AND pw_car.type = 1
		AND pw_car.provinceid = pw_province.id
		AND pw_car.cityid = pw_city.id and  pw_car.id='$carid'";

        $data=Mysql::fetchAll($sql);
        return $data;
    }

    /*
     * 获取车商店铺详细信息
     *
     * */
    public static function getCarMallInfo($data){
        $userid=$data["userid"];
        $sql="SELECT
                userid,
                realname,
                telephone,
                pw_province.`name` as province,
                pw_city. NAME as city,
                pw_area.`name` as area,
                address,
                longitude,
                latitude,
                logoori,
                logoshr,
                outimg,
                innimg,
                licimg,
                liccode,
                apptime,
                ontime
            FROM
                pw_carsecond_user,
                pw_province,
                pw_city,
                pw_area
            WHERE
                userid = '$userid'
            AND pw_carsecond_user.province = pw_province.id
            AND pw_carsecond_user.city = pw_city.id
            AND pw_carsecond_user.area = pw_area.id";
        $data=Mysql::fetchAll($sql);
        return $data;
    }



    /*
     *获取某一车商的所有车辆信息
     *
     */
    public static function getCarMallCarInfo($data){
        $userid=$data["userid"];
        $sql="SELECT
                pw_car.*,
                pw_car_para.realprice,
                pw_car_para.gearbox,
                pw_car.hadkm,
                concat(
                    pw_province.`name`,
                    pw_city.`name`
                ) AS place,
                 concat(
                    pw_car_para.classid,
                    pw_car_para.classcid
                ) AS carName
            FROM
                pw_car,
                pw_car_para,
                pw_province,
                pw_city
            WHERE
                pw_car.userid = '$userid'
            AND pw_car.paraid = pw_car_para.id
            AND pw_car.type = 1
             AND pw_city.id = pw_car.cityid
		    AND pw_province.id = pw_car.provinceid";
        $data=Mysql::fetchAll($sql);
        return $data;

    }


    /*
     * 投诉处理接口
     * 参数：userid:用户编号
     * shopid:车商编号
     * content
     */

    public static function saveFeedbackInfo($condition){

        $data=Mysql::insert("pw_car_litigation",array('shopid'=>$condition['shopid'],'content'=>$condition['content']));
        echo $data;
        return $data;
    }

    /*
        * 上传个人会员车辆信息
        *
        *
        *
        */
    public static function upPersonMyCarInfo($info)
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
        if(!$info['provinceid']||!$info["cityid"])
        {
            $data['errcode']=3017;
            $data['errstr']='上牌城市不能为空';
            return $data;
        }
        if(!$info['type'])
        {
            $info["type"]=1;

        }
        MySql::insert(DB_PRE.self::$secCarTable,$info,true);
        return $data;
    }


    //test
    public static function test()
    {
        $result = array(
            "code" => '200',
            "message" => 'success'
        );
        return $result;

    }
}



?>