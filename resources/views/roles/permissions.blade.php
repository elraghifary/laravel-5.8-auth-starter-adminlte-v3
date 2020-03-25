@extends('layouts.main')

@section('title')
    <title>{{ env('APP_NAME') }} - Set Role Permission</title>
@endsection

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Set Role Permission</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('role.index') }}">Role</a></li>
                        <li class="breadcrumb-item active">Set Role Permission</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-sm-12">
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible">
                        {!! session('success') !!}
                    </div>
                @endif
                @if (session('error'))
                    <div class="alert alert-danger alert-dismissible">
                        {!! session('error') !!}
                    </div>
                @endif
                <div class="card">
                    <div class="card-body">
                        <form role="form" id="form-set-role-permission" action="{{ route('role.set_permission', $role->name) }}" method="post">
                            @csrf
                            <input type="hidden" name="_method" value="PUT">
                            <div class="form-group">
                                <label for="role">Role</label>
                                <input type="text" name="role" id="role" class="form-control" value="{{ $role->name }}" readonly>
                            </div>
                            <div class="form-group">
                                <label for="permission">Permission</label>
                                @php $no = 1; @endphp
                                @foreach ($permissions as $permission)
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" name="permission[]" value="{{ $permission }}" {{ in_array($permission, $hasPermission) ? 'checked' : '' }}>
                                        <label class="form-check-label">{{ $permission }}</label>
                                    </div>
                                @endforeach
                            </div>
                            <button class="btn btn-primary">Set Permission</button>
                            <a href="{{ route('role.index') }}" class="btn btn-default">Back</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
