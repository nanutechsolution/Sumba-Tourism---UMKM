<?php

namespace App\Filament\Resources\Galleries\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class GalleryForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Informasi Foto')->schema([
                    FileUpload::make('image_path')
                        ->label('Unggah Foto')
                        ->image()
                        ->directory('public_galleries')
                        ->required()
                        ->columnSpanFull(),
                    TextInput::make('title')
                        ->label('Caption / Judul Foto')
                        ->required()
                        ->maxLength(255),
                    Select::make('category')
                        ->label('Kategori')
                        ->options([
                            'Alam' => 'Keindahan Alam',
                            'Budaya' => 'Tradisi & Budaya',
                            'Kuliner' => 'Kuliner Lokal',
                            'Infrastruktur' => 'Fasilitas & Infrastruktur',
                        ])
                        ->required(),
                    Toggle::make('is_active')
                        ->label('Tampilkan di Website')
                        ->default(true),
                ])->columns(2),
            ]);
    }
}
