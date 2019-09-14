@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Recent Books</div>

                <div class="card-body">
                    @foreach ($recent as $book)
                        <div class="card mb-4">
                            <div class="card-header">{{ $book->title }}</div>
                            <div class="card-body">
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
