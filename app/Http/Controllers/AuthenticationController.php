<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Account;
use App\Model\Researcher;

class AuthenticationController extends Controller
{
    public function actionLogin(Request $request)
    {
        $passwordHash = md5($request->password);

        $model = Account::where("user_idcard", "=", strtolower($request->username))->where("user_password", "=", $passwordHash)->first();

        if ($model) {

            session(['auth' => true]);
            session(['id' => $model->user_idcard]);
            session(['username' => $model->user_first_name_th]);
            session(['fullname' => $model->user_first_name_th . " " . $model->user_last_name_th]);
            return redirect()->route("dashboard_index_page");
        } else {
            return redirect()->back()->with(["message" => "ไม่พบบัญชีผู้ใช้งาน หรือ ท่านอาจกรอกข้อมูลผิด กรุณาลองอีกครั้ง", "status" => "warning", "alert" => true]);
        }
    }

    public function actionLogout()
    {
        session()->forget('auth');
        session()->forget('id');
        session()->forget('username');
        session()->forget('email');
        session()->forget('fullname');

        return redirect()->route("login_index_page");
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
