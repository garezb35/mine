@php
$id = "";
$money = array();
$recommended = 0;
$alias = "";
$category  = "";
$name = "";
$img = "";
$hot = 0;
$new = 0;
$description = "";
$category_alias = "";
$thumnail = "";
$status = 1;

if(!empty($item)){
    $id = $item["id"];
    $money = !empty($item['money']) ? json_decode($item['money']) : array();
    $recommended = $item['recommended'];
    $alias = $item['alias'];
    $category = $item['category'];
    $name = $item['name'];
    $img = $item['img'];
    $hot = $item['hot'];
    $new = $item['new'];
    $description = $item['description'];
    $category_alias = $item['category_alias'];
    $status = $item['status'];
    $thumnail = $item['thumnail'];
}

@endphp

@extends('admin.layouts.app', ['title' => __('User Profile')])

@section('content')
    @include('admin.users.partials.header', [
        'title' => __('Hello') . ' '. auth()->guard('admin')->user()->name,
        'description' => __('This is your profile page. You can see the progress you\'ve made with your work and manage your projects or assigned tasks'),
        'class' => 'col-lg-7'
    ])

    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col-xl-8 order-xl-1">
                <div class="card bg-secondary shadow">
                    <div class="card-header bg-white border-0">
                        <div class="row align-items-center">
                            <h3 class="mb-0">{{ __('상품권샵 관리') }}</h3>
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="post" action="{{ route('shopping_update') }}" autocomplete="off" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="id" value="{{$id}}">
                            <h6 class="heading-small text-muted mb-4">{{ __('상품권샵 아이템') }}</h6>
                            <div class="row">
                                <div class="col-xl-6">
                                    <div class="form-group">
                                        <label class="form-control-label" for="input-name">{{ __('상품권샵이름') }}</label>
                                        <input type="text" name="name" id="input-name" class="form-control form-control-alternative"  value="{{ old('name', $name) }}">
                                    </div>
                                </div>
                                <div class="col-xl-6">
                                    <div class="form-group{{ $errors->has('alias') ? ' has-danger' : '' }}">
                                        <label class="form-control-label" for="input-alias">{{ __('상품권샵아이디') }}</label>
                                        <input type="text" name="alias" id="input-alias" class="form-control form-control-alternative{{ $errors->has('alias') ? ' is-invalid' : '' }}" placeholder="{{ __('이메일') }}" value="{{ old('alias', $alias) }}" required>

                                        @if ($errors->has('alias'))
                                            <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('alias') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xl-6">
                                    <div class="form-group{{ $errors->has('category') ? ' has-danger' : '' }}">
                                        <label class="form-control-label" for="input-category">{{ __('카테고리') }}</label>
                                        <input type="text" name="category" id="input-category" class="form-control form-control-alternative{{ $errors->has('category') ? ' is-invalid' : '' }}" placeholder="{{ __('카테고리') }}" value="{{ old('category', $category) }}">

                                        @if ($errors->has('category'))
                                            <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('category') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-xl-6">
                                    <div class="form-group{{ $errors->has('category_alias') ? ' has-danger' : '' }}">
                                        <label class="form-control-label" for="input-category_alias">{{ __('Category Alias') }}</label>
                                        <input type="text" name="category_alias" id="input-category_alias" class="form-control form-control-alternative{{ $errors->has('category_alias') ? ' is-invalid' : '' }}" placeholder="{{ __('Cateogry Alias') }}" value="{{ old('category_alias', $category_alias) }}">
                                        @if ($errors->has('category_alias'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('category_alias') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xl-6">
                                    <div class="form-group">
                                        <label class="">{{ __('추천상품') }}</label>
                                        <input type="checkbox" name="recommended" id="input-recommended"  value="1" {{$recommended ?? "checked"}}>
                                        &nbsp;&nbsp;&nbsp;
                                        <label class="">{{ __('핫상품') }}</label>
                                        <input type="checkbox" name="hot" id="input-hot"  value="1" {{$hot ?? "checked"}}>
                                        &nbsp;&nbsp;&nbsp;
                                        <label class="">{{ __('새상품') }}</label>
                                        <input type="checkbox" name="new" id="input-new"  value="1" {{$new ?? "checked"}}>

                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xl-12">
                                    <div class="form-group{{ $errors->has('description') ? ' has-danger' : '' }}">
                                        <label class="form-control-label" for="input-description">{{ __('설명') }}</label>
                                        <textarea name="description" id="input-description" class="form-control form-control-alternative{{ $errors->has('description') ? ' is-invalid' : '' }}" placeholder="{{ __('설명') }}" style="min-height: 200px">{{ old('description', $description) }}</textarea>
                                        @if ($errors->has('description'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('description') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xl-6">
                                    <div class="form-group{{ $errors->has('category') ? ' has-danger' : '' }}">
                                        <label class="form-control-label" for="input-money">{{ __('상품권몰 금액') }}</label>
                                        <input type="text" name="money" id="input-money" class="form-control form-control-alternative{{ $errors->has('money') ? ' is-invalid' : '' }}" placeholder="{{ __('1000,2000,3000') }}" value="{{join(",",$money)}}">

                                        @if ($errors->has('money'))
                                            <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('money') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-xl-6">
                                    <div class="form-group{{ $errors->has('status') ? ' has-danger' : '' }}">
                                        <label class="form-control-label" for="input-status">{{ __('상품권샵 사용') }}</label>
                                        <select name="status" id="input-status" class="form-control form-control-alternative">
                                            <option value="1" {{$status == 1 ? "selected" : ""}}>사용</option>
                                            <option value="0" {{$status == 0 ? "selected" : ""}}>중지</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xl-6">
                                    <div class="form-group">
                                        <label class="form-control-label" for="input-img">{{ __('아이콘') }}</label>
                                        <input type="file" accept="image/*" onchange="loadFile(event,'img-i')" name="img">
                                        <img id="img-i" class="w-100" src="{{$img ?? "/angel/img/icons/imageno.png"}}"/>
                                    </div>
                                </div>
                                <div class="col-xl-6">
                                    <div class="form-group">
                                        <label class="form-control-label" for="input-thumnail">{{ __('썸네일') }}</label>
                                        <input type="file" accept="image/*" onchange="loadFile(event,'thumnail-i')" name="thumnail">
                                        <img id="thumnail-i" class="w-100" src="{{$thumnail ?? "/angel/img/icons/imageno.png"}}"/>
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
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
