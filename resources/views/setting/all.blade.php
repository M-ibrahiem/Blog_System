@extends('custom layouts.dash.app')

@section('title', 'Settings')
@section('content')

<div class="row">
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
                                        <td><img src="{{ $setting->logo }}" alt="Logo" width="50"></td>
                                        <td><img src="{{ $setting->favicon }}" alt="Favicon" width="50"></td>
                                        <td>{{ $setting->facebook }}</td>
                                        <td>{{ $setting->linkedin }}</td>
                                        <td>{{ $setting->phone }}</td>
                                        <td>{{ $setting->email }}</td>
                                        <td>
                                            <a href="{{ route('dashboard.setting.edit', $setting->id) }}" class="btn btn-primary">Edit</a>
                                            <form action="{{ route('dashboard.setting.destroy', $setting->id) }}" method="POST" style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger">Delete</button>
                                            </form>
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
