<template>
<view id="main">
	<view id="uheader">
		<view>
			<img id="uheader_img" src="../../../static/loanPages/Provident-fund.jpg">
			<view id="uheader_txt1" class="htext">
				<text style="font-weight: bold;">公积金贷</text>
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
				<text style="font-style: italic;">连续缴纳公积金一年以上的皆可<text style="color:#F59A23; font-weight: bold;">贷</text></text>
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
				1、 年龄在21周岁（含）以上、55周岁（含）以下，有完全民事行为能力的中国公民（不含港澳台居民）。借款人需在广西区内工作、生活、经营
				2、 有公积金的
				3、 借款人需在当前工作单位连续工作一年以上（含）
				4、借款人征信查询次数三个月6次、半年9次，逾期没有连3次、累计不超过6次，没有当前逾期，没有涉诉，消费类贷款不超过三次
				5、 需要具有稳定的收入来源，具有能按时足额偿还贷款本息的能力
				6、 借款人如为受薪人士的，借款人本人无涉诉信息；借款人为自雇人士的，借款人及其经营机构无涉诉信息
			</text>
		</view>
		<view class="tig">
			<p>申请材料 </p>
		</view>
		<view class="txt">
			<text class="nom" decode="emsp;ensp">
				1、公积金缴纳单位及实际工作单位一致
				2、借款人住房公积金需连续缴纳满一年以上，目前处于断缴或封存状态的不接受此贷款品种申请
				3、借款人需提供的材料：
				&ensp;&emsp;①身份证
				&ensp;&emsp;②户口本（首页、户主页及本人页） 
				&ensp;&emsp;③ 结婚证或未婚声明
				&ensp;&emsp;④一年以上公积金缴存证明
				&ensp;&emsp;⑤其他认为有必要的材料
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
