<?php
session_start();
require_once "vendor/autoload.php";

use GRUB\Display\DisplayRecipes;

$message = "";

if ($_POST != []) {

    $_SESSION['ingredients'] = $_POST;
    $recipeHTML = DisplayRecipes::generateRecipeHTML($_POST);
} else {
    /* Grabs session ingredients if present
    * so that recipes from search are still
    * displayed even after saving a recipe
    */
    if (isset($_SESSION['ingredients'])) {
        $recipeHTML = DisplayRecipes::generateRecipeHTML($_SESSION['ingredients']);
    } else {
        header("Location: index.php?message=Please%20select%20some%20ingredients");
    }
}

if (isset($_GET['message'])) {
    $message = $_GET['message'];
}

?>

<html lang="en-GB">
    <head>
        <title>GRUB</title>
        <link rel="stylesheet" type="text/css" href="styles.css"/>
        <link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body>
        <div class="container">
            <h1>GRUB</h1>
            <?php 
            if($message != "") {
                echo "<h5>Recipe '$message' saved!</h5>";
            } 
             ?>
            <a href='savedRecipes.php'><button>View Saved Recipes</button></a>
            <a href='index.php'><button>Back</button></a>
            <br>
                <?php echo $recipeHTML; ?>  
        </div>
    </body>
</html>
