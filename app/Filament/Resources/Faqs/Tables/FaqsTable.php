<?php

namespace App\Filament\Resources\Faqs\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class FaqsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('badge')
                ->label('Kichik matn')
                ->searchable(),

          
            TextColumn::make('title')
                ->label('Sarlavha')
                ->html()
                ->limit(50)
                ->searchable(),

       
            TextColumn::make('questions')
                ->label('Savollar soni')
                ->getStateUsing(fn ($record) => count($record->questions ?? []) . ' ta savol')
                ->badge()
                ->color('info'),

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
