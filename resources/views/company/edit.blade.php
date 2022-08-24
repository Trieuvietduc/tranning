@extends('layout.app')
@section('content')
    <div id="edit"
    :data="{{ json_encode([
        'company' => $company,
    ]) }}">
    </div>
@endsection
