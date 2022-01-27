@extends('template.index')


<?php 

$breadcrumb = [ 
    [ "name" => "หน้าหลัก" , "url" => route('dashboard_index_page') ],
    [ "name" => "ข้อมูลนักวิจัยทั้งหมด" , "url" => route('researcher_index_page') ],
    [ "name" => $idRes , "url" => route("researcher_view_page" , ["id" => $idRes ])  ],
    [ "name" => "ทำนายความเชี่ยวชาญ" , "url" => null ],
];


?>


@section('breadcrumb')

@component('common.breadcrumb' , [ "name" => "ทำนายความเชี่ยวชาญ" , "breadcrumb" => $breadcrumb])

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

<p>คำสำคัญที่อยู่ในโครงการทั้งหมดของนักวิจัย ด้วยใช้วิธี TF-IDF เพื่อหาคำสัญ </p>
<p>N  คือ จำนวน`คำ`</p>
<p>T  คือ จำนวน`คำ`ทั้งหมดที่มีในเอกสาร</p>
<p>D  คือ จำนวน`เอกสาร` ที่ใช้ทั้งหมด</p>

<hr>

<form action="{{route("keyword_saveexp_data")}}" method="post">

    {{ csrf_field() }}

    <input type="hidden" name="idRes" value="{{$idRes}}">
    <input type="hidden" name="idCard" value="{{$idCard}}">

    <div class="card">
        <div class="card-header">
            คำที่ใช้ในการประมวลผลหาความเชี่ยวชาญ
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>ลำดับ</th>
                            <th>อักษร</th>
                            <th>จำนวนคำ</th>
                            <th>TF (N/T)</th>
                            <th>IDF (log(D/N))</th>
                            <th>TF-IDF (TFxIDF)</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($dataText as $index => $item )                
                        <tr>
                            <td>{{ $index + 1}}</td>
                            <td>{{$item['text']}}</td>
                            <td>{{$item['count']}}</td>
                            <td>{{$item['tf_value']}}</td>
                            <td>{{$item['idf_value']}}</td>
                            <td>{{$item['tfidf_value']}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            ความเชี่ยวชาญที่พบ
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th scope="col">ลำดับ</th>
                            <th scope="col">ความเชี่ยวชาญ</th>
                            <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($expworkData as $index => $item )                
                        <tr>
                            <td scope="row">{{ $index + 1}}</td>
                            <td>{{$item['name_th']}}</td>
                            <td><input type="checkbox" name="boxDepId[]" value={{$item["id"]}}></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div style="padding-bottom: 1%;"></div>

    <button type="submit" class="btn btn-block btn-success">บันทึก</button>

    <div style="padding-bottom: 1%;"></div>

</form>





@endsection

@section('script_footer')

<script>
    $(function () {
    //   $("#dataTable").DataTable({
    //     "responsive": true,
    //     "paging": false,
    //     "autoWidth": true,
    //     "searching": false,
    //   });
    });
</script>


@endsection