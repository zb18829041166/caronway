<?phpuse wechat\Usedcarmall\Usedcarmall;use wechat\Usedcarmall\Currentuserinfo;use wechat\Usedcarmall\Secondhandcar;use wechat\Usedcarmall\Secondcar;use wechat\Usedcarmall\Mutilfileupload;use wechat\Usedcarmall\Basepara_setting;//定义接口函数function API($API){    //参数条件    header('Access-Control-Allow-Origin:*');    header("Access-Control-Allow-Credentials:true");    header("Access-Control-Allow-Methods:*");    header("Access-Control-Allow-Headers:Access-Token,Origin, X-Requested-With, Content-Type, Accept,Authorization");    header("Access-Control-Expose-Headers:*");    header("ContentType:application/json");    //调用接口 a    switch ($API){        //二手车模糊查询        case "queryUsedCarBaseInfo":$output=Usedcarmall::queryUsedCarBaseInfo($_POST);break;        //个人车辆信息模糊查询        case "queryPersonCarBaseInfo":$output=Usedcarmall::queryPersonCarBaseInfo($_POST);break;        //获取二手车基本信息        case "getUsedCarBaseInfo":$output=Usedcarmall::getUsedCarBaseInfo($_POST);break;        //获取二手车详细信息        case "getUsedCarDetailInfo":$output=Usedcarmall::getUsedCarDetailInfo($_POST);break;        //获取店铺名称和logo        case "getCarMallLogoAndName":$output=Usedcarmall::getCarMallLogoAndName($_POST);break;        //获取店铺详细信息        case "getCarMallInfo":$output=Usedcarmall::getCarMallInfo($_POST);break;        //获取店铺车辆信息        case "getCarMallCarInfo":$output=Usedcarmall::getCarMallCarInfo($_POST);break;        //获取个人车主车辆基本信息        case "getPersonUsedCarBaseInfo":$output=Usedcarmall::getPersonUsedCarBaseInfo($_POST);break;        //投诉信息保存接口        case "saveFeedbackInfo":$output=Usedcarmall::saveFeedbackInfo($_POST);break;        //个人会员上传车辆信息        case "upPersonMyCarInfo":$output=Usedcarmall::upPersonMyCarInfo($_POST);break;        //测试接口        case "test":$output=Usedcarmall::test();  break;        //注册        case "register":$output=Secondhandcar::register($_POST);  break;        //登入        case "login":$output=Secondhandcar::login($_POST);  break;        //申请建店        case "createShop":$output=Secondhandcar::createShop($_POST);  break;        //上传我的车辆信息        case "createMyCarInfo":$output=Secondhandcar::createMyCarInfo($_POST);  break;        //专员创建1车系        case "createFirstClass":$output = Secondcar::createFirstClass($_POST); break;        //获得1车系        case "getFirstClass":$output = Secondcar::getFirstClass($_POST); break;        //专员创建2车系        case "createSecondClassByPid":$output = Secondcar::createSecondClassByPid($_POST); break;        //获得2车系        case "getSecondClassByPid":$output = Secondcar::getSecondClassByPid($_POST); break;        //专员创建车辆公共参数        case "createCarParameter":$output=Secondhandcar::createCarParameter($_POST);  break;        //获取车辆公共参数        case "findAllCarParameter":$output=Secondhandcar::findAllCarParameter($_POST);  break;        //申请增加车辆展位        case "addCarPosition":$output=Secondhandcar::addCarPosition($_POST);  break;        //游客投诉        case "cajdvud":$output=Secondhandcar::cajdvud($_POST);  break;        //专员查看投诉列表        case "findCajdvudList":$output=Secondhandcar::findCajdvudList($_POST);  break;        //设置以处理        case "setCajdvudList":$output=Secondhandcar::setCajdvudList($_POST);  break;        //首页汽车查询        case "getAllCarByCondition":$output=Secondhandcar::getAllCarByCondition($_POST);  break;        //获取当前用户信息        case "getCurUserInfo":$output=Currentuserinfo::getCurUserInfo($_POST);  break;        //根据汽车id获得汽车详细信息        case "getCardetailsById":$output = Secondhandcar::getCardetailsById($_POST);break;        //根据userid获得汽车详细信息        case "getCardetailsByUserId":$output = Secondhandcar::getCardetailsByUserId($_POST);break;        //根据店铺id查询店铺信息        case "getShopDetailsInfoById": $output = Secondhandcar::getShopDetailsInfoByShopId($_POST);break;        //根据用户id查询店铺信息        case "getShopDetailsInfoByUserId": $output = Secondhandcar::getShopDetailsInfoByUserId($_POST);break;        //根据用户id查询汽车信息        case "getCarsByUserId": $output = Secondhandcar::getCarsByUserId($_POST);break;        //根据用户id修改汽车信息        case "modifyCarInfoByUserId": $output = Secondhandcar::modifyCarInfoByUserId($_POST);break;        //根据车辆id修改汽车信息        case "modifyCarInfoByCarId": $output = Secondhandcar::modifyCarInfoByCarId($_POST);break;        //根据车辆id修改汽车参数信息        case "modifyCarParameterDetails": $output = Secondhandcar::modifyCarParameterDetails($_POST);break;        //店铺审核通过        case"checkPassUserShopByShopId":$output =  Secondhandcar::checkPassUserShopByShopId($_POST);break;        //店铺重新提交通过        case"submitShopInfoByShopId":$output =  Secondhandcar::submitShopInfoByShopId($_POST);break;        //店铺审核被拒绝        case"checkRefuseUserShopByShopId":$output =  Secondhandcar::checkRefuseUserShopByShopId($_POST);break;        //用户是否已经有开设二手店铺        case"isHadShopApplicationByUserid": $output =  Secondhandcar::isHadShopApplicationByUserid($_POST);break;        //专员店铺上线        case"setShopOnlineByShopId":$output =  Secondhandcar::setShopOnlineByShopId($_POST);break;        //专员店铺下线        case"setShopOfflineByShopId":$output =  Secondhandcar::setShopOfflineByShopId($_POST);break;        //个人车辆上线        case"setMyCarOnlineByCarId":$output =  Secondhandcar::setMyCarOnlineByCarId($_POST);break;        //个人车辆下线        case"setMyCarOfflineByCarId":$output =  Secondhandcar::setMyCarOfflineByCarId($_POST);break;        //专员查看待审核店铺        case"getAllUncheckedShopInfo":$output  = Secondhandcar::getAllUncheckedShop($_POST);break;        //专员查看所有店铺信息        case"getAllShopInfo":$output  = Secondhandcar::getAllShopInfo($_POST);break;        //获取省name和id        case"getAllProvinceInfo":$output = Secondhandcar::getAllProvinceInfo();break;        //获取市name和id        case"getAllCityInfo":$output = Secondhandcar::getAllCityInfo($_POST);break;        //获取区域name和id        case"getAllAreaInfo":$output = Secondhandcar::getAllAreaInfo($_POST);break;        //图片上传        case"uploadImage" :$output = Mutilfileupload::upload($_FILES);break;        //专员设置基础展位        case "setBaseSpotCount":$output = Basepara_setting::setBaseSpotCount($_POST);break;        //专员查看基础展位        case "viewBaseSpotCount":$output = Basepara_setting::viewBaseSpotCount($_POST);break;        //专员修改基础展位        case "modifyBaseSpotCount":$output = Basepara_setting::modifyBaseSpotCount($_POST);break;        //折扣信息列表        case "findDiscountArrayInfo":$output = Basepara_setting::findDiscountArrayInfo($_POST);break;        //专员添加折扣        case "addDiscountArrayInfo":$output = Basepara_setting::addDiscountArrayInfo($_POST);break;        //专员修改折扣        case "modifyDiscountInfoBySeason":$output = Basepara_setting::modifyDiscountInfoBySeason($_POST);break;        //判断车商申请展位        case "applySpotByCount":$output = Basepara_setting::applySpotByCount($_POST);break;        //设置展位申请        case "setappedspot":$output = Basepara_setting::setappedspot($_POST);break;        //根据用户ID查询用户角色        case "getUserIndentify":$output = currentuserinfo::getUserIndentify($_POST);break;        //专员发起通知(个人)        case"sendInformationToOne":$output = Basepara_setting::sendInformationToOne($_POST);break;        //专员发起通知(全部会员)        case"sendInformationToALL":$output = Basepara_setting::sendInformationToALL($_POST);break;        //专员发起通知（全部普通会员）        case"sendInformationToMembers":$output = Basepara_setting::sendInformationToMembers($_POST);break;        //专员发起通知（全部车商会员）        case"sendInformationTocarMembers":$output = Basepara_setting::sendInformationTocarMembers($_POST);break;        //我的通知        case "MyInformation":$output = Basepara_setting::MyInformation($_POST);break;        //我的未看通知个数        case "MyInformationCounts":$output = Basepara_setting::MyInformationCounts($_POST);break;        //查看通知        case "checkMyInformation":$output = Basepara_setting::checkMyInformation($_POST);break;        //查看通知        case "paymentNoticeList":$output = Basepara_setting::paymentNoticeList($_POST);break;        //查看通知        case "getUserInfoByUserid":$output = Currentuserinfo::getUserInfoByUserid($_POST);break;        //查看车辆上线状态        case "checkCarStatusByUserId":$output = Secondcar::checkCarStatusByUserId($_POST);break;        //更新店铺手机        case "updatePhoneNumberByShopId":$output = Secondhandcar::updatePhoneNumberByShopId($_POST);break;        //修改店铺信息        case "updateShopInfoByShopId":$output = Secondhandcar::updateShopInfoByShopId($_POST);break;        //isOKtoUploadCarInfoByShopId        case "isOKtoUploadCarInfoByShopId":$output = Basepara_setting::isOKtoUploadCarInfoByShopId($_POST);break;        //手机验证码        case "insertTelAndMessCode" :$output = Currentuserinfo::insertTelAndMessCode($_POST);break;        //获取手机验证码        case "getMessCodeByTel" :$output = Currentuserinfo::getMessCodeByTel($_POST);break;        //设置审核费用以及可修改信息的最大时长        case "setDaysToModifyShopInfo" :$output = Secondhandcar::setModifyDaysAndCost($_POST);break;        //获取审核费用以及可修改信息的最大时长        case "getDaysToModifyShopInfo" :$output = Secondhandcar::getModifyDaysAndCost($_POST);break;        //获取店铺状态        case "getStatusByUserId" :$output = Secondhandcar::getStatusByUserId($_POST);break;        //设置消息已读        case "setMessageReaded" :$output = Secondhandcar::setMessageReaded($_POST);break;        //判断消息是否可修改        case "isModifyhopInfoByShopid" :$output = Secondhandcar::isModifyhopInfoByShopid($_POST);break;        default:$output = array('data' => NULL, 'info' => '该接口不存在!'.$API, 'code' => -201);break;//接口错误    }    exit(json_encode($output,JSON_UNESCAPED_UNICODE));}?>