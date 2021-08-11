@extends('layouts.master')

@section('title', 'Dashboard')

@section('pageTitle', 'Dashboard')

@section('content')

<div class="row">
    <div class="col-md-4">
        <div class="card card-profile">
            <div class="card-avatar">
                <a href="#pablo">
                    <img class="img"
                        src="{{ asset('avatar1-1.png') }}" />
                </a>
            </div>
            <div class="card-body">
                <h6 class="card-category text-gray">
                    @if (auth()->user()->type == 2)
                        Staff
                    @elseif(auth()->user()->type == 3)
                        Student
                    @else
                        Admin
                    @endif
                </h6>
                <h4 class="card-title">{{ ucfirst(auth()->user()->name) }}</h4>
                <p class="card-description">
                </p>
                {{-- @if (auth()->user()->type == 2)
                <a href="{{ route('teacher.edit', ['teacher' => auth()->user()->id]) }}" class="btn btn-rose btn-round">Edit</a>
                @elseif (auth()->user()->type == 3)
                <a href="{{ route('student.edit', ['student' => auth()->user()->id]) }}" class="btn btn-rose btn-round">Edit</a>
                @else
                <button type="button" disabled class="btn btn-rose btn-round">Edit</button>
                @endif --}}
            </div>
        </div>
    </div>

    <div class="col-md-8">
        <div class="card ">
            <div class="card-header card-header-icon card-header-rose">
                <div class="card-icon">
                    <i class="material-icons">assignment</i>
                </div>
                <h4 class="card-title ">Reset Password</h4>
            </div>
            <form method="post" action="{{ route('reset.password') }}" class="form-horizontal">
                @csrf
                <div class="card-body ">

                    <input type="hidden" name="id" value="{{ Auth()->user()->id }}">

                    <div class="row">
                        <label class="col-sm-2 col-form-label">New Password</label>
                        <div class="col-sm-10">
                            <div class="form-group">
                                <input type="password" class="form-control" name="password" id="password" required
                                    placeholder="Password" @isset($edit) value="{{ $edit->password }}" @endif>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <label class="col-sm-2 col-form-label">Confirm Password</label>
                        <div class="col-sm-10">
                            <div class="form-group">
                                <input type="password" class="form-control" placeholder="cpassword" name="cpassword"
                                    id="cPassword">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card-footer ">
                    <button type="submit" class="btn btn-fill btn-rose">@isset($edit) Update @else Submit @endif<div
                            class="ripple-container"></div>
                    </button>
                </div>
            </form>
        </div>
    </div>

</div>
@endsection