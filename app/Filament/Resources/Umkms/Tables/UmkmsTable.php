<?php

namespace App\Filament\Resources\Umkms\Tables;

use App\Models\Umkm;
use Filament\Actions\Action;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Support\HtmlString;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class UmkmsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('thumbnail')
                    ->label('Foto'),
                TextColumn::make('name')
                    ->label('Nama Usaha')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('category')
                    ->label('Kategori')
                    ->badge()
                    ->sortable()
                    ->searchable(),
                TextColumn::make('village.name')
                    ->label('Desa')
                    ->sortable(),
                ToggleColumn::make('is_active')
                    ->label('Aktif'),
            ])
            ->filters([
                SelectFilter::make('category')
                    ->label('Kategori')
                    ->options([
                        'Kuliner' => 'Kuliner & Makanan',
                        'Kriya' => 'Kriya & Kerajinan Tangan',
                        'Fashion' => 'Fashion & Kain Tenun',
                        'Penginapan' => 'Penginapan & Homestay',
                        'Jasa' => 'Jasa & Sewa Kendaraan',
                        'Lainnya' => 'Lainnya',
                    ]),
                SelectFilter::make('village_id')
                    ->label('Filter Desa')
                    ->relationship('village', 'name'),
            ])
            ->recordActions([
                EditAction::make(),
                Action::make('qrCode')
                    ->label('QR Code')
                    ->icon('heroicon-o-qr-code')
                    ->color('warning')
                    ->modalHeading(fn (Umkm $record) => 'QR Code: ' . $record->name)
                    ->modalSubmitAction(false) 
                    ->modalCancelActionLabel('Tutup')
                    ->modalContent(function (Umkm $record) {
                        $url = route('umkm.show', $record->slug);
                        $qrCodeSvg = QrCode::size(250)->margin(1)->generate($url);
                        $qrCodeBase64 = 'data:image/svg+xml;base64,' . base64_encode($qrCodeSvg);
                        return new HtmlString('
                            <div class="flex flex-col items-center justify-center p-4">
                                <div class="bg-white p-4 rounded-xl shadow-sm border border-gray-200 mb-4">
                                    ' . $qrCodeSvg . '
                                </div>
                                <p class="text-sm text-center text-gray-500 mb-4 max-w-xs">
                                    Pindai kode ini untuk profil usaha <b>' . $record->name . '</b>
                                </p>
                                <a href="' . $qrCodeBase64 . '" download="QR-Code-UMKM-' . $record->slug . '.svg" class="bg-amber-500 text-gray-900 font-bold py-2 px-6 rounded-lg hover:bg-amber-600 transition shadow-sm flex items-center">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path></svg>
                                    Unduh QR Code
                                </a>
                            </div>
                        ');
                    }),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
