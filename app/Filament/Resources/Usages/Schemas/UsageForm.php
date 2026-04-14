<?php

namespace App\Filament\Resources\Usages\Schemas;

use AmidEsfahani\FilamentTinyEditor\TinyEditor;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class UsageForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            Section::make('Sarlavhalar')->schema([
                TinyEditor::make('title')
                    ->label('Asosiy sarlavha')
                    ->required(),
                TextInput::make('subtitle')
                    ->label('Kichik sarlavha (Sub-header)')
                    ->required(),
            ])->columnSpanFull(),

            Section::make('Qo\'llash usullari (Kartochkalar)')->schema([
                Repeater::make('cards')
                    ->label('Kartochkalar ro\'yxati')
                    ->schema([
                        FileUpload::make('image')
                            ->label('Orqa fon rasmi')
                            ->image()
                            ->disk('public')
                            ->required(),
                        TextInput::make('badge')
                            ->label('Tepadagi yozuv (Badge)')
                            ->placeholder('Утро, Вечер, Полный курс')
                            ->required(),
                        TextInput::make('title')
                            ->label('Kartochka sarlavhasi')
                            ->required(),
                        Textarea::make('description')
                            ->label('Qisqa matn')
                            ->required(),
                    ]),
            ])->columnSpanFull(),
        ]);
    }
}
