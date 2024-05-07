<?php

namespace App\DataTables;

use App\Models\Paket;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat\NumberFormatter;

class PaketDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addIndexColumn() 
            ->addColumn('action', 'master.paket.action')
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Paket $model): QueryBuilder
    {
        return $model->with('provider')->select('paket.*')->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('paket-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    //->dom('Bfrtip')
                    ->orderBy(1)
                    ->selectStyleSingle()
                    ->buttons([
                        Button::make('add'),
                        Button::make('reload'),
                        Button::make('reset')
                    ]);
    }

    /**
     * Get the dataTable columns definition.
     */
    public function getColumns(): array
    {
        return [
            Column::make('DT_RowIndex')->title('No')->orderable(false)->searchable(false),
            Column::make('nama_paket'),
            Column::computed('provider.nama_provider')
            ->title('Provider')
            ->orderable(true)
            ->searchable(true),
            Column::make('harga'),
            Column::make('kecepatan'),
            Column::make('action')
                ->exportable(false)
                ->printable(false)
                ->orderable(false)
                ->width(150) // Mengatur lebar kolom agar cukup untuk tombol-tombol
                ->addClass('text-center')
                ->view('master.paket.action') // Gunakan blade view untuk menampilkan tombol-tombol
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'Paket_' . date('YmdHis');
    }
}
