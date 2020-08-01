<?php

use App\Download;
use Illuminate\Database\Seeder;

class DownloadSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = array(
            array(
                'name'            =>    'Sample download 1',
                'filepath'    =>    'downloads/one.zip',
                'price'            =>    500,
            ),
            array(
                'name'            =>    'Sample download 2',
                'filepath'    =>    'downloads/two.zip',
                'price'            =>    1000,
            ),
        );

        foreach ($data as $properties) {

            $download = new Download($properties);
            $download->save();

        }
    }
}
