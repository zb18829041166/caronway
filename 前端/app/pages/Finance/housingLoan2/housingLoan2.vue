<template>
<view id="main">
	<view id="uheader">
		<view>
			<img id="uheader_img" src="../../../static/loanPages/House-property2.jpg">
			<view id="uheader_txt1" class="htext">
				<text style="font-weight: bold;">房产-二押贷</text>
			</view>
			<view id="uheader_txt2" class="htextm">
				<view class="l">
					贷款额度
				</view>
				<view class="r">
					<text style="font-weight: bold;">单人最高20万  夫妻最高40万</text>
				</view>
			</view>
			<view id="uheader_txt3" class="htextm">
				<view class="l">
					月息费率
				</view>
				<view class="r">
					0.78%
				</view>
				<view class="l">
					贷款期限
				</view>
				<view class="r">
					5年（60期）
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
				1、年龄：20-60岁
				2、工作和居住范围范围：南宁七区五县（宾阳、武鸣）
				3、南宁七区商品房，自建房，全款房或按揭房，按揭房征信体现按揭即可，抵押贷别墅不做。
				4、单套房产面积≥60平方、单套房产总价≥30万、房龄≤20年
			</text>
		</view>
		<view class="tig">
			<p>征信要求 </p>
		</view>
		<view class="txt">
			<text class="nom" decode="emsp;ensp;">
				1、房贷半年之内≤1，无M2记录；近1年之内M1≤3
				2、近12个月内无M2，五级分类只能是正常
				3、查询次数：一个月≤5次，两个月≤9次（贷款审批，信用卡审批）
				4、半年之内不能有两笔信用贷款，（可以结清走豁免，同一家机构算一笔）三个月内不能有大于等于5万的信用类贷款
				5、有农户贷的半年内不能有任何逾期。
				6、信用卡要求
				&ensp;&emsp;① 信用卡使用率超80%，授信总额大于不能大于20万
				&ensp;&emsp;② 信用卡使用超90%的，征信近三个月之内不能有逾期
				&ensp;&emsp;③ 信用卡使用超100%，近三个月不能有信用类贷款
			</text>
		</view>
		<view class="tig">
			<p>需要材料 </p>
		</view>
		<view class="txt" style="width:300upx ;margin: 0px;">
			<text class="nom">
				1、身份证 
				2、户口本
				3、结婚证/离婚证 
				4、中国银行卡 
				5、征信 
				6、房产证/购房合同 
				7、按揭合同 
				8、保单
			</text>
		</view>
		<view class="txt" style="width:300upx ;margin: 0px;">
			<text class="nom">
				9、近三个月通话详单 
				10、产调
				11、单位工商网截图 
				12、装修合同（超10万）
				13、账户关联卡、中行卡近一个月流水
				14、收入证明
			</text>
		</view>
		<view class="txt">
			<text class="black">
				备注：\n
			</text>
			<text class="nom">
				1、不电核
				2、提前还款违约金：剩余本金2%
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
