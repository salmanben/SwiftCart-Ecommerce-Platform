<?php

namespace App\DataTables;

use App\Models\FlashSaleItem;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class FlashSaleItemDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
        ->addColumn('action', function($query)
        {
            $delete = '<a onclick="delete_row(event)" href="'.route("admin.flash_sale.destroy",$query->id).'"  id="' . $query->id . '" style="margin-left:20px;"
            class="btn btn-danger delete-item " ><i class="fa-solid fa-trash " ></i></a>';
            return $delete;
        })
        ->addColumn('product', function($query)
        {
            return '<a href="'.route('admin.product.edit', $query->product->id).'">'.$query->product->name.'</a>';
        })
        ->addColumn('show_at_home', function($query)
        {
            if ($query->show_at_home)
                return '<label style="cursor-pointer" class="custom-switch ">
                <input onclick= "switch_show_home(event)"  class="custom-switch-input show-at-home" id="'.$query->id.'" checked type="checkbox" value="" id="defaultCheck1">
                <span class="custom-switch-indicator"></span>
                </label>';
            else
                return '<label class="custom-switch">
                <input onclick= "switch_show_home(event)" style="cursor-pointer" class="custom-switch-input show-at-home" id="'.$query->id.'" type="checkbox" value="" id="defaultCheck1">
                <span class="custom-switch-indicator"></span>
                </label>';
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
        ->rawColumns(['product', 'show_at_home', 'status', 'action']);
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(FlashSaleItem $model): QueryBuilder
    {
        return $model->whereHas('product', function ($query) {
            $query->where('status', 1)
                ->where('is_approved', 1)
                ->where('quantity', '>', 0);
        })->newQuery();
    }


    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('flashsaleitem-table')
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
            Column::make('product')->addClass('text-center'),
            Column::make('show_at_home')->addClass('text-center'),
            Column::make('status')->addClass('text-center'),
            Column::make('action')->addClass('text-center'),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'FlashSaleItem_' . date('YmdHis');
    }
}
