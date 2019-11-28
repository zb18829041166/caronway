//   uploadImages(type){
			// 	const _this = this;
			//     const openid = this.$store.state.openid;
			// 	const data={openid:openid};
			//      jweixin.chooseImage({
			//   		count: 1, // 默认9
			//   		sizeType: ['compressed'], // 可以指定是原图还是压缩图，默认二者都有
			//   		sourceType: ['album', 'camera'], // 可以指定来源是相册还是相机，默认二者都有
			//   		success: res=> {
			// 			console.log(res);
			//   	      	var localIds = res.localIds[0]; // 返回选定照片的本地ID列表，localId可以作为img标签的src属性显示图片
			// 			uni.showToast({
			// 				title:localIds
			// 			})
			// 			jweixin.getLocalImgData({
			// 				localId: localIds, // 图片的localID
			// 				success: function (res) {
			// 				var localData = res.localData; // localData是图片的base64数据，可以用img标签显示
			// 				if(localData.indexOf('data:image/')){
			// 					localData = localData.replace('jgp', 'jpeg');
			// 				}else {
			// 					localData = 'data:image/jpeg;base64,' + localData;
			// 				}
			// 				_this.img[type] = localData;
			// 				jweixin.uploadImage({
			// 				   localId: localIds, // 需要上传的图片的本地ID，由chooseImage接口获得
			//     			   isShowProgressTips: 1, // 默认为1，显示进度提示
			// 				   success: function (res) {
			// 				       var serverId = res.serverId; // 返回图片的服务器端ID
			// 					  _this.shop_info[type].mid = serverId;
			// 					 }
			// 				})
			// 				}
			// 			});
			//   		 },
			// 		 fail:err=>{
			// 			 console.log(err);
			// 		 }
			//   	});
			//   },