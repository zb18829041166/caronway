(window["webpackJsonp"]=window["webpackJsonp"]||[]).push([["pages-secondhandcar-singlecar-singlecar"],{"0acc":function(i,t,s){t=i.exports=s("2350")(!1),t.push([i.i,'@charset "UTF-8";\n/**\n * 这里是uni-app内置的常用样式变量\n *\n * uni-app 官方扩展插件及插件市场（https://ext.dcloud.net.cn）上很多三方插件均使用了这些样式变量\n * 如果你是插件开发者，建议你使用scss预处理，并在插件代码中直接使用这些变量（无需 import 这个文件），方便用户通过搭积木的方式开发整体风格一致的App\n *\n */\n/**\n * 如果你是App开发者（插件使用者），你可以通过修改这些变量来定制自己的插件主题，实现自定义主题功能\n *\n * 如果你的项目同样使用了scss预处理，你也可以直接在你的 scss 代码中使用如下变量，同时无需 import 这个文件\n */\n/* 颜色变量 */\n/* 行为相关颜色 */\n/* 文字基本颜色 */\n/* 背景颜色 */\n/* 边框颜色 */\n/* 尺寸变量 */\n/* 文字尺寸 */\n/* 图片尺寸 */\n/* Border Radius */\n/* 水平间距 */\n/* 垂直间距 */\n/* 透明度 */\n/* 文章场景相关 */.singlecar .singlecar-swiper[data-v-f0844314]{width:100%;height:%?400?%;margin-bottom:%?20?%}.singlecar .singlecar-swiper uni-swiper-item[data-v-f0844314]{width:100%;height:%?400?%;position:relative}.singlecar .singlecar-swiper uni-swiper-item uni-image[data-v-f0844314]{width:100%;height:%?400?%}.singlecar .singlecar-swiper uni-swiper-item .singlecar-swiper-text[data-v-f0844314]{position:absolute;left:0;bottom:0;background:hsla(0,0%,100%,.6);width:100%;height:%?60?%;line-height:%?60?%;text-indent:%?20?%}.singlecar .singlecar-base[data-v-f0844314]{height:%?70?%;line-height:%?70?%;padding:0 %?20?%;background-color:#bdbdbd;color:#000;font-weight:700}.singlecar .singlecar-list .singlecar-content[data-v-f0844314]{-webkit-box-pack:justify;-webkit-justify-content:space-between;-ms-flex-pack:justify;justify-content:space-between;border-bottom:%?1?% solid #bdbdbd;height:%?70?%;line-height:%?70?%;padding:0 %?20?%}',""])},"89a2":function(i,t,s){"use strict";s.r(t);var e=s("af17e"),n=s("a8c9");for(var a in n)"default"!==a&&function(i){s.d(t,i,function(){return n[i]})}(a);s("e639");var c=s("2877"),r=Object(c["a"])(n["default"],e["a"],e["b"],!1,null,"f0844314",null);t["default"]=r.exports},"8a60":function(i,t,s){"use strict";Object.defineProperty(t,"__esModule",{value:!0}),t.default=void 0;var e={data:function(){return{car_detail:""}},onLoad:function(i){console.log(i.carid),this.getCarDetailInfo(i.carid),i.carid},methods:{getCarDetailInfo:function(i){var t=this,s={id:i};this.$api("index/get_car_details","POST",s).then(function(i){console.log(i),i.data&&(t.car_detail=i.data?i.data:"")}).catch(function(i){console.log(i)})}}};t.default=e},a8c9:function(i,t,s){"use strict";s.r(t);var e=s("8a60"),n=s.n(e);for(var a in e)"default"!==a&&function(i){s.d(t,i,function(){return e[i]})}(a);t["default"]=n.a},af17e:function(i,t,s){"use strict";var e=function(){var i=this,t=i.$createElement,s=i._self._c||t;return s("v-uni-view",{staticClass:"singlecar"},[s("v-uni-swiper",{staticClass:"singlecar-swiper",attrs:{"indicator-dots":!1,autoplay:!0,interval:3e3,duration:1e3}},[s("v-uni-swiper-item",[s("v-uni-image",{staticClass:"swiper-item",attrs:{src:i.car_detail.frontpic}}),s("v-uni-view",{staticClass:"singlecar-swiper-text"},[i._v("正面图")])],1),s("v-uni-swiper-item",[s("v-uni-image",{staticClass:"swiper-item",attrs:{src:i.car_detail.rightside}}),s("v-uni-view",{staticClass:"singlecar-swiper-text"},[i._v("右侧图")])],1),s("v-uni-swiper-item",[s("v-uni-image",{staticClass:"swiper-item",attrs:{src:i.car_detail.leftside}}),s("v-uni-view",{staticClass:"singlecar-swiper-text"},[i._v("左侧图")])],1),s("v-uni-swiper-item",[s("v-uni-image",{staticClass:"swiper-item",attrs:{src:i.car_detail.rearview}}),s("v-uni-view",{staticClass:"singlecar-swiper-text"},[i._v("尾部图")])],1),s("v-uni-swiper-item",[s("v-uni-image",{staticClass:"swiper-item",attrs:{src:i.car_detail.frontcover}}),s("v-uni-view",{staticClass:"singlecar-swiper-text"},[i._v("车前盖图")])],1),s("v-uni-swiper-item",[s("v-uni-image",{staticClass:"swiper-item",attrs:{src:i.car_detail.interior1}}),s("v-uni-view",{staticClass:"singlecar-swiper-text"},[i._v("内饰图1")])],1),s("v-uni-swiper-item",[s("v-uni-image",{staticClass:"swiper-item",attrs:{src:i.car_detail.interior2}}),s("v-uni-view",{staticClass:"singlecar-swiper-text"},[i._v("内饰图2")])],1),s("v-uni-swiper-item",[s("v-uni-image",{staticClass:"swiper-item",attrs:{src:i.car_detail.interior3}}),s("v-uni-view",{staticClass:"singlecar-swiper-text"},[i._v("内饰图3")])],1)],1),s("v-uni-view",{staticClass:"singlecar-base"},[i._v("基本参数")]),s("v-uni-view",{staticClass:"uni-column singlecar-list"},[s("v-uni-view",{staticClass:"singlecar-content uni-row"},[s("v-uni-view",{staticClass:"singlecar-content-lef"},[i._v("厂商")]),s("v-uni-view",{staticClass:"singlecar-content-rig"},[i._v(i._s(i.car_detail.prdFactory))])],1),s("v-uni-view",{staticClass:"singlecar-content uni-row"},[s("v-uni-view",{staticClass:"singlecar-content-lef"},[i._v("品牌型号")]),s("v-uni-view",{staticClass:"singlecar-content-rig"},[i._v(i._s(i.car_detail.classid)+i._s(i.car_detail.classcid))])],1),s("v-uni-view",{staticClass:"singlecar-content uni-row"},[s("v-uni-view",{staticClass:"singlecar-content-lef"},[i._v("车型")]),s("v-uni-view",{staticClass:"singlecar-content-rig"},[i._v(i._s(i.car_detail.model))])],1),s("v-uni-view",{staticClass:"singlecar-content uni-row"},[s("v-uni-view",{staticClass:"singlecar-content-lef"},[i._v("级别")]),s("v-uni-view",{staticClass:"singlecar-content-rig"},[i._v(i._s(i.car_detail.classes))])],1),s("v-uni-view",{staticClass:"singlecar-content uni-row"},[s("v-uni-view",{staticClass:"singlecar-content-lef"},[i._v("发动机")]),s("v-uni-view",{staticClass:"singlecar-content-rig"},[i._v(i._s(i.car_detail.motor))])],1),s("v-uni-view",{staticClass:"singlecar-content uni-row"},[s("v-uni-view",{staticClass:"singlecar-content-lef"},[i._v("变速箱")]),s("v-uni-view",{staticClass:"singlecar-content-rig"},[i._v(i._s(i.car_detail.gearbox))])],1),s("v-uni-view",{staticClass:"singlecar-content uni-row"},[s("v-uni-view",{staticClass:"singlecar-content-lef"},[i._v("车身结构")]),s("v-uni-view",{staticClass:"singlecar-content-rig"},[i._v(i._s(i.car_detail.structure))])],1),s("v-uni-view",{staticClass:"singlecar-content uni-row"},[s("v-uni-view",{staticClass:"singlecar-content-lef"},[i._v("长宽高")]),s("v-uni-view",{staticClass:"singlecar-content-rig"},[i._v(i._s(i.car_detail.outline))])],1)],1),s("v-uni-view",{staticClass:"singlecar-base"},[i._v("发动机参数")]),s("v-uni-view",{staticClass:"uni-column singlecar-list"},[s("v-uni-view",{staticClass:"singlecar-content uni-row"},[s("v-uni-view",{staticClass:"singlecar-content-lef"},[i._v("排量")]),s("v-uni-view",{staticClass:"singlecar-content-rig"},[i._v(i._s(i.car_detail.fuelcsption))])],1),s("v-uni-view",{staticClass:"singlecar-content uni-row"},[s("v-uni-view",{staticClass:"singlecar-content-lef"},[i._v("最大马力")]),s("v-uni-view",{staticClass:"singlecar-content-rig"},[i._v(i._s(i.car_detail.maxkw))])],1),s("v-uni-view",{staticClass:"singlecar-content uni-row"},[s("v-uni-view",{staticClass:"singlecar-content-lef"},[i._v("最大扭矩")]),s("v-uni-view",{staticClass:"singlecar-content-rig"},[i._v(i._s(i.car_detail.maxtorque))])],1),s("v-uni-view",{staticClass:"singlecar-content uni-row"},[s("v-uni-view",{staticClass:"singlecar-content-lef"},[i._v("燃料类型")]),s("v-uni-view",{staticClass:"singlecar-content-rig"},[i._v(i._s(i.car_detail.energyType))])],1)],1),s("v-uni-view",{staticClass:"singlecar-base"},[i._v("使用信息")]),s("v-uni-view",{staticClass:"uni-column singlecar-list"},[s("v-uni-view",{staticClass:"singlecar-content uni-row"},[s("v-uni-view",{staticClass:"singlecar-content-lef"},[i._v("行驶里程")]),s("v-uni-view",{staticClass:"singlecar-content-rig"},[i._v(i._s(i.car_detail.hadkm)+"公里")])],1),s("v-uni-view",{staticClass:"singlecar-content uni-row"},[s("v-uni-view",{staticClass:"singlecar-content-lef"},[i._v("车龄")]),s("v-uni-view",{staticClass:"singlecar-content-rig"},[i._v(i._s(i.car_detail.age))])],1),s("v-uni-view",{staticClass:"singlecar-content uni-row"},[s("v-uni-view",{staticClass:"singlecar-content-lef"},[i._v("过户次数")]),s("v-uni-view",{staticClass:"singlecar-content-rig"},[i._v(i._s(i.car_detail.times))])],1),s("v-uni-view",{staticClass:"singlecar-content uni-row"},[s("v-uni-view",{staticClass:"singlecar-content-lef"},[i._v("上牌地址")]),s("v-uni-view",{staticClass:"singlecar-content-rig"},[i._v(i._s(i.car_detail.placepro))])],1),s("v-uni-view",{staticClass:"singlecar-content uni-row"},[s("v-uni-view",{staticClass:"singlecar-content-lef"},[i._v("注册日期")]),s("v-uni-view",{staticClass:"singlecar-content-rig"},[i._v(i._s(i.car_detail.regtime))])],1),s("v-uni-view",{staticClass:"singlecar-content uni-row"},[s("v-uni-view",{staticClass:"singlecar-content-lef"},[i._v("交强险日期")]),s("v-uni-view",{staticClass:"singlecar-content-rig"},[i._v(i._s(i.car_detail.instime))])],1)],1),s("page-swiper")],1)},n=[];s.d(t,"a",function(){return e}),s.d(t,"b",function(){return n})},db89:function(i,t,s){var e=s("0acc");"string"===typeof e&&(e=[[i.i,e,""]]),e.locals&&(i.exports=e.locals);var n=s("4f06").default;n("775d1332",e,!0,{sourceMap:!1,shadowMode:!1})},e639:function(i,t,s){"use strict";var e=s("db89"),n=s.n(e);n.a}}]);