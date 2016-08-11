var elixir = require('laravel-elixir');

// require('laravel-elixir-uncss');
// require('es6-promise').polyfill();

elixir(function(mix) {



	//CSS
	// mix.copy('vendor/twbs/bootstrap/dist/css/bootstrap.min.css', 							'resources/assets/css/');//if need mix
	mix.copy('vendor/twbs/bootstrap/dist/css/bootstrap.min.css', 							'public/css/');//not mixed
	mix.copy('vendor/components/font-awesome/css/font-awesome.min.css', 					'public/css/');//not mixed
	mix.copy('vendor/bootstrap-select/bootstrap-select/dist/css/bootstrap-select.min.css', 	'public/css/');//not mixed
	mix.copy('vendor/eternicode/bootstrap-datepicker/dist/css/bootstrap-datepicker3.css', 	'public/css/');//not mixed
	mix.copy('vendor/datatables/datatables/media/css/jquery.dataTables.min.css', 			'public/css/');//not mixed

	mix.styles([
		// 'bootstrap.min.css',
		// 'font-awesome.min.css',
		// 'bootstrap-select.min.css',
		'custom.css',
	]);



	//JS
	//mix.copy('vendor/components/jquery/jquery.min.js', 										'resources/assets/js/');//if need mix
	mix.copy('vendor/components/jquery/jquery.min.js', 										'public/js/');//not mixed
	mix.copy('vendor/twbs/bootstrap/dist/js/bootstrap.min.js', 								'public/js/');//not mixed
	mix.copy('vendor/bootstrap-select/bootstrap-select/dist/js/bootstrap-select.min.js',	'public/js/');//not mixed
	mix.copy('vendor/eternicode/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js',	'public/js/');//not mixed
	mix.copy('vendor/ckeditor/ckeditor/ckeditor.js', 										'public/js/');//not mixed
	mix.copy('vendor/datatables/datatables/media/js/jquery.dataTables.min.js', 				'public/js/');//not mixed

	mix.scripts([
		// 'jquery.min.js',
		// 'bootstrap.min.js',
		// 'bootstrap-select.min.js',
	]);



	//FONTS
	// mix.copy('vendor/components/font-awesome/fonts/', 										'public/build/fonts/');
	// mix.copy('vendor/twbs/bootstrap/dist/fonts/', 											'public/build/fonts/');
	mix.copy('vendor/components/font-awesome/fonts/', 										'public/fonts/');//not mixed
	mix.copy('vendor/twbs/bootstrap/dist/fonts/', 											'public/fonts/');//not mixed



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