<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Articles;
use App\Http\Requests;

class ArticlesController extends Controller
{



	public function index()
	{
		$articles = Articles::all();
		return view('articles.index_table')
			->with('articles', $articles);
		;

	}



	public function create()
	{
		return view('articles.create');
	}



	public function store(Request $request)
	{
		//
	}



	public function show($id)
	{
		//
	}



	public function edit($id)
	{
		//
	}



	public function update(Request $request, $id)
	{
		//
	}



	public function destroy($id)
	{
		//
	}
}
