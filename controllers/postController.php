<?php
class postController extends Controller
{
    public function index($req , $res , $par ){

        $data = [
            "ho<strong>a</strong>" => "Tiết<h1>a</h1>",
            "dem" => "Nhật",
            "ten" => "Hưng"
        ];

        $res->view("templates/template",$data , "layouts/defaultLayout");
    }

    public function show( $req , $res , $par ){

        $title = "Auther";
        $name = "Hưng";
        $fullname ="Tiết Nhật Hưng $par[0]";
        $old = 23;

        $res->view("postDetail", compact('title','name','fullname','old'), "layouts/defaultLayout");
    }

    public function showDetail( $req , $res , $par ){
        var_dump($par);
    }

    public function api( $req , $res , $par ){
        $data = [
            "method" => $_SERVER['REQUEST_METHOD'],
            "ho" => "Tiết",
            "dem" => "Nhật",
            "ten" => "Hưng"
        ];

        $res->json($data);
    }

}