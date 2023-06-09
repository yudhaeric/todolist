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
        <p class="mr-2 category-style">All</p>
        <p class="amount-style px-[6px] bg-[#D9D9D9] text-white rounded-xl text-[12px]">{{$allAmount}}</p>
      </button>
      <button onclick="updateStatus('active')" class="flex items-center">
        <p class="mr-2 category-style">Active</p>
        <p class="amount-style px-[6px] bg-[#D9D9D9] text-white rounded-xl text-[12px]">{{$activeAmount}}</p>
      </button>
      <button onclick="updateStatus('done')" class="flex items-center">
        <p class="mr-2 category-style">Done</p>
        <p class="amount-style px-[6px] bg-[#D9D9D9] text-white rounded-xl text-[12px]">{{$doneAmount}}</p>
      </button>
      <button onclick="updateStatus('delete')" class="flex items-center">
        <p class="mr-2 category-style">Deleted</p>
        <p class="amount-style px-[6px] bg-[#D9D9D9] text-white rounded-xl text-[12px]">{{$deletedAmount}}</p>
      </button>
    </div>
  </div>
  <div class="flex flex-col items-center justify-center mt-4">
    <div id="all-todo-list" class="content">
      @if (Session::has('status'))
        <div id="flash-message" class="pl-2 py-2 mb-5 bg-[#E9F6ED] border-2 border-[#90d3a2] text-[#3A4347] text-[14px] rounded-xl w-80 h-14 flex gap-3 items-center" role="alert">
            <div class="p-2 rounded-xl bg-[#49b767] w-[35px] h-[35px]">
              <img src="/images/checked.png" alt="Success">
            </div>
            {{Session::get('message')}}
            <button id="close-button" class="ml-auto">
              <img src="/images/close.png" alt="Close" class="w-[10px] h-[10px] mr-6">
            </button>
        </div>
      @endif
      @if ($allTodos->isEmpty())
        <h1 class="text-center">There is no activity, create one! 🙂</h1>
      @else
        @foreach ($allTodos as $item)
          <a href="/edit-task/{{$item->id}}">
            <div class="w-80 h-28 bg-[#FFFFFF] rounded-2xl mb-5 px-5 py-3">
              <div class="grid grid-cols-10 gap-2">
                <div class="col-span-9 overflow-hidden">
                  @if ($item->status != 0)
                    <h1 class="mb-1 font-bold">{{$item->title}}</h1>
                    <p class="text-xs text-[#8A8A8A] w-[95%] h-[18px]">{{$item->task}}</p>
                  @else
                    <h1 class="mb-1 font-bold line-through">{{$item->title}}</h1>
                    <p class="text-xs text-[#8A8A8A] w-[95%] h-[18px] line-through">{{$item->task}}</p>
                  @endif
                </div>
                <form method="POST" action="/update-status/{{$item->id}}">
                    @csrf
                    @method('PUT')
                    <button type="submit" class="flex items-center h-10">
                      @if ($item->status != 0)
                        <div class="border border-[#8A8A8A] w-[18px] h-[18px] rounded-full"></div>
                      @else
                        <img src="images/check.png" width="18px" height="18px" alt="check">
                      @endif
                    </button>
                </form>
              </div>
              <p class="text-[10px] text-[#8A8A8A] mt-3 border-t-2 pt-3 font-bold">{{$item->created_at->format('Y-m-d')}}</p>
            </div>
          </a>
        @endforeach
      @endif
    </div>
    <div id="active-todo-list" class="content">
      @if ($activeTodos->isEmpty())
        <h1 class="text-center">Yeay, all tasks completed! 🥳</h1>
      @else
        @foreach ($activeTodos as $item)
          <a href="/edit-task/{{$item->id}}">
            <div class="w-80 h-28 bg-[#FFFFFF] rounded-2xl mb-5 px-5 py-3">
              <div class="grid grid-cols-10 gap-2">
                <div class="col-span-9 overflow-hidden">
                  <h1 class="mb-1 font-bold">{{$item->title}}</h1>
                  <p class="text-xs text-[#8A8A8A] w-[95%] h-[18px]">{{$item->task}}</p>
                </div>
                <form method="POST" action="/update-status/{{$item->id}}">
                  @csrf
                  @method('PUT')
                  <button type="submit" class="flex items-center h-10">
                    <div class="border border-[#8A8A8A] w-[18px] h-[18px] rounded-full"></div>
                  </button>
                </form>
              </div>
              <p class="text-[10px] text-[#8A8A8A] mt-3 border-t-2 pt-3 font-bold">{{$item->created_at->format('Y-m-d')}}</p>
            </div>
          </a>
        @endforeach
      @endif
    </div>
    <div id="done-todo-list" class="content">
      @if ($doneTodos->isEmpty())
        <h1 class="text-center">Come on, finish your tasks! 🥲</h1>
      @else
        @foreach ($doneTodos as $item)
          <a href="/edit-task/{{$item->id}}">
            <div class="w-80 h-28 bg-[#FFFFFF] rounded-2xl mb-5 px-5 py-3">
              <div class="grid grid-cols-10 gap-2">
                <div class="col-span-9 overflow-hidden">
                  <h1 class="mb-1 font-bold line-through">{{$item->title}}</h1>
                  <p class="text-xs text-[#8A8A8A] w-[95%] h-[18px] line-through">{{$item->task}}</p>
                </div>
                <form method="POST" action="/update-status/{{$item->id}}">
                  @csrf
                  @method('PUT')
                  <button type="submit" class="flex items-center h-10">
                    <img src="images/check.png" width="18px" height="18px" alt="check">
                  </button>
                </form>
              </div>
              <p class="text-[10px] text-[#8A8A8A] mt-3 border-t-2 pt-3 font-bold">{{$item->created_at->format('Y-m-d')}}</p>
            </div>
          </a>
        @endforeach
      @endif
    </div>
    <div id="delete-todo-list" class="content">
      @if ($deletedTodos->isEmpty())
        <h1 class="text-center">Your trash is empty!</h1>
      @else
        @foreach ($deletedTodos as $item)
          <div class="w-80 h-28 bg-[#FFFFFF] rounded-2xl mb-5 px-5 py-3">
            <div class="grid gap-2 pb-3">
              <div class="w-full overflow-hidden">
                <div class="flex items-center justify-between">
                  <h1 class="mb-1 font-bold line-through">{{$item->title}}</h1>
                  <a href="/task/{{$item->id}}/destroy">
                    <img src="/images/delete.png" class="w-4 h-4">
                  </a>
                </div>
                <p class="text-xs text-[#8A8A8A] w-[95%] h-[18px] line-through">{{$item->task}}</p>
              </div>
            </div>
            <div class="flex items-center justify-between border-t-2">
              <p class="text-[10px] text-[#8A8A8A] mt-3 font-bold">{{$item->created_at->format('Y-m-d')}}</p>
              <a href="/task/{{$item->id}}/restore" class="text-[10px] text-[#045EFB] mt-3 font-bold">RESTORE</a>
            </div>
          </div>
        @endforeach
      @endif
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
      
      let categoryText = document.querySelectorAll('.category-style');
      let categoryTextStyle = ["text-[#045EFB]", "font-bold", "underline", "underline-offset-8"];
      let amount = document.querySelectorAll('.amount-style');
      let amountStyle = "bg-[#045EFB]";
      let index = 0;

      for (const todo of Object.keys(category)) {
        if (todo === status) {
          category[todo].style.display = 'block';

          if (index < categoryText.length) {
            categoryTextStyle.forEach(function(style) {
              categoryText[index].classList.add(style);
            });
            amount[index].classList.replace("bg-[#D9D9D9]", amountStyle);
          }
        } else {
          category[todo].style.display = 'none';
          
          if (index < categoryText.length) {
            categoryTextStyle.forEach(function(style) {
              categoryText[index].classList.remove(style);
            });
            amount[index].classList.replace(amountStyle, "bg-[#D9D9D9]");
          }
        }
        index++;
      }
    }
    updateView();

    document.addEventListener('DOMContentLoaded', function() {
      var closeButton = document.getElementById('close-button');
      var flashMessage = document.getElementById('flash-message');

      closeButton.addEventListener('click', function() {
          flashMessage.style.display = 'none';
      });
    });
  </script>
@endsection