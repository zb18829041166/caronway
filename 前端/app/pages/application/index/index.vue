<template>
	
	<view class="application uni-column">
		<view class="application-userinfo uni-column">
			<image class="application-userinfo-img" src="/static/logo.png" mode="widthFix" style="width:128upx;height:128upx;"></image>
			<view class="application-userinfo-name uni-h4">
				{{user_info.username}}({{role}})
			</view>
			<view class="application-userinfo-name uni-h5" v-if = "shop_status">
				{{shop_status}}
			</view>
		</view>
		
		<view class="uni-column application-list">
			<block v-if="user_info.roleid==5">
				<view class="uni-row application-list-content" @click="goMyPersonMessage">
					<view class="application-list-content-left">
						我的消息
					</view>
					<view class="application-list-content-right uni-row">
						<view class="application-list-content-right-number">
							{{message}}
						</view>
						<uni-icon type="arrowright" size="28"></uni-icon>
					</view>	
				</view>
				
				<view class="uni-row application-list-content" @click="goMySecondCar">
					<view class="application-list-content-left">
						我的二手车
					</view>
					<uni-icon type="arrowright" size="28"></uni-icon>
				</view>
				
				<view class="uni-row application-list-content" @click="goshabi">
					<view class="application-list-content-left">
						扫码登陆
					</view>
					<uni-icon type="arrowright" size="28"></uni-icon>
				</view>
				
				<view class="uni-row application-list-content" @click="goShopList" v-if = "shop_status">
					<view class="application-list-content-left">
						二手车店
					</view>
					<uni-icon type="arrowright" size="28"></uni-icon>
				</view>
				
			</block>
			<block v-else-if="user_info.roleid=='6'">
				<view class="uni-row application-list-content" @click="goShopMessage">
					<view class="application-list-content-left">
						我的消息
					</view>
					<view class="application-list-content-right uni-row">
						<view class="application-list-content-right-number">
							{{message}}
						</view>
						<uni-icon type="arrowright" size="28"></uni-icon>
					</view>
				</view>
				
				<view class="uni-row application-list-content" @click="goshabi">
					<view class="application-list-content-left">
						扫码登陆
					</view>
					<uni-icon type="arrowright" size="28"></uni-icon>
				</view>
				
				<view class="uni-row application-list-content" @click="goShopList">
					<view class="application-list-content-left">
						二手车店
					</view>
					<uni-icon type="arrowright" size="28"></uni-icon>
				</view>
			</block>
			
			<block v-else-if="user_info.roleid=='7'">
				<view class="uni-row application-list-content" @click="goMySecondManage">
					<view class="application-list-content-left">
						二手车管理
					</view>
					<uni-icon type="arrowright" size="28"></uni-icon>
				</view>
			<!-- 	<view class="uni-row application-list-content" @click="goMyInfomation">
					<view class="application-list-content-left">
						信息审核
					</view>
					<uni-icon type="arrowright" size="28"></uni-icon>
				</view>
				<view class="uni-row application-list-content" @click="goMyDateSetting">
					<view class="application-list-content-left">
						参数设置
					</view>
					<uni-icon type="arrowright" size="28"></uni-icon>
				</view>
				<view class="uni-row application-list-content" @click="goMyCarSetting">
					<view class="application-list-content-left">
						设置车辆公共参数
					</view>
					<uni-icon type="arrowright" size="28"></uni-icon>
				</view>
				<view class="uni-row application-list-content" @click="goDirectoLevyfees">
					<view class="application-list-content-left">
						催费管理
					</view>
					<uni-icon type="arrowright" size="28"></uni-icon>
				</view> -->
				<!-- <view class="uni-row application-list-content" @click="goDirectoMessage">
					<view class="application-list-content-left">
						我的消息
					</view>
					<view class="application-list-content-right uni-row">
						<view class="application-list-content-right-number">
							{{message}}
						</view>
						<uni-icon type="arrowright" size="28"></uni-icon>
					</view>
				</view> -->
				<!-- <view class="uni-row application-list-content" @click="goDirectorComplaint">
					<view class="application-list-content-left">
						投诉处理
					</view>
					<uni-icon type="arrowright" size="28"></uni-icon>
				</view> -->
			</block>
		</view>
	</view>
</template>

