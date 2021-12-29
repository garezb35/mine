@extends('layouts-angel.app')

@section('head_attach')
    <link type="text/css" rel="stylesheet" href="/angel/myroom/myinfo/css/check.css" />
    <link type="text/css" rel="stylesheet" href="/angel/myroom/myinfo/css/myinfo_modify.css" />
@endsection

@section('foot_attach')
    <script type="text/javascript" src="/angel/myroom/myinfo/js/myinfo_modify.js"></script>
    <script>
        @if ($message = Session::get('message'))
            alert("{{$message}}")
        @endif
    </script>
@endsection
@section('content')
    <div class="container_fulids" id="module-teaser-fullscreen" style="text-align: center">
        <div class="recommend_e34rf">
        </div>
        @include('tab.member',['group'=>'change'])
        <form id="certifyForm" method="post" action="{{route('myinfo_alter')}}">
            @csrf
            <table class="g_gray_tb g_sky_table p-00" id="report_tb" style="width: 600px;margin: auto">
                <colgroup>
                    <col width="200">
                </colgroup>
                <tbody>
                    <tr class="report_tr">
                        <th>현재 비밀번호</th>
                        <td>
                            <input type="text" name="old" value="" id="old" maxlength="40" class="pass_ele"  required="" placeholder="현재 비밀번호를 입력하세요" autofocus>
                        </td>
                    </tr>
                    <tr class="report_tr">
                        <th>새 비밀번호</th>
                        <td>
                            <input type="password" name="password" value="" id="confirm" maxlength="40" class="pass_ele"  required="">
                        </td>
                    </tr>
                    <tr class="report_tr">
                        <th>새 비밀번호 확인</th>
                        <td>
                            <input type="password" name="passwordConfirmation" value="" id="new" maxlength="40" class="pass_ele"  required="">
                        </td>
                    </tr>
                </tbody>
            </table>
            <input type="submit" class="btn-default btn-suc" value="변경하기" style="margin-top: 15px;text-align: center">
        </form>
    </div>
@endsection
<style>
    .pass_ele{
        width: 100%;
        height: 35px;
        border: none;
        padding-left: 10px;
    }

    .pass_ele:focus{
        outline: none;
    }
    .p-00 td{
        padding: 0px;
    }
</style>
