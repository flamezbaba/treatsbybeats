@extends('layouts/main')

@section('add_js')
@endsection
@section('content')
    <div class="page-content bg-white">
        <div class="dz-bnr-inr style-1 text-center bg-parallax tpbr">
            <div class="container">
                <div class="dz-bnr-inr-entry">
                    <h1>Login Account</h1>
                </div>
            </div>
        </div>
        <div class="col-md-6 offset-md-3">
            <div class="offcanvas-body">
                <div class="offcanvas-form">
                    <div class="login-head">
                        <p>@include('layouts.flash')</p>
                    </div>
                    <form method="post">
                        @csrf
                        <div class="form-group m-b15">
                            <label class="form-label">Email*</label>
                            <div class="input-group">
                                <input name="email" required type="text" class="form-control"
                                    placeholder="Enter Your Email" />
                            </div>
                        </div>
                        <div class="form-group m-b30">
                            <label class="form-label">Password*</label>
                            <div class="input-group search-input">
                                <input name="password" type="password" class="form-control dz-password"
                                    placeholder="Enter a Password" />
                                <div class="show-pass">
                                    <svg class="eye-close" xmlns="http://www.w3.org/2000/svg" width="22" height="22"
                                        fill="#8ea5c8">
                                        <path
                                            d="M11 17.188a8.71 8.71 0 0 1-1.576-.147.69.69 0 0 1-.579-.678.7.7 0 0 1 .817-.676 7.33 7.33 0 0 0 1.339.127c4.073 0 7.61-3.566 8.722-4.812a18.51 18.51 0 0 0-2.434-2.274.69.69 0 0 1 .335-1.226.69.69 0 0 1 .268.019c.087.024.169.064.24.12a18.79 18.79 0 0 1 3.036 2.939.69.69 0 0 1 0 .848c-.185.234-4.581 5.763-10.167 5.763zm7.361-13.549a.69.69 0 0 0-.972 0l-2.186 2.186a10.68 10.68 0 0 0-2.606-.864c-.527-.099-1.061-.149-1.597-.149-5.585 0-9.982 5.528-10.166 5.763a.69.69 0 0 0 0 .848c.897 1.09 1.915 2.075 3.033 2.936.529.415 1.083.796 1.66 1.142l-1.888 1.887c-.066.063-.118.139-.154.223a.69.69 0 0 0 .145.757.67.67 0 0 0 .226.15c.085.034.175.052.266.051a.69.69 0 0 0 .265-.056c.084-.036.16-.088.223-.154l13.75-13.75a.69.69 0 0 0 0-.972zm-13.65 9.636A18.51 18.51 0 0 1 2.278 11C3.39 9.754 6.927 6.187 11 6.187a7.31 7.31 0 0 1 1.348.127 8.92 8.92 0 0 1 1.814.55L12.895 8.13c-.661-.437-1.453-.632-2.241-.552a3.44 3.44 0 0 0-2.085.989c-.56.56-.91 1.297-.989 2.085a3.44 3.44 0 0 0 .552 2.241l-1.601 1.604a14.43 14.43 0 0 1-1.82-1.222zm4.432-1.392c-.134-.275-.204-.577-.206-.883a2.07 2.07 0 0 1 .6-1.456 2.12 2.12 0 0 1 2.338-.392l-2.731 2.731z">
                                        </path>
                                    </svg>
                                    <svg class="eye-open" xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                        fill="#8ea5c8">
                                        <path
                                            d="M19.873 9.611c-.179-.244-4.436-5.985-9.873-5.985S.305 9.367.127 9.611a.66.66 0 0 0 0 .778c.178.244 4.436 5.985 9.873 5.985s9.694-5.74 9.873-5.984a.66.66 0 0 0 0-.778zM10 15.055c-4.005 0-7.474-3.81-8.501-5.055C2.525 8.753 5.986 4.945 10 4.945c4.005 0 7.473 3.809 8.501 5.055-1.025 1.247-4.487 5.054-8.501 5.054zm0-9.011A3.96 3.96 0 0 0 6.044 10 3.96 3.96 0 0 0 10 13.956 3.96 3.96 0 0 0 13.956 10 3.96 3.96 0 0 0 10 6.044zm0 6.593A2.64 2.64 0 0 1 7.363 10 2.64 2.64 0 0 1 10 7.363 2.64 2.64 0 0 1 12.637 10 2.64 2.64 0 0 1 10 12.637z">
                                        </path>
                                    </svg>
                                </div>
                            </div>
                        </div>
                        <button name="login" value="submit" type="submit" class="btn btn-primary w-100 d-block">
                            Log In
                        </button>
                    </form>

                    <p class="text-center m-t30">
                        Not registered?
                        <a class="register text-primary font-weight-500" href="{{ route('user.register') }}" role="button"
                            aria-controls="offcanvasRegister">Register
                            here</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
@endsection
