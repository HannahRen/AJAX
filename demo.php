<?php
header("Content-Type:text/plain;charset=utf-8");

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
      if(!isset($_GET["number"])||empty($_GET["number"])) {
        echo "Wrong!!!";
        return;
      }

      global $staff;

      $number = $_GET["number"];
      $result = "Cannot find that person!!!";

      foreach ($staff as $value) {
        if($value["number"] == $number) {
          $result = "Find that staff, staff ID: ".$value["number"].", staff name: ".$value["name"].", staff gender: ".$value["sex"].", staff position: ".$value["job"];
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
          echo "Please complete staff information!!!";
          return;
      }

      echo "The information of ".$_POST["name"]." has been saved!";
    }
?>
