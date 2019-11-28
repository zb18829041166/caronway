<template>
	<view class="business-info uni-column">
		<swiper class="business-info-swiper" :indicator-dots="true" :autoplay="true" :interval="3000" :duration="1000">
			<swiper-item class="business-info-swiper-item">
				<image :src="shop_info.innimg"  ></image>
			</swiper-item>
			<swiper-item class="business-info-swiper-item">
				<image :src="shop_info.outimg" class="swiper-item" ></image>
			</swiper-item>
		</swiper>
		<view class="business-info-detail uni-column">
			<view class="business-info-detail-name uni-h4">
				{{shop_info.realname}}
			</view>
			<view class="business-info-detail-address">
				<!-- <uni-icon type="location" size="26"></uni-icon> -->
				地址: {{shop_info.address}}
			</view>
			<view class="business-info-detail-telephone">
				<!-- <uni-icon type="phone" size="26"></uni-icon> -->
				联系电话: {{shop_info.telephone}}   
			</view>
			<view class="business-info-detail-telephone">
				社会信用代码: {{shop_info.liccode}}   
			</view>
			<block v-if="shop_status==1">
				<view class="update-button" @click="updateShopInfo">
					修改店铺信息
				</view>
				<view class="update-button" @click="updateShopTelephone">
					修改店铺电话
				</view>
			</block>
			<block v-if="shop_status==2">
				<view class="update-button">
					审核被拒绝
				</view>
			</block>
		</view>
		<block v-if="shop_status==1">
			<block v-for="(car,index) in car_info" :key="index">
				<view class="uni-business uni-column">
					<swiper class="uni-business-swiper" :indicator-dots="true" :autoplay="true" :interval="4000" :duration="1000"  @click.stop="goCarDetail(car.id)">
						<swiper-item>
							<image :src="car.frontcover" class="swiper-item" ></image>
						</swiper-item>
						<swiper-item>
							<image :src="car.frontpic" class="swiper-item" ></image>
						</swiper-item>
						<swiper-item>
							<image :src="car.rearview" class="swiper-item" ></image>
						</swiper-item>
						<swiper-item>
							<image :src="car.rightside" class="swiper-item" ></image>
						</swiper-item>
						<swiper-item>
							<image :src="car.leftside" class="swiper-item" ></image>
						</swiper-item>
						<swiper-item>
							<image :src="car.interior1" class="swiper-item" ></image>
						</swiper-item>
						<swiper-item>
							<image :src="car.interior2" class="swiper-item" ></image>
						</swiper-item>
						<swiper-item>
							<image :src="car.interior3" class="swiper-item" ></image>
						</swiper-item>
					</swiper>
					<view class="uni-h4">
						{{car.carName}}
					</view>
					<view class="">
						行驶里程:{{car.hadkm}}公里
					</view>
					<view class="uni-business-price">
						报价:<text>{{car.realprice}}万元</text>
					</view>
					<view class="uni-business-contact uni-h5" style="background:red;" @click.stop="getEditCar(index)">
						重新编辑
					</view>
					<view class="singlecar-list-rig uni-row">
						上线: <switch :checked="car.status==0?false:true" @change.stop="getSwitchChange($event,car.id)" />
					</view>
				</view>
			</block>
		</block>
		<block v-if="shop_status==1">
			<map style="width: 100%; height: 300px;" :latitude="shop_info.latitude" :longitude="shop_info.longitude" :markers="covers" >
			</map>
		</block>
		<page-swiper></page-swiper>	
		<block v-if="shop_status==1">
			<view class="singlecar-btns">
				<view class="singlecar-btns-ts publish" @click.stop="publishMyCar">
					发布新车
				</view>
				<view class="singlecar-btns-ts publish" @click.stop="showCover">
					申请展位
				</view>
			</view>
		</block>
		<view class="cover" v-if="show_flag">
			<view class="cover-content uni-column">
				<view class="cover-content-title is-h4">
					请输入展位
				</view>
				<input class="cover-content-input" type="number" value="" @input="getSpotNumber" placeholder="请输入申请车位数量"/>
				<view class="uni-row cover-content-btn">
					<view class="button" @click.stop="cancelButtonSpot">
						取消
					</view>
					<view class="button" @click.stop="userPayment">
						确认
					</view>
				</view>
			</view>
		</view>
		<view class="cover" v-if="tel_flag">
			<view class="cover-tel uni-column">
				<view class="cover-tel-title">
					修改手机号
				</view>
				<input class="cover-tel-telphone" type="number" placeholder="请输入手机号" value="" v-model="telephone"/>
				<view class="cover-tel-code uni-row">
					<input class="cover-tel-code-input" type="text" value="" placeholder="短信验证码" v-model="code"/>
					<view class="code-btn" :class="smsbtn.status?'':'disBtn'"  @click.stop="getsmscode">{{smsbtn.text}}</view>
				</view>
				<view class="cover-tel-btn uni-row">
					<view class="cover-tel-btn-cancel" @click.stop="cancelUpdateTelephone">
						取消
					</view>
					<view class="cover-tel-btn-confirm" @click.stop="confirmUpdateTelephone">
						确认
					</view>
				</view>
			</view>
		</view>
		<block v-if="shop_status==2">
			<view class="reSubmit" @click="goResubmitShop">
				重新提交审核
			</view>
		</block>
	</view>
