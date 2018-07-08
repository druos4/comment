<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        return view('index');
    }

    public function edit($id)
    {
        return view('edit');
    }

    public function about()
    {
        $txt = 'bla bla bla bla';
        $data = date('H:i:s');
        $list = ['first','second','third'];
        return view('about/index', compact('txt','data','list'));
    }
}
