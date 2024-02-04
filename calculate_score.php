<?php

try {

    include_once 'classes/Ingredient.php';
    include_once 'services/ProcessIngredients.php';

    echo "<pre>";

    $start_time = floor(microtime(true) * 1000);

    //-------Input Section-------

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
    $ingredients1 = [
        new Ingredient("Sugar", 3, 0, 0, -3, 2),
        new Ingredient("Sprinkles", -3, 3, 0, 0, 9),
        new Ingredient("Candy", -1, 0, 4, 0, 1),
        new Ingredient("Chocolate", 0, 0, -2, 2, 8),
    ];

    //Max score with considering 500 calories, 57600000
    //Max score without considering calories,  62842880
    $ingredients2 = [
        new Ingredient("Butterscotch", -1, -2, 6, 3, 8),
        new Ingredient("Cinnamon", 2, 3, -2, -1, 3),
    ];

    $teaspoon_number = 100;//Variable to hold the number of teaspoons to be used

    $max_allowed_calories = 0; //If this is set to 0, the calories will not be considered while calculating the recipe score

    //-------Input Section-------
    
    $total_ingredients = sizeof($ingredients);//check the total number of ingredients

    $process = new ProcessIngredients();

    //Get all the combinations of teaspoons for the ingredients
    $teaspoon_combinations = $process->get_teaspoon_combinations($teaspoon_number, $total_ingredients);

    //Get the highest recipe score. 
    $processed_data = $process->process_data_to_get_highest_recipe_score($ingredients, $total_ingredients, $teaspoon_combinations, $max_allowed_calories);
    $total_score = $processed_data["total_score"];
    $calories = $processed_data["calories"];
    $capacity = $processed_data["capacity"];
    $durability = $processed_data["durability"];
    $flavor = $processed_data["flavor"];
    $texture = $processed_data["texture"];

    $teaspoon_combination = $processed_data["teaspoon_combination"];

    //--------Result--------    
    echo "\n\nTotal number of ingredients: <b>".$total_ingredients."</b>";
    echo "\nTotal number of teaspoons: <b>".$teaspoon_number."</b>";
    
    echo "\n\nTotal score of highest-scoring cookie: <b>".$total_score."</b>";
    if($max_allowed_calories > 0) {
        echo "\n(Considering the maximum allowed calories: <b>".$max_allowed_calories."</b>)";
    } else {
        echo "\n(Without considering the calory.)";
    }
    //echo  "\n\nScore: ". ($capacity*$durability*$flavor*$texture) . "\n";

    echo "\n\n<b>Properties value of the highest-scoring cookie: </b>";
    echo "\nCapacity: <b>".$capacity."</b>";
    echo "\nDurability: <b>".$durability."</b>";
    echo "\nFlavor: <b>".$flavor."</b>";
    echo "\nTexture: <b>".$texture."</b>";
    echo "\nCalory: <b>".$calories."</b>";

    echo "\n\n<b>Recipe of the highest-scoring cookie: </b>";
    for ($counter = 0; $counter < $total_ingredients; $counter++) {
        $ingredient = $ingredients[$counter];
        echo "\n".$ingredient->get_name().": <b>".$teaspoon_combination[$counter]."</b> spoons";
    }

    $end_time = floor(microtime(true) * 1000);

    echo "\n\nTime required to execute the program: <b>".($end_time - $start_time)."</b> ms\n";
    echo "</pre>";

} catch (Exception $e) {
    echo $e->getMessage();
}
