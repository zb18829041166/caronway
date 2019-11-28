<template name="uni-process">
	<view class="uni-process">
		<view class="dateContent">
			<view class="line"></view>
			<view  v-for="(item,key) in base_info.list" :class="{'item':true, 'item-checked': key<=base_info.node, 'item-close': !item.isActive}" :key="key" @click="getSelectNode(key)">
				<view class="circle"></view>
				<view class="week">{{item.name}}</view>
			</view>
		</view>
		<view class="identity-telphone uni-column" v-if="base_info.node==0">
			<view class="registercontent">
				<view class="has-mglr-10 ">
					<view class=" has-mgtb-10 ">
						<input type="number" maxlength="11" placeholder="请输入手机号" class="is-input1" v-model="telephone"/>
					</view>
					<view class=" has-mgtb-10 ">
						<input type="number" maxlength="6" placeholder="短信验证码" class="is-input1" v-model="code"/>
						<view class="codeimg" :class="smsbtn.status?'':'disBtn'"  @tap="getsmscode">{{smsbtn.text}}</view>
					</view>
					<view class=" registerbtn has-radius has-mgtb-20" @click="judgeUserCode">
						<button>确认绑定</button>
					</view>
				</view>
			</view>
			<view class="is-20vh has-mgt-80">
				<navigator url="#" class=" has-radius is-center is-grey " hover-class="">
					<text>请仔细填写热线,</text><text class="is-red">以免对您造成不必要的损失</text>
				</navigator>
			</view>
		</view>
		
		<view class="identity-user" v-else-if="base_info.node==1">
			<view class="identity-user-info uni-column">
				<view class="identity-user-info-conetnt uni-row">
					<input class="identity-user-info-conetnt-input" type="text" value="" placeholder="店名" required v-model="shop_info.realname"/>
				</view>
				<view class="identity-user-info-conetnt uni-row" @click="scanCode">
					<input class="identity-user-info-conetnt-input" disabled="true" type="text" value="" placeholder="请扫描营业执照获取社会信用码" required v-model="shop_info.liccode"/>
				</view>
				<view class="identity-user-info-conetnt uni-row" @click="getUserLocation">
					<input class="identity-user-info-conetnt-input" disable="true" type="text" value="" placeholder="详细地址" required v-model="shop_info.address"/>
				</view>
			</view>
			<view class=" registerbtn has-radius has-mgtb-20" @click="goShopInfo">
				<button>下一步</button>
			</view>
		</view>
		<view class="identity-user identity-shop" v-else-if="base_info.node==2">
			<view class="identity-user-info uni-column">
			</view>
			<view class="identity-user-img uni-row">
				<view class="identity-user-img-container">
					<image :src="shop_info.outimg" alt="" mode=""></image>
					<view class="identity-user-img-container-cover uni-h4" @click.stop="uploadImage('outimg')">
						店铺正面图
					</view>
				</view>
				<view class="identity-user-img-container">
					<image :src="shop_info.innimg" alt="" mode=""></image>
					<view class="identity-user-img-container-cover uni-h4" @click.stop="uploadImage('innimg')">
						店铺内景图
					</view>
				</view>
			</view>
			<view class="identity-user-img uni-row">
				<view class="identity-user-img-container-yy">
					<image :src="shop_info.licimg" alt="" mode=""></image>
					<view class="identity-user-img-container-cover uni-h4" @click.stop="uploadImage('licimg')">
						营业执照
					</view>
				</view>
			</view>
			<view class="identity-user-img uni-row">
				<view class="identity-user-img-container-icon">
					<image :src="shop_info.logoori?shop_info.logoori:shop_info.outimg" mode=""></image>
					<view class="identity-user-img-container-cover uni-h4" @click.stop="uploadImage('logoori')">
						店铺logo
					</view>
				</view>
			</view>
			<view class=" registerbtn has-radius has-mgtb-20" @click="beSureApply">
				<button>确认申请</button>
			</view>
			<canvas canvas-id="fillimg" style="width:300px;height:300px;visibility: hidden;"></canvas>
			
			<view class="is-20vh has-mgt-80">
				<navigator url="#" class=" has-radius is-center is-grey " hover-class="">
					<text>确认申请即表示同意</text><text class="is-blue">《用户协议》</text>
				</navigator>
			</view>
		</view>
		<view class="identity-system" v-else>
			<view class="identity-system-time uni-column">
				<scroll-view class="identity-system-scroll" scroll-x="true">
					<block v-for="(item,index) in priceList" :key="index">
						<view class="identity-system-time-content uni-column" :class="sid==index?'isSelect':''" @click="selectPrice(index)">
							<view class="identity-system-time-content-1">
								{{item.seasons}}个季度
							</view>
							<view class="identity-system-time-content-2">
								￥<text class="identity-system-time-content-2-text">{{item.price}}</text>
							</view>
							<view class="identity-system-time-content-3">
								{{parseInt(item.price/3)}}元/月
							</view>
							<text class="identity-system-time-content-4">
								{{item.discount}}折
							</text>
						</view>
					</block>
				</scroll-view>
			</view>
			<view class="identity-system-count uni-column">
				<view class="identity-system-count-btn" @click="userPayment">
					立即支付
				</view>
			</view>
		</view>
		
		<view class="cover" v-if="show_flag">
			<view class="cover-content uni-column">
			   <block v-for="(item,index) in shop_type" :key="index">
					<view class="cover-content-list" @click="getOpenShopType(index)">
						{{item}}
					</view>
				</block>
			</view>
		</view>
	</view>
