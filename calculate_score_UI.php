<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cookie Calculator</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>
<body>

<div class="container mt-5">
    <h2 class="mb-4">Cookie Calculator</h2>

    <form id="ingredientForm" method="POST">
        <table class="table table-responsive table-striped table-bordered">
            <thead class="thead-dark">
            <tr>
                <th>Ingredient</th>
                <th>Capacity</th>
                <th>Durability</th>
                <th>Flavor</th>
                <th>Texture</th>
                <th>Calories</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody id="tbody">
            <?php
                $ingredients = [
                    'Sprinkles',
                    'Butterscotch',
                    'Chocolate',
                    'Candy'
                ];
                for ($i = 0; $i < 4; $i++): ?>
                <tr id="<?=$id?>">
                    <td><input type="text" name="name[]" class="form-control" required value="<?=$ingredients[$i]?>"></td>
                    <td><input type="number" name="capacity[]" class="form-control" required value="<?=mt_rand(-10, 10)?>"></td>
                    <td><input type="number" name="durability[]" class="form-control" required value="<?=mt_rand(-10, 10)?>"></td>
                    <td><input type="number" name="flavor[]" class="form-control" required value="<?=mt_rand(-10, 10)?>"></td>
                    <td><input type="number" name="texture[]" class="form-control" required value="<?=mt_rand(-10, 10)?>"></td>
                    <td><input type="number" name="calories[]" class="form-control" required value="<?=mt_rand(-10, 10)?>"></td>
                    <td></td>
                </tr>
            <?php endfor; ?>
            </tbody>
        </table>

        <!-- <input type="text" name="total_spoon" class="form-control" required value="100" placeholder="Number of Spoon" style="width: 100px";> -->
        <button type="button" class="btn btn-primary" id="addBtn">Add new ingredient</button>
        &nbsp;&nbsp;&nbsp;
        <input type="checkbox" name="consider_calory" value="1"> Consider calories (500 calories)
        <!-- Spone: &nbsp;&nbsp;<input type="number" name="total_spoon" class="form-control" required value="100" placeholder="Number of Spoon" style="width: 150px;" /> -->
        <button type="submit" class="btn btn-success" id="calculateButton" style="float: right;">Calculate</button>
    </form>

    <div class="mt-4" id="resultContainer"></div>
</div>

<script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

<script>
    $(document).ready(function(){
        
        $('#ingredientForm').on('submit', function(e){

            e.preventDefault();

            $.ajax({
                type: "POST",
                url: "/services/process_form.php", 
                data: $("#ingredientForm").serialize(),
                success: function(data) {   
                    alert(1);
                }
            });
        });

        let count=5;
 
        // Adding row on click to Add New Row button
        $('#addBtn').click(function () {
            var dynamicRowHTML = "<tr id='"+count+"'><td><input type='text' name='name[]' class='form-control' required value=''></td><td><input type='number' name='capacity[]' class='form-control' required value=''></td><td><input type='number' name='durability[]' class='form-control' required value=''></td><td><input type='number' name='flavor[]' class='form-control' required value=''></td><td><input type='number' name='texture[]' class='form-control' required value=''></td><td><input type='number' name='calories[]' class='form-control' required value=''></td><td><button type='button' class='btn btn-danger remove deleteRow' id='removeBtn' onclick='removeTableRow("+count+")'>X</button></td></tr>";
            $('#tbody').append(dynamicRowHTML);
            count++;
        });
 
        $('.deleteRow9').click(function(){
            $(this).closest("tr").remove();
        });

        
    });

    function removeTableRow(trId) {
            $(document.getElementById(trId)).remove();
        }
</script>

</body>
</html>
