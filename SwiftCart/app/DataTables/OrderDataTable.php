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

class OrderDataTable extends DataTable
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
                $show = '<a href="' . route("admin.order.show", $query->id) . '" class="btn btn-primary mb-1"><i class="fa-solid fa-eye"></i></a>';
                $delete = '<a onclick="delete_row(event)" href="' . route("admin.order.destroy", $query->id) . '" id="' . $query->id . '"
                    class="btn btn-danger mb-1 delete-item"><i class="fa-solid fa-trash"></i></a>';

                return $show." ".$delete;
            })
            ->addColumn('customer', function ($query) {
                return $query->user->name;
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
            ->rawColumns(['customer', 'order_status', 'action', 'amount'])
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Order $model): QueryBuilder
    {
        $route = Route::currentRouteName();
        switch ($route) {
            case 'admin.order.index':
                return $model->newQuery();
                break;
            case 'admin.order.pending':
                return $model->where('order_status', 'pending')->newQuery();
                break;
            case 'admin.order.processed':
                return $model->where('order_status', 'processed_and_ready_to_ship')->newQuery();
                break;
            case 'admin.order.dropped_off':
                return $model->where('order_status', 'dropped_off')->newQuery();
                break;
            case 'admin.order.shipped':
                return $model->where('order_status', 'shipped')->newQuery();
                break;
            case 'admin.order.out_for_delivery':
                return $model->where('order_status', 'out_for_delivery')->newQuery();
                break;
            case 'admin.order.delivered':
                return $model->where('order_status', 'delivered')->newQuery();
                break;
            case 'admin.order.canceled':
                return $model->where('order_status', 'canceled')->newQuery();
                break;

        }
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
            Column::make('customer')->addClass('text-center'),
            Column::make('amount')->addClass('text-center'),
            Column::make('order_status')->addClass('text-center'),
            Column::make('payment_method')->addClass('text-center'),
            Column::make('date')->addClass('text-center'),
            Column::make('action')->addClass('text-center'),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'Order_' . date('YmdHis');
    }
}
