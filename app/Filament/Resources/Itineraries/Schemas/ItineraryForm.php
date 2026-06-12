<?php

namespace App\Filament\Resources\Itineraries\Schemas;

use App\Models\Itinerary;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Group;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

class ItineraryForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
               Group::make()->schema([
                   Section::make('Informasi Paket')->schema([
                       TextInput::make('name')
                            ->label('Nama Paket Perjalanan')
                            ->required()
                            ->maxLength(255)
                            ->live(onBlur: true)
                            ->afterStateUpdated(fn(string $operation, $state, Set $set) => $operation === 'create' ? $set('slug', Str::slug($state)) : null),
                       TextInput::make('slug')
                            ->required()
                            ->maxLength(255)
                            ->unique(Itinerary::class, 'slug', ignoreRecord: true),
                       TextInput::make('duration_days')
                            ->label('Durasi (Hari)')
                            ->required()
                            ->numeric()
                            ->minValue(1)
                            ->default(1),
                       TextInput::make('estimated_budget')
                            ->label('Estimasi Biaya (Rp)')
                            ->numeric()
                            ->prefix('Rp')
                            ->placeholder('Contoh: 1500000'),
                       RichEditor::make('description')
                            ->label('Deskripsi Paket')
                            ->columnSpanFull(),
                    ])->columns(2),
                   Section::make('Rute Perjalanan (Destinasi)')->schema([
                       Repeater::make('itineraryDestinations')
                            ->relationship()
                            ->schema([
                               Select::make('destination_id')
                                    ->label('Pilih Destinasi')
                                    ->relationship('destination', 'name')
                                    ->required()
                                    ->searchable()
                                    ->preload()
                                    ->columnSpan(2),
                               TextInput::make('day')
                                    ->label('Hari Ke-')
                                    ->required()
                                    ->numeric()
                                    ->minValue(1)
                                    ->default(1),
                               TextInput::make('order_index')
                                    ->label('Urutan Kunjungan')
                                    ->required()
                                    ->numeric()
                                    ->default(0)
                                    ->helperText('Angka lebih kecil akan dikunjungi lebih dulu pada hari tersebut.'),
                            ])
                            ->columns(4)
                            ->defaultItems(1)
                            ->reorderableWithButtons() // Bisa drag and drop untuk urutan di form
                            ->addActionLabel('Tambah Destinasi ke Rute'),
                    ]),
                ])->columnSpan(['lg' => 2]),

               Group::make()->schema([
                   Section::make('Media & Status')->schema([
                       FileUpload::make('thumbnail')
                            ->label('Foto Sampul Paket')
                            ->image()
                            ->directory('itineraries/thumbnails')
                            ->required(),
                       Toggle::make('is_active')
                            ->label('Status Aktif')
                            ->default(true),
                    ]),
                ])->columnSpan(['lg' => 1]),
            ])
            ->columns(3);
    }
}
