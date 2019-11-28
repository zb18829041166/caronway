<template>
	<view class="frame">
		<view id="shouye" >
			<view style="padding-top: 70rpx;font-size: 80rpx;color: #FFFFFF;">
				车行路上 金融
			</view>
		</view>
		<view style="width: 100%;height: 680rpx;background-color: #FFFFFF;" >
			<view class="kong" style="background: url(../../static/loanPages/Insurance-policy.jpg);background-size: cover; "  @click="gomonthlyLoanA()">
				<button   class="mokuai" >
					<view style="height: 100%;">
						<view class="" style="height: 60%;">
							<view class="jin">
								<text style="color: #FFCC33;">
									20万
								</text>
							</view>
							<view class="jin1">
								<text class="style32">
									月供贷A
								</text>
							</view>
						</view>
					</view>
				</button>
			</view>
			<view class="kong" style="background: url(../../static/loanPages/Insurance-policy.jpg);background-size: cover;"  @click="gomonthlyLoanB()">
				<button   class="mokuai">
					<view style="height: 100%;">
						<view class="" style="height: 60%;">
							<view class="jin">
								<text style="color: #FFCC33;">
									40万
								</text>
							</view>
							<view class="jin1">
								<text class="style32">
									月供贷B
								</text>
							</view>
						</view>
					</view>
				</button>
			</view>
			<view class="kong" style="background: url(../../static/loanPages/Insurance-policy.jpg);background-size: cover;"  @click="goProvidentfundloan()">
				<button   class="mokuai">
					<view style="height: 100%;">
						<view class="" style="height: 60%;">
							<view class="jin">
								<text style="color: #FFCC33;">
									20万
								</text>
							</view>
							<view class="jin1">
								<text class="style32">
									公积金贷
								</text>
							</view>
						</view>
					</view>
				</button>
			</view>
			<view class="kong" style="background: url(../../static/loanPages/Renovation.jpg);background-size: cover;"   @click="goDecorationloan()">
				<button   class="mokuai">
					<view style="height: 100%;">
						<view class="" style="height: 60%;">
							<view class="jin">
								<text style="color: #FFCC33;">
									100万
								</text>
							</view>
							<view class="jin1">
								<text class="style32">
									装修贷
								</text>
							</view>
						</view>
					</view>
				</button>
			</view>
			<view class="kong" style="background: url(../../static/loanPages/House-property1.jpg);background-size: cover;" @click="gohousingLoan1()">
				<button   class="mokuai">
					<view style="height: 100%;">
						<view class="" style="height: 60%;">
							<view class="jin">
								<text style="color: #FFCC33;">
									100万
								</text>
							</view>
							<view class="jin1">
								<text class="style32">
									房产-押贷
								</text>
							</view>
						</view>
					</view>
				</button>
			</view>
			<view class="kong" style="background: url(../../static/loanPages/House-property2.jpg);background-size: cover;" @click="gohousingLoan2()">
				<button   class="mokuai">
					<view style="height: 100%;">
						<view class="" style="height: 60%;">
							<view class="jin">
								<text style="color: #FFCC33;">
									40万
								</text>
							</view>
							<view class="jin1">
								<text class="style32">
									房产-二押
								</text>
							</view>
						</view>
					</view>
				</button>
			</view>
			<view class="kong" style="background: url(../../static/loanPages/Management.jpg);background-size: cover;" @click="goBusinessloan()">
				<button   class="mokuai">
					<view style="height: 100%;">
						<view class="" style="height: 60%;">
							<view class="jin">
								<text style="color: #FFCC33;">
									500万+
								</text>
							</view>
							<view class="jin1">
								<text class="style32">
									经营贷
								</text>
							</view>
						</view>
					</view>
				</button>
			</view>
			<view class="kong" style="background: url(../../static/loanPages/Business-license.jpg);background-size: cover;" @click="goBusinesslicenseloan()">
				<button   class="mokuai">
					<view style="height: 100%;">
						<view class="" style="height: 60%;">
							<view class="jin">
								<text style="color: #FFCC33;">
									50万
								</text>
							</view>
							<view class="jin1">
								<text class="style32">
									营业执照贷
								</text>
							</view>
						</view>
					</view>
				</button>
			</view>
			<view class="kong" style="background: url(../../static/loanPages/Insurance-policy.jpg);background-size: cover;" @click="goPurchasewinningloan()">
				<button   class="mokuai">
					<view style="height: 100%;">
						<view class="" style="height: 60%;">
							<view class="jin">
								<text style="color: #FFCC33;">
									1000万
								</text>
							</view>
							<view class="jin1">
								<text class="style32">
									采购中标贷
								</text>
							</view>
						</view>
					</view>
				</button>
			</view>
			<view class="kong" style="background: url(../../static/loanPages/Enterprise-tax.jpg);background-size: cover;" @click="goEnterprisetaxloanA()">
				<button   class="mokuai">
					<view style="height: 100%;">
						<view class="" style="height: 60%;">
							<view class="jin">
								<text style="color: #FFCC33;">
									500万+
								</text>
							</view>
							<view class="jin1">
								<text class="style32">
									企业税务贷A
								</text>
							</view>
						</view>
					</view>
				</button>
			</view>
			<view class="kong" style="background: url(../../static/loanPages/Enterprise-tax.jpg);background-size: cover;" @click="goEnterprisetaxloanB()">
				<button   class="mokuai">
					<view style="height: 100%;">
						<view class="" style="height: 60%;">
							<view class="jin">
								<text style="color: #FFCC33;">
									年缴税金8倍
								</text>
							</view>
							<view class="jin1">
								<text class="style32">
									企业税务贷B
								</text>
							</view>
						</view>
					</view>
				</button>
			</view>
			<view class="kong" style="background: url(../../static/loanPages/Enterprise-tax.jpg);background-size: cover;"  @click="goPolicyloan()">
				<button   class="mokuai">
					<view style="height: 100%;">
						<view class="" style="height: 60%;">
							<view class="jin">
								<text style="color: #FFCC33;">
									40万
								</text>
							</view>
							<view class="jin1">
								<text class="style32">
									保单贷
								</text>
							</view>
						</view>
					</view>
				</button>
			</view>
			
		
		</view>
		
		<view style="width: 100%;height: 150rpx;margin-top: 40rpx;background-color: #FFFFFF;">
			<button class="ziti33">
				<view class="ziti333">
					<image class="tu" src="../../static/Repair.png" ></image>
				</view>
				<view class="ziti1" @click="goCallPhone()">咨询（更多产品）</view>
			</button>
			<button class="ziti33">
				<view class="ziti333">
					<image class="tu" src="../../static/Repair.png" ></image>
				</view>
				<view class="ziti1" >在线申请</view>
			</button>
		</view>
	
		<view style="width: 100%;height: 400rpx;margin-top: 40rpx;background-color: #FFFFFF;">
			<text>个人贷</text>
			<hr>
			<view class="kong" style="background: url(../../static/loanPages/Insurance-policy.jpg);background-size: cover;" @click="gomonthlyLoanA()">
				<button   class="mokuai2">
					<view style="height: 100%;">
						<view class="" style="height: 60%;">
							<view class="jin2">
								<text class="style33">
									月供贷A
								</text>
							</view>
						</view>
					</view>
				</button>
			</view>
			<view class="kong" style="background: url(../../static/loanPages/Insurance-policy.jpg);background-size: cover;" @click="gomonthlyLoanB()">
				<button  class="mokuai2">
					<view style="height: 100%;">
						<view class="" style="height: 60%;">
							<view class="jin2">
								<text class="style33">
									月供贷B
								</text>
							</view>
						</view>
					</view>
				</button>
			</view>
			<view class="kong" style="background: url(../../static/loanPages/Insurance-policy.jpg);background-size: cover;" @click="goProvidentfundloan()" >
				<button  class="mokuai2">
					<view style="height: 100%;">
						<view class="" style="height: 60%;">
							<view class="jin2">
								<text class="style33">
									公积金贷
								</text>
							</view>
						</view>
					</view>
				</button>
			</view>
			<view class="kong" style="background: url(../../static/loanPages/Renovation.jpg);background-size: cover;"  @click="goDecorationloan()">
				<button class="mokuai2">
					<view style="height: 100%;">
						<view class="" style="height: 60%;">
							<view class="jin2">
								<text class="style33">
									装修贷
								</text>
							</view>
						</view>
					</view>
				</button>
			</view>
			<view class="kong" style="background: url(../../static/loanPages/House-property1.jpg);background-size: cover;" @click="gohousingLoan1()">
				<button  class="mokuai2">
					<view style="height: 100%;">
						<view class="" style="height: 60%;">
							<view class="jin2">
								<text class="style33">
									房产-押贷
								</text>
							</view>
						</view>
					</view>
				</button>
			</view>
			<view class="kong" style="background: url(../../static/loanPages/House-property2.jpg);background-size: cover;" @click="gohousingLoan2()">
				<button  class="mokuai2">
					<view style="height: 100%;">
						<view class="" style="height: 60%;">
							<view class="jin2">
								<text class="style33">
									房产-二押
								</text>
							</view>
						</view>
					</view>
				</button>
			</view>
		</view>
	
		<view style="width: 100%;height: 400rpx;margin-top: 40rpx;background-color: #FFFFFF;">
			<text>企业贷</text>
			<hr>
			<view class="kong" style="background: url(../../static/loanPages/Management.jpg);background-size: cover;" @click="goBusinessloan()" >
				<button  class="mokuai2">
					<view style="height: 100%;">
						<view class="" style="height: 60%;">
							<view class="jin2">
								<text class="style33">
									经营贷
								</text>
							</view>
						</view>
					</view>
				</button>
			</view>
			<view class="kong" style="background: url(../../static/loanPages/Business-license.jpg);background-size: cover;"  @click="goBusinesslicenseloan()">
				<button  class="mokuai2">
					<view style="height: 100%;">
						<view class="" style="height: 60%;">
							<view class="jin2">
								<text class="style33">
									营业执照贷
								</text>
							</view>
						</view>
					</view>
				</button>
			</view>
			<view class="kong" style="background: url(../../static/loanPages/Enterprise-procurement.jpg);background-size: cover;"  @click="goPurchasewinningloan()">
				<button class="mokuai2">
					<view style="height: 100%;">
						<view class="" style="height: 60%;">
							<view class="jin2">
								<text class="style33">
									采购中标贷
								</text>
							</view>
						</view>
					</view>
				</button>
			</view>
			<view class="kong" style="background: url(../../static/loanPages/Insurance-policy.jpg);background-size: cover; " @click="goEnterprisetaxloanA()">
				<button class="mokuai2">
					<view style="height: 100%;">
						<view class="" style="height: 60%;">
							<view class="jin2">
								<text class="style33">
									企业税务贷A
								</text>
							</view>
						</view>
					</view>
				</button>
			</view>
			<view class="kong" style="background: url(../../static/loanPages/Enterprise-tax.jpg);background-size: cover;"  @click="goEnterprisetaxloanB()">
				<button class="mokuai2">
					<view style="height: 100%;">
						<view class="" style="height: 60%;">
							<view class="jin2">
								<text class="style33">
									企业税务贷B
								</text>
								
							</view>
						</view>
					</view>
				</button>
			</view>
			<view class="kong" style="background: url(../../static/loanPages/Insurance-policy.jpg);background-size: cover;" @click="goPolicyloan()" >
				<button class="mokuai2">
					<view style="height: 100%;">
						<view class="" style="height: 60%;">
							<view class="jin2 ">
								<text class="style33">
									保单贷
								</text>
							</view>
						</view>
					</view>
				</button>
			</view>
		</view>
	
		<view style="width: 100%;height: 60rpx;background-color: #4CD964;text-align: center;">
			<view style="width: 34%;height: 100%;background-color: pink;float: left;" @click="gohome()">
				首页
			</view>
			<view style="width: 33%;height: 100%;background-color: pink;float: left;">
				会员车
			</view>
			<view style="width: 33%;height: 100%;background-color: pink;float: left;">
				会员
			</view>
		</view>
	</view>
