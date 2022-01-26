@extends('template.index')


<?php 

$breadcrumb = [ 
    [ "name" => "หน้าหลัก" , "url" => "/" ],
    [ "name" => "อักษรที่ไม่ถูกจัดเก็บ" , "url" => route("bannedchar_index_page") ],
    [ "name" => "$model->bantexts_name" , "url" => null ],
]

?>

@section('breadcrumb')

@component('common.breadcrumb' , [ "name" => "อักษรที่ไม่ถูกจัดเก็บ - $model->bantexts_name" , "breadcrumb" => $breadcrumb])

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

            <form action="{{route("bannedchar_update_data")}}" method="POST">

                {{ csrf_field() }}

                <input type="hidden" value="{{$model->bantexts_id }}" name="id" />

                <div class="form-row">
                    <div class="form-group col-md">
                        <label>คำอ่าน</label>
                        <input type="text" name="text" class="form-control" value={{$model->bantexts_name}} required>
                    </div>
                </div>

                <div style="padding-bottom: 1%;"></div>

                <button type="submit" class="btn btn-success btn-block">แก้ไขข้อมูล</button>

        </div>
    </div>
</div>




@endsection