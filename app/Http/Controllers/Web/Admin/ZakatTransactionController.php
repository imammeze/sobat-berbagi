<?php

namespace App\Http\Controllers\Web\Admin;

use App\Http\Controllers\Controller;
use App\Jobs\SendWhatsAppNotification;
use App\Models\ZakatTransaction;
use App\Services\Api\WhatsappService;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert as Swal;

class ZakatTransactionController extends Controller
{
    public function __construct()
    {
        $this->middleware(['permission:zakat-transaction-list'], ['only' => ['index']]);
        $this->middleware(['permission:zakat-transaction-create'], ['only' => ['store']]);
        $this->middleware(['permission:zakat-transaction-edit'], ['only' => ['update']]);
        $this->middleware(['permission:zakat-transaction-delete'], ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $transactions = ZakatTransaction::latest()->get();

        return view('pages.admin.transaction-management.zakat-transaction.index', compact('transactions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $transaction = ZakatTransaction::findOrFail($id);

        return view('pages.admin.transaction-management.zakat-transaction.show', compact('transaction'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $transaction = ZakatTransaction::findOrFail($id);

        $transaction->update([
            'status' => $request->status
        ]);

        $formattedAmount = number_format($transaction->amount, 0, ',', '.');

        $message = "Terimakasih $request->name, telah melakukan pembayaran zakat melalui aplikasi Sobat Berbagi." . PHP_EOL . PHP_EOL
            . "Berikut adalah detail transaksi kamu:" . PHP_EOL . PHP_EOL
            . "Jenis Zakat: $transaction->category_zakat" . PHP_EOL
            . "Nominal: Rp $formattedAmount" . PHP_EOL
            . "Terimakasih telah berbagi, semoga menjadi amal jariyah untuk kamu." . PHP_EOL . PHP_EOL
            . "Sobat Berbagi," . PHP_EOL . "Lazismu Banyumas";

        $whatsapp = new WhatsappService();
        $whatsapp->sendMessage($request->phone_number, $message);

        Swal::toast('Berhasil mengubah status transaksi', 'success');

        return redirect()->route('admin.transaksi-zakat.index', ['payment_method_code' => 'manual']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
