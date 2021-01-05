@extends('master')
@section('content')
<div class="space50">&nbsp;</div>
<div class="container beta-relative">
    <div class="pull-left">
        <h2>Chỉnh sửa sản phẩm</h2>
    </div>
    {{-- <div class="pull-right"><input type="text" placeholder="Search ID"></div> --}}
</div>
    <div class="space50">&nbsp;</div>
    {{--@include('blocks/error')--}}

    <div class="container">
        <form role="form" action="{{route('adminedit')}}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="exampleInputRoomName">Name of Product</label>
                <input type="text" name="title" id="exampleInputRoomName" class="form-control" placeholder="Enter Name" value="{{$product->title}}">
            </div>
            <div class="form-group">
                <label for="image">Image File</label>
                <input type="file" name="image" id="image" class="form-control-file" placeholder="Enter Image File" value="{{$product->image}}">
            </div>
            <div class="form-group">
                <label for="3">Price of Product</label>
                <input type="text" name="price" id="3" class="form-control" placeholder="Enter Price of Product" value="{{$product->price}}">
            </div>
            <input type="text" name="id" hidden value="{{$product->id}}">
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
</div>
<div class="space50">&nbsp;</div>
@endsection
