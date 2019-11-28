<template>
	<view class="uni-column application-list">
		<view class="uni-row application-list-content" @click="setMyPayInfo">
			<view class="application-list-content-left">
				收费设置
			</view>
			<uni-icon type="arrowright" size="28"></uni-icon>
		</view>
		<view class="uni-row application-list-content" @click="setMyPositionInfo">
			<view class="application-list-content-left">
				展位设置
			</view>
			<uni-icon type="arrowright" size="28"></uni-icon>
		</view>
		<view class="uni-row application-list-content" @click="setMyShopDays">
			<view class="application-list-content-left">
				店铺设置
			</view>
			<uni-icon type="arrowright" size="28"></uni-icon>
		</view>
		<view class="cover" v-if="show_pay">
			<view class="cover-content uni-column">
				<view class="cover-content-input uni-column">
					<input type="number" value="" placeholder="设置季度" @input="getquarter"/>
				</view>
				<view class="cover-content-input uni-column">
					<input type="number" value="" placeholder="设置折扣" @input="getDiscount"/>
				</view>
				<view class="cover-content-input uni-column">
					<input type="number" value="" placeholder="设置价格" @input="getPrice"/>
				</view>
				<view class="btn-list uni-row uni-row">
					<view class="btn-list-1 button" @click="cancelButton">
						取消
					</view>
					<view class="btn-list-2 button" @click="confirmSetPayInfo">
						确认
					</view>
				</view>
			</view>
		</view>
		<view class="cover" v-if="show_pos">
			<view class="cover-content uni-column">
				<view class="cover-content-title">
					{{update_spot?'设置展位':'更新展位'}}
				</view>
				<view class="cover-content-input uni-column">
					<input type="number" value="" placeholder="设置基础展位数" @input="getBaseSpot" v-model="spot_info.basespot"/>
				</view>
				<view class="cover-content-input uni-column">
					<input type="number" value="" placeholder="设置最大展位数" @input="getMaxSpot" v-model="spot_info.maxspot"/>
				</view>
				<view class="btn-list uni-row uni-row">
					<view class="btn-list-1 button" @click="cancelButtons">
						取消
					</view>
					<view class="btn-list-2 button" @click="confirmSetPosInfo">
						确认
					</view>
				</view>
			</view>
		</view>
		
		<view class="cover" v-if="show_days">
			<view class="cover-content uni-column">
				<view class="cover-content-title">
					店铺设置
				</view>
				<view class="cover-content-input uni-column">
					<input type="number" value="" placeholder="设置天数"  v-model="long_time"/>
				</view>
				<view class="cover-content-input uni-column">
					<input type="number" value="" placeholder="设置审核费用"  v-model="fees"/>
				</view>
				<view class="btn-list uni-row uni-row">
					<view class="btn-list-1 button" @click="shopCancelButtons">
						取消
					</view>
					<view class="btn-list-2 button" @click="shopConfirmSetPosInfo">
						确认
					</view>
				</view>
			</view>
		</view>
	</view>
</template>

