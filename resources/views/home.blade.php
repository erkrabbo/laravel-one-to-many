@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row flex-column align-items-center">
        <h1 class="text-center"><a href="{{route('post.index')}}">CLICCAMI PER VEDERE I POST</a></h1>
        <h3 class="text-center"><a href="{{route('login')}}">CLICCAMI SE SEI UN AMMINISTRATORE</a></h3>
    </div>
</div>
@endsection
