<?php

namespace Database\Seeders;

use App\Models\baseItem;
use App\Models\Category;
use App\Models\HargaPaket;
use App\Models\Pengedar;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
        // \App\Models\User::factory(10)->create();
        // Pengedar::factory(5)->create();
        // Peserta::factory(50)->create();
        // Barang::factory(100)->create();

        // reate pengedar
        Pengedar::create([
            'nama' => 'Ai Khodijah',
            'alamat' => 'Dsn. Kubang Alun Alun Rt. 002 Rw. 003 Ds. Trunamanggala Kec. Cimalaka Kab. Sumedang',
            'whatsapp' => '088541236548'
        ]);

        // Create Category
        Category::create([
            'name' => 'Paket Hemat Lebaran',
            'slug' => 'paket-hemat-lebaran',
            'harga_paket_id' => '2'
        ]);
        Category::create([
            'name' => 'Parcel Lebaran',
            'slug' => 'parcel-lebaran',
            'harga_paket_id' => '3'
        ]);
        Category::create([
            'name' => 'Paket Sembako Munggah',
            'slug' => 'paket-sembaku-munggah',
            'harga_paket_id' => '4'
        ]);
        Category::create([
            'name' => 'Paket Sembako Lebaran',
            'slug' => 'paket-sembako-lebaran',
            'harga_paket_id' => '5'
        ]);
        Category::create([
            'name' => 'Paket Minuman Softdrink',
            'slug' => 'paket-minuman-softdrink',
            'harga_paket_id' => '6'
        ]);
        Category::create([
            'name' => 'Paket Minuman Syirup',
            'slug' => 'paket-minuman-syirup',
            'harga_paket_id' => '7'
        ]);
        Category::create([
            'name' => 'Tas Anak Isi + THR',
            'slug' => 'tas-anak-isi-thr',
            'harga_paket_id' => '8'
        ]);
        Category::create([
            'name' => 'Parcel Anak + THR',
            'slug' => 'parcel-anak-thr',
            'harga_paket_id' => '9'
        ]);
        Category::create([
            'name' => 'Parcel Buah (2,5Kg)',
            'slug' => 'parcel-buah',
            'harga_paket_id' => '10'
        ]);
        Category::create([
            'name' => 'Paket Bahan Kue',
            'slug' => 'paket-bahan-kue',
            'harga_paket_id' => '11'
        ]);
        Category::create([
            'name' => 'Paket THR Munggah',
            'slug' => 'paket-thr-munggah',
            'harga_paket_id' => '12'
        ]);
        Category::create([
            'name' => 'Paket THR Lebaran',
            'slug' => 'paket-thr-lebaran',
            'harga_paket_id' => '13'
        ]);
        Category::create([
            'name' => 'Paket Buah Curah',
            'slug' => 'paket-buah-curah',
            'harga_paket_id' => '1'
        ]);
        Category::create([
            'name' => 'Paket Cemilan Lebaran',
            'slug' => 'paket-cemilan-lebaran',
            'harga_paket_id' => '1'
        ]);
        Category::create([
            'name' => 'Paket Kue Kering',
            'slug' => 'paket-kue-kering',
            'harga_paket_id' => '1'
        ]);
        Category::create([
            'name' => 'Paket Selera Sendiri',
            'slug' => 'paket-selera-sendiri',
            'harga_paket_id' => '1'
        ]);

        // Create Items
        HargaPaket::create([
            'harga' => '0'
        ]);
        HargaPaket::create([
            'harga' => '18000'
        ]);
        HargaPaket::create([
            'harga' => '7500'
        ]);
        HargaPaket::create([
            'harga' => '26500'
        ]);
        HargaPaket::create([
            'harga' => '24000'
        ]);
        HargaPaket::create([
            'harga' => '2500'
        ]);
        HargaPaket::create([
            'harga' => '2000'
        ]);
        HargaPaket::create([
            'harga' => '8000'
        ]);
        HargaPaket::create([
            'harga' => '7500'
        ]);
        HargaPaket::create([
            'harga' => '5000'
        ]);
        HargaPaket::create([
            'harga' => '5500'
        ]);
        HargaPaket::create([
            'harga' => '25000'
        ]);
        HargaPaket::create([
            'harga' => '35000'
        ]);

        // Create Base Item
        baseItem::create([
            'nama' => 'Beras',
            'harga' => '12000',
            'satuan' => 'Kg'
        ]);
        baseItem::create([
            'nama' => 'Minyak Bimoli',
            'harga' => '45000',
            'satuan' => 'Liter'
        ]);
        baseItem::create([
            'nama' => 'Fanta',
            'harga' => '15000',
            'satuan' => 'Botol'
        ]);
        baseItem::create([
            'nama' => 'Sprite',
            'harga' => '15000',
            'satuan' => 'Botol'
        ]);
        baseItem::create([
            'nama' => 'Daging Ayam',
            'harga' => '34000',
            'satuan' => 'Kg'
        ]);

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
