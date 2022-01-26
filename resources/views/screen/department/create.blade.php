@extends('template.index')


<?php 

$breadcrumb = [ 
    [ "name" => "หน้าหลัก" , "url" => "/" ],
    [ "name" => "สาขาวิชา" , "url" => route("department_index_page") ],
    [ "name" => "สร้าง" , "url" => null ],
]

?>

@section('breadcrumb')

@component('common.breadcrumb' , [ "name" => "สร้างสาขาวิชา" , "breadcrumb" => $breadcrumb])

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
        <h6 class="m-0 font-weight-bold text-primary">เพิ่มข้อมูลสาขาวิชา</h6>
    </a>

    <div class="collapse show" id="collapseCardExample">
        <div class="card-body">

            <form action="{{route("department_create_data")}}" method="POST">

                {{ csrf_field() }}

                <div class="form-row">
                    <div class="form-group col-md">
                        <label >ชื่อสาขาภาษาไทย</label>
                        <input type="text" name="name_th"  class="form-control" required>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md">
                        <label >ชื่อสาขาภาษาอังกฤษ</label>
                        <input type="text" name="name_eng" class="form-control" required>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md">
                        <label >ชื่อกลุ่มสาขา</label>
                        <input type="text" name="group_name"  class="form-control" >
                    </div>
                </div>

                <button type="submit" class="btn btn-success btn-block">สร้าง</button>

        </div>
    </div>
</div>



@endsection