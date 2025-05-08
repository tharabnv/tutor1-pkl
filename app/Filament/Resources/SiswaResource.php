<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SiswaResource\Pages;
use App\Filament\Resources\SiswaResource\RelationManagers;
use App\Models\Siswa;
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
use App\Imports\SiswaImport; //import dari guru import
use Illuminate\Support\Facades\Storage;
use Filament\Notifications\Notification; //import buat notifikasi kalo berhasil

class SiswaResource extends Resource
{
    protected static ?string $model = Siswa::class;

    protected static ?string $navigationIcon = 'heroicon-o-academic-cap';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('nama')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('nis')
                    ->required()
                    ->maxLength(255),
                    Forms\Components\Select::make('gender')
                    ->required()
                    ->options([
                        'L' => 'Laki-laki',
                        'P' => 'Perempuan',
                    ]),
                Forms\Components\TextInput::make('alamat')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('kontak')
                    ->required()
                    ->maxLength(20) // batas input total karakter
                    ->rule('regex:/^[0-9()+-]+$/') // hanya angka, kurung, plus dan minus
                    ->rule('regex:/[0-9]{10,15}/') // minimal 10 dan maksimal 15 digit angka
                    ->label('Kontak'),  
                Forms\Components\TextInput::make('email')
                    ->email()
                    ->required()
                    ->maxLength(255),
                // Forms\Components\Toggle::make('status_pkl')
                //     ->required(),
                Forms\Components\FileUpload::make('foto')
                    ->image()
                    ->directory('fotosiswa') // folder di storage/app/public/fotosiswa
                    ->imagePreviewHeight('150')
                    ->loadingIndicatorPosition('left')
                    ->uploadProgressIndicatorPosition('left')
                    ->removeUploadedFileButtonPosition('right')
                    ->downloadable()
                    ->openable()
                    ->required(false),                
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nama')
                    ->searchable(),
                Tables\Columns\TextColumn::make('nis')
                    ->searchable(),
                Tables\Columns\TextColumn::make('gender'),
                Tables\Columns\TextColumn::make('alamat')
                    ->searchable(),
                Tables\Columns\TextColumn::make('kontak')
                    ->searchable(),
                Tables\Columns\TextColumn::make('email')
                    ->searchable(),
                Tables\Columns\IconColumn::make('status_pkl')
                    ->boolean(),
                Tables\Columns\ImageColumn::make('foto')
                    ->disk('public') //menyimpan sesuai dengan storage:link di disk publik
                    ->height(50) //menampilkan gambar dengan tinggi 50 piksel
                    ->circular()               
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
                        Excel::import(new SiswaImport, $filePath);
                        Storage::disk('public')->delete($data['file']);

                        Notification::make()
                            ->title('Data siswa berhasil diimpor!')
                            ->success()
                            ->send();
                    }),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageSiswas::route('/'),
        ];
    }
    
    //mengganti nama navigation di tampilan (sebelah kiri bawah dashboard)
    public static function getNavigationLabel(): string
    {
        return 'Data Siswa'; // get navigation
    }
}
