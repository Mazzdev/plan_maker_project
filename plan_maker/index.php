<?php

$pdo = new PDO('mysql:host=localhost;port=3306;dbname=exercises', 'root', '');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$statement = $pdo->prepare('SELECT * FROM exercises_list');
$statement->execute();
$exercises = $statement->fetchAll(PDO::FETCH_ASSOC);

$statement2 = $pdo->prepare('SELECT * FROM plan');
$statement2->execute();
$exercises2 = $statement2->fetchAll(PDO::FETCH_ASSOC);
?>

<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"
          integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <link href="app.css" rel="stylesheet"/>
    <title>Plan Maker</title>
</head>
<body>
<h1>Exercises List</h1>

<p>
    <a href="create.php" type="button" class="btn btn-sm btn-success">Add</a>
</p>
<table class="table">
    <thead>
    <tr>
        <th scope="col">#</th>
        <th scope="col">Title</th>
        <th scope="col">Sets</th>
        <th scope="col">Link</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($exercises as $i => $exercise) { ?>
        <tr>
            <th scope="row"><?php echo $i + 1 ?></th>
            <td><?php echo $exercise['title'] ?></td>
            <td><?php echo $exercise['sets'] ?></td>
            <td><?php echo $exercise['link'] ?></td>
            <td>
                <form method="post" action="delete.php" style="display: inline-block">
                    <input type="hidden" name="id" value="<?php echo $exercise['id'] ?>"/>
                    <button type="button" class="btn btn-success">+</button>
                    
                    <button type="submit" class="btn btn-sm btn-outline-danger">Delete</button>
                </form>
            </td>
        </tr>
    <?php } ?>
    </tbody>
</table>

<?php
?>

<h1>Plan</h1>
<button type="submit" class="btn btn-sm btn-outline-danger">Delete all</button>
<table class="table">
    <thead>
    <tr>
        <th scope="col">#</th>
        <th scope="col">Title</th>
        <th scope="col">Sets</th>
        <th scope="col">Link</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($exercises2 as $i => $exercise2) { ?>
        <tr>
            <th scope="row"><?php echo $i + 1 ?></th>
            <td><?php echo $exercise2['title'] ?></td>
            <td><?php echo $exercise2['sets'] ?></td>
            <td><?php echo $exercise2['link'] ?></td>
            <td>
                <form method="post" action="delete.php" style="display: inline-block">
                    <input type="hidden" name="id" value="<?php echo $exercise2['id'] ?>"/>
                    <button type="submit" class="btn btn-sm btn-outline-danger">Delete</button>
                </form>
            </td>
        </tr>
    <?php } ?>
    </tbody>
</table>

</body>
</html>