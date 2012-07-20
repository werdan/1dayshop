jQuery(document).ready(function() {
	
	jQuery("div.newsletter input").resettable();
	jQuery("a.newsletterbox_open").click(function(){
		jQuery("div.newsletter").fadeIn(1000);
	});
	jQuery("div.newsletter button").click(function(){
		if ( jQuery("div.newsletter input").val() == jQuery("div.newsletter input").data("original") || jQuery.trim(jQuery("div.newsletter input").val()) == "") {
			return;
		}
		jQuery.post('/index/subscribe', { email: jQuery("div.newsletter input").val()}, function(data) {
			_gaq.push(['_trackEvent','Keep in touch','Newsletter']);
			jQuery("div.newsletter")
			  	.html(data)
			    .delay(3000)
			    .fadeOut(1000);
		});
	});
});