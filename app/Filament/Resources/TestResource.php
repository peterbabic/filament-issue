<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TestResource\Pages;
use App\Models\Test;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class TestResource extends Resource {
  protected static ?string $model = Test::class;

  protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

  public static function form(Form $form): Form {
    return $form->schema([
      Forms\Components\TextInput::make('make')->required()->maxLength(255),
    ]);
  }

  public static function table(Table $table): Table {
    return $table
      ->columns([
        Tables\Columns\TextColumn::make('make')->searchable(),
      ])
      ->filters([
        //
      ])
      ->actions([
        Tables\Actions\EditAction::make(),
        Tables\Actions\DeleteAction::make(),
      ])
      ->bulkActions([
        Tables\Actions\BulkActionGroup::make([
          Tables\Actions\DeleteBulkAction::make(),
        ]),
      ]);
  }

  public static function getPages(): array {
    return [
      'index' => Pages\ListTests::route('/'),
      'create' => Pages\CreateTest::route('/create'),
      'edit' => Pages\EditTest::route('/{record}/edit'),
    ];
  }
}
