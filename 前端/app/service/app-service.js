const { api } = require('./http-service');

class AppService {
	constructor() {
	    
	}
	getLoactionUrlData(url){
		if(url && url.split('?')){
			const arr = url.split('?');
			const result = {};
			if(arr[1]){
				const data = arr[1].split('&');
				for(let i = 0;i<data.length;i++){
					result[data[i].split('=')[0]] = data[i].split('=')[1];
				}
			}
			return result;
		}
		else{
			return {
				openid:''
			}
		}
	}
	goCurrentPage(url) {
	   if(url) {
		   if(url == 'second') {
			   uni.redirectTo({
			   	 url:'../secondhandcar/index/index'
			   })
		   }else if(url == 'person') {
			   uni.redirectTo({
			   	 url:'../application/index/index'
			   })
		   }else if(url == 'newcar') {
			   uni.redirectTo({
			   	 url:'../newcar/index'
			   })
		   }else if( url == 'openshop') {
			   uni.redirectTo({
			   	 url:'../openshop/shoplist/shoplist'
			   })
		   }
	   }	
	}
	makeCallPhone(number) {
		uni.makePhoneCall({
			phoneNumber:number
		})
	}
}
module.exports = new AppService();
