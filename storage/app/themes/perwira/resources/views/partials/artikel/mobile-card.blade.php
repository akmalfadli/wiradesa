<script type="text/template" id="mobile-card-template">
    <article class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-lg transition-all duration-300 transform hover:-translate-y-1">
        <!-- Article Image -->
        <div class="relative h-48 bg-gradient-to-br from-green-400 to-blue-500 overflow-hidden">
            @if (isset($post['gambar']) && $post['gambar'])
                <img src="{{ AmbilFotoArtikel($post['gambar'], 'sedang') }}" 
                     alt="{{ $post['judul'] }}" 
                     class="w-full h-full object-cover"
                     loading="lazy"
                     onerror="this.parentElement.innerHTML='<div class=\'w-full h-full bg-gradient-to-br from-green-400 to-blue-500 flex items-center justify-center\'><svg class=\'w-12 h-12 text-white opacity-70\' fill=\'currentColor\' viewBox=\'0 0 20 20\'><path fill-rule=\'evenodd\' d=\'M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm12 12H4l4-8 3 6 2-4 3 6z\' clip-rule=\'evenodd\'></path></svg></div>'">
            @else
                <div class="w-full h-full bg-gradient-to-br from-green-400 to-blue-500 flex items-center justify-center">
                    <svg class="w-12 h-12 text-white opacity-70" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm12 12H4l4-8 3 6 2-4 3 6z" clip-rule="evenodd"></path>
                    </svg>
                </div>
            @endif
            
            <!-- Category Badge -->
            @if (isset($post['kategori']) && $post['kategori'])
                <div class="absolute top-3 left-3">
                    <span class="inline-block px-2 py-1 text-xs font-medium bg-white/90 text-gray-800 rounded-full backdrop-blur-sm">
                        {{ ucfirst($post['kategori']) }}
                    </span>
                </div>
            @endif
        </div>

        <!-- Article Content -->
        <div class="p-5">
            <!-- Date and Author -->
            <div class="flex items-center text-xs text-gray-500 mb-3">
                <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"></path>
                </svg>
                <span>{{ tgl_indo($post['tgl_upload']) }}</span>
                @if (isset($post['owner']) && $post['owner'])
                    <span class="mx-1">•</span>
                    <span>{{ $post['owner'] }}</span>
                @endif
            </div>

            <!-- Title -->
            <h3 class="font-bold text-gray-900 mb-3 leading-tight line-clamp-2">
                <a href="{{ ci_route('artikel.' . $post['id'] . '.' . $post['slug']) }}" 
                   class="hover:text-green-600 transition-colors">
                    {{ $post['judul'] }}
                </a>
            </h3>

            <!-- Excerpt -->
            <p class="text-sm text-gray-600 mb-4 line-clamp-3 leading-relaxed">
                {{ strip_tags(potong_teks($post['isi'], 120)) }}
            </p>

            <!-- Read More Button -->
            <div class="flex items-center justify-between">
                <a href="{{ ci_route('artikel.' . $post['id'] . '.' . $post['slug']) }}" 
                   class="inline-flex items-center text-sm font-medium text-green-600 hover:text-green-700 transition-colors group">
                    Baca Selengkapnya
                    <svg class="w-4 h-4 ml-1 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                </a>

                <!-- Share Button -->
                <button onclick="shareArticle('{{ $post['judul'] }}', '{{ ci_route('artikel.' . $post['id'] . '.' . $post['slug']) }}')" 
                        class="p-2 text-gray-400 hover:text-green-600 transition-colors rounded-full hover:bg-green-50">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.367 2.684 3 3 0 00-5.367-2.684z"></path>
                    </svg>
                </button>
            </div>
        </div>
    </article>
</script>