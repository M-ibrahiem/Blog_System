@extends('custom layouts.dash.app')

@push('custom_css')
    <link href="https://cdn.datatables.net/v/bs4/jq-3.7.0/dt-2.0.8/datatables.min.css" rel="stylesheet">
@endpush
@push('custom_js')
    <script src="https://cdn.datatables.net/v/bs4/jq-3.7.0/dt-2.0.8/datatables.min.js"></script>
    <script>
        let table = new DataTable('#postsTable');
    </script>
@endpush
@section('title', 'post')
@section('content')

    <div class="col-xl-12">
        <section class="hk-sec-wrapper">
            <h5 class="hk-sec-title">post</h5>
            <p class="mb-25">List of all posts</p>
            <div class="row">
                <div class="col-sm">
                    <a href="{{ route('dashboard.posts.create') }}" class="btn btn-info mb-3">Add New</a>
                    <div class="table-responsive">
                        <table class="table table-hover mb-0" id="postsTable">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Image</th>
                                    <th>Author</th>
                                    <th>Category</th>
                                    @foreach (LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                                        <th>Title ({{ strtoupper($localeCode) }})</th>
                                        <th>Content ({{ strtoupper($localeCode) }})</th>
                                        <th>Small Description ({{ strtoupper($localeCode) }})</th>
                                        <th>Tags ({{ strtoupper($localeCode) }})</th>
                                    @endforeach
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $post)
                                    <tr>
                                        <td>{{ $loop->index + 1 }}</td>
                                        <td><img src="{{ $post->getFirstMediaUrl('images') }}" alt="post" width="50"></td>
                                        <td>{{ $post->user ? $post->user->name : 'No user' }}</td>
                                        <td>{{ $post->category ? $post->category->title : 'No Category' }}</td>
                                        @foreach (LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                                            @php
                                                $translation = $post->translate($localeCode);
                                                $tags = $translation ? explode(',', $translation->tags) : [];
                                                @endphp
                                            <td>{{ $translation ? $translation->title : '' }}</td>
                                            <td>{{ $translation ? $translation->content : '' }}</td>
                                            <td>{{ $translation ? $translation->small_description : '' }}</td>
                                            <td>
                                                @foreach ($tags as $tag)
                                                    <span class="badge badge-success badge-pill mt-15 mr-10">{{ trim($tag) }}</span>
                                                @endforeach
                                            </td>
                                        @endforeach
                                        <td>
                                            <div class="d-flex">
                                                @if ($post->deleted_at)
                                                    <a href="{{ route('dashboard.posts.restore', $post->id) }}" class="btn btn-icon btn-secondary btn-icon-style-3">
                                                        <span class="btn-icon-wrap"><i class="fa fa-undo"></i></span>
                                                    </a>
                                                    <form action="{{ route('dashboard.posts.erase', $post->id) }}" method="POST" style="display: inline;">
                                                        @method('DELETE')
                                                        @csrf
                                                        <button type="submit" class="btn btn-icon btn-info btn-icon-style-3" onclick="return confirm('Are you sure you want to delete this post?')">
                                                            <span class="btn-icon-wrap"><i class="icon-trash"></i></span>
                                                        </button>
                                                    </form>
                                                @else
                                                    <a href="{{ route('dashboard.posts.edit', $post->id) }}" class="btn btn-icon btn-secondary btn-icon-style-1 mr-2">
                                                        <span class="btn-icon-wrap"><i class="fa fa-pencil"></i></span> Edit
                                                    </a>
                                                    <form action="{{ route('dashboard.posts.destroy', $post->id) }}" method="POST" style="display: inline;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-icon btn-danger btn-icon-style-1" onclick="return confirm('Are you sure you want to delete this post?')">
                                                            <span class="btn-icon-wrap"><i class="icon-trash"></i></span>
                                                            Delete
                                                        </button>
                                                    </form>
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
