<?php

namespace App\Filament\Resources\Reviews\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Table;

class ReviewsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('destination.name')
                    ->label('Destinasi')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('reviewer_name')
                    ->label('Nama')
                    ->searchable(),
                TextColumn::make('rating')
                    ->label('Rating')
                    ->badge()
                    ->color(fn(string $state): string => match ($state) {
                        '5' => 'success',
                        '4' => 'success',
                        '3' => 'warning',
                        '2' => 'danger',
                        '1' => 'danger',
                        default => 'gray',
                    })
                    ->formatStateUsing(fn(string $state): string => $state . ' Bintang')
                    ->sortable(),
                ToggleColumn::make('is_approved')
                    ->label('Ditampilkan'),
                TextColumn::make('created_at')
                    ->label('Tanggal')
                    ->dateTime('d M Y H:i')
                    ->sortable(),
            ])
            ->defaultSort('created_at', 'desc')
            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
