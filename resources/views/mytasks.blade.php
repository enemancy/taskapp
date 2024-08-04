<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            mytaskspage
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div>
                    @foreach ($todos as $todo)
                        <div class="border-b border-gray-200 p-4">
                            <div class="flex items-center">
                                <input type="checkbox" 
                                       id="todo-{{ $todo->id }}" 
                                       class="todo-checkbox mr-3" 
                                       {{ $todo->completed ? 'checked' : '' }}>
                                
                                <div class="ml-3">
                                    <h3 class="text-lg font-semibold mb-1">{{ $todo->name }}</h3>
                                    <p class="{{ $todo->deadline && strtotime($todo->deadline) < strtotime('today') ? 'text-red-500' : 'text-gray-600' }} text-sm">
                                        締め切り: {{ $todo->deadline ? date('Y/m/d', strtotime($todo->deadline)) : 'なし' }}
                                    </p>
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
                    updateTodoStatus(this.dataset.id, this.checked);
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
            .catch(error => console.error('エラー:', error));
        }
    </script>

</x-app-layout>
