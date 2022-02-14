<main>
    <style>
        .fmxw-700 {
            max-width: 700px !important;
        }
        .fs-7 {
            font-size: 14px !important;
        }
        main {
            min-height: 814px;
            background: white !important;
        }

    </style>

    <section class="pb-6 bg-soft bg-white pt-6">
        <div class="container">
            <div wire:ignore.self class="row justify-content-center">
                <div class="col-12 d-flex align-items-center justify-content-center">
                    <div class="bg-white shadow-soft rounded border py-lg-0 p-4 p-lg-5 w-100 fmxw-400">
                        <div class="text-center text-md-center my-4">
                            <img src="/assets/img/logo.png" width="200" height="76">
                        </div>

                        <div class="text-center text-md-center mt-5 mb-3 fw-bolder fs-5">회원 로그인</div>

                        <form wire:submit.prevent="login" action="#" class="mt-3" method="POST">

                            <div class="form-group mb-3">
                                <div class="input-group">
                                    <input wire:model="loginId" type="text" class="form-control py-2 fs-6"
                                        placeholder="아이디" id="userid" autofocus required>
                                </div>
                                @error('loginId') <div wire:key="form" class="invalid-feedback"> {{$message}} </div>
                                @enderror
                            </div>

                            <div class="form-group">

                                <div class="form-group mb-3">
                                    <div class="input-group">
                                        <input wire:model.lazy="password" type="password" placeholder="비밀번호"
                                            class="form-control py-2 fs-6" id="password" required>
                                    </div>
                                    @error('password') <div class="invalid-feedback"> {{ $message }} </div> @enderror
                                </div>

                                <div class="d-flex justify-content-between align-items-top mb-3">
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
                                <button type="submit" class="btn btn-info fs-6 py-2">로그인</button>
                            </div>
                        </form>

                        <div class="d-flex justify-content-center mt-3 py-lg-3 border-top border-2 ">
                            <a href="{{route('user_lose_id')}}" class="btn me-2 fs-7 p-lg-1">
                                아이디찾기
                            </a>
                            <a href="{{route('user_lose_pwd')}}" class="btn me-2 fs-7 p-lg-1">
                                비밀번호찾기
                            </a>
                            <a href="{{route('user_reg_step1')}}" class="btn fs-7 p-lg-1">
                                회원가입하기
                            </a>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
