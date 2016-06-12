var elixir = require('laravel-elixir');

// require('laravel-elixir-uncss');
// require('es6-promise').polyfill();

elixir(function(mix) {
	// mix.sass('app.scss');

	mix.styles([
		'bootstrap.css',
		'custom.css',
		'font-awesome.min.css',
		'select2.min.css'
		]);

	mix.scripts([
		'jquery.min.js',
		'bootstrap.min.js',
		'select2.min.js'
		]);

	mix.version([
		'public/css/all.css',
		'public/js/all.js'
		]);

	mix.copy('resources/assets/fonts', 'public/build/fonts');
	mix.copy('resources/assets/js/ckeditor.js', 'public/build/js');
	
	//dropzone (file uploader)
	// mix.copy('resources/assets/css/dropzone.css', 'public/build/css');
	// mix.copy('resources/assets/js/dropzone.js', 'public/build/js');

	//jQuery File Upload
	// mix.copy('resources/assets/js/jquery.fileupload.js', 		'public/build/js');
	// mix.copy('resources/assets/js/jquery.iframe-transport.js', 	'public/build/js');
	// mix.copy('resources/assets/js/jquery.ui.widget.js', 		'public/build/js');
	
	//Fine-Uploader
	mix.copy('resources/assets/js/fine-uploader.min.js', 				'public/build/js');
	mix.copy('resources/assets/css/fine-uploader.min.css', 				'public/build/css');
	mix.copy('resources/assets/css/fine-uploader-gallery.min.css', 		'public/build/css');

	// mix.uncss('main.css', {
	//     html: ['index.html']
	// });

	//mix.html('**/*.html', 'public/html', 'resources/assets/html', {quotes: true, loose: true, empty: true});

	// mix.phpUnit().phpSpec();
	// mix.less('app.less');
});