<template>
<view id="main">
	<view id="uheader">
		<view>
			<img id="uheader_img" src="../../../static/loanPages/Business-license.jpg">
			<view id="uheader_txt1" class="htext">
				<text style="font-weight: bold;">营业执照贷</text>
			</view>
			<view id="uheader_txt2" class="htextm">
				<view class="l">
					贷款额度
				</view>
				<view class="r">
					<text style="font-weight: bold;">最高50万，可续贷</text>
				</view>
			</view>
			<view id="uheader_txt3" class="htextm">
				<view class="l">
					月息费率
				</view>
				<view class="r">
					8厘-1.3分
				</view>
				<view class="l">
					贷款期限
				</view>
				<view class="r">
					12个月
				</view>
				<view class="l">
					还款方式
				</view>
				<view class="r">
					先息后本
				</view>
			</view>
			<view id="uheader_foot">
				<text style="font-style: italic;">实体经营店或公司皆可<text style="color:#F59A23; font-weight: bold;">贷</text></text>
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
				营业执照满一年的南宁市实体经营店或公司（个体商户可做）
			</text>
		</view>
		<view class="tig">
			<p>需要材料</p>
		</view>
		<view class="txt">
			<text class="nom">
				1、法人征信报告良好
				2、房户口本及复印件
				3、结婚证及婚姻证明
				4、最近半年流水
				5、居住证明（有房在南宁或南宁本户口不用）
			</text>	
		</view>
		<view class="txt">
			<text class="black">
				备注：\n
			</text>
			<text class="nom">
				1、医药产品、农产品、五金加工厂、烟酒销售类的月息8-9厘；其他产业类月息1.3分
				2、10天左右下款
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
