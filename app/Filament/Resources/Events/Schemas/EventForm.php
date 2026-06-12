<?php

namespace App\Filament\Resources\Events\Schemas;

use App\Models\Event;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Group;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Hamcrest\Core\Set;
use Illuminate\Support\Str;

class EventForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Group::make()->schema([
                    Section::make('Informasi Event')->schema([
                        TextInput::make('name')
                            ->label('Nama Event / Festival')
                            ->required()
                            ->maxLength(255)
                            ->live(onBlur: true)
                            ->afterStateUpdated(fn(string $operation, $state, Set $set) => $operation === 'create' ? $set('slug', Str::slug($state)) : null),
                        TextInput::make('slug')
                            ->required()
                            ->maxLength(255)
                            ->unique(Event::class, 'slug', ignoreRecord: true),
                        RichEditor::make('description')
                            ->label('Deskripsi Event')
                            ->columnSpanFull(),
                    ])->columns(2),

                    Section::make('Jadwal & Lokasi')->schema([
                        DatePicker::make('start_date')
                            ->label('Tanggal Mulai')
                            ->required(),
                        DatePicker::make('end_date')
                            ->label('Tanggal Selesai (Opsional)'),
                        Select::make('village_id')
                            ->label('Desa / Kelurahan')
                            ->relationship('village', 'name')
                            ->required()
                            ->searchable()
                            ->preload(),
                        TextInput::make('location_name')
                            ->label('Nama Tempat Spesifik (Contoh: Lapangan Pasola)')
                            ->maxLength(255),
                        Toggle::make('is_active')
                            ->label('Status Aktif')
                            ->default(true),
                    ])->columns(2),
                ])->columnSpan(['lg' => 2]),

                Group::make()->schema([
                    Section::make('Poster / Banner')->schema([
                        FileUpload::make('thumbnail')
                            ->label('Poster Event')
                            ->image()
                            ->directory('events/thumbnails')
                            ->required(),
                    ]),
                ])->columnSpan(['lg' => 1]),
            ])
            ->columns(3);
    }
}
