<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Payment;
use Illuminate\Support\Carbon;
use PDF;

class LaporanController extends Controller
{
 public function index()
{
    $ordersQuery = Order::with(['customer.district.citie.province', 'payment'])
        ->orderBy('created_at', 'DESC');

    if (request()->has('q') && request()->q != '') {
        $keyword = request()->q;
        $ordersQuery = $ordersQuery->where(function ($query) use ($keyword) {
            $query->where('customer_name', 'LIKE', '%' . $keyword . '%')
                  ->orWhere('invoice', 'LIKE', '%' . $keyword . '%')
                  ->orWhere('customer_address', 'LIKE', '%' . $keyword . '%');
        });
    }

    if (request()->has('status') && request()->status !== '') {
        $ordersQuery = $ordersQuery->where('status', request()->status);
    }

    if (request()->filled('bulan')) {
        $bulan = request()->bulan;
        $ordersQuery = $ordersQuery->whereYear('created_at', substr($bulan, 0, 4))
                                   ->whereMonth('created_at', substr($bulan, 5, 2));
    }

    $orders = $ordersQuery->paginate(10);

    $total = Order::when(request()->filled('q'), function ($query) {
            $keyword = request()->q;
            $query->where(function ($q) use ($keyword) {
                $q->where('customer_name', 'LIKE', '%' . $keyword . '%')
                  ->orWhere('invoice', 'LIKE', '%' . $keyword . '%')
                  ->orWhere('customer_address', 'LIKE', '%' . $keyword . '%');
            });
        })
        ->when(request()->filled('status'), function ($query) {
            $query->where('status', request()->status);
        })
        ->when(request()->filled('bulan'), function ($query) {
            $bulan = request()->bulan;
            $query->whereYear('created_at', substr($bulan, 0, 4))
                  ->whereMonth('created_at', substr($bulan, 5, 2));
        })
        ->sum('subtotal');

    return view('orders.laporan', compact('orders', 'total'));
}



    // Update status pesanan
    public function update(Request $request)
    {
        $order = Order::findOrFail($request->id);
        $order->status = $request->status;
        $order->save();

        $label = $this->getStatusLabel($request->status);
        session()->flash('success', "Status berhasil diubah menjadi $label");
        return redirect()->route('laporan.index');
    }

    // Helper status label
    private function getStatusLabel($status)
    {
        switch ((int)$status) {
            case 0: return 'Baru';
            case 1: return 'Dikonfirmasi';
            case 2: return 'Proses';
            case 3: return 'Dikirim';
            case 4: return 'Selesai';
            default: return 'Tidak diketahui';
        }
    }

    // Hapus pesanan
    public function destroy($id)
    {
        $order = Order::findOrFail($id);
        $order->details()->delete();
        $order->payment()->delete();
        $order->delete();

        session()->flash('success', 'Pesanan berhasil dihapus');
        return redirect()->route('laporan.index');
    }

    // Menampilkan laporan berdasarkan tanggal (untuk frontend)
    public function viewOrder()
    {
        $start = Carbon::now()->startOfMonth()->startOfDay();
        $end = Carbon::now()->endOfMonth()->endOfDay();

        if (request()->has('date') && request()->date != '') {
            $range = explode(' - ', request()->date);
            $start = Carbon::parse($range[0])->startOfDay();
            $end = Carbon::parse($range[1])->endOfDay();
        }

        $orders = Order::with(['customer.district'])
            ->whereBetween('created_at', [$start, $end])
            ->get();

        return view('order.view', compact('orders'));
    }

    // Export PDF laporan berdasarkan range tanggal
    public function orderReportPdf($daterange)
    {
        $range = explode('+', $daterange);
        $start = Carbon::parse($range[0])->startOfDay();
        $end = Carbon::parse($range[1])->endOfDay();

        $orders = Order::with(['customer.district'])
            ->whereBetween('created_at', [$start, $end])
            ->get();

        // $pdf = PDF::loadView('order.order_pdf', compact('orders', 'range'));
        return $pdf->stream('laporan-order.pdf');
    }

    // Endpoint ambil data JSON (invoice, customer, tanggal, total harga)
    public function getOrderSummary()
    {
        $orders = Order::select('invoice', 'customer_name', 'created_at', 'subtotal')
            ->orderBy('created_at', 'DESC')
            ->get();

        $orders->transform(function ($order) {
            return [
                'invoice' => $order->invoice,
                'customer' => $order->customer_name,
                'tanggal' => $order->created_at->format('d-m-Y'),
                'total' => number_format($order->subtotal, 0, ',', '.')
            ];
        });

        return response()->json([
            'success' => true,
            'data' => $orders
        ]);
    }
}
