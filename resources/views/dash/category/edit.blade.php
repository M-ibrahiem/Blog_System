@extends('dash.custom layouts.dash.app')

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

                        <div class="form-group">
                            <label for="title_en">Title (EN)</label>
                            <input type="text" class="form-control" id="title_en" name="en[title]" value="{{ $translations['en']['title'] ?? '' }}">

                        </div>
                        @error('en.title')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror

                        <div class="form-group">
                            <label for="title_ar">Title (AR)</label>
                            <input type="text" class="form-control" id="title_ar" name="ar[title]" value="{{ $translations['ar']['title'] ?? '' }}">
                        </div>
                        @error('ar.title')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror

                        <div class="form-group">
                            <label for="content_en">Content (EN)</label>
                            <textarea class="form-control" id="content_en" name="en[content]" rows="3">{{ $translations['en']['content'] ?? '' }}</textarea>
                        </div>
                        @error('en.content')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror

                        <div class="form-group">
                            <label for="content_ar">Content (AR)</label>
                            <textarea class="form-control" id="content_ar" name="ar[content]" rows="3">{{ $translations['ar']['content'] ?? '' }}</textarea>
                        </div>
                        @error('ar.content')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror

                        <div class="form-group">
                            <label for="image">Image</label>
                            <input type="file" class="form-control-file" id="image" name="image">
                            @if($category->getFirstMediaUrl('images'))
                                <img src="{{ $category->getFirstMediaUrl('images') }}" alt="category image" width="100">
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

                        <button type="submit" class="btn btn-primary">Update Category</button>
                    </form>
                </div>
            </div>
        </section>
    </div>
@endsection
