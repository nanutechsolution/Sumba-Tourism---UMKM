<?php

namespace App\Filament\Widgets;

use App\Models\Destination;
use App\Models\Event;
use App\Models\Umkm;
use BezhanSalleh\FilamentShield\Traits\HasWidgetShield;
use Filament\Support\Icons\Heroicon;
use Filament\Widgets\StatsOverviewWidget as BaseStatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverviewWidget extends BaseStatsOverviewWidget
{
    use HasWidgetShield;
    /**
     * Polling interval agar angka update otomatis tanpa perlu refresh browser
     */
    protected  ?string $pollingInterval = '15s';

    /**
     * Memastikan widget ini muncul di urutan paling atas di Dashboard
     */
    protected static ?int $sort = 1;
    protected function getStats(): array
    {
        return [
            Stat::make('Total Destinasi Aktif', Destination::where('is_active', true)->count())
                ->description('Destinasi wisata siap dikunjungi')
                ->descriptionIcon(Heroicon::OutlinedPhoto)
                ->color('success')
                ->chart([7, 2, 10, 3, 15, 4, 17]), // Grafik dummy visual

            Stat::make('Total UMKM', Umkm::where('is_active', true)->count())
                ->description('Mitra UMKM lokal terdaftar')
                ->descriptionIcon(Heroicon::OutlinedBuildingStorefront)
                ->color('warning')
                ->chart([3, 12, 4, 10, 2, 14, 5]), // Grafik dummy visual

            Stat::make('Total Event & Festival', Event::where('is_active', true)->count())
                ->description('Agenda pariwisata aktif')
                ->descriptionIcon(Heroicon::OutlinedCalendarDays)
                ->color('primary')
                ->chart([1, 4, 2, 8, 5, 12, 3]), // Grafik dummy visual
        ];
    }
}
