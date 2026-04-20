<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\PageUpdateRequest;
use App\Models\Page;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class PageController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:pages.manage');
    }

    public function index(): View
    {
        $pages = Page::orderBy('title')->get();

        return view('admin.pages.index', compact('pages'));
    }

    public function edit(Page $page): View
    {
        return view('admin.pages.form', compact('page'));
    }

    public function update(PageUpdateRequest $request, Page $page): RedirectResponse
    {
        $data = $request->validated();
        if ($data['status'] === 'published' && ! $page->published_at) {
            $data['published_at'] = now();
        }

        $page->update($data);

        return back()->with('success', 'Page updated.');
    }
}
