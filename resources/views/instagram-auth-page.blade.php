@extends('layouts.app')

@section('title', 'Instagram Auth')

@section('content')
    <a href="{{ $instagram_auth_url }}">Click to get Instagram permission</a>
@endsection