</template>

<script>
	export default {
		data() {
			return {
				title: 'Hello'
			}
		},
		methods: {
		
		goPolicyloan()
		{
			uni.navigateTo({
				url:'../Finance/Policy-loan/index',
			})
		},
		goEnterprisetaxloanB()
		{
			uni.navigateTo({
				url:'../Finance/Enterprise-tax-loan-B/index',
			})
		},
		goCallPhone() 
		{
			uni.makePhoneCall({
				phoneNumber:'13986007724'
			})
		},
		gomonthlyLoanA()
		{
			uni.navigateTo({
				url:'../Finance/monthlyLoanA/monthlyLoanA',
			})
		},
		gomonthlyLoanB()
		{
			uni.navigateTo({
				url:'../Finance/monthlyLoanB/monthlyLoanB',
			})
		},
		goBusinesslicenseloan()
		{
			uni.navigateTo({
				url:'../Finance/Business-license-loan/index',
			})
		},
		goBusinessloan()
		{
			uni.navigateTo({
				url:'../Finance/Business-loan/index',
			})
		}, 
		goEnterprisetaxloanA()
		{
			uni.navigateTo({
				url:'../Finance/Enterprise-tax-loan-A/index',
			})
		},
		goPurchasewinningloan()
		{
			uni.navigateTo({
				url:'../Finance/Purchase-winning-loan/index',
			})
		},
		gohousingLoan2()
		{
			uni.navigateTo({
				url:'../Finance/housingLoan2/housingLoan2',
			})
		},
		gohousingLoan1()
		{
			uni.navigateTo({
				url:'../Finance/housingLoan1/housingLoan1',
			})
		},
		goDecorationloan()
		{
			uni.navigateTo({
				url:'../Finance/Decoration-loan/index',
			})
		},
		goProvidentfundloan()
		{
			uni.navigateTo({
				url:'../Finance/Provident-fund-loan/index',
			})
		},
		gohome()
		{
			uni.navigateTo({
				url:'../index/index',
			})
		}
		}
	}
