@extends('layout')
@section('content')
    <div class="max-w-4xl mx-auto px-4 py-8">
        <div class="text-center mb-10">
            <h1 class="text-4xl font-bold text-indigo-700 mb-2">Kris Kringle Palabunutan!</h1>
            <div class="w-24 h-1 bg-indigo-500 mx-auto rounded"></div>
        </div>
        
        <div class="bg-white rounded-xl shadow-lg p-6 mb-10">
            <div class="text-center mb-6">
                <h2 class="text-2xl font-semibold text-gray-800 mb-4">My name is:</h2>
                <select id="santa" v-on:change="enableSpin" v-model="santa" 
                        class="w-full max-w-xs mx-auto block px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                    <option value="">Select your name</option>
                    @foreach($users['santa'] as $santaId => $santa)
                        <option value="{{$santaId}}">{{$santa}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        
        <div class="bg-white rounded-xl shadow-lg p-6 mb-10 text-center">
            <h1 class="text-2xl font-semibold text-gray-800 mb-6">Click Spin then Click Stop to pick your Giftee</h1>
            <h1 id="giftee" data-names='{{ implode(',', array_keys($users['giftee'])) }}'
                data-value="{{json_encode($users['giftee'])}}" 
                class="text-5xl font-bold text-indigo-600 mb-8">
                <span class="rotate">@{{giftee}}</span>
            </h1>
            <input type="hidden" id="crf" value="{{ csrf_token() }}"/>
        </div>
        
        <div class="text-center mb-10">
            <button id="btn-spin" v-bind:class="[btnSpinEnabled ? '' : 'opacity-50 cursor-not-allowed']"
                    v-bind:disabled="! btnSpinEnabled" 
                    class="px-8 py-4 bg-indigo-600 text-white font-bold text-xl rounded-full shadow-lg hover:bg-indigo-700 transition duration-300 transform hover:scale-105 focus:outline-none focus:ring-4 focus:ring-indigo-400"
                    @click="spinName">
                @{{btnName}}
            </button>
        </div>
        
        <div class="bg-white rounded-xl shadow-lg p-6">
            <h1 class="text-2xl font-semibold text-gray-800 mb-6 text-center">Wishes</h1>
            <div class="flex flex-wrap justify-center gap-4">
                @foreach($users['wishes'] as $name=>$wishes)
                    <div class="group relative">
                        <button class="px-4 py-2 bg-indigo-100 text-indigo-800 rounded-lg hover:bg-indigo-200 transition duration-300">
                            {{$name}}
                        </button>
                        <div class="absolute bottom-full left-1/2 transform -translate-x-1/2 mb-2 hidden group-hover:block w-64 bg-gray-800 text-white text-sm rounded-lg py-2 px-3 z-10">
                            {{$wishes}}
                            <div class="absolute top-full left-1/2 transform -translate-x-1/2 border-4 border-transparent border-t-gray-800"></div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
