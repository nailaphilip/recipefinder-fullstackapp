<?php
include('DBConnect.php');

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PATCH, PUT, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token');


$objectDB = new DBConnect;
$connection = $objectDB->connect();


if (isset($_GET['name'])) {
$name = $_GET['name'];

$stmt = $connection->prepare('SELECT * FROM recipes WHERE name LIKE :name');
$stmt->bindValue(':name', "%$name%");
$stmt->execute();
$recipes = $stmt->fetchAll(PDO::FETCH_ASSOC);
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Recipe Finder</title>
<style>
  <?php include "recipe.css" ?>
</style>
</head>
<body>
<h1>Recipe Finder</h1>
<form method="get" action="recipe.php">
<label for="name">Recipe Name:</label>
<input type="text" id="name" name="name" value="<?php echo htmlspecialchars($name ?? ''); ?>">
<button type="submit">Search</button>
</form>

<?php if(isset($recipes)): ?>
    <div class="result">
<h1>Dessert recipe</h1>
<div class="container"> 
<div class="list">
<ul>
<?php foreach ($recipes as $recipe): ?>
<li>

<h3><?php echo htmlspecialchars($recipe['name']); ?></h3>
 
    <h4>Shopping List:</h4>
<ul> 
<?php foreach (explode(',', $recipe['ingridients']) as $ingridient): 
mail("nailya@mail.com", 'Shopping list', $ingridient)?>
<li><?php echo htmlspecialchars(trim($ingridient)); ?></li>
<?php endforeach; ?>
</ul>
</li>
<?php endforeach; ?>
</ul>
<?php endif; ?>
</div>
<div class="instructions">
    <h4>Instructions</h4>
<?php echo htmlspecialchars($recipe['instructions']); ?>
</div>
</div>
</div>
</body>
</html>