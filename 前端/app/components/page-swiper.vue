<template name="page-swiper">
	<view class="page-swiper uni-column">
		<swiper :indicator-dots="true" :autoplay="true" :interval="3000" :duration="1000">
			<swiper-item>
				<image src="/static/ban1.png" class="swiper-item" mode="widthFix"></image>
			</swiper-item>
			<swiper-item>
				<image src="/static/ban1.png" class="swiper-item" mode="widthFix"></image>
			</swiper-item>
			<swiper-item>
				<image src="/static/ban1.png" class="swiper-item" mode="widthFix"></image>
			</swiper-item>
		</swiper>
	</view>
</template>

<script>
	export default {
		data() {
			return {
				
			};
		}
	}
</script>

<style lang="scss">
   .page-swiper{
	   padding:0 20upx;
	   margin:20upx 0;
	   swiper{
		   width:100%;
		   height:240upx;
		   swiper-item{
			   .swiper-item{
				   width:100%;
				   height:240upx;
				   background-color: green;
			   }
		   }
	   }
   }
</style>
