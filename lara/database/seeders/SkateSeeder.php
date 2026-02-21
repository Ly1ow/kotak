<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Skate;
use Illuminate\Support\Facades\DB;

class SkateSeeder extends Seeder
{
    public function run()
    {
        // Очищаем таблицу перед заполнением (опционально)
        DB::table('skates')->truncate();

        $skates = [
            // Bauer
            [
                'brand' => 'Bauer',
                'model' => 'Vapor X3',
                'size' => 42,
                'quantity' => 5,
                'image' => 'https://images.unsplash.com/photo-1551698618-1dfe5d97d256?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'brand' => 'Bauer',
                'model' => 'Supreme S37',
                'size' => 44,
                'quantity' => 3,
                'image' => 'https://images.unsplash.com/photo-1551698618-1dfe5d97d256?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'brand' => 'Bauer',
                'model' => 'Nexus N2700',
                'size' => 41,
                'quantity' => 4,
                'image' => 'https://images.unsplash.com/photo-1551698618-1dfe5d97d256?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // CCM
            [
                'brand' => 'CCM',
                'model' => 'JetSpeed FT485',
                'size' => 43,
                'quantity' => 2,
                'image' => 'https://images.unsplash.com/photo-1551698618-1dfe5d97d256?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'brand' => 'CCM',
                'model' => 'Ribcor 80K',
                'size' => 45,
                'quantity' => 3,
                'image' => 'https://images.unsplash.com/photo-1551698618-1dfe5d97d256?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'brand' => 'CCM',
                'model' => 'Tacks AS-580',
                'size' => 42,
                'quantity' => 4,
                'image' => 'https://images.unsplash.com/photo-1551698618-1dfe5d97d256?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // Graf
            [
                'brand' => 'Graf',
                'model' => 'Supra 703',
                'size' => 40,
                'quantity' => 2,
                'image' => 'https://images.unsplash.com/photo-1551698618-1dfe5d97d256?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'brand' => 'Graf',
                'model' => 'Cobra 500',
                'size' => 46,
                'quantity' => 1,
                'image' => 'https://images.unsplash.com/photo-1551698618-1dfe5d97d256?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // Детские коньки
            [
                'brand' => 'Bauer',
                'model' => 'Youth Vapor',
                'size' => 30,
                'quantity' => 6,
                'image' => 'https://images.unsplash.com/photo-1551698618-1dfe5d97d256?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'brand' => 'CCM',
                'model' => 'Kids Ribcor',
                'size' => 32,
                'quantity' => 4,
                'image' => 'https://images.unsplash.com/photo-1551698618-1dfe5d97d256?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'brand' => 'Graf',
                'model' => 'Junior Supra',
                'size' => 35,
                'quantity' => 3,
                'image' => 'https://images.unsplash.com/photo-1551698618-1dfe5d97d256?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // Дополнительные модели
            [
                'brand' => 'Reebok',
                'model' => '17K Pump',
                'size' => 44,
                'quantity' => 2,
                'image' => 'https://images.unsplash.com/photo-1551698618-1dfe5d97d256?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'brand' => 'Easton',
                'model' => 'Synergy',
                'size' => 43,
                'quantity' => 2,
                'image' => 'https://images.unsplash.com/photo-1551698618-1dfe5d97d256?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'brand' => 'Mission',
                'model' => 'Inhaler',
                'size' => 41,
                'quantity' => 3,
                'image' => 'https://images.unsplash.com/photo-1551698618-1dfe5d97d256?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        foreach ($skates as $skate) {
            Skate::create($skate);
        }

        $this->command->info('Создано ' . count($skates) . ' записей коньков');
    }
}