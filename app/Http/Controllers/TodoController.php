<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Todo;

class TodoController extends Controller
{
    public function index() {
        $todo = Todo::all();

        date_default_timezone_set('Asia/Jakarta');
        $day = date('l');
        $date = date('d');
        $month = date('F');

        return view('home', ['todolist' => $todo, 'day' => $day,'date' => $date, 'month' => $month]);
    }

    public function create() {
        return view('home-add');
    }
}
