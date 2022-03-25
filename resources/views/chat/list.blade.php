<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('chat.title.list') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <span class="error-msg">{{ $errors->first('content') }}</span>
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-5 pl-16">
                <i class="fa-solid fa-pen text-2xl chat-create-link"></i>
                <form action="{{ route('chat.create') }}" method="POST" class="w-full create-form">
                    @csrf
                    <textarea name="content" placeholder="書き込んでね"></textarea>
                    <div class="flex mt-2">
                        <x-jet-label for="public" value="{{ __('chat.list.public') }}" />
                        <x-jet-input id="public" class="block mx-2" type="radio" name="public" value="1" checked />
                        <x-jet-label for="private" value="{{ __('chat.list.private') }}" />
                        <x-jet-input id="private" class="block mx-2" type="radio" name="public" value="0" />
                    </div>
                    <x-jet-button class="mt-2">
                        {{ __('chat.btn.upload') }}
                    </x-jet-button>
                </form>
            </div>
        </div>
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mt-2">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-11">
                <div class="text-left mb-5">
                    <a href="{{ route('chat.getReload') }}" class="ml-5">
                        <i class="fa-solid fa-rotate text-2xl"></i>
                    </a>
                </div>
                @foreach ($result as $item)
                    <div class="border rounded p-3 my-1">
                        <span class="text-sm text-gray-600">{{ $item['name'] }}</span>
                        <span class="text-xs text-gray-600">({{ $item['created_at'] }})</span>
                        @if (!$item['public'])
                            <i class="fa-solid fa-eye text-sm text-red-500"></i>
                        @endif
                        <div class="mt-1 text-lg">
                            {!! nl2br($item['content']) !!}
                        </div>
                    </div>
                @endforeach
                @if ($result->hasMorePages())
                    <form action="{{ route('chat.postReload') }}" method="POST" class="reload-form">
                        @csrf
                        <input type="hidden" name="scrol_top" value="" id="scroll-top">
                        <input type="submit" value="もっと見る" class="border rounded mt-2 w-full bg-gray-500 py-1 text-white font-bold">
                    </form>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
<script>
    $(function () {
        $('.chat-create-link').click(function () {
            $('.create-form').toggleClass('is-open');
        })
    })
    $('.reload-form').submit(function () {
        let top = $(window).scrollTop();
        $('#scroll-top').val(top);
    })
    window.onload = function () {
        console.log(@json($scrollTop));
        $(window).scrollTop(@json($scrollTop));
    }
</script>