@extends('layouts-angel.app-frame')

@section('head_attach')
    <link type="text/css" rel="stylesheet" href="/angel/customer/css/menu.css" />
    <link type="text/css" rel="stylesheet" href="/angel/customer/css/customer_common.css" />
    <link type="text/css" rel="stylesheet" href="/angel/customer/myqna/css/list.css" />
@endsection

@section('foot_attach')
    <script type="text/javascript" src="/angel/customer/myqna/js/list.js"></script>
    <script type='text/javascript'>


    </script>
@endsection

@section('content')
    <div class="bg-white">
        <div>
        </div>
        <div >
            <style>
                .aside .notice {
                    height: 24px;
                    margin-top: 20px;
                    font-weight: bold;
                    border-bottom: 1px solid #E1E1E1
                }

                .aside .notice img {
                    margin: 5px 3px 0 0
                }

                .aside .notice_list {
                    margin: 0 0 30px;
                    padding-top: 10px;
                    background: none;
                    border: 0
                }

                .aside .notice_list li {
                    margin-left: 10px;
                    margin-bottom: 3px;
                    color: #767676;
                    font-size: 12px
                }

                .aside .img_wrap {
                    box-sizing: border-box;
                    width: 214px;
                    margin-bottom: 10px;
                    padding: 10px 0;
                    text-align: center;
                    border: 1px solid #E1E1E1
                }
            </style>
            @include('angel.customer.aside', ['group'=>'myqna', 'part'=>''])
            <div class="pagecontainer">
                <div class="contextual--title no-border"> 나의 질문과 답변 </div>
                <form name="signForm" id="signForm" method="post">
                    <table class="table-primary tb_list mt-10">
                        <tr>
                            <th>상태</th>
                            <th>분야</th>
                            <th>거래번호</th>
                            <th>제목</th>
                            <th>처리상황</th>
                            <th>등록일시</th>
                        </tr>
                        @foreach ($askRecord as $rec)
                            <tr>
                                <td>
                                    @if ($rec['is_read'] == 1)
                                        <img src="/angel/img/icons/ico_message.png" width="14" height="11" alt="확인" />
                                    @else
                                        <img src="/angel/img/icons/ico_message_on.png" width="14" height="11" alt="미확인" />
                                    @endif
                                </td>
                                <td>
                                    @switch ($rec['type'])
                                        @case ('cancel')
                                        취소요청
                                        @break;
                                        @case ('complete')
                                        종료요청
                                        @break;
                                        @case ('login')
                                        로그인문의
                                        @break;
                                        @case ('charge')
                                        충전/입금문의
                                        @break;
                                        @case ('exchange')
                                        출금문의
                                        @break;
                                        @case ('other')
                                        기타문의
                                        @break;
                                        @case ('faulty')
                                        비거래 물품 신고
                                        @break;
                                        @case ('newgame')
                                        신규게임/서버 추가
                                        @break;
                                    @endswitch
                                </td>
                                <td>{{$rec['order_no'] == null  ? '-' : $rec['order_no'] }}</td>
                                <td class="left"><a href="/customer/myqna/view?seq={{$rec['askid']}}">{{$rec['subject']}}</a></td>
                                <td> {{$rec['response'] == '' ? '답변 대기' : '답변 완료'}} </td>
                                <td>{{date('Y-m-d H:i:s', strtotime($rec['created_at']))}}</td>
                            </tr>
                        @endforeach

                    </table>
                </form>

                <div class="pagination__bootstrap">
                    {{$askRecord->withQueryString()->links()}}
                </div>

            </div>
            <div class="empty-high"></div>
        </div>
    </div>

@endsection

