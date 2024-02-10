<?php

namespace App\DataTables;

use App\Models\ChildCategory;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class ChildCategoryDataTable extends DataTable
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
                $edit = '<a href="'.route("admin.child_category.edit",$query->id).'" class="btn btn-primary mb-1"><i class="fa-solid fa-pen-to-square"></i></a>';
                $delete = '<a onclick="delete_row(event)" href="'.route("admin.child_category.destroy",$query->id).'" id="' . $query->id . '"
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
            ->addColumn('category', function($query)
            {
                return $query->category->name;
            })
            ->addColumn('sub category', function($query)
            {
                return $query->sub_category->name;
            })
            ->rawColumns(['action', 'category', 'status', 'sub category'])
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(ChildCategory $model): QueryBuilder
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('category-table')
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
            Column::make('category')->addClass('text-center'),
            Column::make('sub category')->addClass('text-center'),
            Column::make('status')->width(100)->addClass('text-center'),
            Column::make('action')->addClass('text-center')->width(100),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'ChildCategory_' . date('YmdHis');
    }
}