</template>

<script>
	import uniBusiness from '@/components/uni-business.vue';
	import uniIcon from "@/components/uni-icon/uni-icon.vue";
	// #ifdef H5
	const jweixin = require('../../../../common/jweixin.js');
	// #endif
	export default {
		data() {
			return {
				role:'',
				openid:'',
				shop_info:{},
				car_info:[],
				covers: [],
				circles:[],
				show_flag:false,
				spot_number:'',
				show_switch:true,
				userid:'',
				smsbtn: {
					text: '获取验证码',
					status: true,
					codeTime: 60,
				},
				code:'',
				telephone:'',
				tel_flag:false,
				shop_status:'1'
			};
		},
		components:{
			uniBusiness,
			uniIcon
		},
		onShow() {
			this.userid = this.$store.state.user_info.userid;
			this.getShopInfo(this.userid);
			this.getShopCar(this.userid);
		},
		onLoad(options){
			console.log(options.status);
			this.shop_status = options.status;
			// #ifdef H5
			this.setWxConfig();
		   // #endif
		},
		created() {
		 
		  	
		},
		methods:{
			// #ifdef H5
			setWxConfig(){
				const _this = this;
				const data = {};
				this.$api('upload/get_use_signature','GET',data)
				.then(res=>{
					console.log(res);
					jweixin.config({
						debug: true, 
						appId: 'wx8f25aab4660823a5', 
						timestamp:res.data.timestamp , 
						nonceStr: res.data.nonceStr, 
						signature:res.data.signature,
						jsApiList: ['chooseWXPay'] 
					})
						jweixin.ready(()=>{
							console.log('验证成功');
						})
				})
				.catch(err=>{console.log(err)});
			},
			//------用户支付-------
			async userPayment(){
			  const _this = this;
			  const openid = this.$store.state.openid;
			  const money = 100;
			  const jresult = await this.judgeUserHaveSpot();
			  if(jresult.data.code !== 0) {
				  return uni.showToast({
				  	title:jresult.data.message,
					icon:'none'
				  })
			  }
			  const data={openid:openid,money:money};
			  this.$api('users/payment','POST',data)
			  .then(res=>{
				   const pay = res.data.data;
				   console.log(pay);
				   jweixin.chooseWXPay({
						timestamp: pay.timeStamp, // 支付签名时间戳，注意微信jssdk中的所有使用timestamp字段均为小写。但最新版的支付后台生成签名使用的timeStamp字段名需大写其中的S字符
						nonceStr: pay.nonceStr, // 支付签名随机串，不长于 32 位
						package: pay.package, // 统一支付接口返回的prepay_id参数值，提交格式如：prepay_id=\*\*\*）
						signType: pay.signType, // 签名方式，默认为'SHA1'，使用新版支付需传入'MD5'
						paySign: pay.paySign, // 支付签名
						success: function (res) {
						   console.log(res);
						   if(res.errMsg == 'chooseWXPay:ok') {
							   _this.confirmButtonSpot(); 
						   }else{
							   uni.showToast({
								 title:'支付失败',
								 icon:'none'
							   })
							 _this.show_flag = false;  
						   }
						},
						fail:err =>{
							console.log(err)
							wx.showModal({
								title:'支付错误',
								content:err
							})
							_this.show_flag = false;
						}
				  })
			  })
			  .catch(err=>{
			  })
			},
			// #endif
			getEditCar(id) {
				const _this =this;
				uni.showModal({
					title:'系统提示',
					content:'重新编辑车辆信息下线店铺',
					success:res =>{
						if(res.confirm){
							_this.$store.state.use_info = _this.car_info[id];
							uni.navigateTo({
								url:'../../../openshop/uploadcar/uploadcar?type=edit'
							})
						}
					},
					fail:err =>{
						throw new Error(err);
					}
				})
			},
			offLineCar(){
				const data = {userid:id};
				const _this = this;
				this.$api('index/person_off_line','POST', data)
				.then(res=>{
					console.log(res)
					if(res.data && res.data.length>0){
						_this.shop_info = res.data[0];
					}
				}).catch(err=>{
					console.log(err);
				})
			},
			goCarDetail(val) {
				uni.navigateTo({
				   url:`../../../secondhandcar/cardeatil/cardeatil?carid=${val}`,
				})
			},
			cancelButtonSpot(){
				this.show_flag = false;
			},
			confirmButtonSpot(){
				const _this= this;
				if(this.spot_number){
					const data = {shopid:this.shop_info.id,appcount:this.spot_number};
					const _this = this;
					this.$api('index/shop_insert_spot','POST', data)
					.then(res=>{
						console.log(res)
						_this.show_flag = false;
						if(res.data.code==0){
							uni.showToast({
								title:'申请成功',
								icon:'none'
							})
						}else{
							uni.showToast({
								title:res.data.message,
								icon:'none'
							})
						}
					}).catch(err=>{
						console.log(err);
					})
				}else{
					uni.showToast({
						title:'请输入展位数',
						icon:'none'
					})
				}
				
			},
			async getSwitchChange(e,id) {
				console.log(e);
				console.log(id);
				const uid = this.userid ? this.userid : this.$store.state.user_info.userid;
				if(e.detail.value){
					const res = await this.onlineCar(id);
					console.log(res);
					if(res.data.errcode == 0){
						uni.showToast({
							title: res.data.errstr,
							success:res=>{
								this.getShopCar(uid)
							},
							fail:err=>{
								throw new Error(err);
							}
						})
					}
				}else{
					const res = await this.offlineCar(id);
					console.log(res);
					if(res.data.errcode == 0){
						uni.showToast({
							title: res.data.errstr,
							success:res=>{
								this.getShopCar(uid)
							},
							fail:err=>{
								throw new Error(err);
							}
						})
					}
				}
			},
			//----获取用户输入-----
			getSpotNumber(e){
				let val = e.detail.value;
				if(val){
					this.spot_number = val;
				}
			},
			getShopInfo(id){
				const data = {userid:id};
				const _this = this;
				this.covers = [];
				const result = {
					iconPath: '/static/location.png'
				}
				this.$api('index/get_shop_detail','POST', data)
				.then(res=>{
					console.log(res)
					if(res.data ){
						_this.shop_info = res.data;
						result.latitude = res.data.latitude;
						result.longitude = res.data.longitude;
						_this.covers.push(result);
					}
				}).catch(err=>{
					console.log(err);
				})
			},
			getShopCar(id){
				const data = {userid:id};
				const _this = this;
				this.$api('index/get_shop_car','POST', data)
				.then(res=>{
					console.log(res);
					if(res.data && res.data.length>0){
						_this.car_info = res.data;
					}
				}).catch(err=>{
					console.log(err);
				})
			},
			//-----新增展位----
			//----添加新车-----
			publishMyCar(){
				const _this = this;
				const data = {
					shopid: this.shop_info.id,
				}
				this.$api('index/judge_shop_upload','POST',data)
				.then(res=>{
					console.log(res);
					if(res.data){
						uni.navigateTo({
							url:'../../../openshop/uploadcar/uploadcar?type=upload'
						})
					}else{
						uni.showToast({
							title:'您的展位不足',
							icon:'none'
						})
					}
				})
				.catch(err=>{
					console.log(err);
				})
				
			},
			//判断用户是否还有展位
			judgeUserHaveSpot() {
				const _this= this;
				if(this.spot_number){
					const data = {shopid:this.shop_info.id,appcount:this.spot_number};
					const _this = this;
					return this.$api('index/shop_apply_spot','POST', data);
				}else{
					return uni.showToast({
						title:'请输入展位数',
						icon:'none'
					})
				}
			},
			showCover(){
				this.show_flag = true;
			},
			//-----车辆上线
			offlineCar(id){
				this.$store.state.use_info = this.car_detail;
				const userid = this.$store.state.user_info.userid;
				const carid = id;
				const data = {userid:userid,id:carid};
				return this.$api('index/person_off_line','POST', data)
			},
			//-----车辆下线
			onlineCar(id) {
			    this.$store.state.use_info = this.car_detail;
				const userid = this.$store.state.user_info.userid;
				const carid = id;
				const data = {userid:userid,id:carid};
				return this.$api('index/person_on_line','POST', data)
			},
			//------修改店铺信息
			async updateShopInfo() {
				const result = await this.judgeShopModify();
				if(result.data) {
					uni.navigateTo({
						url:'../../../openshop/index/index?type=update'
					})
				}else {
					uni.showToast({
						title:'暂时不能修改店铺信息'
					})
				}
			},
			//判断店铺信息是否能修改
			judgeShopModify() {
				const data = {shopid: this.shop_info.id};
				return this.$api('index/judge_shop_modify','POST', data);
			},
			//------修改店铺电话
			updateShopTelephone(){
				this.tel_flag = true;
			},
			cancelUpdateTelephone(){
				this.tel_flag = false;
			},
			confirmUpdateTelephone() {
				const data = {telphone:this.telephone};
				const _this = this;
				this.$api('index/get_telephone_code','POST',data)
				.then(res=>{
					console.log(res.data);
					const code = res.data[0].code;
					if(code == _this.code) {
						_this.updateTelephone();
					}else{
						uni.showToast({
							title:'验证码错误'
						})
					}
				 })
				.catch(err=>{
					console.log(err)
				}); 
			},
			getsmscode() {
				const rgx= /^1[345789]\d{9}$/;
				const data ={telephone:this.telephone};
				const _this = this;
				if(!rgx.test(this.telephone)){
					wx.showToast({
						title:'号码有误',
						icon:'none',
					})
				}else{
					this.$api('upload/get_telephone_code','POST',data)
					.then(res=>{
						if(res.data && res.data.resultCode == 1000) {
							uni.showToast({
								title:'验证码发送成功',
								icon:'none'
							})
						}else{
							uni.showToast({
								title:'验证码发送失败',
								icon:'none'
							})
						}
					 })
					.catch(err=>{
						console.log(err)
					}); 
					this.timerId = setInterval(() => {
							var codeTime = this.smsbtn.codeTime;
							codeTime--;
							this.smsbtn.codeTime = codeTime;
							this.smsbtn.text = codeTime + "S";
							this.smsbtn.status=false;
							if (codeTime < 1) {
								clearInterval(this.timerId);
								this.smsbtn.text = "重新获取";
								this.smsbtn.codeTime = 60;
								this.smsbtn.status = true;
							}
						},
						1000);
				}
				
			},
			//-------修改号码-----
			updateTelephone(){
				const _this = this;
				const data = {
					telephone: this.telephone,
					shopid: this.shop_info.id
				}
				this.$api('index/update_shop_telephone','POST', data)
				.then(res => {
					console.log(res)
					if(res.data.code == 0) {
						uni.showToast({
							title:'修改成功',
							icon:'none'
						})
					}else{
						uni.showToast({
							title:'修改失败',
							icon:'none'
						})
					}
					_this.tel_flag = false;
				})
				.catch(err =>{
					throw err;
				})
				
			},
			goResubmitShop() {
				uni.navigateTo({
					url:'../../../openshop/index/index?type=resubmit'
				})
			}
		}
	}
