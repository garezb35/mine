@extends('admin.layouts.app', ['title' => __('User Profile')])

@section('content')
    @include('admin.users.partials.header', [
        'title' => __('Hello') . ' '. auth()->guard('admin')->user()->name,
        'description' => __('This is your profile page. You can see the progress you\'ve made with your work and manage your projects or assigned tasks'),
        'class' => 'col-lg-7'
    ])

    <div class="container-fluid mt-100">
        <div class="row">
            <div class="col-xl-8 order-xl-1">
                <div class="card bg-secondary shadow">
                    <div class="card-header bg-white border-0">
                        <div class="row align-items-center">
                            <h3 class="mb-0">{{ __('회원 편집') }}</h3>
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="post" action="{{ route('member.update') }}" autocomplete="off">
                            @csrf
                            <input type="hidden" name="page" value="{{Request::get("page")}}">
                            <input type="hidden" name="id" value="{{$muser['id']}}">
                            <h6 class="heading-small text-muted mb-4">{{ __('회원정보') }}</h6>
                            <div class="row">
                                <div class="col-xl-6">
                                    <div class="form-group">
                                        <label class="form-control-label" for="input-loginId">{{ __('로그인아이디') }}</label>
                                        <input type="text" disabled name="loginId" id="input-loginId" class="form-control form-control-alternative"  value="{{ old('loginId', $muser['loginId']) }}">
                                    </div>
                                </div>
                                <div class="col-xl-6">
                                    <div class="form-group{{ $errors->has('email') ? ' has-danger' : '' }}">
                                        <label class="form-control-label" for="input-email">{{ __('이메일') }}</label>
                                        <input type="text" name="email" id="input-email" class="form-control form-control-alternative{{ $errors->has('email') ? ' is-invalid' : '' }}" placeholder="{{ __('이메일') }}" value="{{ old('email', $muser['email']) }}" required>

                                        @if ($errors->has('email'))
                                            <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xl-6">
                                    <div class="form-group{{ $errors->has('last_name') ? ' has-danger' : '' }}">
                                        <label class="form-control-label" for="input-last_name">{{ __('라스트 네임') }}</label>
                                        <input type="text" name="last_name" id="input-last_name" class="form-control form-control-alternative{{ $errors->has('last_name') ? ' is-invalid' : '' }}" placeholder="{{ __('라스트 네임') }}" value="{{ old('last_name', $muser['last_name']) }}">

                                        @if ($errors->has('last_name'))
                                            <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('last_name') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-xl-6">
                                    <div class="form-group{{ $errors->has('first_name') ? ' has-danger' : '' }}">
                                        <label class="form-control-label" for="input-first_name">{{ __('퍼스트 네임') }}</label>
                                        <input type="text" name="first_name" id="input-first_name" class="form-control form-control-alternative{{ $errors->has('first_name') ? ' is-invalid' : '' }}" placeholder="{{ __('퍼스트 네임') }}" value="{{ old('first_name', $muser['first_name']) }}">

                                        @if ($errors->has('first_name'))
                                            <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('first_name') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xl-6">
                                    <div class="form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                                        <label class="form-control-label" for="input-name">{{ __('이름') }}</label>
                                        <input type="text" name="name" id="input-name" class="form-control form-control-alternative{{ $errors->has('name') ? ' is-invalid' : '' }}" placeholder="{{ __('이름') }}" value="{{ old('name', $muser['name']) }}" required>

                                        @if ($errors->has('name'))
                                            <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-xl-6">
                                    <div class="form-group{{ $errors->has('nickname') ? ' has-danger' : '' }}">
                                        <label class="form-control-label" for="input-nickname">{{ __('닉네임') }}</label>
                                        <input type="text" name="nickname" id="input-nickname" class="form-control form-control-alternative{{ $errors->has('nickname') ? ' is-invalid' : '' }}" placeholder="{{ __('닉네임') }}" value="{{ old('nickname', $muser['nickname']) }}" required>

                                        @if ($errors->has('nickname'))
                                            <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('nickname') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xl-6">
                                    <div class="form-group{{ $errors->has('mileage') ? ' has-danger' : '' }}">
                                        <label class="form-control-label" for="input-mileage">{{ __('마일리지') }}</label>
                                        <input type="text" name="mileage" id="input-mileage" class="form-control form-control-alternative{{ $errors->has('mileage') ? ' is-invalid' : '' }}" placeholder="{{ __('마일리지') }}" value="{{ old('mileage', $muser['mileage']) }}">

                                        @if ($errors->has('mileage'))
                                            <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('mileage') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-xl-6">
                                    <div class="form-group{{ $errors->has('point') ? ' has-danger' : '' }}">
                                        <label class="form-control-label" for="input-point">{{ __('포인트') }}</label>
                                        <input type="text" name="point" id="input-point" class="form-control form-control-alternative{{ $errors->has('point') ? ' is-invalid' : '' }}" placeholder="{{ __('포인트') }}" value="{{ old('point', $muser['point']) }}">

                                        @if ($errors->has('point'))
                                            <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('point') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xl-6">
                                    <div class="form-group{{ $errors->has('number') ? ' has-danger' : '' }}">
                                        <label class="form-control-label" for="input-number">{{ __('휴대폰번호') }}</label>
                                        <input type="text" name="number" id="input-number" class="form-control form-control-alternative{{ $errors->has('number') ? ' is-invalid' : '' }}" placeholder="{{ __('휴대폰번호 xxx-xxxx-xxxx') }}" value="{{ old('number', $muser['number']) }}">

                                        @if ($errors->has('number'))
                                            <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('number') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-xl-6">
                                    <div class="form-group{{ $errors->has('home') ? ' has-danger' : '' }}">
                                        <label class="form-control-label" for="input-home">{{ __('자택번호') }}</label>
                                        <input type="text" name="home" id="input-home" class="form-control form-control-alternative{{ $errors->has('home') ? ' is-invalid' : '' }}" placeholder="{{ __('자택번호 xxx-xxxx-xxxx') }}" value="{{ old('home', $muser['home']) }}">

                                        @if ($errors->has('home'))
                                            <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('home') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xl-6">
                                    <div class="form-group{{ $errors->has('role') ? ' has-danger' : '' }}">
                                        <label class="form-control-label" for="input-role">{{ __('등급') }}</label>
                                        <select class="form-control" name="role" required>
                                            @foreach($roles as $r)
                                            <option value="{{$r['level']}}" {{$muser['role'] == $r['level'] ? "selected": ""}}>{{$r['alias']}}</option>
                                            @endforeach
                                        </select>

                                        @if ($errors->has('role'))
                                            <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('role') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xl-6">
                                    <div class="form-group{{ $errors->has('address') ? ' has-danger' : '' }}">
                                        <label class="form-control-label" for="input-address">{{ __('주소') }}</label>
                                        <input type="text" name="address" id="input-address" class="form-control form-control-alternative{{ $errors->has('address') ? ' is-invalid' : '' }}" placeholder="{{ __('주소') }}" value="{{ old('address', $muser['address']) }}">

                                        @if ($errors->has('address'))
                                            <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('address') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-xl-6">
                                    <div class="form-group{{ $errors->has('zip') ? ' has-danger' : '' }}">
                                        <label class="form-control-label" for="input-zip">{{ __('ZIP Code') }}</label>
                                        <input type="text" name="zip" id="input-zip" class="form-control form-control-alternative{{ $errors->has('zip') ? ' is-invalid' : '' }}" placeholder="{{ __('우편번호') }}" value="{{ old('zip', $muser['zip']) }}">

                                        @if ($errors->has('zip'))
                                            <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('zip') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xl-12">
                                    <div class="form-group{{ $errors->has('email_verified_at') ? ' has-danger' : '' }}">
                                        <label class="form-control-label" for="input-email_verified_at">{{ __('이메일 인증') }}</label>
                                        <input type="checkbox" name="email_verified_at" id="input-email_verified_at"   value="1" {{!empty($muser['email_verified_at']) ? "checked": ""}}>
                                        &nbsp;&nbsp;&nbsp;
                                        <label class="form-control-label" for="input-mobile_verified">{{ __('휴대폰 인증') }}</label>
                                        <input type="checkbox" name="mobile_verified" id="input-mobile_verified"   value="1" {{$muser['mobile_verified'] == 1 ? "checked": ""}}>
                                        &nbsp;&nbsp;&nbsp;
                                        <label class="form-control-label" for="input-bank_verified">{{ __('계정 인증') }}</label>
                                        <input type="checkbox" name="bank_verified" id="input-bank_verified"   value="1" {{$muser['bank_verified'] == 1 ? "checked": ""}}>
                                    </div>
                                </div>

                            </div>
                            <div class="pl-lg-4">
                                <div class="text-center">
                                    <button type="submit" class="btn btn-success mt-4">{{ __('변경') }}</button>
                                    <button type="reset" class="btn btn-danger mt-4">{{ __('재설정') }}</button>
                                </div>
                            </div>
                        </form>
                        <hr class="my-4" />
                        <form method="post" action="{{ route('member.password') }}" autocomplete="off">
                            @csrf
                            <h6 class="heading-small text-muted mb-4">{{ __('Password') }}</h6>
                            <input type="hidden" name="id" value="{{$muser['id']}}">
                            <input type="hidden" name="page" value="{{Request::get("page")}}">
                            @if (session('password_status'))
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    {{ session('password_status') }}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif

                            <div class="pl-lg-4">
                                <div class="form-group{{ $errors->has('old_password') ? ' has-danger' : '' }}">
                                    @if ($errors->has('old_password'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('old_password') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group{{ $errors->has('password') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-password">{{ __('New Password') }}</label>
                                    <input type="password" name="password" id="input-password" class="form-control form-control-alternative{{ $errors->has('password') ? ' is-invalid' : '' }}" placeholder="{{ __('New Password') }}" value="" required>

                                    @if ($errors->has('password'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="text-center">
                                    <button type="submit" class="btn btn-success mt-4">{{ __('암호변경') }}</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
