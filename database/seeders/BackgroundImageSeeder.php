<?php

namespace Database\Seeders;

use App\Models\BackgroundImage;
use Illuminate\Database\Seeder;

class BackgroundImageSeeder extends Seeder
{
    public function run(): void
    {
        $images = [
            'https://picsum.photos/seed/amphi-g1/700/420',
            'https://picsum.photos/seed/amphi-g2/700/420',
            'https://picsum.photos/seed/amphi-g3/700/420',
            'https://picsum.photos/seed/amphi-g4/700/420',
            'https://picsum.photos/seed/amphi-g5/700/420',
            'https://picsum.photos/seed/amphi-g6/700/420',
            'https://picsum.photos/seed/amphi-g7/700/420',
        ];

        foreach ($images as $url) {
            BackgroundImage::create([
                'url' => $url,
                'thumbnail_url' => str_replace('/700/420', '/200/200', $url),
            ]);
        }
    }
}
