<main>
    <style>
        body {
            width: 100% !important;
            min-width: initial !important;
            background-color: white;
        }
        .input-group-login {
            width: calc(100% - 24px);
            margin: auto;
        }
        .font-sub-menu {
            font-size: 13px !important;
            padding-top: 12px !important;
            padding-bottom: 12px !important;
        }
        #userid, #password {
            font-size: 14px !important;
        }
    </style>
    <section class="pb-6 bg-soft bg-white">
        <div class="warning-19-part mb-lg-5">
            <div class="row justify-content-center py-lg-2 ">
                <div class="col-12">
                    <div class="fmxw-700 d-flex align-items-center justify-content-center m-auto" style="margin: 16px 10px !important;">
                        <div style="width: 66px;">
                            <div style="position: absolute;top: 16px;">
                                <img src="/assets/img/19red.png" width="66" height="66" alt="">
                            </div>
                        </div>
                        <div style="width: calc(100% - 66px)">
                            <div class="ps-1 fw-bold" style="font-size: 12px;margin-top: 6px;">
                                <div>본 정보내용은 청소년유해매체물로서 [정보통신만 이용촉진 및 정보보호 등에 관한 법률] 및 [청소년 보호법]의 규정에 의하여 19세미만의 청소년은 사용할수 없습니다.</div>
                                <div style="margin: 6px 0 0px;">
                                    <a href="{{route('index')}}" class="bg-gray-500 link-light" style="font-size: 11px; padding: 4px 8px;">19세 미만 나가기</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container" style="margin-top: 10px;">
            <div wire:ignore.self class="row justify-content-center">
                <div class="col-12 d-flex align-items-center justify-content-center">
                    <div class="bg-white shadow-soft rounded border w-100 fmxw-400">
                        <div class="text-center text-md-center mt-4 my-2">
                            <a href="{{route('index')}}"><img src="/assets/img/logo.png" width="" height="45"></a>
                        </div>

                        <div class="text-center text-md-center mt-3 mb-3 fw-bolder fs-5">회원 로그인</div>

                        <form wire:submit.prevent="login" action="#" class="mt-3" method="POST">

                            <div class="form-group mb-3 input-group-login">
                                <div class="input-group">
                                    <input wire:model="loginId" type="text" class="form-control py-2 fs-6"
                                        placeholder="아이디" id="userid" autofocus required>
                                </div>
                                @error('email') <div wire:key="form" class="invalid-feedback"> {{$message}} </div>
                                @enderror
                            </div>

                            <div class="form-group">

                                <div class="form-group mb-3 input-group-login">
                                    <div class="input-group">
                                        <input wire:model.lazy="password" type="password" placeholder="비밀번호"
                                            class="form-control py-2 fs-6" id="password" required>
                                    </div>
                                    @error('password') <div class="invalid-feedback"> {{ $message }} </div> @enderror
                                </div>

                                <div class="d-flex justify-content-between align-items-top mb-3 input-group-login">
                                    <div class="form-check">
                                        <input wire:model="remember_me" class="form-check-input" type="checkbox"
                                            value="" id="remember">
                                        <label class="form-check-label mb-0 fs-7" for="remember">
                                            아이디 저장
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="d-grid">
                                <button type="submit" class="btn btn-info fs-6 py-2 input-group-login">로그인</button>
                            </div>
                        </form>

                        <div class="d-flex justify-content-center mt-3 py-lg-3 border-top border-2 ">
                            <a href="{{route('user_lose_id')}}" class="btn me-2 font-sub-menu p-lg-1">
                                아이디찾기
                            </a>
                            <a href="{{route('user_lose_pwd')}}" class="btn me-2 font-sub-menu fs-7 p-lg-1">
                                비밀번호찾기
                            </a>
                            <a href="{{route('user_reg_step1')}}" class="btn fs-7 font-sub-menu p-lg-1">
                                회원가입하기
                            </a>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
