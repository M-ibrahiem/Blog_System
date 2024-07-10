@extends('dash.custom layouts.dash.app')

@section('title', 'Settings')
@section('content')

{{-- <div class="row"> --}}
    <div class="col-xl-12">
        <section class="hk-sec-wrapper">
            <h5 class="hk-sec-title">Settings</h5>
            <p class="mb-25">List of all settings</p>
            <div class="row">
                <div class="col-sm">
                    <a href="{{ route('dashboard.setting.create') }}" class="btn btn-info mb-3">Add New</a>
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Logo</th>
                                    <th>Favicon</th>
                                    <th>Facebook</th>
                                    <th>LinkedIn</th>
                                    <th>Phone</th>
                                    <th>Email</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($data as $setting)
                                    <tr>
                                        <td>{{ $loop->index + 1 }}</td>
                                        <td>
                                            @if($setting->getFirstMediaUrl('logos'))
                                                <img src="{{ $setting->getFirstMediaUrl('logos') }}" alt="Logo" width="50">
                                            @endif
                                        </td>
                                        <td>
                                            @if($setting->getFirstMediaUrl('favicons'))
                                                <img src="{{ $setting->getFirstMediaUrl('favicons') }}" alt="Favicon" width="50">
                                            @endif
                                        </td>
                                        <td>{{ $setting->facebook }}</td>
                                        <td>{{ $setting->linkedin }}</td>
                                        <td>{{ $setting->phone }}</td>
                                        <td>{{ $setting->email }}</td>
                                        <td>
                                            <div class="d-flex">
                                                <a href="{{ route('dashboard.setting.edit', $setting->id) }}"
                                                    class="btn btn-icon btn-secondary btn-icon-style-1 mr-2">
                                                    <span class="btn-icon-wrap"><i class="fa fa-pencil"></i></span> Edit
                                                </a>
                                                <form action="{{ route('dashboard.setting.destroy', $setting->id) }}"
                                                    method="POST" style="display: inline;">
                                                    @csrf
                                                    @method('DELETE')

                                                    <button type="submit"
                                                        class="btn btn-icon btn-danger btn-icon-style-1"
                                                        onclick="return confirm('Are you sure you want to delete this setting?')">
                                                        <span class="btn-icon-wrap"><i class="icon-trash"></i></span> Delete
                                                    </button>
                                                </form>
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
</div>

@endsection
