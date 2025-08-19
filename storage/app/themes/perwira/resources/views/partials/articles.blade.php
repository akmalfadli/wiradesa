{{-- resources/views/partials/articles.blade.php --}}

<div class="mt-16" id="articles-section">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold">Artikel {{ ucfirst(setting('sebutan_desa')) }} {{ ucwords($desa['nama_desa']) }}</h2>
        <div class="text-sm">  
            @include('theme::commons.paging', ['paging_page' => $paging_page])
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @php
            $filteredArtikel = $artikel->reject(fn($post) => $post['kategori'] === 'agenda');
        @endphp

        @if ($filteredArtikel->count() > 0)
            @foreach ($filteredArtikel->take(6) as $post)
                @include('theme::partials.artikel.list', ['post' => $post])
            @endforeach
        @else
            @include('theme::partials.artikel.empty', ['title' => $title])
        @endif
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Function to scroll to articles section
    function scrollToArticles() {
        const articlesSection = document.getElementById('articles-section');
        if (articlesSection) {
            const offsetTop = articlesSection.offsetTop - 100; // 100px offset from top
            window.scrollTo({
                top: offsetTop,
                behavior: 'smooth'
            });
        }
    }
    
    // Check if we should scroll to articles (from sessionStorage)
    if (sessionStorage.getItem('scrollToArticles') === 'true') {
        sessionStorage.removeItem('scrollToArticles'); // Clear the flag
        setTimeout(scrollToArticles, 300);
    }
    
    // Also check for page parameter as fallback
    const urlParams = new URLSearchParams(window.location.search);
    const currentPage = urlParams.get('page');
    
    if (currentPage && currentPage !== '1' && !sessionStorage.getItem('scrollToArticles')) {
        setTimeout(scrollToArticles, 300);
    }
    
    // Handle direct anchor links
    if (window.location.hash === '#articles-section') {
        setTimeout(scrollToArticles, 300);
    }
});
</script>