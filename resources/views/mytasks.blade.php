<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $pageName }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <a href="{{ route('makeTask') }}"
                class="inline-flex items-center mb-4 px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xm text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                新規作成
            </a>
            <div class="bg-white overflow-hidden shadow-lg rounded-lg">
                @foreach ($todos as $todo)
                    <div class="border-b border-gray-200 p-6 hover:bg-gray-50 transition duration-150 ease-in-out">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center space-x-4">
                                <input type="checkbox" id="{{ $todo->id }}"
                                    class="todo-checkbox w-5 h-5 text-blue-600 border-gray-300 rounded focus:ring-blue-500"
                                    {{ $todo->completed ? 'checked' : '' }}>

                                <div class="ml-4">
                                    <h3
                                        class="text-xl font-semibold text-gray-800 {{ $todo->completed ? 'line-through' : '' }}">
                                        {{ $todo->name }}
                                    </h3>
                                    <p
                                        class="{{ $todo->deadline && strtotime($todo->deadline) < strtotime('today') ? 'text-red-600' : 'text-gray-600' }} text-sm mt-1 {{ $todo->completed ? 'line-through' : '' }}">
                                        締め切り: {{ $todo->deadline ? date('Y年m月d日', strtotime($todo->deadline)) : 'なし' }}
                                    </p>
                                </div>
                            </div>
                            <div class="flex justify-end space-x-2">
                                <a href="{{ route('editTask', ['id' => $todo->id]) }}" class="text-xl">
                                    <i class="fa-solid fa-pen"></i>
                                </a>
                                <form action="{{ route('tasks.delete', ['id' => $todo->id]) }}" method="POST" class="inline">
                                    @csrf
                                    <button type="submit" class="text-red-600 bg-transparent border-none cursor-pointer text-xl">
                                        <i class="fa-solid fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        
    </div>
    
    <div id="deleteConfirmationModal"
        class="fixed inset-0 bg-black bg-opacity-75 flex items-center hidden justify-center">
        <div
            class="bg-white p-8 rounded-lg shadow-xl max-w-md w-full mx-auto mx-4">
            <h2 class="text-xl font-bold mb-4">本当に削除しますか？</h2>
            <p class="mb-6">この操作は取り消せません。</p>
            <div class="flex justify-end space-x-4">
                <button id="cancelDelete" onClick=""
                    class="px-4 py-2 bg-gray-300 text-gray-800 rounded hover:bg-gray-400">キャンセル</button>
                <button id="confirmDelete"
                    class="px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700">削除</button>
            </div>
        </div>
    </div>



    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const checkboxes = document.querySelectorAll('.todo-checkbox');
            checkboxes.forEach(checkbox => {
                checkbox.addEventListener('change', function () {
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