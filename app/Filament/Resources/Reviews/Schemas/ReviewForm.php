<?php

namespace App\Filament\Resources\Reviews\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class ReviewForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('reviewer_name')
                    ->label('Nama Reviewer')
                    ->disabled(),
                Select::make('destination_id')
                    ->relationship('destination', 'name')
                    ->disabled(),
                TextInput::make('rating')
                    ->label('Bintang (1-5)')
                    ->numeric()
                    ->disabled(),
                Textarea::make('comment')
                    ->label('Komentar')
                    ->disabled()
                    ->columnSpanFull(),
                Toggle::make('is_approved')
                    ->label('Tampilkan di Website (Approved)')
                    ->required(),
            ]);
    }
}
