## Assignment Title:
Cookie Crafting Challenge: Finding the Perfect Recipe

## Application structure:

```bash
< PROJECT ROOT >                            # Application Root Directory
   |
   |-- classes/                             # Folder to keep all the class files
   |    |-- Ingredient.php                  # Ingredient class file
   |
   |-- services/                            # Folder to keep all the service files
   |    |-- process_form.php                # File to process the form data send by UI (Not complete)
   |    |-- ProcessIngredients.php          # File to process the the ingredient data to calculate recipe score. 
   |
   |-- assignment.txt                       # Details of the problem or the assignment.
   |-- calculate_score_UI.php               # File to design the UI (Not complete)
   |-- calculate_score.php                  # Main file to calcuate the recipe score. (Completed)
   |
   |-- ************************************************************************
```

## Steps to run the application:

# 1) Get the code from Git repository
git clone https://github.com/parvej35/highest-scoring-cookie

# 2) Put the folder into an application server like Apache.

# 3) Start the server and make sure that server is up and running.

# 4) Open the file __calculate_score.php__.

# 5) Change the below variables as per needed: 
    - ##$teaspoon_number = 100##; 
    (Variable to hold the number of teaspoons to be used.)
    - ##$max_allowed_calories = 0##; 
    (If set to 0, the calories will not be considered while calculating the recipe score.)

# 6) Open the browser and browse the file : http://localhost/LEADS_IO/calculate_score.php

## Developer:
Chowdhury PA, Parvej (parvej35@gmail.com)<br>

## Licence:

Distributed under the GNU General Public License v3.0. 
For more information <a href='https://www.gnu.org/licenses/gpl-3.0.en.html#license-text' target='_blank'> license</a>.