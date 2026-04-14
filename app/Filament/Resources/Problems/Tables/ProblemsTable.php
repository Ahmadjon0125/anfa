<?php

namespace App\Filament\Resources\Problems\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class ProblemsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                  
                ImageColumn::make('image_path')
                    ->disk('public')
                    ->label('Image'),
                TextColumn::make('title')
                    ->searchable(),
                TextColumn::make('description')
                    ->label('Description'),
             
           
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
