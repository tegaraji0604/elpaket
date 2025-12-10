<?php

namespace App\Http\Controllers;

use App\Models\Shipment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;

class ShipmentController extends Controller
{
    public function index()
    {
        $shipments = Shipment::latest()->take(50)->get();
        return view('index', compact('shipments'));
    }

    public function create()
    {
        return view('create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'sender_name' => 'required',
            'sender_phone' => 'required',
            'sender_address' => 'required',

            'receiver_name' => 'required',
            'receiver_phone' => 'required',
            'receiver_address' => 'required',

            'weight' => 'required|numeric',
            'description' => 'required',
        ]);

        // Insert ke tabel shipments
        $shipment = Shipment::create([
            'tracking_number' => 'TRK-' . strtoupper(uniqid()),
            'sender_name' => $validated['sender_name'],
            'sender_address' => $validated['sender_address'],
            'receiver_name' => $validated['receiver_name'],
            'receiver_address' => $validated['receiver_address'],
            'weight' => $validated['weight'],
            'description' => $validated['description'],
            'status' => 'Diproses',
        ]);

        // Simpan ke shipment_history
        DB::table('shipment_history')->insert([
            'shipment_id' => $shipment->id,
            'status' => 'Diproses',
            'tanggal_status' => now(),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()->route('about')->with('success', 'Pengiriman berhasil dibuat!');
    }

    public function track(Request $request)
    {
        $result = null;

        if ($request->q) {
            $result = Shipment::where('tracking_number', $request->q)->first();
        }

        return view('track', compact('result'));
    }

    public function history(Request $request)
    {
        $query = DB::table('shipments')
            ->leftJoin('shipment_history', 'shipments.id', '=', 'shipment_history.shipment_id')
            ->select(
                'shipments.id',
                'shipments.tracking_number',
                'shipments.sender_name',
                'shipments.receiver_name',
                'shipments.status as current_status',
                'shipments.completed_at',
                'shipment_history.tanggal_status',
                'shipment_history.status as history_status'
            );

        if ($request->date) {
            $query->whereDate('shipment_history.tanggal_status', $request->date);
        }

        if ($request->q) {
            $q = $request->q;
            $query->where(function ($x) use ($q) {
                $x->where('shipments.sender_name', 'like', "%$q%")
                    ->orWhere('shipments.receiver_name', 'like', "%$q%");
            });
        }

        $history = $query->orderBy('shipment_history.tanggal_status', 'desc')->get();

        return view('history', compact('history'));
    }

    public function about()
    {
        return view('about');
    }

    public function complete($id)
    {
        $shipment = Shipment::findOrFail($id);

        $shipment->status = 'Selesai';
        $shipment->completed_at = now();
        $shipment->save();

        // Cek apakah sudah ada status selesai
        $cek = DB::table('shipment_history')
            ->where('shipment_id', $shipment->id)
            ->where('status', 'Selesai')
            ->first();

        if (!$cek) {
            DB::table('shipment_history')->insert([
                'shipment_id' => $shipment->id,
                'status' => 'Selesai',
                'tanggal_status' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        return back()->with('success', 'Pengiriman ditandai selesai!');
    }

    // ================================
    // 🔥 EXPORT PDF
    // ================================
    public function exportPdf()
{
    $history = DB::table('shipments')
        ->leftJoin('shipment_history', 'shipments.id', '=', 'shipment_history.shipment_id')
        ->select(
            'shipments.tracking_number',
            'shipment_history.tanggal_status',
            'shipments.sender_name',
            'shipments.receiver_name',
            'shipment_history.status',
            'shipments.completed_at'
        )
        ->orderBy('shipment_history.tanggal_status', 'desc')
        ->get();

    $pdf = \PDF::loadView('pdf.shipment-history', compact('history'));
    return $pdf->download('shipment-history.pdf');
}

}
