<?php

namespace App\Filament\Resources\Destinations\Schemas;

use App\Models\Destination;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Group;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

class DestinationForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Group::make()->schema([
                    Section::make('Informasi Utama')->schema([
                        TextInput::make('name')
                            ->label('Nama Destinasi')
                            ->required()
                            ->maxLength(255)
                            ->live(onBlur: true)
                            ->afterStateUpdated(fn(string $operation, $state, Set $set) => $operation === 'create' ? $set('slug', Str::slug($state)) : null),
                        TextInput::make('slug')
                            ->required()
                            ->maxLength(255)
                            ->unique(Destination::class, 'slug', ignoreRecord: true),
                        Select::make('village_id')
                            ->label('Desa / Kelurahan')
                            ->relationship('village', 'name')
                            ->required()
                            ->searchable()
                            ->preload(),
                        RichEditor::make('description')
                            ->label('Deskripsi Lengkap')
                            ->columnSpanFull(),
                    ])->columns(2),

                    Section::make('Lokasi & Status')->schema([
                        Textarea::make('address')
                            ->label('Alamat Lengkap')
                            ->columnSpanFull(),
                        TextInput::make('latitude')
                            ->label('Latitude (Opsional)')
                            ->numeric(),
                        TextInput::make('longitude')
                            ->label('Longitude (Opsional)')
                            ->numeric(),
                        Toggle::make('is_active')
                            ->label('Status Aktif')
                            ->default(true),
                    ])->columns(2),
                ])->columnSpan(['lg' => 2]),

                Group::make()->schema([
                    Section::make('Media Gambar')->schema([
                        FileUpload::make('thumbnail')
                            ->label('Foto Utama (Thumbnail)')
                            ->image()
                            ->directory('destinations/thumbnails')
                            ->required(),
                        FileUpload::make('gallery')
                            ->label('Galeri Foto (Bisa lebih dari satu)')
                            ->image()
                            ->multiple()
                            ->directory('destinations/galleries')
                            ->reorderable()
                            ->panelLayout('grid'),
                    ]),
                ])->columnSpan(['lg' => 1]),
            ])
            ->columns(3);
    }
}
