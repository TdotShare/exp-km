@extends('template.index')


<?php 

$breadcrumb = [ 
    [ "name" => "หน้าหลัก" , "url" => "/" ],
    [ "name" => "สาขาวิชา" , "url" => null ],
]

?>

@section('breadcrumb')

@component('common.breadcrumb' , [ "name" => "สาขาวิชา" , "breadcrumb" => $breadcrumb])

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


<a href="{{route("department_create_page")}}"><button class="btn btn-success">เพิ่มข้อมูล</button></a>

<div style="padding-bottom: 1%;"></div>


<table id="dataTable" class="table table-bordered table-striped" width=100%>
    <thead>
        <tr>
            <th>ลำดับ</th>
            <th>ชื่อสาขาภาษาไทย</th>
            <th>ชื่อสาขาภาษาอังกฤษ</th>
            <th>กลุ่มสาขา</th>
            <th></th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        @foreach ($model as $index => $item)
        <tr>
            <td>{{$index + 1}}</td>
            <td>{{$item->name_th}}</td>
            <td>{{$item->name_eng}}</td>
            <td>{{$item->group_name}}</td>
            <td><a href={{route("department_update_page" , ["id" => $item->id])}}><button
                        class="btn btn-primary btn-block"><i class="fas fa-edit"></i> แก้ไขข้อมูล</button></a></td>
            <td><a href={{route("department_delete_data" , ["id" => $item->id])}}><button
                        class="btn btn-danger btn-block" onclick="return confirm('Are you sure?')" ><i class="fas fa-trash"></i> ลบข้อมูล</button></a></td>
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