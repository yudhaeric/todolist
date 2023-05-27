@extends('layouts.mainlayout')

@section('content')
  <div class="p-8 w-96 h-36 lg:rounded-xl">
    <div class="flex items-center justify-between mb-6">
      <div>
        <p class="text-xl font-bold">Today's Task</p>
        <p class="text-sm text-[#8A8A8A]">{{$day}}, {{$date}} {{$month}}</p>
      </div>
      <div class="bg-[#E2EBFA] rounded-lg w-28 h-8 flex items-center justify-center">
        <a href="/add" class="flex items-center justify-center">
          <img src="images/plus.png" width="12" height="12" class="mr-2">
          <p class="text-[#045EFB] font-bold text-[12px]"> 
            New Task
          </p>
        </a>
      </div>
    </div>
    <div class="flex items-center text-[#8A8A8A] text-sm justify-between">
      <button onclick="updateStatus('all')" class="flex items-center">
        <p class="mr-2 text-[#045EFB] font-bold underline underline-offset-8">All</p>
        <p class="px-[6px] bg-[#045EFB] text-white rounded-xl text-[12px]">1</p>
      </button>
      <button onclick="updateStatus('active')" class="flex items-center">
        <p class="mr-2 text-[#8A8A8A]">Active</p>
        <p class="px-[6px] bg-[#D9D9D9] text-white rounded-xl text-[12px]">1</p>
      </button>
      <button onclick="updateStatus('done')" class="flex items-center">
        <p class="mr-2 text-[#8A8A8A]">Done</p>
        <p class="px-[6px] bg-[#D9D9D9] text-white rounded-xl text-[12px]">0</p>
      </button>
      <button onclick="updateStatus('delete')">
        <p class="mr-1 text-[#8A8A8A]">Deleted</p>
      </button>
    </div>
  </div>
  <div class="flex flex-col items-center justify-center mt-4">
    <div id="all-todo-list" class="content">
      @foreach ($todolist as $item)
        <div class="w-80 h-28 bg-[#FFFFFF] rounded-2xl mb-5 px-5 py-3">
          <div class="grid grid-cols-10 gap-2">
            <div class="col-span-9 overflow-hidden">
              <h1 class="mb-1 font-bold">{{$item->title}}</h1>
              <p class="text-xs text-[#8A8A8A] w-[95%]">{{$item->subtitle}}</p>
            </div>
            <div class="flex items-center h-[90%]">
              <div class="border border-[#8A8A8A] w-[18px] h-[18px] rounded-full"></div>
            </div>
          </div>
          <p class="text-[10px] text-[#8A8A8A] mt-3 border-t-2 pt-3 font-bold">April 27</p>
        </div>
      @endforeach
    </div>
    <div id="active-todo-list" class="content">
      <h1>Todos Active</h1>
    </div>
    <div id="done-todo-list" class="content">
      <h1>Todos Done</h1>
    </div>
    <div id="delete-todo-list" class="content">
      <h1>Todos Deleted</h1>
    </div>
  </div>
  <script>
    let status = 'all';
    
    function updateStatus(newStatus) {
      status = newStatus;
      updateView();
    }
    
    function updateView() {
      const category = {
        all: document.getElementById('all-todo-list'),
        active: document.getElementById('active-todo-list'),
        done: document.getElementById('done-todo-list'),
        delete: document.getElementById('delete-todo-list')
      };

      for (const todo in category) {
        if (todo === status) {
          category[todo].style.display = 'block';
        } else {
          category[todo].style.display = 'none';
        }
      }
    }
    
    updateView();
  </script>
@endsection