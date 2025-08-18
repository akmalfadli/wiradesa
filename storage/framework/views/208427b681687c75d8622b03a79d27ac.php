<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>

<div class="box box-primary box-solid items-center">
        <div class="bg-green-600 flex items-center justify-center py-3 px-6 mb-1">
            <h3 class="text-md font-semibold text-white text-center">
                <?php echo e(strtoupper($judul_widget)); ?>

            </h3>
        </div>
        <div class="h-1 bg-green-500 mb-2"></div>

    
    <!-- Single Column Layout -->
    <div class="space-y-6">
        <!-- Interactive Map -->
        <div class="w-full h-80 bg-gradient-to-br from-primary-100 to-primary-200 rounded-xl overflow-hidden relative">
            <!-- Map Container -->
            <div id="map_canvas" class="w-full h-full"></div>

            <div class="absolute bottom-4 right-4 bg-white p-3 rounded-lg shadow-lg z-[9999] pointer-events-auto">
                <div class="flex items-center gap-2">
                    <div class="bg-green-100 rounded-full p-1">
                        <i data-lucide="users" class="h-5 w-5 text-green-700"></i>
                    </div>
                    <div>
                        <a href="https://www.openstreetmap.org/#map=15/<?php echo e($data_config['lat']); ?>/<?php echo e($data_config['lng']); ?>" target="_blank" class="text-xs font-bold">Kantor <?php echo e(ucwords(setting('sebutan_desa'))); ?> <?php echo e($desa['nama_desa']); ?></a>
                        <p class="text-xs text-gray-500"><?php echo e($desa['alamat_kantor']); ?></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<style>
    #map_canvas {
        width: 100%;
        height: 100%;
    }
</style>


<script>
    // Jika posisi kantor desa belum ada, tampilkan seluruh Indonesia
    <?php if(!empty($data_config['lat']) && !empty($data_config['lng'])): ?>
        var posisi = [<?php echo e($data_config['lat']); ?>, <?php echo e($data_config['lng']); ?>];
        var zoom = <?php echo e($data_config['zoom'] ?: 10); ?>;
    <?php else: ?>
        var posisi = [-7.3983118, 109.5432662]; // default center (e.g., Central Java)
        var zoom = 15; // zoom out to see Indonesia
    <?php endif; ?>

    var options = {
        maxZoom: <?php echo e(setting('max_zoom_peta')); ?>,
        minZoom: <?php echo e(setting('min_zoom_peta')); ?>,
    };

    // Init map
    var lokasi_kantor = L.map('map_canvas', options).setView(posisi, zoom);

    // Base layer (OpenStreetMap)
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; OpenStreetMap contributors'
    }).addTo(lokasi_kantor);

    // Add marker if location is set

    L.marker(posisi).addTo(lokasi_kantor)
        .bindPopup("Kantor Desa Timbang")
        .openPopup();
</script>
<?php /**PATH /Users/akmalfadli/Developer/desa-digital/wiradesa//desa/themes/perwira/resources/views/widgets/peta_lokasi_kantor.blade.php ENDPATH**/ ?>