// jQuery Ready
jQuery().ready(function($){
	
	$('div.jqmWindow').jqm({
		toTop: true,
		onShow: function(hash) {
			hash.w.show();
			var img = $('img',hash.w);
			
			img.Jcrop({
				boxWidth: $(window).width() - 20,
				boxHeight: $(window).height() - 24,
				aspectRatio: img.attr('data-aspectratio')
			}, function(){ window.my_jcrop_api = this});
		},
		onHide: function(hash) {
			window.my_jcrop_api.destroy();
			hash.w.hide();
			hash.o.remove(); 
		}
	});
	$('a.jqmTrigger').click(function(){
		$('#' + $(this).attr('rel')).jqmShow();
		return false;
	});
	
	$('a.uploadify-jcrop').click(function(){
		$.ajax({
			url:this.href,
			data: $.extend({FileID: $(this).attr('rel')},window.my_jcrop_api.tellSelect())
		});
		
		$(this).closest('div.jqmWindow').jqmHide();
		
		
		
		return false;
	});
});