<?php

require_once("db.php");
require_once("component.php");

// because we return connection in db.php we save here the con-string in $con ### IT IS GLOBAL ----> $GLOBALS['con'] ###
$con = createdb();

// messages
function textNode($classname, $msg){
    $element = "<h6 class='$classname'>$msg</h6>";
    echo $element;
}

// ########## Insert Data to DataBase Start ##########
// create button click
if(isset($_POST['create'])){
    createData();
}
// Get Data button click
// if(isset($_POST['read'])){
//     getData();
// }
// Update Data button click
if(isset($_POST['update'])){
    updateData();
}
if(isset($_POST['delete'])){
    deleteRecord();
}

if(isset($_POST['deleteall'])){
    deleteAll();
}
// if(isset($_POST['id'])){
//     echo ""
// }
// Post Data ---- if empty = fasle
function textboxValue($value) {
    $textbox = mysqli_real_escape_string($GLOBALS['con'], $_POST[$value]);
    if(empty($textbox)) {
        return false;
    } else {
        return $textbox;
    }
}

// Insert Data in SQL
function createData(){
    $mealimg = textboxValue('food_picture');
    $mealname = textboxValue('food_name');
    $mealprice = textboxValue('food_price');
    $mealingredient = textboxValue('food_ingridiant');
    $mealallergene = textboxValue('food_allergen');

    if($mealimg && $mealname && $mealprice && $mealingredient && $mealallergene){
        $sql = "insert into meal(meal_img, meal_name, meal_price, meal_ingredients, meal_allergenes ) values ('$mealimg','$mealname','$mealprice','$mealingredient', '$mealallergene')";
        
        if(mysqli_query($GLOBALS['con'], $sql)){
             textNode("succsess", "Successfully inserted!");
         } else {
             echo "Error!";
         }
    } else {
       textNode("error", "Fill the text box!");
    }
}
// ########## Insert Data to DataBase End ##########

// ########## Print Rows Start ##########
function getData(){
    $sql = "select * from meal";
    // $result = $connect->query($sql);

    $result = mysqli_query($GLOBALS['con'], $sql);

    if(mysqli_num_rows($result) > 0){
        return $result;
        // while($row = mysqli_fetch_assoc($result)){
        //     echo tableRowElement($row['meal_img'], $row['meal_name'], $row['meal_ingredients'], $row['meal_allergenes'], $row['meal_price']);
        // }
    }
}
// ########## Print Rows End ##########

// ########## Update Data start ##########
function updateData(){
    $mealId = textboxValue('food_id');
    $mealimg = textboxValue('food_picture');
    $mealname = textboxValue('food_name');
    $mealprice = textboxValue('food_price');
    $mealingredient = textboxValue('food_ingridiant');
    $mealallergene = textboxValue('food_allergen');

    if($mealimg && $mealname && $mealprice && $mealingredient && $mealallergene){
        $sql = "
        update meal set meal_img = '$mealimg', meal_name = '$mealname',
        meal_ingredients = '$mealingredient', meal_allergenes = '$mealallergene' where id='$mealId'
        ";

        if(mysqli_query($GLOBALS['con'], $sql)){
        textNode("succsess", "Successfully updated!");
         } else {
        textNode("error", "Error, not updated!");
         }

    }else{
        textNode("error", "Get Data using the edit butoon in row!");
    }
}

// ########## Update Data end ##########

function deleteRecord(){
    $bookid = (int)textboxValue("food_id");

    $sql = "delete from meal where id = $bookid";

    if(mysqli_query($GLOBALS['con'], $sql)){
        textNode("success", "Deleted success");
    } else {
        textNode("error", "something went wrong can't delete");
    }
}

function deleteBtn(){
    $result = getData();
    $i = 0;
    if($result) {
        while($row = mysqli_fetch_assoc($result)){
            $i++;
            if($i > 3) {
                buttonElement("btn-deleteall", "btn btn-danger", "<i class='fas fa-trash'></i> Delete All", "deleteall","");
                return;
            }
        }
        
    }
}

function deleteAll(){
    $sql="drop table meal";

    if(mysqli_query($GLOBALS['con'], $sql)){
        textNode("success", "All records deleted");
        createdb();
    } else {
        textNode("error", "something went wrong call the police!!!");
    }
}