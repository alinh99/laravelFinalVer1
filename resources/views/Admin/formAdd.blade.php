@extends('master')
@section('content')
<div class="space50">&nbsp;</div>
<div class="container beta-relative">
    <div class="pull-left">
        <h2>Thêm sản phẩm</h2>
    </div>
    {{-- <div class="pull-right"><input type="text" placeholder="Search ID"></div> --}}
</div>
    <div class="space50">&nbsp;</div>
    {{--@include('blocks/error')--}}

    <div class="container">
        <form role="form" action="{{route('adminadd')}}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="exampleInputRoomName">Name of Product</label>
                <input type="text" name="title" id="exampleInputRoomName" class="form-control" placeholder="Enter Name">
            </div>
            <div class="form-group">
                <label for="image">Image File</label>
                <input type="file" name="image" id="image" class="form-control-file" placeholder="Enter Image File">
            </div>
            <div class="form-group">
                <label for="3">Price of Product</label>
                <input type="text" name="price" id="3" class="form-control" placeholder="Enter Price of Product">
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
</div>
<div class="space50">&nbsp;</div>
@endsection
