<template name="uni-business">
	<view class="uni-business uni-column" @click="goCarDetail(carInfo.id)">
		<swiper class="uni-business-swiper" :indicator-dots="true" :autoplay="true" :interval="4000" :duration="1000">
			<swiper-item>
				<image :src="carInfo.frontcover" class="swiper-item" ></image>
			</swiper-item>
			<swiper-item>
				<image :src="carInfo.frontpic" class="swiper-item" ></image>
			</swiper-item>
			<swiper-item>
				<image :src="carInfo.rearview" class="swiper-item" ></image>
			</swiper-item>
			<swiper-item>
				<image :src="carInfo.rightside" class="swiper-item" ></image>
			</swiper-item>
			<swiper-item>
				<image :src="carInfo.leftside" class="swiper-item" ></image>
			</swiper-item>
			<swiper-item>
				<image :src="carInfo.interior1" class="swiper-item" ></image>
			</swiper-item>
			<swiper-item>
				<image :src="carInfo.interior2" class="swiper-item" ></image>
			</swiper-item>
			<swiper-item>
				<image :src="carInfo.interior3" class="swiper-item" ></image>
			</swiper-item>
		</swiper>
		<view class="uni-h4">
			{{carInfo.carName}}
		</view>
		<view class="">
			行驶里程:{{carInfo.hadkm}}公里
		</view>
		<view class="uni-business-price">
			报价:<text>{{carInfo.realprice}}万元</text>
		</view>
		<view class="uni-business-contact uni-h5" @click.stop="getContact(phone)">
			立即联系
		</view>
	</view>
</template>

<script>
	export default {
		data() {
			return {
				
			};
		},
		props:{
			role:{
				type:String,
				default:''
			},
			photo:{
				type:String,
				default:''
			},
			carInfo:{
				type:Object,
				default:()=>{
					return {};
				}
			},
			phone:{
				type:String,
				default:''
			}
		},
		methods:{
			getContact(phone){
				console.log(phone);
				uni.makePhoneCall({
					phoneNumber:phone
				})
			},
			goCarDetail(id){
				// uni.navigateTo({
				// 	url:`../cardeatil/cardeatil?carid=${id}`
			 //    })
			 console.log(id);
			 this.$emit('goCarDetail',id)
			},
			getEditCar(id){
				this.$emit('getEditCar',id)
			}
		}
	}
</script>

<style lang="scss">
 .uni-business{
	 padding:20upx;
	 background-color: #fff;
	 margin-bottom:20upx;
	 .uni-business-swiper{
		 width:100%;
		 height:320upx;
		 swiper-item{
			 width:100%;
			 height:320upx;
			 image{
				 width:100%;
				 height:320upx;
			 }
		 }
	 }
	 .uni-business-contact{
		 background-color: green;
		 height:60upx;
		 line-height: 60upx;
		 width:140upx;
		 color:#fff;
		 border-radius: 12upx;
		 text-align: center;
	 }
	 .uni-business-price text{
		 font-weight: bold;
		 color:#e82713;
		 font-size: 34upx;
	 }
 }
</style>
