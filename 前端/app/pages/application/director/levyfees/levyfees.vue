<template>
	<view class="levyfees">
		<view class="levyfees-header">
			<view class="uni-row">
				<view class="levyfees-header-list" :class="flag==0?'isActive':''" @click="selectFlag(0)">
					即将到期
				</view>
				<view class="levyfees-header-list" :class="flag==1?'isActive':''" @click="selectFlag(1)">
					已到期
				</view>
			</view>
		</view>
		<view class="levyfees-neardate" v-if="flag==0">
			1
		</view>
		<view class="levyfees-overdate" v-else>
			2
		</view>
	</view>
</template>

<script>
	export default {
		data() {
			return {
				flag:0,
			};
		},
		methods:{
			selectFlag(id){
				this.flag = id;
			}
		}
	}
</script>

<style lang="scss">
.levyfees{
	.levyfees-header{
		position: fixed;
		left:0;
		top:90upx;
		width:100%;
		height:100upx;
		line-height: 100upx;
		background:#fff;
		.levyfees-header-list{
			width:50%;
			text-align: center;
			font-size: 34upx;
		}
		.isActive{
			color:red;
			background:#f5f5f5;
			border-bottom:3upx solid red;
		}
	}
	.levyfees-neardate{
		margin-top:116upx;
		background:#fff;
	}
	.levyfees-overdate{
		margin-top:116upx;
		background:#fff;
	}
}

</style>
