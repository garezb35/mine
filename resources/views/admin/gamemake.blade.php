@php
    $id = "";
    $game = "";
    $depth = 0;
    $parent = "";
    $new  = 0;
    $unit = "";
    $order = 1;
    $status = 1;
    $discount = 1;
    $gamemony_unit = 0;
    $range = 1;
    $options = 0;
    $purchase_enable = 0;
    $character_enabled = 0;
    $tag = "";
    $alias = "";
    $icon = null;

    if(!empty($game_row)){
        $id = $game_row["id"];
        $game = $game_row['game'];
        $depth = $game_row['depth'];
        $parent = $game_row['parent'];
        $new = $game_row['new'];
        $unit = $game_row['unit'];
        $order = $game_row['order'];
        $status = $game_row['status'];
        $discount = $game_row['discount'];
        $gamemoney_unit = $game_row['gamemoney_unit'];
        $options = $game_row['options'];
        $purchase_enable = $game_row['purchase_enable'];
        $character_enabled = $game_row['character_enabled'];
        $tag = $game_row['tag'];
        $alias = $game_row['alias'];
        $icon = trim($game_row['icon']) ?? null;
        $range = $game_row['range'];
    }

@endphp

@extends('admin.layouts.app', ['title' => __('User Profile')])

@section('content')
    <div class="container-fluid mt-100">
        <div class="row">
            <div class="col-xl-8 order-xl-1">
                <div class="card bg-secondary shadow">
                    <div class="card-header bg-white border-0">
                        <div class="row align-items-center">
                            <h3 class="mb-0">{{ __('게임관리') }}</h3>
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="post" action="{{ route('UpdateMGame') }}" autocomplete="off" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="id" value="{{$id}}">
                            <div class="row">
                                <div class="col-xl-12">
                                    @if(!empty($id))
                                    <input type="hidden" name="depth" value="{{$depth}}">
                                    @endif
                                    <label class="form-control-label" for="input-depth0">{{ __('게임') }}</label>
                                    <input type="radio" name="depth" id="input-depth0"  value="0" class="depth" @if($depth == 0) checked @endif @if(!empty($id)) disabled @endif>&nbsp;&nbsp;&nbsp;
                                    <label class="form-control-label" for="input-depth1">{{ __('서버') }}</label>
                                    <input type="radio" name="depth" id="input-depth1"  value="1" class="depth" @if($depth == 1) checked @endif @if(!empty($id)) disabled @endif>&nbsp;&nbsp;
                                    <label class="form-control-label" for="input-depth2">{{ __('속성') }}</label>
                                    <input type="radio" name="depth" id="input-depth2"  value="2" class="depth" @if($depth == 2) checked @endif @if(!empty($id)) disabled @endif>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xl-12">
                                    <div class="form-group">
                                        <label class="form-control-label" for="input-parent">{{ __('게임') }}</label>
                                        <select name="parent" @if($depth == 0) disabled @endif id="parent">
                                            <option value="">선택하세요</option>
                                            @foreach($games as $g)
                                            <option value="{{$g['id']}}" @if($parent == $g['id']) selected @endif>{{$g['game']}}</option>
                                            @endforeach
                                        </select>
                                        &nbsp;&nbsp;
                                        <label class="form-control-label" for="input-status">{{ __('사용상태') }}</label>
                                        <select name="status"  id="status">
                                            <option value="1" @if($status == 1) selected @endif>사용</option>
                                            <option value="0" @if($status == 0) selected @endif>중지</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xl-12">
                                    <div class="form-group">
                                        <label class="form-control-label" for="input-order">{{ __('순위') }}</label>
                                        <input type="text" name="order" id="input-order" class="" placeholder="{{ __('순위') }}" value="{{ old('order', $order) }}" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xl-6">
                                    <div class="form-group{{ $errors->has('game') ? ' has-danger' : '' }}">
                                        <label class="form-control-label" for="input-game">{{ __('네임') }}</label>
                                        <input type="text" name="game" id="input-game" class="form-control form-control-alternative{{ $errors->has('game') ? ' is-invalid' : '' }}" placeholder="{{ __('네임') }}" value="{{ old('game', $game) }}" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                @if($depth == 0)
                                <div class="col-xl-6" id="character_displayed">
                                    <div class="form-group{{ $errors->has('character_enabled') ? ' has-danger' : '' }}">
                                        <label class="form-control-label" for="input-character_enabled">{{ __('캐릭터페이지에 현시하기') }}</label>
                                        <input type="checkbox" name="character_enabled" id="input-character_enabled"   value="1" @if($character_enabled == 1) checked @endif>
                                    </div>
                                </div>
                                <div class="col-xl-6 gameicon">
                                    <div class="form-group">
                                        <label class="form-control-label" for="input-icon">{{ __('게임아이콘') }}</label>
                                        <input type="file" accept="image/*" onchange="loadFile(event,'icon-i')" name="icon">
                                        <img id="icon-i" class="w-100" src="{{$icon ?? "/angel/img/icons/imageno.png"}}"/>
                                    </div>
                                </div>
                                @endif
                            </div>

                            <div class="row section2">
                                @if($depth == 2)
                                <div class="col-xl-12">
                                    할인가능 <input type="checkbox" name="discount" id="input-discount"   value="1" @if($discount == 1) checked @endif>&nbsp;&nbsp;
                                    게임단위(천,만,억) <input type="checkbox" name="gamemoney_unit" id="input-gamemoney_unit"   value="1" @if($gamemoney_unit == 1) checked @endif>&nbsp;&nbsp;
                                    판매수량 지정 <input type="checkbox" name="range" id="input-range"   value="1" @if($range == 1) checked @endif>&nbsp;&nbsp;
                                    아이템 옵션 <input type="checkbox" name="options" id="input-options"   value="1" @if($options == 1) checked @endif>&nbsp;&nbsp;
                                    <label class="form-control-label" for="input-unit">{{ __('속성 닉명') }}</label>
                                    <select name="unit"  id="input-unit">
                                        <option value="money" @if($unit == 'money') selected @endif>money</option>
                                        <option value="item" @if($unit == 'item') selected @endif>item</option>
                                        <option value="character" @if($unit == 'character') selected @endif>character</option>
                                        <option value="etc" @if($unit == 'etc') selected @endif>etc</option>
                                    </select>&nbsp;&nbsp;
                                    뉴 아이콘 <input type="checkbox" name="new" id="input-new"   value="1" @if($new == 1) checked @endif>&nbsp;&nbsp;
                                </div>
                                @endif
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
@section('foot_attach')
<script>
    $(document).ready(function(){
        var depth = {{$depth}};
        $(".depth").change(function(){
            depth = $(this).val();
            if(depth == 2){
                $(".section2").html('<div class="row">\
                    <div class="col-xl-12">\
                    할인가능 <input type="checkbox" name="discount" id="input-discount" value="1">&nbsp;&nbsp;\
                    게임단위(천,만,억) <input type="checkbox" name="gamemoney_unit" id="input-gamemoney_unit" value="1">&nbsp;&nbsp;\
                    판매수량 지정 <input type="checkbox" name="range" id="input-range" value="1">&nbsp;&nbsp;\
                    아이템 옵션 <input type="checkbox" name="options" id="input-options" value="1">&nbsp;&nbsp;\
                    <label class="form-control-label" for="input-unit">속성 닉명</label>\
                    <select name="unit" id="input-unit">\
                        <option value="money">money</option>\
                        <option value="character">character</option>\
                        <option value="etc">etc</option>\
                    </select>&nbsp;&nbsp;\
                    뉴 아이콘 <input type="checkbox" name="new" id="input-new" value="1">&nbsp;&nbsp;\
                </div>\
                </div>');

            }
            else{
                $(".section2").html("");
            }
            if($(this).val() == 0) {
                $("#parent").prop("disabled", true);
                $("#parent").prop('required', false)
                $("#parent").val("")

                $("#character_displayed").html('<div class="col-xs-6" id="character_displayed">\
                                                    <div class="form-group">\
                                                        <label class="form-control-label" for="input-character_enabled">캐릭터페이지에 현시하기</label>\
                                                        <input type="checkbox" name="character_enabled" id="input-character_enabled" value="1">\
                                                    </div>\
                                                </div>');
                $("#gameicon").html('<div class="form-group">\
                    <label class="form-control-label" for="input-icon">게임아이콘</label>\
                    <input type="file" accept="image/*" onchange="loadFile(event,'/icon-i/')" name="icon">\
                        <img id="icon-i" class="w-100" src="/angel/img/icons/imageno.png">\
                        </div>')
            }
            else {
                $("#parent").prop("disabled", false);
                $("#parent").prop('required', true);
                $("#character_displayed").html("");
                $("#gameicon").html("")
            }
        });

    })
</script>
@endsection
