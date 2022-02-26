<?php




return [

	'adminConfig' => '{
		"logo": {
			"title": "Admax",
			"image": "/static/admin/images/logo.png"
		},
		"menu": {
			"data": "/admax.php/menu/initmenu",
			"accordion": true,
			"control": false,
			"select": "10",
			"async": true
		},
		"tab": {
			"muiltTab": true,
			"keepState": true,
			"tabMax": 30,
			"index": {
				"id": "10",
				"href": "/admax.php/index/welcome",
				"title": "首页"
			}
		},
		"theme": {
			"defaultColor": "2",
			"defaultMenu": "dark-theme",
			"allowCustom": true
		},
		"colors": [{
				"id": "1",
				"color": "#FF5722"
			},
			{
				"id": "2",
				"color": "#5FB878"
			},
			{
				"id": "3",
				"color": "#1E9FFF"
			}, {
				"id": "4",
				"color": "#FFB800"
			}, {
				"id": "5",
				"color": "darkgray"
			}
		],
		"other": {
			"keepLoad": 1200
		}
	}',

	'captcha' => [

		// 验证码字体大小
	    'fontSize'    =>    30,    
	    // 验证码位数
	    'length'      =>    3,   
	    // 关闭验证码杂点
	    'useNoise'    =>    false, 	
	    // 验证码宽度
	    'imageW'	  =>    200,

	],

];