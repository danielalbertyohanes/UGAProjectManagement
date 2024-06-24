<?php

namespace App\Filament\Resources;


use App\Models\Ppt;
use Filament\Forms;
use App\Models\Ppts;
use Filament\Tables;
use Filament\Resources\Form;
use Filament\Resources\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Select;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\FileUpload;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\PPTResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\PPTResource\RelationManagers;

class PPTResource extends Resource
{
    protected static ?string $model = Ppt::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('panduan_ppt_path')
                    ->label('Panduan PPT')

                    ->required(),
                TextInput::make('template_ppt_overview_path')
                    ->label('Template PPT Overview')

                    ->required(),
                TextInput::make('template_ppt_materi_path')
                    ->label('Template PPT Materi')

                    ->required(),
                TextInput::make('contoh_ppt_materi_path')
                    ->label('Contoh PPT Materi')

                    ->required(),
                TextInput::make('uploaded_ppt_path')
                    ->label('Upload PPT')

                    ->nullable(),
                Select::make('jenis_ppt')
                    ->label('Jenis PPT')
                    ->options([
                        'overview' => 'PPT Overview Kursus',
                        'materi' => 'PPT Materi Kursus',
                    ])
                    ->required()
                    ->reactive()
                    ->afterStateUpdated(fn ($state, callable $set) => $state === 'materi' ? $set('kode_topik', '') : $set('kode_topik', null)),
                TextInput::make('kode_topik')
                    ->label('Kode Topik')
                    ->visible(fn ($get) => $get('jenis_ppt') === 'materi')
                    ->nullable(),
                TextInput::make('nama_topik')
                    ->label('Nama Topik')
                    ->visible(fn ($get) => $get('jenis_ppt') === 'materi')
                    ->nullable(),
                TextInput::make('kode_subtopik')
                    ->label('Kode Subtopik')
                    ->visible(fn ($get) => $get('jenis_ppt') === 'materi')
                    ->nullable(),
                TextInput::make('nama_subtopik')
                    ->label('Nama Subtopik')
                    ->visible(fn ($get) => $get('jenis_ppt') === 'materi')
                    ->nullable(),
                Select::make('status')
                    ->label('Status')
                    ->options([
                        'uploaded' => 'PPT has been successfully uploaded',
                        'reviewed' => 'RPP is reviewed by PIC',
                        'need_revision' => 'Need to be revised by contributors',
                        'passed_qc' => 'Passed Quality Control',
                    ])
                    ->default('uploaded'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')->sortable()->searchable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
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
            'index' => Pages\ListPPTS::route('/'),
            'create' => Pages\CreatePPT::route('/create'),
            'edit' => Pages\EditPPT::route('/{record}/edit'),
        ];
    }
}
