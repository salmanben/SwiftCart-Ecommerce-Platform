<?php

namespace App\DataTables;

use App\Models\GeneralSetting;
use App\Models\ProductVariantItem;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class VendorProductVariantItemDataTable  extends DataTable
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
            $edit = '<a href="'.route("vendor.product_variant_item.edit",$query->id).'" class="btn btn-primary mb-1"><i class="fa-solid fa-pen-to-square"></i></a>';
            $delete = '<a onclick="delete_row(event)" href="'.route("vendor.product_variant_item.destroy",$query->id).'" id="' . $query->id . '"
            class="btn btn-danger mb-1 delete-item"><i class="fa-solid fa-trash"></i></a>';
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
        ->addColumn('is_default', function($query)
        {

            if ($query->is_default)
                return "<p><span class='badge bg-success text-white'>Yes</span></p>";
            else
                return "<p><span class='badge bg-danger text-white'>No</span></p>";
        })
        ->addColumn('variant_name', function($query)
        {

            return $query->product_variant->name;
        })
        ->addColumn('price', function($query)
        {
            $setting = GeneralSetting::first();
            if ($setting == null)
               $currency_icon = '$';
            else
               $currency_icon = $setting->currency_icon;

            return $currency_icon. $query->price;
        })
        ->rawColumns(['action', 'is_default', 'status', 'price'])
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(ProductVariantItem $model): QueryBuilder
    {
        return $model->where('product_variant_id', request()->variant_id)->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('productvariantitem-table')
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
            Column::make('variant_name')->addClass('text-center'),
            Column::make('price')->addClass('text-center'),
            Column::make('is_default')->addClass('text-center'),
            Column::make('status')->addClass('text-center'),
            Column::make('action')->addClass('text-center'),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'VendorProductVariantItem_' . date('YmdHis');
    }
}
