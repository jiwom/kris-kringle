@extends('layout')
@section('content')
    <div class="header">
        <h1 class="text-center">Kris Kringle Palabunutan!</h1>
    </div>
    <div class="form-group text-center">
        <h2>My name is: </h2>
        <select class="form-control" id="santa" v-on:change="enableSpin" v-model="santa">
            <option selected>---</option>
            @foreach($users['santa'] as $santaId => $santa)
                <option value="{{$santaId}}">{{$santa}}</option>
            @endforeach
        </select>
    </div>
    <div class="main">
        <h1>Click Spin then Click Stop to pick your Giftee</h1>
        <h1 id="giftee" data-names='{{ implode(',', array_keys($users['giftee'])) }}'
            data-value="{{json_encode($users['giftee'])}}">
            <span class="rotate">@{{giftee}}</span></h1>
        <input type="hidden" id="crf" value="{{ csrf_token() }}"/>
    </div>
    <div class="text-center spin-container">
        <button id="btn-spin" v-bind:class="[btnSpinEnabled ? '' : 'disabled']"
                v-bind:disabled="! btnSpinEnabled" class="btn btn-primary btn-lg" href="#"
                role="button" @click="spinName">
        @{{btnName}}
        </button>
    </div>

    <div class="menu text-center">
        <h1>Wishes</h1>
        @foreach($users['wishes'] as $name=>$wishes)
            <a href="#" onclick="event.preventDefault();" data-toggle="tooltip" title="{{$wishes}}" >{{$name}}</a>
        @endforeach
    </div>
@section('stop')