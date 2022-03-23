<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('chat.title.list') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <span class="error-msg">{{ $errors->first('content') }}</span>
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-11">
                <form action="{{ route('chat.create') }}" method="POST" class="flex" name="create_form">
                    @csrf
                    <a href="javascript: create_form.submit();" class="chat-create-link mx-5">
                        <i class="fa-solid fa-pen text-2xl"></i>
                    </a>
                    <textarea name="content" placeholder="書き込んでね"></textarea>
                </form>
            </div>
        </div>
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mt-2">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-11">
                <div class="text-left mb-5">
                    <a href="{{ route('chat.reload') }}" class="ml-5">
                        <i class="fa-solid fa-rotate text-2xl"></i>
                    </a>
                </div>
                @foreach ($result as $item)
                    <div class="border rounded p-3 my-1">
                        <span class="text-sm text-gray-600">{{ $item['name'] }}</span>
                        <span class="text-xs text-gray-600">({{ $item['created_at'] }})</span>
                        <div class="mt-1 text-lg">
                            {!! nl2br($item['content']) !!}
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</x-app-layout>
