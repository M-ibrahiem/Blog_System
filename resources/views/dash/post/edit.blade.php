@extends('custom layouts.dash.app')

@section('title', 'Edit Category')

@section('content')
    <div class="col-xl-12">
        <section class="hk-sec-wrapper">
            <h5 class="hk-sec-title">Edit Category</h5>
            <p class="mb-25">Fill the form below to edit the category</p>
            <div class="row">
                <div class="col-sm">
                    <form action="{{ route('dashboard.categories.update', $category->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        @php
                            $translations = $category->translations->keyBy('locale')->toArray();
                        @endphp

                        @foreach (LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                            <div class="form-group">
                                <label for="title_{{ $localeCode }}">Title ({{ strtoupper($localeCode) }})</label>
                                <input type="text" class="form-control" id="title_{{ $localeCode }}" name="{{ $localeCode }}[title]" value="{{ $translations[$localeCode]['title'] ?? '' }}">
                            </div>
                            @error("{$localeCode}.title")
                                <span class="text-danger">{{ $message }}</span>
                            @enderror

                            <div class="form-group">
                                <label for="content_{{ $localeCode }}">Content ({{ strtoupper($localeCode) }})</label>
                                <textarea class="form-control" id="content_{{ $localeCode }}" name="{{ $localeCode }}[content]" rows="3">{{ $translations[$localeCode]['content'] ?? '' }}</textarea>
                            </div>
                            @error("{$localeCode}.content")
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        @endforeach

                        <div class="form-group">
                            <label for="image">Image</label>
                            <input type="file" class="form-control-file" id="image" name="image"onchange="showPreview(event, 'image_preview')">
                            @if($category->getFirstMediaUrl('images'))
                                <img src="{{ $category->getFirstMediaUrl('images') }}" alt="category image" id="image_preview" width="100">
                            @endif
                        </div>
                        @error('image')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror

                        <div class="form-group">
                            <label for="parent">Parent Category</label>
                            <select class="form-control" id="parent" name="parent">
                                <option value="">Main Category</option>
                                @foreach ($categories as $cat)
                                    <option value="{{ $cat->id }}" {{ $category->parent == $cat->id ? 'selected' : '' }}>{{ $cat->title }}</option>
                                @endforeach
                            </select>
                        </div>
                        @error('parent')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror

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
                        <button type="submit" class="btn btn-primary">Update Category</button>
                    </form>
                </div>
            </div>
        </section>
    </div>
@endsection
