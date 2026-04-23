<?php
require_once 'vendor/autoload.php';

$mysqli = new mysqli("db", "user", "password", "restaurant_db");
if ($mysqli->connect_error) die("DB Error");

$mysqli->query("DELETE FROM statistics");

$faker = Faker\Factory::create('ru_RU');

for ($i = 0; $i < 50; $i++) {
    $name = $mysqli->real_escape_string($faker->word . " " . $faker->word);
    $cat_id = $faker->numberBetween(1, 2);
    $price = $faker->randomFloat(2, 5, 50);
    $rating = $faker->numberBetween(1, 5);
    $date = $faker->dateTimeBetween('-1 month', 'now')->format('Y-m-d H:i:s');
    
    $mysqli->query("INSERT INTO statistics (name, category_id, price, rating, created_at) 
                    VALUES ('$name', $cat_id, $price, $rating, '$date')");
}
header("Location: index.php");
exit;
?>
