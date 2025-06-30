<?php

namespace App\Http\Controllers\Web\Admin;

use App\Http\Controllers\Controller;
use App\Models\WhatsappNotification;
use App\Services\Api\WhatsappService;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Campaign;

class WhatsappNotificationController extends Controller
{
    private $whatsappService;

    public function __construct(WhatsappService $whatsappService)
    {
        $this->whatsappService = $whatsappService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::with('donaturRelation')->get();
        $campaigns = Campaign::all();

        return view('pages.admin.whatsapp-notification.notification.index', compact('users', 'campaigns'));
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

    public function storeSingle(Request $request)
    {
        $request->validate([
            'number' => 'required|string',
            'message' => 'required|string',
        ]);
    
        // Ambil nama pengguna dari request atau default ke 'Pengguna'
        $userName = $request->user_name;
        $campaignName = $request->campaign_title;
        $campaignLink = 'https://sobatberbagi.com/campaign/' . $request->campaign_link;
        // $campaignImage = 'https://sobatberbagi.com/storage/' .  $request->campaign_thumbnail;
        // dd($campaignImage);
    
        // Replace placeholder {Nama User} dengan nama penerima
        $personalizedMessage = str_replace(
            ['{Nama User}', '{Nama Kampanye}', '{Link Donasi}'], 
            [$userName, $campaignName, $campaignLink], 
            $request->message
        );        
    
        // // Kirim pesan
        $this->whatsappService->sendMessageWithImage($request->number, $request->campaign_thumbnail, $personalizedMessage);

        return redirect()->route('admin.whatsapp.index')->with('success', 'Notifikasi berhasil dikirim ke penerima.');
    }

    /**
     * Display the specified resource.
     */
    public function show(WhatsappNotification $whatsappNotification)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(WhatsappNotification $whatsappNotification)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, WhatsappNotification $whatsappNotification)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(WhatsappNotification $whatsappNotification)
    {
        //
    }
}
