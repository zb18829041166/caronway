<template>
	<view id="zong">
		<view id="head"  style="background: url(../../static/background.jpg);background-size: cover;">
			<view id="logo" >
				<image  src="/static/logo3.png" style="width: 40%;height: 100%;"></image>
			</view>
			<view style="height: 16%;width: 100%;"></view>
			<view class="list">
				<view class="header"  >
					<view class="bian" >车辆维养</view> 
		        </view >
				<view class="body">
					<view class="modular5">
						<view class="modular4">
							<image class="tu" src="../../static/Repair.png" ></image>
						</view>
						<view class="ziti1" >维修</view>
					</view>
					<view class="interval" ></view>
					
					<view class="modular5">
						<view class="modular4">
							<image class="tu" src="../../static/Repair.png" ></image>
						</view>
						<view class="ziti1" >保养</view>
					</view>
					<view class="interval"></view>
					
					<view class="modular5">
						<view class="modular4">
							<image class="tu" src="../../static/Repair.png" ></image>
						</view>
						<view class="ziti1" >维养</view>
					</view>
					
				</view>
			</view>
			
			<view class="list">
				<view class="header">
					<view class="bian" >保险</view>
				</view>
				<view class="body" >
					<view class="modular5">
						<view class="modular4">
							<image class="tu" src="../../static/Repair.png" ></image>
						</view>
						<view class="ziti1" >最平比价</view>
					</view>
					<view class="interval"></view>
					
					<view class="modular5">
						<view class="modular4">
							<image class="tu" src="../../static/Repair.png" ></image>
						</view>
						<view class="ziti1" >电子账单</view>
					</view>
					<view class="interval"></view>
					
					<view class="modular5">
						<view class="modular4">
							<image class="tu" src="../../static/Repair.png" ></image>
						</view>
						<view class="ziti1" >金融</view>
					</view>
					<view class="interval"></view>
				</view>
			</view>
			<view class="list">
				<view class="header">
					<view class="bian" >开店</view>
				</view>
				<view class="body" >
					<view class="modular5">
						<view class="modular4">
							<image class="tu" src="../../static/Repair.png" ></image>
						</view>
						<view class="ziti1" >维养店</view>
					</view>
					<view class="interval"></view>
					
					<view class="modular5">
						<view class="modular4">
							<image class="tu" src="../../static/Repair.png" ></image>
						</view>
						<view class="ziti1" >新车店</view>
					</view>
					<view class="interval"></view>
					<view class="modular5">
						<view class="modular4">
							<image class="tu" src="../../static/Repair.png" ></image>
						</view>
						<view class="ziti1" >二手车店</view>
					</view>
					<view class="interval"></view>
					
					<view class="modular5">
						<view class="modular4">
							<image class="tu" src="../../static/Repair.png" ></image>
						</view>
						<view class="ziti1" >精品店</view>
					</view>
					<view class="interval"></view>
				</view>
			</view>
			<button class="land" @click="gologin()">
				<view style="font-size: 30upx;margin-top: -8rpx;" >
					会员
				</view>	
			</button>
		</view>
	
		<view class="modular">
			<view style="">
				<view style="font-size: 35rpx;">去逛逛</view>
			</view>
			<view class="">
				<view class="modular3" >
					<button class="san3" >
						<image class="tu1" src="../../static/Repair.png" ></image>
						<view class="ziti4">
							维养
						</view>	
					</button>
				</view>
				<view class="modular3">
					<button class="san3">
						<image class="tu1" src="../../static/Repair.png" ></image>
						<view class="ziti4">
							新车
						</view>	
					</button>
				</view>
				<view class="modular3"  @click="goSecondHandCar()">
					<button class="san3">
						<image class="tu1" src="../../static/Repair.png" ></image>
						<view class="ziti4">
							二手车
						</view>	
					</button>
				</view>
				<view  class="modular3" @click="goFinance()">
					<button class="san3">
						<image class="tu1" src="../../static/Repair.png" ></image>
						<view class="ziti4">
							金融
						</view>	
						
					</button>
				</view>
				<view class="modular3">
					<button class="san3">
						<image class="tu1" src="../../static/Repair.png" ></image>
						<view class="ziti4">
							保险
						</view>	
						
					</button>
				</view>
			</view>
		</view>
		<view class="modular">
			<view style="">
				<view style="font-size: 35rpx;">去开店</view>
			</view>
			<view>
				<view class="modular3" @click="goOpenshop()">
					<button class="san3">
						<image class="tu1" src="../../static/Repair.png" ></image>
						<view class="ziti4">
							维养店
						</view>	
						
					</button>
				</view>
				<view class="modular3" @click="goOpenshop()">
					<button class="san3">
						<image class="tu1" src="../../static/Repair.png" ></image>
						<view class="ziti4">
							新车店
						</view>	
						
					</button>
				</view>
				<view class="modular3" @click="goOpenshop()">
					<button class="san3" >
						<image class="tu1" src="../../static/Repair.png" ></image>
						<view class="ziti4">
							二手车店
						</view>	
						
					</button>
				</view>
			</view>
		</view>
		<view class="modular" >
			<view style="">
				<view style="font-size: 35rpx;">会员特权</view>
			</view>
			<view class="modular3">
				<button class="san3">
					<image class="tu1" src="../../static/Repair.png" ></image>
					<view class="ziti4">
						会员车
					</view>	
					
				</button>
			</view>
			<view class="modular3">
				<button class="san3">
					<image class="tu1" src="../../static/Repair.png" ></image>
					<view class="ziti4">
						管理
					</view>	
				</button>
			</view>
				
			
		</view>
		<view id="tail" style="background-color: #555555;">
			<view style="float: left;width: 70%;">
				<view class="ziti2" >车行路上车俱乐部（www.caronway.cn）版权所有</view>
				<view class="ziti2" >Copynight@2018-2017 CaronwayClub</view>
				<view class="ziti2" >All Rights Reserved</view>
				<view class="ziti2" >桂公网安备4501030200112号</view>
			</view >
			<view style="width: 30%;float: right;height: 100%;">
				<image id="logo2" src="../../static/QR-code.png"></image>
			</view>
		</view>
	</view>
