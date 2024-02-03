<?php

// error_reporting(E_ALL);
// ini_set('display_errors', 1);

error_reporting(E_ALL ^ E_WARNING); 


class Ingredient1 {
    public $name;
    public $capacity;
    public $durability;
    public $flavor;
    public $texture;
    public $calories;

    public function __construct($name, $capacity, $durability, $flavor, $texture, $calories) {
        $this->name = $name;
        $this->capacity = $capacity;
        $this->durability = $durability;
        $this->flavor = $flavor;
        $this->texture = $texture;
        $this->calories = $calories;
    }
}

class CookieRecipe1 {
    private $ingredients;

    public function __construct($ingredients) {
        $this->ingredients = $ingredients;
    }

    public function calculateScore($teaspoons) {

        try {

            $capacity = $durability = $flavor = $texture = 0;

            echo "\nX0 Teaspoons: $teaspoons[0], $teaspoons[1], $teaspoons[2]\n";

            // print_r($this->ingredients);

            echo sizeof($teaspoons);

            foreach($teaspoons as $teaspoon) {
                //echo "P1: ".$teaspoon;

                foreach ($this->ingredients as $ingredient) {

                    //echo "\nP: ".$ingredient->capacity;
                    //echo "\nP: ".max(0, $ingredient->capacity * $teaspoon);

                    // echo "\n\nP1: ".$ingredient->capacity * $teaspoon;
                    // echo " P2: ".$ingredient->durability * $teaspoon;
                    // echo " P3: ".$ingredient->flavor * $teaspoon;
                    // echo " P4: ".$ingredient->texture * $teaspoon;
    
                    // $capacity += max(0, $ingredient->capacity * $teaspoon);
                    // $durability += max(0, $ingredient->durability * $teaspoon);
                    // $flavor += max(0, $ingredient->flavor * $teaspoon);
                    // $texture += max(0, $ingredient->texture * $teaspoon);

                    $capacity += max($capacity, $ingredient->capacity * $teaspoon);
                    $durability += max($durability, $ingredient->durability * $teaspoon);
                    $flavor += max($flavor, $ingredient->flavor * $teaspoon);
                    $texture += max($texture, $ingredient->texture * $teaspoon);
    
                    if($teaspoon == 44 || $teaspoon == 56 || $teaspoon == 100) {
                        echo "\nP1: ".$teaspoon;
                        echo "\nX1 Capacity: $capacity, Durability: $durability, Flavor: $flavor, Texture: $texture\n";
                        // echo "X1 Capacity: $capacity, Durability: $durability, Flavor: $flavor, Texture: $texture\n";
                    }
    
                }
            }

        
            $score = $capacity * $durability * $flavor * $texture;
            // echo "X2 Score: $score\n";

            return $score;

        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
        
    }

    public function get_score_of_highest_scoring_cookie_recipe($targetCalories){

        try {
                
                $capacity = $durability = $flavor = $texture = 0;
                $maxScore = 0;
    
                foreach ($this->ingredients as $ingredient) {
                    
                    echo "\n\nP1: ".$ingredient->capacity;
                    echo " P2: ".$ingredient->durability;
                    echo " P3: ".$ingredient->flavor;
                    echo " P4: ".$ingredient->texture;
    
                    $capacity += max($capacity, $ingredient->capacity);
                    $durability += max($durability, $ingredient->durability);
                    $flavor += max($flavor, $ingredient->flavor);
                    $texture += max($texture, $ingredient->texture);

                    // $calories = $butterscotch * $this->ingredients[0]->calories
                            // + $cinnamon * $this->ingredients[1]->calories
                            // + $suger * $this->ingredients[2]->calories
                            // + $this->ingredients[3]->calories;

                }
    
                echo "P4 MaxScore: $maxScore\n";
    
                return $maxScore;
    
            } catch (Exception $e) {
                throw new Exception($e->getMessage());
        }
    }

    public function findOptimalRecipe($targetCalories) {

        try {

            $maxScore = 0;

            for ($butterscotch = 0; $butterscotch <= 100; $butterscotch++) {
                for ($cinnamon = 0; $cinnamon <= 100 - $butterscotch; $cinnamon++) {
                    $suger = 100 - $butterscotch - $cinnamon;

                    // echo "P1 Butterscotch: $butterscotch, Cinnamon: $cinnamon, Suger: $suger\n";

                    // echo "\ningredients[0]:".$this->ingredients[0]->calories;
                    // echo "\ningredients[1]:".$this->ingredients[1]->calories;
                    // echo "\ningredients[2]:".$this->ingredients[2]->calories;

                    $calories = $butterscotch * $this->ingredients[0]->calories
                            + $cinnamon * $this->ingredients[1]->calories
                            + $suger * $this->ingredients[2]->calories
                            + $this->ingredients[3]->calories;

                    echo "Calories: $calories\n";

                    // if (($targetCalories > 0) && ($calories == $targetCalories)) {
                        $teaspoons = [$butterscotch, $cinnamon, $suger];
                        $score = $this->calculateScore($teaspoons);

                        $maxScore = max($maxScore, $score);
                        echo "Pre MaxScore: $maxScore, Score: $score, NewMaxScore: $maxScore\n";
                    // }
                }
            }

            echo "P4 MaxScore: $maxScore\n";

            return $maxScore;

        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
        
    }

}

try {

    include_once 'services/general.php';
    
    function get_attribute_score_based_on_spoon($ingredient, $spoon_counter) {
        
        try {
            // echo "\nX1: ";
            // echo "\nX2: ".$ingredient->capacity;

            $capacity = $ingredient->capacity * $spoon_counter;
            $durability = $ingredient->durability * $spoon_counter;
            $flavor = $ingredient->flavor * $spoon_counter;
            $texture = $ingredient->texture * $spoon_counter;
            $calories = $ingredient->calories * $spoon_counter;

            $data = array($capacity, $durability, $flavor, $texture, $calories);
            return $data;
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    /**
     * Finds all combinations of integers that sum up to a target, given a specific number of integers.
     *
     * @param int $targetSum - The target sum to achieve.
     * @param int $numIntegers - The number of integers in each combination.
     * @param array $memo - Memoization array to store and reuse previously computed results.
     *
     * @return array - An array of arrays representing all valid combinations.
     */
    function get_teaspoon_combinations_1($targetSum, $numIntegers, $memo = []){

        // Base case: If the target sum is 0 and the required number of integers is 0, return an array with an empty combination.
        if ($targetSum == 0 && $numIntegers == 0) {
            return [[]];
        }
    
        // Base case: If the target sum is not positive or the required number of integers is not positive, return an empty array.
        if ($targetSum <= 0 || $numIntegers <= 0) {
            return [];
        }
    
        // Generate a unique key for the current state using target sum and the number of integers.
        $key = "$targetSum,$numIntegers";
    
        // Check if the result for the current state is already memoized.
        if (isset($memo[$key])) {
            return $memo[$key];
        }
    
        // Initialize an array to store the combinations.
        $combinations = [];
    
        // Loop through possible integer values (from 1 to the target sum).
        for ($i = 1; $i <= $targetSum; $i++) {
            // Recursively find combinations for the remaining sum and one fewer integer.
            $subCombinations = get_teaspoon_combinations($targetSum - $i, $numIntegers - 1, $memo);
    
            // Append the current integer to each sub-combination.
            foreach ($subCombinations as $subCombination) {
                $combinations[] = array_merge([$i], $subCombination);
            }
        }
    
        // Memoize the result for the current state.
        $memo[$key] = $combinations;
    
        // Return the combinations for the current state.
        return $combinations;
    }


    echo "<pre>";

    //Max score with considering 500 calories,   1766400
    //Max score without considering calories,   21367368
    $ingredients = [
        new Ingredient1("Sprinkles", 2, 0, -2, 0, 3),
        new Ingredient1("Butterscotch", 0, 5, -3, 0, 3),
        new Ingredient1("Chocolate", 0, 0, 5, -1, 8),
        new Ingredient1("Candy", 0, -1, 0, 5, 8),
    ];


    //Max score with considering 500 calories, 117936
    //Max score without consideringcalories,   222870
    $ingredients = [
        new Ingredient1("Sugar", 3, 0, 0, -3, 2),
        new Ingredient1("Sprinkles", -3, 3, 0, 0, 9),
        new Ingredient1("Candy", -1, 0, 4, 0, 1),
        new Ingredient1("Chocolate", 0, 0, -2, 2, 8),
    ];

    //Max score with considering 500 calories, 57600000
    //Max score without consideringcalories,   62842880
    $ingredients1 = [
        new Ingredient1("Butterscotch", -1, -2, 6, 3, 8),
        new Ingredient1("Cinnamon", 2, 3, -2, -1, 3),
    ];

    echo "Ingredients:\n";
    print_r($ingredients);

    //echo "Totla : ".sizeof($ingredients);

    $start_time = floor(microtime(true) * 1000);

    $teaspoon = 1;

    $total_capacity = 0;
    $total_durability = 0;
    $total_flavor = 0;
    $total_texture = 0;
    $total_calories = 0;

    $total_score = 0;
    $teaspoon_number = 100;

    $max_allwed_calories = 500;

    $total_ingredients = sizeof($ingredients);//check the total number of ingredients

    // Example 1: Target sum = 100, Number of integers = 3
    $teaspoon_combinations = get_teaspoon_combinations($teaspoon_number, $total_ingredients);

    $total_combinations = sizeof($teaspoon_combinations);//check the total number of ingredients

    
    for ($counter = 1; $counter <= $total_combinations; $counter++) {

        $teaspoon_combination = $teaspoon_combinations[$counter];

        //echo "\n\nCombination $counter: [".$teaspoon_combination[0].', '.$teaspoon_combination[1].', '.$teaspoon_combination[2].', '.$teaspoon_combination[3]."]";

        $capacity = $durability = $flavor = $texture = $calories = 0;

        for($i = 0; $i < $total_ingredients; $i++) {
            
            // echo "\nP1: "
            // .$ingredients[$i]->name. ' - '.$ingredients[$i]->capacity. ' - '
            // .$ingredients[$i]->durability. ' - '.$ingredients[$i]->flavor. ' - '
            // .$ingredients[$i]->texture. ' - '.$ingredients[$i]->calories;

            //print_r($ingredients[$i]);

            // echo "\nP1: $teaspoon_combination[$i]";

            //echo "\nCombination $counter: [".$teaspoon_combination[$i].', '.$teaspoon_combination[$i].', '.$teaspoon_combination[$i].', '.$teaspoon_combination[$i]."]";
            //echo "\nCombination PAAA $counter: [".strlen($teaspoon_combination[0]);
            //if(strlen($teaspoon_combination[$i]) != 0) {
                
                $capacity += $ingredients[$i]->capacity * $teaspoon_combination[$i];
                $durability += $ingredients[$i]->durability * $teaspoon_combination[$i];
                $flavor += $ingredients[$i]->flavor * $teaspoon_combination[$i];
                $texture += $ingredients[$i]->texture * $teaspoon_combination[$i];

                $calories += $ingredients[$i]->calories * $teaspoon_combination[$i];
                //echo "\nP1 Capacity: ".$ingredients[$i]->calories.", Calories: ".$calories." - ".$teaspoon_combination[$i]."\n";

                // $attributes_score = get_attribute_score_based_on_spoon($ingredients[$i], $temp_counter);

                // $temp_capacity += $attributes_score[0];
                // $temp_durability += $attributes_score[1];
                // $temp_flavor += $attributes_score[2];
                // $temp_texture += $attributes_score[3];
                // $temp_calories += $attributes_score[4];
                
                //$temp_counter++;

            //}
        }
        

        //Condition: If any properties had produced a negative total, it would have instead become zero, causing the whole score to multiply to zero.
        $score = $capacity * $durability * $flavor * $texture;
        if ($capacity <= 0 || $durability <= 0 || $flavor <= 0 || $texture <= 0) {
            $score = 0;
        }
        
        // echo "\nP3 Score: $score\n";

        if($score > 0) {

            if($calories == $max_allwed_calories) {

                // echo "\n\nP2 Capacity: $capacity, Durability: $durability, Flavor: $flavor, Texture: $texture, Calories: $calories";
                // echo "\nP3 Positive Score: $score";
                // echo "\nP4 Total Score: $total_score";

                if($score > $total_score) {
                    $total_score = $score;
                }
                // echo "\nP5 New Total Score: $total_score";
                // echo "\nP6 Combination $counter: [".$teaspoon_combination[0].', '.$teaspoon_combination[1].', '.$teaspoon_combination[2].', '.$teaspoon_combination[3]."]";
            }

            // if($score > $total_score) {
                // $total_score = $score;
            // }
            // echo "\nP5 New Total Score: $total_score";
            // echo "\nP6 Combination $counter: [".$teaspoon_combination[0].', '.$teaspoon_combination[1].', '.$teaspoon_combination[2].', '.$teaspoon_combination[3]."]";
        }

    }

    echo "\nP5 New Total Score: $total_score";
    echo "\nP6 Combination $counter: [".$teaspoon_combination[0].', '.$teaspoon_combination[1].', '.$teaspoon_combination[2].', '.$teaspoon_combination[3]."]";

    $end_time = floor(microtime(true) * 1000);

    echo "\n\nExecution Time: ".($end_time - $start_time)." ms\n";

    echo "</pre>";

} catch(Exception $e){
    echo $e->getMessage();
}

