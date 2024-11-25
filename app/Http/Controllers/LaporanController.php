<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TransaksiServis\TransaksiServis;
use App\Models\TransaksiSparepart\TransaksiJualSparepart;

class LaporanController extends Controller
{
    public function index(Request $request)
    {
        $month = $request->get('month', date('m'));
        $year = $request->get('year', date('Y'));

        $serviceTransactions = TransaksiServis::whereMonth('tanggal_masuk', $month)
            ->whereYear('tanggal_masuk', $year)
            ->get()
            ->map(function ($transaction) {
                return [
                    'id' => $transaction->id_service,
                    'type' => 'Servis',
                    'date' => $transaction->tanggal_masuk,
                    'amount' => $transaction->harga_total_transaksi_servis,
                ];
            });

        $sparepartTransactions = TransaksiJualSparepart::whereMonth('tanggal_jual', $month)
            ->whereYear('tanggal_jual', $year)
            ->get()
            ->map(function ($transaction) {
                return [
                    'id' => $transaction->id_transaksi_sparepart,
                    'type' => 'Penjualan Sparepart',
                    'date' => $transaction->tanggal_jual,
                    'amount' => $transaction->harga_total_transaksi_sparepart,
                ];
            });

        $transactions = $serviceTransactions->merge($sparepartTransactions)->sortBy('date');
        $totalProfit = $transactions->sum('amount');

        return view('laporan.index', [
            'transactions' => $transactions,
            'totalProfit' => $totalProfit,
        ]);
    }
}