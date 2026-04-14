<?php

namespace App\Filament\Resources\Products\Schemas;

use AmidEsfahani\FilamentTinyEditor\TinyEditor;
use Filament\Schemas\Schema;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;

// use Filament\Forms\Components\Section;

class ProductForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Main Content')
                    ->columnSpanFull()
                    ->schema([
                        TextInput::make('subtitle')
                            ->label('Subtitle (Top Text)')
                            ->placeholder('e.g. KOGNITIV KOMPLEKS')
                            ->maxLength(255),
                        TinyEditor::make('title')
                            ->required(),
                        TinyEditor::make('description')
                            ->required(),
                        FileUpload::make('image_path')
                            ->label('Product Image')
                            ->image()
                            ->disk('public')
                            ->required(),
                    ]),

                Section::make('Specifications')
                    ->schema([
                        TextInput::make('absorption_rate')
                            ->label('Absorption Rate'),
                        TextInput::make('course_duration')
                            ->label('Course Duration'),
                        TextInput::make('capsule_count')
                            ->label('Capsule Count')
                            ->numeric(),
                    ])->columns(3),

                Section::make('Action Links')
                    ->description('Set the destinations for the landing page buttons.')
                    ->schema([
                        Grid::make(2)->schema([
                            TextInput::make('primary_link')
                                ->label('Start Course Link (Black button)')
                                ->url()
                                ->placeholder('https://...'),

                            TextInput::make('secondary_link')
                                ->label('View Ingredients Link (White button)')
                                ->url()
                                ->placeholder('https://...'),
                        ]),
                    ]),

                Section::make('SEO Sozlamalari')
                    ->description('Google va ijtimoiy tarmoqlar uchun ma’lumotlar')
                    ->collapsible()
                    ->collapsed()
                    ->schema([
                        TextInput::make('seo_title')
                            ->label('Meta Sarlavha')
                            ->helperText('Google qidiruvida chiqadigan ko‘k rangli sarlavha.'),
                        Textarea::make('seo_description')
                            ->label('Meta Tavsif')
                            ->rows(3)
                            ->helperText('Sayt haqida qisqacha ma’lumot (maksimum 160 belgi tavsiya etiladi).'),
                    ]),
            ]);
    }
}
