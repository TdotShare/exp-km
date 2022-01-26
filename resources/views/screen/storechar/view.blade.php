@extends('template.index')


<?php 

$breadcrumb = [ 
    [ "name" => "หน้าหลัก" , "url" => "/" ],
    [ "name" => "คลังข้อมูลอักษร" , "url" => route("storechar_index_page") ],
    [ "name" => "$model->text" , "url" => null ],
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

            <form action="{{route("storechar_update_data")}}" method="POST">

                {{ csrf_field() }}

                <input type="hidden" value="{{$model->id}}" name="id" />

                <div class="form-row">
                    <div class="form-group col-md">
                        <label>คำอ่าน</label>
                        <input type="text" name="text" class="form-control" value={{$model->text}} required>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md">
                        <label>หมวดที่ถูกจัด</label>

                        <br>

                        @php
                        $storechar = \App\Model\Department::whereIn("id" , json_decode($model->dep_id_all) )->get();
                        @endphp

                        @if ($storechar)

                        @foreach ($storechar as $item)


                        <span class="badge badge-primary"
                            style="font-weight: normal; font-size: 16px;">{{$item["name_th"]}}</span>


                        @endforeach



                        @endif

                    </div>
                </div>

                <hr>

                <b>หมวดที่ต้องการจัดใหม่</b>

                <div style="padding-bottom: 1%;"></div>

                <select class="selectpicker form-control" name="dep_all[]" data-live-search="true" multiple
                    data-selected-text-format="count">
                    @foreach ($selectItem as $el)

                    @if (in_array($el["id"] , json_decode($model->dep_id_all) ))
                    <option value="{{$el[" id"]}}" selected>{{$el["name_th"]}}</option>
                    @else
                    <option value="{{$el[" id"]}}">{{$el["name_th"]}}</option>
                    @endif

                    @endforeach
                </select>

                <div style="padding-bottom: 1%;"></div>

                <button type="submit" class="btn btn-success btn-block">แก้ไขข้อมูล</button>

        </div>
    </div>
</div>


<script>
    $(function () {
      $('.selectpicker').selectpicker();
    });
</script>



@endsection