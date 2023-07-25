<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use app\Models\Disease;

class Diseaseeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
    Disease::create([
       'name' => 'Influenza',
    ]);

       Disease::create([
       'name' => 'COVID-19',
    ]);

       Disease::create([
       'name' => 'Malaria',
    ]);

       Disease::create([
       'name' => 'Diabetes',
    ]);

       Disease::create([
       'name' => 'Cancer',
    ]);

       Disease::create([
       'name' => 'HIV/AIDS',
    ]);

       Disease::create([
       'name' => 'Alzheimer',
    ]);

       Disease::create([
       'name' => 'Parkinson',
    ]);

       Disease::create([
       'name' => 'Stroke',
    ]);

       Disease::create([
       'name' => 'Heart disease',
    ]);

       Disease::create([
       'name' => 'Dengue fever',
    ]);

       Disease::create([
       'name' => 'Tuberculosis',
    ]);

       Disease::create([
       'name' => 'Epilepsy',
    ]);

       Disease::create([
       'name' => 'Asthma',
    ]);

       Disease::create([
       'name' => 'Arthritis',
        ]);
    
}
}
