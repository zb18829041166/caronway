<template>
	<view class="uni-process">
		<view class="uni-process-class uni-row">
			<view class="chexi" @click.stop="showFlag(1)">
				添加车系
			</view>
			<view class="chexi" @click.stop="showFlag(2)">
				添加子车系
			</view>
		</view>
		<view class="identity-telphone uni-column">
			<view class="identity-user-info uni-column">
				<view class="identity-system-discount">
					<view class="identity-user-info-conetnt uni-row">
						<view class="uni-list-cell is-picker">
							<view class="uni-list-cell-left">
								请选择车系
							</view>
							<view class="uni-list-cell-db">
								<picker mode="selector" :value="parent_num" :range="car_parent"  range-key="carClassName"   @change="bindParentChange">
									<view class="uni-input">{{car_parent[parent_num].carClassName}}</view>
								</picker>
							</view>
						</view>
					</view>
				</view>
				<view class="identity-system-discount">
					<view class="identity-user-info-conetnt uni-row">
						<view class="uni-list-cell is-picker">
							<view class="uni-list-cell-left">
								请选择子车系
							</view>
							<view class="uni-list-cell-db">
								<picker mode="selector" :value="child_num" :range="car_child" range-key="carClassName" @change="bindChildChange">
									<view class="uni-input">{{car_child[child_num].carClassName}}</view>
								</picker>
							</view>
						</view>
					</view>
				</view>
				<view class="identity-user-info-conetnt uni-row">
					<input type="text" maxlength="11" placeholder="请输入车型" class="is-input1" v-model="car_info.model"/>
				</view>
				<view class="identity-system-discount">
					<view class="identity-user-info-conetnt uni-row">
						<view class="uni-list-cell is-picker">
							<view class="uni-list-cell-left">
								请选择动力
							</view>
							<view class="uni-list-cell-db">
								<picker mode="selector" :value="power_num" :range="power_list" @change="bindPowerChange">
									<view class="uni-input">{{power_list[power_num]}}</view>
								</picker>
							</view>
						</view>
					</view>
				</view>
				<view class="identity-user-info-conetnt uni-row">
					<input type="text" maxlength="11" placeholder="请输入级别" class="is-input1" v-model="car_info.classes"/>
				</view>
				<view class="identity-user-info-conetnt uni-row">
					<view class="uni-list-cell is-picker">
						<view class="uni-list-cell-left">
							选择上市时间
						</view>
						<view class="uni-list-cell-db">
							<picker mode="date" :value="date" :start="startDate" :end="endDate" @change="bindDateChange">
								<view class="uni-input">{{date}}</view>
							</picker>
						</view>
					</view>
				</view>
				<view class="identity-user-info-conetnt uni-row">
					<input type="text" maxlength="11" placeholder="请输入发动机" class="is-input1" v-model="car_info.motor"/>
				</view>
				<view class="identity-user-info-conetnt uni-row">
					<input type="text" maxlength="11" placeholder="请输入最大功率" class="is-input1" v-model="car_info.maxkw"/>
				</view>
				<view class="identity-user-info-conetnt uni-row">
					<input type="text" maxlength="11" placeholder="请输入最大扭矩" class="is-input1" v-model="car_info.maxtorque"/>
				</view>
				<view class="identity-user-info-conetnt uni-row">
					<input type="text" maxlength="11" placeholder="请输入变速箱" class="is-input1" v-model="car_info.gearbox"/>
				</view>
				<view class="identity-user-info-conetnt uni-row">
					<input type="text" maxlength="11" placeholder="请输入长宽高" class="is-input1" v-model="car_info.outline"/>
				</view>
				<view class="identity-user-info-conetnt uni-row">
					<input type="text" maxlength="11" placeholder="请输入车身结构" class="is-input1" v-model="car_info.structure"/>
				</view>
				<view class="identity-user-info-conetnt uni-row">
					<input type="text" maxlength="11" placeholder="请输入最高车速" class="is-input1" v-model="car_info.maxspeed"/>
				</view>
				<view class="identity-system-discount">
					<view class="identity-user-info-conetnt uni-row">
						<view class="uni-list-cell is-picker">
							<view class="uni-list-cell-left">
								请选择市场销售
							</view>
							<view class="uni-list-cell-db">
								<picker mode="selector" :value="sale_num" :range="sale_list" @change="bindSaleChange">
									<view class="uni-input">{{sale_list[sale_num]}}</view>
								</picker>
							</view>
						</view>
					</view>
				</view>
				<view class="identity-user-info-conetnt uni-row">
					<input type="text" maxlength="11" placeholder="请输入综合油耗" class="is-input1" v-model="car_info.fuelcsption"/>
				</view>
				<view class="identity-user-info-conetnt uni-row">
					<input type="text" maxlength="11" placeholder="请输入产地" class="is-input1" v-model="car_info.placepro"/>
				</view>
				<view class="identity-user-info-conetnt uni-row">
					<input type="text" maxlength="11" placeholder="请输入实际售价" class="is-input1" v-model="car_info.realprice"/>
				</view>
				<view class="identity-user-info-conetnt uni-row">
					<input type="text" maxlength="11" placeholder="请输入新车参考价" class="is-input1" v-model="car_info.newprice"/>
				</view>
			</view>
			<view class=" registerbtn has-radius has-mgtb-20" @click="goShopInfo">
				<button>确认设置</button>
			</view>	
		</view>
		<view class="cover" v-if="show_flag1">
			<view class="cover-content uni-column">
				<view class="cover-content-title is-h4">
					请输入车系
				</view>
				<input class="cover-content-input" type="text" value="" @input="getClassID" placeholder="请输入车系,如奥迪"/>
				<view class="uni-row cover-content-btn">
					<view class="button" @click.stop="cancelButtonID">
						取消
					</view>
					<view class="button" @click.stop="confirmButtonID">
						确认
					</view>
				</view>
			</view>
		</view>
		<view class="cover" v-if="show_flag2">
			<view class="cover-content uni-column" style="height:400upx;">
				<view class="cover-content-title is-h4">
					请输入子车系
				</view>
				<view class="identity-system-discount">
					<view class="identity-user-info-conetnt uni-row">
						<view class="uni-list-cell is-picker">
							<view class="uni-list-cell-left">
								请选择父车系
							</view>
							<view class="uni-list-cell-db">
								<picker mode="selector" :value="parent_num" :range="car_parent"  range-key="carClassName"   @change="bindParentChange">
									<view class="uni-input">{{car_parent[parent_num].carClassName}}</view>
								</picker>
							</view>
						</view>
					</view>
				</view>
				<input class="cover-content-input" type="text" value="" placeholder="请输入子车系,如A3" @input="getClassCID"/>
				<view class="uni-row cover-content-btn">
					<view class="button" @click.stop="cancelButtonCID">
						取消
					</view>
					<view class="button" @click.stop="confirmButtonCID">
						确认
					</view>
				</view>
			</view>
		</view>
	</view>
