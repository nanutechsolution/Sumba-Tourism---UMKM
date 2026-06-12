<?php

namespace App\Filament\Widgets;

use App\Models\Destination;
use App\Models\PageView;
use App\Models\Review;
use App\Models\Umkm;
use Filament\Support\Icons\Heroicon;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Facades\DB;

class StatsOverview extends StatsOverviewWidget
{
  protected function getStats(): array
    {
        // Menghitung produk/destinasi paling populer berdasarkan jumlah review (proxy)
        $topDestination = Review::select('destination_id', DB::raw('count(*) as total'))
            ->groupBy('destination_id')->orderBy('total', 'desc')->first();
        
        $destName = $topDestination ? Destination::find($topDestination->destination_id)->name : '-';

        return [
            Stat::make('Total Destinasi', Destination::count())
                ->description('Destinasi terdaftar')
                ->icon(Heroicon::OutlinedPhoto),
            Stat::make('Total UMKM', Umkm::count())
                ->description('Mitra UMKM aktif')
                ->icon(Heroicon::OutlinedBuildingStorefront),
            Stat::make('Pengunjung', PageView::count())
                ->description('Total page views')
                ->icon(Heroicon::OutlinedEye),
            Stat::make('Destinasi Populer', $destName)
                ->description('Berdasarkan jumlah review')
                ->icon(Heroicon::OutlinedStar),
        ];
    }
}
