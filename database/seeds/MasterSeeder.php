<?php

use App\Models\Master\JenisPengiriman;
use App\Models\Master\Merch;
use App\Models\Master\Payment;
use Illuminate\Database\Seeder;

class MasterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $merch = [
            [
                'name' => 'T-Shirt',
                'size' => 'S',
                'text' => 'High quality cotton T-shirt',
                'harga' => 150000.00,
                'stok' => 100,
                'thumbnail' => 'tshirt.jpg',
                'created_by' => 1,
            ],
            [
                'name' => 'T-Shirt',
                'size' => 'M',
                'text' => 'High quality cotton T-shirt',
                'harga' => 160000.00,
                'stok' => 100,
                'thumbnail' => 'tshirt.jpg',
                'created_by' => 1,
            ],
            [
                'name' => 'T-Shirt',
                'size' => 'L',
                'text' => 'High quality cotton T-shirt',
                'harga' => 170000.00,
                'stok' => 100,
                'thumbnail' => 'tshirt.jpg',
                'created_by' => 1,
            ],
            [
                'name' => 'T-Shirt',
                'size' => 'XL',
                'text' => 'High quality cotton T-shirt',
                'harga' => 180000.00,
                'stok' => 100,
                'thumbnail' => 'tshirt.jpg',
                'created_by' => 1,
            ],
        ];

        Merch::insert($merch);


        $jenisPengiriman = [
            ['name' => 'Dikirim Ke Alamat', 'text' => 'Pengiriman akan dilakukan dengan metode pembayaran COD', 'created_by' => 1],
            ['name' => 'Diambil', 'text' => 'Pengambilan T-Shirt akan diberitahukan melalui email / informasi di dashboard', 'created_by' => 1],
        ];

        JenisPengiriman::insert($jenisPengiriman);


        $payments = [
            ['bank' => 'BCA', 'name' => 'KIKI TEST', 'norek' => '847283172', 'text' => '', 'created_by' => 1],
            ['bank' => 'BRI', 'name' => 'KIKI TEST', 'norek' => '65903082402384', 'text' => '', 'created_by' => 1],
        ];

        Payment::insert($payments);
    }
}
