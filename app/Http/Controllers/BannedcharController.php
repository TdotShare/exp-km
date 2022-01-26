<?php

namespace App\Http\Controllers;

use App\Model\Bantexts;
use Illuminate\Http\Request;

class BannedcharController extends Controller
{

    public function actionIndex()
    {
        $model = Bantexts::all();
        return view("screen.banned.index", ["model" => $model]);
    }


    public function actionCreate(Request $request)
    {
        if ($request->method() != "POST") {

            return view("screen.banned.create");
        } else {

            $model = Bantexts::where("bantexts_name", "=", $request->text)->count();

            if ($model == 0) {

                $model = new Bantexts();
                $model->bantexts_name = $request->text;
                $model->created_by = session("username");
                $model->created_date = date("Y-m-d H:i:s");

                if ($model->save()) {
                    return $this->responseRedirectRoute("bannedchar_index_page", "เพิ่มคำอ่าน $model->bantexts_name สำเร็จ !");
                } else {
                    return $this->responseRedirectBack("ไม่สามารถสร้างข้อมูลได้ กรุณาลองใหม่อีกครั้ง !", "warning");
                }
            } else {

                return $this->responseRedirectBack("มีคำอ่านนี้อยู่ในระบบอยู่แล้ว กรุณาลองใหม่อีกครั้ง !", "warning");
            }
        }
    }

    public function actionDelete($id)
    {

        $model = Bantexts::find($id);

        if ($model->delete()) {
            return $this->responseRedirectRoute("bannedchar_index_page", "ลบคำอ่าน $model->bantexts_name สำเร็จ !");
        } else {
            return $this->responseRedirectBack("ไม่สามารถลบข้อมูล ได้กรุณาลองใหม่อีกครั้ง !", "warning");
        }
    }

    public function actionView($id)
    {
        $model = Bantexts::find($id);

        if ($model) {
            return view("screens.banned.view", ["model" => $model]);
        } else {
            return $this->responseRedirectRoute("bannedchar_index_page", "ไม่พบข้อมูลที่ค้นหา", "warning");
        }
    }

    public function actionUpdate(Request $request)
    {
        $model = Bantexts::find($request->id);

        if ($model) {

            $model->bantexts_name = $request->text;

            if ($model->save()) {

                return $this->responseRedirectRoute("bannedchar_index_page", "แก้ไขข้อมูลเรียบร้อยสำเร็จ !");
            } else {
                return $this->responseRedirectBack("ไม่สามารถแก้ไขข้อมูล ได้กรุณาลองใหม่อีกครั้ง !", "warning");
            }
        } else {
            return $this->responseRedirectRoute("bannedchar_index_page", "ไม่พบข้อมูลที่ค้นหา", "warning");
        }
    }

    public function actionTest()
    {

        $model = Bantexts::pluck('text')->toArray();
        return $model;
    }

    protected function responseRedirectBack($message, $status = "success", $alert = true)
    {
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
