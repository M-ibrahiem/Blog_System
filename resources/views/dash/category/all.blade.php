@extends('custom layouts.dash.app')

@push('custom_css')
    <link href="https://cdn.datatables.net/v/bs4/jq-3.7.0/dt-2.0.8/datatables.min.css" rel="stylesheet">
@endpush
@push('custom_js')
    <script src="https://cdn.datatables.net/v/bs4/jq-3.7.0/dt-2.0.8/datatables.min.js"></script>
    <script>
        let table = new DataTable('#categorysTable');
    </script>
@endpush
@section('title', 'Category')
@section('content')

    <div class="col-xl-12">
        <section class="hk-sec-wrapper">
            <h5 class="hk-sec-title">Category</h5>
            <p class="mb-25">List of all Categories</p>
            <div class="row">
                <div class="col-sm">
                    <a href="{{ route('dashboard.categories.create') }}" class="btn btn-info mb-3">Add New</a>
                    <div class="table-responsive">
                        <table class="table table-hover mb-0" id="categorysTable">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Image</th>
                                    <th>Title (EN)</th>
                                    <th>Title (AR)</th>
                                    <th>Content (EN)</th>
                                    <th>Content (AR)</th>
                                    <th>Parent</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $category)
                                    @php
                                        $translations = $category->translations->keyBy('locale')->toArray();
                                    @endphp
                                    <tr>
                                        <td>{{ $loop->index + 1 }}</td>
                                        <td><img src="{{ $category->getFirstMediaUrl('images') }}" alt="category" width="50"></td>
                                        <td>{{ $translations['en']['title'] ?? $category->title }}</td>
                                        <td>{{ $translations['ar']['title'] ?? $category->title }}</td>
                                        <td>{{ $translations['en']['content'] ?? $category->content }}</td>
                                        <td>{{ $translations['ar']['content'] ?? $category->content }}</td>
                                        <td>{{ $category->parentCategory->title ?? 'Main Category' }}</td>
                                        <td>
                                            <div class="d-flex">
                                                @if($category->deleted_at)
                                                    <a href="{{ route('dashboard.categories.restore', $category->id) }}"
                                                        class="btn btn-icon btn-secondary btn-icon-style-3">
                                                        <span class="btn-icon-wrap"><i class="fa fa-undo"></i></span>
                                                    </a>
                                                    <form action="{{ route('dashboard.categories.erase', $category->id) }}"
                                                        method="POST" style="display: inline;">
                                                        @method('DELETE')
                                                        @csrf
                                                        <button type="submit" class="btn btn-icon btn-info btn-icon-style-3"
                                                            onclick="return confirm('Are you sure you want to delete this category?')">
                                                            <span class="btn-icon-wrap"><i class="icon-trash"></i></span>
                                                        </button>
                                                    </form>
                                                @else
                                                    <a href="{{ route('dashboard.categories.edit', $category->id) }}"
                                                        class="btn btn-icon btn-secondary btn-icon-style-1 mr-2">
                                                        <span class="btn-icon-wrap"><i class="fa fa-pencil"></i></span> Edit
                                                    </a>
                                                    <form action="{{ route('dashboard.categories.destroy', $category->id) }}"
                                                        method="POST" style="display: inline;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-icon btn-danger btn-icon-style-1"
                                                            onclick="return confirm('Are you sure you want to delete this category?')">
                                                            <span class="btn-icon-wrap"><i class="icon-trash"></i></span> Delete
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
