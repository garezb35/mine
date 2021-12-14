@extends('layouts-mania.app')

@section('head_attach')
    <link type="text/css" rel="stylesheet" href="/angel/myroom/customer/css/index.css" />
    <!--<script type="text/javascript" src="/angel/advertise/advertise_code_head.js?v=200727"></script>-->
    <script type="text/javascript" src="/angel/_banner/js/banner_module.js?v=210209"></script>
@endsection

@section('foot_attach')
    <script type="text/javascript"  src="/angel/myroom/customer/js/index.js"></script>
@endsection
@section('content')
    <div class="g_container" id="g_CONTENT">
        <div class="g_remocon_l">
        </div>
        @include('aside.myroom',['group'=>'settings'])
        <div class="g_content">
            <!-- ▼ 사용자 환결설정 탭 -->
            <!-- ▼ 타이틀 //-->
            <div class="g_title_blue noborder">
                환경설정
            </div>
            @include('tab.g_tab_customer',['group'=>'index'])
            <div class="service_layer" id="service_layer">
                <div class="inner">
                    <div class="title">
                        나만의 서비스 설정
                        <span>빠른 메뉴 설정을 위해 아이콘 8개를 선택하신 후 저장 버튼을 클릭하세요.</span>
                        <div class="r_area">
                            <a href="javascript:;" class="btn_white2 save" id="service_save">저장</a>
                            <a href="javascript:;" class="btn_white2 init" id="service_init">초기화</a>
                        </div>
                    </div>
                    <ul class="service_list" id="service_list">
                        <li  @if(!empty($list[1])) class="on" @endif>
                            <label>
                                <input type="checkbox" class="cs_checkbox" name="service[]" value="1" @if(!empty($list[1])) checked @endif>
                                <span class="tmp_checkbox"></span>
                                <div class="settings_bottom_icon">
                                    <img src="/angel/img/settings/my_mileage.png" />
                                    <div>내 마일리지</div>
                                </div>
                            </label>
                        </li>
                        <li @if(!empty($list[2])) class="on" @endif>
                            <label>
                                <input type="checkbox" class="cs_checkbox" name="service[]" value="2" @if(!empty($list[2])) checked @endif>
                                <span class="tmp_checkbox"></span>
                                <div class="settings_bottom_icon">
                                    <img src="/angel/img/settings/chat_history.png" />
                                    <div>상담내역보기</div>
                                </div>
                            </label>
                        </li>
                        <li @if(!empty($list[3])) class="on" @endif>
                            <label>
                                <input type="checkbox" class="cs_checkbox" name="service[]" value="3" @if(!empty($list[3])) checked @endif>
                                <span class="tmp_checkbox"></span>
                                <div class="settings_bottom_icon">
                                    <img src="/angel/img/settings/selling_products.png" />
                                    <div>판매관련물품</div>
                                </div>
                            </label>
                        </li>
                        <li @if(!empty($list[4])) class="on" @endif>
                            <label>
                                <input type="checkbox" class="cs_checkbox" name="service[]" value="4" @if(!empty($list[4])) checked @endif>
                                <span class="tmp_checkbox"></span>
                                <div class="settings_bottom_icon">
                                    <img src="/angel/img/settings/buying_products.png" />
                                    <div>구매관련물품</div>
                                </div>
                            </label>
                        </li>
                        <li @if(!empty($list[5])) class="on" @endif>
                            <label>
                                <input type="checkbox" class="cs_checkbox" name="service[]" value="5" @if(!empty($list[5])) checked @endif>
                                <span class="tmp_checkbox"></span>
                                <div class="settings_bottom_icon">
                                    <img src="/angel/img/settings/mileage_charge.png" />
                                    <div>마일리지충전</div>
                                </div>
                            </label>
                        </li>
                        <li @if(!empty($list[6])) class="on" @endif>
                            <label>
                                <input type="checkbox" class="cs_checkbox" name="service[]" value="6" @if(!empty($list[6])) checked @endif>
                                <span class="tmp_checkbox"></span>
                                <div class="settings_bottom_icon" style="left: 40px">
                                    <img src="/angel/img/settings/fee.png" />
                                    <div>수수료</div>
                                </div>
                            </label>
                        </li>
                        <li @if(!empty($list[7])) class="on" @endif>
                            <label>
                                <input type="checkbox" class="cs_checkbox" name="service[]" value="7" @if(!empty($list[7])) checked @endif>
                                <span class="tmp_checkbox"></span>
                                <div class="settings_bottom_icon" style="left: 22px">
                                    <img src="/angel/img/settings/level.png" />
                                    <div>신용등급/수수료</div>
                                </div>
                            </label>
                        </li>

                        <li @if(!empty($list[8])) class="on" @endif>
                            <label>
                                <input type="checkbox" class="cs_checkbox" name="service[]" value="8" @if(!empty($list[8])) checked @endif>
                                <span class="tmp_checkbox"></span>
                                <div class="settings_bottom_icon">
                                    <img src="/angel/img/settings/guide.png" />
                                    <div>초보가이드</div>
                                </div>
                            </label>
                        </li>
                        <li @if(!empty($list[9])) class="on" @endif>
                            <label>
                                <input type="checkbox" class="cs_checkbox" name="service[]" value="9" @if(!empty($list[9])) checked @endif>
                                <span class="tmp_checkbox"></span>
                                <div class="settings_bottom_icon" style="left: 40px;">
                                    <img src="/angel/img/settings/faq.png" />
                                    <div class="text-center">FAQ</div>
                                </div>
                            </label>
                        </li>
                        <li @if(!empty($list[10])) class="on" @endif>
                            <label>
                                <input type="checkbox" class="cs_checkbox" name="service[]" value="10" @if(!empty($list[10])) checked @endif>
                                <span class="tmp_checkbox"></span>
                                <div class="settings_bottom_icon">
                                    <img src="/angel/img/settings/message.png" />
                                    <div class="text-center">메시지함</div>
                                </div>
                            </label>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="g_finish"></div>
    </div>
@endsection
