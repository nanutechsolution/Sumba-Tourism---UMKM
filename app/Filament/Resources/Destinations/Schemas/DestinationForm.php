<?php

namespace App\Filament\Resources\Destinations\Schemas;

use App\Models\Destination;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Tabs;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

class DestinationForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Tabs::make('Tabs')
                    ->tabs([

                        // TAB 1: Informasi Dasar
                        Tabs\Tab::make('Informasi Utama')
                            ->icon('heroicon-o-information-circle')
                            ->schema([
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
                                    ->label('Deskripsi Singkat')
                                    ->columnSpanFull(),
                                Toggle::make('is_active')
                                    ->label('Status Aktif')
                                    ->default(true),
                            ])->columns(2),

                        // TAB 2: Story of Sumba
                        Tabs\Tab::make('Story of Sumba')
                            ->icon('heroicon-o-book-open')
                            ->schema([
                                RichEditor::make('history')
                                    ->label('📜 Sejarah Singkat')
                                    ->placeholder('Ceritakan asal-usul tempat ini...')
                                    ->columnSpanFull(),
                                RichEditor::make('culture')
                                    ->label('🛖 Nilai Budaya')
                                    ->placeholder('Jelaskan nilai budaya yang dianut masyarakat sekitar...')
                                    ->columnSpanFull(),
                                RichEditor::make('myth')
                                    ->label('🐉 Mitos & Legenda Lokal')
                                    ->placeholder('Apakah ada cerita mistis atau legenda turun-temurun?')
                                    ->columnSpanFull(),
                                RichEditor::make('tradition')
                                    ->label('🎭 Tradisi & Ritual')
                                    ->placeholder('Ritual atau tradisi apa yang biasa dilakukan di sini?')
                                    ->columnSpanFull(),
                            ]),

                        // TAB 3: Lokasi & Pemetaan
                        Tabs\Tab::make('Lokasi & Koordinat')
                            ->icon('heroicon-o-map')
                            ->schema([
                                Textarea::make('address')
                                    ->label('Alamat Lengkap')
                                    ->columnSpanFull(),
                                TextInput::make('latitude')
                                    ->label('Latitude')
                                    ->numeric(),
                                TextInput::make('longitude')
                                    ->label('Longitude')
                                    ->numeric(),
                            ])->columns(2),

                        // TAB 4: Media & Spot Foto
                        Tabs\Tab::make('Media Visual')
                            ->icon('heroicon-o-photo')
                            ->schema([
                                FileUpload::make('thumbnail')
                                    ->label('Foto Utama (Thumbnail)')
                                    ->image()
                                    ->directory('destinations/thumbnails')
                                    ->required(),
                                FileUpload::make('panorama_image')
                                    ->label('Foto Panorama 360° (Opsional)')
                                    ->image()
                                    ->directory('destinations/panoramas'),
                                FileUpload::make('gallery')
                                    ->label('Galeri Foto')
                                    ->image()
                                    ->multiple()
                                    ->directory('destinations/galleries')
                                    ->reorderable()
                                    ->panelLayout('grid')
                                    ->columnSpanFull(),
                                Repeater::make('photo_spots')
                                    ->label('Daftar Spot Foto Landscape')
                                    ->schema([
                                        TextInput::make('spot_name')
                                            ->label('Nama Spot')
                                            ->required(),
                                        Select::make('best_moment')
                                            ->label('Waktu Terbaik')
                                            ->options([
                                                'sunrise' => 'Sunrise',
                                                'sunset' => 'Sunset',
                                                'milkyway' => 'Malam',
                                                'all_day' => 'Sepanjang Hari'
                                            ])
                                            ->required(),
                                        Textarea::make('angle_tip')
                                            ->label('Tips Sudut Pandang')
                                            ->required(),
                                    ])
                                    ->columnSpanFull(),
                            ])->columns(2),

                    ]) // Penutup array tabs[]
                    ->columnSpanFull(), // Penutup parent Tabs::make()
            ]);
    }
}
