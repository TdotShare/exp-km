@extends('template.index')


<?php 

$breadcrumb = [ 
    [ "name" => "หน้าหลัก" , "url" => "/" ],
    [ "name" => "คลังข้อมูลอักษร" , "url" => route("storechar_index_page") ],
    [ "name" => "สร้าง" , "url" => null ],
]

?>

@section('breadcrumb')

@component('common.breadcrumb' , [ "name" => "สร้างข้อมูลคำอ่าน" , "breadcrumb" => $breadcrumb])

@endcomponent

@endsection


<!-- CONTENT -->

@section('content')

@if (session('alert'))


<div class="alert alert-{{session('status')}} alert-dismissible fade show" role="alert">
    {{ session('message') }}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>

@endif


<div class="card shadow mb-4">

    <a href="#collapseCardExample" class="d-block card-header py-3" data-toggle="collapse" role="button"
        aria-expanded="true" aria-controls="collapseCardExample">
        <h6 class="m-0 font-weight-bold text-primary">เพิ่มคำอ่าน</h6>
    </a>

    <div class="collapse show" id="collapseCardExample">
        <div class="card-body">

            <form action="{{route("storechar_create_data")}}" method="POST">

                {{ csrf_field() }}

                <div class="form-row">
                    <div class="form-group col-md">
                        <label>คำอ่าน</label>
                        <input type="text" name="text" class="form-control" required>
                    </div>
                </div>


                <div class="form-row">
                    <div class="form-group col-md">
                        <label>จัดหมวดหมู่คำอ่าน</label>
                        <select class="selectpicker form-control" name="dep_all[]" data-live-search="true" multiple data-selected-text-format="count">
                            @foreach ($selectItem as $el)
                            <option value="{{$el["id"]}}">{{$el["name_th"]}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <button type="submit" class="btn btn-success btn-block">สร้าง</button>

                <div style="padding-bottom: 1%;"></div>
        </div>
    </div>
</div>


<script>
    $(function () {
      $('.selectpicker').selectpicker();
    });
</script>



@endsection