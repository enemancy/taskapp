<div class="py-12">
  <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
    <form method="POST" class="space-y-4"
      @switch($routeName)
        @case('makeTask')
          action="/tasks/store"
          @break
        @case('editTask')
          action="/tasks/{{ $task->id }}/update"
          @break
        @default
          action="#"
      @endswitch
    >
        @csrf
        <div>
            <label for="name" class="block text-sm font-medium text-gray-700">タスク名</label>
            <input type="text" name="task[name]" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" value="{{ isset($task) ? $task->name : '' }}">
        </div>
        <div class="mt-6">
            <label for="deadline" class="block text-sm font-medium text-gray-700">締め切り</label>
            <input type="date" name="task[deadline]" id="deadline" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" value="{{ isset($task->deadline) ? \Carbon\Carbon::parse($task->deadline)->format('Y-m-d') : '' }}">
        </div>
        <div>
            <label for="team" class="block text-sm font-medium text-gray-700">チーム名</label>
            <select name="task[team_id]" id="team" class="h-10 mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                <option value=""></option>
                @foreach ($teams as $team)
                    <option value="{{ $team->id }}" {{ isset($task) && $task->team_id == $team->id ? 'selected' : '' }}>{{ $team->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="mt-6">
            <button type="submit" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
              @switch($routeName)
                @case('makeTask')
                  作成
                  @break
                @case('editTask')
                  更新
                  @break
                @default
                  実行
              @endswitch
            </button>
        </div>
    </form>
  </div>
</div>