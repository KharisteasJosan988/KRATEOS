<?php

namespace Database\Seeders;

use App\Models\Menu;
use Faker\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Factory::create('id_ID');
        #product1
        $p = new Menu();
        $p->jenis = 'Makanan';
        $p->id_menu = $faker->numerify('###');
        $p->nama = 'Fried Chicken';
        $p->harga = 15000;
        $p->save();
        #product2
        $p = new Menu();
        $p->jenis = 'Makanan';
        $p->id_menu = $faker->numerify('###');
        $p->nama = 'Chicken Nugget';
        $p->harga = 9000;
        $p->save();
        #product3
        $p = new Menu();
        $p->jenis = 'Makanan';
        $p->id_menu = $faker->numerify('###');
        $p->nama = 'Onion Rings';
        $p->harga = 10000;
        $p->save();
        #product4
        $p = new Menu();
        $p->jenis = 'Makanan';
        $p->id_menu = $faker->numerify('###');
        $p->nama = 'Ice Cream';
        $p->harga = 12000;
        $p->save();
        #product5
        $p = new Menu();
        $p->jenis = 'Minuman';
        $p->id_menu = $faker->numerify('###');
        $p->nama = 'Vanilla Latte';
        $p->harga = 13000;
        $p->save();
        #product6
        $p = new Menu();
        $p->jenis = 'Minuman';
        $p->id_menu = $faker->numerify('###');
        $p->nama = 'Hazelnut Latte';
        $p->harga = 12000;
        $p->save();
        #product7
        $p = new Menu();
        $p->jenis = 'Minuman';
        $p->id_menu = $faker->numerify('###');
        $p->nama = 'Caramel Mocha';
        $p->harga = 10000;
        $p->save();
        #product8
        $p = new Menu();
        $p->jenis = 'Minuman';
        $p->id_menu = $faker->numerify('###');
        $p->nama = 'Iced Lemonade';
        $p->harga = 17000;
        $p->save();
        #php artisan db:seed --class=MenuSeeder
    }
}
