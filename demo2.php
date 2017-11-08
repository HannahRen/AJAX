<?php
header("Content-Type:application/json;charset=utf-8");
//解决跨域：只支持IE10以上
// html和php都不需要有关于jsonp的改动，加上下面两句话
//header("Access-Control-Allow-Origin:*");
//header("Access-Control-Allow-Methods:POST,GET");

$staff=array
    (
      array("name" => "John", "number" => "101", "sex" => "male", "job" => "Manager"),
      array("name" => "Mark", "number" => "102", "sex" => "male", "job" => "Software Developer"),
      array("name" => "Mary", "number" => "103", "sex" => "female", "job" => "Sale"),
    );

    if($_SERVER["REQUEST_METHOD"]=="GET"){
      search();
    } elseif ($_SERVER["REQUEST_METHOD"]=="POST") {
      create();
    }

    function search(){
      $jsonp = $_GET["callback"];
      if(!isset($_GET["number"])||empty($_GET["number"])) {
        echo $jsonp.'({"success":false,"msg":"Wrong!!!"})';
        return;
      }

      global $staff;

      $number = $_GET["number"];
      $result = $jsonp.'({"success":false,"msg":"Cannot find that person!!!"})';

      foreach ($staff as $value) {
        if($value["number"] == $number) {
          $result = $jsonp.'({"success":true,"msg":"Find that staff, staff ID: '.$value["number"].', staff name: '.$value["name"].', staff gender: '.$value["sex"].', staff position: '.$value["job"].'"})';
          break;
        }
      }
      echo $result;
    }

    function create() {
      if (!isset($_POST["number"])||empty($_POST["number"])
          ||!isset($_POST["name"])||empty($_POST["name"])
          ||!isset($_POST["sex"])||empty($_POST["sex"])
          ||!isset($_POST["job"])||empty($_POST["job"])) {
          echo '{"success":false,"msg":"Please complete staff information!!!"}';
          return;
      }

      echo '{"success":true, "msg":"The information of '.$_POST["name"].' has been saved!"}';
    }
?>
