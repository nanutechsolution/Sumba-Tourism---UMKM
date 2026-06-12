<?php

namespace App\Filament\Resources\Destinations\Tables;

use App\Models\Destination;
use Filament\Actions\Action;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Tables\Table;
use Illuminate\Support\HtmlString;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class DestinationsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('thumbnail')
                    ->label('Foto'),
                TextColumn::make('name')
                    ->label('Nama Destinasi')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('village.name')
                    ->label('Desa')
                    ->sortable()
                    ->searchable(),
                ToggleColumn::make('is_active')
                    ->label('Aktif'),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                SelectFilter::make('village_id')
                    ->label('Filter Desa')
                    ->relationship('village', 'name'),
                TernaryFilter::make('is_active')
                    ->label('Status Aktif'),
            ])
            ->recordActions([
                EditAction::make(),
                Action::make('qrCode')
                    ->label('QR Code')
                    ->icon('heroicon-o-qr-code')
                    ->color('info')
                    ->modalHeading(fn (Destination $record) => 'QR Code: ' . $record->name)
                    ->modalSubmitAction(false) // Hilangkan tombol submit karena ini hanya view
                    ->modalCancelActionLabel('Tutup')
                    ->modalContent(function (Destination $record) {
                        // Generate URL publik untuk destinasi ini
                        $url = route('destination.show', $record->slug);
                        
                        // Generate gambar QR Code dalam format SVG
                        $qrCodeSvg = QrCode::size(250)->margin(1)->generate($url);
                        
                        // Konversi ke base64 agar mudah diunduh (Data URI)
                        $qrCodeBase64 = 'data:image/svg+xml;base64,' . base64_encode($qrCodeSvg);

                        return new HtmlString('
                            <div class="flex flex-col items-center justify-center p-4">
                                <div class="bg-white p-4 rounded-xl shadow-sm border border-gray-200 mb-4">
                                    ' . $qrCodeSvg . '
                                </div>
                                <p class="text-sm text-center text-gray-500 mb-4 max-w-xs">
                                    Pindai kode ini untuk langsung menuju halaman <b>' . $record->name . '</b>
                                </p>
                                <a href="' . $qrCodeBase64 . '" download="QR-Code-' . $record->slug . '.svg" class="bg-amber-500 text-gray-900 font-bold py-2 px-6 rounded-lg hover:bg-amber-600 transition shadow-sm flex items-center">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path></svg>
                                    Unduh QR Code (SVG)
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
