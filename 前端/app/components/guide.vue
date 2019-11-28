<template name="guide">
	<!-- #ifdef H5 -->
		<transition name="fade">
			 <view v-if="show" class="uni-column guide">
				<image src="/static/icon.png" mode="widthFix"></image>
				<view class="title">
					车行路上欢迎您
				</view>
			 </view>
		</transition>
	<!-- #endif -->
</template>

<script>
	export default {
		data() {
			return {
				
			};
		},
		props:{
			show:{
				type: Boolean,
				default: false
			}
		}
	}
</script>

<style lang="scss">
.guide{
	position: fixed;
	left:0;
	top:0;
	width:100%;
	height:100%;
	background: rgba($color: #fff, $alpha: 1.0);
	z-index: 9999;
	align-items: center;
	justify-content: center;
	image{
		width:80%;
	}
	.title{
		font-size: 40upx;
		font-weight: 600;
		color:#707070;
	}
}
 .fade-enter-active, .fade-leave-active {
  transition: opacity .5s;
}
.fade-enter, .fade-leave-to /* .fade-leave-active below version 2.1.8 */ {
  opacity: 0;
}
</style>
