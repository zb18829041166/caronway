<template>
<view id="main">
	<view id="uheader">
		<view>
			<img id="uheader_img" src="../../../static/loanPages/Enterprise-procurement.jpg">
			<view id="uheader_txt1" class="htext">
				<text style="font-weight: bold;">企业采购中标贷</text>
			</view>
			<view id="uheader_txt2" class="htextm">
				<view class="l">
					贷款额度
				</view>
				<view class="r">
					<text style="font-weight: bold;">100-3000千万</text>
				</view>
			</view>
			<view id="uheader_txt3" class="htextm">
				<view class="l">
					月息费率
				</view>
				<view class="r">
					综合年化9%
				</view>
				<view class="l">
					贷款期限
				</view>
				<view class="r">
					1-5年
				</view>
				<view class="l">
					还款方式	
				</view>
				<view class="r">

					<view style="height:25upx;font-size:25upx;line-height: 25upx;">先息后本，</view>
					<view style="height:25upx;font-size:25upx;line-height: 25upx;">按月/季付息、到期还本</view> 
					</text>
				</view>
			</view>
			<view id="uheader_foot">
				<text style="font-style: italic; font-size: 38upx;">广西区内政府采购项目(财政拨款)皆可<text style="color:#F59A23; font-weight: bold;">贷</text></text>
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
				1、借款人为政府采购中标供应商，具有履行合同所必需的设备和服务能力
				2、企业成立2（含）年以上，且实际控制人有3年以上实际行业经验，具有良好的纳税记录、工商登记记录；有固定的经营场所，具有独立承担民事责任的能力；生产经营符合国家法律法规、产业政策和环境保护要求，符合信贷政策
				3、人行征信信息查询系统查询显示企业法人、法定代表人、主要经营者无重大不良记录；政府采购履约行为无不良记录
			</text>
		</view>
		<view class="txt">
			<text class="black">
				备注：\n
			</text>
			<text class="nom">
				1、融资额度按照中标总金额的60%～70%。放款额度100-3000千万。具体额度看企业负债情况而定
				2、需中标有广西区内政府采购项目(财政拨款)类型
				3、材料齐全15个工作日左右放款
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
