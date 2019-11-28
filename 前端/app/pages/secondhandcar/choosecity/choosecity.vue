<template>
  <view class="demo">
    <ss-select-city :hotCitys="hotCitys" v-model="value" @on-select="onSelect"></ss-select-city>
  </view>
</template>

<script>
  import ssSelectCity from '@/components/ss-select-city/ss-select-city.vue'
  export default {
    data() {
      return {
        hotCitys: ['杭州', '天津', '北京', '上海', '深圳', '广州', '成都', '重庆', '厦门'],
        value: '武汉'
      }
    },
    components: {
      ssSelectCity
    },
    methods: {
      onSelect(city) {
        console.log(city)
		let pages = getCurrentPages();
        let currPage = pages[pages.length-2];
		currPage.city=city;
		uni.navigateBack();
      }
    }
  }
</script>

<style lang="scss" scoped>

</style>
