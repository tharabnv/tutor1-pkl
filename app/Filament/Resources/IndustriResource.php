<?php

namespace App\Filament\Resources;

use App\Filament\Resources\IndustriResource\Pages;
use App\Filament\Resources\IndustriResource\RelationManagers;
use App\Models\Industri;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Notifications\Notification; //import buat notifikasi kalo berhasil
use Filament\Tables\Actions\DeleteAction;

class IndustriResource extends Resource
{
    protected static ?string $model = Industri::class;

    protected static ?string $navigationIcon = 'heroicon-o-building-office';

    public static function form(Form $form): Form
{
    return $form
        ->schema([
            Forms\Components\TextInput::make('nama')
                ->label('Nama Industri')
                ->required()
                ->maxLength(255)
                // Pake unique built-in Laravel/Filament
                // ignoreRecord: true supaya saat edit data yang sama tidak kena validasi
                ->unique(table: Industri::class, column: 'nama', ignoreRecord: true),

            Forms\Components\TextInput::make('bidang_usaha')
                ->required()
                ->maxLength(255),

            Forms\Components\TextInput::make('alamat')
                ->required()
                ->maxLength(255),

            Forms\Components\TextInput::make('kontak')
                ->label('Kontak')
                ->required()
                ->maxLength(20),

            Forms\Components\TextInput::make('email')
                ->email()
                ->required()
                ->maxLength(255),

            Forms\Components\TextInput::make('website')
                ->label('Website')
                ->url()
                ->nullable()
                ->maxLength(255),
        ]);
}

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nama')
                    ->searchable(),
                Tables\Columns\TextColumn::make('bidang_usaha')
                    ->searchable(),
                Tables\Columns\TextColumn::make('alamat')
                    ->searchable(),
                Tables\Columns\TextColumn::make('kontak')
                    ->searchable(),
                Tables\Columns\TextColumn::make('email')
                    ->searchable(),
                Tables\Columns\TextColumn::make('website')
                    ->label('Website')
                    ->url(fn ($record) => $record->website, true) // bikin jadi link aktif
                    ->openUrlInNewTab() // buka tab baru
                    ->searchable()
                    ->formatStateUsing(fn ($state) => \Str::limit($state, 30)) // tampilkan max 30 karakter,
                    ->color('info') // ubah warna menjadi biru
                    ->wrap(), // biar nggak kepotong di satu baris
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make()
                ->before(function ($record, $action) {
                    if ($record->pkls()->exists()) {
                        Notification::make()
                            ->title('Gagal Menghapus')
                            ->body('Industri ini sudah digunakan dalam data PKL dan tidak bisa dihapus.')
                            ->danger()
                            ->persistent() // biar nggak hilang sendiri
                            ->send();

                        $action->cancel(); // hentikan proses delete tanpa error 500
                    }
                })
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageIndustris::route('/'),
        ];
    }
    
    //mengganti nama Industris, navigation di tampilan (sebelah kiri bawah dashboard)
    public static function getNavigationLabel(): string
    {
        return 'Data Industri'; // get navigation
    }

}
