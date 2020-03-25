@extends('layouts.main')

@section('title')
    <title>{{ env('APP_NAME') }} - Set User Role</title>
@endsection

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Set User Role</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('user.index') }}">User</a></li>
                        <li class="breadcrumb-item active">Set User Role</li>
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
                <div class="card">
                    <div class="card-body">
                        <form role="form" id="form-set-user-role" action="{{ route('user.set_role', $user->id) }}" method="post">
                            @csrf
                            <input type="hidden" name="_method" value="PUT">
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" name="name" id="name" class="form-control" value="{{ $user->name }}" readonly>
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="text" name="email" id="email" class="form-control" value="{{ $user->email }}" readonly>
                            </div>
                            <div class="form-group">
                                <label for="role">Role</label>
                                @foreach ($roles as $row)
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" name="role[]" {{ $user->hasRole($row) ? 'checked':'' }} value="{{ $row }}">
                                        <label class="form-check-label">{{ $row }}</label>
                                    </div>
                                @endforeach
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">Set Role</button>
                                <a href="{{ route('user.index') }}" class="btn btn-default">Back</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
    <script type="text/javascript">
        $( document ).ready(function() {
            $("#form-set-user-role").submit(function(event) {
                var length = $("input[name*='role']:checked").length;

                if (length <=0)  {
                    alert("Please check at least 1 role.");
                    return false;
                } else {
                    return true;
                }
            });
        });
    </script>
@endpush