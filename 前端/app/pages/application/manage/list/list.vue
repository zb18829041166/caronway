<template>
	<view class="uni-column application-list">
		<view class="uni-row application-list-content" @click="goMyInfomation">
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
		</view>
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
		<view class="uni-row application-list-content" @click="goDirectorComplaint">
			<view class="application-list-content-left">
				投诉处理
			</view>
			<uni-icon type="arrowright" size="28"></uni-icon>
		</view>
	</view>
</template>

<script>
	import uniIcon from "@/components/uni-icon/uni-icon.vue"
	export default {
		data() {
			return {
				
			};
		},
		components:{
		  uniIcon	
		},
		methods:{
			goMyInfomation() {
				uni.navigateTo({
					url:'../../director/examine/examine'
				})
			},
			goMyDateSetting(){
				uni.navigateTo({
					url:'../../director/setting/setting'
				})
			},
			//专员处理投诉
			goDirectorComplaint(){
				uni.navigateTo({
					url:'../../director/complaint/complaint'
				})
			},
			goDirectoMessage(){
				uni.navigateTo({
					url:'../../director/message/message'
				})
			},
			goDirectoLevyfees(){
				uni.navigateTo({
					url:'../../director/levyfees/levyfees'
				})
			},
			goMyCarSetting(){
				uni.navigateTo({
					url:'../../director/carbaseting/carbaseting'
			    })
			}
		}
	}
</script>

<style lang="scss">
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
			font-weight: 400;
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
