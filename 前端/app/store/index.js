import Vue from 'vue'
import Vuex from 'vuex'

Vue.use(Vuex)

const store = new Vuex.Store({
	state: {
		extra: false,
		loginProvider: "",
		openid:uni.getStorageSync('openid') && uni.getStorageSync('openid') ? uni.getStorageSync('openid') : '',
		unionid: uni.getStorageSync('unionid') && uni.getStorageSync('unionid') ? uni.getStorageSync('unionid') : '',
		isLogin:false,
		examineInfo:{},
		tousu:{},
		search:'',
		role:uni.getStorageSync('role') && uni.getStorageSync('role')? uni.getStorageSync('role') :'',
		use_info:{},
		base_info:{},
		user_info:uni.getStorageSync('userinfo') && uni.getStorageSync('userinfo').userid ? uni.getStorageSync('userinfo') : {}
	},
	mutations: {
		login(state, provider) {
			state.hasLogin = true;
			state.loginProvider = provider;
		},
		logout(state) {
			state.hasLogin = false
			state.openid = null
		},
		setOpenid(state, openid) {
			state.openid = openid
		},
		updateUserInfo(state,info){
			state.user_info = info;
		},
		updateUserRole(state,role){
			state.role = role;
		}
	},
	actions: {
		// lazy loading openid
		getUserOpenId: async function ({
			commit,
			state
		}) {
			return await new Promise((resolve, reject) => {
				if (state.openid) {
					resolve(state.openid)
				} else {
					uni.login({
						success: (data) => {
							commit('login')
							setTimeout(function () { //模拟异步请求服务器获取 openid
								const openid = '123456789'
								console.log('uni.request mock openid[' + openid + ']');
								commit('setOpenid', openid)
								resolve(openid)
							}, 1000)
						},
						fail: (err) => {
							console.log('uni.login 接口调用失败，将无法正常使用开放接口等服务', err)
							reject(err)
						}
					})
				}
			})
		}
	}
})

export default store
