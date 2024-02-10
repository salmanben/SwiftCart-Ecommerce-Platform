<?php

namespace App\DataTables;

use App\Models\ProductVariant;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class ProductVariantDataTable extends DataTable
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
            $edit = '<a href="'.route("admin.product_variant.edit",$query->id).'" class="btn btn-primary mb-1"><i class="fa-solid fa-pen-to-square"></i></a>';
            $delete = '<a onclick="delete_row(event)" href="'.route("admin.product_variant.destroy",$query->id).'" id="' . $query->id . '"
            class="btn btn-danger mb-1 delete-item"><i class="fa-solid fa-trash"></i></a>';
            $variant_items = '<a
            href="'.route('admin.product_variant_item.index', ['variant_id'=>$query->id]).'" id="' . $query->id . '"
            class="btn btn-info mb-1"><i class="fa-solid fa-square-arrow-up-right me-1"></i>Variant Items</i></a>';
            return $variant_items." ".$edit." ".$delete;
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
        ->rawColumns(['action', 'status'])
        ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(ProductVariant $model): QueryBuilder
    {
        return $model->where('product_id', request()->id)->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('productvariant-table')
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
            Column::make('status')->addClass('text-center'),
            Column::computed('action')
                  ->addClass('text-center')
                  ->width(300)
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'ProductVariant_' . date('YmdHis');
    }
}