</template>

<script>
    const jweixin = require('../../common/jweixin.js');
	import Guide from  '@/components/guide.vue';
	export default {
		
		components:{
			Guide,
		},
		computed:{
			
		},
		async onLoad() {
			await this.getOpenid();
			await this.getUserInfo();
			this.getSystemInfo();
			if(this.url){
				await this.$appSvc.goCurrentPage(this.url);	
			}
		},
		onShow() {
			if(this.$store.state.openid){
				this.getUserInfo();
			}
		},
		methods:{
			async getOpenid(){
				var url =  window.location.href || document.location.href || '';
				const result = await this.$appSvc.getLoactionUrlData(url);
				this.openid = result.openid ? result.openid : '';
				this.unionid = result.unionid ? result.unionid : '';
				this.url = result.url ? result.url : '';
				this.openid = result.openid ? result.openid : 'oDHlYwUxn1s81UXgPPB04hgAEtdU';
				this.unionid = result.unionid ? result.unionid : 'oFtFo6Om7Ww6keL3RF5ZkYBPeLJk';
				//this.openid = result.openid ? result.openid : 'oDHlYwfrxRVJ0uwIqZUl0ahG9y1k';
				//this.unionid = result.unionid ? result.unionid : 'oFtFo6B5TGB_3HwymLFwk2dZGUIM';
				this.$store.state.openid = this.openid;
				uni.setStorageSync('openid',this.openid);
				this.$store.state.unionid = this.unionid;
				uni.setStorageSync('unionid',this.unionid);
				setTimeout(() =>{
					this.showGuide = false;
				},500)
			},
			goCallPhone() {
				uni.makePhoneCall({
					phoneNumber:'13986007724'
				})
			},
			goRegister(){
				// #ifdef H5
				uni.navigateTo({
					url:'../register/register?type=register',
				})
				// #endif
				 // #ifdef APP-PLUS
                 uni.login({
                 	provider: 'weixin',
                 	success: function(loginRes) {
                 		console.log(JSON.stringify(loginRes));
                 		// 获取用户信息
                 		uni.getUserInfo({
                 			provider: 'weixin',
                 			success: function(infoRes) {
                 				console.log('-------获取微信用户所有-----');
                 				console.log(JSON.stringify(infoRes.userInfo));
								console.log(JSON.stringify(infoRes.userInfo.unionId));
								const openId = infoRes.userInfo.openId;
								const unionId = infoRes.userInfo.unionId;
                 			}
                 		});
                 	}
                 });
               // #endif
			},
			goApplication(){
				uni.navigateTo({
					url:'../application/index/index',
				})
			},
			goFinance()
			{
				uni.navigateTo({
					url:'../Finance/index',
				})
			},
			gologin()
			{
				uni.navigateTo({
					url:'../login/login',
				})
			},
			findOpenid()
			{
               uni.navigateTo({
               	   url:'../becomevip/index/index'
               })
			},
			goSecondHandCar()
			{
				uni.navigateTo({
					url:'../secondhandcar/index/index'
				})
			},
			goOpenshop()
			{
				uni.navigateTo({
						url:'../openshop/shoplist/shoplist'
					})
			},
			goUploadCar() 
			{
				uni.navigateTo({
					url:'../openshop/uploadcar/uploadcar'
				})
			},
			getUserInfo(){
			    const data = {unionid:this.$store.state.unionid};
				const _this = this;
				this.$api('index/get_user_info','POST', data)
				.then(res=>{
					console.log(res.data);
					if(res.data){
						_this.user_info = res.data;
						if(res.data.roleid == '5'){
							_this.role = '普通会员'
						}else if(res.data.roleid == '6'){
							_this.role = '车商会员'
						}else if(res.data.roleid == '7'){
							_this.role = '专员会员'
						}else{
							_this.role = '游客'
						}
						_this.$store.commit('updateUserInfo',res.data);
						_this.$store.commit('updateUserRole',_this.role);
						uni.setStorageSync('userinfo',res.data);
						uni.setStorageSync('role',_this.role);
					}
				}).catch(err=>{
					throw err;
				})
			},
			getSystemInfo() {
				uni.getSystemInfo({
					success: res=>{
						console.log(res);
						if(res.platform == 'ios'){
							this.setWxConfig();
						}
					},
					fail: err=>{
						console.log(err);
					}
				})
			},
			setWxConfig(){
				const _this = this;
				const data = {};
				this.$api('upload/get_use_signature','GET',data)
				.then(res=>{
					jweixin.config({
						debug: true, // 开启调试模式,调用的所有api的返回值会在客户端alert出来，若要查看传入的参数，可以在pc端打开，参数信息会通过log打出，仅在pc端时才会打印。
						appId: 'wx8f25aab4660823a5', // 必填，公众号的唯一标识
						timestamp:res.data.timestamp , // 必填，生成签名的时间戳
						nonceStr: res.data.nonceStr, // 必填，生成签名的随机串
						signature:res.data.signature,// 必填，签名
							//signature:'wdwdwfw2efesdwfcsdwfce',// 必填，签名
						jsApiList: ['chooseWXPay','chooseImage','uploadImage','getLocalImgData'] // 必填，需要使用的JS接口列表
					})
						jweixin.ready(()=>{
							console.log('验证成功');
						})
				})
				.catch(err=>{console.log(err)});
			},
		},
		
	}
