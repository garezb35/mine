@php
$uids = array();
$u_alias = array();
foreach($users as $v){
    array_push($uids,$v['id']);
    array_push($u_alias,$v['name']);
}
@endphp
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', '관리자') }}</title>
    <link href="{{ asset('argon') }}/img/brand/favicon.png" rel="icon" type="image/png">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
    <link href="{{ asset('argon') }}/vendor/nucleo/css/nucleo.css" rel="stylesheet">
    <link href="{{ asset('argon') }}/vendor/@fortawesome/fontawesome-free/css/all.min.css" rel="stylesheet">
    <link type="text/css" href="{{ asset('argon') }}/css/argon.css" rel="stylesheet">
    <link rel="stylesheet" href="/angel/myroom/chat/css/chat.css">
    <script>
        var  server_domain = "210.112.174.178";
        var a_token = "{{$user['api_token']}}";
    </script>
    <script src="{{ asset('argon') }}/vendor/jquery/dist/jquery.min.js"></script>
    <script src="{{ asset('argon') }}/js/ckeditor/ckeditor.js"></script>
    <script src="{{ asset('argon') }}/js/ckeditor/sample.js"></script>
</head>
<body>
<div class="main-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-xl-8 mb-5 mb-xl-0">
                <div class="card shadow">
                    <div class="card-header bg-transparent">
                        <div class="row align-items-center">메세지 보내기
                        </div>
                    </div>
                    <form action="{{route("sendMsg")}}" method="post" id="form_process">
                        @csrf
                        <div class="card-body">
                            <div>유저네임 : {{join(',',$u_alias)}}</div>
                            <input type="hidden" name="uids" value="{{join(',',$uids)}}">
                            <input type="text" placeholder="제목" name="title" style="margin-bottom: 10px;height: 50px;width: 100%">
                            <textarea id="editor" name="reason" style="width: 100%;height: 150px" placeholder="내용"></textarea>
                            <input type="submit" value="보내기" class="mt-4 btn btn-primary">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
<script>
    $(".acceptBtn").click(function(){
        var process = $(this).data('process');
        $("#process").val(process);
        if(CKEDITOR.instances.editor.getData().trim() == ""){
            alert('내용이 비었습니다.');
            return false;
        }
        if($("#uids").val().trim() == ''){
            alert('내용이 비었습니다.');
            return false;
        }
        $("#form_process").submit();
    })
</script>
</html>
