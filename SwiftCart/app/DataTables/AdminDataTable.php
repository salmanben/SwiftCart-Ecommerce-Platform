<?php

namespace App\DataTables;

use App\Models\User;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class AdminDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
          if (auth()->user()->id == 1)
          {
            return (new EloquentDataTable($query))
            ->addColumn('action', function ($query) {
                $delete = '<a onclick="delete_row(event)" href="' . route("admin.user_admin.destroy", $query->id) . '" id="' . $query->id . '"
                class="btn btn-danger mb-1 delete-item"><i class="fa-solid fa-trash"></i></a>';
                return $delete;
            })
            ->addColumn('status', function ($query) {
                if (auth()->user()->id != 1) {
                    if ($query->status == 'active')
                    return "<p><span class='badge text-white bg-success'>Active</span></p>";
                else
                    return "<p><span class='badge text-white bg-danger'>Inactive</span></p>";
                } else {
                    if ($query->status == 'active')
                        return '<label style="cursor-pointer" class="custom-switch ">
                                   <input  onclick="switch_status(event)"  class="custom-switch-input switch-status" id="' . $query->id . '" checked type="checkbox" value="" id="defaultCheck1">
                                   <span class="custom-switch-indicator"></span>
                                </label>';
                    else
                        return '<label class="custom-switch">
                                   <input  onclick="switch_status(event)" style="cursor-pointer" class="custom-switch-input switch-status" id="' . $query->id . '" type="checkbox" value="" id="defaultCheck1">
                                   <span class="custom-switch-indicator"></span>
                                </label>';
                }
            })
            ->rawColumns(['status', 'action'])
            ->setRowId('id');
          }
          else
          {
            return (new EloquentDataTable($query))
            ->addColumn('status', function ($query) {
                if (auth()->user()->id != 1) {
                    if ($query->status == 'active')
                    return "<p><span class='badge text-white bg-success'>Active</span></p>";
                else
                    return "<p><span class='badge text-white bg-danger'>Inactive</span></p>";
                } else {
                    if ($query->status == 'active')
                        return '<label style="cursor-pointer" class="custom-switch ">
                                   <input  onclick="switch_status(event)"  class="custom-switch-input switch-status" id="' . $query->id . '" checked type="checkbox" value="" id="defaultCheck1">
                                   <span class="custom-switch-indicator"></span>
                                </label>';
                    else
                        return '<label class="custom-switch">
                                   <input  onclick="switch_status(event)" style="cursor-pointer" class="custom-switch-input switch-status" id="' . $query->id . '" type="checkbox" value="" id="defaultCheck1">
                                   <span class="custom-switch-indicator"></span>
                                </label>';
                }
            })
            ->rawColumns(['status'])
            ->setRowId('id');
          }
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(User $model): QueryBuilder
    {
        return $model->where('role', 'admin')->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('user-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            //->dom('Bfrtip')
            ->orderBy(1)
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
        $arr =  [
            Column::make('id')->addClass('text-center'),
            Column::make('name')->addClass('text-center'),
            Column::make('email')->addClass('text-center'),
            Column::make('status')->addClass('text-center'),
        ];
        if (auth()->user()->id == 1)
          $arr[] = Column::make('action')->addClass('text-center');
        return $arr;
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'Admin_' . date('YmdHis');
    }
}
