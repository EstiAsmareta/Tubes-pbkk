<?php

namespace App\Filament\Resources;

use App\Filament\Resources\KaryawanResource\Pages;
use App\Filament\Resources\KaryawanResource\RelationManagers;
use App\Models\Karyawan;
use App\Models\Wahana;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Tables\Actions\Action;

class KaryawanResource extends Resource
{
    protected static ?string $model = Karyawan::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-group';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('id')
                ->placeholder('NKW001')
                ->label('ID Karyawan'),
                TextInput::make('nama')
                ->placeholder('Nama Karyawan'),
                TextInput::make('alamat')
                ->placeholder('Alamat Karyawan'),
                DatePicker::make('tgl_lahir')
                ->beforeOrEqual('today')
                ->label('Tanggal Lahir'),
                TextInput::make('jabatan')
                ->placeholder('Jabatan Keryawan'),
                Select::make('wahana_id')
                ->relationship('Wahana', 'nama')
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')
                ->label('ID Karyawan')
                ->sortable()
                ->searchable(),
                TextColumn::make('nama')
                ->sortable()
                ->searchable(),
                TextColumn::make('alamat'),
                TextColumn::make('tgl_lahir')
                ->sortable()
                ->label('Tanggal Lahir'),
                TextColumn::make('jabatan')
                ->sortable()
                ->searchable()
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

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListKaryawans::route('/'),
            'create' => Pages\CreateKaryawan::route('/create'),
            'edit' => Pages\EditKaryawan::route('/{record}/edit'),
        ];
    }
}
