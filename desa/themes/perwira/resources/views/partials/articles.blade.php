{{-- resources/views/partials/articles.blade.php --}}

<div class="mt-16">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold">Artikel {{ ucfirst(setting('sebutan_desa')) }} {{ ucwords($desa['nama_desa']) }}</h2>
        <button class="bg-green-600 text-white px-4 py-2 rounded-lg text-sm hover:bg-green-700 transition-colors">
            Lihat Semua
        </button>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @php
            $filteredArtikel = $artikel->reject(fn($post) => $post['kategori'] === 'agenda');
        @endphp

        @if ($filteredArtikel->count() > 0)
            @foreach ($filteredArtikel->take(6) as $post)
                @include('theme::partials.artikel.list', ['post' => $post])
            @endforeach

            {{-- <div class="pagination space-y-1 flex-wrap w-full">
                @include('theme::commons.paging', ['paging_page' => $paging_page])
            </div> --}}
        @else
            @include('theme::partials.artikel.empty', ['title' => $title])
        @endif

    </div>
</div>