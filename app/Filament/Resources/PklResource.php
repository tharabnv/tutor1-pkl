<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PklResource\Pages;
use App\Filament\Resources\PklResource\RelationManagers;
use App\Models\Pkl;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Exports\PklExport;
use Maatwebsite\Excel\Facades\Excel;
use Filament\Tables\Actions\Action;
use Filament\Forms\Get;
use Filament\Forms\Set;

class PklResource extends Resource
{
    protected static ?string $model = Pkl::class;

    protected static ?string $navigationIcon = 'heroicon-o-briefcase';

    public static function form(Form $form): Form
{
    return $form
        ->schema([
            Forms\Components\Select::make('siswa_id')
                ->label('Siswa')
                ->relationship('siswa', 'nama')
                ->searchable()
                ->preload()
                ->required()
                ->unique(ignoreRecord: true),

            Forms\Components\Select::make('industri_id')
                ->relationship('industri', 'nama')
                ->searchable()
                ->preload()
                ->required(),

            Forms\Components\Select::make('guru_id')
                ->relationship('guru', 'nama')
                ->required(),

            Forms\Components\DatePicker::make('mulai')
                ->required(),

            Forms\Components\DatePicker::make('selesai')
                ->required()
                ->after('mulai')
                ->rules([
                    function (Get $get) {
                        return function (string $attribute, $value, \Closure $fail) use ($get) {
                            $mulai = $get('mulai');
                            $selesai = $value;

                            if ($mulai && $selesai) {
                                $start = \Carbon\Carbon::parse($mulai);
                                $end = \Carbon\Carbon::parse($selesai);
                                $durasi = $start->diffInDays($end);

                                if ($durasi < 90) {
                                    $fail('Durasi PKL minimal 90 hari. Saat ini hanya '.$durasi.' hari.');
                                }
                            }
                        };
                    }
                ]),
        ]);
}

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('siswa.nama')
                    ->numeric()
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('industri.nama')
                    ->numeric()
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('guru.nama')
                    ->label('Guru Pembimbing')
                    ->sortable()
                    ->searchable()
                    ->placeholder('Belum ditentukan'),
                Tables\Columns\TextColumn::make('mulai')
                    ->date()
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('selesai')
                    ->date()
                    ->sortable()
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
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManagePkls::route('/'),
        ];
    }
    
    //mengganti nama navigation di tampilan (sebelah kiri bawah dashboard)
    public static function getNavigationLabel(): string
    {
        return 'Data PKL'; // get navigation
    }
}
