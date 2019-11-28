<template>
	<view class="message uni-column">
		<block v-for="(item,index) in price_list" :key="index">
		<view class="message-content uni-column">
			<view class="message-content-title uni-row">
				<image src="/static/large.png" mode=""></image>
				<view class="logo">
					车行路上俱乐部
				</view>
			</view>
			<view class="message-content-content uni-column">
				<view class="title">
					开店收费
				</view>
				<view class="text">
					季度：{{item.seasons}}季度
				</view>
				<view class="text">
					收费：{{item.price}}元
				</view>
				<view class="text">
					折扣：{{item.discount}}折
				</view>
			</view>
			<!-- <view class="message-content-list uni-row">
				<view class="message-content-list-price">
					{{item.price}}元
				</view>
				<view class="message-content-list-rig uni-column">
					<view class="">
						{{item.seasons}}季度
					</view>
					<view class="">
						{{item.discount}}折
					</view>
				</view>
			</view> -->
			<view class="message-content-detail uni-row">
				<view class="delete-btn" @click="updatePay(item.id)">
					修改
				</view>
				<view class="add-btn" @click = "deletePay(item.id)">
					删除
				</view>
			</view>
		</view>
		</block>
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
		<view class="pay-btn" @click="addPay">
			添加收费
		</view>
	</view>
	
	
</template>

<script>
	export default {
		data() {
			return {
				price_list:[],
				show_pay:false,
				pay_info:{
					seasons:'',
					discount:'',
				    price:''	
				},
			}
		},
		onLoad() {
			this.getPriceList();
		},
		methods: {
			getPriceList(){
			    const _this =this;
			    const data = {};
			    this.$api('index/find_charge_list','POST', data)
			    .then(res=>{
				   console.log(res);
				   if(res.data && res.data.length>0){
					   _this.price_list = res.data;
				   }
			    }).catch(err=>{
				  console.log(err);
			    })   
			},
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
			cancelButton(){
				this.show_pay = false
			},
			confirmSetPayInfo() {
				this.show_pay = false;
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
							title:'添加成功',
							icon:'none',
							success:res=>{
								_this.show_pay = false;
								_this.getPriceList();
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
			addPay(){
				this.show_pay = true;
			},
			updatePay(id){
				// this.show_pay = true;
				// const info = this.price_list[id];
				// for(let i in info) {
				// 	this.pay_info[i].
				// }
			}
		}
	}
</script>

<style lang="scss">
.message{
	padding:20upx 20upx 110upx 20upx; 
	.message-content{
		background:#fff;
		border-radius: 12upx;
		padding:0 20upx;
		margin-bottom:20upx;
		overflow: hidden;
		.message-content-title{
			padding:20upx 0;
			image{
				width:78upx;
				height:78upx;
				border-radius: 50%;
			}
			.logo{
				margin-left:20upx;
				font-weight: bold;
				font-size: 34upx;
				line-height:78upx; 
			}
		}
		.message-content-content{
			.title{
				font-size: 32upx;
				font-weight: 500;
			}
			.text{
				color:#999999;
				font-size: 28upx;
			}
		}
		.message-content-detail{
			width:100%;
			border-top:1upx solid #bdbdbd;
			height:90upx;
			line-height: 90upx;
			margin-top:40upx;
			font-weight: 500;
			font-size: 34upx;
			align-self: flex-end;
			justify-content: flex-end;
			align-items: center;
			color:#fff;
			.delete-btn{
				width:140upx;
				height:70upx;
				line-height: 70upx;
				background-color: #f5f5f5;
				text-align: center;
				border-radius: 10upx;
				color:#999999;
				
			}
			.add-btn{
				width:140upx;
				height:70upx;
				line-height: 70upx;
				background-color: green;
				text-align: center;
				border-radius: 10upx;
				margin-left:20upx;
			}
		}
		.message-content-list{
			height:240upx;
			border-left: 4upx solid red;
			.message-content-list-price{
				flex: 2;
				text-align: center;
				line-height: 240upx;
				font-size: 50upx;
				font-weight: 600;
			}
			.message-content-list-rig{
				flex:3;
				font-size: 32upx;
				text-align: left;
				text-indent: 30upx;
				align-items: center;
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
			.cover-content-input{
				height:90upx;
				border-bottom:1upx solid #bdbdbd;
				justify-content: space-between;
				input{
					height:90upx;;
					line-height: 90upx;
					padding:0 20upx;
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
			}
		}
	}
	.pay-btn{
		position: fixed;
		left:0;
		bottom:0;
		width:100%;
		height:90upx;
		line-height: 90upx;
		text-align: center;
		background-color: red;
		color:#fff;
		font-size: 32upx;
	}
}
</style>
