@extends('template.index')


<?php 

$breadcrumb = [ 
    [ "name" => "หน้าหลัก" , "url" => "/" ],
    [ "name" => "อักษรที่ไม่ถูกจัดเก็บ" , "url" => route("bannedchar_index_page") ],
    [ "name" => "สร้าง" , "url" => null ],
]

?>

@section('breadcrumb')

@component('common.breadcrumb' , [ "name" => "สร้างอักษรที่ไม่ถูกจัดเก็บ" , "breadcrumb" => $breadcrumb])

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

            <form action="{{route("bannedchar_create_data")}}" method="POST">

                {{ csrf_field() }}

                <div class="form-row">
                    <div class="form-group col-md">
                        <label>คำอ่าน</label>
                        <input type="text" name="text" class="form-control" required>
                    </div>
                </div>

                <button type="submit" class="btn btn-success btn-block">สร้าง</button>

        </div>
    </div>
</div>



@endsection