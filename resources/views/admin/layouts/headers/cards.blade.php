<div class="header bg-gradient-primary pb-8 pt-5 pt-md-8">
    <div class="container-fluid">
        <div class="header-body">
            <!-- Card stats -->
            <div class="row">
                <div class="col-xl-3 col-lg-6">
                    <div class="card card-stats mb-4 mb-xl-0">
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <h5 class="card-title text-uppercase text-muted mb-0">판매/구매등록물품</h5>
                                    <span class="h2 font-weight-bold mb-0">{{number_format($products_num)}}</span>
                                </div>
                                <div class="col-auto">
                                    <div class="icon icon-shape bg-danger text-white rounded-circle shadow">
                                        <i class="fas fa-chart-bar"></i>
                                    </div>
                                </div>
                            </div>
{{--                            <p class="mt-3 mb-0 text-muted text-sm">--}}
{{--                                <span class="text-success mr-2"><i class="fa fa-arrow-up"></i> 3.48%</span>--}}
{{--                                <span class="text-nowrap">Since last month</span>--}}
{{--                            </p>--}}
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-6">
                    <div class="card card-stats mb-4 mb-xl-0">
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <h5 class="card-title text-uppercase text-muted mb-0">구매 취소/종료신청</h5>
                                    <span class="h2 font-weight-bold mb-0">{{number_format($request_num)}}</span>
                                </div>
                                <div class="col-auto">
                                    <div class="icon icon-shape bg-warning text-white rounded-circle shadow">
                                        <i class="fas fa-chart-pie"></i>
                                    </div>
                                </div>
                            </div>
{{--                            <p class="mt-3 mb-0 text-muted text-sm">--}}
{{--                                <span class="text-danger mr-2"><i class="fas fa-arrow-down"></i> 3.48%</span>--}}
{{--                                <span class="text-nowrap">Since last week</span>--}}
{{--                            </p>--}}
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-6">
                    <div class="card card-stats mb-4 mb-xl-0">
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <h5 class="card-title text-uppercase text-muted mb-0">회원</h5>
                                    <span class="h2 font-weight-bold mb-0">{{number_format($users_num)}}</span>
                                </div>
                                <div class="col-auto">
                                    <div class="icon icon-shape bg-yellow text-white rounded-circle shadow">
                                        <i class="fas fa-users"></i>
                                    </div>
                                </div>
                            </div>
{{--                            <p class="mt-3 mb-0 text-muted text-sm">--}}
{{--                                <span class="text-warning mr-2"><i class="fas fa-arrow-down"></i> 1.10%</span>--}}
{{--                                <span class="text-nowrap">Since yesterday</span>--}}
{{--                            </p>--}}
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-6">
                    <div class="card card-stats mb-4 mb-xl-0">
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <h5 class="card-title text-uppercase text-muted mb-0">관리자 재고</h5>
                                    <span class="h2 font-weight-bold mb-0">{{number_format($cash)}}원</span>
                                </div>
                                <div class="col-auto">
                                    <div class="icon icon-shape bg-info text-white rounded-circle shadow">
                                        <i class="fas fa-percent"></i>
                                    </div>
                                </div>
                            </div>
{{--                            <p class="mt-3 mb-0 text-muted text-sm">--}}
{{--                                <span class="text-success mr-2"><i class="fas fa-arrow-up"></i> 12%</span>--}}
{{--                                <span class="text-nowrap">Since last month</span>--}}
{{--                            </p>--}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>