@props(['routeName','team'])

<div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 bg-white shadow-sm sm:rounded-lg p-6">
            <form 
                action="
                    @switch($routeName)
                        @case('makeTeam')
                            {{ '/teams/store' }}
                            @break
                        @case('editTeam')
                            {{ "/teams/{$team->id}/update" }}
                            @break
                        @default
                            {{ '#' }}
                    @endswitch
                "
                method="POST" class="space-y-4"
            >
                @csrf
                <div>
                    <label for="name" 
                        class="block text-sm font-medium text-gray-700">
                        チーム名
                    </label>
                    <input
                        type="text" name="team[name]" id="name"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                        value="{{ isset($team) ? $team->name : '' }}"
                    >
                </div>
                <div class="mt-6">
                    <label for="member" class="block text-sm font-medium text-gray-700">メンバー</label>
                    <div class="flex items-center space-x-2">
                        <input type="text" id="autoComplete" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                    </div>
                    <ul id="memberList" class="mt-2 space-y-2">
                        <!-- メンバーリストがここに追加されます -->
                        <li class="bg-gray-100 p-2 rounded-md flex justify-between items-center">
                            <span>{{ Auth::user()->name }}</span>
                            <input type="hidden" name="userIds[]" value="{{ Auth::user()->id }}">
                            <span class="text-gray-500 text-sm">(あなた)</span>
                        </li>
                        @isset($team)
                            @foreach($team->user as $user)
                                @if($user->id != Auth::user()->id)
                                    <li id="member_{{ $user->id }}" class="bg-gray-100 p-2 rounded-md flex justify-between items-center">
                                        <span>{{ $user->name }}</span>
                                        <input type="hidden" name="userIds[]" value="{{ $user->id }}">
                                        <i class="fa-solid fa-trash" onclick="removeMember({{ $user->id }})"></i>
                                    </li>
                                @endif
                            @endforeach
                        @endisset
                    </ul>

                </div>
                <div class="mt-6">
                    <button type="submit" 
                        class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                        @switch($routeName)
                            @case('makeTeam')
                                作成
                                @break
                            @case('editTeam')
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

<script>
    const autoCompleteJS = new autoComplete({
        placeHolder: 'Search for User...',
        data: {
            src: async (query) => {
                try {
                    const source = await fetch(`/users/suggest/${query}`); 
                    const data = await source.json();

                    return data;
                } catch (err) {
                    return error;
                }
            },
            keys: ['suggest'],
        },
        debounce: 300,
        resultsList: {
            element: (list, data) => {
                if (!data.results.length) {
                    const message = document.createElement("div");
                    message.setAttribute("class", "no_result");
                    message.innerHTML = `<span>Found No Results for "${data.query}"</span>`;
                    list.prepend(message);
                }
            },

            noResults: true,
            maxResults: 5,
        },
        resultItem: {
            highlight: true,
        }
    });


    // リスト選択時に起動
    document.querySelector("#autoComplete").addEventListener("selection", function (event) {
        addMember(event.detail.selection.value.email);
    });

    //Liに追加
    function addMember(email){

        fetch(`/users/${email}/search`, {
            method: 'GET',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
        })
        .then(response => response.json())
        .then(data => {
            updateMemberList(data);
            autoCompleteJS.input.value = '';
        })
        .catch(error => {
            console.error('Error:', error);
        });

    }

    //メンバー削除
    function removeMember(id){
        const targetLi = document.getElementById(`member_${id}`);
        targetLi.remove();
    }

    //メンバーリスト更新
    function updateMemberList(data){
        const carrentUserIds = Array.from(document.querySelectorAll('[name="member_id"]')).map(el => el.textContent);

        if (data.id === undefined) {
            alert('ユーザーが見つかりませんでした。');
            return;
        }

        if(carrentUserIds.includes(String(data.id)) || data.id === {{ Auth::user()->id }}){
            alert('このユーザーは既に追加されています。');
            return;
        }

        const targetUl = document.getElementById('memberList');
        const li = document.createElement('li');
        li.className = 'bg-gray-100 p-2 rounded-md flex justify-between items-center';
        li.innerHTML = `<span>${data.name}</span>`;
        li.id = `member_${data.id}`;

        const input = document.createElement('input');
        input.type = 'hidden';
        input.name = 'userIds[]';
        input.value = data.id;

        const removeButton = document.createElement('i');
        removeButton.className = 'fa-solid fa-trash';
        removeButton.onclick = () => removeMember(data.id);

        li.appendChild(input);
        li.appendChild(removeButton);
        targetUl.appendChild(li);
    }
</script>