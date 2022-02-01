@extends('template.index')


<?php 

$breadcrumb = [ 
    [ "name" => "หน้าหลัก" , "url" => route('dashboard_index_page') ],
    [ "name" => "คลังอักษรที่จัดหมวด" , "url" => null ],
];


?>

@section('breadcrumb')

@component('common.breadcrumb' , [ "name" => "คลังข้อมูลอักษรที่จัดหมวด" , "breadcrumb" => $breadcrumb])

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

<a href={{route("storechar_create_page")}}><button class="btn btn-primary"><i class="fas fa-plus"></i> เพิ่มข้อมูล</button></a>

<div style="padding-bottom: 1%;"></div>


<table id="dataTable" class="table table-bordered table-striped" width=100%>
    <thead>
        <tr>
            <th>ลำดับ</th>
            <th>อักษร</th>
            <th>หมวดที่อักษรอยู่</th>
            <th></th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        @foreach ($model as $index => $item)
        <tr>
            <td>{{$index + 1}}</td>
            <td>{{$item->text}}</td>
            <td>
                @if ($item["dep_id_all"] != null)
                    
                    @foreach (json_decode($item["dep_id_all"]) as $el)

                    @php
                    $char = \App\Model\Department::find($el);
                    @endphp

                    <span class="badge badge-primary"
                        style="font-weight: normal;  font-size: 16px;">{{$char["name_th"]}}</span>

                    @endforeach
                @endif
            </td>
            <td><a href={{route("storechar_view_page" , ["id" => $item->id])}} ><button class="btn btn-primary btn-block"><i class="fas fa-edit"></i> แก้ไขข้อมูล</button></a></td>
            <td><a href={{route("storechar_delete_data" , ["id" => $item->id])}}><button class="btn btn-danger btn-block"><i class="fas fa-trash"></i> ลบข้อมูล</button></a></td>
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