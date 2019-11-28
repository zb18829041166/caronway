<template>
	<view class="message uni-column">
		<view class="message-content uni-column">
			<view class="message-content-title uni-row">
				<image src="/static/large.png" mode=""></image>
				<view class="logo">
					车行路上俱乐部
				</view>
			</view>
			<view class="message-content-content uni-column">
				<view class="title">
					缴费通知
				</view>
				<view class="text">
					您的开店费用已经要用完
				</view>
			</view>
			<view class="message-content-detail uni-row">
				<view class="">
					查看消息详情
				</view>
				<uni-icon type="arrowright" size="24"></uni-icon>
			</view>
		</view>
		
		<view class="message-content uni-column">
			<view class="message-content-title uni-row">
				<image src="/static/large.png" mode=""></image>
				<view class="logo">
					车行路上俱乐部
				</view>
			</view>
			<view class="message-content-content uni-column">
				<view class="title">
					投诉通知
				</view>
				<view class="text">
					您的店铺被用户投诉
				</view>
			</view>
			<view class="message-content-detail uni-row">
				<view class="">
					查看消息详情
				</view>
				<uni-icon type="arrowright" size="24"></uni-icon>
			</view>
		</view>
		
		<view class="message-content uni-column">
			<view class="message-content-title uni-row">
				<image src="/static/large.png" mode=""></image>
				<view class="logo">
					车行路上俱乐部
				</view>
			</view>
			<view class="message-content-content uni-column">
				<view class="title">
					店铺下线通知
				</view>
				<view class="text">
					您的店铺已经被下线
				</view>
			</view>
			<view class="message-content-detail uni-row">
				<view class="">
					查看消息详情
				</view>
				<uni-icon type="arrowright" size="24"></uni-icon>
			</view>
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
	}
</script>

<style lang="scss">
.message{
	padding:20upx; 
	.message-content{
		background:#fff;
		border-radius: 12upx;
		padding:0 20upx;
		margin-bottom:20upx;
		.message-content-title{
			padding:20upx 0;
			image{
				width:78upx;
				height:78upx;
				border-radius: 50%;
			}
			.logo{
				margin-left:20upx;
				font-weight: bold;
				font-size: 34upx;
				line-height:78upx; 
			}
		}
		.message-content-content{
			.title{
				font-size: 32upx;
				font-weight: 500;
			}
			.text{
				color:#999999;
				font-size: 28upx;
			}
		}
		.message-content-detail{
			width:100%;
			border-top:1upx solid #bdbdbd;
			height:80upx;
			line-height: 80upx;
			margin-top:40upx;
			font-weight: 500;
			font-size: 34upx;
			align-self: flex-end;
			justify-content: space-between;
			align-items: center;
		}
	}
}

</style>
