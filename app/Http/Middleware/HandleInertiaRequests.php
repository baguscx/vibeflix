<?php

namespace App\Http\Middleware;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Middleware;

class HandleInertiaRequests extends Middleware
{
    /**
     * The root template that is loaded on the first page visit.
     *
     * @var string
     */
    protected $rootView = 'app';

    /**
     * Determine the current asset version.
     */
    public function version(Request $request): string|null
    {
        return parent::version($request);
    }

    private function activePlan(){
        $activePlan = Auth::user() ? Auth::user()->LastActiveUserSubscription : null;
        if(!$activePlan){
            return null;
        }

        $lastDay = Carbon::parse($activePlan->updated_at)->addMonth($activePlan->subscriptionPlan->active_period_in_months);
        $activeDays = Carbon::parse($activePlan->updated_at)->diffInDays($lastDay);
        $expiredDate = Carbon::parse($activePlan->expired_date);
        $now = Carbon::now('Asia/Jakarta'); // Contoh mengatur zona waktu

        // Cek jika subscription masih dalam masa aktif
        if ($now->lessThanOrEqualTo($expiredDate)) {
            // Menghitung sisa hari yang benar jika tanggal sekarang kurang dari atau sama dengan expired_date
            $remainingActiveDays =(int) $now->diffInDays($expiredDate);
        } else {
            // Jika tanggal sekarang melewati expired_date, berarti tidak ada hari tersisa
            $remainingActiveDays = 0;
        }

        return [
            'name' => $activePlan->subscriptionPlan->name,
            'remainingActiveDays'=> $remainingActiveDays,
            'activeDays' => $activeDays,

        ];
    }

    /**
     * Define the props that are shared by default.
     *
     * @return array<string, mixed>
     */
    public function share(Request $request): array
    {
        return [
            ...parent::share($request),
            'auth' => [
                'user' => $request->user(),
                'activePlan' => $this->activePlan(),
            ],
        ];
    }
}
