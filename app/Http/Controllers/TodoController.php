<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Todo;

class TodoController extends Controller
{
    public function index() {
        // Get Data 
        $all = Todo::orderBy('status', 'DESC')->orderBy('created_at', 'DESC')->get();
        $active = Todo::where('status', 1)->orderBy('created_at', 'DESC')->get();
        $done = Todo::where('status', 0)->orderBy('created_at', 'DESC')->get();
        $deleted = Todo::onlyTrashed()->orderBy('deleted_at', 'DESC')->get();

        // Get Amount of Data
        $allAmount = Todo::count();
        $activeAmount = Todo::where('status', 1)->count();
        $doneAmount = Todo::where('status', 0)->count();
        $deletedAmount = Todo::onlyTrashed()->count();

        // Get Local Time
        date_default_timezone_set('Asia/Jakarta');
        $day = date('l');
        $date = date('d');
        $month = date('F');

        $data = [
            'allTodos' => $all,
            'activeTodos' => $active,
            'doneTodos' => $done,
            'deletedTodos' => $deleted,
            'allAmount' => $allAmount,
            'activeAmount' => $activeAmount,
            'doneAmount' => $doneAmount,
            'deletedAmount' => $deletedAmount,
            'day' => $day,
            'date' => $date,
            'month' => $month
        ];
        
        return view('home', $data);
    }

    public function updateStatus($id)
    {
        $test = Todo::find($id);
        if ($test->status === 1) {
            $test->status = 0;
            $test->save();
        } else {
            $test->status = 1;
            $test->save();
        }

        return redirect('/');
    }

    public function add() {
        return view('add');
    }

    public function store(Request $request) {
        $task = Todo::create($request->all());

        return redirect('/');
    }

    public function edit($id) {
        $todo = Todo::findOrFail($id);

        // mengoper value task ke page view
        return view('edit', ['todo' => $todo]);
    }

    public function update(Request $request, $id) {
        $todo = Todo::findOrFail($id);

        $todo->update($request->all());
        return redirect('/');
    }

    public function delete($id) {
        $todo = Todo::findOrFail($id);
        $todo->delete();

        return redirect('/');
    }
}
