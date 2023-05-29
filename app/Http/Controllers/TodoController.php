<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Todo;

class TodoController extends Controller
{
    public function index() {
        // Get Data 
        $all = Todo::get();
        $active = Todo::where('status', 1)->get();
        $done = Todo::where('status', 0)->get();

        // Get Amount of Data
        $allAmount = Todo::count();
        $activeAmount = Todo::where('status', 1)->count();
        $doneAmount = Todo::where('status', 0)->count();

        // Get Local Time
        date_default_timezone_set('Asia/Jakarta');
        $day = date('l');
        $date = date('d');
        $month = date('F');

        $data = [
            'allTodos' => $all,
            'activeTodos' => $active,
            'doneTodos' => $done,
            'allAmount' => $allAmount,
            'activeAmount' => $activeAmount,
            'doneAmount' => $doneAmount,
            'day' => $day,
            'date' => $date,
            'month' => $month
        ];
        
        return view('home', $data);
    }

    // public function create() {
    //     return view('home-add');
    // }
}
