<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Todos</title>
  @vite('resources/css/app.css')
</head>
<body class="bg-[#FFFFFF] flex flex-col items-center">
    <div class="h-12 border-b w-80">
        <h1 class="mt-3 font-bold text-center">New Task ToDo</h1>
    </div>
    <div>
        <form method="post" action="store">
            @csrf
            <div class="flex flex-col h-full w-96">
                <label for="title" class="mt-4 mx-8 font-bold text-[#131313]">Task Name</label>
                <input required type="text" name="title" id="title" placeholder="Add Task Name..." class="text-[12px] outline-[#131313] mt-2 mx-8 bg-[#EFF3F4] rounded-md py-2 pl-4">
            </div>
            <div class="flex flex-col overflow-hidden w-96">
                <label for="task" class="mt-4 mx-8 font-bold text-[#131313]">Description</label>
                <textarea name="task" id="task" rows="4" cols="50" placeholder="Add Descriptions..."  maxlength="100" class="resize-none overflow-hidden bg-[#EFF3F4] mt-2 mx-8 px-2 pt-2 pb-[60%] outline-[#131313] rounded-md text-[12px]"></textarea>
            </div>
            <div class="flex justify-center gap-2 mt-5">
                <a href="/" class="w-[155px] flex justify-center items-center h-12 border border-[#3085FE] rounded-lg text-[#3085FE] font-bold">
                    Cancel
                </a>
                <button type="submit" class="w-[155px] h-12 bg-[#3085FE] rounded-lg text-[#FFFFFF] font-bold">
                    Create
                </button>
            </div>
        </form>
    </div>
</body>
</html>