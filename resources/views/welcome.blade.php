<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'タスク管理アプリ') }}</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <!-- FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="antialiased bg-gray-100">
    <div class="min-h-screen flex flex-col">
        <header class="bg-white shadow">
            <nav class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
                <div class="flex justify-between items-center">
                    <div class="text-2xl font-bold text-gray-800">
                        <i class="fas fa-tasks mr-2"></i>タスク管理アプリ
                    </div>
                    @if (Route::has('login'))
                        <div class="space-x-4">
                            @auth
                                <a href="{{ route('myTasks') }}" class="bg-white text-gray-800 hover:bg-gray-100 font-semibold py-2 px-4 border border-gray-400 rounded shadow">
                                    <i class="fas fa-list mr-2"></i>マイタスク
                                </a>
                            @else
                                <a href="{{ route('login') }}" class="bg-white text-gray-800 hover:bg-gray-100 font-semibold py-2 px-4 border border-gray-400 rounded shadow">
                                    <i class="fas fa-sign-in-alt mr-2"></i>ログイン
                                </a>
                                @if (Route::has('register'))
                                    <a href="{{ route('register') }}" class="bg-indigo-600 text-white hover:bg-indigo-700 font-semibold py-2 px-4 border border-indigo-600 rounded shadow">
                                        <i class="fas fa-user-plus mr-2"></i>新規登録
                                    </a>
                                @endif
                            @endauth
                        </div>
                    @endif
                </div>
            </nav>
        </header>

        <main class="flex-grow">
            <div class="max-w-7xl mx-auto py-12 sm:px-6 lg:px-8">
                <div class="text-center">
                    <h1 class="text-4xl font-extrabold text-gray-900 sm:text-5xl sm:tracking-tight lg:text-6xl">
                        <span class="block text-indigo-600">タスクを制する者が</span>
                        <span class="block">時間を制する</span>
                    </h1>
                    <p class="mt-5 max-w-xl mx-auto text-xl text-gray-500">
                        煩雑な日々のタスクを整理し、チームの生産性を最大化。
                    </p>
                    <p class="mt-2 max-w-xl mx-auto text-xl font-semibold text-indigo-600">
                        あなたの成功への道筋を可視化します。
                    </p>
                    <div class="mt-8 flex justify-center">
                        <div class="inline-flex rounded-md shadow">
                            <a href="#features" class="inline-flex items-center justify-center px-5 py-3 border border-transparent text-base font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700">
                                <i class="fas fa-info-circle mr-2"></i>機能を見る
                            </a>
                        </div>
                        <div class="ml-3 inline-flex">
                            <a href="{{ route('register') }}" class="inline-flex items-center justify-center px-5 py-3 border border-transparent text-base font-medium rounded-md text-indigo-600 bg-white hover:bg-gray-50">
                                <i class="fas fa-rocket mr-2"></i>無料で始める
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </main>

        <section id="features" class="bg-white">
            <div class="max-w-7xl mx-auto py-16 px-4 sm:px-6 lg:py-24 lg:px-8">
                <div class="max-w-3xl mx-auto text-center">
                    <h2 class="text-3xl font-extrabold text-gray-900">主な機能</h2>
                    <p class="mt-4 text-lg text-gray-500">タスク管理をより効率的に、より簡単に</p>
                </div>
                <dl class="mt-12 space-y-10 sm:space-y-0 sm:grid sm:grid-cols-3 sm:gap-x-6 sm:gap-y-12 lg:gap-x-8">
                    <div class="relative">
                        <dt>
                            <i class="fas fa-clipboard-list text-3xl text-indigo-600"></i>
                            <p class="mt-5 text-lg leading-6 font-medium text-gray-900">タスク管理</p>
                        </dt>
                        <dd class="mt-2 text-base text-gray-500">
                            簡単にタスクを作成、編集、完了できます。優先順位や期限の設定も可能です。
                        </dd>
                    </div>
                    <div class="relative">
                        <dt>
                            <i class="fas fa-users text-3xl text-indigo-600"></i>
                            <p class="mt-5 text-lg leading-6 font-medium text-gray-900">チーム協力</p>
                        </dt>
                        <dd class="mt-2 text-base text-gray-500">
                            チームメンバーとタスクを共有し、進捗状況をリアルタイムで確認できます。
                        </dd>
                    </div>
                    <div class="relative">
                        <dt>
                            <i class="fas fa-chart-line text-3xl text-indigo-600"></i>
                            <p class="mt-5 text-lg leading-6 font-medium text-gray-900">進捗分析</p>
                        </dt>
                        <dd class="mt-2 text-base text-gray-500">
                            詳細なレポートとグラフで、プロジェクトの進捗状況を視覚的に把握できます。
                        </dd>
                    </div>
                </dl>
            </div>
        </section>

        <footer class="bg-white">
            <div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 md:flex md:items-center md:justify-between lg:px-8">
                <div class="mt-8 md:mt-0 md:order-1">
                    <p class="text-center text-base text-gray-400">&copy; {{ date('Y') }} タスク管理アプリ. All rights reserved.</p>
                </div>
            </div>
        </footer>
    </div>
</body>
</html>