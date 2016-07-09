var elixir = require('laravel-elixir');

// require('laravel-elixir-uncss');
// require('es6-promise').polyfill();

elixir(function(mix) {



	//CSS
	mix.copy('vendor/twbs/bootstrap/dist/css/bootstrap.min.css', 							'resources/assets/css/');
	mix.copy('vendor/components/font-awesome/css/font-awesome.min.css', 					'resources/assets/css/');
	// mix.copy('vendor/select2/select2/dist/css/select2.min.css', 							'resources/assets/css/');
	mix.copy('vendor/bootstrap-select/bootstrap-select/dist/css/bootstrap-select.min.css', 	'resources/assets/css/');

	mix.styles([
		'bootstrap.min.css',
		'font-awesome.min.css',
		'bootstrap-select.min.css',
		// 'select2.min.css',
		'custom.css',
	]);



	//JS
	mix.copy('vendor/components/jquery/jquery.min.js', 										'resources/assets/js/');
	mix.copy('vendor/twbs/bootstrap/dist/js/bootstrap.min.js', 								'resources/assets/js/');
	// mix.copy('vendor/select2/select2/dist/js/select2.min.js', 							'resources/assets/js/');
	mix.copy('vendor/bootstrap-select/bootstrap-select/dist/js/bootstrap-select.min.js',	'resources/assets/js/');
	mix.copy('vendor/ckeditor/ckeditor/ckeditor.js', 										'resources/assets/js/');

	mix.scripts([
		'jquery.min.js',
		'bootstrap.min.js',
		'bootstrap-select.min.js',
		// 'select2.min.js'
	]);



	//FONTS
	mix.copy('vendor/components/font-awesome/fonts/', 	'public/build/fonts/');
	mix.copy('vendor/twbs/bootstrap/dist/fonts/', 		'public/build/fonts/');



	//VERSIONING
	mix.version([
		'public/css/all.css',
		'public/js/all.js'
	]);



	// //IMAGES
	// mix.copy('/resources/assets/mimetypes/', 'public/build/mimetypes/');
	// mix.copy('/resources/assets/images/', 'public/build/images/');



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