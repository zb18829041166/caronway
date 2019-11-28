<template>
<view id="main">
	<view id="uheader">
		<view>
			<img id="uheader_img" src="../../../static/loanPages/Management.jpg">
			<view id="uheader_txt1" class="htext">
				<text style="font-weight: bold;">经营贷</text>
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
				1、借款人与产权人（房产共有人）之间的关系仅限夫妻/父母/子女
				2、共有人年龄18-60岁
				3、借款人年龄25-55周岁，必须为中国国籍，市区内商品房，房龄小于30年
				4、借款人需为公司法人或者股东身份
				（持有房产证，持证时间大于6个月）
				5、不接受：×别墅/商铺/经济适用房/自建房/等未经过交易过的特殊房产
				6、可接受：全款房，银行按揭贷款房
				7、只限南宁五县七区
			</text>
		</view>
		<view class="tig">
			<p>征信要求 </p>
		</view>
		<view class="txt">
			<text class="nom">
				近两个月有逾期客户/黑户/三个月征信查询次数大于8次不能办理。征信白户不可办理
			</text>
		</view>
		<view class="tig">
			<p>需要材料</p>
		</view>
		<view class="txt">
			<text class="nom" decode="emsp;ensp">
				
				1、身份证，户口本。（所有产权人及配偶均需提供）
				2、房产证，按揭合同，购房合同
				3、银行卡、近6个月还款对账单
				4、婚姻关系证明
				&ensp;&emsp;结婚：结婚证
				&ensp;&emsp;离婚：离婚证、离婚协议
				&ensp;&emsp;再婚：前任的离婚证、离婚协议、现任的结婚证
				5、营业执照、公司或者个人近三个月流水
				    （全款房不需要提供按揭合同以及对账单）
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
