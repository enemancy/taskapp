<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            mytaskspage
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <a href="{{ route('maketask') }}" class="inline-flex items-center mb-4 px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xm text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                新規作成
            </a>
            <div class="bg-white overflow-hidden shadow-lg rounded-lg">
                @foreach ($todos as $todo)
                    <div class="border-b border-gray-200 p-6 hover:bg-gray-50 transition duration-150 ease-in-out">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center space-x-4">
                                <input type="checkbox" 
                                        id="{{ $todo->id }}" 
                                        class="todo-checkbox w-5 h-5 text-blue-600 border-gray-300 rounded focus:ring-blue-500" 
                                        {{ $todo->completed ? 'checked' : '' }}>
                                
                                <div class="ml-4">
                                    <h3 class="text-xl font-semibold text-gray-800 {{ $todo->completed ? 'line-through' : '' }}">{{ $todo->name }}</h3>
                                    <p class="{{ $todo->deadline && strtotime($todo->deadline) < strtotime('today') ? 'text-red-600' : 'text-gray-600' }} text-sm mt-1 {{ $todo->completed ? 'line-through' : '' }}">
                                        締め切り: {{ $todo->deadline ? date('Y年m月d日', strtotime($todo->deadline)) : 'なし' }}
                                    </p>
                                </div>
                                <i class="fa-solid fa-pen"></i>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const checkboxes = document.querySelectorAll('.todo-checkbox');
            checkboxes.forEach(checkbox => {
                checkbox.addEventListener('change', function() {
                    updateTodoStatus(this.id, this.checked);
                });
            });
        });

        function updateTodoStatus(id, completed) {
            fetch(`/todos/${id}/update-status`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ completed: completed })
            })
            .then(console.log(JSON.stringify({ completed: completed })))
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    console.log('Todoのステータスが更新されました');
                } else {
                    console.error('Todoの更新に失敗しました');
                }
            })
            .then(location.reload())
            .catch(error => console.error('エラー:', error));
        }
    </script>

</x-app-layout>
