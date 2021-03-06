<?php
require_once 'php/database.php';
require_once "php/functions.php";

if (!connected()) {
	header('Location: ./login.php');
}

$id ='';
$location = '';
$name_product = '';
$ref_product = '';
$categories = '';
$purchase_date = '';
$garanty_date = '';
$price = '';
$advice = '';
$picture = '';
$manual = '';
$error = false;
$data = array();

if( isset($_GET['id'])){
    $sql = 'SELECT `location` AS "loc_ID", sites.name AS "sites_name", `name_product`,`ref_product`,`categories` AS "cat_ID", category.name AS "cat_name",`purchase_date`,`garanty_date`,`price`,`advice`,`picture`,`manual` FROM `achat_materiel` INNER JOIN category ON achat_materiel.categories=category.id INNER JOIN sites on achat_materiel.location=sites.id where achat_materiel.id=:id ';

    $sth = $dbh->prepare( $sql );

    $sth->bindParam(':id', $_GET['id'], PDO::PARAM_INT);

    $sth->execute();

    $data = $sth->fetch(PDO::FETCH_ASSOC);
    

    $location = $data['loc_ID'];
    $name_product= $data['name_product'];
    $ref_product = $data['ref_product'];
    $categories = $data['cat_ID'];
    $purchase_date = $data['purchase_date'];
    $garanty_date = $data['garanty_date'];
    $price = $data['price'];
    $advice = $data['advice'];
    $picture = $data['picture'];
    $manual = $data['manual'];
    $id = htmlentities($_GET['id']);
    $error = false;
}

if (count($_POST) > 0){
    // location
    var_dump($_POST);
    if (!empty($_POST['location'])){
        if(strlen(trim($_POST['location']))== -1){
            $location = trim($_POST['location']);
        }else{
            $error = true;
        }
    }


    // name product
    if (strlen(trim($_POST['name_product']))!== 0){
        $name_product = trim($_POST['name_product']);
    }
    else{
        $error = true;
    }
    // reference product
    if (strlen(trim($_POST['ref_product']))!== 0){
        $ref_product = trim($_POST['ref_product']);
    }
    else{
        $error = true;
    }

    // categories
    if (!empty($_POST['categories'])){
        if(strlen(trim($_POST['categories']))== -1){
            $categories = trim($_POST['categories']);
        }else{
            $error = true;
        }
    }

    //purchase_date
    if (strlen(trim($_POST['purchase_date']))!== 0){
        $purchase_date = trim($_POST['purchase_date']);
    }
    else{
        $error = true;
    }
    // guarantee date
    if (strlen(trim($_POST['garanty_date']))!== 0){
        $garanty_date = trim($_POST['garanty_date']);
    }
    else{
        $error = true;
    }
    // price
    if (strlen(trim($_POST['price']))!== 0){
        $price = trim($_POST['price']);
    }
    else{
        $error = true;
    }
    // advice
    if (strlen(trim($_POST['advice']))!== 0){
        $advice = trim($_POST['advice']);
    }
    else{
        $error = true;
    }


    // picture
    // Get the image and convert into string
    $file = file_get_contents($_FILES['picture']['tmp_name']);
    // Encode the image string data into base64
    $picturebase64 = base64_encode($file);


    // manual
    $manfile = file_get_contents($_FILES['man']['tmp_name']);
    // Encode the image string data into base64
    $manbase64 = base64_encode($manfile);

    if( $error === false){
        if( isset($_POST['edit'])){
            $sql = 'UPDATE achat_materiel SET location=:location, name_product=:name_product, ref_product=:ref_product, categories=:categories, purchase_date=:purchase_date, garanty_date=:garanty_date, price=:price, advice=:advice picture=:picture, manual=:manual WHERE id=:id';
        }
        var_dump($_POST['edit']);

    $sth = $dbh->prepare($sql);
    $sth->bindParam(':location', $location, PDO::PARAM_STR);
    $sth->bindParam(':name_product', $name_product, PDO::PARAM_STR);
    $sth->bindParam(':ref_product', $ref_product, PDO::PARAM_STR);
    $sth->bindParam(':categories', $categories, PDO::PARAM_STR);
    $sth->bindValue(':purchase_date', strftime("%Y-%m-%d", strtotime($purchase_date)), PDO::PARAM_STR);
    $sth->bindValue(':garanty_date', strftime("%Y-%m-%d", strtotime($garanty_date)), PDO::PARAM_STR);
    $sth->bindParam(':price', $price, PDO::PARAM_STR);
    $sth->bindParam(':advice', $advice, PDO::PARAM_STR);
    $sth->bindParam(':picture', $picturebase64, PDO::PARAM_STR);
    $sth->bindParam(':manual', $manbase64, PDO::PARAM_STR);
    if( isset($_POST['edit'])){
        $sth->bindParam(':id', $id, PDO::PARAM_INT);
    }

    // execute
    $sth->execute();

    // Redirection après insertion
    header('Location: ./index.php');
}
}




/* TWIG */
/* Variables */
$project_title = 'Dashboard Project';

/* Conf */
require_once 'vendor/autoload.php';

$loader = new \Twig\Loader\FilesystemLoader('templates');
$twig = new \Twig\Environment($loader, [
    'cache' => false,
]);


/* Templates */
$template = $twig->load('edit.html');
echo $template->render([
	'project_title' => $project_title,
	'datas' => $data
]);