</template>
<script>
  // #ifdef H5
  const jweixin = require('../common/jweixin.js');
   // #endif
  export default {
    props: {
      types: {
        type: String,
        default: ''
      },
	  priceList:{
		  type:Array,
		  default: () => []
	  },
	  show_flag:{
		  type:Boolean,
		  default:false,
	  }
    },
    computed: {
    },
    data() {
      return {
		 telephone:'',
		 telephone1:'',
		 car_num:0,
		 discount_num:0,
		 shop_type:['新车店','二手车店','零售店'],
		 select_num:0,
		 selectPri:'',
		 sid:0,
		 smsbtn: {
		 	text: '获取验证码',
		 	status: true,
		 	codeTime: 60,
		 },
		 code:'',
		 shop_info:{
		 	telephone:'',	
		 	realname:'',	
		 	longitude:'23.34556',	
		 	latitude:'112.34213',
		    address:'请选择地址',
		 	licimg:'',	
		 	innimg:'',
		 	outimg:'',	
		 	logoori:'',	
		 	liccode:'',	
		 	userid:this.$store.state.user_info.userid,
			paytime:''
		 },
		 img:{
			licimg:'',	
			innimg:'',
			outimg:'',	
			logoori:'',	
		 },	
         base_info:{
			 node:0,
			 list:[
				 {
					 name:'手机绑定',
					 isActive:true,
				 },
				 {
					 name:'商铺信息',
					 isActive:false,
				 },
				 {
					 name:'上传图片',
					 isActive:false,
				 },
				 {
					 name:'系统审核',
					 isActive:false,
				 },
			 ]
		 }
      }
    },
	onLoad() {
		
	},
	created(){
		if(this.types == 'update') {
			console.log('newshop');
			this.getNowShopInfo();
		}else{
			// this.judgeUserOpenShop();
		}
		this.getPriceList();
		// #ifdef H5
		this.setWxConfig();
		// #endif
	},
    methods: {
      getSelectInfo(i,k){
		  this.base_info.list[k].isActive=true;
		  this.base_info.node = k;
	  },
	  getSelectNode(id) {
		  const node = this.base_info.node;
		if(this.base_info.list[id].isActive) {
			this.getSelectInfo(this.base_info.list[node],id);
		}  
	  },
	  getNowShopInfo(){
		  const data = {userid:this.$store.state.user_info.userid};
		  const _this = this;
		  this.covers = [];
		  const result = {
		  	iconPath: '/static/location.png'
		  }
		  this.$api('index/get_shop_detail','POST', data)
		  .then(res=>{
		  	console.log(res)
		  	if(res.data ){
		  		_this.shop_info = res.data;
		  	}
		  }).catch(err=>{
		  	console.log(err);
		  })
	  },
	  getsmscode() {
	  	const rgx= /^1[345789]\d{9}$/;
	  	const data ={telephone:this.telephone};
	  	const _this = this;
	  	if(!rgx.test(this.telephone)){
	  		wx.showToast({
	  			title:'号码有误',
	  			icon:'none',
	  		})
	  	}else{
	  		this.$api('upload/get_telephone_code','POST',data)
	  		.then(res=>{
	  			if(res.data && res.data.resultCode == 1000) {
	  				uni.showToast({
	  					title:'验证码发送成功',
	  					icon:'none'
	  				})
	  			}else{
	  				uni.showToast({
	  					title:'验证码发送失败',
	  					icon:'none'
	  				})
	  			}
	  		 })
	  		.catch(err=>{
	  			console.log(err)
	  		}); 
	  		this.timerId = setInterval(() => {
	  				var codeTime = this.smsbtn.codeTime;
	  				codeTime--;
	  				this.smsbtn.codeTime = codeTime;
	  				this.smsbtn.text = codeTime + "S";
	  				this.smsbtn.status=false;
	  				if (codeTime < 1) {
	  					clearInterval(this.timerId);
	  					this.smsbtn.text = "重新获取";
	  					this.smsbtn.codeTime = 60;
	  					this.smsbtn.status = true;
	  				}
	  			},
	  			1000);
	  	}
	  },
	  setWxConfig(){
	  	const _this = this;
	  	const data = {};
	  	this.$api('upload/get_use_signature','GET',data)
	  	.then(res=>{
	  		console.log(res);
	  		jweixin.config({
	  			debug: false, // 开启调试模式,调用的所有api的返回值会在客户端alert出来，若要查看传入的参数，可以在pc端打开，参数信息会通过log打出，仅在pc端时才会打印。
	  			appId: 'wx8f25aab4660823a5', // 必填，公众号的唯一标识
	  			timestamp:res.data.timestamp , // 必填，生成签名的时间戳
	  			nonceStr: res.data.nonceStr, // 必填，生成签名的随机串
	  			signature:res.data.signature,// 必填，签名
	  			jsApiList: ['chooseWXPay','chooseImage','uploadImage','getLocalImgData','scanQRCode'] // 必填，需要使用的JS接口列表
	  		})
			jweixin.ready(()=>{
				console.log('验证成功');
			})
	  	})
	  	.catch(err=>{console.log(err)});
	  },
	  // --------扫码获取营业执照信息
	  scanCode() {
		  const _this = this;
		  jweixin.scanQRCode({
			  needResult:1,
			  scanType: ["qrCode","barCode"],
			  success:res => {
					console.log(res)
					alert(JSON.stringify(res));
					var result = res.resultStr;
					alert('res:'+result);
					const data = result.split('\n');
					for(const i in data) {
						const res = data[i].split(':');
						if(res[0] == '企业信用代码') {
							this.shop_info.liccode = res[1];
						}
					}
			   },
			  fail: err =>{
				console.log(err);	
			  }
		  });
	  },
	  //------用户支付-------
	  userPayment(){
		  const _this = this;
		  const openid = this.$store.state.openid;
		  const money = this.selectPri.price;
		  const data={openid:openid,money:money};
		  this.$api('users/payment','POST',data)
		  .then(res=>{
			   const pay = res.data.data;
			   console.log(pay);
			   jweixin.chooseWXPay({
					timestamp: pay.timeStamp, // 支付签名时间戳，注意微信jssdk中的所有使用timestamp字段均为小写。但最新版的支付后台生成签名使用的timeStamp字段名需大写其中的S字符
					nonceStr: pay.nonceStr, // 支付签名随机串，不长于 32 位
					package: pay.package, // 统一支付接口返回的prepay_id参数值，提交格式如：prepay_id=\*\*\*）
					signType: pay.signType, // 签名方式，默认为'SHA1'，使用新版支付需传入'MD5'
					paySign: pay.paySign, // 支付签名
					success: function (res) {
					   console.log(res);
					   if(res.errMsg == 'chooseWXPay:ok') {
						   const date = new Date();
						   const time = date.toISOString();
						   // _this.shop_info.paytime = time;
						   if(_this.types == 'upload') {
							   _this.uploadShopInfo(); 
						   }else {
							   _this.updateShopInfo();
						   }
						   
					   }else{
						   uni.showToast({
						   	 title:'支付失败',
							 icon:'none'
						   })
					   }
					},
					fail:err =>{
						console.log(err)
						wx.showModal({
							title:'支付错误',
							content:err
						})
					}
			  })
		  })
		  .catch(err=>{
		  })
	  },
	  register(){
		const _this = this;
		const rgx= /^1[345789]\d{9}$/;
		if(rgx.test(this.telephone) && rgx.test(this.telephone1)){
			if(this.telephone == this.telephone1){
				this.shop_info.telephone = this.telephone;
				this.getSelectInfo(this.base_info.list[1],1);
			}else {
				wx.showToast({
					title:'两次输入号码不一致',
					icon:'none',
				})
			}
		}else {
			wx.showToast({
				title:'号码有误',
				icon:'none',
			})
		}	
	  },
	  //-------验证用户验证码-----
	  judgeUserCode(){
		const rgx= /^1[345789]\d{9}$/;
	  	const data = {telphone:this.telephone};
	  	const _this = this;
		if(rgx.test(this.telephone)){
		    this.$api('index/get_telephone_code','POST',data)
			.then(res=>{
				const code = res.data[0].code;
				if(code == _this.code) {
					_this.shop_info.telephone = _this.telephone;
					_this.getSelectInfo(this.base_info.list[1],1);
				}else{
					uni.showToast({
						title:'验证码错误'
					})
				}
			 })
			.catch(err=>{
				console.log(err)
			}); 
		}else{
			uni.showToast({
				title:'号码有误'
			})
		}
	  },
	  goShopInfo(){
		  console.log(this.shop_info);
		  if(this.shop_info.realname && this.shop_info.address && this.shop_info.liccode){
			  this.getSelectInfo(this.base_info.list[2],2)
		  }else {
			  uni.showToast({
			  	title:'请填写完整'
			  })
		  }
	  },
	  selectPrice(id){
		 this.sid = id;
		 this.selectPri = this.priceList[id];
	  },
	  getOpenShopType(id) {
		  const title = this.shop_type[id];
		 this.$emit('getOpenShopType',title);
	  },
	  beSureApply(){
		  const _this =this;
		  for (var i in this.shop_info) {
			  if(!this.shop_info[i]){
				  if(i == 'licimg'){
					 return uni.showToast({
						title:'请上传营业执照'
					}) 
				  }else if( i == 'innimg') {
					   return uni.showToast({
					  	title:'请上传内景图'
					  }) 
				  }else if(i == 'outimg') {
					   return uni.showToast({
					  	title:'请上传外景图'
					  }) 
				  }else if(i == 'logoori'){
					   return uni.showToast({
					  	title:'请上传店铺图标'
					  }) 
				  }
			  }
		  }
		  this.getSelectInfo(this.base_info.list[3],3);
		  // this.uploadShopInfo();
	  },
	  //获取微信服务器图片并下载到个人服务区器
	  getWxServerImg() {
		  const _this =this;
		  const data ={shop: JSON.stringify(this.shop_info)};
		  this.$api('upload/get_wx_img','POST',data).then(res=>{
			  console.log(res.data);
			  uni.showModal({
			  	title: res.data.data.outimg,
			  	content: '获取图片成功',
			  	
			  });
			  _this.shop_info =  res.data.data;
			  _this.uploadShopInfo();
		  }).catch(err=>{
			  console.log(获取失败)
			  uni.showToast({
			  	title:'获取失败'
			  })
		  })
	  },
	  // ----------上传店铺信息 ----------
	  async uploadShopInfo() {
		  const _this =this;
		  const data = this.shop_info;
		  this.$api('index/apply_open_shop','POST', data)
		  .then(res=>{
			if(res.data.code == 0){
				uni.showToast({
					title:res.data.message,
					icon:'none',
					success: res => {
						setTimeout(() => {
							uni.navigateTo({
								url:"../pages/application/shop/index/index"
							})
						},300)
					}
				})
			}else{
				uni.showToast({
					title:res.data.message,
					icon:'none',
				})
			}
		  }).catch(err=>{
		  	console.log(err);
		  })   
	  },
	  //---------修改店铺信息-----
	  async updateShopInfo() {
		  const _this =this;
		  const data = this.shop_info;
		  this.shop_info.shopid = this.shop_info.id;
		  this.$api('index/update_shop_info','POST', data)
		  .then(res=>{
			if(res.data.code == 0){
				uni.showToast({
					title:res.data.message,
					icon:'none',
					success: res => {
						setTimeout(() => {
							uni.navigateTo({
								url:"../pages/application/shop/index/index"
							})
						},300)
					}
				})
			}else{
				uni.showToast({
					title:res.data.message,
					icon:'none',
					success: res => {
						setTimeout(() => {
							uni.navigateBack({
								delta:1,
							})
						},300)
					}
				})
			}
		  }).catch(err=>{
			console.log(err);
		  })   
	  },
	  getUserLocation(){
		  uni.chooseLocation({
		  	success:res=> {
		  		console.log(res);
				this.shop_info.address = res.address;
				this.shop_info.latitude = res.latitude;
				this.shop_info.longitude = res.longitude;
		  	},
			fail:err=>{
				console.log('please check your network!');
			}
		  })
	  },
	  uploadImages(type){
		const _this = this;
        const openid = this.$store.state.openid;
		const data={openid:openid};
	     jweixin.chooseImage({
	  		count: 1, // 默认9
	  		sizeType: ['compressed'], // 可以指定是原图还是压缩图，默认二者都有
	  		sourceType: ['album', 'camera'], // 可以指定来源是相册还是相机，默认二者都有
	  		success: res=> {
				console.log(res);
	  	      	var localIds = res.localIds[0]; // 返回选定照片的本地ID列表，localId可以作为img标签的src属性显示图片
				uni.showToast({
					title:localIds
				})
				jweixin.getLocalImgData({
					localId: localIds, // 图片的localID
					success: function (res) {
					var localData = res.localData; // localData是图片的base64数据，可以用img标签显示
					if(localData.indexOf('data:image/')){
						localData = localData.replace('jgp', 'jpeg');
					}else {
						localData = 'data:image/jpeg;base64,' + localData;
					}
					_this.img[type] = localData;
					jweixin.uploadImage({
					   localId: localIds, // 需要上传的图片的本地ID，由chooseImage接口获得
	    			   isShowProgressTips: 1, // 默认为1，显示进度提示
					   success: function (res) {
					       var serverId = res.serverId; // 返回图片的服务器端ID
						  _this.shop_info[type].mid = serverId;
						 }
					})
					}
				});
	  		 },
			 fail:err=>{
				 console.log(err);
			 }
	  	});
	  },
	  bindCarChange(e){
		  console.log(e)
		  this.car_num = e.target.value;
		  console.log(this.car_num);
	  },
	  bindDiscountChange(e){
		   console.log(e)
		  this.discount_num = e.target.value;
		  console.log(this.car_num);
	  },
	  getPriceList(){
	      const _this =this;
	      const data = {};
	      this.$api('index/find_charge_list','POST', data)
	      .then(res=>{
	  	   console.log(res);
	      }).catch(err=>{
	  	  console.log(err);
	      })   
	  },
	  uploadImage(type){
	  	const that = this;
	  		console.log(type);
	  	uni.chooseImage({
	  		count: 1,
	  		sizeType: ['compressed'],
	  		success: res=> {
	  			const img_path = res.tempFilePaths[0];
				//that.shop_info[type] = img_path;
				that.getImageInfo(img_path,type);
	          },
	  	})
	  },
	getImageInfo(path,type){
	  const that = this;
	  uni.showLoading({
	  	title:'图片上传中'
	  })
	  uni.getImageInfo({
			src: path,  
			success: function(res){
			// 利用canvas压缩图片
			that.imgurl= res.path;
			var ratio = 2;
			var canvasWidth = res.width //获取图片原始长宽
			var canvasHeight = res.height
			while (canvasWidth > 300 || canvasHeight > 300){// 保证宽高在400以内
				canvasWidth = Math.trunc(res.width / ratio)
				canvasHeight = Math.trunc(res.height / ratio)
				ratio++;
			}
			var ctx = wx.createCanvasContext('fillimg');
			ctx.drawImage(res.path, 0, 0,canvasWidth,canvasHeight);
		   ctx.draw(false, setTimeout(function(){
				 uni.canvasToTempFilePath({
					 canvasId: 'fillimg',
					 quality:1,
					 destWidth: canvasWidth,
					 destHeight: canvasHeight,
					 success: function (resp) {
						 console.log('res',resp.tempFilePath)//最终图片路径
							 uni.uploadFile({
								url: 'http://www.caronway.cn/v1/upload/addimg', //仅为示例，非真实的接口地址
								//url:'http://localhost:8084/upload/addimg',
								filePath: resp.tempFilePath,
								name: 'file',
								formData: {
									'userid': that.$store.state.user_info.userid,
								},
								success: (res) => {
									const data = JSON.parse(res.data)	
									console.log(data)
									 if(data.status ==4){
										 if(type === 'outimg') {	
											 that.shop_info.logoori = data.data;
										 }
										 that.shop_info[type] = data.data;
									 }
									 uni.hideLoading();
								},
								fail:err=>{
									throw new Error(err);
								}
							 })
					 },
					 fail: function (res) {
						 console.log(res.errMsg)
					}
				},this)
			},3000))    //留一定的时间绘制canvas
		}
	  })
	  },
	  //判断用户是否开店
	  judgeUserOpenShop(){
		  const _this = this;
		  const data = {userid:this.$store.state.user_info.userid};
		   this.$api('index/judge_shop_open','POST', data)
		  .then(res=>{
		   console.log(res);
		   if(!res.data){
			   uni.showToast({
			   	 title:'您已经开店',
				 icon:'none',
				 success: res=>{
					 setTimeout(() =>{
						 uni.navigateTo({
						 	url:'../pages/application/index/index'
						 })
					 },500)
				 }
			   })
		   }
		  }).catch(err=>{
		  console.log(err);
		  })   
	  }
    },
  }
