<template>
<view id="main">
	<view id="uheader">
		<view>
			<img id="uheader_img" src="../../../static/loanPages/monthlyLoanA.svg">
			<view id="uheader_txt1" class="htext">
				<text style="font-weight: bold;">月供贷A</text>
			</view>
			<view id="uheader_txt2" class="htextm">
				<view class="l">
					贷款额度
				</view>
				<view class="r">
					<text style="font-weight: bold;">3万 — 20万</text>
				</view>
			</view>
			<view id="uheader_txt3" class="htextm">
				<view class="l">
					月息费率
				</view>
				<view class="r">
					0.66%-0.69%
				</view>
				<view class="l">
					贷款期限
				</view>
				<view class="r">
					36个月 
				</view>
				<view class="l">
					等额本息 
				</view>
				<view class="r">
					先息后本/等额本息
				</view>
			</view>
			<view id="uheader_foot">
				<text style="font-style: italic;">有月供者皆可<text style="color:#F59A23; font-weight: bold;">贷</text></text>
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
				1、借款人须为银行按揭贷款的借款人，年龄在21~55周岁
				2、借款人须在广西区内生活及开展工作
				3、自雇人士：经营企业的经营范围不涉及禁入及敏感行业；
				4、受薪人士：具有稳定的、按时足额偿还贷款本息的能力
			</text>
		</view>
		<view class="tig">
			<p>征信要求 </p>
		</view>
		<view class="txt">
			<text class="nom">
				征信条件查询次数三个月6次、半年9次，逾期没有连3次、累计不超过6次，没有当前逾期，没有涉诉，消费类贷款不超过三次
			</text>
		</view>
		<view class="tig">
			<p>申请材料</p>
		</view>
		<view class="txt">
			<text class="nom">
				1、身份证
				2、户口本
				3、婚姻证明
				4、购房合同或房产证
				5、按揭还款流水
			</text>
		</view>
		<view class="tig">
			<p>服务费用</p>
		</view>
		<view class="txt">
			<text class="nom">
				1、履约险2.5%
				2、人身意外险0.3% 
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
