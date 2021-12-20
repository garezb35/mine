<nav class="navbar navbar-vertical fixed-left navbar-expand-md navbar-light bg-white" id="sidenav-main">
    <div class="container-fluid">

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#sidenav-collapse-main" aria-controls="sidenav-main" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <a class="navbar-brand pt-0" href="{{route('dashboard')}}">
            <img src="{{ asset('argon') }}/img/brand/blue.png" class="navbar-brand-img" alt="...">
        </a>

        <ul class="nav align-items-center d-md-none">
            <li class="nav-item dropdown">
                <a class="nav-link" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <div class="media align-items-center">
                        <span class="avatar avatar-sm rounded-circle">
                        <img alt="Image placeholder" src="{{ asset('argon') }}/img/theme/team-1-800x800.jpg">
                        </span>
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
                    <a href="#" class="dropdown-item">
                        <i class="ni ni-settings-gear-65"></i>
                        <span>{{ __('설정') }}</span>
                    </a>
                    <a href="#" class="dropdown-item">
                        <i class="ni ni-calendar-grid-58"></i>
                        <span>{{ __('Activity') }}</span>
                    </a>
                    <a href="#" class="dropdown-item">
                        <i class="ni ni-support-16"></i>
                        <span>{{ __('Support') }}</span>
                    </a>
                    <div class="dropdown-divider"></div>
                    <a href="/" class="dropdown-item" onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();">
                        <i class="ni ni-user-run"></i>
                        <span>{{ __('로그아웃') }}</span>
                    </a>
                </div>
            </li>
        </ul>

        <div class="collapse navbar-collapse" id="sidenav-collapse-main">

            <div class="navbar-collapse-header d-md-none">
                <div class="row">
                    <div class="col-6 collapse-brand">
                        <a href="/">
                            <img src="{{ asset('argon') }}/img/brand/blue.png">
                        </a>
                    </div>
                    <div class="col-6 collapse-close">
                        <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#sidenav-collapse-main" aria-controls="sidenav-main" aria-expanded="false" aria-label="Toggle sidenav">
                            <span></span>
                            <span></span>
                        </button>
                    </div>
                </div>
            </div>

            <form class="mt-4 mb-3 d-md-none">
                <div class="input-group input-group-rounded input-group-merge">
                    <input type="search" class="form-control form-control-rounded form-control-prepended" placeholder="{{ __('Search') }}" aria-label="Search">
                    <div class="input-group-prepend">
                        <div class="input-group-text">
                            <span class="fa fa-search"></span>
                        </div>
                    </div>
                </div>
            </form>

            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link {{ active_class(['dashboard']) }}" href="{{route('dashboard')}}">
                        <i class="ni ni-tv-2 text-primary"></i> {{ __('대쉬보드') }}
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#navbar-examples" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="navbar-examples">
                        <i class="fab fa-laravel" style="color: #f4645f;"></i>
                        <span class="nav-link-text">{{ __('회원관리') }}</span>
                    </a>

                    <div class="collapse {{ active_class( ["admin/members"], 'show') }}" id="navbar-examples">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a class="nav-link" href="{{route("members")}}">
                                        {{ __('회원목록') }}
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ active_class( ["admin/members?state=6"]) }}" href="{{route("members")}}?state=6">
                                    {{ __('회원탈퇴신청관리') }}
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ active_class( ["admin/members?state=3-2"]) }}" href="{{route("members")}}?state=3-2">
                                    {{ __('탈퇴회원관리') }}
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ active_class( ["admin/mileage_charge","admin/mileage_used"]) }}" href="#mileage-lists" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="mileage-lists">
                        <i class="ni ni-tv-2" style="color: #f4645f;"></i>
                        <span class="nav-link-text">{{ __('마일리지 관리') }}</span>
                    </a>

                    <div class="collapse {{ active_class( ["admin/mileage_charge","admin/mileage_used"] ,'show') }}" id="mileage-lists">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a class="nav-link {{ active_class( ["admin/mileage_charge"])}}" href="{{route("mileage_charge")}}">
                                    {{ __('마일리지충환전관리') }}
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ active_class( ["admin/mileage_used"])}}" href="{{route("mileage_used")}}">
                                    {{ __('마일리지사용내역') }}
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ active_class( ["admin/order_list","admin/order_list_request"]) }}" href="#orders-lists" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="mileage-lists">
                        <i class="ni ni-tv-2" style="color: #f4645f;"></i>
                        <span class="nav-link-text">{{ __('물품관리') }}</span>
                    </a>

                    <div class="collapse {{ active_class( ["admin/order_list","admin/order_list_request"], 'show') }}" id="orders-lists">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a class="nav-link {{ active_class( ["admin/order_list"]) }}" href="{{route("order_list")}}">
                                    {{ __('등록물품') }}
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ active_class( ["admin/order_list_request"]) }}" href="{{route("order_list_request")}}">
                                    {{ __('주문 종료/취소 요청') }}
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li class="nav-item">
                    <a class="nav-link {{ active_class( ["admin/use_relative","admin/new_gaming","admin/publish_msg"]) }}" href="#customer-lists" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="mileage-lists">
                        <i class="ni ni-tv-2" style="color: #f4645f;"></i>
                        <span class="nav-link-text">{{ __('고객센터관리') }}</span>
                    </a>

                    <div class="collapse {{ active_class( ["admin/use_relative","admin/new_gaming","admin/publish_msg"], 'show') }}" id="customer-lists">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a class="nav-link {{ active_class( ["admin/use_relative"]) }}" href="{{route("use_relative")}}">
                                    {{ __('이용관련') }}
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ active_class( ["admin/new_gaming"]) }}" href="{{route("new_gaming")}}">
                                    {{ __('신규게임/서버 추가') }}
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ active_class( ["admin/publish_msg"]) }}" href="{{route("publish_msg")}}">
                                    {{ __('공지사항관리') }}
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ active_class( ["admin/shoppingmal","admin/editShop"]) }}" href="#mall-lists" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="mileage-lists">
                        <i class="ni ni-tv-2" style="color: #f4645f;"></i>
                        <span class="nav-link-text">{{ __('상품권샵') }}</span>
                    </a>

                    <div class="collapse {{ active_class( ["admin/shoppingmal","admin/editShop","admin/shoppingmal_list"], 'show') }}" id="mall-lists">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a class="nav-link {{ active_class( ["admin/shoppingmal"]) }}" href="{{route("shoppingmal")}}">
                                    {{ __('상품권샵') }}
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ active_class( ["admin/shoppingmal_list"]) }}" href="{{route("shoppingmal_list")}}">
                                    {{ __('구매목록') }}
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ active_class( ["admin/game_management"]) }}" href="{{route("game_management")}}">
                        <i class="ni ni-planet text-blue"></i> {{ __('게임관리') }}
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>
