import Vue from 'vue'
import App from './App'

import pageHead from './components/page-head.vue'
import pageFoot from './components/page-foot.vue'
import pageSearch from './components/page-search.vue'
import pageItem from './components/page-item.vue'
import pageScroll from './components/page-scroll.vue'
import pageSwiper from './components/page-swiper.vue'
import pageContent from './components/page-content.vue'
import store from './store'
import request from './common/request'
import AppService from './service/app-service.js'
Vue.config.productionTip = false;
Vue.prototype.$store = store;
Vue.prototype.$api= request.api;
Vue.prototype.$appSvc = AppService;
Vue.prototype.$backgroundAudioData = {
	playing: false,
	playTime: 0,
	formatedPlayTime: '00:00:00'
}
Vue.component('page-head', pageHead)
Vue.component('page-foot', pageFoot)
Vue.component('page-search', pageSearch)
Vue.component('page-item', pageItem)
Vue.component('page-scroll',pageScroll)
Vue.component('page-swiper',pageSwiper)
Vue.component('page-content',pageContent)
App.mpType = 'app'

const app = new Vue({
	store,
	...App
})
app.$mount()