<script>
	import uniIcon from "@/components/uni-icon/uni-icon.vue"
	export default {
		data() {
			return {
				pay_info:{
					seasons:'',
					discount:'',
                    price:''	
				},
				spot_info:{
					basespot:'',
					maxspot:''
				},
				show_pay:false,
				show_pos:false,
				update_spot:false,
				long_time:'',
				show_days:false,
			};
		},
		components:{
		  uniIcon	
		},
		onLoad() {
			this.findSpotList();
			this.getShopBaseInfo();
		},
		methods:{
			getquarter(e){
				console.log(e);
				this.pay_info.seasons = e.detail.value;
			},
			getDiscount(e){
				console.log(e);
				this.pay_info.discount = e.detail.value;
			},
			getPrice(e){
				console.log(e);
				this.pay_info.price = e.detail.value;
			},
			getBaseSpot(e){
				console.log(e);
				this.spot_info.basespot = e.detail.value;
			},
			getMaxSpot(e){
				console.log(e);
				this.spot_info.maxspot = e.detail.value;
			},
			setMyPayInfo(){
				//this.show_pay = true;
				uni.navigateTo({
					url:'../setlist/payset/payset'
				})
			},
			setMyPositionInfo(){
			    this.show_pos = true;	
			},
			setMyShopDays() {
				this.show_days = true;
			},
			cancelButton(){
				this.show_pay =false;
			},
			cancelButtons(){
				this.show_pos = false;
			},
			shopCancelButtons() {
				this.show_days = false;
			},
			async shopConfirmSetPosInfo() {
				await this.updateShopBseInfo();
				this.show_days = false;
			},
			confirmSetPayInfo(){
				const _this = this;
				const data = this.pay_info;
				for(let i in data){
					if(!data[i]){
						return uni.showToast({
							title:'请仔细填写',
							icon:'none'
						})
					}
				}
				this.$api('index/add_charge_info','POST', data)
				.then(res=>{
					console.log(res)
					if(res.data.code==0){
						return uni.showToast({
							title:'填写成功',
							icon:'none',
							success:res=>{
								_this.show_pay = false;
						    },
							fail:err=>{
								cosnole.log(err);
							}
						})
					}else{
						return uni.showToast({
							title:'填写失败',
							icon:'none'
						})
					}
				}).catch(err=>{
					console.log(err);
				})  
			},
			confirmSetPosInfo(){
				const _this = this;
				const data = this.spot_info;
				for(let i in data){
					if(!data[i]){
						return uni.showToast({
							title:'请仔细填写',
							icon:'none'
						})
					}
				}
				this.$api('index/set_spot_info','POST', data)
				.then(res=>{
					console.log(res)
					if(res.data.code==0){
						return uni.showToast({
							title:'设置成功',
							icon:'none',
							success:res=>{
								_this.show_pos = false;
						    },
							fail:err=>{
								cosnole.log(err);
							}
						})
					}else{
						return uni.showToast({
							title:'填写失败',
							icon:'none'
						})
					}
				}).catch(err=>{
					console.log(err);
				})  
			},
			//-------设置基础展位
			setSpotList(){
				const _this = this;
				const data = {};
				this.$api('index/set_spot_info','POST', data)
				.then(res=>{
					console.log(res)
				}).catch(err=>{
					console.log(err);
				})  
			},
			//-------获取基础展位信息
			findSpotList(){
				const _this = this;
				const data = {};
				this.$api('index/find_spot_info','POST', data)
				.then(res=>{
					console.log(res)
					if(res.data){
						_this.spot_info.basespot = res.data[0].basespot;
						_this.spot_info.maxspot = res.data[0].maxspot;
						_this.update_spot = true
					}else{
						_this.update_spot = false
					}
					
				}).catch(err=>{
					console.log(err);
				})  
			},
			//-------修改基础展位信息
			updateSpotList(){
				const _this = this;
				const data = {};
				this.$api('index/upload_spot_info','POST', data)
				.then(res=>{
					console.log(res)
				}).catch(err=>{
					console.log(err);
				})  
			},
			//-------店铺信息设置获取
			getShopBaseInfo(){
				const _this = this;
				const data = {};
				this.$api('index/getting_shop_days','POST', data)
				.then(res=>{
					_this.long_time = res.data.mdtime;
					_this.fees = res.data.cost;
				}).catch(err=>{
					console.log(err);
				})  
			},
			//-------店铺信息更新
			updateShopBseInfo(){
				const _this = this;
				const data = {
					mdtime: this.long_time,
					cost: this.fees,
				};
				this.$api('index/setting_shop_days','POST', data)
				.then(res=>{
					console.log(res)
					if(res.data.code == 0) {
						return uni.showToast({
							     title: res.data.message,
								 icon:'none'
						       })
					} else {
						return uni.showToast({
							     title: '修改失败',
								 icon:'none'
						       })
					}
				}).catch(err=>{
					console.log(err);
				})  
			},
		}
	}
</script>

<style lang="scss">
.application-list{
	.application-list-content{
		height:90upx;
		line-height: 90upx;
		padding:0 20upx;
		justify-content: space-between;
		align-items: center;
		border-bottom: 1upx solid #bdbdbd;
		.application-list-content-left{
			font-size: 34upx;
			font-weight: 400;
		}
		.application-list-content-right{
			.application-list-content-right-number{
				width:54upx;
				height:54upx;
				line-height: 54upx;
				text-align: center;
				border-radius: 50%;
				background: #e91010;
				color:#fff;
			}
		}
		
	}
}
.cover{
	position: fixed;
	left:0;
	top:0;
	width:100%;
	height:100%;
	background: rgba($color: #bdbdbd, $alpha: .6);
	.cover-content{
		width:80%;
		background: #fff;
		position: fixed;
		left:50%;
		top:50%;
		transform: translateX(-50%) translateY(-50%);
		border-radius: 14upx;
		overflow: hidden;
		.cover-content-title{
			height:70upx;
			line-height: 70upx;
			font-weight: 600;
			text-align: center;
			font-size: 32upx;
		}
		.cover-content-input{
			height:90upx;
			border-bottom:1upx solid #bdbdbd;
			justify-content: space-between;
			input{
				height:90upx;;
				line-height: 90upx;
				padding:0 20upx;
				text-align: center;
			}
		}
	}
	.btn-list{
		height:90upx;
		line-height: 90upx;
		background-color: #f5f5f5;
		justify-content: space-between;
		.button{
			width:49.5%;
			background-color: #fff;
			text-align: center;
			font-weight: 550;
		}
	}
}
</style>
