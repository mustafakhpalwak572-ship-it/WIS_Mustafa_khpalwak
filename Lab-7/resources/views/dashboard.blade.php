@extends('layouts.app')

@section('title', 'My Books')

@section('content')
<div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-2 mb-4">
    <div>
        <h1 class="h2 mb-1">My Reading List</h1>
        <p class="text-secondary mb-0">Register and keep track of your books.</p>
    </div>
    <span class="badge text-bg-primary fs-6">{{ $books->count() }} book(s)</span>
</div>

@if (session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

<div class="card border-0 shadow-sm mb-4">
    <div class="card-header bg-white py-3">
        <h2 class="h5 mb-0">Register a new book</h2>
    </div>
    <div class="card-body p-4">
        <form action="{{ route('books.store') }}" method="POST">
            @csrf
            <div class="row g-3">
                <div class="col-12 col-md-5">
                    <label for="title" class="form-label">Title</label>
                    <input id="title" name="title" type="text" maxlength="150"
                           class="form-control @error('title') is-invalid @enderror"
                           value="{{ old('title') }}" required>
                    @error('title')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-12 col-md-4">
                    <label for="author" class="form-label">Author</label>
                    <input id="author" name="author" type="text" maxlength="100"
                           class="form-control @error('author') is-invalid @enderror"
                           value="{{ old('author') }}" required>
                    @error('author')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-12 col-md-3">
                    <label for="pages" class="form-label">Pages</label>
                    <input id="pages" name="pages" type="number" min="1" max="10000"
                           class="form-control @error('pages') is-invalid @enderror"
                           value="{{ old('pages') }}" required>
                    @error('pages')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <button type="submit" class="btn btn-primary mt-3">Register book</button>
        </form>
    </div>
</div>

<div class="card border-0 shadow-sm">
    <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
        <h2 class="h5 mb-0">My Books</h2>
        <span class="text-secondary small">Newest first</span>
    </div>
    <div class="card-body p-0">
        @if ($books->isEmpty())
            <div class="p-4">
                <div class="alert alert-info mb-0">Your reading list is empty. Register your first book above.</div>
            </div>
        @else
            <div class="table-responsive">
                <table class="table table-striped table-hover align-middle mb-0">
                    <thead class="table-dark">
                        <tr>
                            <th scope="col" class="ps-3">No.</th>
                            <th scope="col">Title</th>
                            <th scope="col">Author</th>
                            <th scope="col">Pages</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($books as $book)
                            <tr>
                                <td class="ps-3">{{ $loop->iteration }}</td>
                                <td>{{ $book->title }}</td>
                                <td>{{ $book->author }}</td>
                                <td>{{ $book->pages }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
</div>
@endsection
