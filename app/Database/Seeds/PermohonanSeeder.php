<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use CodeIgniter\I18n\Time;
use App\Models\FakultiModel;
use Faker\Factory;
use Faker\Provider\ms_MY\PhoneNumber;

class PermohonanSeeder extends Seeder
{
    public function run()
    {
        // Create two Faker instances for English and Malay
        $fakerEN = Factory::create('en_US'); // For English
        $fakerMY = Factory::create('ms_MY'); // For Malay
        
        // Add Malaysian-specific providers to the Malay Faker
        $fakerMY->addProvider(new PhoneNumber($fakerMY));
        
        $this->fakultiModel = new FakultiModel();
        $fakulti = $this->fakultiModel->orderBy('RAND()')->first()['fakulti'];

        $nama = $fakerMY->randomElement([
            "Pertandingan Futsal",
            "Kejohanan Badminton Terbuka",
            "Perlawanan Bola Sepak Amal",
            "Larian Amal 10KM",
            "Pertandingan Bola Jaring Wanita",
            "Sukaneka Hari Keluarga",
            "Kejohanan Sepak Takraw Kebangsaan",
            "Pertandingan Ping Pong Pelajar",
            "Kursus Memanah Remaja",
            "Hari Sukan Tahunan"]);
        // print_r($nama);
        // exit();

        for ($i = 0; $i < 10; $i++) {
            $data = [
                // 'nama_program' => ucwords($fakerEN->catchPhrase()).' 2025', 
                'lokasi_program' => $fakerMY->city, 
                'penganjur' => $fakerMY->insurance, 
                'tarikh_mula' => Time::today()->format('Y-m-d'), 
                'tarikh_tamat' => Time::tomorrow()->format('Y-m-d'), 
                'peruntukan' => $fakerEN->randomNumber(5, true), 
                'nama_kelab' => $fakerMY->companyName,
                'nama_pemohon' => $fullName = $fakerMY->randomElement([$fakerMY->firstNameMaleMalay, $fakerMY->firstNameFemaleMalay]).' '.$fakerMY->lastNameMalay, 
                'no_matrik' => strtoupper($fakerMY->regexify('[A-D]{2}[0-4]{6}')), 
                'jawatan' => 'Pengerusi', 
                'fakulti' => $fakulti, 
                'no_telefon' => $fakerMY->mobileNumber(true, false), 
                'kertas_kerja' => $fakerEN->randomNumber(5, true).'.pdf', 
                'perakuan' => 1,
                'id_pemohon' => $fakerMY->randomElement([1, 2, 7, 13]),
                'status_id' => $fakerMY->numberBetween(1, 4),
                'komen' => '',
                'reviewed_at' => null,
                'created_at' => Time::now(),
                'updated_at' => Time::now(),
            ];
    
            
            // Insert the data into the database
            $this->db->table('permohonan')->insert($data);
        }
    }
}