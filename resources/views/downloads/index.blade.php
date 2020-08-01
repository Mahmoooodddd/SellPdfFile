@extends('layouts.app')

@section('content')
    <br><br>
    <table class="table table-bordered table-hover">
        <thead>
        <tr>
            <th>id</th>
            <th>name</th>
            <th>price</th>
            <th>Operation</th>
        </tr>
        </thead>
        <tbody>
        <tr>

            @foreach($downloads as $download)
                <th>{{$download->id}}</th>
                <th>{{$download->name}}</th>
                <th>{{$download->price}}</th>
                <th><a href="/buy/{{ $download->id }}" class="btn btn-primary">Buy</a></th>

        </tr>
        @endforeach
        </tbody>
    </table>

@endsection
