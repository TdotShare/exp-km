@extends('template.index')


<?php 

$breadcrumb = [ 
    [ "name" => "หน้าหลัก" , "url" => route('dashboard_index_page') ],
    [ "name" => "อักษรที่ไม่ถูกจัดเก็บ" , "url" => null ],
];


?>

@section('breadcrumb')

@component('common.breadcrumb' , [ "name" => "อักษรที่ไม่ถูกจัดเก็บ" , "breadcrumb" => $breadcrumb])

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

<style>
    .badge-primary {
        background-color: #9C27B0;
        /*สีพื้นหลังปุ่ม*/
    }
</style>

<a href={{route("bannedchar_create_page")}}><button class="btn btn-primary"><i class="fas fa-plus"></i> เพิ่มข้อมูล</button></a>

<div style="padding-bottom: 1%;"></div>


<table id="dataTable" class="table table-bordered table-striped" width=100%>
    <thead>
        <tr>
            <th>ลำดับ</th>
            <th>อักษร</th>
            <th>เพิ่มโดย</th>
            <th></th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        @foreach ($model as $index => $item)
        <tr>
            <td>{{$index + 1}}</td>
            <td>{{$item->bantexts_name}}</td>
            <td>{{$item->created_by}}</td>
            <td><a href={{route("bannedchar_view_page" , ["id" => $item->bantexts_id ])}} ><button class="btn btn-primary btn-block"><i class="fas fa-edit"></i> แก้ไขข้อมูล</button></a></td>
            <td><a href={{route("bannedchar_delete_data" , ["id" => $item->bantexts_id ])}}><button class="btn btn-danger btn-block" onclick="return confirm('Are you sure?')"><i class="fas fa-trash"></i> ลบข้อมูล</button></a></td>
        </tr>
        @endforeach
    </tbody>
</table>





@endsection

@section('script_footer')

<script>
    $(function () {
      $("#dataTable").DataTable({
        "responsive": true,
        "autoWidth": false,
      });
    });
</script>


@endsection