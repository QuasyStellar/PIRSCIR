<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\Dish;
use App\Models\Statistic;
use Illuminate\Support\Facades\DB;

class RestaurantSeeder extends Seeder
{
    public function run(): void
    {
        // Отключаем проверку внешних ключей для очистки
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Dish::truncate();
        Statistic::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        // 1. Убеждаемся, что категории есть
        $categories = ['Супы', 'Напитки', 'Десерты', 'Горячее', 'Салаты'];
        foreach ($categories as $cat) {
            Category::firstOrCreate(['name' => $cat]);
        }

        $allCats = Category::all();

        // 2. Генерируем блюда
        for ($i = 1; $i <= 15; $i++) {
            Dish::create([
                'name' => 'Тестовое блюдо ' . $i,
                'price' => rand(100, 1000) / 10,
                'category_id' => $allCats->random()->id
            ]);
        }

        // 3. Генерируем статистику (50 записей)
        for ($i = 1; $i <= 50; $i++) {
            Statistic::create([
                'name' => 'Блюдо ' . rand(1, 15),
                'category_id' => $allCats->random()->id,
                'price' => rand(50, 500) / 10,
                'rating' => rand(1, 5),
                'created_at' => now()->subDays(rand(0, 30))
            ]);
        }
    }
}
