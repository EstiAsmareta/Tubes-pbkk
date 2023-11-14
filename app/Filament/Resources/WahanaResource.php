<?php

namespace App\Filament\Resources;

use App\Filament\Resources\WahanaResource\Pages;
use App\Filament\Resources\WahanaResource\RelationManagers;
use App\Models\Wahana;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\Section;
use Filament\Tables\Actions\Action;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\SelectFilter;

class WahanaResource extends Resource
{
    protected static ?string $model = Wahana::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make()
                ->schema([
                    TextInput::make('id')
                    ->label('ID Wahana')
                    ->placeholder('WHN001'),
                    TextInput::make('nama')
                    ->label('Nama Wahana')
                    ->placeholder('Nama Wahana'),
                    DatePicker::make('tgl_dibuka')
                    ->label('Tanggal Dibuka')
                    ->beforeOrEqual('today'),
                    TextInput::make('luas_area')
                    ->label('Luas Area (m)')
                    ->placeholder('Luas'),
                    Select::make('neverland_id')
                    ->label('Taman Hiburan')
                    ->relationship('Neverland', 'nama'),
                    Select::make('kategori')
                    ->options([
                        'dewasa' => 'Dewasa',
                        'keluarga' => 'Keluarga',
                        'alam' => 'Alam',
                        'anak_anak' => 'Anak-anak',
                            ])
                    ->native(false)
                    ->label('Kategori Wahana'),
                ])
                ->columns(2),
                RichEditor::make('deskripsi'),
                FileUpload::make('gambar')
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
                ->searchable()
                ->sortable(),
                TextColumn::make('tgl_dibuka')
                ->sortable(),
                TextColumn::make('luas_area')
                ->sortable()
                ->numeric(),
                TextColumn::make('Neverland.nama'),
                // TextColumn::make('deskripsi'),
                TextColumn::make('kategori'),
                ImageColumn::make('gambar')
                    ->square()
            ])
            ->filters([
                SelectFilter::make('kategori')
                ->options([
                    'dewasa' => 'Wahana Dewasa',
                    'anak_anak' => 'Wahana Anak',
                    'keluarga' => 'Wahana Keluarga',
                    'alam' => 'Wahana Alam',
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
            'index' => Pages\ListWahanas::route('/'),
            'create' => Pages\CreateWahana::route('/create'),
            'edit' => Pages\EditWahana::route('/{record}/edit'),
        ];
    }
}
