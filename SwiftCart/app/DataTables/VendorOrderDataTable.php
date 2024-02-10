<?php

namespace App\DataTables;

use App\Models\Order;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;
use Illuminate\Support\Facades\Route;

class VendorOrderDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('action', function ($query) {
                $show = '<a href="' . route("vendor.order.show", $query->id) . '" class="btn btn-primary mb-1"><i class="fa-solid fa-eye"></i></a>';
                return $show;
            })
            ->addColumn('amount', function ($query) {
                return $query->currency_icon .   $query->amount;
            })
            ->addColumn('order_status', function ($query) {
                $bg = '';
                switch($query->order_status)
                {
                    case 'pending':$bg = 'bg-secondary';break;
                    case 'processed_and_ready_to_ship':$bg = 'bg-info';break;
                    case 'dropped_off':;
                    case 'shipped':;
                    case 'out_for_delivery':;
                    case 'delivered':$bg = 'bg-success';break;
                    case 'canceled':$bg = 'bg-danger';break;
                };
                return '<span class="badge '.$bg.' color-white">'.ucfirst(str_replace('_', ' ',$query->order_status)).'</span>';
            })
            ->addColumn('date', function ($query) {
                return date('Y-m-d', strtotime($query->created_at));
            })
            ->rawColumns(['order_status', 'action', 'payment_method', 'amount'])
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Order $model): QueryBuilder
    {
        return $model->whereHas('order_products', function ($query) {
            $query->whereHas('product', function ($query) {
                $query->where('vendor_id', auth()->user()->vendor->id);
            });
        })->newQuery();
    }



    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('order-table')
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
            Column::make('invoice_id')->addClass('text-center'),
            Column::make('amount')->addClass('text-center'),
            Column::make('order_status')->addClass('text-center'),
            Column::make('date')->addClass('text-center'),
            Column::make('action')->addClass('text-center'),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'VendorOrder_' . date('YmdHis');
    }
}

