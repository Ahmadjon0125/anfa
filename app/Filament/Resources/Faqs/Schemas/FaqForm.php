<?php

namespace App\Filament\Resources\Faqs\Schemas;

use AmidEsfahani\FilamentTinyEditor\TinyEditor;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class FaqForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            Section::make('Sarlavhalar')->schema([
                TextInput::make('badge')
                    ->label('Kichik matn (Badge)')
                    ->placeholder('ПОДДЕРЖКА'),

             
                TinyEditor::make('title')
                    ->label('Asosiy sarlavha')
                    ->required(),

                Textarea::make('description')
                    ->label('Tavsif matni')
                    ->rows(2),
            ]) ->columnSpanFull(),

            Section::make('Savol-Javoblar')->schema([
                Repeater::make('questions')
                    ->label('Savollar ro\'yxati')
                    ->schema([
                        TextInput::make('question')
                            ->label('Savol')
                            ->required(),
                        Textarea::make('answer')
                            ->label('Javob')
                            ->required()
                            ->rows(3),
                    ])
                    ->itemLabel(fn(array $state): ?string => $state['question'] ?? null) 
                    ->collapsible()
                    ,
            ])->columnSpanFull(),
        ]);
    }
}
