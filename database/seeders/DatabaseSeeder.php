<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // Llama al seeder de productos
        $this->call(ProductosTableSeeder::class);

        // Aquí puedes agregar más llamadas a otros seeders si los tienes
    }
}
