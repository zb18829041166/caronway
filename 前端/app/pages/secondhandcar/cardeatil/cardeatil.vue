<template>
	<view class="singlecar">
		<swiper class="singlecar-swiper" :indicator-dots="false" :autoplay="true" :interval="3000" :duration="1000">
			<swiper-item @click="previewImage(car_detail.frontpic)">
				<image :src="car_detail.frontpic" class="swiper-item" ></image>
				<view class="singlecar-swiper-text">
					正面图
				</view>
			</swiper-item>
			<swiper-item @click="previewImage(car_detail.rightside)">
				<image :src="car_detail.rightside" class="swiper-item" ></image>
				<view class="singlecar-swiper-text">
					右侧图
				</view>
			</swiper-item>
			<swiper-item @click="previewImage(car_detail.leftside)">
				<image :src="car_detail.leftside" class="swiper-item" ></image>
				<view class="singlecar-swiper-text">
					左侧图
				</view>
			</swiper-item>
			<swiper-item @click="previewImage(car_detail.rearview)">
				<image :src="car_detail.rearview" class="swiper-item" ></image>
				<view class="singlecar-swiper-text">
					尾部图
				</view>
			</swiper-item>
			<swiper-item @click="previewImage(car_detail.frontcover)">
				<image :src="car_detail.frontcover" class="swiper-item" ></image>
				<view class="singlecar-swiper-text">
					车前盖图
				</view>
			</swiper-item>
			<swiper-item @click="previewImage(car_detail.interior1)">
				<image :src="car_detail.interior1" class="swiper-item" ></image>
				<view class="singlecar-swiper-text">
					内饰图1
				</view>
			</swiper-item>
			<swiper-item @click="previewImage(car_detail.interior2)">
				<image :src="car_detail.interior2" class="swiper-item" ></image>
				<view class="singlecar-swiper-text">
					内饰图2
				</view>
			</swiper-item>
			<swiper-item @click="previewImage(car_detail.interior3)">
				<image :src="car_detail.interior3" class="swiper-item" ></image>
				<view class="singlecar-swiper-text">
					内饰图3
				</view>
			</swiper-item>	
		</swiper>
		<view class="uni-column singlecar-list">
			<view class="singlecar-list-price uni-h4">
				{{car_detail.newprice}}万
			</view>
			<view class="singlecar-list-name">
				{{car_detail.classid}}{{car_detail.classcid}}
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
						注册时间
					</view>
					<view class="text">
						{{car_detail.timemarket}}
					</view>
				</view>
				<view class="singlecar-data-content-item">
					<view class="title">
						强险到期
					</view>
					<view class="text">
						{{car_detail.regtime}}
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
			<!-- <view class="singlecar-btns-ts publish" @click="publishMyCar">
				发布新车
			</view> -->
			<view class="singlecar-btns-ts" @click="showCover">
				投诉Ta
			</view>
			<view class="singlecar-btns-ct" @click="getCellPhone">
				联系Ta
			</view>
		</view>
		
		<view class="ts" v-show="show_cover">
			<view class="ts-cover uni-column">
				<view class="ts-cover-title uni-h4">
					投诉处理
				</view>
				<!-- <view class="ts-cover-checkbox">
					<checkbox-group @change="checkboxChange">
						<label class="" v-for="item in items" :key="item.value">
							<checkbox :value="item.name" :checked="item.checked" /><text>{{item.name}}</text>
						</label>
					</checkbox-group>
                </view> -->
				<view class="ts-cover-textarea">
					<textarea value="" placeholder="请输入投诉原因" @blur="bindTextAreaBlur" @input="getAreaInput"/>
				</view>
				<view class="ts-cover-btn uni-row">
					<view class="btns btns-cancel" @click.stop="cancelButton">
						取消
					</view>
					<view class="btns btns-confirm" @click.stop="confirmButton">
						确认
					</view>
				</view>
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
					'车商名称':'更脑二手车行',
					'联系电话':'13888888888',
					'城市':'武汉市',
					'地址':'天峨县更脑屯更旦街13号',
					'经度':'东经132.32465',
					'纬度':'北纬23.45688',
					'上线时间':'2019-04-25',
					'状态':'上线',
				},
			};
		},
		onLoad(options) {
			console.log(options);
			this.carid = options.carid;
			this.getCarDetailInfo(options.carid);
			this.getUserRole();
		},
		methods:{
			getCarDetailInfo(carid){
				const _this =this;
				const data={carid};
				this.$api('index/get_car_detailinfo','POST', data)
				.then(res=>{
					console.log(res)
					if(res.data){
						_this.car_detail = res.data[0]?res.data[0]:'';
					}
				}).catch(err=>{
					console.log(err);
				})
			},
			getAreaInput(e){
				const val = e.detail.value;
				console.log(val);
				console.log(val.length);
			},
			goCarMoreData(){
				console.log(this.carid);
				uni.navigateTo({
					url:`../singlecar/singlecar?carid=${this.carid}`
				})
			},
			getCellPhone(){
				const _this =this;
				const data={userid:this.car_detail.userid};
				this.$api('index/get_user_infos','POST', data)
				.then(res=>{
					console.log(res)
					if(res.data){
						const telephone = res.data.telephone;
						console.log('tel',telephone);
						uni.makePhoneCall({
							phoneNumber:telephone
						})
					}else{
						uni.showToast({
							title:'拨打失败'
						})
					}
				}).catch(err=>{
					console.log(err);
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
			publishMyCar(){
				const userid = this.$store.state.user_info.userid;
				const data = {userid:userid};
				const _this = this;
				console.log(this.roleid)
				if(this.roleid=='8'){
					uni.showModal({
						title:'系统提示',
						content:'您还不是会员，需注册会员',
						success:res=>{
							if(res.confirm){
								uni.navigateTo({
									url:'../../register/register'
								})
							}
						},
						fail:err=>{
							throw new Error(err);
						}
					})
				}else if(this.roleid == '7'){
					uni.showToast({
						title:'您是专员不能上传'
					})
				}else if(this.roleid == '6'){
					uni.navigateTo({
						url:'../../openshop/uploadcar/uploadcar?type=upload'
					})
				}else if(this.roleid == '5'){
					this.$api('index/get_vip_car','POST', data)
					.then(res=>{
						if(res.data && res.data.length>0){
							uni.showModal({
								title:'系统提示',
								content:'普通会员只能上传一辆二手车'
							})
						}else{
							uni.navigateTo({
								url:'../../openshop/uploadcar/uploadcar?type=upload'
							})
						}
					}).catch(err=>{
						console.log(err);
					})
				}
			},
			//-----------预览图片-----------
			previewImage(url){
			   uni.previewImage({
			   	current:url,
				urls:[url,]
			   })	
			},
			//-----------获取用户身份------
			getUserRole(){
				const data = {openid:this.$store.state.openid};
				const _this = this;
				this.$api('index/get_user_info','POST', data)
				.then(res=>{
					// console.log(res);
					if(res.data){
						const data = res.data;
						_this.roleid = res.data.roleid;
					}else{
						_this.roleid = 8;
					}
				}).catch(err=>{
					console.log(err);
				})
			},
			//------check person car------
			getCarInfo() {
				const userid = this.$store.state.user_info.userid;
				const data = {userid:userid};
				const _this = this;
				this.$api('index/get_vip_car','POST', data)
				.then(res=>{
					if(res.data.length>0){
						
					}else{
					}
				}).catch(err=>{
					console.log(err);
				})
			},
			//-----------投诉--------
			getSecondCarShop(){
				const _this = this;
				const uid = this.$store.state.openid?this.$store.state.openi:'12';
				const userid = this.car_detail.userid;
				const carid = this.car_detail.carid;
				const content = this.content;
				const data = {
					uid,
					carid,
					userid,
					content,
				};
				this.$api('index/get_feedback_info','POST', data)
				.then(res=>{
					console.log(res);
					if(res.data.errcode==0){
						uni.showToast({
							title:'投诉成功',
							icon:'success'
						})
						setTimeout(()=>{
							_this.show_cover=false;
						},1000)
					}
				}).catch(err=>{
					console.log(err);
				})
			},
			//--------查看基础展位--------
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
