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
                            <div class="card-header">
                                {{ $book->title }}<br/>
                                <small class="text-secondary">
                                    {{ $book->authors->count()
                                        ? $book->authors->pluck('name')->join(', ')
                                        : ''}}
                                </small>
                            </div>
                            <div class="card-body">
                                {{ $book->descriptions->count()
                                    ? $book->descriptions->first()->description
                                    : "No description given."}}
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
