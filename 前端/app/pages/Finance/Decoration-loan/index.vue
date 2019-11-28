<template>
<view id="main">
	<view id="uheader">
		<view>
			<img id="uheader_img" src="../../../static/loanPages/Insurance-policy.jpg">
			<view id="uheader_txt1" class="htext">
				<text style="font-weight: bold;">装修贷</text>
			</view>
			<view id="uheader_txt2" class="htextm">
				<view class="l">
					贷款额度
				</view>
				<view class="r">
					<text style="font-weight: bold;">最高100万或评估总价7成</text>
				</view>
			</view>
			<view id="uheader_txt3" class="htextm">
				<view class="l">
					月息费率
				</view>
				<view class="r">
					最低6厘
				</view>
				<view class="l">
					贷款期限
				</view>
				<view class="r">
					最长10年 
				</view>
				<view class="l">
					最长十年
				</view>
				<view class="r">
					等额本息
				</view>
			</view>
			<view id="uheader_foot">
				<text style="font-style: italic;">个体、个体户、公司法人皆可<text style="color:#F59A23; font-weight: bold;">贷</text></text>
			</view>
		</view>
	</view>
	<hr>
	<view id="ubody">
		<view class="tig">
			<p>准入条件</p>
		</view>
		<view class="txt">
			<text class="nom" decode="emsp;ensp">
				房产地域：南宁城区包括武鸣
				房产性质：20年内商品房
				低押便捷：接受直系亲属亲属房产抵押
			</text>
		</view>
		<view class="txt23">
			<text class="nom33" decode="emsp;ensp">
				<text class="color">5天</text>放款 
				提前结清不收违约金 
				最长十年无需过桥资金
			</text>
		</view>

	
		
		
	</view>
	
	<hr>
	<view id="ufooter">
			<view class="botm" @tap="carCall">
				<p>致电咨询</p>
			</view>
			<view class="botm">
				<p>我要申请</p>
			</view>
	</view>
</view>
</template>

<script>
	import '../css/Loan.css'
	export default {
		methods:{
			carCall: function(){
				uni.makePhoneCall({
					phoneNumber:'10000'
				})
			}
		}
	}
</script>

<style>
</style>