<script>
	import uniIcon from "@/components/uni-icon/uni-icon.vue"
	export default {
		data() {
			return {
				 user_info:'',
				 role:'',
				 message:0,
				 shop_status:'',
				 status:''
			}
		},
		components:{
		  uniIcon	
		},
		onLoad() {
		  
		},
		onShow() {
			this.getUserInfo();	
			this.getShopStatus();
		},
		methods: {
			goMyMessage(){
				uni.navigateTo({
					url:'../message/message'
				})
			},
			goMySecondShop(){
				uni.navigateTo({
					url:`../../secondhandcar/business/business?role=${this.role}&&openid=${this.$store.state.openid}`
				})
			},
			goshabi(){
				
					wx.showToast({
						title:'没啥用',
					})
			},
			goMyInfomation() {
				uni.navigateTo({
					url:'../director/examine/examine'
				})
			},
			goMyDateSetting(){
				uni.navigateTo({
					url:'../director/setting/setting'
				})
			},
			//专员处理投诉
			goDirectorComplaint(){
				uni.navigateTo({
					url:'../director/complaint/complaint'
				})
			},
			goDirectoMessage(){
				uni.navigateTo({
					url:'../director/message/message'
				})
			},
			goDirectoLevyfees(){
				uni.navigateTo({
					url:'../director/levyfees/levyfees'
				})
			},
			goMyCarSetting(){
				uni.navigateTo({
					url:'../director/carbaseting/carbaseting'
				})
			},
			goMySecondManage() {
				uni.navigateTo({
					url: '../manage/list/list',
				});
			},
			async goShopMessage(){
				await this.setMessageStatus();
				const userid = this.$store.state.user_info.userid;
				uni.navigateTo({
					url:`../shop/message/message?userid=${userid}`
				})
			},
			async goMyPersonMessage(){
				await this.setMessageStatus();
				uni.navigateTo({
					url:'../person/message/message'
				})
			},
			goShopList(){
				const userid = this.$store.state.user_info.userid;
				// const userid = 4;
				uni.navigateTo({
					url:`../shop/index/index?userid=${userid}&&status=${this.status}`
				})
			},
			
			//get_user_message
			getUserMessage(id){
				const data = {secuserid:id};
				const _this = this;
				this.$api('index/get_user_message','POST', data)
				.then(res=>{
					console.log(res)
					if(res.data && res.data.length>0){
						_this.message=res.data.length;
					}
				}).catch(err=>{
					console.log(err);
				})
			},
			getUserInfo(){
				const data = {openid:this.$store.state.openid};
				const _this = this;
				this.$api('index/get_user_info','POST', data)
				.then(res=>{
					console.log(res)
					_this.getUserMessage(res.data.userid);
					_this.user_info = res.data;
					//_this.
					res.data.roleid=6;
					var i=1;
					
					if(res.data.roleid == '5'){
						_this.role = '白金会员'
					}else if(res.data.roleid == '6'){
						_this.role = '车商会员'
					}else if(res.data.roleid == '7'){
						_this.role = '专员会员'
					}else{
						_this.role = '游客'
					}
					i=1;
				}).catch(err=>{
					console.log(err);
				})
			},
			
			goMySecondCar(){
				uni.navigateTo({
					url:'../person/car/car',
				})
			},
			//获取店铺状态
			getShopStatus(){
				const data = { userid: this.$store.state.user_info.userid };
				const _this = this;
				this.$api('index/get_shop_status','POST', data)
				.then(res=>{
					console.log(res);
					_this.status = res.data.status;
					if(res.data) {
						if(res.data.status == 0) {
							_this.shop_status = '待审核'
						}else if (res.data.status == 1) {
							_this.shop_status = '审核通过'
						}else if (res.data.status == 2) {
							_this.shop_status = '审核已拒绝'
						}
					}
				}).catch(err=>{
					console.log(err);
				})
			},
			
			//设置消息已读
			setMessageStatus() {
				const data = {userid: this.$store.state.user_info.userid};
				const _this = this;
				return this.$api('index/set_message_read','POST', data);
			}
		}
	}
</script>

<style lang="scss">
.application-userinfo{
	width:100%;
	height:340upx;
	background-color:#e91010;
	justify-content: center;
	align-items: center;
	.application-userinfo-img {
		width:128upx;
		height:128upx;
		border-radius: 50%;
	}
	.application-userinfo-name{
		margin-top:10upx;
		color:#fff;
	}
}
.application-list{
	
	.application-list-content{
		height:90upx;
		line-height: 90upx;
		padding:0 20upx;
		justify-content: space-between;
		align-items: center;
		border-bottom: 1upx solid #bdbdbd;
		.application-list-content-left{
			font-size: 34upx;
			font-weight: 800;
		}
		
		.application-list-content-right{
			.application-list-content-right-number{
				width:54upx;
				height:54upx;
				line-height: 54upx;
				text-align: center;
				border-radius: 50%;
				background: #e91010;
				color:#fff;
			}
		}
		
	}
}
</style>