</script>

<style lang="scss">
.business-info{
	background-color:#f5f5f5;
	.business-info-swiper{
		width:100%;
		height:400upx;
		.business-info-swiper-item{
			width:100%;
			height:400upx;
			image{
				width:100%;
				height:400upx;
			}
		}
	}
	.business-info-detail{
		padding:20upx;
		margin-bottom:20upx;
		background-color: #fff;
		.business-info-detail-name{
			font-weight: bold;
		}
	}
}
.reSubmit{
	margin:20upx;
	height:80upx;
	line-height: 80upx;
	background: red;
	color:#fff;
	text-align: center;
	border-radius: 12upx;
}
.uni-business{
	 padding:20upx;
	 background-color: #fff;
	 margin-bottom:20upx;
	 position: relative;
	 .uni-business-swiper{
		 width:100%;
		 height:320upx;
		 swiper-item{
			 width:100%;
			 height:320upx;
			 image{
				 width:100%;
				 height:320upx;
			 }
		 }
	 }
	 .singlecar-list-rig{
	 	position: absolute;
	    right:12upx;
	    bottom:120upx;
	 }
	 .uni-business-contact{
		 background-color: green;
		 height:60upx;
		 line-height: 60upx;
		 width:140upx;
		 color:#fff;
		 border-radius: 12upx;
		 text-align: center;
	 }
	 .uni-business-price text{
		 font-weight: bold;
		 color:#e82713;
		 font-size: 34upx;
	 }
 }
 .singlecar-btns{
 	  position: fixed;
 	  right:10upx;
 	  top:50%;
 	  .singlecar-btns-ts{
 		  width:108upx;
 		  height:108upx;
 		  line-height: 108upx;
 		  border-radius: 50%;
 		  border:1upx solid #bdbdbd;
 		  text-align: center;
 		  font-weight: bold;
 		  background:#bdbdbd;
 		  opacity: 0.6;
 		  color:#fff;
 	  }
 	  .publish{
 		  font-size: 22upx;
 		  background:red;
 		  margin-bottom:14px;
 	  }
 	  .singlecar-btns-ct{
 	  		  width:108upx;
 	  		  height:108upx;
 	  		  line-height: 108upx;
 	  		  border-radius: 50%;
 			  margin-top:20upx;
 	  		  border:1upx solid #bdbdbd;
 	  		  text-align: center;
 	  		  font-weight: bold;
 	  		  background:green;
 	  		  opacity: 0.6;
 	  		  color:#fff;
 	  }
 }
 .cover{
 	  width:100%;
 	  height:100%;
 	  position: fixed;
 	  left:0;
 	  top:0;
 	  background:rgba($color: #000000, $alpha: .6);
 	  z-index: 999;
 	  .cover-content{
 		  width:90%;
 		  height:300upx;
 		  position: fixed;
 		  left:50%;
 		  top:50%;
 		  transform: translateX(-50%) translateY(-50%);
 		  background: #fff;
 		  border-radius: 14upx;
 		  padding:30upx 0 0 0;
 		  text-align: center;
 		  overflow: hidden;
 		  .cover-content-input{
 			  width:320upx;
 			  height:90upx;
 			  line-height: 90upx;
 			  align-self: center;
 			  text-align: center;
 			  border-bottom: 1upx solid green;
 			  input{
 				  width:320upx;
 				  text-align: center;
 				  height:90upx;
 				  line-height: 90upx;
 			  }
 		  }
 		  .cover-content-btn{
 			 height:90upx;
 			 line-height: 90upx;
 			 width:100%;
 			 justify-content: space-between;
 			 position: absolute;
 			 bottom:0;
 			 left:0;
 			 background:#f5f5f5;
 			 .button{
 				 width:49.5%;
 				 text-align: center;
 				 border-top:1upx solid #bdbdbd;
 				 background-color: #fff;
 			 }
 		  }
 	  }
	  .cover-tel{
		  width:80%;
		  
		  position: fixed;
		  left:50%;
		  top:50%;
		  transform: translateX(-50%) translateY(-50%);
		  background: #fff;
		  border-radius: 14upx;
		  padding:20upx 0 0 0;
		  text-align: center;
		  overflow: hidden;
		  align-items: center;
		  .cover-tel-title{
			  font-weight: 600;
			  font-size: 30upx;
		  }
		  .cover-tel-telphone{
			  width:420upx !important;
			  height:80upx !important;
			  line-height: 80upx !important;
			  border-bottom: 1upx solid #bdbdbd;
			 
			  input{
				  width:420upx;
				  height:80upx !important;
				  line-height: 80upx !important;
				  text-align: center;
			  }
		  }
		  .cover-tel-code{
			  width:420upx !important;
			  height:80upx !important;
			  line-height: 80upx !important;
			  align-items: center;
			  border-bottom:1upx solid #bdbddb;
			  .cover-tel-code-input{
				  flex:3;
				  height:80upx !important;
				  input{
					  width:100%;
					  height:80upx !important;
					  line-height: 80upx !important;
				  }
			  }
			  .code-btn{
				  flex:2;
				  background: #e82713;
				  color:#fff;
				  height:70upx;
				  line-height: 70upx;
				  border-radius: 12upx;
			  }
		  }
		  .cover-tel-btn{
			  height:80upx;
			  line-height: 80upx;
			  width:100%;
			  border-top:1upx solid #bdbddb;
			  margin-top:20upx;
			  color:#bdbdbd;
			  font-weight: bold;
			  .cover-tel-btn-cancel{
				  flex:1;
				  border-right:1upx solid #bdbdbd;
			  }
			  .cover-tel-btn-confirm{
				  flex:1;
			  }
		  }
	  }
	  
 }
 .update-button{
	 height:70upx;
	 line-height: 70upx;
	 width:200upx;
	 background: green;
	 color:#fff;
	 text-align: center;
	 border-radius: 12upx;
	 margin-bottom:20upx;
 }
</style>
