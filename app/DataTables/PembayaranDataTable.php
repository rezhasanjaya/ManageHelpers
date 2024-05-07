<?php

namespace App\DataTables;

use App\Models\Pembayaran;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class PembayaranDataTable extends DataTable
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
            ->addColumn('action', 'pembayaran.action')
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Pembayaran $model): QueryBuilder
    {
        return $model->with(['billing.customer', 'billing.paket', 'billing'])->select('pembayaran.*')->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('pembayaran-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    //->dom('Bfrtip')
                    ->orderBy(1)
                    ->selectStyleSingle()
                    ->buttons([
                        // Button::make('add'),
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
            Column::make('billing.id')->title('Id Billing')->searchable(true)->orderable(true),
            Column::make('billing.customer.nama')->title('Nama Customer')->searchable(true)->orderable(true),
            Column::make('billing.paket.nama_paket')->title('Paket')->searchable(true)->orderable(true),
            Column::make('tanggal_pembayaran'),
            Column::make('action')
            ->exportable(false)
            ->printable(false)
            ->orderable(false)
            ->width(150) // Mengatur lebar kolom agar cukup untuk tombol-tombol
            ->addClass('text-center')
            ->view('pembayaran.action')
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'Pembayaran_' . date('YmdHis');
    }
}
