<template>
	<view class="uni-process">
		<view class="dateContent">
			<view class="line"></view>
			<view  v-for="(item,key) in base_info.list" :class="{'item':true, 'item-checked': key<=base_info.node, 'item-close': !item.isActive}" :key="key" @click="getSelectNode(key)">
				<view class="circle"></view>
				<view class="week">{{item.name}}</view>
			</view>
		</view>
		
		<view class="identity-telphone uni-column" v-if="base_info.node==0">
			<view class="identity-user-info uni-column">
				<view class="rechoose" @click="reChooseClassID">
					重新选择车系:{{car_info.classid}}{{car_info.classcid}}
				</view>
				<view class="identity-system-discount">
					<view class="identity-user-info-conetnt uni-row">
						<view class="uni-list-cell is-picker">
							<view class="uni-list-cell-left">
								请选择车系
							</view>
							<view class="uni-list-cell-db">
								<picker mode="selector" :value="discount_num" :range="discount_list" @change="bindDiscountChange">
									<view class="uni-input">{{discount_list[discount_num]}}</view>
								</picker>
							</view>
						</view>
					</view>
				</view>
				<view class="identity-user-info-conetnt uni-row">
					<view class="uni-list-cell is-picker">
						<view class="new-title">
							车型
						</view>
						<input type="text" maxlength="11" placeholder="请输入车型" class="new-input" v-model="car_info.model"/>
					</view>
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
					<view class="uni-list-cell is-picker">
						<view class="new-title">
							级别
						</view>
						<input type="text" maxlength="11" placeholder="请输入级别" class="new-input" v-model="car_info.classes"/>
					</view>
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
					<view class="uni-list-cell is-picker">
						<view class="new-title">
							发动机
						</view>
						<input type="text" maxlength="11" placeholder="请输入发动机" class="new-input" v-model="car_info.motor"/>
					</view>
				</view>
				<view class="identity-user-info-conetnt uni-row">
					<view class="uni-list-cell is-picker">
						<view class="new-title">
							最大功率
						</view>
						<input type="text" maxlength="11" placeholder="请输入最大功率" class="new-input" v-model="car_info.maxkw"/>
					</view>
				</view>
				<view class="identity-user-info-conetnt uni-row">
					<view class="uni-list-cell is-picker">
						<view class="new-title">
							最大扭矩
						</view>
						<input type="text" maxlength="11" placeholder="请输入最大扭矩" class="new-input" v-model="car_info.maxtorque"/>
					</view>
				</view>
				<view class="identity-user-info-conetnt uni-row">
					<view class="uni-list-cell is-picker">
						<view class="new-title">
							变速箱
						</view>
						<input type="text" maxlength="11" placeholder="请输入变速箱" class="new-input" v-model="car_info.gearbox"/>
					</view>
				</view>
				<view class="identity-user-info-conetnt uni-row">
					<view class="uni-list-cell is-picker">
						<view class="new-title">
							长宽高
						</view>
						<input type="text" maxlength="11" placeholder="请输入长宽高" class="new-input" v-model="car_info.outline"/>
					</view>
				</view>
				<view class="identity-user-info-conetnt uni-row">
					<view class="uni-list-cell is-picker">
						<view class="new-title">
							车身结构
						</view>
						<input type="text" maxlength="11" placeholder="请输入车身结构" class="new-input" v-model="car_info.structure"/>
					</view>
				</view>
				<view class="identity-user-info-conetnt uni-row">
					<view class="uni-list-cell is-picker">
						<view class="new-title">
							最高车速
						</view>
						<input type="text" maxlength="11" placeholder="请输入最高车速" class="new-input" v-model="car_info.maxspeed"/>
					</view>
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
					<view class="uni-list-cell is-picker">
						<view class="new-title">
							综合油耗
						</view>
						<input type="text" maxlength="11" placeholder="请输入综合油耗" class="new-input" v-model="car_info.fuelcsption"/>
					</view>
				</view>
				<view class="identity-user-info-conetnt uni-row">
					<view class="uni-list-cell is-picker">
						<view class="new-title">
							产地
						</view>
						<input type="text" maxlength="11" placeholder="请输入产地" class="new-input" v-model="car_info.placepro"/>
					</view>
				</view>
				<view class="identity-user-info-conetnt uni-row">
					<view class="uni-list-cell is-picker">
						<view class="new-title">
							实际售价
						</view>
						<input type="number" maxlength="11" placeholder="请输入实际售价" class="new-input" v-model="car_info.realprice"/>
					</view>
				</view>
				<view class="identity-user-info-conetnt uni-row">
					<view class="uni-list-cell is-picker">
						<view class="new-title">
							新车参考价
						</view>
						<input type="number" maxlength="11" placeholder="请输入新车参考价" class="new-input" v-model="car_info.newprice"/>
					</view>
				</view>
			</view>
			<view class=" registerbtn has-radius has-mgtb-20" @click="goShopInfo">
				<button>下一步</button>
			</view>	
		</view>
		
		<view class="identity-user" v-else-if="base_info.node==1">
			<view class="identity-user-info uni-column">
				<view class="identity-user-info-conetnt uni-row">
					<view class="uni-list-cell is-picker">
						<view class="new-title">
							已有行程数
						</view>
						<input type="text" maxlength="11" placeholder="已有行程数" class="new-input" v-model="use_info.hadkm"/>
					</view>
				</view>
				<view class="identity-system-discount">
					<view class="identity-user-info-conetnt uni-row">
						<view class="uni-list-cell is-picker">
							<view class="uni-list-cell-left">
								请选择省份
							</view>
							<view class="uni-list-cell-db" v-if="province_list">
								<picker mode="selector" :value="province_num" :range="province_list" range-key="name" @change="bindProvinceChange">
									<view class="uni-input">{{province_list[province_num].name}}</view>
								</picker>
							</view>
						</view>
					</view>
				</view>
				<view class="identity-system-discount">
					<view class="identity-user-info-conetnt uni-row">
						<view class="uni-list-cell is-picker">
							<view class="uni-list-cell-left">
								请选择城市
							</view>
							<view class="uni-list-cell-db" v-if="city_list.length">
								<picker mode="selector" :value="city_num" :range="city_list" range-key="name" @change="bindCityChange">
									<view class="uni-input">{{city_list[city_num].name}}</view>
								</picker>
							</view>
						</view>
					</view>
				</view>
				<view class="identity-user-info-conetnt uni-row">
					<view class="uni-list-cell is-picker">
						<view class="uni-list-cell-left">
							注册日期
						</view>
						<view class="uni-list-cell-db">
							<picker mode="date" :value="date1" :start="startDate" :end="endDate" @change="bindRegisterChange">
								<view class="uni-input">{{date1}}</view>
							</picker>
						</view>
					</view>
				</view>
				<view class="identity-user-info-conetnt uni-row">
					<view class="uni-list-cell is-picker">
						<view class="uni-list-cell-left">
							交强险截至日期
						</view>
						<view class="uni-list-cell-db">
							<picker mode="date" :value="date2" :start="startDate" :end="endDate" @change="bindSafeChange">
								<view class="uni-input">{{date2}}</view>
							</picker>
						</view>
					</view>
				</view>
				<view class="identity-user-info-conetnt uni-row">
					<view class="uni-list-cell is-picker">
						<view class="new-title">
							车龄
						</view>
						<input type="text" maxlength="11" placeholder="车龄(以月计)" class="new-input" v-model="use_info.age"/>
					</view>
				</view>
				<view class="identity-user-info-conetnt uni-row">
					<view class="uni-list-cell is-picker">
						<view class="new-title">
							过户次数
						</view>
						<input type="text" maxlength="11" placeholder="过户次数" class="new-input" v-model="use_info.times"/>
					</view>
				</view>
			</view>
			<view class=" registerbtn has-radius has-mgtb-20" @click="goUploadImages">
				<button>下一步</button>
			</view>	
		</view>
		<view class="identity-user identity-car-img" v-else-if="base_info.node==2">
			<view class="identity-user-img uni-row">
				<view class="identity-user-img-container">
					<image :src="use_info.frontpic?use_info.frontpic:''" alt="" mode=""></image>
					<view class="identity-user-img-container-cover uni-h4" @click.stop="uploadImage('frontpic')">
						车辆前脸图
					</view>
				</view>
				<view class="identity-user-img-container">
					<image :src="use_info.rearview?use_info.rearview:''" alt="" mode=""></image>
					<view class="identity-user-img-container-cover uni-h4" @click.stop="uploadImage('rearview')">
						车辆尾部图
					</view>
				</view>
				<view class="identity-user-img-container">
					<image :src="use_info.leftside?use_info.leftside:''" alt="" mode=""></image>
					<view class="identity-user-img-container-cover uni-h4" @click.stop="uploadImage('leftside')">
						车辆左侧图
					</view>
				</view>
				<view class="identity-user-img-container">
					<image  :src="use_info.rightside?use_info.rightside:''" alt="" mode=""></image>
					<view class="identity-user-img-container-cover uni-h4" @click.stop="uploadImage('rightside')">
						车辆右侧图
					</view>
				</view>
				<view class="identity-user-img-container">
					<image :src="use_info.frontcover?use_info.frontcover:''" alt="" mode=""></image>
					<view class="identity-user-img-container-cover uni-h4" @click.stop="uploadImage('frontcover')">
						车辆前盖图
					</view>
				</view>
				<view class="identity-user-img-container" style="visibility: hidden;">
					<image src="" alt="" mode=""></image>
					<view class="identity-user-img-container-cover uni-h4" @click.stop="uploadImage('fb')">
						车辆外部补充图
					</view>
				</view>
			</view>
			<view class="identity-user-img uni-row">
				<view class="identity-user-img-container">
					<image :src="use_info.interior1?use_info.interior1:''" alt="" mode=""></image>
					<view class="identity-user-img-container-cover uni-h4" @click.stop="uploadImage('interior1')">
						车辆内饰图1
					</view>
				</view>
				<view class="identity-user-img-container">
					<image :src="use_info.interior2?use_info.interior2:''" alt="" mode=""></image>
					<view class="identity-user-img-container-cover uni-h4" @click.stop="uploadImage('interior2')">
						车辆内饰图2
					</view>
				</view>
				<view class="identity-user-img-container">
					<image :src="use_info.interior3?use_info.interior3:''" alt="" mode=""></image>
					<view class="identity-user-img-container-cover uni-h4" @click.stop="uploadImage('interior3')">
						车辆内饰图3
					</view>
				</view>
				<view class="identity-user-img-container" style="visibility: hidden;">
					<image src="" alt="" mode=""></image>
					<view class="identity-user-img-container-cover uni-h4" @click.stop="uploadImage('interior4')">
						车辆内饰图4
					</view>
				</view>
			</view>
			
			<view class=" registerbtn has-radius has-mgtb-20" @click="beSureApply">
				<button>确认申请</button>
			</view>
			<view class="is-20vh has-mgt-80">
				<!-- <navigator url="#" class=" has-radius is-center is-grey " hover-class=""> -->
					<text>确认申请即表示同意</text><text class="is-blue">《用户协议》</text>
				<!-- </navigator> -->
			</view>
			<canvas canvas-id="fillimg" :style="'width:'+ canvasWidth+ ';height:' + canvasHeight +';visibility: hidden;'"></canvas>
		</view>
		<!-- <view class="identity-system" v-else>
			<view class=" registerbtn has-radius has-mgtb-20" @click="submitCarInfo">
				<button>确认提交</button>
			</view>	
		</view> -->
		<view class="cover" v-if="show_car">
			<view class="cover-content uni-column">
				
				<view class="identity-system-discount">
					<view class="identity-user-info-conetnt uni-row">
						<view class="uni-list-cell is-picker">
							<view class="uni-list-cell-left">
								请选择车系
							</view>
							<view class="uni-list-cell-db" v-if="car_parent">
								<picker mode="selector" :value="parent_num" :range="car_parent" range-key="carClassName" @change="bindParentChange">
									<view class="uni-input">{{car_parent[parent_num].carClassName}}</view>
								</picker>
							</view>
						</view>
					</view>
				</view>
				
				<view class="identity-system-discount" style="height:100upx;">
					<view class="identity-user-info-conetnt uni-row">
						<view class="uni-list-cell is-picker">
							<view class="uni-list-cell-left">
								请选择子车系
							</view>
							<view class="uni-list-cell-db" >
								<picker mode="selector" :value="child_num" :range="car_child" range-key="carClassName" @change="bindChildChange">
									<view class="uni-input" >{{car_child[child_num].carClassName}}</view>
								</picker>
							</view>
						</view>
					</view>
				</view>
				<view class="cover-btn uni-row">
					<view class="cover-btn-click cover-btn-cancel" @click="cancleGetParaid">
						取消
					</view>
					<view class="cover-btn-click cover-btn-confirm" @click="comfirmGetParaid">
						确认
					</view>
				</view>
			</view>
		</view>
		
		<view class="cover" v-if="show_flag">
			<view class="cover-container">
				<view class="" v-for="(item,index) in car_data" :key="index">
					<view class="cover-containe-list" :class="select_id==index?'isSelect':''" @click="getSelectIndex(index)">
						{{item.classid}}{{item.classcid}}
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
		 canvasWidth:'300px',
		 canvasHeight:'300px',
		 chexi:'',
		 chexing:'',
		 imgurl:'',
		 use_type:'upload',
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
		 user_address:{
			address:'',
			latitude:'',
			longitude:'' 
		 },
		 use_info:{
			userid:this.$store.state.user_info.userid,
			hadkm:'',
			paraid:'',
			provinceid:'',
			cityid:'',
			regtime:'',
			instime:'',
			age:'',
			times:'',
			frontpic:'',
			rearview:'',
			rightside:'',
			leftside:'',
			frontcover:'',
			interior1:'',
			interior2:'',
			interior3:'',
		 },
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
	  reChooseClassID() {
		this.show_car = true;  
	  },
	  register(){
		const _this = this;
		const rgx= /^1[345789]\d{9}$/ ;
		if(rgx.test(this.telephone) && rgx.test(this.telephone1)){
			if(this.telephone == this.telephone1){
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
	  goShopInfo(){
		  this.car_info.energyType = this.discount_list[this.discount_num];
		  this.car_info.hot = this.sale_list[this.sale_num];
		  console.log(this.date);
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
		  this.getSelectInfo(this.base_info.list[1],1)
	  },
	  goUploadImages(){
		  this.use_info.regtime = this.date1;
		  this.use_info.instime = this.date2;
		  this.use_info.provinceid = this.province_list[this.province_num].id;
		  this.use_info.cityid = this.city_list[this.city_num].id;
		  this.use_info.paraid = this.car_data[this.select_id].id;
		  this.getSelectInfo(this.base_info.list[2],2);  
	  },
	  async beSureApply(){
		const carinfo = await this.uploadCarBaseInfo();
		const _this =this;
		let useinfo;
		if(this.use_type == 'upload'){
		    useinfo = await this.uploadCarUserInfo();
		}else{
			useinfo = await this.updateCarUserInfo();
		}
		console.log(carinfo);
		console.log(useinfo);
		if(carinfo.data.errcode==0 && (useinfo.data.errcode==0 || useinfo.data.code==0)) {
			uni.showToast({
				title:'上传成功',
				icon:'none',
				success:res =>{
					setTimeout(() =>{
						if(this.use_type =='edit'){
							_this.onLineCar();
							uni.navigateBack({
								delta:1
							})
						}else{
							uni.navigateBack({
								delta:1,
							})
						}
					},500)
				}
			})
		}else{
		    uni.showToast({
				title:'上传失败',
				icon:'none'
		    })
		}
	  },
	  getUserLocation(){
		  uni.chooseLocation({
		  	success:res=> {
		  		console.log(res);
				this.user_address.address = res.address;
				this.user_address.this.user_address.latitude = res.latitude;
				this.user_address.longitude = res.longitude;
		  	},
			fail:err=>{
				console.log('please check your network!');
			}
		  })
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
		 this.getChildCarList(pid);
	  },
	  bindChildChange(e){
		 console.log(e);
		 this.child_num = e.detail.value;
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
	  uploadImage(type){
	  	const that = this;
		console.log(type);
	  	uni.chooseImage({
			count: 1,
			sizeType: ['compressed'],
	  		success: res=> {
				console.log(res);
	  			const img_path = res.tempFilePaths[0];
				this.getImageInfo(img_path,type);
	          },
	  	})
	  },
	  setTimeCreate() {
	  	setTimeout(() => {
	  	  return true;	
	  	},1000)
	  },
	  getImageInfo(path,type){
		  const that = this;
		  uni.showLoading({
		  	title:'图片上传中'
		  })
		  uni.getImageInfo({
				src: path,  
				success:async res => {
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
				that.canvasWidth = `${canvasWidth}px`;
				that.canvasHeight = `${canvasHeight}px`;
				const timeRes = await that.setTimeCreate();
				var ctx = wx.createCanvasContext('fillimg');
				ctx.drawImage(res.path, 0, 0,canvasWidth,canvasHeight);
			   ctx.draw(false, setTimeout(function(){
					 uni.canvasToTempFilePath({
						 canvasId: 'fillimg',
						 quality:1,
						 destWidth: canvasWidth,
						 destHeight: canvasHeight,
						 success: function (resp) {
							 //console.log('res',resp.tempFilePath)//最终图片路径
								 uni.uploadFile({
									url: 'http://www.caronway.cn/v1/upload/addimg', //仅为示例，非真实的接口地址
									//url:'http://localhost:8084/upload/addimg',
									filePath: resp.tempFilePath,
									name: 'file',
									formData: {
										'userid': that.$store.state.user_info.userid,
										'shopType': 'SecondCar',
									},
									success: (res) => {
										const data = JSON.parse(res.data)	
										console.log(data)
										 if(data.status ==4){
											 that.use_info[type] = data.data
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
  .rechoose{
	  height:80upx;
	  line-height: 80upx;
	  padding: 0 20upx;
	  border-radius: 35upx;
	  color:#999;
	  background: #f5f5f5;
	  margin:20upx;
	  text-indent: 20upx;
	  font-weight: 600upx;
  }
  .identity-user-info-conetnt{
	  padding:0 20upx;
	  margin-bottom:20upx;
	  height:80upx !important;
	  line-height: 80upx;
	  
	  .identity-user-info-conetnt-input{
	  }
	  .new-title{
		  flex:3;
		  text-indent: 30upx;
		  font-size: 32upx;
	  }
	  .new-input{
		  flex:6;
		  height:80upx !important;
		  line-height: 80upx !important;
		  color:#bdbdbd;
		  font-size: 32upx;
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
 		  position: fixed;
 		  left:50%;
 		  top:50%;
 		  transform: translateX(-50%) translateY(-50%);
 		  background: #fff;
 		  border-radius: 14upx;
 		  padding:30upx 0 0 0;
		  overflow: hidden;
 	  }
	  .cover-btn{
		  justify-content: space-between;
		  background:#f5f5f5;
		  border-top:1upx solid #bdbdbd;
		  .cover-btn-click{
			  width:49.5%;
			  height:80upx;
			  line-height: 80upx;
			  background:#fff;
			  text-align: center;
			  color:#999999;
		  }
	  }
	  .cover-container{
		  width:90%;
		  height:500upx;
		  position: fixed;
		  left:0;
		  top:0;
		  right:0;
		  bottom: 0;
		  margin: auto;
		  background-color: #fff;
		  border-radius: 14upx;
		  overflow-y: scroll;
		  .cover-containe-list{
			  height:80upx;
			  line-height: 80upx;
			  text-indent: 20upx;
			  border-bottom: 1upx solid #bdbdbd;
		  }  
		  .isSelect{
			  color:#f35;
			  font-weight: 500;
			  border-bottom: 1upx solid #f35;
		  }
	  }
 }
 #fillimg{
	 canvas{
		 width:100% !important;
		 height:100% !important;
	 }
 }
</style>