<?php 

    /**
     * Finds all combinations of integers that sum up to a target, given a specific number of integers.
     *
     * @param int $targetSum - The target sum to achieve.
     * @param int $numIntegers - The number of integers in each combination.
     * @param array $memo - Memoization array to store and reuse previously computed results.
     *
     * @return array - An array of arrays representing all valid combinations.
     */
    function get_teaspoon_combinations($targetSum, $numIntegers, $memo = []){

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


    /**
     * Processes the data to get the highest recipe score.
     *
     * @param array $ingredients - An array of Ingredient objects.
     * @param int $total_ingredients - The total number of ingredients.
     * @param array $teaspoon_combinations - An array of arrays representing all valid combinations of teaspoons for the ingredients.
     * @param int $max_allowed_calories - The maximum allowed calories for the recipe. If set to 0, calories will not be considered.
     *
     * @return array - The highest recipe score.
     */
    function process_data_to_get_highest_recipe_score($ingredients, $total_ingredients, $teaspoon_combinations, $max_allowed_calories) {

        $total_score = 0;//initialize the total score
        $total_combinations = sizeof($teaspoon_combinations);//check the total number of ingredients

        $temp_teaspoon_combination = array();

        $temp_capacity = $temp_durability = $temp_flavor = $temp_texture = $temp_calories = 0;

        for ($counter = 1; $counter <= $total_combinations; $counter++) {//loop through all the combinations of teaspoons for the ingredients

            $teaspoon_combination = $teaspoon_combinations[$counter];

            $capacity = $durability = $flavor = $texture = $calories = 0;

            for($i = 0; $i < $total_ingredients; $i++) {//loop through all the ingredients
                
                $capacity += $ingredients[$i]->capacity * $teaspoon_combination[$i];
                $durability += $ingredients[$i]->durability * $teaspoon_combination[$i];
                $flavor += $ingredients[$i]->flavor * $teaspoon_combination[$i];
                $texture += $ingredients[$i]->texture * $teaspoon_combination[$i];
                $calories += $ingredients[$i]->calories * $teaspoon_combination[$i];

            }
            
            //Condition: If any properties had produced a negative total, it would have instead become zero, causing the whole score to multiply to zero.
            $score = $capacity * $durability * $flavor * $texture;
            if ($capacity <= 0 || $durability <= 0 || $flavor <= 0 || $texture <= 0) {//check if any of the properties is negative
                $score = 0;
            }
            
            //
            if (($score > $total_score) && ($max_allowed_calories <= 0 || $calories == $max_allowed_calories)) {
                $total_score = $score;
                $temp_capacity = $capacity;
                $temp_durability = $durability;
                $temp_flavor = $flavor;
                $temp_texture = $texture;
                $temp_calories = $calories;

                $temp_teaspoon_combination = $teaspoon_combination;
            }
        }

        //print_r($temp_teaspoon_combination);

        $return_data = array(
            "total_score" => $total_score, "calories" => $temp_calories, "capacity" => $temp_capacity, 
            "durability" => $temp_durability, "flavor" => $temp_flavor, "texture" => $temp_texture,
            "teaspoon_combination" => $temp_teaspoon_combination
        );

        return $return_data;
    }
