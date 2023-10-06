@extends('layouts.app')

@section('title', 'Instagram Auth successful !')

@section('content')
    <div style="display: flex; align-items: center; flex-direction: column">
        @foreach($feed as $post)
            <div style="display: block">
                Caption : {{ $post->caption }}
                Date : {{ \Carbon\Carbon::createFromTimestamp($post->timestamp)->toDateTimeString() }}
            </div>
            <img style="width: 350px; height: 350px" src="{{ $post->url }}">
        @endforeach
    </div>
@endsection
