<?php

namespace App\DataTables;

use App\Models\GeneralSetting;
use App\Models\WithdrawRequest;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class VendorWithdrawRequestDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        $setting = GeneralSetting::first();
        if ($setting == null)
            $currency_icon = '$';
        else
            $currency_icon = $setting->currency_icon;

        return (new EloquentDataTable($query))
            ->addColumn('action', function ($query) {
                $show = '<a href="' . route("vendor.withdraw.show", $query->id) . '" class="btn btn-primary mb-1"><i class="fa-solid fa-eye"></i></a>';
                return $show;
            })
            ->addColumn('withdraw_amount', function ($query) use ($currency_icon) {
                return $currency_icon .   $query->amount;
            })
            ->addColumn('total_amount', function ($query) use ($currency_icon) {
                return $currency_icon .   round($query->amount + $query->amount * $query->charge/100, 2);
            })
            ->addColumn('withdraw_charge', function ($query) use ($currency_icon){
                return $currency_icon .   round($query->amount * $query->charge/100, 2);
            })

            ->addColumn('status', function ($query) {
                if ($query->status == 'pending')
                    return '<span class="badge" style="background:#F58026" color-white">'.$query->status.'</span>';
                else if ($query->status == 'paid')
                    return '<span class="badge bg-success" color-white">'.$query->status.'</span>';
                else
                    return '<span class="badge bg-danger" color-white">'.$query->status.'</span>';

            })
            ->rawColumns(['action', 'status', 'total_amount','withdraw_amount', 'withdraw_charge'])
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(WithdrawRequest $model): QueryBuilder
    {
        return $model->where('vendor_id', auth()->user()->vendor->id)->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('WithdrawRequest-table')
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
            Column::make('method')->addClass('text-center'),
            Column::make('total_amount')->addClass('text-center'),
            Column::make('withdraw_amount')->addClass('text-center'),
            Column::make('withdraw_charge')->addClass('text-center'),
            Column::make('status')->addClass('text-center'),
            Column::make('action')->addClass('text-center'),

        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'VendorWithdrawRequest_' . date('YmdHis');
    }
}
