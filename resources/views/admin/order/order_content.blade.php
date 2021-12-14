@php
    $category = '> > 기타';
    if(!empty($item['game']['game'])){
        $category = $item['game']['game']." > ";
    }
    if(!empty($item['server']['game'])){
        $category .= $item['server']['game']." > ";
    }

$category .= $item['good_type'];

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
        <!-- Icons -->
        <link href="{{ asset('argon') }}/vendor/nucleo/css/nucleo.css" rel="stylesheet">
        <link href="{{ asset('argon') }}/vendor/@fortawesome/fontawesome-free/css/all.min.css" rel="stylesheet">
        <!-- Argon CSS -->
        <link type="text/css" href="{{ asset('argon') }}/css/argon.css" rel="stylesheet">
    </head>
    <body>
        <div class="main-content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-xl-8 mb-5 mb-xl-0">
                        <div class="card shadow">
                            <div class="card-header bg-transparent">
                                <div class="row align-items-center">거래내용
                                </div>
                            </div>
                            <div class="card-body">

                                    <table class="table-striped table-green1 table table-bordered">
                                        <colgroup>
                                            <col width="160" />
                                            <col width="250" />
                                            <col width="160" />
                                            <col />
                                        </colgroup>
                                        <tbody>
                                        <tr>
                                            <th>카테고리</th>
                                            <td colspan="3">{{$category}}</td>
                                        </tr>
                                        <tr>
                                            <th>물품제목</th>
                                            <td colspan="3">
                                                {{$item['user_text']}}
                                            </td>
                                        </tr>

                                        <tr>
                                            <th>거래번호</th>
                                            <td>#{{$item['orderNo']}}</td>
                                            <th>등록일시</th>
                                            <td>{{date("Y-m-d H:i:s",strtotime($item['created_at']))}}</td>
                                        </tr>
                                        @if(!empty($item['payitem']))
                                        </tbody>
                                    </table>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
    <script src="{{ asset('argon') }}/vendor/jquery/dist/jquery.min.js"></script>
    <script src="{{ asset('argon') }}/vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('argon') }}/js/common.js"></script>
    <script src="{{ asset('argon') }}/select2/select2.min.js"></script>
</html>
