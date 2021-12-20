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
                            <div class="row align-items-center">거래요청내용
                            </div>
                        </div>
                        <form action="{{route("processOrderRequest")}}" method="post">
                            @csrf
                            <div class="card-body">
                                <div>제목 : {{$item['subject']}}</div>
                                @if(!empty($item['order_no']))
                                    <P>주문번호 : #{{$item['order_no']}}</P>
                                @endif
                                    @if(!empty($item['content']))
                                        <P>내용 : {{$item['content']}}</P>
                                    @endif

                                <textarea id="editor" name="reason">{{$item['response']}}</textarea>
                                <input type="hidden" name="id" value="{{$item['askid']}}" />
                                <input type="hidden" name="type" value="{{$item['type']}}">
                                <input type="submit" value="회답" class="mt-4 btn btn-primary">
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
