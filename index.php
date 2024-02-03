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

    <form id="ingredientForm">
        <table class="table">
            <thead>
            <tr>
                <th>Ingredient</th>
                <th>Capacity</th>
                <th>Durability</th>
                <th>Flavor</th>
                <th>Texture</th>
                <th>Calories</th>
            </tr>
            </thead>
            <tbody>
            <?php
                $ingredients = [
                    'Sprinkles',
                    'Butterscotch',
                    'Chocolate',
                    'Candy'
                ];
                for ($i = 0; $i < 4; $i++): ?>
                <tr>
                    <td><input type="text" name="name[]" class="form-control" required value="<?=$ingredients[$i]?>"></td>
                    <td><input type="number" name="capacity[]" class="form-control" required value="<?=mt_rand(-10, 10)?>"></td>
                    <td><input type="number" name="durability[]" class="form-control" required value="<?=mt_rand(-10, 10)?>"></td>
                    <td><input type="number" name="flavor[]" class="form-control" required value="<?=mt_rand(-10, 10)?>"></td>
                    <td><input type="number" name="texture[]" class="form-control" required value="<?=mt_rand(-10, 10)?>"></td>
                    <td><input type="number" name="calories[]" class="form-control" required value="<?=mt_rand(-10, 10)?>"></td>
                </tr>
            <?php endfor; ?>
            </tbody>
        </table>

        <button type="button" class="btn btn-primary" id="calculateButton">Calculate</button>
    </form>

    <div class="mt-4" id="resultContainer"></div>
</div>

<!--<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>-->
<script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

<script>
    $(document).ready(function () {
        $("#calculateButton").click(function () {
            $.ajax({
                type: "POST",
                url: "_a_cookies_process.php", // Create a separate PHP file (e.g., process.php) for server-side processing
                data: $("#ingredientForm").serialize(),
                success: function (response) {
                    $("#resultContainer").html(response);
                }
            });
        });
    });
</script>

</body>
</html>
