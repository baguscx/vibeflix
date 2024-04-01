<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Movie;

class MovieTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $movies = [
            [
                'name' => 'The Shawshank Redemption',
                'slug' => 'the-shawshank-redemption',
                'category' => 'Drama',
                'video_url' => 'https://youtu.be/2FYlvGAf-iM',
                'thumbnail' => 'https://helios-i.mashable.com/imagery/videos/04Qg3qlDRI3FscjxidIYJdP/hero-image.fill.size_1248x702.v1711459854.png',
                'rating' => 4.3,
                'is_featured' => true,
            ],
            [
                'name' => 'The Godfather',
                'slug' => 'the-godfather',
                'category' => 'Crime',
                'video_url' => 'https://www.youtube.com/watch?v=17KBPN2yy40',
                'thumbnail' => 'https://occ-0-6710-58.1.nflxso.net/dnm/api/v6/Qs00mKCpRvrkl3HZAN5KwEL1kpE/AAAABdHPBUFyq_0MertEiMMVe8uWXrQs2wN4g_bgMbUP_XMmHIq-ib5z3v1vPI4kQdD3Iyz3k3A5JLAszmSPc2sZLyS6fu0Bua5bp1xe_yDH69PqepOwiU9TaZ-uvblJNwWNyobVWw.jpg',
                'rating' => 4.5,
                'is_featured' => false,
            ],
            [
                'name' => 'The Dark Knight',
                'slug' => 'the-dark-knight',
                'category' => 'Action',
                'video_url' => 'https://youtu.be/HBCN9905LDs',
                'thumbnail' => 'https://occ-0-6710-58.1.nflxso.net/dnm/api/v6/Qs00mKCpRvrkl3HZAN5KwEL1kpE/AAAABWMoJTKp2R_slQ4kEiv-73NUnEVV3zyk6JCwgXNXdQbApPo2P0K8hKB0N6rZXYHiiAhzjp2cOYhoRFU_wf4i8AiaJ8yF0ISRqkR5Cy71TFeQR6TvPmCwy0_k2xuB28ysss63ZA.jpg',
                'rating' => 4.4,
                'is_featured' => false,
            ]
        ];
        Movie::insert($movies);
    }
}
