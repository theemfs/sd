@extends('layouts.app')



@section('css')
@endsection



@section('title', 'Hello React!')



@section('content')



	<div id="content"></div>



@endsection



@section('js')
	{{-- <script src="{{ url('/') }}/js/react.min.js"></script>
	<script src="{{ url('/') }}/js/react-dom.min.js"></script> --}}
	<script src="https://unpkg.com/react@15.3.1/dist/react.js"></script>
    <script src="https://unpkg.com/react-dom@15.3.1/dist/react-dom.js"></script>
    <script src="https://unpkg.com/babel-core@5.8.38/browser.min.js"></script>
    <script src="https://unpkg.com/jquery@3.1.0/dist/jquery.min.js"></script>
    <script src="https://unpkg.com/remarkable@1.6.2/dist/remarkable.min.js"></script>

	<script type="text/babel" src="scripts/example.js"></script>
	<script type="text/babel">
		// To get started with this tutorial running your own code, simply remove
		// the script tag loading scripts/example.js and start writing code here.
	</script>

@endsection