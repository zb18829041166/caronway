<template>
	<view class="singlecar">
		<view class="singlecar-base">
			车辆参数
		</view>
		<view class="uni-column singlecar-list">
			<block v-for="(item,index) in carinfo" :key="index">
				<view class="singlecar-content uni-row">
					<view class="singlecar-content-lef">
						{{index}}
					</view>
					<view class="singlecar-content-rig">
						{{item}}
					</view>
				</view>
			</block>
		</view>
		<page-swiper></page-swiper>
	</view>
</template>

<script>
	export default {
		data() {
			return {
				carinfo:{
					'厂商':'一汽奥迪',
					'车系':'奥迪A8',
					'车型':'2.0T自动活力智尚型',
					'级别':'中型车',
					'能源类型':'汽油',
					'上市时间':'2019-03',
					'发动机':'2.0T 150马力 L4',
					'最大功率（kw':'110',
					'最大扭矩（N.m':'270',
	                '变速箱':'7档双离合',
					'长宽高（mm）':'4818*1843*1432',
					'车身结构':'4门5座三厢车',
					'最高车速（km/h）':'205',
					'综合油耗（L/100km）':'5.8',
					'市场热度':'热销',
					'产地':'国产/进口/平行进口车',
					'实际销售价（万元）':'28',
					'新车市场参考价（万元）':'38',
					'行驶里程（万公里）':'2.3',
					'上牌城市':'武汉市',
					'注册日期':'2016.2.2',
					'交强险止期':'2020.3.8',
					'车龄（月）':'37',
					'过户次数':'1',
				},
				saleinfo:{
					'车商名称':'更脑二手车行',
					'联系电话':'13888888888',
					'城市':'武汉市',
					'地址':'天峨县更脑屯更旦街13号',
					'经度':'东经132.32465',
					'纬度':'北纬23.45688',
					'上线时间':'2019-04-25',
					'状态':'上线',
				}
			};
		}
	}
</script>

<style lang="scss" scoped>
  .singlecar{
	  .singlecar-base{
		  height:70upx;
		  line-height: 70upx;
		  padding:0 20upx;
		  background-color:#bdbdbd;
		  color:#000;
		  font-weight: bold;
	   }
	  .singlecar-list{
		 .singlecar-content{
			 justify-content: space-between;
			 border-bottom:1upx solid #bdbdbd;
			 height:70upx;
			 line-height: 70upx;
			 padding:0 20upx;
			 .singlecar-content-lef{
				 
			 }
			 .singlecar-content-rig{
				 
			 }
		 }  
	  }
  }
</style>
