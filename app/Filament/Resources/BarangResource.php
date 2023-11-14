<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BarangResource\Pages;
use App\Filament\Resources\BarangResource\RelationManagers;
use App\Models\Barang;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Radio;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class BarangResource extends Resource
{
    protected static ?string $model = Barang::class;

    protected static ?string $navigationIcon = 'heroicon-o-inbox-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make()
                ->schema([
                    TextInput::make('nama')
                    ->label('Nama Barang')
                    ->placeholder('nama barang'),
                    TextInput::make('jumlah')
                    ->label('Jumlah Barang')
                    ->placeholder('1xx')
                    ->numeric(),
                    DatePicker::make('tgl_awal')
                    ->beforeOrEqual('today'),
                    Select::make('wahana_id')
                    ->label('Nama Wahana')
                    ->relationship('Wahana', 'nama'),
                    Radio::make('kondisi')
                    ->label('Kondisi')
                    ->boolean('baik', 'rusak')
                    ->inline()
                ])->columnSpan(1)
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')
                ->searchable()
                ->sortable(),
                TextColumn::make('nama')
                ->label('Nama Barang')
                ->searchable()
                ->sortable(),
                TextColumn::make('jumlah'),
                TextColumn::make('tgl_awal')
                ->label('Tanggal Masuk')
                ->sortable(),
                TextColumn::make('wahana_id')
                ->label('Wahana')
                ->searchable(),
                IconColumn::make('kondisi')
                ->boolean()
                ->label('Kondisi')
            ])
            ->filters([
                SelectFilter::make('Kondisi')
                ->options([
                    '1' => 'Baik',
                    '0' => 'Rusak',
                ])
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
            'index' => Pages\ListBarangs::route('/'),
            'create' => Pages\CreateBarang::route('/create'),
            'edit' => Pages\EditBarang::route('/{record}/edit'),
        ];
    }
}
