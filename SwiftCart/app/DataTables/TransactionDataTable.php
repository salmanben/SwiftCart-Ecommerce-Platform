<?php

namespace App\DataTables;

use App\Models\Transaction;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class TransactionDataTable extends DataTable
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
                $delete = '<a onclick="delete_row(event)" href="' . route("admin.transaction.destroy", $query->id) . '" id="' . $query->id . '"
                    class="btn btn-danger mb-1 delete-item"><i class="fa-solid fa-trash"></i></a>';
            return $delete;
            })
            ->addColumn('amount', function ($query) {
                return $query->currency_icon .   $query->amount_real_currency;
            })
            ->addColumn('date', function ($query) {
                return date('Y-m-d', strtotime($query->created_at));
            })
            ->addColumn('invoice_id', function ($query) {
                return $query->order->invoice_id;
            })
            ->rawColumns([ 'action', 'amount', 'date', 'invoice_id'])
            ->filterColumn('invoice_id', function ($query, $keyword) {
                $query->whereHas('order', function ($query) use ($keyword) {
                    $query->where('invoice_id', 'like', '%' . $keyword . '%');
                });
            })

            ->setRowId('id');
    }


    /**
     * Get the query source of dataTable.
     */
    public function query(Transaction $model): QueryBuilder
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('transaction-table')
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
            Column::make('transaction_id')->addClass('text-center'),
            Column::make('amount')->addClass('text-center'),
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
        return 'Transaction_' . date('YmdHis');
    }
}
