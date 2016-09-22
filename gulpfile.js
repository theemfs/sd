var elixir = require('laravel-elixir');

// require('laravel-elixir-uncss');
// require('es6-promise').polyfill();

elixir(function(mix) {



	//CSS
	mix.copy('bower_components/bootstrap-select/dist/css/bootstrap-select.min.css', 							'public/css/');
	mix.copy('bower_components/bootstrap/dist/css/bootstrap.min.css',											'public/css/');
	mix.copy('bower_components/datatables/media/css/dataTables.bootstrap.min.css',								'public/css/');
	mix.copy('bower_components/eonasdan-bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.min.css', 	'public/css/');
	mix.copy('bower_components/font-awesome-animation/dist/font-awesome-animation.min.css',						'public/css/');
	mix.copy('bower_components/font-awesome/css/font-awesome.min.css', 											'public/css/');
	mix.copy('bower_components/pnotify/dist/pnotify.css',			 											'public/css/');
	mix.copy('bower_components/animate.css/animate.min.css',			 										'public/css/');

	mix.styles([
		// 'bootstrap.min.css',
		// 'font-awesome.min.css',
		// 'bootstrap-select.min.css',
		'custom.css',
	]);



	//JS
	mix.copy('bower_components/bootstrap-select/dist/js/bootstrap-select.min.js',								'public/js/');
	mix.copy('bower_components/bootstrap/dist/js/bootstrap.min.js',												'public/js/');
	mix.copy('bower_components/ckeditor/ckeditor.js', 															'public/js/');
	mix.copy('bower_components/datatables/media/js/jquery.dataTables.min.js', 									'public/js/');
	mix.copy('bower_components/eonasdan-bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js',		'public/js/');
	mix.copy('bower_components/jquery/dist/jquery.min.js',														'public/js/');
	mix.copy('bower_components/moment/min/moment-with-locales.min.js', 											'public/js/');
	mix.copy('bower_components/pnotify/dist/pnotify.desktop.js', 												'public/js/');
	mix.copy('bower_components/pnotify/dist/pnotify.js', 														'public/js/');
	mix.copy('bower_components/react/react.min.js', 															'public/js/');
	mix.copy('bower_components/react/react-dom.min.js', 														'public/js/');
	mix.copy('bower_components/jquery-ui/jquery-ui.min.js', 													'public/js/');

	mix.scripts([
	// 	// 'jquery.min.js',
	// 	// 'bootstrap.min.js',
	// 	// 'bootstrap-select.min.js',
		'custom.js',
	]);



	//FONTS
	mix.copy('bower_components/bootstrap/dist/fonts/', 															'public/fonts/');
	mix.copy('bower_components/font-awesome/fonts/', 															'public/fonts/');



	//SOUNDS
	mix.copy('resources/assets/sounds', 																		'public/sounds/');



	// //IMAGES
	mix.copy('resources/assets/favicon.png',		 															'public/favicon.ico');
	mix.copy('resources/assets/images/', 																		'public/images/');
	mix.copy('vendor/datatables/datatables/media/images', 														'public/images');



	//VERSIONING
	mix.version([
		'public/css/all.css',
		'public/js/all.js'
	]);



	// //OTHER
	// 	// WYSIWYG web text editor
	// 		mix.copy('vendor/ckeditor/ckeditor/ckeditor.js', 'public/build/js');
	// 	// Dropzone (file uploader)
	// 		// mix.copy('resources/assets/css/dropzone.css', 'public/build/css');
	// 		// mix.copy('resources/assets/js/dropzone.js', 'public/build/js');
	// 	//jQuery File Upload
	// 		// mix.copy('resources/assets/js/jquery.fileupload.js', 		'public/build/js');
	// 		// mix.copy('resources/assets/js/jquery.iframe-transport.js', 	'public/build/js');
	// 		// mix.copy('resources/assets/js/jquery.ui.widget.js', 		'public/build/js');
	// 	//Fine-Uploader
	// 		// mix.copy('/resources/assets/js/fine-uploader.min.js', 				'public/build/js');
	// 		// mix.copy('/resources/assets/css/fine-uploader.min.css', 				'public/build/css');
	// 		// mix.copy('/resources/assets/css/fine-uploader-gallery.min.css', 		'public/build/css');


	// // mix.uncss('main.css', {
	// //     html: ['index.html']
	// // });

	// //mix.html('**/*.html', 'public/html', 'resources/assets/html', {quotes: true, loose: true, empty: true});

	// // mix.phpUnit().phpSpec();
	// // mix.less('app.less');
});