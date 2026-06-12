<?php

namespace App\Filament\Resources\News\Schemas;

use App\Models\News;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Group;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

class NewsForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Group::make()->schema([
                    Section::make('Konten Berita')->schema([
                        TextInput::make('title')
                            ->label('Judul Berita')
                            ->required()
                            ->maxLength(255)
                            ->live(onBlur: true)
                            ->afterStateUpdated(fn(string $operation, $state, Set $set) => $operation === 'create' ? $set('slug', Str::slug($state)) : null),
                        TextInput::make('slug')
                            ->required()
                            ->maxLength(255)
                            ->unique(News::class, 'slug', ignoreRecord: true),
                        RichEditor::make('content')
                            ->label('Isi Artikel / Berita')
                            ->required()
                            ->columnSpanFull(),
                    ])->columns(2),
                ])->columnSpan(['lg' => 2]),

                Group::make()->schema([
                    Section::make('Publish & Media')->schema([
                        FileUpload::make('thumbnail')
                            ->label('Foto Sampul (Thumbnail)')
                            ->image()
                            ->directory('news/thumbnails')
                            ->required(),
                        Select::make('status')
                            ->label('Status Publikasi')
                            ->options([
                                'draft' => 'Draft (Simpan Sementara)',
                                'published' => 'Published (Terbitkan)',
                            ])
                            ->required()
                            ->default('draft')
                            ->live()
                            ->afterStateUpdated(function ($state, Set $set) {
                                if ($state === 'published') {
                                    $set('published_at', now()->format('Y-m-d H:i:s'));
                                } else {
                                    $set('published_at', null);
                                }
                            }),
                        DateTimePicker::make('published_at')
                            ->label('Waktu Publikasi')
                            ->disabled()
                            ->dehydrated(), // Tetap mengirimkan data ke database walaupun di-disable
                        // Hidden input untuk menyimpan user_id yang sedang login secara otomatis
                        Hidden::make('user_id')
                            ->default(fn() => auth()->id())
                            ->required(),
                    ]),
                ])->columnSpan(['lg' => 1]),
            ])
            ->columns(3);
    }
}
