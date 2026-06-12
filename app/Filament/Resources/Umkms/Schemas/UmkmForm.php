<?php

namespace App\Filament\Resources\Umkms\Schemas;

use App\Models\Umkm;
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

class UmkmForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Group::make()->schema([
                    Section::make('Informasi UMKM')->schema([
                        TextInput::make('name')
                            ->label('Nama Usaha / Produk')
                            ->required()
                            ->maxLength(255)
                            ->live(onBlur: true)
                            ->afterStateUpdated(fn(string $operation, $state, Set $set) => $operation === 'create' ? $set('slug', Str::slug($state)) : null),
                        TextInput::make('slug')
                            ->required()
                            ->maxLength(255)
                            ->unique(Umkm::class, 'slug', ignoreRecord: true),
                        Select::make('category')
                            ->label('Kategori Usaha')
                            ->options([
                                'Kuliner' => 'Kuliner & Makanan',
                                'Kriya' => 'Kriya & Kerajinan Tangan',
                                'Fashion' => 'Fashion & Kain Tenun',
                                'Penginapan' => 'Penginapan & Homestay',
                                'Jasa' => 'Jasa & Sewa Kendaraan',
                                'Lainnya' => 'Lainnya',
                            ])
                            ->required()
                            ->searchable(),
                        Select::make('village_id')
                            ->label('Desa / Kelurahan')
                            ->relationship('village', 'name')
                            ->required()
                            ->searchable()
                            ->preload(),
                        TextInput::make('phone_number')
                            ->label('Nomor WhatsApp / Telepon')
                            ->tel()
                            ->maxLength(255),
                        RichEditor::make('description')
                            ->label('Deskripsi Usaha')
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
                            ->label('Foto Utama / Logo')
                            ->image()
                            ->directory('umkms/thumbnails')
                            ->required(),
                        FileUpload::make('gallery')
                            ->label('Galeri Produk')
                            ->image()
                            ->multiple()
                            ->directory('umkms/galleries')
                            ->reorderable()
                            ->panelLayout('grid'),
                    ]),
                ])->columnSpan(['lg' => 1]),
            ])
            ->columns(3);
    }
}
