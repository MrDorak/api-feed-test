@extends('layouts.app')

@section('title', 'Instagram Feed')

@section('content')
    <div style="display: flex; align-items: center; flex-direction: column; gap: 1rem">
        @foreach($feed as $post)
            <div style="display: flex; flex-direction: column">
                <span>
                    <b>Caption</b> : {{ $post->caption }}
                </span>
                <span>
                    <b>Date</b> : {{ \Carbon\Carbon::parse($post->timestamp)->toDateTimeString() }}
                </span>
                <img style="width: 200px; height: 200px" src="{{ $post->url }}">
            </div>
        @endforeach
    </div>
@endsection
