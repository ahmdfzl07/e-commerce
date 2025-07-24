<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FullCustom;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class FullCustomController extends Controller
{
    public function list()
    {
        $customer_id = Auth::guard('costumer')->user()->id;
        $list = FullCustom::where('customer_id', $customer_id)->get();

        return view('costumer.full_custom.full_custom', compact('list'));
    }

    public function checkoutProsesCustom(Request $request)
    {
        $request->validate([
            'customer_name' => 'required|string|max:255',
            'customer_phone' => 'required|string|max:15',
            'customer_address' => 'required|string|max:255',
            'photo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'product_name' => 'required|string|max:255',
            'photo_width' => 'required|numeric',
            'photo_height' => 'required|numeric',
        ]);

        if ($request->hasFile('photo')) {
            $file = $request->file('photo');
            $filename = time() . Str::slug($request->product_name) . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('full_custom'), $filename);
        }

        $fullcustom = FullCustom::create([
            'invoice' => $request->invoice,
            'customer_id' => Auth::guard('costumer')->user()->id,
            'customer_name' => $request->customer_name,
            'customer_phone' => $request->customer_phone,
            'customer_address' => $request->customer_address,
            'photo' => $filename,
            'product_name' => $request->product_name,
            'photo_width' => $request->photo_width,
            'photo_height' => $request->photo_height,
            'subtotal' => $request->photo_width * $request->photo_height * 1800000,
            'status' => 0,
        ]);

        session()->flash('success', "Pesanan SEBELAH GDNG Berhasil dipesan");
        return redirect()->back();
    }

    public function show($id)
    {
        $custom = FullCustom::where('id', $id)->where('customer_id', Auth::guard('costumer')->user()->id)->firstOrFail();
        return view('costumer.full_custom.detail', compact('custom'));
    }
    public function payment($id){
        $order = FullCustom::where('id', $id)->first();

        return view('costumer.full_custom.payment', compact('order'));
    }
    public function pay(Request $request){
        $order = FullCustom::where('id', $request->id)->first();
        if ($request->hasFile('bukti')) {
            $file = $request->file('bukti');
            $filename = time() . $file->getClientOriginalExtension();
            $file->move(public_path('bukti_full_custom'), $filename);
        }
        $order->update([
            'status' => 1,
            'bukti' => $filename
        ]);

        session()->flash('success', "Upload bukti pembayaran berhasil. Silahkan tunggu konfirmasi dari admin!");
        return redirect()->back();

    }

    public function full_custom()
    {
        $orders = FullCustom::with(['customer.district.citie.province'])
            ->orderBy('created_at', 'DESC');  

        if (request()->q != '') {
            $orders = $orders->where(function($q) {
                $q->where('customer_name', 'LIKE', '%' . request()->q . '%')
                ->orWhere('invoice', 'LIKE', '%' . request()->q . '%')
                ->orWhere('customer_address', 'LIKE', '%' . request()->q . '%');
            });
        }

        if (request()->status != '') {
            $orders = $orders->where('status', request()->status);
        }
        $orders = $orders->paginate(10);
        return view('full_custom.index', compact('orders'));
    }
    public function updateFC(Request $request)
    {
        $orderId = $request->id;
    
        $orders = FullCustom::where('id', $orderId)->update([
            'status' => $request->status,
        ]);
    
        $statusLabel = $this->getStatusLabel($request->status);
    
        session()->flash('success', "Status pesanan berhasil diubah menjadi $statusLabel");
        return redirect()->back();
    }
    private function getStatusLabel($status)
    {
        switch ($status) {
            case 0:
                return 'Menunggu Pembayaran';
            case 1:
                return 'Menunggu konfirmasi admin';
            case 2:
                return 'Sedang Proses';
            case 3:
                return 'Sedang Dikirim';
            case 4:
                return 'Tunggu customer update ke Selesai';
            default:
                return 'Unknown';
        }
    }
}
