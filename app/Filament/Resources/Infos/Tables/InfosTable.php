<?php

namespace App\Filament\Resources\Infos\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class InfosTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('phone')
                ->label('Telefon')
                ->icon('heroicon-m-phone')
                ->copyable()
                ->searchable(),


            TextColumn::make('email')
                ->label('Email')
                ->icon('heroicon-m-envelope')
                ->searchable(),


            TextColumn::make('address')
                ->label('Manzil')
                ->limit(30)
                ->toggleable(),

    
            TextColumn::make('telegram')
                ->label('TG')
                ->formatStateUsing(fn ($state) => $state ? '✅' : '❌')
                ->alignCenter(),

            TextColumn::make('instagram')
                ->label('Insta')
                ->formatStateUsing(fn ($state) => $state ? '✅' : '❌')
                ->alignCenter(),

            TextColumn::make('updated_at')
                ->label('Oxirgi yangilanish')
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
