<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Topic;
use App\Models\Course;
use Filament\Resources\Form;
use Filament\Resources\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Select;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Filters\SelectFilter;
use App\Filament\Resources\TopicResource\Pages;

class TopicResource extends Resource
{
    protected static ?string $model = Topic::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('course_id')
                    ->label('Course')
                    ->options(Course::all()->pluck('name', 'id')->toArray())
                    ->required(),
                TextInput::make('panduan_rpp_path')
                    ->label('Panduan RPP')
                    ->required(),
                TextInput::make('template_rpp_path')
                    ->label('Template RPP')
                    ->required(),
                TextInput::make('uploaded_rpp_path')
                    ->label('Upload RPP')
                    ->nullable(),
                TextInput::make('jumlah_video')
                    ->label('Jumlah Video')
                    ->numeric()
                    ->nullable(),
                Select::make('status')
                    ->label('Status')
                    ->options([
                        'uploaded' => 'RPP has been successfully uploaded',
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
                TextColumn::make('course.name')->label('Course Name'),
                TextColumn::make('panduan_rpp_path')->label('Panduan RPP'),
                TextColumn::make('template_rpp_path')->label('Template RPP'),
                TextColumn::make('uploaded_rpp_path')->label('Uploaded RPP'),
                TextColumn::make('jumlah_video')->label('Jumlah Video'),
                BadgeColumn::make('status')->label('Status')
                    ->enum([
                        'uploaded' => 'Uploaded',
                        'reviewed' => 'Reviewed',
                        'need_revision' => 'Need Revision',
                        'passed_qc' => 'Passed Quality Control',
                    ]),
            ])
            ->filters([
                SelectFilter::make('status')
                    ->options([
                        'uploaded' => 'Uploaded',
                        'reviewed' => 'Reviewed',
                        'need_revision' => 'Need Revision',
                        'passed_qc' => 'Passed Quality Control',
                    ]),
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
            'index' => Pages\ListTopics::route('/'),
            'create' => Pages\CreateTopic::route('/create'),
            'edit' => Pages\EditTopic::route('/{record}/edit'),
        ];
    }
}
