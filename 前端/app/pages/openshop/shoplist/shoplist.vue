<template>
	<view class="shops uni-column">
		<block v-for="(item, index) in  shopType" :key="index">
			<view class="shop-list uni-column">
				<view class="shop-list-content uni-row">
					<view class="image">
						<image :src="item.img" mode=""></image>
					</view>
					<view class="text">
						<view class="name">{{item.name}}</view>
						<view class="descripe">{{item.descripe}}</view>
					</view>
				</view>
				<view class="button uni-row">
					<view class="button-open" @click="getOpenShopType(item.name)">开店</view>
				</view>
			</view>
		</block>
	</view>
</template>

<script>
	export default {
		data() {
			return {
				shopType: [
					{
						name:'二手车店',
						descripe:'为用户提供一个二手车交易平台',
						img:'/static/shuijiao.jpg'
					},	
					{
						name:'新车店',
						descripe:'为用户提供一个二手车交易平台',
						img:'/static/shuijiao.jpg'
					},	
					{
						name:'零售店',
						descripe:'为用户提供一个二手车交易平台',
						img:'/static/shuijiao.jpg'
					},	
				]
			};
		},
		methods:{
			async getOpenShopType(val){
				const result = await this.getExamineStatus();
			    // const result = {data:{code:2}};
				if(val !== '二手车店') {
					return uni.showToast({
						title:'功能暂未开放',
						icon:'none',
						success: res =>{
							setTimeout(() =>{
								uni.navigateBack({
									delta:1,
								})
							},500)
						}
					})
				} 
				if(result.data.code ==0) {
					uni.showToast({
						title:result.data.message,
						icon:'none',
						success:res=> {
							setTimeout(() =>{
								uni.redirectTo({
									url:'../../index/index'
								})
							},500)
						},
						fail:err =>{
							throw err;
						}
					})
				}else if(result.data.code == 1) {
					uni.showToast({
						title:result.data.message,
						success:res=> {
							setTimeout(() =>{
								uni.redirectTo({
									url:"../../application/index/index"
								})
							},500)
						},
						fail:err =>{
							throw err;
						}
					})
				}else if(result.data.code == 2) {
					uni.showToast({
						title:result.data.message,
						success:res=> {
							setTimeout(() =>{
								uni.navigateTo({
									url:'../index/index' 
								})
							},500)
						},
						fail:err =>{
							throw err;
						}
					})
				} else {
					uni.showToast({
						title:result.data.message,
						success:res=> {
							setTimeout(() =>{
								uni.navigateBack({
									delta: 1,
								})
							},500)
						},
						fail:err =>{
							throw err;
						}
					})
				}
			},
			getUserinfo(){
				console.log(this.$store.state.user_info.roleid);
				const _this = this;
				  if(this.$store.state.user_info && this.$store.state.user_info.roleid && this.$store.state.user_info.roleid !=8){
					 if(this.$store.state.user_info.roleid ==7){
						 uni.showModal({
							title:'系统提示',
							content:'您是专员不能操作',
							success:res=>{
								setTimeout(()=>{
									uni.navigateBack({
										delta:1,
									})
								},500)
							}
						 })
					 }else if(this.$store.state.user_info.roleid ==6){
						 // uni.showModal({
							// title:'系统提示',
							// content:'您已经是车商',
							// success:res=>{
							// 	setTimeout(()=>{
							// 		uni.navigateBack({
							// 			delta:1,
							// 		})
							// 	},500)
							// }
						 // })
						 
					 }else{
						 _this.show = true;
					 }
				  }else{
					  uni.showModal({
						title:'系统提示',
						content:'您需要注册会员',
						success:res=>{
							if(res.confirm){
								uni.redirectTo({
									url:'../../register/register'
								})
							}
						},
						fail:err=> {
							uni.showToast({
								title:'System Error'
							})
						}
					  })
				  }
			},
			//------判断用户的店铺审核状态------
			getExamineStatus(){
			    const _this =this;
			    const data = {userid:this.$store.state.user_info.userid};
			    return this.$api('index/find_examine_status','POST', data);
			},
		}
	}
</script>

<style lang="scss">
.shops{
	padding:20upx;
	.shop-list{
		background:#fff;
		margin-bottom:20upx;
		border-radius: 14upx;
		.shop-list-content{
			padding:20upx;
			height:160upx;
			.image{
				flex:1;
				image{
					width:100%;
					height:100%;
				}
			}
			.text{
				flex:2;
				padding: 0 0 0 20upx;
				.name{
					font-size: 32upx;
					color:#000;
					font-weight: bold;
				}
			}
		}
		.button{
			height:80upx;
			border-top:1upx solid #bdbddb;
			flex-direction: row-reverse;
			align-items: center;
			.button-open{
				width:120upx;
				height:60upx;
				line-height: 60upx;
				text-align: center;
				background: red;
				color:#fff;
				border-radius: 8upx;
				margin-right:20upx;
			}
		}
	}
}
</style>
