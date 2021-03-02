// JavaScript Document
(function () {
	tinymce.PluginManager.add('bb_sm', function (editor, url) {

		editor.addButton('bb_sm_imagesequence', {
			text: '',
            id: 'bb_imagesequence',
			tooltip: 'Image sequence',
			image: BB_SM.BB_SMIMSQ_ICON,
			onclick: function () {
				// Open window
                var body = [
						{type: 'textbox', name: 'images', label: 'Images (IDs separated by commas)'},
						{type: 'textbox', name: 'scene', label: 'Scenes', tooltip: 'Enter list Class ID of Scenes separated by commas'},
						{
							type: 'listbox',
							name: 'align',
							label: 'Align',
							'values': [
								{text: 'Left', value: 'left'},
								{text: 'Center', value: 'center'},
								{text: 'Right', value: 'right'},
							],
						},
					];

				body = body.concat();

				editor.windowManager.open({
					title: 'Image sequence',
					body: body,
					onsubmit: function (e) {

						var images = e.data.images;
						var align = e.data.align;
						var scene = e.data.scene;

						editor.insertContent('[bb_sm_imagesequence bbsm_scene="'+scene+'"  align="'+align+'"  images="'+images+'"][/bb_sm_imagesequence]');
					}
				});
			}
		});
		
		editor.addButton('bb_sm_image_group', {
			text: '',
            id: 'bb_image_group',
			tooltip: 'Image Group',
			image: BB_SM.BB_SM_IMAGE_GROUP,
			onclick: function () {
				// Open window
                var body = [
						{type: 'textbox', name: 'scene', label: 'Scenes', tooltip: 'Enter list Class ID of Scenes separated by commas'},
						{
							type: 'listbox',
							name: 'align',
							label: 'Align',
							'values': [
								{text: 'Left', value: 'left'},
								{text: 'Center', value: 'center'},
								{text: 'Right', value: 'right'},
							],
						},
					];

				body = body.concat();

				editor.windowManager.open({
					title: 'Image Group',
					body: body,
					onsubmit: function (e) {

						var align = e.data.align;
						var scene = e.data.scene;
						var selected_text = editor.selection.getContent();

						editor.insertContent('[bb_sm_image_group bbsm_scene="'+scene+'"  align="' + align + '"]' + selected_text + '[/bb_sm_image_group]');
					}
				});
			}
		});
		
		editor.addButton('bb_sm_single_image', {
			text: '',
            id: 'bb_single_image',
			tooltip: 'Single Image',
			image: BB_SM.BB_SM_SINGLE_IMAGE,
			onclick: function () {
				// Open window
                var body = [
						
						{type: 'textbox', name: 'scene', label: 'Scenes', tooltip: 'Enter list Class ID of Scenes separated by commas'},
						{type: 'textbox', name: 'image', label: 'Image ID', tooltip: 'Enter ID of Image'},

					];

				body = body.concat();

				editor.windowManager.open({
					title: 'Single Image',
					body: body,
					onsubmit: function (e) {

						var image = e.data.image;
						var scene = e.data.scene;

						editor.insertContent('[bb_sm_single_image  bbsm_scene="'+scene+'"  image="' + image + '"][/bb_sm_single_image]');
					}
				});
			}
		});


		editor.addButton('bb_sm', {
			text: '',
            id: 'bb_scrollmagic',
			tooltip: 'Scroll Magic',
			image: BB_SM.BB_SM_ICON,
			onclick: function () {
				// Open window
                var body = [

						{type: 'textbox', name: 'scene', label: 'Scenes', tooltip: 'Enter list Class ID of Scenes separated by commas'},

						// {
						// 	type: 'listbox',
						// 	name: 'scene',
						// 	label: 'Scene',
						// 	'options': BB_SCENES,
						// },

						{type: 'textbox', name: 'content', label: 'Content', multiline: true, tooltip: 'Content in ScrollMagic'},

					];

				body = body.concat();

				editor.windowManager.open({
					title: 'Scroll Magic',
					body: body,
					onsubmit: function (e) {

						var scene = e.data.scene;
						var content = e.data.content;
						var selected_text = editor.selection.getContent();

						editor.insertContent('[bb_sm bbsm_scene="' + scene + '" bb_sm_mode="yes"]' + selected_text + content + '[/bb_sm]');
					}
				});
			}
		});

	});

})();
