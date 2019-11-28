<template name="page-content">
	<view class="page-content">
		<scroll-view class="page-item" scroll-x="true">
			<block v-for="(item,index) in list" :key="index">
				<view class="page-item-content" @click="goPersonCar(item.carid)">
					<view class="uni-column">
						<image class="page-item-content-img" :src="item.frontcover" mode="aspectFill"></image>
						<view class="page-item-content-title">
							{{item.classid}}{{item.classcid}}
						</view>
						<text class="page-item-content-pl is-h6">{{item.newprice}}万</text>
						<text class="page-item-content-dw is-h6">档位:{{item.gearbox}}</text>
						<text class="page-item-content-lc is-h6">里程:{{item.hadkm}}万公里</text>
					</view>
				</view>
			</block>
		</scroll-view>
	</view>
</template>

<script>
	export default {
		data() {
			return {
				
			};
		},
		props:{
			list:{
				type:Array,
				default:() => {
					return {}
				}
			}
		},
		methods:{
			goPersonCar(id){
				this.$emit('goPersonCar',id)
			}
		}
	}
</script>

<style lang="scss">
.page-content{
	padding:0 20upx 14upx 20upx;
	margin:20upx 0;
	 .page-item{
		  width:100%;
		  white-space: nowrap;
		 .page-item-content{
			display: inline-block;
			width: 45%;
			text-align: center;
			font-size: 36upx;
			margin-right:20upx;
			 background:#fff;
			 text-align: left;
			 border-radius: 14upx;
			 overflow: hidden;
			 .page-item-content-img{
				 width:100%;
				 height:240upx;
			 }
			 .page-item-content-title{
				 font-weight: bold;
				 text-indent: 24upx;
			 }
			 .page-item-content-pl,.page-item-content-dw,.page-item-content-lc{
				 margin-left: 24upx;
				 font-size: 28upx;
			 }
		 }
	 }
 }
</style>
