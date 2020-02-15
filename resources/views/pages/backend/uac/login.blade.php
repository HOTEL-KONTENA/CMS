@extends('layouts.backend')

@section('template_content')
    <div class="wrapper">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 ml-auto mr-auto" style="padding-top:15vh;">
                    <div class="card card-user">
                        <div class="card-body ">
                            <p class="card-text"></p>
                            <div class="author">
                                <div class="block block-one"></div>
                                <div class="block block-two"></div>
                                <div class="block block-three"></div>
                                <div class="block block-four"></div>
                                <a href="#">
                                    <h4 class="title">Thunder CMS</h4>
                                </a>
                                </br>
                                <p class="description">
                                    Login
                                </p>
                            </div>
                            </br>
                            </br>
                            <p></p>
                            {!! Form::open(['url' => route('backend.logging'), 'class' => 'register-form']) !!}
                                {!! csrf_field() !!}
                                <div class='row'>
                                    <div class="col-12 p-b-2">
                                        @include('components.backend.alertbox')
                                    </div>
                                </div>
                                <div class="form-group{{ $errors->has('username') ? ' has-error' : '' }}">
                                    <label for="username" class="control-label text-secondary"><strong>Username</strong></label>
                                    <input id="username" type="phone" class="form-control font-weight-bold"  name="username" value="{{ old('username') }}" required autofocus placeholder="62xxxxxxxx">

                                    @if ($errors->has('username'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('username') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }} ">
                                    <label for="password" class="control-label text-secondary"><strong>Password</strong></label>
                                    <input id="password" type="password" class="form-control font-weight-bold" name="password" required placeholder="******">

                                    @if ($errors->has('password'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                <div class="form-group mt-5 mb-0">
                                    <button class="btn btn-primary btn-block">Login</button>
                                </div>
                            {!! Form::close() !!}
                            <div class="card-footer ">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
