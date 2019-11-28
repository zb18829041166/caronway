<?php

use wechat\Usedcarmall\Usedcarmall;
use wechat\Usedcarmall\Seconduser;
use wechat\Usedcarmall\Secondcar;
use phpWeChat\Area;

use phpWeChat\CaChe;

use phpWeChat\Config;

use phpWeChat\Member;

use phpWeChat\Module;

use phpWeChat\MySql;




!defined('IN_APP') && exit('Access Denied!');

header('Content-Type:application/json; charset=utf-8');
header('Access-Control-Allow-Origin:*');
header("Access-Control-Allow-Credentials:true");
header("Access-Control-Allow-Methods:*");
header("Access-Control-Allow-Headers:Access-Token,Origin, X-Requested-With, Content-Type, Accept,Authorization");
header("Access-Control-Expose-Headers:*");
switch($action)

{
    case 'index':
        break;
    case 'usedCarIndex':
        break;
    /*
     * 接口调用
     * author：niexiongchao
     *
     * */
    //后台给前台传递参数
    case 'api':

        $data=API($API);
        exit(json_decode($data));
        break;

    default:
        break;
}

?>