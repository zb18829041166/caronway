<template>
	<view class="complaint uni-column">
		<view class="complaint-header uni-column">
			<image src="/static/large.png" mode=""></image>
			<view class="complaint-header-name uni-h4">
				车行路上俱乐部
			</view>
			<view class="complaint-header-resolve">
				投诉处理
			</view>
		</view>
		
		<view class="complaint-content uni-column">
			<view class="complaint-content-list uni-row">
				<view class="complaint-content-list-name">
					车辆名称
				</view>
				<view class="complaint-content-text">
					{{car_info.classid}}{{car_info.classcid}}
				</view>
			</view>
			<view class="complaint-content-list uni-row">
				<view class="complaint-content-list-name">
					车行名称
				</view>
				<view class="complaint-content-text">
					{{shop_info.realname}}
				</view>
			</view>
			<view class="complaint-content-list uni-row">
				<view class="complaint-content-list-name">
					上线时间
				</view>
				<view class="complaint-content-text">
					{{ts.createTime}}
				</view>
			</view>
			<view class="complaint-content-list uni-row">
				<view class="complaint-content-list-name">
					当前状态
				</view>
				<view class="complaint-content-text">
					{{ts.status=='0'?'未处理':'已处理'}}
				</view>
			</view>
			<view class="complaint-content-list uni-row">
				<view class="complaint-content-list-name">
					投诉原因
				</view>
				<view class="complaint-content-text">
					{{ts.content}}
				</view>
			</view>
		</view>
		
		<view class="complaint-operate uni-column">
			<view class="complaint-operate-content uni-row" @click="goCarDetail">
				<view class="complaint-operate-content-left">
					违规车辆详情
				</view>
				<uni-icon type="arrowright" size="24"></uni-icon>
			</view>
			<!-- <view class="complaint-operate-content uni-row">
				<view class="complaint-operate-content-left">
					类似投诉
				</view>
				<uni-icon type="arrowright" size="24"></uni-icon>
			</view> -->
			<!-- <view class="complaint-operate-content uni-row">
				<view class="complaint-operate-content-left">
					联系车行
				</view>
				<uni-icon type="arrowright" size="24"></uni-icon>
			</view> -->
			<view class="complaint-operate-content uni-row" style="border:none;" @click="getResolveResult">
				<view class="complaint-operate-content-left">
					立即处理
				</view>
				<uni-icon type="arrowright" size="24"></uni-icon>
			</view>
		</view>
		
		<view class="complaint-cover" v-show="cover_show">
			<view class="complaint-cover-content uni-column">
				<view class="complaint-cover-content-btn" @click="goOfflineShop">
					下线店铺
				</view>
				<view class="complaint-cover-content-btn" @click = "goCorrectResolve">
					归正投诉
				</view>
				<view class="complaint-cover-content-btn" @click="hideShowCover">
					取消操作
				</view>
			</view>
		</view>
	</view>
</template>

<script>
	import uniIcon from "@/components/uni-icon/uni-icon.vue"
	export default {
		data() {
			return {
				cover_show:false,
				ts:'',
				shop_info:'',
				car_info:'',
			};
		},
		components:{
		  uniIcon	
		},
		async onLoad() {
			this.ts = this.$store.state.tousu;
			// const Page = currentPage();
			// console.log(Page);
		   const result = await this.getShopInfo();
		   console.log(result);
		   if(result.data) {
			   this.shop_info =  result.data;
		   }
		   const carinfo = await this.getCarInfo();
		   if(carinfo.data[0]) {
			   this.car_info = carinfo.data[0];
		   }
		},
		methods:{
			getResolveResult(){
				this.cover_show = true;
			},
			hideShowCover(){
				this.cover_show = false;
			},
			goOfflineShop(){
				const _this = this;
				const data = {id:this.shop_info.id,userid:this.ts.userid};
				this.$api('index/shop_off_line','POST', data)
				.then(res=>{
					console.log(res)
					if(res.data.errcode==0){
						uni.showToast({
							title:res.data.errstr,
							success:res=>{
								_this.cover_show = false;
								setTimeout(()=>{
									_this.setTsStatus();
									uni.navigateBack({
										delta:1
									})
								},500)
							}
						})
					}else{
						uni.showToast({
							title:res.data.errstr
						})
					}
				}).catch(err=>{
					console.log(err);
				})  
			},
			getShopInfo(){
				const data = {userid:this.ts.userid};
				const _this = this;
				return this.$api('index/get_shop_detail','POST', data);
			},
			goCarDetail() {
				if(this.ts.carid) {
					uni.navigateTo({
						url:`../../../secondhandcar/cardeatil/cardeatil?carid=${this.ts.carid}`
					})
				}
			},
			async goCorrectResolve() {
				await this.sendNotify();
				await this.setTsStatus();
			},
			//获取车辆信息
			getCarInfo() {
				const data={carid: this.ts.carid};
				return this.$api('index/get_car_detailinfo','POST', data);
			},
			// -- 发送通知 -----
			sendNotify(){
				const _this = this;
				const data = {
					userid:this.$store.state.user_info.userid,
					secuserid:this.ts.userid,
					content:`您的车辆${this.car_info.classid}${this.car_info.classcid}被投诉,已由专员归正`,
				};
				this.$api('index/send_user_message','POST', data)
				.then(res=>{
					
				}).catch(err=>{
					throw err;
				})  
			},
			//改变消息投诉状态
			setTsStatus(){
				const data = {
					carid: this.ts.carid,
				};
				return this.$api('index/set_tx_status','POST', data)
			},
		}
	}
</script>

<style lang="scss">
.complaint{
	.complaint-header{
		background-color: #fff;
		align-items: center;
		border-bottom:1upx solid #bdbdbd;
		padding:20upx;
		image{
			width:128upx;
			height:128upx;
			border-radius: 50%;
		}
		.complaint-header-resolve{
			font-size: 36upx;
			margin-top:14upx;
			color:#999999;
		}
	}
	.complaint-content{
		background-color: #fff;
		padding:0 20upx;
		.complaint-content-list{
			height:85upx;
			line-height: 85upx;
			.complaint-content-list-name{
				font-size: 34upx;
				width:160upx;
				color:#000;
				font-weight: 500;
			}
			.complaint-content-text{
				font-size: 34upx;
				color:#999999;
			}
		}
	}
	.complaint-operate{
		padding:0 20upx;
		background:#fff;
		margin-top:20upx;
		border-bottom:1upx solid #bdbdbd;
		.complaint-operate-content{
			justify-content: space-between;
			align-items: center;
			height:90upx;
			line-height: 90upx;
			border-bottom:1upx solid #bdbdbd;
			.complaint-operate-content-left{
				font-size:34upx;
			}
		}
	}
}

.complaint-cover{
	width:100%;
	height:100%;
	position: fixed;
	left:0;
	top:0;
	background:rgba($color: #000000, $alpha: .6 );
	.complaint-cover-content{
		width:80%;
		height:300upx;
		position: fixed;
		left:50%;
		top:50%;
		transform: translateX(-50%) translateY(-50%);
		background:#fff;
		border-radius: 14upx;
		.complaint-cover-content-btn{
			height:99upx;
			line-height: 99upx;
			font-size: 36upx;
			font-weight: 500;
			border-bottom:1upx solid #bdbdbd;
			text-align: center;
			
		}
	}
}
</style>
