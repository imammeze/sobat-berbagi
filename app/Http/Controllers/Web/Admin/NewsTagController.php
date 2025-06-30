<?php

namespace App\Http\Controllers\Web\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Web\Admin\News\StoreNewsTagRequest;
use App\Http\Requests\Web\Admin\News\UpdateNewsTagRequest;
use App\Interfaces\NewsTagRepositoryInterface;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert as Swal;

class NewsTagController extends Controller
{

    private NewsTagRepositoryInterface $tagRepository;

    public function __construct(NewsTagRepositoryInterface $tagRepository)
    {
        $this->tagRepository = $tagRepository;

        $this->middleware(['permission:article-tag-list'], ['only' => ['index']]);
        $this->middleware(['permission:article-tag-create'], ['only' => ['store']]);
        $this->middleware(['permission:article-tag-edit'], ['only' => ['update']]);
        $this->middleware(['permission:article-tag-delete'], ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tags = $this->tagRepository->getAllNewsTags();

        return view('pages.admin.news-management.tag.index', compact('tags'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.admin.news-management.tag.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreNewsTagRequest $request)
    {

        $this->tagRepository->createNewsTag($request->all());

        Swal::toast('Data berhasil ditambahkan', 'success');

        return redirect()->route('admin.news-tags.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $tag = $this->tagRepository->getNewsTagById($id);

        return view('pages.admin.news-management.tag.edit', compact('tag'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateNewsTagRequest $request, string $id)
    {

        $this->tagRepository->updateNewsTag($request->all(), $id);

        Swal::toast('Data berhasil diubah', 'success');

        return redirect()->route('admin.news-tags.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {

        $this->tagRepository->deleteNewsTag($id);

        Swal::toast('Data berhasil dihapus', 'success');

        return redirect()->route('admin.news-tags.index');
    }
}