</script>

<style>
	#shouye
	{
		width: 100%;
		height: 300rpx;
		text-align: center;
		background: url(../../static/index1.jpg);
		background-size: cover;
	}
	.mokuai
	{
		height: 60%;
		margin-top: 12%;
		background: #808080;
		 opacity: 0.85; 
	}
	.style33
	{
		font-size: 30rpx;
		color: #FFFFFF;
	}
	.style32
	{
		font-size: 26rpx;
		color: #FFFFFF;
	}
	.mokuai2
	{
		height: 50%;
		margin-top: 18%;
		background: #808080;
		opacity: 0.85;
	}
	.ziti33
	{
		width: 45%;
		height: 50%;
		float: left;
		margin-top:5% ;
		margin-left: 3.3%;
		background-color: #007AFF;
	}
	.ziti333
	{
		width: 25%; 
		height: 80%;
		float: left;
		padding-top: 10rpx;
	}
	.frame
	{
		background-color: #E5E5E5;
		width: 100%;
		height: 100%;
	}
	#tu1
	{
		opacity: 0.85;
		width: 100%;
		height: 100%;
		
	}
	.kong
	{
		border-radius: 15%;
		margin-top: 30rpx;
		margin-left: 4%;
		float: left;
		width: 28%;
		height: 130rpx;
	}
	.jin
	{
		height: 50%;
		font-size: 24rpx;
	}
	.jin1
	{
		height: 50%;
		font-size: 25rpx;
		height: 50%;
		margin-top: 0rpx;
	}
	.jin2
	{
		margin-top: -4rpx;
		font-size: 2rpx;
	}
	.tu
	{
			width: 80%;
			height: 100%;
			float: left;
	}
	.ziti1
	{
		margin-top: 3rpx;
		font-size: 26rpx;
		text-align: left;
		flex-direction: column;
		text-align: center;
	} 
	.kong2
	{
		
		border-radius: 12%;
		margin-top: 30rpx;
		margin-left: 2.4%;
		float: left;
		width: 22%;
		height: 110rpx;
	}
</style>
