@extends('layouts.frontend')
@section('content')
<div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
    <x-header></x-header>
    <div class="mt-8 bg-white dark:bg-gray-800 overflow-hidden shadow sm:rounded-lg">
        <div class="grid grid-cols-1 md:grid-cols-2">



            @if (isset($book))

            <div class="p-6 border-t border-gray-200 dark:border-gray-700">
                <div class="flex items-center">
                    <img src="{{$book->cover}}" alt="{{$book->title}}" class="w-8 h-8 rounded-full">
                    <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" class="w-8 h-8 text-gray-500">
                        <path d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z"></path>
                    </svg>
                    <div class="ml-4 text-lg leading-7 font-semibold"><a href="" class=" underline text-gray-900 dark:text-white">{{$book->title}}</a></div>
                </div>

                <div class="ml-12">
                    <div class="mt-2 text-gray-600 dark:text-gray-400 text-sm">
                        {{$book->content,0,200}}
                    </div>
                </div>
            </div>


            @endif

        </div>
    </div>
</div>
@endsection