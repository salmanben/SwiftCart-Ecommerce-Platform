<?php

namespace App\DataTables;

use App\Models\GeneralSetting;
use App\Models\Product;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class VendorProductDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('image', function($query)
            {
                return "<img width=100 src='".asset("storage/upload/".$query->image)."' >";
            })
            ->addColumn('product_type', function($query)
            {
                switch($query->product_type){
                    case 'New Arrival': return "<p><span class='badge bg-success text-white'>".$query->product_type."</span></p>";
                    break;
                    case 'Featured': return "<p><span class='badge bg-info text-white'>".$query->product_type."</span></p>";
                    break;
                    case 'Top Product': return "<p><span class='badge bg-primary text-white'>".$query->product_type."</span></p>";
                    break;
                    case 'Best Product': return "<p><span class='badge bg-warning text-white'>".$query->product_type."</span></p>";
                    break;
                }
            })
            ->addColumn('is_approved', function($query)
            {
                if ($query->is_approved)
                    return "<p><span class='badge bg-success text-white'>Yes</span></p>";
                else
                    return "<p><span class='badge bg-danger text-white'>No</span></p>";
            })
            ->addColumn('action', function($query)
            {
                $edit = '<a href="'.route("vendor.product.edit",$query->id).'" class="btn btn-primary mb-1"><i class="fa-solid fa-pen-to-square"></i></a>';
                $delete = '<a onclick="delete_row(event)" href="'.route("vendor.product.destroy",$query->id).'" id="' . $query->id . '"
                class="btn btn-danger mb-1 delete-item"><i class="fa-solid fa-trash"></i></a>';
                $more_actions = '
                <div class="dropdown mb-1">
                   <a class="btn btn-info dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
                   <i class="fas fa-cog"></i>
                   </a>
                   <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                      <li><a class="dropdown-item" href="' . route('vendor.product_image_gallery.index', ['id'=>$query->id]) . '"><i class="fa-solid fa-image me-2"></i> Image Gallery</a></li>
                      <li><a class="dropdown-item" href="' . route('vendor.product_variant.index', ['id'=>$query->id]) . '"><i class="fa-sharp fa-solid fa-square-arrow-up-right me-2"></i>Variants</a></li>
                   </ul>
                </div>
            '
            ;

                return $edit." ".$delete." ".$more_actions;
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
            ->addColumn('price', function($query)
            {
                $setting = GeneralSetting::first();
                if ($setting == null)
                   $currency_icon = '$';
                else
                   $currency_icon = $setting->currency_icon;

                return $currency_icon. $query->price;
            })
            ->rawColumns(['image', 'action', 'product_type', 'status', 'is_approved', 'price'])
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Product $model): QueryBuilder
    {
        return $model->where('vendor_id', auth()->user()->vendor->id)->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('product-table')
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
            Column::make('image')->addClass('text-center'),
            Column::make('price')->addClass('text-center'),
            Column::make('quantity')->addClass('text-center'),
            Column::make('product_type')->addClass('text-center'),
            Column::make('is_approved')->addClass('text-center'),
            Column::make('status')->addClass('text-center'),
            Column::make('action')->addClass('text-center')
            ->addClass('text-center'),

        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'VendorProduct_' . date('YmdHis');
    }
}
