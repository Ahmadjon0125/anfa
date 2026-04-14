<?php

namespace App\Filament\Resources\Leads\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Table;

class LeadsTable
{
    public static function configure(Table $table): Table
    {
        return $table
           ->columns([
            TextColumn::make('created_at')
                ->label('Sana')
                ->dateTime()
                ->sortable(),
            TextColumn::make('name')
                ->label('Ism')
                ->searchable(),
            TextColumn::make('phone')
                ->label('Telefon'),
            TextColumn::make('email')
                ->label('Email'),
            ToggleColumn::make('is_contacted')
                ->label('Bog\'lanildi'), 
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
