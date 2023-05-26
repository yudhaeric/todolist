<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Todo;

class TodoController extends Controller
{
    public function index() {
        $todo = Todo::all();
        return view('home', ['todolist' => $todo]);
    }
}
