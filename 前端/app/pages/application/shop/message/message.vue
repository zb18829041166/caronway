<template>
	<view class="message uni-column">
		<block v-for="(item,index) in message_list" :key="index">
			<view class="message-content uni-column">
				<view class="message-content-title uni-row">
					<image src="/static/large.png" mode=""></image>
					<view class="logo">
						车行路上俱乐部
					</view>
				</view>
				<view class="message-content-content uni-column">
					<view class="title">
						系统通知
					</view>
					<view class="text">
						{{item.content}}
					</view>
				</view>
				<view class="message-content-detail uni-row">
					<view class="">
						<!-- 查看消息详情 -->
					</view>
					<!-- <uni-icon type="arrowright" size="24"></uni-icon> -->
				</view>
			</view>
		</block>
	</view>
</template>

<script>
	import uniIcon from "@/components/uni-icon/uni-icon.vue"
	export default {
		data() {
			return {
				message_list:[],
			};
		},
		components:{
		  uniIcon	
		},
		onLoad(options) {
			this.getMessageList(options.userid);
		},
		methods:{
			getMessageList(id){
				const _this = this;
				const data = {secuserid:id};
				this.$api('index/get_user_message','POST', data)
				.then(res=>{
					console.log(res);
					if(res.data && res.data.length>0){
						_this.message_list = res.data;
					}else{
						uni.showToast({
							title:'暂无消息',
							icon:'none'
						})
					}
					
				}).catch(err=>{
					console.log(err);
				})  
			}
		}
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
				color:red;
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
