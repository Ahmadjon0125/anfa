<?php

namespace App\Filament\Resources\Infos\Schemas;

use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class InfoForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            Section::make('Kompaniya haqida')->schema([
                Textarea::make('about_text')
                    ->label('Logo ostidagi matn')
                    ->rows(2),
            ]),

            Section::make('Ijtimoiy tarmoqlar (Linklar)')->schema([
                TextInput::make('instagram'),
                TextInput::make('facebook'),
                TextInput::make('telegram'),
                TextInput::make('linkedin'),
            ])->columns(2),

            Section::make('Kontakt ma\'lumotlari')->schema([
                TextInput::make('phone')->label('Telefon raqami')->required(),
                TextInput::make('address')->label('Manzil')->required(),
                TextInput::make('email')->label('Email manzili')->email()->required(),
                TextInput::make('work_hours')->label('Ish vaqti')->required(),
            ])->columns(2),
        ]);
    }
}
