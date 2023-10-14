<?php

namespace App\Http\Livewire;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\Views\Columns\BooleanColumn;
use Rappasoft\LaravelLivewireTables\Views\Columns\ButtonGroupColumn;
use Rappasoft\LaravelLivewireTables\Views\Columns\LinkColumn;
use Illuminate\Database\Eloquent\Builder;
use App\Models\Affiliate;
use App\Models\RelSponsor;

class WalletWeekListTable extends DataTableComponent
{
    // protected $model = Affiliate::class;


    public function configure(): void
    {
        $this->setPrimaryKey('id');
    }
    
    public function columns(): array
    {
            return [
                Column::make("Id", "idAffiliated")
                    ->sortable()
                    ->searchable(),
                Column::make("Name", "Name")
                    ->sortable()
                    ->searchable(),
                Column::make("LastName", "LastName")
                    ->sortable()
                    ->searchable(),
                Column::make("UserName", "user.userName")
                    ->sortable()
                    ->searchable(),
                Column::make("Email", "Email")
                    ->sortable()
                    ->searchable(),
                BooleanColumn::make("Active", "user.active")
                    ->sortable(),
                ButtonGroupColumn::make('Acciones')
                    ->attributes(function($row){
                        return [
                            'class' => 'space-x-2',
                        ];
                    })
                    ->buttons([
                        LinkColumn::make('View')
                            ->title(fn($row) => 'Pagos')
                            ->location(fn($row) =>  route('walletWeekDataUser', $row->idAffiliated))
                            ->attributes(function($row){
                                return [
                                    'class' => 'px-3 py-2 btn bg-green-600 hover:btn h-12 w-32 bg-green-700 rounded-lg text-white opacity-100',
                                ];
                            })
                        ]),
            ];
        
    }

    public function builder(): Builder
    {
        
        return Affiliate::query()
        ->whereHas('user',function($query){
            $query->where('active', 1);
        })
        ->with('rank');
   
    }

}
