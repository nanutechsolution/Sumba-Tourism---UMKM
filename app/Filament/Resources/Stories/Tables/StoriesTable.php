<?php

namespace App\Filament\Resources\Stories\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Tables\Table;

class StoriesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('photo_path')
                    ->label('Foto')
                    ->circular(),
                TextColumn::make('title')
                    ->label('Judul')
                    ->searchable()
                    ->limit(30),
                TextColumn::make('author_name')
                    ->label('Penulis')
                    ->searchable(),
                TextColumn::make('created_at')
                    ->label('Tanggal Dikirim')
                    ->dateTime('d M Y H:i')
                    ->sortable(),
                ToggleColumn::make('is_approved')
                    ->label('Tampil (Approved)'),
            ])
            ->defaultSort('created_at', 'desc') // Urutkan dari yang paling baru
            ->filters([
                TernaryFilter::make('is_approved')
                    ->label('Status Moderasi')
                    ->placeholder('Semua Cerita')
                    ->trueLabel('Sudah Disetujui')
                    ->falseLabel('Menunggu Persetujuan (Pending)'),
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
