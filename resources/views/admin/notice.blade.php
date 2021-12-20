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
                        <div class="row align-items-center">공지사항
                        </div>
                    </div>
                    <form action="{{route("updateNotice")}}" method="post">
                        @csrf
                        <div class="card-body">
                            <div class="form-group">
                                <label class="form-control-label" for="input-loginId">제목</label>
                                <input type="text"  name="title" id="input-loginId" class="form-control form-control-alternative" value="{{$item['title'] ?? ""}}">
                            </div>
                            <textarea id="editor" name="contents">{{$item['content'] ?? ""}}</textarea>
                            <input type="hidden" name="id" value="{{$item['id'] ?? ""}}" />
                            <input type="submit" value="확인" class="mt-4 btn btn-primary">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
<script>
    initSample();
</script>
</html>
