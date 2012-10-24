mfImage();
function mfImage(){
	var g = document, 
		f = [100, 100],
		rootdomain = "mufeng.me",
		postdomain = rootdomain + "/photo/?page_id=972",
		mflay = "mfLay",
		$$ = function(a) {
			return g.getElementById(a)
		},
		$T = function(b, a) {
			return b.getElementsByTagName(a)
		},
		t = g.documentElement.scrollTop || g.body.scrollTop,
		addListener = function(b, a, d, c) {
			if (b.addEventListener) {
				b.addEventListener(a, d, c);
				return true
			}
			else {
				if (b.attachEvent) {
					b["e" + a + d] = d;
					b[a + d] = function() {
						b["e" + a + d](window.event)
					};
					b.attachEvent("on" + a, b[a + d]);
					return true
				}
			};
			return false
		};
	if (location.href.indexOf(rootdomain) > -1) {
		confirm("禁止采集本站图片");
		return false
	};
	if ($$(mflay)) {
		return false
	};
	var n = g.createElement("div"),
	m = g.createElement("div"),
	l = g.createElement("a");
	m.innerHTML = '<style type="text/css">#'+(n.id = mflay) + "{width: 100%;height: 100%;background-color:#fafafa;position: fixed;top: 0;left: 0;z-index: 9999998;_position: absolute;_height: expression(body.offsetHeight);}#" + (m.id = "mfWrap") + "{position: absolute;top:" + t + "px;left:0;z-index:9999999;}#mfWrap img{border:1px solid #d9d9d9;background-color:#fff;max-height: 200px;max-width: 200px;width: auto !important;height: auto !important;padding:0 !important;margin:0 10px 10px 0!important;}#mfWrap a:hover img{opacity:0.5;-moz-opacity:0.5;filter: alpha(opacity=50);}#" + (l.id = "mfClose") + "{position: fixed;top: 0;right: 0;z-index: 9999999;width:50px!important;height:50px!important;font-size:32px;}</style>",
	m.appendChild(l);
	l.href = "#";
	l.innerHTML = "x";
	(f = f.filter.call(g.images,function(a){return a.width >= f[0] && a.height >= f[1] && a.src}))[0] ? (f.forEach(function(a){m.innerHTML += '<img src="' + a.cloneNode(0).src + '">'}), (f = g.body).appendChild(n), f.appendChild(m)) : confirm("没找到足够大的图片")
	addListener($$("mfClose"), "click",function() {
		f.removeChild(n);
		f.removeChild(m);
		return false
	},false);
	l = $T($$("mfWrap"), "img");
	var k, h = l.length;
	for (k = 0;k < h;k++) {
		addListener(l[k], "click",function(a) {
			var c = this.src,
			b = g.title;
			window.open("http://" + postdomain + "&action=new&src="+c + "&title=" + b, null, "height=400, width=600, top=100, left=200, toolbar=no, menubar=no, scrollbars=no, resizable=no,location=no, status=no");
			f.removeChild(n);
			f.removeChild(m)
		},false)
	}
};