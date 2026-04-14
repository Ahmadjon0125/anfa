<?php

namespace App\Filament\Resources\Usages\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class UsagesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('title')
                    ->label('Sarlavha')
                    ->html()
                    ->limit(50)
                    ->searchable(),


                TextColumn::make('subtitle')
                    ->label('Sub-header')
                    ->limit(30)
                    ->toggleable(),


                TextColumn::make('cards')
                    ->label('Kartochkalar')
                    ->getStateUsing(fn($record) => count($record->cards ?? []) . ' ta blok')
                    ->badge()
                    ->color('success'),


                TextColumn::make('updated_at')
                    ->label('Yangilandi')
                    ->dateTime('d.m.Y H:i')
                    ->sortable(),
            ])
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
