<template>
	<view class="message uni-column">
		<block v-for="(item,index) in ts_list" :key="index">
			<view class="message-content uni-column">
				<view class="message-content-title uni-row">
					<image src="/static/large.png" mode=""></image>
					<view class="logo">
						车行路上俱乐部
					</view>
				</view>
				<view class="message-content-content uni-column">
					<view class="title">
						投诉原因
					</view>
					<view class="text">
						{{item.content}}
					</view>
				</view>
				<view class="message-content-detail uni-row" @click="goComplaintDetail(index)">
					<view class="">
						查看处理详情
					</view>
					<uni-icon type="arrowright" size="24"></uni-icon>
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
				ts_list:[],
			};
		},
		components:{
		  uniIcon	
		},
		onLoad() {
			
		},
		onShow() {
			this.getTousuList();
		},
		methods:{
			goComplaintDetail(id){
				this.$store.state.tousu = this.ts_list[id];
				uni.navigateTo({
					url:'../complaintdel/complaintdel'
				})
			},
			getTousuList(){
				const _this = this;
				const data = {};
				this.$api('index/find_tx_info','POST', data)
				.then(res=>{
					console.log(res)
					_this.ts_list = res.data;
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
