@extends('layout')
@section('content')
    <div class="header">
        <h1 class="text-center">Kris Kringle Palabunutan!</h1>
    </div>
    <div class="form-group text-center">
        <h2>My name is: </h2>
        <select class="form-control" id="user">
            @foreach(explode(',', $users['name']) as $name)
            <option>{{$name}}</option>
            @endforeach
        </select>
    </div>
    <div class="main">
        <h1>Click Spin then Click Stop to pick your Giftee</h1>
        <h1 id="giftee" data-names='{{$users['name']}}'><span class="rotate">@{{giftee}}</span></h1>
    </div>
    <div class="text-center spin-container">
        <button id="btn-spin" class="btn btn-primary btn-lg" href="#" role="button" @click="spinName"
        >@{{btnName}}</button>
    </div>

    <div class="menu text-center">
        @foreach(explode(',', $users['name']) as $name)
            <a href="#">{{$name}}</a>
        @endforeach
    </div>
@section('stop')