<?php

namespace App\Filament\Resources\Causes\Schemas;

use AmidEsfahani\FilamentTinyEditor\TinyEditor;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class CauseForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            Section::make('Asosiy sarlavha')->schema([
                TinyEditor::make('title')->required(), 
            ])->columnSpanFull(),

            Section::make('1-Blok: Основное действие')->schema([
                TextInput::make('main_action_title')->required(),
                Repeater::make('main_actions')
                    ->schema([
                        TextInput::make('item')->required(),
                    ])->simple(TextInput::make('item')), 
            ]),

            Section::make('2-Blok: Markaziy qism')->schema([
                FileUpload::make('center_image')->image()->disk('public')->required(),
                Repeater::make('center_stats')
                    ->schema([
                        TextInput::make('label')->required(), 
                        TextInput::make('sub_label')->required(),
                    ])->grid(2)->maxItems(4),
            ]),

            Section::make('3-Blok: Состав')->schema([
                TextInput::make('composition_title')->required(),
                Repeater::make('composition_items')
                    ->schema([
                        TextInput::make('name')->required(), 
                        TextInput::make('desc')->required(), 
                    ]),
            ]),
        ]);
    }
}
