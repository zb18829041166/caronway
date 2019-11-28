<template>
	<view class="secondcar uni-column">
		<view class="secondcar-header uni-row">
			<!-- <view class="secondcar-header-city uni-row" @click='goChooseCity'>
				{{city}}
				<uni-icon type="arrowdown" size="20"></uni-icon>
			</view> -->
			<page-search :show="true" :placeholder="search" @goSearchResult="goSearchResult"></page-search>
		</view>
		<page-item :list='sencond_car' @goSingleCarDetail="goDetail" @getMoreItem="getMoreItem"></page-item>
		<page-scroll @goBusiness="goBusinessDetail" :list="shop_list"></page-scroll>
		<page-content :list="person_list" @goPersonCar="goDetail"></page-content>
		<page-swiper></page-swiper>
	</view>
</template>

<script>
	import uniIcon from "@/components/uni-icon/uni-icon.vue"
	export default {
		data() {
			return {
				city:'武汉',
				sencond_car:[],
				shop_list:[],
				person_list:[],
				pageSize:6,
				pageNo:0,
				search:'',
			};
		},
		components:{
			uniIcon,
		},
		onLoad(){
			//this.getSearchResult();
			this.getSecondCarList();
			this.getSecondCarShop();
			this.getSecondCarPerson();
		},
		onShow() {
			console.log(this.$store.state.search);
			if(this.$store.state.search){
				this.sencond_car=[];
				this.pageSize=6;
				this.pageNo=0;
				this.search = this.$store.state.search;
				this.getSearchResult();
			}
		},
		methods:{
			//-------获取二手车列表----------
			getSecondCarList(){
				const data = {start:0,end:this.pageSize,condition:this.$store.state.search};
				const _this = this;
				this.$api('index/get_secondcar_base','POST', data)
				.then(res=>{
					console.log(res)
					if(res.data){
						_this.sencond_car = res.data,
						_this.pageNo +=1;
					}
				}).catch(err=>{
					console.log(err);
				})
			},
			goDetail(val){
				console.log(val);
				this.$store.state.search = '';
				uni.navigateTo({
				  url:`../cardeatil/cardeatil?carid=${val}`,
				})
			},
			goSearchResult(){
				uni.navigateTo({
					url:'../../search/search'
				})
			},
			getMoreItem(){
				const start = this.pageNo  * this.pageSize + 1;
				const end = (this.pageNo + 1) *this.pageSize;
				console.log(start);
				console.log(end);
				const condition = this.$store.state.search;
				const data = {start,end,condition};
				const _this = this;
				this.$api('index/get_secondcar_base','POST', data)
				.then(res=>{
					console.log(res)
					if(res.data && res.data.length>0){
						for(let i=0; i<res.data.length; i+=1){
							_this.sencond_car.push(res.data[i]);
						}
						_this.pageNo +=1;
					}
					else{
						uni.showToast({
							title:'没有更多了'
						})
					}
				}).catch(err=>{
					console.log(err);
				})
			},
			goBusinessDetail(val){
				console.log(val);
				uni.navigateTo({
					url:`../business/business?userid=${val}`,
				})
			},
			goChooseCity(){
				uni.navigateTo({
					url:'../choosecity/choosecity'
				})
			},
			getSearchResult() {
				console.log(search);
				console.log('car',this.$store.state.search);
				const _this = this;
				const search = this.$store.state.search;
			    this.sencond_car = [];
				const data = {condition:search,start:0,end:this.pageSize};
				if(this.$store.state.search){
					this.$api('index/get_secondcar_base','POST', data)
					.then(res=>{
						console.log(res)
						if(res.data){
							_this.sencond_car = res.data,
							_this.pageNo +=1;
						}
					}).catch(err=>{
						console.log(err);
					})
				}
			},
			//获取二手车商
			getSecondCarShop(){
				const _this = this;
				const data = {};
				this.$api('index/get_secondcar_shop','POST', data)
				.then(res=>{
					console.log(res)
					if(res.data && res.data.length>0){
						this.shop_list=res.data;
					}
				}).catch(err=>{
					console.log(err);
				})
			},
			//--------获取个人二手车-------
			getSecondCarPerson(){
				const _this = this;
				const data = {};
				this.$api('index/search_car_person','POST', data)
				.then(res=>{
					console.log(res)
					if(res.data && res.data.length>0){
						this.person_list=res.data;
					}
				}).catch(err=>{
					console.log(err);
				})
			},
			
		}
	}
</script>

<style lang="scss">
  .secondcar-header-city{
	  width:140upx;
	  height:90upx;
	  line-height: 90upx;
	  background-color: #fff;
	  align-items: center;
	  justify-content: center;
  }
</style>
