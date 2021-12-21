

<nav class="navbar navbar-top navbar-expand-md navbar-dark" id="navbar-main">
    <div class="container-fluid">
        <a class="h4 mb-0 text-white text-uppercase d-none d-lg-inline-block mr-4" href="{{route('order_list')}}">{{ __('등록물품') }} <span class="text-warning">{{number_format($products_num)}}</span>건</a>
        <a class="h4 mb-0 text-white text-uppercase d-none d-lg-inline-block mr-4" href="{{route('mileage_charge')}}?state=0">{{ __('마일리지충환전요청') }} <span class="text-warning">{{number_format($mileage_count)}}</span>건</a>
        <a class="h4 mb-0 text-white text-uppercase d-none d-lg-inline-block mr-4" href="{{route('order_list_request')}}">{{ __('거래취소/종료신청') }} <span class="text-warning">{{number_format($request_num)}}</span>건</a>
        <a class="h4 mb-0 text-white text-uppercase d-none d-lg-inline-block mr-4" href="{{route('use_relative')}}">{{ __('이용관련') }} <span class="text-warning">{{$game_requests_count}}</span>건</a>
        <a class="h4 mb-0 text-white text-uppercase d-none d-lg-inline-block mr-4" href="{{route('new_gaming')}}?response=1">{{ __('신규게임/서버 추가요청') }} <span class="text-warning">{{number_format($new_game_count)}}</span>건</a>
        <a class="h4 mb-0 text-white text-uppercase d-none d-lg-inline-block mr-4" href="{{route('shoppingmal_list')}}">{{ __('상품권몰 구매') }} <span class="text-warning">{{number_format($buy_lists_count)}}</span>건</a>
        <a class="h4 mb-0 text-white text-uppercase d-none d-lg-inline-block mr-4" href="javascript:;">{{ __('관리자 재고') }} <span class="text-danger">{{number_format($cash)}}</span>원</a>
        <a class="h4 mb-0 text-white text-uppercase d-none d-lg-inline-block mr-4" href="{{route('notice_list_admin')}}">
            <div class="position-relative">
                <img src="/angel/img/icons/bell.png" width="23">
                <div class="itemCntBox" id="mail-count">{{$notice_count}}</div>
            </div>
        </a>
        <form class="navbar-search navbar-search-dark form-inline mr-3 d-none d-md-flex ml-lg-auto" action="{{route("order_list")}}" method="get" >
            @csrf
            <div class="form-group mb-0">
                <div class="input-group input-group-alternative">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-search"></i></span>
                    </div>
                    <input class="form-control" placeholder="주문번호 검색하기" type="text" name="orderNo" value="{{Request::get("orderNo")}}">
                </div>
            </div>
        </form>

        <ul class="navbar-nav align-items-center d-none d-md-flex">
            <li class="nav-item dropdown">
                <a class="nav-link pr-0" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <div class="media align-items-center">
                        <span class="avatar avatar-sm rounded-circle">
                            <img alt="Image placeholder" src="{{ asset('argon') }}/img/theme/team-4-800x800.jpg">
                        </span>
                        <div class="media-body ml-2 d-none d-lg-block">
                            <span class="mb-0 text-sm  font-weight-bold">{{$user['name']}}</span>
                        </div>
                    </div>
                </a>
                <div class="dropdown-menu dropdown-menu-arrow dropdown-menu-right">
                    <div class=" dropdown-header noti-title">
                        <h6 class="text-overflow m-0">{{ __('안녕하세요!') }}</h6>
                    </div>
                    <a href="{{route('profile.edit')}}" class="dropdown-item">
                        <i class="ni ni-single-02"></i>
                        <span>{{ __('내 프로필') }}</span>
                    </a>
                    <div class="dropdown-divider"></div>
                    <a href="{{route("adminLogout")}}" class="dropdown-item">
                        <i class="ni ni-user-run"></i>
                        <span>{{ __('로그아웃') }}</span>
                    </a>
                </div>
            </li>
        </ul>
    </div>
</nav>
