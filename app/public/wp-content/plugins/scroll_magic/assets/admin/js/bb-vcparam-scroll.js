(function($) {
	'use strict';

	function bb_scroll_build_css(){
		var bb_scroll_el = $('.bb-scroll-value');

		if(bb_scroll_el.length <= 0) {
			return;
		}

		bb_scroll_el.each(function(index){

			var _self = $(this),
				bb_scroll_container = _self.closest('.bb-scroll');

			var bb_scroll_properties = ['position', 'top', 'left', 'bottom', 'right', 'opacity', 'z-index', 'width', 'height', 'margin-top', 'margin-right', 'margin-bottom', 'margin-left', 'padding-top', 'padding-right', 'padding-bottom', 'padding-left', 'background-color', 'color', 'background-position', 'font-size', 'word-spacing', 'letter-spacing', 'font-weight', 'line-height'];

			var bb_scroll_transform = ['translateX', 'translateY', 'translateZ', 'perspective', 'scaleX', 'scaleY', 'scaleZ', 'rotate', 'rotateX', 'rotateY', 'rotateZ', 'skewX', 'skewY'];

			var bb_scroll_css = '';
			$.each(bb_scroll_properties, function( index, property ) {
				var property_el = bb_scroll_container.find('.bb-scroll-' + property);
				var easing_el = bb_scroll_container.find('.bb-easing-' + property);
				if(property_el.length > 0 && property_el.val() != '') {
					var bb_scroll_easing = '';
					if(easing_el.length > 0 && easing_el.val() != '') {
						bb_scroll_easing = '#b#'+easing_el.val()+'#e#';
					}
					if(property == 'color') {
						property = ' ' + property;
					}
					bb_scroll_css += property + bb_scroll_easing + ':' + property_el.val() + ';';
				}
			});

			var flag = false;
			var bb_transform = '';
			$.each(bb_scroll_transform, function( index, tranfunc ) {
				var tranfunc_el = bb_scroll_container.find('.bb-scroll-transform.' + tranfunc);
				if(tranfunc_el.length > 0 && tranfunc_el.val() != '') {
					bb_transform += tranfunc + '(' + tranfunc_el.val() + ') ';
					flag = true;
				}
			});
			var easing_transform = bb_scroll_container.find('.bb-easing-transform');
			var bb_scroll_easing = '';
			if(easing_transform.length > 0 && easing_transform.val() != '' && flag) {
				bb_scroll_easing = '#b#'+easing_transform.val()+'#e#';
			}
			if(flag) {
				bb_scroll_css += 'transform' + bb_scroll_easing + ':' + bb_transform + ';';
			}

			_self.val(bb_scroll_css);

		});
	}

	function bb_scroll_init(){
		var bb_scroll_el = $('.bb-scroll-value');

		if(bb_scroll_el.length <= 0 || bb_scroll_el.val() == '') {
			return;
		}

		bb_scroll_el.each(function(index){

			var _self = $(this),
				bb_scroll_value = _self.val(),
				bb_scroll_container = _self.closest('.bb-scroll');

			if(bb_scroll_value == '') {
				return;
			}

			var bb_scroll_properties = bb_scroll_value.split(/;/);

			$.each(bb_scroll_properties, function( index, property_value ) {
				if(property_value == '') {
					return;
				}

				var property = property_value.split(/\:/);
				property[0] = $.trim(property[0]);
				var easing = '';

				var patt = /#b#/ig;

				if(patt.test(property[0])) {
					var data_split = property[0].split(/#b#/ig);
					property[0] = data_split[0];
					data_split = data_split[1].split(/#e#/ig);
					easing = data_split[0];
				}

				if(property[0] != 'transform') {
					var property_el = bb_scroll_container.find('.bb-scroll-' + property[0]);
					var easing_el = bb_scroll_container.find('.bb-easing-' + property[0]);
					if(property_el.length > 0) {
						property_el.val(property[1]);
						if(easing_el.length > 0) {
							easing_el.val(easing);
						}
					}
				} else {
					var easing_el = bb_scroll_container.find('.bb-easing-' + property[0]);
					if(easing_el.length > 0) {
						easing_el.val(easing);

						var tranfuncs = property[1].split(' ');

						$.each(tranfuncs, function( index, tranfunc ) {
							if(tranfunc == '') {
								return;
							}

							var tfunc = tranfunc.split('(');
							var tvalue = tfunc[1].split(')');

							tfunc = tfunc[0];
							tvalue = tvalue[0];

							var tfunc_el = bb_scroll_container.find('.bb-scroll-transform.' + tfunc);
							if( tfunc_el.length > 0 ) {
								tfunc_el.val(tvalue);
							}

						});
					}
				}
			});

		});
		//bb_scroll_build_css();
	}

	$('document').ready(function(){

		function bb_init_color(){
			$('.bb-color-picker').wpColorPicker({
				change: function(event, ui){
					bb_scroll_build_css();
				}
			});
			$('.bb-color-picker').trigger('change');
		}

		bb_scroll_init();
		bb_init_color();
		$('.bb-scroll .iris-palette, .bb-scroll .wp-picker-clear').on('click', function(){
			setTimeout( bb_scroll_build_css, 500);
		});

		// $('.bb-scroll').on('change keyup' , 'input, select', function(){
		// 	bb_scroll_build_css();
		// });
		$('.bb-scroll input, .bb-scroll select').live('change', function(){
			bb_scroll_build_css();
		});
		$('.bb-scroll input, .bb-scroll select').live('keyup', function(){
			bb_scroll_build_css();
		});

		$('.vc_control.column_clone').live('click', function(){
			setTimeout( bb_scroll_init, 2000);
			setTimeout( bb_init_color, 2100);
		});

	});
}(window.jQuery));
