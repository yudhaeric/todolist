<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Todos</title>
  @vite('resources/css/app.css')
</head>
<body class="bg-[#FFFFFF] flex flex-col items-center">
    <div class="flex items-center justify-between h-12 border-b w-80">
        <a href="/">
            <img src="/images/back.png" class="w-6 h-6 mr-2">
        </a>
        <h1 class="mr-2 font-bold text-center ">Edit</h1>
        <form action="/delete-task/{{$todo->id}}" method="post">
            @csrf
            @method('delete')
            <button type="submit">
                <img src="/images/delete.png" class="w-5 h-5">
            </button>
        </form>
    </div>
    <div class="w-80">
        <form action="/task/{{$todo->id}}" method="post">
            @csrf
            @method('put')
            <div class="flex flex-col h-full w-80">
                <label for="title" class="mt-4 font-bold text-[#131313]">Task Name</label>
                <input required type="text" name="title" value="{{$todo->title}}" id="title" placeholder="Add Task Name..." class="text-[12px] outline-[#131313] mt-2 bg-[#EFF3F4] rounded-md py-2 pl-2">
            </div>
            <div class="flex flex-col overflow-hidden w-80">
                <label for="task" class="mt-4 font-bold text-[#131313]">Description</label>
                <textarea name="task" id="task" rows="4" cols="50" maxlength="100" class="resize-none overflow-hidden bg-[#EFF3F4] mt-2 pt-2 pb-[70%] outline-[#131313] rounded-md text-[12px] pl-2">{{$todo->task}}</textarea>
            </div>
            <div class="flex justify-center mt-5">
                <button type="submit" class="w-full h-12 bg-[#3085FE] rounded-lg text-[#FFFFFF] font-bold">
                    Update
                </button>
            </div>
        </form>
    </div>
</body>
</html>