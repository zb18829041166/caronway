<template>
	<view class="">
		<view class="map-content">
			<!-- <map :latitude="latitude" :longitude="longitude" :circles="circles"></map> -->
		</view>
		<view class="upload-img" @click="chooseImage">
			上传图片
		</view>
		<canvas canvas-id="fillimg"></canvas>
	</view>
	
</template>

<script>
	export default {
		data() {
			return {
				latitude:'',
				longitude:'',
				address:'',
				circles:[{
				   latitude:this.latitude,
				   longitude:this.longitude,
				   color:"red",
				   fillColor:'#bdbdbd',
				   radius:20,
				   strokeWidth:20
				}]
			};
		},
		onLoad() {
// 			uni.chooseLocation({
// 				success:res=> {
// 					console.log(res);
// 					this.latitude = res.latitude,
// 					this.longitude = res.longitude,
// 					this.address = res.name
// 				}
// 			}) 
		},
		methods: {
			chooseImage(){
				const that = this;
				wx.chooseImage({
					success: res=> {
						const img_path = res.tempFilePaths[0];
						wx.getImageInfo({
								src: img_path,  
								success: function(res){
								//---------利用canvas压缩图片--------------
								var ratio = 2;
								var canvasWidth = res.width //图片原始长宽
								var canvasHeight = res.height
								while (canvasWidth > 400 || canvasHeight > 400){// 保证宽高在400以内
									canvasWidth = Math.trunc(res.width / ratio)
									canvasHeight = Math.trunc(res.height / ratio)
									ratio++;
								}
							    that.cWidth = canvasWidth;
								that.cWidth = canvasHeight;
								//----------绘制图形并取出图片路径--------------
								var ctx = wx.createCanvasContext('fillimg')
								ctx.drawImage(res.path, 0, 0, canvasWidth, canvasHeight)
								ctx.draw(false, setTimeout(function(){
									 wx.canvasToTempFilePath({
										 canvasId: 'fillimg',
										 destWidth: canvasWidth,
										 destHeight: canvasHeight,
										 success: function (res) {
											 console.log('res',
											 res.tempFilePath)//最终图片路径
										 },
										 fail: function (res) {
											 console.log(res.errMsg)
										}
									})
								},100))    //留一定的时间绘制canvas
					        }
			            })
			        },
				})
			},
			uploadImage() {
				wx.uploadFile({
					filePath:'',
					name:'',
				})
			}
			
		}
		
		
	}
</script>

<style lang="scss">
  .map-content{
	  width:750upx;
	  height:780upx;
	  map{
		  width:750upx;
		  height:780upx;
	  }
  }
</style>
