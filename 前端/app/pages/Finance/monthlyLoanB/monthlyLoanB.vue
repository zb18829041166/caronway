<template>
<view id="main">
	<view id="uheader">
		<view>
			<img id="uheader_img" src="../../../static/loanPages/monthlyLoanA.svg">
			<view id="uheader_txt1" class="htext">
				<text style="font-weight: bold;">月供贷B</text>
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
					0.73%-1.14%
				</view>
				<view class="l">
					贷款期限
				</view>
				<view class="r">
					3年（36期） 
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
				1、年龄：20-60岁
				2、工作和居住范围范围：南宁七区五县
				3、房产：商品房，商铺，商住两用，自建房（要按揭在四大行）
				4、按揭房月供满6个月，商铺、商住两用要按揭满1年。
			</text>
		</view>
		<view class="tig">
			<p>征信要求 </p>
		</view>
		<view class="txt">
			<text class="nom" decode="emsp;ensp">
				1、房贷半年之内≤1，无M2记录；近1年之内M1≤3
				2、近12个月内无M2，五级分类只能是正常
				3、查询次数：一个月≤5次，两个月≤9次（贷款审批，信用卡审批）
				4、半年之内不能有两笔信用贷款，（可以结清走豁免，同一家机构算一笔）三个月内不能有大于等于5万的信用类贷款
				5、有农户贷的半年内不能有任何逾期。
				6、信用卡要求
				&ensp;&emsp; ① 信用卡使用率超80%，授信总额大于不能大于20万
				&ensp;&emsp; ② 信用卡使用超90%的，征信近三个月之内不能逾期
				&ensp;&emsp; ③ 信用卡使用超100%，近三个月不能有信用类贷款
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
