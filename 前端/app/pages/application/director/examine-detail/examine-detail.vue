<template>
	<view class="exam-del uni-column">
		<view class="exam-del-list uni-row">
			<view class="">
				店名:
			</view>
			<view class="">
				{{shop_info.realname}}
			</view>
		</view>
		<view class="exam-del-list uni-row">
			<view class="">
				手机号:
			</view>
			<view class="">
				{{shop_info.telephone}}
			</view>
		</view>
		<view class="exam-del-list uni-row">
			<view class="">
				地址:
			</view>
			<view class="" style="max-width:70%;overflow-x: scroll;">
				{{shop_info.address}}
			</view>
		</view>
		<view class="exam-del-lists uni-row" @click="previewImage(shop_info.outimg)">
			<view class="">
				店铺外景图:
			</view>
			<image :src="shop_info.outimg" mode=""></image>
		</view>
		<view class="exam-del-lists uni-row" @click="previewImage(shop_info.innimg)">
			<view class="">
				店铺内景图:
			</view>
			<image :src="shop_info.innimg" mode=""></image>
		</view>
		<view class="exam-del-lists uni-row" @click="previewImage(shop_info.licimg)">
			<view class="">
				店铺营业执照:
			</view>
			<image :src="shop_info.licimg" mode=""></image>
		</view>
		<view class="exam-del-lists uni-row" @click="previewImage(shop_info.logoori)">
			<view class="">
				店铺Logo:
			</view>
			<image :src="shop_info.logoori" mode=""></image>
		</view>
		<map :latitude="shop_info.latitude" :longitude="shop_info.longitude" :markers="covers"></map>
		
		<!-- <view class="exam-del-textarea">
			<textarea value="" placeholder="" @input="getTextAreaInput"/>
		</view> -->
		<block v-if="this.shop_info.status==0">
			<view class="exam-del-btn" @click="confirmExamine">
				确认通过
			</view>
			<view class="exam-del-btn" @click="showCover">
				拒绝通过
			</view>
		</block>
		<view class="cover" v-if="show_cover">
			<view class="cover-content">
				<view class="cover-content-1">
					<textarea value="" placeholder="请输入不通过原因" @input="getAreaTextInput"/>
				</view>
				<view class="cover-content-2 uni-row">
					<view class="cover-content-2-btn" @click="cancelClick">
						取消
					</view>
					<view class="cover-content-2-btn" @click="confirmClick">
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
				shop_info:{},
				show_cover:false,
				reason:'',
				covers: [],
				basespot:'4',
				maxspot:'8',
			};
		},
		onLoad(){
			this.shop_info = this.$store.state.examineInfo;
			console.log(this.shop_info);
			const data = {
				latitude: this.shop_info.latitude,
				longitude: this.shop_info.longitude,
				iconPath: '../../../../static/location.png'
			}
			this.covers.push(data);
			console.log(this.shop_info);
			this.findBaseSpot();
		},
		methods:{
			previewImage(url){
				uni.previewImage({
					current:url,
					urls:[url]
				})
			},
			getAreaTextInput(e){
				this.reason = e.detail.value;
			},
			cancelClick(){
				this.show_cover = false;
			},
			// -----查看基础展位------
			findBaseSpot(){
				const _this = this;
				const data = {};
				this.$api('index/get_base_spot','POST', data)
				.then(res=>{
					console.log(res)
					if(res.data && res.data.length>0){
						_this.basespot = res.data[0].basespot;
						_this.maxspot = res.data[0].maxspot;
					}
				}).catch(err=>{
					console.log(err);
				})  
			},
			confirmClick(){
				this.show_cover = false;
				if(this.reason){
					const _this = this;
					const data = {
						id:this.shop_info.id,
						checker: this.$store.state.user_info.userid,
						checkphone: this.$store.state.user_info.telephone,
						userid: this.shop_info.userid,
						refusereason:this.reason
					};
					this.$api('index/reject_shop_open','POST', data)
					.then(res=>{
						console.log(res)
						if(res.data.errcode==0){
							uni.showToast({
								title:'拒绝成功',
								success: res =>{
									_this.sendNotify('系统拒绝了你的开店申请');
								},
								fail: err=>{
									throw new Error(err);
								}
							})
						}else{
							uni.showToast({
								title:res.data.errstr
							})
						}
					}).catch(err=>{
						console.log(err);
					})  
				}else{
					uni.showLoading({
						title:'请输入原因',
						icon:'none'
					})
				}
			},
			showCover(){
				this.show_cover = true;
			},
			confirmExamine() {
				const _this = this;
				const data = {
					id:this.shop_info.id,
					basespot:this.basespot,
					maxspot: this.maxspot,
					userid:this.shop_info.userid
				};
				this.$api('index/allow_shop_open','POST', data)
				.then(res=>{
					console.log(res)
					if(res.data.errcode==0){
						uni.showToast({
							title:'通过成功',
							icon:'none',
							success:res=>{
								_this.sendNotify('审核成功');
							}
						})
					}else{
						uni.showToast({
							title:'通过失败',
							icon:'none'
						})
					}
				}).catch(err=>{
					console.log(err);
				})  
			},
			// -- 发送通知 -----
			sendNotify(content){
				const _this = this;
				const data = {
					userid:this.$store.state.user_info.userid,
					secuserid:this.shop_info.userid,
					content:content,
				};
				this.$api('index/send_user_message','POST', data)
				.then(res=>{
					
				}).catch(err=>{
					throw err;
				})  
			}
		}
	}
</script>

<style lang="scss">
.exam-del{
	.exam-del-list{
		padding:0 20upx;
		height:80upx;
		line-height: 80upx;
		justify-content: space-between;
		border-bottom: 1upx solid #bdbdbd;
	}
	.exam-del-lists{
		padding:0 20upx;
		height:120upx;
		line-height: 80upx;
		justify-content: space-between;
		border-bottom: 1upx solid #bdbdbd;
		align-items: center;
		image{
			width:140upx;
			height:100upx;
		}
	}
	map{
		width:100%;
		height:500upx;
	}
	.exam-del-btn{
		width:80%;
		height:80upx;
		line-height: 80upx;
		background-color: #f35;
		border-radius: 40px;
		text-align: center;
		margin:30upx auto 0 auto;
		color:#fff;
		font-size: 30upx;
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
			.cover-content-1{
				height:260upx;
				padding:10px;
				textarea{
					height:100%;
					width:100%;
				}
			}
			.cover-content-2{
				height:80upx;
				line-height: 80upx;
				border-top:1upx solid #bdbdbd;
				background:#f5f5f5;
				justify-content: space-between;
				.cover-content-2-btn{
					width:49.5%;
					background:#fff;
					text-align: center;
				}
			}
		}
	}
}
</style>
