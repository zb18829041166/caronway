<template name="page-item">
		<view class="page-item uni-row">
			<block v-for="(item,index) in list" :key="index">
				<view class="uni-column page-item-content" @click="goSingleCar(item.id)">
					<image class="page-item-content-img" :src="item.frontpic" mode="aspectFill"></image>
					<view class="page-item-content-title">
						{{item.carName}}
					</view>
					<!-- <text class="page-item-content-pl is-h6">排量:4l</text> -->
					<text class="page-item-content-dw is-h6">变速箱:{{item.gearbox}}</text>
					<text class="page-item-content-lc is-h6">里程:{{item.hadkm}}万公里</text>
					<text class="page-item-content-sp is-h6">上牌:{{item.place}}</text>
					<view class="page-item-content-price">
						{{item.realprice}}万
					</view>
				</view>
			</block>
			<view class="page-item-loading" @click="getMoreItem()">
				加载更多
			</view>
		</view>
</template>

<script>
	export default {
		name:'page-item',
		data() {
			return {
			};
		},
		props:{
			list:{
				type: Array,
			}
		},
		methods:{
			goSingleCar(id){
				this.$emit('goSingleCarDetail',id);
			},
			getMoreItem(){
				this.$emit('getMoreItem',this)
			}
		}
	}
</script>

<style lang="scss">
 .page-item{
	 flex-wrap: wrap;
	 justify-content: space-between;
	 background-color: #f5f5f5;
	 padding:20upx 16upx;
	 .page-item-content{
		 background:#fff;
	 	 width:49%;
		 border-radius: 14upx;
	 	 overflow: hidden;
		 margin-bottom:20upx;
		 position:relative;
		 text-indent: 10upx;
		 .page-item-content-img{
			 width:100%;
			 height:240upx;
		 }
		 .page-item-content-title{
			 font-weight: bold;
		 }
		 .page-item-content-price{
			 width:140upx;
			 height:60upx;
			 line-height: 60upx;
			 position: absolute;
			 left:0;
			 top:180upx;
			 background:red;
			 border-radius: 0 30upx 30upx 0;
			 color:#fff;
		}
	 }
 }
 .page-item-loading{
	 height:70upx;
	 line-height: 70upx;
	 text-align: center;
	 background-color: #fff;
	 width:100%;
	 border-radius: 10upx;
 }
</style>
