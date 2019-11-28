<template>
	<view class="singlecar">
		<swiper class="singlecar-swiper" :indicator-dots="false" :autoplay="true" :interval="3000" :duration="1000">
			<swiper-item>
				<image :src="car_detail.frontpic" class="swiper-item" ></image>
				<view class="singlecar-swiper-text">
					正面图
				</view>
			</swiper-item>
			<swiper-item>
				<image :src="car_detail.rightside" class="swiper-item" ></image>
				<view class="singlecar-swiper-text">
					右侧图
				</view>
			</swiper-item>
			<swiper-item>
				<image :src="car_detail.leftside" class="swiper-item" ></image>
				<view class="singlecar-swiper-text">
					左侧图
				</view>
			</swiper-item>
			<swiper-item>
				<image :src="car_detail.rearview" class="swiper-item" ></image>
				<view class="singlecar-swiper-text">
					尾部图
				</view>
			</swiper-item>
			<swiper-item>
				<image :src="car_detail.frontcover" class="swiper-item" ></image>
				<view class="singlecar-swiper-text">
					车前盖图
				</view>
			</swiper-item>
			<swiper-item>
				<image :src="car_detail.interior1" class="swiper-item" ></image>
				<view class="singlecar-swiper-text">
					内饰图1
				</view>
			</swiper-item>
			<swiper-item>
				<image :src="car_detail.interior2" class="swiper-item" ></image>
				<view class="singlecar-swiper-text">
					内饰图2
				</view>
			</swiper-item>
			<swiper-item>
				<image :src="car_detail.interior3" class="swiper-item" ></image>
				<view class="singlecar-swiper-text">
					内饰图3
				</view>
			</swiper-item>
		</swiper>
		<view class="singlecar-base">
			基本参数
		</view>
		<view class="uni-column singlecar-list">
			<view class="singlecar-content uni-row">
				<view class="singlecar-content-lef">厂商</view>
				<view class="singlecar-content-rig">{{car_detail.prdFactory}}</view>
			</view>
			<view class="singlecar-content uni-row">
				<view class="singlecar-content-lef">品牌型号</view>
				<view class="singlecar-content-rig">{{car_detail.classid}}{{car_detail.classcid}}</view>
			</view>
			<view class="singlecar-content uni-row">
				<view class="singlecar-content-lef">车型</view>
				<view class="singlecar-content-rig">{{car_detail.model}}</view>
			</view>
			<view class="singlecar-content uni-row">
				<view class="singlecar-content-lef">级别</view>
				<view class="singlecar-content-rig">{{car_detail.classes}}</view>
			</view>
			<view class="singlecar-content uni-row">
				<view class="singlecar-content-lef">发动机</view>
				<view class="singlecar-content-rig">{{car_detail.motor}}</view>
			</view>
			<view class="singlecar-content uni-row">
				<view class="singlecar-content-lef">变速箱</view>
				<view class="singlecar-content-rig">{{car_detail.gearbox}}</view>
			</view>
			<view class="singlecar-content uni-row">
				<view class="singlecar-content-lef">车身结构</view>
				<view class="singlecar-content-rig">{{car_detail.structure}}</view>
			</view>
			<view class="singlecar-content uni-row">
				<view class="singlecar-content-lef">长宽高</view>
				<view class="singlecar-content-rig">{{car_detail.outline}}</view>
			</view>
			<!-- <view class="singlecar-content uni-row">
				<view class="singlecar-content-lef">结构</view>
				<view class="singlecar-content-rig">{{car_detail.structure}}</view>
			</view> -->
		</view>
		<view class="singlecar-base">
			发动机参数
		</view>
		<view class="uni-column singlecar-list">
			<view class="singlecar-content uni-row">
				<view class="singlecar-content-lef">排量</view>
				<view class="singlecar-content-rig">{{car_detail.fuelcsption}}</view>
			</view>
			<view class="singlecar-content uni-row">
				<view class="singlecar-content-lef">最大马力</view>
				<view class="singlecar-content-rig">{{car_detail.maxkw}}</view>
			</view>
			<view class="singlecar-content uni-row">
				<view class="singlecar-content-lef">最大扭矩</view>
				<view class="singlecar-content-rig">{{car_detail.maxtorque}}</view>
			</view>
			<view class="singlecar-content uni-row">
				<view class="singlecar-content-lef">燃料类型</view>
				<view class="singlecar-content-rig">{{car_detail.energyType}}</view>
			</view>
			<!-- <view class="singlecar-content uni-row">
				<view class="singlecar-content-lef">排放标准</view>
				<view class="singlecar-content-rig">{{car_detail.classid}}{{car_detail.classcid}}</view>
			</view> -->
		</view>
		<view class="singlecar-base">
			使用信息
		</view>
		<view class="uni-column singlecar-list">
			<view class="singlecar-content uni-row">
				<view class="singlecar-content-lef">行驶里程</view>
				<view class="singlecar-content-rig">{{car_detail.hadkm}}公里</view>
			</view>
			<view class="singlecar-content uni-row">
				<view class="singlecar-content-lef">车龄</view>
				<view class="singlecar-content-rig">{{car_detail.age}}</view>
			</view>
			<view class="singlecar-content uni-row">
				<view class="singlecar-content-lef">过户次数</view>
				<view class="singlecar-content-rig">{{car_detail.times}}</view>
			</view>
			<view class="singlecar-content uni-row">
				<view class="singlecar-content-lef">上牌地址</view>
				<view class="singlecar-content-rig">{{car_detail.placepro}}</view>
			</view>
			<view class="singlecar-content uni-row">
				<view class="singlecar-content-lef">注册日期</view>
				<view class="singlecar-content-rig">{{car_detail.regtime}}</view>
			</view>
			<view class="singlecar-content uni-row">
				<view class="singlecar-content-lef">交强险日期</view>
				<view class="singlecar-content-rig">{{car_detail.instime}}</view>
			</view>
		</view>
		<page-swiper></page-swiper>
	</view>
