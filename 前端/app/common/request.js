const baseUrl = "http://www.caronway.cn/v1/"
//const baseUrl = "http://localhost:8084/"
const api = function(url,method="GET",data={}){
	url = baseUrl+url;
	return new Promise((resolve,reject)=>{
		uni.request({
			url,
			method,
			data,
			//dataType:'json',
			// xhrFields: {
			// 	'withCredentials': true,
			// },
			// crossDomain: true,
			header:{
				'content-type': method == 'GET'? 'application/json' : 'application/x-www-form-urlencoded',
			},
			success:res => {
				resolve(res);
			},
			fail:err => {
				reject(err);
			}
		})
	})
}
module.exports = {
	api
}