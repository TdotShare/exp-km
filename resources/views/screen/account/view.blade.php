@extends('template.index')


<?php 

$breadcrumb = [ 
    [ "name" => "หน้าหลัก" , "url" => route('dashboard_index_page') ],
    [ "name" => "ข้อมูลนักวิจัยทั้งหมด" , "url" => route('researcher_index_page') ],
    [ "name" => "$model->user_id" , "url" => null ],
];

?>

@section('breadcrumb')

@component('common.breadcrumb' , [ "name" => "ข้อมูลนักวิจัย - $model->user_first_name_th $model->user_last_name_th  ($model->user_id)" , "breadcrumb" => $breadcrumb])

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

    <a href="#CardproposalData" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="true"
        aria-controls="CardproposalData">
        <h6 class="m-0 font-weight-bold text-primary">โครงการ (proposalData)</h6>
    </a>

    <div class="collapse" id="CardproposalData">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="proposalData" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">ชื่อโครงการ</th>

                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($proposalData as $index => $item)
                        <tr>
                            <td scope="row">{{$index + 1}}</td>
                            <td>{{$item->concept_proposal_name_th}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<div class="card shadow mb-4">

    <a href="#CardprojectData" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="true"
        aria-controls="CardprojectData">
        <h6 class="m-0 font-weight-bold text-primary">โครงการ (projectData)</h6>
    </a>

    <div class="collapse" id="CardprojectData">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="projectData" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">ชื่อโครงการ</th>

                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($projectData as $index => $item)
                        <tr>
                            <td scope="row">{{$index + 1}}</td>
                            <td>{{$item->project_name_th}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<div class="card shadow mb-4">

    <a href="#CardcertificateData" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="true"
        aria-controls="CardcertificateData">
        <h6 class="m-0 font-weight-bold text-primary">ใบรับรอง (certificate)</h6>
    </a>

    <div class="collapse" id="CardcertificateData">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="certificateData" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">ชื่อใบรับรอง</th>

                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($certificateData as $index => $item)
                        <tr>
                            <td scope="row">{{$index + 1}}</td>
                            <td>{{$item->certificate_name}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<div class="card shadow mb-4">

    <a href="#CardawardData" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="true"
        aria-controls="CardawardData">
        <h6 class="m-0 font-weight-bold text-primary">รางวัล (award)</h6>
    </a>

    <div class="collapse" id="CardawardData">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="awardData" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">ชื่อรางวัล</th>

                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($awardData as $index => $item)
                        <tr>
                            <td scope="row">{{$index + 1}}</td>
                            <td>{{$item->award_name_th}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<div class="card shadow mb-4">

    <a href="#CardpatentData" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="true"
        aria-controls="CardpatentData">
        <h6 class="m-0 font-weight-bold text-primary">สิทธิบัตร (patent)</h6>
    </a>

    <div class="collapse" id="CardpatentData">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="patentData" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">ชื่อสิทธิบัตร</th>

                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($patentData as $index => $item)
                        <tr>
                            <td scope="row">{{$index + 1}}</td>
                            <td>{{$item->patent_name_th}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<div class="card shadow mb-4">

    <a href="#CardPublication" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="true"
        aria-controls="CardPublication">
        <h6 class="m-0 font-weight-bold text-primary">ผลงานตีพิมพ์ (publication)</h6>
    </a>

    <div class="collapse" id="CardPublication">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="publicationData" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">ชื่อผลงานตีพิมพ์</th>

                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($publicationData as $index => $item)
                        <tr>
                            <td scope="row">{{$index + 1}}</td>
                            <td>{{$item->publication_name_th}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>


<form action="{{route("keyword_setup_data")}}" method="POST">

    {{ csrf_field() }}


    <div class="form-group">
        <label>แยกคำจากชื่อโครงการทั้งหมด</label>
        <textarea class="form-control" name="keywordText" id="keywordText" rows="3" readonly></textarea>
    </div>

    <input type="hidden" name="idRes" value="{{$model->user_id}}">
    <input type="hidden" name="idCard" value="{{$model->user_idcard}}">

    <button type="submit" class="btn btn-success btn-block"><i class="fas fa-balance-scale-right"></i> ประมวลผล</button>

    <br>

</form>




<!-- Modal Loading -->
<div class="modal fade" id="BackdropLoading" data-backdrop="static" tabindex="-1" role="dialog"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <center>
                    <p>กรุณารอสักครู่ กำลังทำการโหลดข้อมูล</p>
                    <div style="padding-bottom: 1%;"></div>
                    <div class="spinner-border text-primary" role="status">
                        <span class="sr-only">Loading...</span>
                    </div>
                </center>

            </div>
        </div>
    </div>
</div>


@endsection


@section('script_footer')

<script>
    $(function () {
    //   $("#proposalData").DataTable({
    //     "responsive": true,
    //   });

      actionCutWord()
    });



    function actionCutWord() {

        // $("#BackdropLoading").modal({backdrop: "static"});

        let textData = '{{ $textall }}';

        //https://pythontdot.herokuapp.com/api/word_tokenize
        //https://mis-ird.rmuti.ac.th/expertiseapi/controller/keyword/char.php
        
        axios.post("https://pythontdot.herokuapp.com/api/word_tokenizes", { text: textData })
        .then(res => {

            //$('#BackdropLoading').modal('hide')

            try {

                if (res.data.bypass) {


                    console.log(res.data)

                    

                    let wordTokenize =  res.data.data
                    let textSum = ""
                    wordTokenize.forEach(el => {
                        textSum += `${el},`
                    });

                    document.getElementById("keywordText").value = textSum


                }else{
                    console.log("null data !")
                }

                
            } catch (error) {
                console.log(error)

                //$('#BackdropLoading').modal('hide')
            }
        })
        .catch(err => {
            console.error(err); 
        })
        
    }
</script>

@endsection