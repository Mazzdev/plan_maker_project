<?php

$pdo = new PDO('mysql:host=localhost;port=3306;dbname=exercises', 'root', '');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$errors = [];

$title = '';
$sets = '';
$link = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $title = $_POST['title'];
    $sets = $_POST['sets'];
    $link = $_POST['link'];

    if (!$title) {
        $errors[] = 'Title is required';
    }

    if (!$sets) {
        $errors[] = 'Sets are required';
    }

    if (!$link) {
        $errors[] = 'Link is required';
    }

    if (empty($errors)) {
        $statement = $pdo->prepare("INSERT INTO exercises_list (title, sets, link)
                VALUES (:title, :sets, :link)");
        $statement->bindValue(':title', $title);
        $statement->bindValue(':sets', $sets);
        $statement->bindValue(':link', $link);

        $statement->execute();
        header('Location: index.php');
    }

}


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
    <title>Products CRUD</title>
</head>
<body>
<p>
    <a href="index.php" type="button" class="btn btn-primary">Back</a>
</p>
<h1>Create new Product</h1>

<?php if (!empty($errors)): ?>
    <div class="alert alert-danger">
        <?php foreach ($errors as $error): ?>
            <div><?php echo $error ?></div>
        <?php endforeach; ?>
    </div>
<?php endif; ?>

<form method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label>Title</label>
        <input type="text" name="title" class="form-control" value="<?php echo $title ?>">
    </div>
    <div class="form-group">
        <label>Sets</label>
        <input type="text" name="sets" class="form-control" value="<?php echo $sets ?>">
    </div>
    <div class="form-group">
        <label>Link</label>
        <input type="text" name="link" class="form-control" value="<?php echo $link ?>">
    </div>
    <button type="submit" class="btn btn-success">Submit</button>
</form>

</body>
</html>