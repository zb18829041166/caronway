<template>
	<view class="levyfees">
		<view class="levyfees-header">
			<view class="uni-row">
				<view class="levyfees-header-list" :class="flag==0?'isActive':''" @click="selectFlag(0)">
					待审核
				</view>
				<view class="levyfees-header-list" :class="flag==1?'isActive':''" @click="selectFlag(1)">
					已审核
				</view>
			</view>
		</view>
		<view class="levyfees-neardate" v-if="flag==0">
			<view class="message uni-column" v-if="wait_shop && wait_shop.length>0">
				<block  v-for="(item,index) in wait_shop" :key="index">
					<view class="message-content uni-column" @click="goWaitExamineDetail(index)">
						<view class="message-content-title uni-row">
							<image src="/static/large.png" mode=""></image>
							<view class="logo">
								车行路上俱乐部
							</view>
						</view>
						<view class="message-content-content uni-column">
							<view class="title">
								待审核通知
							</view>
							<view class="text">
								车商<text style="color:red;font-weight: 500;;">{{item.realname}}</text>需要您审核
							</view>
						</view>
						<view class="message-content-detail uni-row">
							<view class="">
								查看消息详情
							</view>
							<uni-icon type="arrowright" size="24"></uni-icon>
						</view>
					</view>
				</block>
			</view>
			<view class="no-data" v-else>
				暂无数据
			</view>
		</view>
		<view class="levyfees-overdate" v-else>
			
			<view class="message uni-column" v-if="through_shop && through_shop.length>0">
				<block v-for="(item,index) in through_shop" :key="index">
					<view class="message-content uni-column" @click="goExamineDetail(index)">
						<view class="message-content-title uni-row">
							<image src="/static/large.png" mode=""></image>
							<view class="logo">
								车行路上俱乐部
							</view>
						</view>
						<view class="message-content-content uni-column">
							<view class="title">
								审核处理
							</view>
							<view class="text">
								您已经{{item.status=='1'?'通过' : '拒绝'}}<text style="color:red;font-weight: 500;;">{{item.realname}}</text>的开店申请
							</view>
						</view>
						<view class="message-content-detail uni-row">
							<view class="">
								查看消息详情
							</view>
							<uni-icon type="arrowright" size="24"></uni-icon>
						</view>
					</view>
				</block>
			</view>
			
			<view class="no-data" v-else>
				暂无数据
			</view>
		</view>
	</view>
</template>

<script>
	import uniIcon from "@/components/uni-icon/uni-icon.vue"
	export default {
		data() {
			return {
				flag:0,
				wait_shop:[],
				through_shop:[]
			};
		},
		components:{
		  uniIcon	
		},
		onLoad(){
			this.getWaitExamine();
			this.getThroughExamine();
		},
		methods:{
			selectFlag(id){
				this.flag = id;
			},
			getWaitExamine(){
				const _this = this;
				const data = {};
				this.$api('index/find_wait_shop','POST', data)
				.then(res=>{
					console.log(res)
					if(res.data && res.data.length>0){
						_this.wait_shop=res.data;
					}
				}).catch(err=>{
					console.log(err);
				})  
			},
			getThroughExamine(){
				const _this = this;
				const data = {};
				this.$api('index/find_through_shop','POST', data)
				.then(res=>{
					console.log(res)
					if(res.data && res.data.length>0){
						this.through_shop=res.data;
					}
				}).catch(err=>{
					console.log(err);
				})  
			},
			goExamineDetail(id){
				console.log(this.through_shop[id]);
				this.$store.state.examineInfo = this.through_shop[id];
				uni.navigateTo({
					url:'../examine-detail/examine-detail'
				})
			},
			goWaitExamineDetail(id){
				console.log(this.wait_shop[id]);
				this.$store.state.examineInfo = this.wait_shop[id];
				uni.navigateTo({
					url:'../examine-detail/examine-detail'
				})
			}
		}
	}
</script>

<style lang="scss">
.levyfees{
	padding-top:120upx;
	.levyfees-header{
		position: fixed;
		left:0;
		top:90upx;
		width:100%;
		height:100upx;
		line-height: 100upx;
		background:#fff;
		z-index: 999;
		.levyfees-header-list{
			width:50%;
			text-align: center;
			font-size: 34upx;
		}
		.isActive{
			color:red;
			background:#f5f5f5;
			border-bottom:2upx solid red;
		}
	}
	.levyfees-neardate{
		background:#f5f5f5;
	}
	.levyfees-overdate{
		background:#f5f5f5;
	}
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
	.no-data{
		height:500upx;
		line-height: 500upx;
		width:100%;
		text-align: center;
		font-weight: 600;
		font-size: 32upx;
	}
}

</style>