</script>

<style >
 #zong
	 {
		height: 1600rpx;
		width: 100%;
		background-color: #F5F5F5;
	 }
	 #head
	 {
		height: 40%;
		width: 100%;
		text-align: center;
		
	 }
	 #logo
	 {
		width: 100%;
		padding-top: 25rpx;
		height: 28%;
		justify-content: center;      //水平居中
		align-items: center;          //垂直居中
	 }
	 .san3
	 {
	 		  width: 100%;
	 		  height: 60upx;
	 } 
	 .list
	 {
		 color: #FFFFFF;
		width: 30%;
		float: left;
		height: 40%;
		margin-left: 2.5%;
	 }
	 .modular3
	 {
		width: 30%;
		float: left;
		margin-left:2.5%;
		margin-top: 12rpx;
	 }
	 .bian
	 {
		font-size:30rpx;
		border-radius: 15rpx;
		color: #333333;
		background-color: #D3D3D3;
	 }
	 .ziti1
	 {
		flex-direction: column;
		font-size: 8px;
		text-align: left; 
		padding-left: 10rpx;
		font-size: 30rpx;
	 } 
	 .interval
	  {
		width: 100%;
		height: 5rpx;
	  }
	 .ziti2
	 {
		padding-top: 5rpx;
		width: 100%;
		height: 15%;
		flex-direction: column;
		text-align: center;
		font-size: 20rpx;
		text-align: left; 
		padding-left: 10rpx
	 }
	 .modular4
	 {
		 width: 30%; 
		 height: 100%;
		 float: left;
		 background: #007AFF;
		 padding-top: 2rpx;
	 }
	 .modular5
	 {
		 height: 25%;
		 width: 100%;
	 }
	 .tu
	 {
		width: 80%;
		height: 100%;
		float: left;
	 }
	 .tu1
	 {
	 		 width: 42%;
	 		 height: 100%;
	 		 float: left;
	 }
	 .header
	 {
		padding: 0;
		height: 16%;
		width: 100%;
	 }
	 .land
	 {
		 background-color: #DD524D;
		 width: 20%; 
		 margin-left: 40%;
		 margin-top: 8%;
		 height: 9%;
	 }
	 .ziti4
	 {
		 font-size: 25rpx;
	 }
	 .body
	 {
		width: 100%;
		height: 76%; 
		margin-top: 9%;
	 }
	 .modular
	 {
		margin-top: 2%;
		height: 13%;
		width: 100%;
		background-color: #FFFFFF;
		border: 3rpx solid #F1F1F1; 
	 }
	 #tail
	 {
		margin-top: 3%;
		height: 12%;
		width: 100%;
		font-size: 15rpx;
	 }
	 #logo2
	 {
		 margin-left: 16%;
		height: 75%;
		width: 66.66%;
		margin-top: 12%;
	 } 
</style>
