@extends('custom layouts.dash.app')

@section('title', 'Edit Post')

@section('content')
    <div class="col-xl-12">
        <section class="hk-sec-wrapper">
            <h5 class="hk-sec-title">Edit Post</h5>
            <p class="mb-25">Fill the form below to edit the Post</p>
            <div class="row">
                <div class="col-sm">
                    <form action="{{ route('dashboard.posts.update', $post->id) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="image">Image</label>
                            <input type="file" class="form-control-file" id="image"
                                name="image" onchange="showPreview(event, 'image_preview')">
                            @if ($post->getFirstMediaUrl('images'))
                                <img src="{{ $post->getFirstMediaUrl('images') }}" alt="post image" id="image_preview" width="100">
                            @endif
                        </div>
                        @error('image')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror

                        <div class="form-group">
                            <label for="name">Author</label>
                            <input type="text" name="name" class="form-control" id="name"
                                placeholder="Enter name" value="{{ old('name', auth()->user()->name) }}" readonly>
                            @error('name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="parent">Category ID</label>
                            <select class="form-control" id="parent" name="category_id">
                                <option value="">Main Category</option>
                                @foreach ($categories as $cat)
                                    <option value="{{ $cat->id }}" {{ $post->category_id == $cat->id ? 'selected' : '' }}>{{ $cat->title }}</option>
                                @endforeach
                            </select>
                            @error('category_id')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        @php
                            $translations = $post->translations->keyBy('locale')->toArray();
                        @endphp
                        @foreach (LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                            <div class="form-group">
                                <label for="title_{{ $localeCode }}">Title ({{ strtoupper($localeCode) }})</label>
                                <input type="text" class="form-control" id="title_{{ $localeCode }}" name="{{ $localeCode }}[title]" value="{{ $translations[$localeCode]['title'] ?? '' }}">
                                @error("{$localeCode}.title")
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror

                                <label for="content_{{ $localeCode }}">Content ({{ strtoupper($localeCode) }})</label>
                                <textarea class="form-control" id="content_{{ $localeCode }}" name="{{ $localeCode }}[content]" rows="3">{{ $translations[$localeCode]['content'] ?? '' }}</textarea>
                                @error("{$localeCode}.content")
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror

                                <label for="small_description_{{ $localeCode }}">Small Description ({{ strtoupper($localeCode) }})</label>
                                <textarea class="form-control" id="small_description_{{ $localeCode }}" name="{{ $localeCode }}[small_description]" rows="3">{{ $translations[$localeCode]['small_description'] ?? '' }}</textarea>
                                @error("{$localeCode}.small_description")
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        @endforeach

                        <div class="form-group">
                            <label for="tags">Tags</label>
                            <input type="text" name="tags" class="form-control" id="tags"
                                placeholder="Enter tags, separated by commas" value="{{ $post->tags }}">
                            @error('tags')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary">Update Post</button>
                    </form>
                </div>
            </div>
        </section>
    </div>
    <script>
        function showPreview(event, id) {
            let file = event.target.files[0];
            if (file.type.startsWith('image/')) {
                let src = URL.createObjectURL(file);
                let prv = document.getElementById(id);
                prv.src = src;
            } else {
                alert('Please select a valid image file.');
            }
        }
    </script>
@endsection
