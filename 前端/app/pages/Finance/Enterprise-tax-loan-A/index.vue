<template>
<view id="main">
	<view id="uheader">
		<view>
			<img id="uheader_img" src="../../../static/loanPages/Enterprise-tax.jpg">
			<view id="uheader_txt1" class="htext">
				<text style="font-weight: bold;">企业税务贷A</text>
			</view>
			<view id="uheader_txt2" class="htextm">
				<view class="l">
					贷款额度
				</view>
				<view class="r">
					<text style="font-weight: bold;">1-500万以上</text>
				</view>
			</view>
			<view id="uheader_txt3" class="htextm">
				<view class="l">
					月息费率
				</view>
				<view class="r">
					0.63%-0.86%
				</view>
				<view class="l">
					贷款期限
				</view>
				<view class="r">
					12个月/36个月
				</view>
				<view class="l">
					还款方式
				</view>
				<view class="r">
					先息后本/等额本息
				</view>
			</view>
			<view id="uheader_foot">
				<text style="font-style: italic;">企业法或个体工商户皆可<text style="color:#F59A23; font-weight: bold;">贷</text></text>
			</view>
		</view>
	</view>
	<hr>
	<view id="ubody">
		<view class="tig">
			<p>准入条件</p>
		</view>
		<view class="txt">
			<text class="nom">
				1、企业法定代表人或个体工商户经营者
				2、贷款人年龄为23（含）～60（不含）周岁，具有完全民事行为能力
				3、企业正常缴税两年及以上，纳税评级B级及以上，无不良信用记录
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
