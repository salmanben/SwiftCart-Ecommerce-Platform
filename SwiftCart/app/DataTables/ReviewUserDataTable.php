<?php

namespace App\DataTables;

use App\Models\Review;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class ReviewUserDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('action', 'Review.action')
            ->addColumn('action', function ($query) {
                $delete = '<a onclick="delete_row(event)" href="' . route("user.review.delete", $query->id) . '" id="' . $query->id . '" class="btn btn-danger "><i class="fa-solid fa-trash"></i></a>';
                return $delete;
            })
            ->addColumn('rating', function ($query) {
                $rating = '';
                for ($i = 0; $i < $query->rating; $i++) {
                    $rating .= '<i class="fas fa-star text-warning me-2"></i>';
                }

                for ($i = $query->rating; $i < 5; $i++) {
                    $rating .= '<i class="far fa-star text-warning me-2"></i>';
                }
                return $rating;
            })
            ->addColumn('product', function ($query) {
                return '<div style="width:80px; height:80px">
                    <a href="' . route('product_details', $query->product_id) . '">
                        <img src="' .asset('storage/upload/' . $query->product->image). '" class="img-fluid rounded">
                    </a>
                </div>';
            })
            ->addColumn('name', function ($query) {
                return '<a href="' . route('product_details', $query->product_id) . '">' .
                    $query->product->name .
                    '</a>';
            })
            ->addColumn('image', function ($query) {
                $gallery = '';
                $images = json_decode($query->image);
                for ($i = 0; $i < count($images); $i++)
                {
                   $gallery .= '<div style="width:50px; height:50px">
                       <img src="' .asset('storage/upload/' . $images[$i]). '" class="img-fluid rounded">
                       </div>';
                }

                return '<div class="d-flex flex-wrap gap-2">
                '.$gallery.'</div>';
            })
            ->rawColumns(['action', 'rating', 'product', 'name', 'image'])
            ->setRowId('id');
    }


    /**
     * Get the query source of dataTable.
     */
    public function query(Review $model): QueryBuilder
    {
        return $model->where('user_id', auth()->user()->id)->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('Review-table')
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
            Column::make('name')->addClass('text-center'),
            Column::make('rating')->addClass('text-center'),
            Column::make('comment')->addClass('text-center'),
            Column::make('image')->addClass('text-center'),
            Column::make('action')->addClass('text-center'),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'Review_' . date('YmdHis');
    }
}
