	(function($){
		$(document).ready(function(){
			$(".uniqueclass .notice-dismiss").on("click", function(){
				var url = new URL(location.href);
				url.searchParams.append("dismissed", 1);
				location.href = url;

			});
			$('#widgetkit-pro-update p').empty().append('There is a new version of this plugin is available. Please download from your <a href="https://themesgrove.com/account/">account</a>. <i>Automatic update is unavailable for this plugin.</i>');

		});

	})(jQuery);