<?php

namespace App\Filament\Resources\Stories\Schemas;

use App\Models\Story;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Group;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

class StoryForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Group::make()->schema([
                    Section::make('Isi Cerita')->schema([
                        TextInput::make('title')
                            ->label('Judul Cerita')
                            ->required()
                            ->maxLength(255)
                            ->live(onBlur: true)
                            ->afterStateUpdated(fn(string $operation, $state, Set $set) => $operation === 'create' ? $set('slug', Str::slug($state) . '-' . uniqid()) : null),
                        TextInput::make('slug')
                            ->required()
                            ->maxLength(255)
                            ->unique(Story::class, 'slug', ignoreRecord: true),
                        TextInput::make('author_name')
                            ->label('Nama Penulis')
                            ->required()
                            ->maxLength(255),
                        Textarea::make('content')
                            ->label('Isi Cerita')
                            ->required()
                            ->rows(10)
                            ->columnSpanFull(),
                    ])->columns(2),
                ])->columnSpan(['lg' => 2]),

                Group::make()->schema([
                    Section::make('Media & Moderasi')->schema([
                        FileUpload::make('photo_path')
                            ->label('Foto Dokumentasi')
                            ->image()
                            ->directory('stories')
                            ->columnSpanFull(),
                        Toggle::make('is_approved')
                            ->label('Setujui & Tampilkan (Publish)')
                            ->helperText('Jika diaktifkan, cerita ini akan muncul di halaman publik.')
                            ->default(false),
                    ]),
                ])->columnSpan(['lg' => 1]),
            ])
            ->columns(3);
    }
}
