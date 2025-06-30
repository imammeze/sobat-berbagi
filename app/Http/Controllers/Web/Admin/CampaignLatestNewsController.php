<?php

namespace App\Http\Controllers\Web\Admin;

use App\Http\Controllers\Controller;
use App\Models\Campaign;
use App\Models\CampaignLatestNews;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert as Swal;

class CampaignLatestNewsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (Auth::user()->hasRole('mitra')) {
            $latestNews = CampaignLatestNews::whereHas('campaign', function ($query) {
                $query->where('mitra_id', Auth::user()->profile->id);
            })->get();
        } else {
            $latestNews = CampaignLatestNews::all();
        }

        return view('pages.admin.campaign-management.latest-news.index', compact('latestNews'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (Auth::user()->hasRole('mitra')) {
            $campaigns = Campaign::where('mitra_id', Auth::user()->profile->id)->get();
        } else {
            $campaigns = Campaign::all();
        }

        return view('pages.admin.campaign-management.latest-news.create', compact('campaigns'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'campaign_id' => 'required',
            'date' => 'required',
            'title' => 'required',
            'content' => 'required',
        ], [
            'campaign_id.required' => 'Campaign wajib dipilih',
            'date.required' => 'Tanggal wajib diisi',
            'title.required' => 'Judul wajib diisi',
            'content.required' => 'Content wajib diisi',
        ]);

        CampaignLatestNews::create($data);

        Swal::toast('Berita Campaign baru ditambahkan', 'success');

        return redirect()->route('admin.campaign-latest-news.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        if (Auth::user()->hasRole('mitra')) {
            $campaigns = Campaign::where('mitra_id', Auth::user()->profile->id)->get();
        } else {
            $campaigns = Campaign::all();
        }

        $latestNews = CampaignLatestNews::find($id);

        return view('pages.admin.campaign-management.latest-news.edit', compact('campaigns', 'latestNews'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = $request->validate([
            'campaign_id' => 'required',
            'date' => 'required',
            'title' => 'required',
            'content' => 'required',
        ], [
            'campaign_id.required' => 'Campaign wajib dipilih',
            'date.required' => 'Tanggal wajib diisi',
            'title.required' => 'Judul wajib diisi',
            'content.required' => 'Content wajib diisi',
        ]);

        $latestNews = CampaignLatestNews::find($id);

        $latestNews->update($data);

        Swal::toast('Berita Campaign berhasil diperbarui', 'success');

        return redirect()->route('admin.campaign-latest-news.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $latestNews = CampaignLatestNews::find($id);

        $latestNews->delete();

        Swal::toast('Berita Campaign berhasil dihapus', 'success');

        return redirect()->route('admin.campaign-latest-news.index');
    }
}
