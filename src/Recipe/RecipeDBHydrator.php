<?php

namespace GRUB\Recipe;
use PDO;

/**
 * Class to create recipe entities from DB
 */
class RecipeDBHydrator
{
    /**
     * Property to store DB object
     *
     * @var PDO 
     */
    private $db;

    /**
     * Constructor that takes PDO object and stores in $db
     *
     * @param PDO $db
     */

    public function __construct(PDO $db) 
    {
        $this->$db  = $db;    
    }

    /**
     * Function that retrieves the recipe objects from the DB
     *
     * @return array Array of recipe objects
     */
    public function getRecipesFromDB(): array
    {
        $recipesOut = [];

        $statement = "SELECT `title`, `link`, `imageURL`, `ingredients` FROM `recipes`;";
        $query = $this->db->prepare($statement);
        $query->setFetchMode(PDO::FETCH_ASSOC);
        $query->execute();
        $savedRecipes =  $query->fetchAll();

        foreach($savedRecipes as $recipe) {
            $recipeObj = new RecipeEntity($recipe['title'], $recipe['link'], $recipe['imageURL'], $recipe['ingredients']);
            array_push($recipesOut, $recipeObj);
        }

        return $recipesOut;
    }
}