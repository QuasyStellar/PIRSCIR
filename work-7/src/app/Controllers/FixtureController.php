<?php
namespace App\Controllers;

use App\Models\Statistic;
use Faker\Factory;

class FixtureController extends BaseController {
    public function run() {
        Statistic::clear();
        $faker = Factory::create('ru_RU');
        for ($i = 0; $i < 50; $i++) {
            $name = $faker->word . " " . $faker->word;
            $cat_id = $faker->numberBetween(1, 2);
            $price = $faker->randomFloat(2, 5, 50);
            $rating = $faker->numberBetween(1, 5);
            $date = $faker->dateTimeBetween('-1 month', 'now')->format('Y-m-d H:i:s');
            Statistic::add($name, $cat_id, $price, $rating, $date);
        }
        header("Location: index.php?action=home");
    }
}
