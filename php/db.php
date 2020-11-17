<?php 

function createdb(){
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "meals";

    // Create connection
    $con = mysqli_connect($servername, $username, $password);

    // check Connection
    if(!$con){
        die("Connection Failed:" . mysqli_connect_error());
    }

    // create database
    $sql = "create database if not exists $dbname";

    //  ##### Not necessary anymore #####
    //  if(mysqli_query($con, $sql)){
    //     echo "Hallo";
    // } else {
    //     echo "cannnot create table!" . mysqli_error($con);
    // }

    if(mysqli_query($con, $sql)) {
        $con = mysqli_connect($servername, $username, $password, $dbname);

    $sql = "
        create table if not exists meal(
            id int auto_increment primary key,
            meal_img varchar(100),
            meal_name varchar(30) not null,
            meal_ingredients varchar(200),
            meal_allergenes varchar(200),
            meal_price float
            ) 
    ";

    if(mysqli_query($con, $sql)){
        return $con;
    } else {
        echo "cannnot create table!";
    }
    
    }

}