</template>

<script>
  import uniUpload from '@/components/uni-upload.vue'
  export default {
    name:'upload-car',
    data() {
		 const currentDate = this.getDate({
            format: true
        })
      return {
		 telephone:'',
		 telephone1:'',
		 show_cover:false,
		 chexi:'',
		 chexing:'',
		 imgurl:'',
		 use_type:'upload',
		 cWidth:100,
		 cHeight:100,
		 show_car:true,
		 show_flag:false,
		 discount_list:['国产车','德系车','日系车','美系车','韩系车','其他'],
		 power_list:['柴油','汽油','电能','天然气','氢能','混动'],
		 sale_list:['一般','畅销','热销'],
		 car_parent:[{carClassName: "奥迪",carType: "1",id: "9",pid: "-1"}],
		 car_child:[{carClassName: "A3",carType: "2",id: "10",pid: "9"}],
		 car_data:'',
		 discount_num:0,
		 power_num:0,
		 sale_num:0,
		 province_num:0,
		 city_num:0,
		 parent_num:0,
		 child_num:0,
		 select_id:0,
		 date: currentDate,
		 date1:currentDate,
		 date2:currentDate,
		 province_list:[],
		 city_list:[{name:'北京市',id:13000}],
		 type:{
			fg:false,
			 
		 },
		 show_flag1:false,
		 show_flag2:false,
		 car_info:{
			classid:'',
			classcid:'',
			model:'',
			classes:'',
			energyType:'',
			timemarket :'',
			motor:'',
			maxkw:'',
			maxtorque:'',
			gearbox:'',
			outline:'',
			structure:'',
			maxspeed:'',
			hot:'',
			placepro:'',
			realprice:'',
			newprice:'',
			fuelcsption:'',
			fromtype:'1',
		 },
         base_info:{
			 node:0,
			 list:[
				 {
					 name:'基本信息',
					 isActive:true,
				 },
				 {
					 name:'使用信息',
					 isActive:false,
				 },
				 {
					 name:'上传图片',
					 isActive:false,
				 },
			 ]
		 }
      }
    },
	components:{
	  	uniUpload, 
	},
	computed: {
        startDate() {
            return this.getDate('start');
        },
        endDate() {
            return this.getDate('end');
        }
    },
	onLoad(options) {
		this.getProvinceInfo();
		this.use_type = options.type;
		if(options.type && options.type =='edit'){
			console.log('user_info',this.$store.state.use_info);
			const useInfo = this.$store.state.use_info;
			for(let i in useInfo){
				if(this.use_info[i] == ''){
					this.use_info[i] = useInfo[i]?useInfo[i]:'';
				}
			}
		}
		this.getCarList();
	},
    methods: {
	 
	  goShopInfo(){
		  this.car_info.energyType = this.power_list[this.power_num];
		  this.car_info.hot = this.sale_list[this.sale_num];
		  this.car_info.timemarket = this.date;
		  console.log(this.car_info);
		  for(let i in this.car_info) {
			  if(!this.car_info[i]){
				  return uni.showToast({
				  	title:'请填写完整',
					icon:'none'
				  })
			  }
		  }
		  this.uploadCarBaseInformation(this.car_info);
	  },
	  //上传车辆基本信息
	  uploadCarBaseInformation(info){
		     const _this = this;
			 const data = info;
			 this.$api('index/add_car_baseSet','POST', data)
			 .then(res=>{
				console.log(res)
				if(res.data && res.data.errcode==0){
					uni.showToast({
						title:'上传成功',
						icon:'none'
					})
					_this.getCarList();
				}
				else{
					uni.showToast({
						title:'上传失败',
						icon:'none'
					})
				}
			 }).catch(err=>{
				console.log(err);
			 })   
	  },
	  showFlag(id){
		  if(id==1){
			  this.show_flag1 = true;
		  }
		  else if(id==2){
			  this.show_flag2 = true;
			  this.getCarList();
		  }
	  },
	  //获取父车系输入
	  getClassID(e){
		  if(e.detail.value){
			  this.classId= e.detail.value;
		  }
	  },
	  //获取子车系输入
	  getClassCID(e){
		   if(e.detail.value){
		  		this.classCId= e.detail.value;
		  }
	  },
	  cancelButtonID(){
		  this.show_flag1 = false;
	  },
	  confirmButtonID(){
		  this. setParentClass();
	  },
	  cancelButtonCID(){
		 this.show_flag2 = false;  
	  },
	  confirmButtonCID(){
		 this.setChildClass();
	  },
	  //设置父车系
	  setParentClass(){
		 const _this = this;
		 if(this.classId){
			  const data = {carClassName:this.classId};
			 this.$api('index/add_parent_class','POST', data)
			 .then(res=>{
			 	console.log(res)
			 	if(res.data && res.data.code==0){
					uni.showToast({
						title:'设置成功',
						icon:'none'
					})
					_this.getCarList();
			 	}
			 }).catch(err=>{
			 	console.log(err);
			 })   
		 }else{
			 uni.showToast({
			 	title:'请输入父车系',
				icon:'none'
			 })
		 }
		this.show_flag1 = false;
	  },
	  //设置子车系
	  setChildClass(){
		 const _this = this;
		 if(this.classCId){
			  const data = {carClassName:this.classCId,pid: this.car_parent[this.parent_num].id};
			 this.$api('index/add_child_class','POST', data)
			 .then(res=>{
				console.log(res)
				if(res.data && res.data.code==0){
					uni.showToast({
						title:'设置成功',
						icon:'none'
					})
					_this.getCarList();
				}
			 }).catch(err=>{
				console.log(err);
			 })   
		 }else{
			 uni.showToast({
				title:'请输入父车系',
				icon:'none'
			 })
		 }
		this.show_flag2 = false;
	  },
	  bindDateChange: function(e) {
         this.date = e.target.value;
      },
	  bindSafeChange(e) {
		  console.log(e);
		  this.date2 = e.target.value;
	  },
	  bindRegisterChange(e) {
		  console.log(e);
		  this.date1 = e.target.value;
	  },
	  bindProvinceChange(e){
		console.log(e);
		this.province_num = e.detail.value;
		const proid = this.province_list[this.province_num].id;
		this.getCityInfo(proid);
	  },
	  bindCityChange(e){
		console.log(e);
		this.city_num = e.detail.value;
		const city_id= this.city_list[this.city_num].id;
	  },
	  bindParentChange(e){
		 console.log(e);
		 this.parent_num = e.detail.value;
		 const pid = this.car_parent[this.parent_num].id;
		 this.car_info.classid = this.car_parent[this.parent_num].carClassName;
		 this.getChildCarList(pid);
	  },
	  bindChildChange(e){
		 console.log(e);
		 this.child_num = e.detail.value;
		 this.car_info.classcid = this.car_child[this.child_num].carClassName;
	  },
	  getDate(type) {
            const date = new Date();
            let year = date.getFullYear();
            let month = date.getMonth() + 1;
            let day = date.getDate();
            if (type === 'start') {
                year = year - 60;
            } else if (type === 'end') {
                year = year + 2;
            }
            month = month > 9 ? month : '0' + month;;
            day = day > 9 ? day : '0' + day;
            return `${year}-${month}-${day}`;
        },
	   bindDiscountChange(e){
		   console.log(e)
		   this.discount_num = e.target.value;
	  },
	  bindPowerChange(e){
		  this.power_num = e.target.value;
	  },
	  bindSaleChange(e) {
		  this.sale_num = e.target.value;
	  },
	  uploadCarBaseInfo(){
		const _this = this;
		const data = this.car_info;
		return this.$api('index/upload_car_info','POST', data)
	  },
	  uploadCarUserInfo(){
	  		const _this = this;
	  		const data = this.use_info;
	  		return this.$api('index/upload_user_car','POST', data)
	  },
	  updateCarUserInfo(){
	  		const _this = this;
	  		const data = this.use_info;
	  		return this.$api('index/update_user_car','POST', data)
	  },
	  onLineCar(){
		  const _this = this;
		  const data = {id:this.$store.state.use_info.id,userid:this.use_info.userid};
		  return this.$api('index/person_on_line','POST', data)
	  },
	  getProvinceInfo(){
		const _this = this;
		const data = {};
	    this.$api('index/get_province_info','POST', data)
		.then(res=>{
			console.log(res)
			if(res.data && res.data.length>0){
				_this.province_list=res.data;
			}
		}).catch(err=>{
			console.log(err);
		})  
	  },
	  getCityInfo(id){
		const _this = this;
		const data = {proid:id};
	    this.$api('index/get_city_info','POST', data)
		.then(res=>{
			console.log(res)
			if(res.data && res.data.length>0){
				_this.city_list=res.data;
			}
		}).catch(err=>{
			console.log(err);
		})    
	  },
	  noSubmitButton(){
		  this.show_cover=true;
	  },
	  cancelButton(){
		  this.show_cover=false;
	  },
	  confirmButton(){
		  this.show_cover=false;
	  },
	  getCarList(){
		  const _this = this;
		  const data = {};
		  this.$api('index/get_car_parent','POST', data)
		  .then(res=>{
		  	console.log(res)
		  	if(res.data && res.data.length>0){
		  		_this.car_parent=res.data;
				_this.getChildCarList(res.data[0].id);
		  	}
		  }).catch(err=>{
		  	console.log(err);
		  })
	  },
	  getChildCarList(id){
		   const _this = this;
		  const data = {pid:id};
		  this.$api('index/get_car_child','POST', data)
		  .then(res=>{
		  	console.log(res)
		  	if(res.data && res.data.length>0){
		  		_this.car_child=res.data;
		  	}
		  }).catch(err=>{
		  	console.log(err);
		  })
	  },
	  cancleGetParaid(){
		  
		  this.show_car = false;
		  uni.navigateBack({
		  	delta:1,
		  })
	  },
	  comfirmGetParaid(){
		  const classId = this.car_parent[this.parent_num].carClassName;
		  const _this = this;
		  const data = {classID:classId};
		  this.$api('index/get_car_common','POST', data)
		  .then(res=>{
		  	console.log(res)
		  	if(res.data && res.data.length>0){
		  		_this.car_data=res.data;
				_this.show_car = false;
				_this.show_flag = true;
		  	}
		  }).catch(err=>{
		  	console.log(err);
		  })
	  },
	  getSelectIndex(id){
		  this.select_id =id;
		  setTimeout(()=>{
			this.show_flag = false;  
			const carInfo = this.car_data[id];
			for(let i in carInfo){
				if(this.car_info[i] || this.car_info[i] == ''){
					this.car_info[i] = carInfo[i];
				}
			}
		 },500)
	  }
    },
  }
