<template name="uni-upload">
	<view class="uni-upload">
		<view class="uni-upload-content">
			
		</view>
	</view>
</template>

<script>
	export default {
		name:'uni-upload',
		data() {
			return {
				
			};
		},
		props:{
			imgurl:{
				type:String,
				default:''
			}
		},
		methods:{
			chooseImage(){
				const img_path = this.imgurl;
				wx.getImageInfo({
						src: img_path,  
						success: function(res){
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
		}
	}
</script>

<style lang="scss">
.uni-upload{
	width:100%;
	height:100%;
	position: fixed;
	left:0;
	top:0;
	// background: rgba($color: #999999, $alpha: .5);
	background: #000;
	opacity: 0.6;
	z-index: 999;
	.uni-upload-content{
		width:80%;
		height:400upx;
		background:#fff;
		position: fixed;
		left:50%;
		top:50%;
		transform:translateX(-50%) translateY(-50%);
		z-index: 9999;
	}
}
</style>
