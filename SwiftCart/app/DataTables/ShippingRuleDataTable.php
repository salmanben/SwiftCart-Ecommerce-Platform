<?php

namespace App\DataTables;

use App\Models\ShippingRule;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;
use App\Models\GeneralSetting;
class ShippingRuleDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    protected $currency_icon = '';
    public function __construct()
    {
        $this->currency_icon = GeneralSetting::first()->currency_icon;
    }
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('action', 'shippingrule.action')
            ->addColumn('action', function($query)
            {
                $edit = '<a href="'.route("admin.shipping_rule.edit",$query->id).'" class="btn btn-primary mb-1"><i class="fa-solid fa-pen-to-square"></i></a>';
                $delete = '<a onclick="delete_row(event)" href="'.route("admin.shipping_rule.destroy",$query->id).'" id="' . $query->id . '"
                class="btn btn-danger delete-item mb-1"><i class="fa-solid fa-trash"></i></a>';
                return $edit." ".$delete;
            })
            ->addColumn('status', function($query)
            {
                if ($query->status)
                    return '<label style="cursor-pointer" class="custom-switch ">
                    <input  class="custom-switch-input switch-status"  onclick="switch_status(event)" id="'.$query->id.'" checked type="checkbox" value="" id="defaultCheck1">
                    <span class="custom-switch-indicator"></span>
                    </label>';
                else
                    return '<label class="custom-switch">
                    <input style="cursor-pointer" onclick="switch_status(event)" class="custom-switch-input switch-status" id="'.$query->id.'" type="checkbox" value="" id="defaultCheck1">
                    <span class="custom-switch-indicator"></span>
                    </label>';
            })
            ->addColumn('type', function($query){

                if ($query->type == 'min_cost')
                {
                    return "<p><span class='badge bg-success'>".$query->type."</span></p>";
                }
                else
                {
                    return "<p><span class='badge bg-primary'>".$query->type."</span></p>";
                }
            })
            ->addColumn('cost', function($query){
                  return $this->currency_icon.$query->cost;
            })
            ->addColumn('min_cost', function($query){
                if ($query->min_cost)
                    return $this->currency_icon.$query->min_cost;
                else
                    return "$0";
          })
            ->rawColumns(['action', 'cost', 'min_cost', 'type', 'status'])
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(ShippingRule $model): QueryBuilder
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('shippingrule-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    //->dom('Bfrtip')
                    ->orderBy(0)
                    ->selectStyleSingle()
                    ->buttons([
                        Button::make('excel'),
                        Button::make('csv'),
                        Button::make('pdf'),
                        Button::make('print'),
                        Button::make('reset'),
                        Button::make('reload')
                    ]);
    }

    /**
     * Get the dataTable columns definition.
     */
    public function getColumns(): array
    {
        return [
            Column::make('id')->addClass('text-center'),
            Column::make('name')->addClass('text-center'),
            Column::make('cost')->addClass('text-center'),
            Column::make('type')->addClass('text-center'),
            Column::make('min_cost')->addClass('text-center'),
            Column::make('status')->addClass('text-center'),
            Column::computed('action')
                  ->addClass('text-center'),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'ShippingRule_' . date('YmdHis');
    }
}
