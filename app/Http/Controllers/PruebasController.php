<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Relationship;
use App\Models\User;
use App\Models\UserCount;
use Illuminate\Http\Request;

class PruebasController extends Controller
{
    public function index()
    {
        return view('pruebas');
    }
}
