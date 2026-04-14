<?php

namespace App\Filament\Resources\Consultations\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class ConsultationsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
               TextColumn::make('badge')
                ->label('Badge')
                ->searchable()
                ->toggleable(),


            TextColumn::make('title')
                ->label('Asosiy sarlavha')
                ->html()
                ->limit(50)
                ->searchable(),

  
            ImageColumn::make('image_path')
                ->label('Rasm')
                ->disk('public'),

    
            TextColumn::make('form_title')
                ->label('Forma sarlavhasi')
                ->limit(30),

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
