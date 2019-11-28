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
		<view class="singlecar-list uni-row">
			<view class="uni-col">
				<view class="singlecar-list-price uni-h4">
					{{car_detail.newprice}}万
				</view>
				<view class="singlecar-list-name">
					{{car_detail.classid}}{{car_detail.classcid}}
				</view>
			</view>
			<view class="singlecar-list-rig uni-row">
				上线: <switch :checked="show_switch" @change="getSwitchChange" />
			</view>
		</view>
		<view class="uni-column singlecar-data">
			<view class="singlecar-data-title uni-h4">
				车辆档案
			</view>
			<view class="singlecar-data-content uni-row">
				<view class="singlecar-data-content-item">
					<view class="title">
						表显里程
					</view>
					<view class="text">
						{{car_detail.hadkm}}万公里
					</view>
				</view>
				<view class="singlecar-data-content-item">
					<view class="title">
						注册时间
					</view>
					<view class="text">
						{{car_detail.regtime}}
					</view>
				</view>
				<view class="singlecar-data-content-item">
					<view class="title">
						车牌所在地
					</view>
					<view class="text">
						{{car_detail.place}}
					</view>
				</view>
				<view class="singlecar-data-content-item">
					<view class="title">
						结构
					</view>
					<view class="text">
						{{car_detail.structure}}
					</view>
				</view>
				<view class="singlecar-data-content-item">
					<view class="title">
						变速箱
					</view>
					<view class="text">
						{{car_detail.gearbox}}
					</view>
				</view>
				<view class="singlecar-data-content-item">
					<view class="title">
						排放量
					</view>
					<view class="text">
						{{car_detail.fuelcsption}}
					</view>
				</view>
				<view class="singlecar-data-content-item">
					<view class="title">
						过户次数
					</view>
					<view class="text">
						{{car_detail.times}}
					</view>
				</view>
				<view class="singlecar-data-content-item">
					<view class="title">
						年检到期
					</view>
					<view class="text">
						2020.4
					</view>
				</view>
				<view class="singlecar-data-content-item">
					<view class="title">
						商业险到期
					</view>
					<view class="text">
						2019.7
					</view>
				</view>
			</view>
			<view class="singlecar-data-more" @click="goCarMoreData">
				查看全部参数数据 >
			</view>
		</view>
		<view class="singlecar-swipers">
			<page-swiper></page-swiper>
		</view>
		<view class="singlecar-btns">
			<view class="singlecar-btns-ts publish" @click="publishMyCar">
				编辑
			</view>
			<!-- <view class="singlecar-btns-ts" @click="showCover">
				申诉
			</view> -->
		</view>
		
		<view class="cover">
			<view class="cover-content">
				
			</view>
		</view>
	</view>
</template>

<script>
	export default {
		data() {
			return {
				show_cover:false,
				car_detail:'',
				carid:'',
				roleid:'',
				saleinfo:{
				},
				show_switch:false,
			};
		},
		onLoad(options) {
			// console.log(options);
			// this.carid = options.carid;
			//this.getCarInfo();
			//this.getCarDetailInfo(options.carid);
			//this.getUserRole();
		},
		onShow() {
			this.getCarInfo();
		},
		methods:{
			getCarInfo() {
				const userid = this.$store.state.user_info.userid;
				const data = {userid:userid};
				const _this = this;
				this.$api('index/get_vip_car','POST', data)
				.then(res=>{
					console.log(res);
					if(res.data.length>0){
						_this.car_detail = res.data[0];
						_this.show_switch = res.data[0].status == 0? false:true;
					}else{
						uni.showModal({
							title:'系统提示',
							content:'去上传你的二手车',
							success:res=>{
								if(res.confirm) {
									uni.navigateTo({
										url:'../../../openshop/uploadcar/uploadcar?type=upload'
									})
								}else {
									uni.navigateBack({
										delta: 1,
									})
								}
							},
							fail:err=>{
								console.log(err)
							}
						})
					}
				}).catch(err=>{
					console.log(err);
				})
			},
			publishMyCar(){
				const _this =this;
				uni.showModal({
					title:'系统提示',
					content:'重新编辑车辆信息下线车辆',
					success:res =>{
						if(res.confirm){
							_this.$store.state.use_info = _this.car_detail;
							const userid = _this.$store.state.user_info.userid;
							const carid = _this.car_detail.id;
							const data = {userid:userid,id:carid};
							this.$api('index/person_off_line','POST', data)
							.then(res=>{
								console.log(res);
								uni.navigateTo({
									url:'../../../openshop/uploadcar/uploadcar?type=edit'
								})
							}).catch(err=>{
								console.log(err);
							})
							
						}
					},
					fail:err =>{
						throw new Error(err);
					}
				})
			},
			async getSwitchChange(e){
				const val = e.detail.value;
				console.log(val);
				if (val){
					const res = await this.onlineCar();
					console.log(res);
					if(res.data.errcode == 0){
						uni.showToast({
							title: res.data.errstr,
						})
					}
				}else{
					const res = await this.offlineCar();
					console.log(res);
					if(res.data.errcode == 0){
						uni.showToast({
							title: res.data.errstr,
						})
					}
				}
			},
			goCarMoreData(){
				console.log(this.car_detail.id);
				uni.navigateTo({
					url:`../../../secondhandcar/singlecar/singlecar?carid=${this.car_detail.id}`,
				})
			},
			getCellPhone(){
			   uni.makePhoneCall({
			   	phoneNumber:this.$store.state.user_info.telephone,
			   })	
			},
			checkboxChange(e){
				console.log(e);
			},
			bindTextAreaBlur(e){
				console.log(e);
				this.content = e.detail.value;
			},
			cancelButton(){
				this.show_cover=false;
			},
			confirmButton(){
				this.getSecondCarShop();
			},
			showCover(){
				this.show_cover=true;
			},
			
			//-----车辆上线
			offlineCar(){
				this.$store.state.use_info = this.car_detail;
				const userid = this.$store.state.user_info.userid;
				const carid = this.car_detail.id;
				const data = {userid:userid,id:carid};
				return this.$api('index/person_off_line','POST', data)
			},
			//-----车辆下线
			onlineCar() {
			    this.$store.state.use_info = this.car_detail;
				const userid = this.$store.state.user_info.userid;
				const carid = this.car_detail.id;
				const data = {userid:userid,id:carid};
				return this.$api('index/person_on_line','POST', data)
			}
		}
	}
