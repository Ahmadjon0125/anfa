<?php

namespace App\Filament\Resources\Consultations\Schemas;

use AmidEsfahani\FilamentTinyEditor\TinyEditor;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class ConsultationForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            Section::make('Chap tomon (Matnlar)')->schema([
                TextInput::make('badge')->label('Kichik matn'),
                TinyEditor::make('title')->label('Asosiy sarlavha')->required(),
                Textarea::make('description')->label('Tavsif')->rows(3),
                FileUpload::make('image_path')->label('Rasm')->image()->disk('public'),
            ])->columnSpanFull(),

            Section::make('O\'ng tomon (Forma matnlari)')->schema([
                TextInput::make('form_title')->label('Forma sarlavhasi')->required(),
                TextArea::make('form_subtitle')->label('Forma kichik matni')->required(),
                TextInput::make('form_text')->label('Kichik text')->required(),
            ])->columnSpanFull(),
        ]);
    }
}
