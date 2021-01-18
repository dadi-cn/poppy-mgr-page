(function (width, height, url) {
	var descriptions = '',
	    imgs         = [],
	    img_match    = /http.+png|http.+jpg|http.+gif|http.+svg|http.+jpeg/g,
	    tag_meta     = document.getElementsByTagName('meta'),
	    tag_img      = document.getElementsByTagName('img'),
	    tag_a        = document.getElementsByTagName('a'),
	    idx;
	for (idx = 0; idx < tag_meta.length; idx++) {
	    if ((tag_meta[idx].name.toLowerCase()) === 'description') {
	        descriptions = tag_meta[idx].content
	    }
	}
	var url_open  = url + '?url=' + encodeURIComponent(location.href) + '&title=' + encodeURIComponent(document.title) + '&description=' + encodeURIComponent(descriptions);
	var url_param = 'toolbar=0,resizable=1,scrollbars=yes,status=1,width=' + width + ',height=' + height + ',left=' + (screen.width - width) / 2 + ',top=' + (screen.height - height) / 2;
	if (!window.open(url_open, '{!! sys_setting('system::site.name') !!}', url_param)) {
	    window.location.href = url_open;
	}
})(700,500, '{!! route_url('url:web.collection.establish') !!}')