</script>

<style lang="scss" scoped>
  .singlecar{
	  .singlecar-swiper{
		  width:100%;
		  height:400upx;
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
		background-color: #fff;
		padding:0 20upx 20upx 20upx;
		justify-content: space-between;
		align-items: center;
		.singlecar-list-price{
			color:red;
			font-size: 40upx;
		}
		.singlecar-list-name{
			font-size: 34upx;
			color:#707070;
		}
	  }
	  .singlecar-data{
		  margin-top:20upx;
		  background-color: #fff;
		  padding:0 20upx;
		  .singlecar-data-content{
			  flex-wrap: wrap;
			  justify-content: space-around;
			  .singlecar-data-content-item{
				  width:30%;
				  margin-bottom:20upx;
				  .title{
					  font-size: 28upx;
					  color:#999999;
				  }
				  .text{
					  font-size: 32upx;
					  color:#000;
					  font-weight: 500;
				  }
			  }
		  }
		  .singlecar-data-more{
			  width:100%;
			  height:80upx;
			  font-size:34upx;
			  line-height: 80upx;
			  text-align: center;
			  border-top:1upx solid #bdbdbd;
		  }
	  }
  }
  .singlecar-swipers{
	  width:100%;
	  // position: fixed;
	  // left:0;
	  // bottom:0;
	  margin-top:200upx;
  }
  .singlecar-btns{
	  position: fixed;
	  right:10upx;
	  top:50%;
	  .singlecar-btns-ts{
		  width:108upx;
		  height:108upx;
		  line-height: 108upx;
		  border-radius: 50%;
		  border:1upx solid #bdbdbd;
		  text-align: center;
		  font-weight: bold;
		  background:#bdbdbd;
		  opacity: 0.6;
		  color:#fff;
	  }
	  .publish{
		  font-size: 22upx;
		  background:red;
		  margin-bottom:14px;
	  }
	  .singlecar-btns-ct{
	  		  width:108upx;
	  		  height:108upx;
	  		  line-height: 108upx;
	  		  border-radius: 50%;
			  margin-top:20upx;
	  		  border:1upx solid #bdbdbd;
	  		  text-align: center;
	  		  font-weight: bold;
	  		  background:green;
	  		  opacity: 0.6;
	  		  color:#fff;
	  }
  }
  .ts{
	  width:100%;
	  height:100%;
	  position: fixed;
	  left:0;
	  top:0;
	  background:rgba($color: #000000, $alpha: .6);
	  .ts-cover{
		  width:90%;
		  position: fixed;
		  left:50%;
		  top:50%;
		  transform: translateX(-50%) translateY(-50%);
		  background: #fff;
		  border-radius: 14upx;
		  padding:0 20upx;
		  .ts-cover-title{
			  height:80upx;
			  line-height: 80upx;
			  text-align: center;
		  }
		  .ts-cover-checkbox{
			  height:140upx;
			  checkbox-group{
				  display: flex;
				  flex-direction: row;
				  flex-wrap: wrap;
				  justify-content: space-around;
				  label{
					  width:23%;
					  margin-bottom:14upx;
				  }
			  }
			  
		  }
		  .ts-cover-textarea{
			  height:200upx;
			  border:1upx solid #bdbdbd;
			  border-radius: 12upx;
			  textarea{
				  height:200upx;
				  width:100%;
			  }
		  }
		  .ts-cover-btn{
			  height:80upx;
			  padding:20upx 0;
			  justify-content: space-between;
			  .btns{
				  width:160upx;
				  height:80upx;
				  line-height: 80upx;
				  color:#fff;
				  text-align: center;
				  border-radius: 14upx;
			  }
			  .btns-cancel{
				  background:#bdbdbd;
			  }
			  .btns-confirm{
				  background:green;
			  }
		  }
	  }
  }
</style>
