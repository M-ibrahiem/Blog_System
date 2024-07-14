@extends('custom layouts.dash.app')

@section('title', 'Add Post')

@section('content')
<div class="col-xl-12">
    <section class="hk-sec-wrapper">
        <h5 class="hk-sec-title">Add New Post</h5>
        <p class="mb-25">Fill the form below to add a new Post</p>
        <div class="row">
            <div class="col-sm">
                <form action="{{ route('dashboard.posts.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="form-group">
                        <label for="image">Image</label>
                        <input type="file" class="form-control-file" id="image" name="image" onchange="showPreview(event)">
                        <img id="image_preview" style="display: none; margin-top: 10px;" width="100" alt="Preview image">
                        @error('image')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="name">Author</label>
                        <input type="text" name="name" class="form-control" id="name" placeholder="Enter name" value="{{ old('name', auth()->user()->name) }}" readonly>
                        @error('name')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="parent">Category ID</label>
                        <select class="form-control" id="parent" name="category_id">
                            <option value="">Main Category</option>
                            @foreach ($categories as $cat)
                                <option value="{{ $cat->id }}" {{ old('category_id') == $cat->id ? 'selected' : '' }}>{{ $cat->title }}</option>
                            @endforeach
                        </select>
                        @error('category_id')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    @foreach (LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                        <div class="form-group">
                            <label for="title_{{ $localeCode }}">Title ({{ strtoupper($localeCode) }})</label>
                            <input type="text" class="form-control" id="title_{{ $localeCode }}" name="{{ $localeCode }}[title]" value="{{ old("{$localeCode}.title") }}">
                            @error("{$localeCode}.title")
                                <span class="text-danger">{{ $message }}</span>
                            @enderror

                            <label for="content_{{ $localeCode }}">Content ({{ strtoupper($localeCode) }})</label>
                            <textarea class="form-control" id="content_{{ $localeCode }}" name="{{ $localeCode }}[content]" rows="3">{{ old("{$localeCode}.content") }}</textarea>
                            @error("{$localeCode}.content")
                                <span class="text-danger">{{ $message }}</span>
                            @enderror

                            <label for="small_description_{{ $localeCode }}">Small Description ({{ strtoupper($localeCode) }})</label>
                            <textarea class="form-control" id="small_description_{{ $localeCode }}" name="{{ $localeCode }}[small_description]" rows="3">{{ old("{$localeCode}.small_description") }}</textarea>
                            @error("{$localeCode}.small_description")
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    @endforeach

                    <div class="form-group">
                        <label for="tags">Tags</label>
                        <input type="text" name="tags" class="form-control" id="tags" placeholder="Enter tags, separated by commas" value="{{ old('tags') }}">
                        @error('tags')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary">Add Post</button>
                </form>
            </div>
        </div>
    </section>
</div>
<script>
    function showPreview(event) {
        const input = event.target;
        const file = input.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                const preview = document.getElementById('image_preview');
                preview.src = e.target.result;
                preview.style.display = 'block';
            };
            reader.readAsDataURL(file);
        }
    }
</script>
@endsection
