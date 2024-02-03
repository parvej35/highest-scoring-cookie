<?php

try {

    include_once 'classes/Ingredient.php';
    include_once 'services/general.php';

    echo "<pre>";

    $start_time = floor(microtime(true) * 1000);

    // input
    //Max score with considering 500 calories,   1766400
    //Max score without considering calories,   21367368
    $ingredients = [
        new Ingredient("Sprinkles", 2, 0, -2, 0, 3),
        new Ingredient("Butterscotch", 0, 5, -3, 0, 3),
        new Ingredient("Chocolate", 0, 0, 5, -1, 8),
        new Ingredient("Candy", 0, -1, 0, 5, 8),
    ];

    //Max score with considering 500 calories, 117936
    //Max score without considering calories,  222870
    $ingredients = [
        new Ingredient("Sugar", 3, 0, 0, -3, 2),
        new Ingredient("Sprinkles", -3, 3, 0, 0, 9),
        new Ingredient("Candy", -1, 0, 4, 0, 1),
        new Ingredient("Chocolate", 0, 0, -2, 2, 8),
    ];

    //Max score with considering 500 calories, 57600000
    //Max score without considering calories,  62842880
    $ingredients = [
        new Ingredient("Butterscotch", -1, -2, 6, 3, 8),
        new Ingredient("Cinnamon", 2, 3, -2, -1, 3),
    ];

    $teaspoon_number = 100;

    $max_allowed_calories = 500; //If this is set to 0, the calories will not be considered while calculating the recipe score

    $total_ingredients = sizeof($ingredients);//check the total number of ingredients

    //Get all the combinations of teaspoons for the ingredients
    $teaspoon_combinations = get_teaspoon_combinations($teaspoon_number, $total_ingredients);

    //Get the highest recipe score. 
    //$total_score = process_data_to_get_highest_recipe_score($ingredients, $total_ingredients, $teaspoon_combinations, $max_allowed_calories);
    
    $processed_data = process_data_to_get_highest_recipe_score($ingredients, $total_ingredients, $teaspoon_combinations, $max_allowed_calories);
    $total_score = $processed_data["total_score"];
    $calories = $processed_data["calories"];
    $capacity = $processed_data["capacity"];
    $durability = $processed_data["durability"];
    $flavor = $processed_data["flavor"];
    $texture = $processed_data["texture"];

    $teaspoon_combination = $processed_data["teaspoon_combination"];

    echo "\n<b>Properties value of the highest-scoring cookie: </b>";
    echo "\nCapacity: <b>".$capacity."</b>";
    echo "\nDurability: <b>".$durability."</b>";
    echo "\nFlavor: <b>".$flavor."</b>";
    echo "\nTexture: <b>".$texture."</b>";
    //echo "\nCalories of highest-scoring cookie: <b>".$calories."</b>";

    echo "\n\nTotal score of highest-scoring cookie: <b>".$total_score."</b>";

    echo "\n\n<b>Recipe of the highest-scoring cookie: </b>";
    for ($counter = 0; $counter < $total_ingredients; $counter++) {
        $ingredient = $ingredients[$counter];
        echo "\n".$ingredient->name.": <b>".$teaspoon_combination[$counter]."</b> spoons";
    }

    

    //echo  "\n\nScore: ". ($capacity*$durability*$flavor*$texture) . "\n";

    $end_time = floor(microtime(true) * 1000);

    echo "\n\nTime required to execute the program: <b>".($end_time - $start_time)."</b> ms\n";
    echo "</pre>";

} catch (Exception $e) {
    echo $e->getMessage();
}