</script>

<style lang="scss">
  .uni-process{
	width:100%;
	height:100%;
	position: relative;
	padding:140upx 0 0 0;
	
   }
   .uni-process-class{
	   width:100%;
	   height:100upx;
	   line-height: 100upx;
	   background-color: #fff;
	   position: absolute;
	   left:0;
	   top:0;
	   .chexi{
		   flex:1;
		   height:100%;
		   text-align: center;
		   font-size: 30upx;
	   }
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
  .registerbtn{
	  padding:0 20upx;
	}
  .registerbtn button {
  	margin-top: 50upx !important;
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
  	border: 2upx solid #f2f2f2;
  }
  .disBtn{
  	pointer-events: none;
  }
  .identity-telphone{
	  padding:20upx;
  }
  .identity-user{
	  padding:20upx;  
  }
  .identity-user-info{
  		  background:#fff;
  		  margin-bottom:20upx;
  		  padding:20upx;
  		  border-radius: 14upx;
  }
  .identity-user-info-conetnt{
    			  // height:70upx;
    			  // line-height: 70upx;
    			  // border:1upx solid #bdbdbd;
    			  // border-radius: 35upx;
    			  padding:0 20upx;
    			  margin-bottom:20upx;
    			  .identity-user-info-conetnt-input{
    				  width:100%;
    				  height:70upx !important;
    				  line-height: 70upx;
    			  }
  }
  .identity-user-img{
	      flex-wrap: wrap;
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
			  margin-bottom:30upx;
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
  .upload-car-select{
	  background: #fff;
	  border-radius: 35upx;
	  overflow: hidden;
	  
  }
  .uni-list-cell::after{
	  display: none;
  }
  .uni-list-cell-left{
	  color:#707070;
	  font-size: 32upx;
  }  
 .uni-input{
	  color:#bdbdbd;
	  font-size: 32upx;
 }
 .is-picker{
	 border:1upx solid #bdbdbd;
	 width:100%;
	 height:100%;
	 border-radius: 44upx;
	 overflow: hidden;
 }
 .identity-car-img{
	 flex-wrap: wrap;
	 justify-content: space-between;
 }
 .identity-system-payment{
	 
 }
 .cover{
 	  width:100%;
 	  height:100%;
 	  position: fixed;
 	  left:0;
 	  top:0;
 	  background:rgba($color: #000000, $alpha: .6);
	  z-index: 999;
 	  .cover-content{
 		  width:90%;
		  height:300upx;
 		  position: fixed;
 		  left:50%;
 		  top:50%;
 		  transform: translateX(-50%) translateY(-50%);
 		  background: #fff;
 		  border-radius: 14upx;
 		  padding:30upx 0 0 0;
		  text-align: center;
		  overflow: hidden;
		  .cover-content-input{
			  width:320upx;
			  height:90upx;
			  line-height: 90upx;
			  align-self: center;
			  text-align: center;
			  border-bottom: 1upx solid green;
			  input{
				  width:320upx;
				  text-align: center;
				  height:90upx;
				  line-height: 90upx;
			  }
		  }
		  .cover-content-btn{
			 height:90upx;
			 line-height: 90upx;
			 width:100%;
			 justify-content: space-between;
			 position: absolute;
			 bottom:0;
			 left:0;
			 background:#f5f5f5;
			 .button{
				 width:49.5%;
				 text-align: center;
				 border-top:1upx solid #bdbdbd;
				 background-color: #fff;
			 }
		  }
 	  }
 }
</style>