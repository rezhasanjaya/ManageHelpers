<?php

namespace App\DataTables;

use Carbon\Carbon;
use App\Models\Billing;
use App\Models\Pembayaran;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;

class BillingDataTable extends DataTable
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
            ->addColumn('action', 'billing.action')
            ->addColumn('jatuh_tempo_logic', function ($billing) {
                $checkJatuhTempo = Billing::where('id', $billing->id)
                ->first();
                $jatuh_tempo = $checkJatuhTempo->jatuh_tempo;
                if($jatuh_tempo == null){
                    return '-';
                } else {
                    return $jatuh_tempo;
                }
            })
            ->addColumn('tanggal_pembayaran_terakhir', function ($billing) {
                $latestPayment = Pembayaran::where('id_billing', $billing->id)
                    ->latest('tanggal_pembayaran')
                    ->first();
                return $latestPayment ? $latestPayment->tanggal_pembayaran : '-';
            })
            ->addColumn('lunas', function ($billing) {
                $latestPayment = Pembayaran::where('id_billing', $billing->id)
                                ->latest('tanggal_pembayaran')
                                ->first();
                if (!$latestPayment) {
                    return 'Belum Melakukan Pembayaran Pertama';
                }
        
                $tanggal_pembayaran_terakhir = Carbon::parse($latestPayment->tanggal_pembayaran);
                $jatuh_tempo = Carbon::parse($billing->jatuh_tempo);
                
                $getPembayaran = Pembayaran::where('id_billing', $billing->id)
                                ->latest('tanggal_pembayaran')
                                ->where('tanggal_pembayaran', '>=', $tanggal_pembayaran_terakhir)
                                ->where('tanggal_pembayaran', '<=', $jatuh_tempo)
                                ->first();
                
                $hari_ini = Carbon::now();

                if($hari_ini >  $jatuh_tempo){
                    return 'Melewati Jatuh Tempo';
                } else {
                    if ($getPembayaran) {
                        return 'Lunas';
                    } else {
                        return 'Tidak Valid';
                    }
                }
            })
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Billing $model): QueryBuilder
    {
        return $model->with(['customer', 'paket.provider'])->select('billings.*')->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('billing-table')
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
            Column::make('customer.nama')->title('Nama Customer')->searchable(true)->orderable(true),
            Column::make('customer.email')->title('Email')->searchable(true)->orderable(true),  
            Column::make('customer.telp')->title('Telp')->searchable(true)->orderable(true),  
            Column::make('paket.nama_paket')->title('Nama Paket')->searchable(true)->orderable(true),
            Column::make('paket.provider.nama_provider')->title('Provider')->searchable(true)->orderable(true),
            Column::make('tanggal_langganan')->title('Langganan')->searchable(true)->orderable(true),
            Column::make('tanggal_pembayaran_terakhir')->title('Pembayaran Terakhir')->searchable(true)->orderable(true),
            Column::make('jatuh_tempo_logic')->title('Jatuh Tempo')->searchable(true)->orderable(true),
            Column::make('lunas')->title('Status')->searchable(true)->orderable(true),
            Column::make('action')
                ->exportable(false)
                ->printable(false)
                ->orderable(false)
                ->width(150) // Mengatur lebar kolom agar cukup untuk tombol-tombol
                ->addClass('text-center')
                ->view('billing.action')
        ];
    }


    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'Billing_' . date('YmdHis');
    }
}
