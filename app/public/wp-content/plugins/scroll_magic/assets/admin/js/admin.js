(function($) {
	'use strict';

	$('document').ready(function(){

		var bb_sm_option_by_themselves = $('#bb_sm_option_by_themselves');
		$(bb_sm_option_by_themselves).on('change', function(){
			$('.bb_sm_icon_depend').css({display: 'none'});
			if($(this).val() == 'custom') {
				$( '#bb_sm_option_by_themselves_custom' ).css({display: 'block'});
			}
		});
		$(bb_sm_option_by_themselves).trigger('change');

	});
}(window.jQuery));
