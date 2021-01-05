@extends('master')
@section('content')
    <div class="space50">&nbsp;</div>
    <div class="container beta-relative">
        <div class="pull-left"><h2>List</h2></div>
        {{-- <div class="pull-right"><input type="text" name="" id="" placeholder="Search ID"> --}}
        </div></div>
        <div class="container">
            <table class="table table-striped table-dark">
                <thead>
                    <tr>
                        <th scope="col">Id</th>
                        <th scope="col">name</th>
                        <th scope="col">image</th>
                        <th scope="col">price</th>
                    <th scope="col"><a href="{{route('getadminadd')}}" class="btn btn-primary" style="width: 80px;">Add</a></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($products as $product)
                    <tr>
                        <th scope="row">{{$product->id}}</th>
                        <td>{{$product->title}}</td>
                        <td><img src="assets/img/{{$product->image}}" alt="" style="width: 100px; height: 100px"></td>
                        <td>{{$product->price}}.000đ</td>

                    <td><form action="{{route('getadminedit',$product->id)}}" method="GET" role="form">
                        @csrf
                        <button class="btn btn-warning" name="edit" style="width: 80px">Edit</button>
                    </form>
                    <form action="{{route('admindelete',$product->id)}}" method="POST" role="form">
                        @csrf
                        <button class="btn btn-danger" name="delete" style="width: 80px">Delete</button>
                    </form>
                </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="space50">&nbsp;</div>
@endsection
