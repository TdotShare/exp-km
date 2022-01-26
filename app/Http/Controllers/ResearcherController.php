<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Account;
use App\Model\Bantexts;
use App\Model\Keyword;
use App\Model\Department;

use App\Model\Process\Proposal;
use App\Model\Process\Project;
use App\Model\Process\Certificate;
use App\Model\Process\Award;
use App\Model\Process\Patent;
use App\Model\Process\Publication;

class ResearcherController extends Controller
{

    public function actionIndex()
    {
        $model = Account::all();
        return view("screen.account.index", ["model" => $model]);
    }

    public function actionView($id)
    {
        $model = Account::find($id);

        if ($model) {

            $textall = "";

            $proposalData = Proposal::select("concept_proposal_name_th")->where("user_idcard",  "=", $model->user_idcard)->get();
            $projectData = Project::select("project_name_th")->where("user_idcard",  "=", $model->user_idcard)->get();
            $certificateData = Certificate::select("certificate_name")->where("user_idcard",  "=", $model->user_idcard)->get();
            $awardData = Award::select("award_name_th")->where("user_idcard",  "=", $model->user_idcard)->get();
            $patentData = Patent::select("patent_name_th")->where("user_idcard",  "=", $model->user_idcard)->get();
            $publicationData = Publication::select("publication_name_th")->where("user_idcard",  "=", $model->user_idcard)->get();

            foreach ($proposalData as $key => $item) {
                $textall .= strip_tags($item['concept_proposal_name_th'])."+";
            }

            foreach ($projectData as $key => $item) {
                $textall .= strip_tags($item['project_name_th'])."+";
            }

            foreach ($certificateData as $key => $item) {
                $textall .= strip_tags($item['certificate_name'])."+";
            }

            foreach ($awardData as $key => $item) {
                $textall .= strip_tags($item['award_name_th'])."+";
            }

            foreach ($patentData as $key => $item) {
                $textall .= strip_tags($item['patent_name_th'])."+";
            }

            foreach ($publicationData as $key => $item) {
                $textall .= strip_tags($item['publication_name_th'])."+";
            }

            //return $textall;


            return view("screen.account.view", [
                "model" => $model,
                "proposalData" => $proposalData,
                "projectData" => $projectData,
                "certificateData" => $certificateData,
                "awardData" => $awardData,
                "patentData" => $patentData,
                "publicationData" => $publicationData,
                "textall" => $textall
            ]);
        } else {
            return $this->responseRedirectBack("ไม่พบข้อมูลที่ค้นหา", "warning");
        }
    }

    public function actionSetupKeyword(Request $request)
    {



        $data =  explode(",", $request->keywordText);

        if (count($data) <= 1) {
            return $this->responseRedirectBack("ไม่มีคำที่ใช้ประมวลผล", "warning");
        }

        $dataText = []; // { text : "" , count : 0 }
        $textBan = ["+", "(", ")", "", ".)+", ")+", ".)", ":", "-", " ", ";", "nbsp", "&"];  //preg_match //p hp regular
        $BantextData = Bantexts::pluck('bantexts_name')->toArray();


        $numberArr = [];

        foreach ($data as  $el) {

            //$checkedBen = array_search($el, $textBan, true);

            if (!in_array( $el , $textBan) && !in_array( $el , $BantextData)) {

                $checkedText = false;

                for ($i = 0; $i < count($dataText); $i++) {
                    if ($el == $dataText[$i]["text"]) {
                        $checkedText = true;
                        break;
                    }
                }

                if ($checkedText) {

                    for ($i = 0; $i < count($dataText); $i++) {
                        if ($el == $dataText[$i]["text"]) {
                            $dataText[$i]["count"] = (int)$dataText[$i]["count"] + 1;
                            break;
                        }
                    }
                } else {
                    array_push($dataText, array("text" => $el, "count" => 1));
                }
            }
        }

        //เก็บจำนวนคำ ทั้งหมดในเอกสาร
        foreach ($dataText as $item) {
            array_push($numberArr, $item["count"]);
        }

        $proposalData = Proposal::select("concept_proposal_name_th")->where("user_idcard",  "=", $request->idCard)->count();
        $projectData = Project::select("project_name_th")->where("user_idcard",  "=", $request->idCard)->count();
        $certificateData = Certificate::select("certificate_name")->where("user_idcard",  "=", $request->idCard)->count();
        $awardData = Award::select("award_name_th")->where("user_idcard",  "=", $request->idCard)->count();
        $patentData = Patent::select("patent_name_th")->where("user_idcard",  "=", $request->idCard)->count();
        $publicationData = Publication::select("publication_name_th")->where("user_idcard",  "=", $request->idCard)->count();

        $docIdf = $proposalData + $projectData + $certificateData + $awardData + $patentData + $publicationData;

        for ($i = 0; $i < count($dataText); $i++) {

            //คำนวณ Term-Frequency (TF)
            $dataText[$i]["tf_value"] = round($dataText[$i]['count'] / max($numberArr), 2);

            //คำนวณ Inverse Document Frequency (IDF)
            $dataText[$i]['idf_value'] = round(log( $docIdf  / $dataText[$i]['count'] , 10) , 2);

            //คำนวณ tfidf
            $dataText[$i]['tfidf_value'] = round($dataText[$i]["tf_value"] * $dataText[$i]['idf_value'] , 2);
        }

        usort($dataText, function ($a, $b) {
            return $a['tfidf_value'] < $b['tfidf_value'];
        });


        $selectItem = Department::all();

        return view("screen.account.process", [
            "dataText" => $dataText,
            "idRes" => $request->idRes,
            "idModel" => $request->idModel,
            "maxNumber" => max($numberArr),
            "selectItem" => $selectItem
        ]);

        //return $dataText;
    }

    public function actionCategorizeKwd(Request $request)
    {

        $keyword = $request->keyword;

        foreach ($keyword as $index => $item) {
            if ($request["value$index"]) {

                $model = Keyword::where("text", "=", $item)->first();

                if (!$model) {

                    $model = new Keyword();
                    $model->text = $item;
                    $model->dep_id_all = json_encode($request["value$index"]);
                    $model->save();
                }
            }
        }

        return $this->responseRedirectRoute("researcher_index_page", "จัดหมวดคำเรียบร้อย !");
    }

    protected function responseRedirectBack($message, $status = "success", $alert = true)
    {
        //primary , success , danger , warning
        return redirect()->back()->with(["message" => $message, "status" => $status, "alert" => $alert]);
    }

    protected function responseRedirectRoute($route, $message, $status = "success", $alert = true)
    {
        //primary , success , danger , warning
        return redirect()->route($route)->with(["message" => $message, "status" => $status, "alert" => $alert]);
    }


    protected function responseRequest($data, $bypass = true,  $status = "success")
    {
        return response()->json(['bypass' => $bypass,  'status' => $status, 'data' => $data], 200)
            ->header('Access-Control-Allow-Origin', '*')
            ->header('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS')
            ->header("Access-Control-Allow-Headers", "Authorization, Content-Type")
            ->header('Access-Control-Allow-Credentials', ' true');
    }
}
