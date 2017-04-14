@extends('layouts.app')

@section('content')
<div id="app">
    <div class="menu-bar">
        <div class="left">
            <router-link class="brand" to="/">Super Duper <span class="brand-color">Contacts</span></router-link>
        </div>
        <div class="right links">
            <a class="link" href="/logout">Logout</a>
        </div>
    </div>
    <div class="content">
        <dashboard></dashboard>
    </div>
</div>
@endsection
