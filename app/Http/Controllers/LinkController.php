<?php

namespace App\Http\Controllers;

use App\Models\Link;
use Illuminate\Http\Request;


class LinkController extends Controller
{
    // Menampilkan semua link di admin
    public function index()
    {
        $links = Link::all();
        return view('admin.links.index', compact('links'));
    }

    // Form untuk membuat link baru
    public function create()
    {
        return view('admin.links.create');
    }

    // Menyimpan link baru
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'content' => 'required'
        ]);

        Link::create($request->all());

        return redirect()->route('links.index')->with('success', 'Link berhasil ditambahkan.');
    }

    // Form untuk mengedit link
    public function edit(Link $link)
    {
        return view('admin.links.edit', compact('link'));
    }

    // Update link
    public function update(Request $request, Link $link)
    {
        $request->validate([
            'title' => 'required',
            'content' => 'required'
        ]);

        $link->update($request->all());

        return redirect()->route('links.index')->with('success', 'Link berhasil diupdate.');
    }

    // Hapus link
    public function destroy(Link $link)
    {
        $link->delete();

        return redirect()->route('links.index')->with('success', 'Link berhasil dihapus.');
    }

    // Menampilkan konten di frontend berdasarkan parameter link_laman
    public function showContent(Request $request)
    {
        // Ambil parameter dari URL
        $linkLaman = $request->query('link_laman');

        // Cari link berdasarkan judul
        $link = Link::where('title', $linkLaman)->first();

        // Jika ditemukan, tampilkan kontennya
        if ($link) {
            return view('frontend.show-content', ['link' => $link]);
        } else {
            return abort(404, 'Halaman tidak ditemukan');
        }
    }
}


