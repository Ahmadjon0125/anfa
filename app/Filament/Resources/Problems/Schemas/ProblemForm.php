<?php

namespace App\Filament\Resources\Problems\Schemas;

use AmidEsfahani\FilamentTinyEditor\TinyEditor;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class ProblemForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Asosiy Sarlavha va Tavsif')
                    ->columnSpanFull()
                    ->schema([
                        TinyEditor::make('title')
                            ->label('Sarlavha')
                            ->required()
                            ->helperText('Masalan: Верни контроль над своим <span class="gradient-text">мышлением</span>'),

                        Textarea::make('description')
                            ->label('Tavsif matni')
                            ->rows(3),

                        FileUpload::make('image_path')
                            ->label('Asosiy rasm ')
                            ->image()
                            ->disk('public')
                            ->required(),
                    ]),

                Section::make('Muammolar ro\'yxati')
                    ->description('O\'ng tomondagi 3 ta blok')
                    ->schema([
                        Repeater::make('problems')
                            ->label('Muammo elementlari')
                            ->schema([
                                FileUpload::make('icon')
                                    ->label('Lucide Icon nomi')
                                    ->image()
                                    ->disk('public')
                                    ->required(),

                                TextInput::make('title')
                                    ->label('Kichik sarlavha')
                                    ->required(),

                                Textarea::make('text')
                                    ->label('Batafsil matn')
                                    ->required(),
                            ])
                            ->columns(1),
                    ]),
            ]);
    }
}
