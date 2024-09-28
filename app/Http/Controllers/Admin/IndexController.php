<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IndexController extends Controller
{
    public function index()
    {

        $user = Auth::user();

        if ($user->id != 1) {
            return redirect('/');
        }

        return view('admin.index', compact('user'));
    }
}
