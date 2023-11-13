<?php

namespace App\Filament\Resources;

use App\Filament\Resources\NeverlandResource\Pages;
use App\Filament\Resources\NeverlandResource\RelationManagers;
use App\Models\Neverland;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class NeverlandResource extends Resource
{
    protected static ?string $model = Neverland::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('nama'),
                TextInput::make('lokasi'),
                TextInput::make('pemilik'),
                DatePicker::make('tgl_berdiri')->format('Y/m/d'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('nama'),
                TextColumn::make('lokasi'),
                TextColumn::make('pemilik'),
                TextColumn::make('tgl_berdiri'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListNeverlands::route('/'),
            'create' => Pages\CreateNeverland::route('/create'),
            'edit' => Pages\EditNeverland::route('/{record}/edit'),
        ];
    }
}
