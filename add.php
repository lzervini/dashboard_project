<?php
require_once 'php/database.php';
require_once "php/functions.php";

if (!connected()) {
	header('Location: ./login.php');
}


var_dump('TEST');

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

if ( !empty($_POST) ) {
    var_dump('Donnees post');
    // location
    if (strlen(trim($_POST['location']))!== 0){
        $location = trim($_POST['location']);
    }
    else{
        $error = true;
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
    if (strlen(trim($_POST['categories']))!== 0){
        $categories = trim($_POST['categories']);
    }
    else{
        $error = true;
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
        $guarantee_date = trim($_POST['garanty_date']);
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
    var_dump($_FILES['picture']['tmp_name']);
    // Encode the image string data into base64
    $picturebase64 = base64_encode($file);
        var_dump($picturebase64);
    die();


/*    if (isset($_FILES['picture'])&& !empty($_FILES['picture']['name'])){
        $tailleMax= 2097152;
        $extensionValide= array('jpg', 'jpeg', 'png', 'gif');
            if($_FILES['picture']['size'] <= $tailleMax){
            $extensionUpload = strtolower(substr(strrchr($_FILES['picture']['name'], '.'), 1));
            if(in_array($extensionUpload, $extensionValide))
            {
                $chemin = dirname(__FILE__). DIRECTORY_SEPARATOR . "medias/".$_FILES['picture']['name'];
                $deplacement = move_uploaded_file($_FILES['picture']['tmp_name'], $chemin);
                if($deplacement){
                    $picture = $chemin;
                }else{
                    $msgPic = "Error.";
                }
            }else{
                $msgPic = "Images must be in the format : .jpg, .jpeg, .gif, .png";
            }
        }
        }*/
    // manual
        $manfile = file_get_contents($_FILES['manual']['tmp_name']);
        var_dump($_FILES['manual']['tmp_name']);
        // Encode the image string data into base64
        $manbase64 = base64_encode($manfile);
/*        if (isset($_FILES['manual'])&& !empty($_FILES['manual']['name'])){
        $tailleMax= 2097152;
        $extensionValide= array('pdf', 'txt');
            if($_FILES['manual']['size'] <= $tailleMax)
            {
            $extensionUpload = strtolower(substr(strrchr($_FILES['manual']['name'], '.'), 1));
            if(in_array($extensionUpload, $extensionValide))
            {
                $chemin = dirname(__FILE__). DIRECTORY_SEPARATOR . "medias/".$_FILES['manual']['name'];
                $deplacement = move_uploaded_file($_FILES['manual']['tmp_name'], $chemin);
                    if($deplacement){
                        $manual = $chemin;
                    }else{
                        $msgManual = "Error.";
                    }
                }else{
                    $msgManual = "Document must be in the format : .txt, .pdf";
                }
            }
            }*/

    if( $error === false){
        $sql = "INSERT INTO `achat_materiel`( `location`, `name_product`, `ref_product`, `categories`, `purchase_date`, `garanty_date`, `price`, `advice`, `picture`, `manual`) VALUES (:location, :name_product, :ref_product, :categories, :purchase_date, :garanty_date, :price, :advice, :picture, :manual)";
    }

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

    // execute
    $sth->execute();

    // Redirection après insertion
    header('Location: ./index.php');
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
$template = $twig->load('add.html');
echo $template->render([
    'project_title' => $project_title
]);