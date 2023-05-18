<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard()
    {
        try {
            return view('dashboard',['title'=>'Dashboard']);
        } catch (\Exception $e) {
            echo 'Some thing wrong!';
        }
    }
}
