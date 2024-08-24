<?php

use App\Models\Master\Activity;
use App\Models\Master\Event;
use App\Models\Master\Setting;
use App\Models\Master\Sponsor;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        ///SETTING
        $text = 'Assalamualikum wr.wb.<br>
                        Salam sejahtera untuk kita semua,
                        <br>
                        <br>Salam otomotif !
                        <br>Salam jatim pride ! All In Untuk Semesta 🔥

                        <br>Puji syukur kehadirat Allah SWT atas segala nikmat dan karunia-Nya sehingga kita semua masih
                        diberikan kesehatan jasmani maupun rohani dan tetap menjalin silaturahmi dalam satu hobi di dunia
                        otomotif .
                        <br>
                        <br>Perkenalkan saya Mas Fadh Tri Wahyudo S.E. Sering di sapa mas fadh , selaku dari CEO / Leader
                        Jatim Pride
                        <br>
                        <br>JATIM PRIDE adalah sebuah kegiatan apresiasi dalam bidang otomotif motor di segala merk motor
                        yang ada. Banyak nya antusiasme pada akhir akhir ini pemuda pemuda yang menggandrungi hobi dalam
                        bidang
                        otomotif melalui media sosial yang berkembang pada jaman saat ini. Kami “JATI JAYA ENTERTAINMENT”
                        mengadakan acara yang bertujuan untuk menyambung tali silaturahmi dan menyambung seduluran diantara
                        banyaknya jenis jenis motor yang ada.Kegiatan ini akan mengundang seluruh pemuda yang memiliki hobi
                        yang sama di sekitar Provinsi Jawa Timur. Dari CB, Herex, Matic, Supermoto, Moge, 2 tak dan lain
                        sebagainya akan turut hadir, karena sebuah perbedaan itu akanme nimbulkan suatu Persaudaraan. Acara
                        ini memiliki konsep unik dan menarik, serta diikuti dengan konten acara yang berkualitas dengan
                        mengusung tema “JATIM PRIDE” dengan maksud bahwa kami adalah Kerbanggaan Jawa Timur dengan banyaknya
                        jenis motor yang menarik, elegan bagi berbagai macam kalangan serta selalu menumbuhkan persatuan dan
                        persaudaraan terhadap sesama club dengan jenis / merk yang berbeda.
                        <br>Alhamdulillaah Jatim pride sudah berada di Volume 4 , ini adalah sebuah semangat luar biasa
                        pemuda
                        dibidang otomotif untuk tetap melestarikan di Jawa Timur
                        Saya mengucapkan terima kasih sebanyak banyaknya kepada seluruh Elemen yang selalu membantu setiap
                        giat Jatim Pride mulai volume 1-4 ini .
                        <br>
                        <br>Semoga kita semua senantiasa di beri kesehatan dan kemudahan dalam segala hal langkah kebaikan
                        kita
                        untuk manfaat di masyarakat !
                        <br>
                        <br>Ingat tetap jangan arogan di Jalan raya , keep safety dan tunjukkan bahwa kita semua sangat
                        bermanfaat untuk masyarakat luas di Jawa Timur !
                        <br>
                        <br>Salam Jatim Pride ! All in untuk Semesta !';

        $data = [
            'event_gmaps' => 'https://maps.app.goo.gl/ThygBK4LbCH5sobU9',
            'event_date' => '2024-09-29 07:00:00',
            'about_name' => 'Mas Fadh Tri Wahyudo S.E.',
            'about_jabatan' => 'CEO / LEADER JATIM PRIDE',
            'about_text' => $text,
            'contact_name' => 'Jati Jaya Garage',
            'contact_alamat' => 'Jl. Pahlawan Sunaryo No.256, Jabon, Kutorejo, Kec. Pandaan, Pasuruan, Jawa Timur 67156',
            'contact_whatsapp' => '0822-4528-3892',
            'contact_email' => 'officialjatimpride@gmail.com',
            'contact_instagram' => 'https://www.instagram.com/jatim.pride',
            'contact_tiktok' => 'https://www.tiktok.com/@jatijayagarage',
            'contact_youtube' => 'https://youtube.com/@jatijayagarage5108?si=_f8iPep27QHP87hS',
        ];

        Setting::create($data);
        ///SETTING


        //EVENT
        $event = [
            ['name' => 'JATIM PRIDE VOL.1', 'urutan' => 1,],
            ['name' => 'JATIM PRIDE VOL.2', 'urutan' => 2,],
            ['name' => 'JATIM PRIDE VOL.3', 'urutan' => 3,],
        ];

        Event::insert($event);
        //EVENT

        //ACTIVITY
        $activity = [
            ['name' => 'KONTES OTOMOTIF', 'urutan' => 1],
            ['name' => 'SUNDAY MORNING RIDE', 'urutan' => 2],
            ['name' => 'BAZZAR UMKM', 'urutan' => 3],
            ['name' => 'KONSER MUSIK', 'urutan' => 4],
        ];

        Activity::insert($activity);
        //ACTIVITY

        //SPONSOR
        $sponsor = [
            ['name' => 'jne', 'urutan' => 1],
            ['name' => 'surya', 'urutan' => 2],
            ['name' => 'kilap', 'urutan' => 3],
        ];

        Sponsor::insert($sponsor);
        //SPONSOR

    }
}
