<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\SubscriptionPlan;

class SubscriptionPlanTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $subscriptionPlan = [
            [
                "name" => "Basic",
                "price" => 100000,
                "active_period_in_months" => 3,
                "features" => json_encode(["feature1", "feature2", "feature3"]),
            ],
            [
                "name" => "Premium",
                "price" => 1000000,
                "active_period_in_months" => 6,
                "features" => json_encode(["feature1", "feature2", "feature3", "feature4", "feature5"]),
            ],
        ];

        SubscriptionPlan::insert($subscriptionPlan);

    }
}
