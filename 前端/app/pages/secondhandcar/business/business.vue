<template>
	<view class="business-info uni-column">
		<swiper class="business-info-swiper" :indicator-dots="true" :autoplay="true" :interval="3000" :duration="1000">
			<swiper-item class="business-info-swiper-item">
				<image :src="shop_info.innimg"  ></image>
			</swiper-item>
			<swiper-item class="business-info-swiper-item">
				<image :src="shop_info.outimg" class="swiper-item" ></image>
			</swiper-item>
		</swiper>
		<view class="business-info-detail uni-column">
			<view class="business-info-detail-name uni-h4">
				{{shop_info.realname}}
			</view>
			<view class="business-info-detail-address">
				<uni-icon type="location" size="26"></uni-icon>
				{{shop_info.address}}
			</view>
			<view class="business-info-detail-telephone">
				<uni-icon type="phone" size="26"></uni-icon>
				联系电话:{{shop_info.telephone}}   
			</view>
		</view>
		<block v-for="(car,index) in car_info" :key="index">
			<uni-business :carInfo="car" :phone="shop_info.telephone" @getEditCar="getEditCar" @goCarDetail="goCarDetail"></uni-business>
		</block>
		
	    <page-swiper></page-swiper>	
		<map style="width: 100%; height: 300px;" :latitude="shop_info.latitude" :longitude="shop_info.longitude" :markers="covers">
        </map>
	</view>
</template>

<script>
	import uniBusiness from '@/components/uni-business.vue'
	import uniIcon from "@/components/uni-icon/uni-icon.vue"
	export default {
		data() {
			return {
				role:'',
				openid:'',
				
				latitude: 39.909,
				longitude: 116.39742,
				shop_info:{},
				car_info:[],
				covers: [],
			};
		},
		components:{
			uniBusiness,
			uniIcon
		},
		onShow(){
			uni.getLocation({
				type: 'wgs84',
				success: function (res) {
					console.log('当前位置的经度：' + res.longitude);
					console.log('当前位置的纬度：' + res.latitude);
				}
			});
			
		},
		onLoad(options){
			console.log(options);
			// this.role = options.userid;
			this.getShopInfo(options.userid);
			this.getShopCar(options.userid);
		},
		methods:{
			getEditCar() {
				uni.showModal({
					title:'系统提示',
					content:'重新编辑车辆信息下线店铺',
					success:res =>{
						if(res.confirm){
							uni.navigateTo({
								url:'../../openshop/uploadcar/uploadcar'
							})
						}
					},
					fail:err =>{
						throw new Error(err);
					}
				})
			},
			goCarDetail(val) {
			  console.log(val);
				  uni.navigateTo({
				  	url:`../cardeatil/cardeatil?carid=${val}`
				  })
			},
			getShopInfo(id){
				const data = {userid:id};
				const _this = this;
				this.covers = [];
				const result = {
					iconPath: '../../../static/location.png'
				}
				this.$api('index/get_shop_detail','POST', data)
				.then(res=>{
					console.log(res)
					if(res.data){
						_this.shop_info = res.data;
						result.latitude = res.data.latitude;
						result.longitude = res.data.longitude;
						_this.covers.push(result);
					}
				}).catch(err=>{
					console.log(err);
				})
			},
			getShopCar(id){
				const data = {userid:id};
				const _this = this;
				this.$api('index/get_shop_car','POST', data)
				.then(res=>{
					console.log(res);
					
					if(res.data && res.data.length>0){
						_this.car_info = res.data;
					}
				}).catch(err=>{
					console.log(err);
				})
			},
			getShopRole(){
				const data = {openid:this.$store.state.openid};
				const _this = this;
				this.$api('index/get_user_info','POST', data)
				.then(res=>{
					console.log(res)
					if(res.data){
						const data = res.data;
						_this.roleid = res.data.roleid;
						if(data.roleid == '8'){
							
						}else if(data.roleid == '7'){
							
						}else if(data.roleid == '6'){
							
						}else if(data.roleid == '5'){
							
						}
						
					}
				}).catch(err=>{
					console.log(err);
				})
			}
		}
	}
</script>

<style lang="scss">
.business-info{
	background-color:#f5f5f5;
	.business-info-swiper{
		width:100%;
		height:400upx;
		.business-info-swiper-item{
			width:100%;
			height:400upx;
			image{
				width:100%;
				height:400upx;
			}
		}
	}
	.business-info-detail{
		padding:20upx;
		margin-bottom:20upx;
		background-color: #fff;
		.business-info-detail-name{
			font-weight: bold;
		}
	}
}
</style>
