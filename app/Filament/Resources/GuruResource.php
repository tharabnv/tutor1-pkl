<?php

namespace App\Filament\Resources;

use App\Filament\Resources\GuruResource\Pages;
use App\Filament\Resources\GuruResource\RelationManagers;
use App\Models\Guru;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Tables\Actions\Action;
use Filament\Forms\Components\FileUpload;
use Maatwebsite\Excel\Facades\Excel; //untuk import excel
use App\Imports\GuruImport; //import dari guru import
use Illuminate\Support\Facades\Storage;
use Filament\Notifications\Notification; //import buat notifikasi kalo berhasil

class GuruResource extends Resource
{
    protected static ?string $model = Guru::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-group';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('nama')
                    ->required()
                    ->placeholder('Contoh: Jason Statham')
                    ->maxLength(255),

                Forms\Components\TextInput::make('nip')
                    ->required()
                    ->unique(ignoreRecord: true)
                    ->placeholder('Masukkan NIP guru')
                    ->maxLength(255),

                Forms\Components\Select::make('gender')
                    ->required()
                    ->options([
                        'L' => 'Laki-laki',
                        'P' => 'Perempuan',
                    ]),

                Forms\Components\TextInput::make('alamat')
                    ->required()
                    ->placeholder('Contoh: Jalan Alpukat No. 54')
                    ->maxLength(255),

                Forms\Components\TextInput::make('kontak')
                    ->required()
                    ->maxLength(20) // batas input total karakter
                    ->placeholder('Contoh: 81234567890') // placeholder saat input
                    ->helperText('Masukkan nomor tanpa 0 di depan.')
                    ->rule('regex:/^[0-9()+-]+$/') // hanya angka, kurung, plus dan minus
                    ->rule('regex:/[0-9]{10,15}/') // minimal 10 dan maksimal 15 digit angka
                    ->label('Kontak')
                    ->prefix('+62') // tampilan form
                    ->dehydrateStateUsing(function ($state) {
                        return '+62' . ltrim($state, '0');
                    }),      

                Forms\Components\TextInput::make('email')
                    ->required()
                    ->email()
                    ->maxLength(255)
                    ->rule('regex:/^[\w.+-]+@gurusija\.com$/') // hanya email @gurusija.com
                    ->label('Email (@gurusija.com)')
                    ->helperText('Hanya gunakan email @gurusija.com'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->defaultSort('created_at', 'desc')
            ->columns([
                Tables\Columns\TextColumn::make('nama')
                    ->searchable(),

                Tables\Columns\TextColumn::make('nip')
                    ->searchable(),
                
                Tables\Columns\TextColumn::make('gender'),
                
                Tables\Columns\TextColumn::make('alamat')
                    ->searchable(),
                
                Tables\Columns\TextColumn::make('kontak')
                    ->searchable(),
                
                Tables\Columns\TextColumn::make('email')
                    ->searchable(),
                
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
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->headerActions([
                Action::make('Import CSV')
                    ->label('Import CSV')
                    ->form([
                        FileUpload::make('file')
                            ->label('Pilih CSV')
                            ->acceptedFileTypes(['text/csv', 'text/plain', 'application/vnd.ms-excel'])
                            ->disk('public')
                            ->directory('uploads')
                            ->required(),
                    ])
                    ->action(function (array $data) {
                        $filePath = storage_path('app/public/' . $data['file']);
                        Excel::import(new GuruImport, $filePath);
                        Storage::disk('public')->delete($data['file']);

                        Notification::make()
                            ->title('Data guru berhasil diimpor!')
                            ->success()
                            ->send();
                    }),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageGurus::route('/'),
        ];
    }
    
    //mengganti nama navigation di tampilan (sebelah kiri bawah dashboard)
    public static function getNavigationLabel(): string
    {
        return 'Data Guru'; // get navigation
    }

    public static function getNavigationBadge(): ?string
    {
        return (string) Guru::count();
    }

    public static function getNavigationBadgeColor(): ?string
    {
        return 'info'; // bisa 'success', 'warning', 'danger', dll
    }
}