</script>

<style lang="scss">
  .uni-process{
	width:100%;
	height:80%;
	position: relative;
	padding:140upx 0 0 0;
   }
  .dateContent{
	  width:100%;
      background: $uni-bg-color;
      display: flex;
      flex-direction: row;
      padding: 18upx 0 4upx 0;
	  position: absolute;
	  left:0;
	  top:0;
      .item{
          z-index: 9;
          color: $uni-text-color-grey;
          flex: 1;
          text-align: center;
          padding-bottom: 12upx;
          &-checked{
              color: #3FC0A2;
              font-weight: bolder;
              .circle{
                  background-color: #3FC0A2!important;
              }
          }
          &-close{
              color: $uni-text-color-grey;
          }
          .week{
              margin-top: 4upx;
              font-size: $uni-font-size-base;
          }
          .circle{
              width: 18upx;
              height: 18upx;
              border-radius: 50%;
              border:1px solid #ebedf0;
              margin: 20upx auto ;
              background-color: $uni-bg-color;
          }
      }
      .line{
          position: absolute;
          top: 47upx;
          width: 94%;
          left: 3%;
          height: 4upx;
          background-color: #ebedf0;
      }
  }
  .registercontent {
  	width: 85%;
  	margin: 0 auto;
  }
  .is-input1 {
  	height: 88rpx;
  	width: 100%;
  	line-height: 88rpx;
  	padding:0 12rpx;
  	color: #353535;
  	font-size: 32rpx;
  	box-sizing: border-box;
  	appearance: none;
  	border: 2rpx solid #e5e5e5;
  	box-shadow: none;
  	border-radius: 44rpx;
  	outline: 0;
  	display: block;
  	padding-left: 30rpx;
  	margin: 0;
  	font-family: inherit;
  	background: #fff;
  	resize: none;
  }
  
  .iconfont {
  	position: absolute;
  	font-size: 40rpx;
  	right: 12%;
  	z-index: 999;
  	width: 105rpx;
  	text-align: center;
  	color: #353535;
  	margin-top: -11%;
  	background: #fff;
  	border-top-right-radius: 44rpx;
  	border-bottom-right-radius: 44rpx;
  	height: 80rpx;
  	line-height: 80rpx;
  }
  
  .codeimg {
  	position: absolute;
  	font-size: 28rpx;
  	right: 12%;
  	z-index: 999;
  	width: 200rpx;
  	text-align: center;
  	color: #353535;
  	margin-top: -11%;
  	background: #fff;
  	border-top-right-radius: 44rpx;
  	border-bottom-right-radius: 44rpx;
  	height: 80rpx;
  	line-height: 80rpx;
  }
  
  .registerbtn button {
  	margin-top: 20rpx;
  	height: 88rpx;
  	width: 100%;
  	line-height: 88rpx;
  	color: #ffffff;
  	font-size: 32rpx;
  	border-radius: 44rpx;
  	outline: 0;
  	display: block;
  	margin: 0;
  	font-family: inherit;
  	background: #f35;
  	opacity: 0.8;
  }
  
  button:after {
  	border: 2rpx solid #f2f2f2;
  }
  .disBtn{
  	pointer-events: none;
  }
  .identity-telphone{
	  // width:100%;
	  // position: absolute;
	  // left:0;
	  // top:50%;
	  // transform: translateY(-50%);
	  margin-top:300upx;
  }
  .identity-user{
	  padding:20upx;
	  .identity-user-info{
		  background:#fff;
		  margin-bottom:20upx;
		  padding:20upx;
		  border-radius: 14upx;
		  .identity-user-info-conetnt{
			  height:70upx;
			  line-height: 70upx;
			  border:1upx solid #bdbdbd;
			  border-radius: 35upx;
			  padding:0 20upx;
			  margin-bottom:20upx;
			  .identity-user-info-conetnt-input{
				  width:100%;
				  height:70upx !important;
				  line-height: 70upx;
			  }
		  }
	  }
	  .identity-user-img{
		  justify-content: space-around;
		  background:#fff;
		  padding:50upx 20upx;
		  border-radius: 14upx;
		  margin-bottom:20upx;
		 .identity-user-img-container{
			  width:287upx;
			  height:183upx;
			  border-radius: 12upx;
			  overflow: hidden;
			  position: relative;
			  image{
				  width:100%;
				  height:100%;
			  }
			  .identity-user-img-container-cover{
				 width:100%;
				 height:100%;
				  background: rgba($color: #bdbdbd, $alpha: .6);
				  position: absolute;
				  left:0;
				  top:0;
				  text-align: center;
				  line-height: 183upx;
			  }
		 } 
		 .identity-user-img-container-yy{
		 			  width:203upx;
		 			  height:287upx;
		 			  border-radius: 12upx;
		 			  overflow: hidden;
		 			  position: relative;
		 			  image{
		 				  width:100%;
		 				  height:100%;
		 			  }
		 			  .identity-user-img-container-cover{
		 				 width:100%;
		 				 height:100%;
		 				  background: rgba($color: #bdbdbd, $alpha: .6);
		 				  position: absolute;
		 				  left:0;
		 				  top:0;
		 				  text-align: center;
		 				  line-height: 287upx;
		 	}
		 } 
		 .identity-user-img-container-icon{
		 			  width:128upx;
		 			  height:128upx;
		 			  border-radius: 12upx;
		 			  overflow: hidden;
		 			  position: relative;
		 			  image{
		 				  width:100%;
		 				  height:100%;
		 			  }
		 			  .identity-user-img-container-cover{
		 				 width:100%;
		 				 height:100%;
		 				  background: rgba($color: #bdbdbd, $alpha: .6);
		 				  position: absolute;
		 				  left:0;
		 				  top:0;
		 				  text-align: center;
		 				  line-height: 128upx;
		 	}
		 } 
	  }
	  
  }
  .identity-user-info-conetnt{		
	  padding:0 20upx;
	  margin-bottom:20upx;
	  .identity-user-info-conetnt-input{
		  width:100%;
		  height:70upx !important;
		  line-height: 70upx;
	  }
  }
  .is-picker{
  	 border:1upx solid #bdbdbd;
  	 width:100%;
  	 height:100%;
  	 border-radius: 44upx;
  	 overflow: hidden;
	 background-color:#fff;
  }
  .identity-system-carnum{
	  margin-top:40upx;
	  
  }
  .identity-system-time{
	  padding:20upx;
	  margin-top:50upx;
  }
  .identity-system-scroll{
	  white-space: nowrap;
	  height:242upx;
	  width:100%;
  }
  
  .identity-system-time-content{
	  display: inline-block;
	  width:180upx;
	  height:240upx;
	  border:1upx solid #bdbdbd;
	  background:#fff;
	  margin-right:20upx;
	  border-radius: 12upx;
  }
  .identity-system-time-content{
	  text-align: center;
	  .identity-system-time-content-1{
		  margin-top:14upx;
	  }
	  .identity-system-time-content-2{
		  color:#f9c201;
		  .identity-system-time-content-2-text{
			  font-weight: bold;
			  font-size: 40upx;
		  }
	  }
	  .identity-system-time-content-3{
		  color:#999999;
	  }
	  .identity-system-time-content-4{
		  background-color:#f9c201;
		  color:#fff;
		  padding:2upx 20upx;
		  border-radius: 8upx;
	  }
  }
  .uni-list-cell-left{
	  font-weight: 500;
  }
  .identity-system-count{
	  padding:20upx;
	  .identity-system-count-btn{
		 height:90upx;
		 line-height: 90upx;
		 color:#fff;
		 font-size: 34upx;
		 text-align: center;
	  	 background-color:#13752f;
		 border-radius: 45upx;
	  }
  }
  .isSelect{
	  border:1upx solid #f9c201;
  }
  .cover{
	  position: fixed;
	  left:0;
	  top:0;
	  width:100%;
	  height:100%;
	  background:rgba($color: #000000, $alpha: .6);
	  z-index: 999;
	  .cover-content{
		  width:80%;
		  height:270upx;
		  background: #fff;
		  border-radius: 14upx;
		  position: fixed;
		  left:0;
		  top:0;
		  right:0;
		  bottom:0;
		  margin:auto;
		  .cover-content-list{
			  height:90upx;
			  line-height: 90upx;
			  border-bottom: 1upx solid #bdbdbd;
			  text-indent: 30upx;
			  font-weight: 600;
			  font-size: 32upx;
			  &:last-child(){
				  border-bottom: 0;
			  }
		  }
	  }
  }
  .disBtn{
  	pointer-events: none;
  }
</style>