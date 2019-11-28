<template>
<view id="main">
	<view id="uheader">
		<view>
			<img id="uheader_img" src="../../../static/loanPages/House-property1.jpg">
			<view id="uheader_txt1" class="htext">
				<text style="font-weight: bold;">房产-押贷</text>
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
					最长20年
				</view>
				<view class="l">
					还款方式
				</view>
				<view class="r">
					等额本息 
				</view>
			</view>
			<view id="uheader_foot">
				<text style="font-style: italic;">有房者皆可<text style="color:#F59A23; font-weight: bold;">贷</text></text>
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
				1、借款人：南宁做生意（有股份就行）
				2、抵押物类型：商品房，接受直系亲属和朋友房产抵押
				3、借款人、配偶及房产共有人年龄在18~65周岁
				4、房产地域：南宁城区，包括武鸣
			</text>
		</view>
		<view class="txt">
			<text class="black">
				备注：\n
			</text>
			<text class="nom">
				1、提前还款不收违约金
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