</template>

<script>
	export default {
		data() {
			return {
				car_detail:'',
			};
		},
		onLoad(options){
			console.log(options.carid);
			this.getCarDetailInfo(options.carid);
		 options.carid;
		},
		methods:{
			getCarDetailInfo(carid){
				const _this =this;
				const data={id:carid};
				this.$api('index/get_car_details','POST', data)
				.then(res=>{
					console.log(res)
					if(res.data){
						_this.car_detail = res.data?res.data:'';
					}
				}).catch(err=>{
					console.log(err);
				})
			},
		}
	}
</script>

<style lang="scss" scoped>
  .singlecar{
	  .singlecar-swiper{
		  width:100%;
		  height:400upx;
		  margin-bottom:20upx;
		  swiper-item{
			 width:100%;
			 height:400upx;
			 position: relative;
			  image{
				  width:100%;
				  height:400upx;
			  }
			  .singlecar-swiper-text{
				  position: absolute;
				  left:0;
				  bottom:0;
				  background: rgba($color: #ffffff, $alpha: .6);
				  width:100%;
				  height:60upx;
				  line-height: 60upx;
				  text-indent: 20upx;
			  }
		  }
	  }
	  .singlecar-base{
		  height:70upx;
		  line-height: 70upx;
		  padding:0 20upx;
		  background-color:#bdbdbd;
		  color:#000;
		  font-weight: bold;
	   }
	  .singlecar-list{
		 .singlecar-content{
			 justify-content: space-between;
			 border-bottom:1upx solid #bdbdbd;
			 height:70upx;
			 line-height: 70upx;
			 padding:0 20upx;
			 .singlecar-content-lef{
				 
			 }
			 .singlecar-content-rig{
				 
			 }
		 }  
	  }
  }
</style>
