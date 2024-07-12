@extends('dash.custom layouts.dash.app')

@section('title', 'Add Category')

@section('content')
    <div class="col-xl-12">
        <section class="hk-sec-wrapper">
            <h5 class="hk-sec-title">Add New Category</h5>
            <p class="mb-25">Fill the form below to add a new category</p>
            <div class="row">
                <div class="col-sm">
                    <form action="{{ route('dashboard.categories.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="title_en">Title (EN)</label>
                            <input type="text" class="form-control" id="title_en" name="en[title]" value="{{ old('en.title') }}">
                        </div>
                        @error('en.title')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                        <div class="form-group">
                            <label for="title_ar">Title (AR)</label>
                            <input type="text" class="form-control" id="title_ar" name="ar[title]" value="{{ old('ar.title') }}">
                        </div>
                        @error('ar.title')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                        <div class="form-group">
                            <label for="content_en">Content (EN)</label>
                            <textarea class="form-control" id="content_en" name="en[content]" rows="3" value="{{ old('en.content') }}"></textarea>
                        </div>
                        @error('en.content')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                        <div class="form-group">
                            <label for="content_ar">Content (AR)</label>
                            <textarea class="form-control" id="content_ar" name="ar[content]" rows="3" value="{{ old('ar.content') }}"></textarea>
                        </div>
                        @error('ar.content')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                        <div class="form-group">
                            <label for="image">Image</label>
                            <input type="file" class="form-control-file" id="image" name="image" value="{{ old('image')}}>
                        </div>
                        @error('image')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                        <div class="form-group">
                            <label for="parent">Parent Category</label>
                            <select class="form-control" id="parent" name="parent" value="{{ old('parent')}}">
                                <option value="">Main Category</option>
                                @foreach($data as $category)
                                    <option value="{{ $category->id }}">{{ $category->title }}</option>
                                @endforeach
                            </select>
                        </div>
                        @error('parent')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                        <button type="submit" class="btn btn-primary">Add Category</button>
                    </form>
                </div>
            </div>
        </section>
    </div>
@endsection
