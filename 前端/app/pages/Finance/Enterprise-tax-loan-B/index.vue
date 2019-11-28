<template>
<view id="main">
	<view id="uheader">
		<view>
			<img id="uheader_img" src="../../../static/loanPages/Enterprise-tax.jpg">
			<view id="uheader_txt1" class="htext">
				<text style="font-weight: bold;">企业税务贷B</text>
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
				1、公司需要两年以上，年交税达到2万元
				2、非建行产品，不用开对公账户也可办理
			</text>
		</view>
		<view class="tig">
			<p>需要材料</p>
		</view>
		<view class="txt">
			<text class="nom">
				1、公司营业执照
				2、法人或股东征信
				3、税务证明
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
