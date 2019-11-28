<template name="page-scroll">
	<view class="page-scroll">
		<scroll-view scroll-x="true" scroll-y="false" @scroll="scroll" class="page-scroll-view">
			<view v-for="(item,index) in list" :key="index" class="page-scroll-content" @click="goBusiness(item.userid)">
				<image class="page-scroll-content-img" :src="item.logoori" mode=""></image>
				<view class="page-scroll-content-text">{{item.realname}}</view>
			</view>
			<view class="page-scroll-content">
				<image class="page-scroll-content-img" src="/static/bwm.png"></image>
				<view class="page-scroll-content-text">更多</view>
			</view>
		</scroll-view>
	</view>
</template>

<script>
	export default {
		name:'page-scroll',
		data() {
			return {
			};
		},
		props:{
			list:{
				type:Array,
				default:function(){
					return [];
				}
			}
				
		},
		methods:{
			scroll(e){
				console.log(e);
			},
			goBusiness(id){
				this.$emit('goBusiness',id);
			}
		}
	}
</script>

<style lang="scss">
  .page-scroll{  
	  padding:0 20upx;
	  margin:20upx 0;
	  .page-scroll-view{
		  width:100%;
		  height:260upx;
		  white-space: nowrap;
		  background:#fff;
		  .page-scroll-content{
		  		 display: inline-block;
		  		 width: 30%;
				 height:260upx;
		  		 text-align: center;
		  		 font-size: 36upx;
		  		  .page-scroll-content-img{
		  			  width:140upx;
		  			  height:140upx;
					  margin-top:30upx;
					  border-radius: 50%;
		  		  }
		  		  .page-scroll-content-text{  
					  font-size: 32upx;
					  line-height: 30upx;
					  font-weight: bold;
		  		  }
		  }
	  }
	  
// 	  .scroll-view_H {
// 	  	white-space: nowrap;
// 	  	width: 100%;
// 	  }
	  
// 	  .scroll-view-item {
// 	  	height: 300upx;
// 	  	line-height: 300upx;
// 	  	text-align: center;
// 	  	font-size: 36upx;
// 	  }
// 	  
// 	  .scroll-view-item_H {
// 	  	display: inline-block;
// 	  	width: 30%;
// 	  	height: 300upx;
// 	  	line-height: 300upx;
// 	  	text-align: center;
// 	  	font-size: 36upx;
// 	  }
  }
</style>
