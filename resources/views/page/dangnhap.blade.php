@extends('master')
@section('content')
<div class="container sign-up banner">
    <div class="form-row text-center">
        <div class="col-6 sign">
            <a class="btn btn-dark mt-1" href="{{route('dangnhap')}}">ĐĂNG NHẬP</a>
        </div>
        <div class="col-6 sign">
            <a class="btn btn-dark mt-3" href="{{route('dangki')}}">ĐĂNG KÍ</a>
        </div>

        <div class="alert alert-{{session()->get('flags')}}">{{session()->get('message')}}</div>
        <form class="form-group center" method="POST" action="{{route('dangnhap')}}">
            @csrf
            <input class="email mt-3 form-control" id="name" type="text" placeholder="Nhập email hoặc tên đăng nhập" name="email"/>
            <input class="email mt-3 form-control" id="password" type="password" placeholder="Mật Khẩu" name="password"/>

            <button class="btn btn-dark mt-3 text-white" type="submit">ĐĂNG NHẬP</button>

            <a class="btn btn-dark mt-3" href="#">QUÊN MẬT KHẨU</a>
        </form>
    </div>
</div>
@endsection
