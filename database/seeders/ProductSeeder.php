<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data   = [
            'uuid'      => Str::uuid(),
            'name'      => 'Indomie Goreng',
            'type'      => 'Makanan',
            'price'     => 3000,
            'quantity'  => 100
        ];

        Product::create($data);

        $data   = [
            'uuid'      => Str::uuid(),
            'name'      => 'Kornet',
            'type'      => 'Makanan',
            'price'     => 30000,
            'quantity'  => 100
        ];

        Product::create($data);

        $data   = [
            'uuid'      => Str::uuid(),
            'name'      => 'Nugget',
            'type'      => 'Makanan',
            'price'     => 30000,
            'quantity'  => 100
        ];

        Product::create($data);

        $data   = [
            'uuid'      => Str::uuid(),
            'name'      => 'Sosis',
            'type'      => 'Makanan',
            'price'     => 30000,
            'quantity'  => 100
        ];

        Product::create($data);

        $data   = [
            'uuid'      => Str::uuid(),
            'name'      => 'Telur',
            'type'      => 'Makanan',
            'price'     => 2000,
            'quantity'  => 100
        ];

        Product::create($data);

        $data   = [
            'uuid'      => Str::uuid(),
            'name'      => 'Susu Ultra Strawberry',
            'type'      => 'Minuman',
            'price'     => 6000,
            'quantity'  => 100
        ];

        Product::create($data);

        $data   = [
            'uuid'      => Str::uuid(),
            'name'      => 'Teh Pucuk',
            'type'      => 'Minuman',
            'price'     => 4000,
            'quantity'  => 100
        ];

        Product::create($data);

        $data   = [
            'uuid'      => Str::uuid(),
            'name'      => 'Coca Cola',
            'type'      => 'Minuman',
            'price'     => 5000,
            'quantity'  => 100
        ];

        Product::create($data);

        $data   = [
            'uuid'      => Str::uuid(),
            'name'      => 'Pocari Sweat',
            'type'      => 'Minuman',
            'price'     => 7500,
            'quantity'  => 1
        ];

        Product::create($data);

        $data   = [
            'uuid'      => Str::uuid(),
            'name'      => 'Kopikap',
            'type'      => 'Minuman',
            'price'     => 1000,
            'quantity'  => 0
        ];

        Product::create($data);
    }
}
