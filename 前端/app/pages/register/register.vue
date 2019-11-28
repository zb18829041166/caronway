<template>
	<view class="s-page-wrapper is-100vh">
		<view class="is-33vh has-mgt-10">
			<view class="is-flex is-column is-justify-center  is-align-center is-height-100">
				<image src="../../static/logo.png" mode="aspectFit" class="logoimg"></image>
				<view>{{telephone}}</view>
			</view>
		</view>
		<view class="registercontent">
			<view class="has-mglr-10 ">
				<view class=" has-mgtb-10 ">
					<input type="text"  placeholder="请输入您的真实姓名" class="is-input1" v-model="user_info.username"/>
				</view>
				<view class=" has-mgtb-10 ">
					<input type="number" maxlength="11" placeholder="请输入手机号" class="is-input1" v-model="user_info.telephone"/>
				</view>
				<view class=" has-mgtb-10 ">
					<input type="number" maxlength="6" placeholder="短信验证码" class="is-input1" v-model="code"/>
					<view class="codeimg" :class="smsbtn.status?'':'disBtn'"  @tap="getsmscode">{{smsbtn.text}}</view>
				</view>

				<view class=" has-radius has-mgtb-10">
					<input placeholder="请输入登录密码" :password="true" class="is-input1" v-model="user_info.userpwd"/>
				</view>
				<view class=" has-radius has-mgtb-10">
					<input placeholder="请再次登录密码" :password="true" class="is-input1" v-model="user_info.reuserpwd"/>
				</view>
				<view class=" registerbtn has-radius has-mgtb-20" @click="judgeUserCode">
					<button>注 册</button>
				</view>
			</view>
		</view>
		<view class="is-20vh has-mgt-80">
			<navigator url="#" class=" has-radius is-center is-grey " hover-class="">
				<text>注册即表示同意</text><text class="is-blue">《用户协议》</text>
			</navigator>
		</view>
	</view>
</template>

<script>
	export default {
		data() {
			return {
				smsbtn: {
					text: '获取验证码',
					status: true,
					codeTime: 60,
				},
				type:'',
				code:'',
				pwd:'',
				timerId: null,
				telephone:'',
				user_info:{
					'username':'',
					'telephone':'',
					'userpwd':'',
					'reuserpwd':'',
					'openid':this.$store.state.openid?this.$store.state.openid:'',
					'unionid':this.$store.state.unionid?this.$store.state.unionid:'',
				}
			};
		},
		onLoad(options){
			this.type = options.type;
		},
		methods: {
			getsmscode() {
				const rgx= /^1[345789]\d{9}$/;
				const data ={telephone:this.user_info.telephone};
				const _this = this;
				if(!rgx.test(this.user_info.telephone)){
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
						},1000);
				}
				
			},
			//-------验证用户验证码-----
			judgeUserCode(){
				const data = {telphone:this.user_info.telephone};
				const _this = this;
				this.$api('index/get_telephone_code','POST',data)
				.then(res=>{
					console.log(res.data);
					const code = res.data[0].code;
					if(code == _this.code) {
						_this.register();
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
			register(){
				const rgx= /^1[345789]\d{9}$/ ;
				const _this =this;
				if(!rgx.test(this.user_info.telephone)){
					return wx.showToast({
							title:'号码有误',
							icon:'none',
					     })
				}
				if(this.user_info.userpwd && this.user_info.userpwd != this.user_info.reuserpwd){
					return wx.showToast({
							title:'两次密码不一致',
							icon:'none',
					        })
				}
				if(!this.user_info.unionid) {
					return wx.showToast({
							title:'网络错误，请重新进入',
							icon:'none',
					       })
				}
				for(let i in this.user_info){
					if(!this.user_info[i]){
						return wx.showToast({
							title:'输入不正确',
							icon:'none',
						})
					}
				}
				this.$api('index/user_register','POST', this.user_info)
				.then(res=>{
					console.log(res);
					if(res.data.code===0){
						uni.showToast({
							title:res.data.message,
							icon:'success',
							success:res=>{
								setTimeout(()=>{
									if(_this.type =='upload'){
										uni.navigateTo({
											url:'../openshop/uploadcar/uploadcar',
										})
									}else{
										uni.navigateBack({
											delta:1,
										})
									}
								},1000)
							},
							fail:err=>{
								throw new Error(err);
							}
						})
					} else {
						uni.showToast({
							title:res.data.message,
							icon:'none'
						})
					}
				})
				.catch(err=>{
					throw new Error(err);
				})
			}

		}
	}
</script>

<style>
	page {
		min-height: 100%;
		background-color: #FFFFFF;
	}

	.registercontent {
		width: 85%;
		margin: 0 auto;
	}

	.logoimg {
		width: 200rpx;
		height: 200rpx;
		border-radius: 50%;
		margin-top:80upx;
	}

	.is-input1 {
		height: 88rpx;
		width: 100%;
		line-height: 88rpx;
		padding:0 12rpx;
		color: #353535;
		font-size: 32rpx;
		box-sizing: border-box;
		appearance: none;
		border: 2rpx solid #e5e5e5;
		box-shadow: none;
		border-radius: 44rpx;
		outline: 0;
		display: block;
		padding-left: 30rpx;
		margin: 0;
		font-family: inherit;
		background: #fff;
		resize: none;
	}

	.iconfont {
		position: absolute;
		font-size: 40rpx;
		right: 12%;
		z-index: 999;
		width: 105rpx;
		text-align: center;
		color: #353535;
		margin-top: -11%;
		background: #fff;
		border-top-right-radius: 44rpx;
		border-bottom-right-radius: 44rpx;
		height: 80rpx;
		line-height: 80rpx;
	}

	.codeimg {
		position: absolute;
		font-size: 28rpx;
		right: 12%;
		z-index: 999;
		width: 200rpx;
		text-align: center;
		color: #353535;
		margin-top: -11%;
		background: #fff;
		border-top-right-radius: 44rpx;
		border-bottom-right-radius: 44rpx;
		height: 80rpx;
		line-height: 80rpx;
	}

	.registerbtn button {
		margin-top: 20rpx;
		height: 88rpx;
		width: 100%;
		line-height: 88rpx;
		color: #ffffff;
		font-size: 32rpx;
		border-radius: 44rpx;
		outline: 0;
		display: block;
		margin: 0;
		font-family: inherit;
		background: #f35;
		opacity: 0.8;
	}

	button:after {
		border: 2rpx solid #f2f2f2;
	}
	.disBtn{
		pointer-events: none;
	}
</style>
