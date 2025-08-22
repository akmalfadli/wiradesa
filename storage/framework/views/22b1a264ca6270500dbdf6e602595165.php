<!-- Breadcrumb -->
<nav class="mb-6">
    <ol class="flex items-center space-x-2 text-sm text-gray-500">
        <li><a href="<?php echo e(ci_route('')); ?>" class="hover:text-green-600 transition-colors">Beranda</a></li>
        <li><svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path></svg></li>
        <li class="text-gray-900 font-medium">Data Statistik</li>
    </ol>
</nav>

<!-- Header Section -->
<div class="p-6 md:p-8 mb-8">
    <h1 class="text-2xl md:text-3xl font-bold mb-2"><?php echo e($judul); ?></h1>
    <p class=" text-sm md:text-base">Analisis data statistik terkini untuk pengambilan keputusan yang lebih baik</p>
</div>

<!-- Year Filter -->
<?php if(isset($list_tahun)): ?>
<div class="bg-white  shadow-sm border border-gray-200 p-4 mb-6">
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <label for="tahun" class="text-sm font-medium text-gray-700 flex items-center">
            <svg class="w-4 h-4 mr-2 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
            </svg>
            Filter Tahun
        </label>
        <select class="px-4 py-2 border border-gray-300 rounded-xs focus:ring-2 focus:ring-green-500 focus:border-green-500 bg-white text-sm" id="tahun" name="tahun">
            <option selected="" value="">Semua Tahun</option>
            <?php $__currentLoopData = $list_tahun; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item_tahun): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option <?= ($item_tahun == $selected_tahun) ? 'selected' : ''; ?> value="<?php echo e($item_tahun); ?>"><?php echo e($item_tahun); ?></option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </select>
    </div>
</div>
<?php endif; ?>

<!-- Chart Section -->
<div class="bg-white  shadow-sm border border-gray-200 mb-8">
    <!-- Chart Header -->
    <div class="px-6 py-4 border-b border-gray-200">
        <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4">
            <h2 class="text-xl font-semibold text-gray-900 flex items-center">
                Grafik <?php echo e($heading); ?>

            </h2>
            
            <!-- Control Buttons -->
            <div class="flex flex-wrap items-center gap-2">
                <!-- Chart Type Buttons -->
                <div class="flex bg-gray-10 rounded-xs p-1">
                    <button class="btn-switch px-3 py-2 text-xs font-medium transition-all button-switch" data-type="column">
                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                        </svg>
                        Bar
                    </button>
                    <button class="btn-switch px-3 py-2 text-xs font-medium transition-all button-switch is-active" data-type="pie">
                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 3.055A9.001 9.001 0 1020.945 13H11V3.055z"></path>
                        </svg>
                        Pie
                    </button>
                </div>
                
                <!-- Action Buttons -->
                <div class="flex gap-2">
                    <a href="<?php echo e(ci_route("data-statistik.{$slug_aktif}.cetak.cetak")); ?>?tahun=<?php echo e($selected_tahun); ?>" 
                       class="inline-flex items-center px-3 py-2 bg-green-500 hover:bg-green-600 text-white text-xs font-medium rounded-md transition-colors" 
                       title="Cetak Laporan" target="_blank">
                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"></path>
                        </svg>
                        Cetak
                    </a>
                    <a href="<?php echo e(ci_route("data-statistik.{$slug_aktif}.cetak.unduh")); ?>?tahun=<?php echo e($selected_tahun); ?>" 
                       class="inline-flex items-center px-3 py-2 bg-green-500 hover:bg-green-600 text-white text-xs font-medium rounded-md transition-colors" 
                       title="Unduh Laporan" target="_blank">
                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                        Unduh
                    </a>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Chart Container -->
    <div class="p-6">
        <div id="statistics" class="min-h-[400px] flex items-center justify-center">
            <div class="text-center">
                <div class="animate-spin rounded-full h-12 w-12 border-b-2 border-green-500 mx-auto mb-4"></div>
                <p class="text-gray-500">Memuat grafik...</p>
            </div>
        </div>
    </div>
</div>

<!-- Table Section -->
<div class="bg-white  shadow-sm border border-gray-200 mb-8">
    <!-- Table Header -->
    <div class="px-6 py-4 border-b border-gray-200">
        <h2 class="text-xl font-semibold text-gray-900 flex items-center">
            <svg class="w-5 h-5 mr-2 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17V7m0 10a2 2 0 01-2 2H5a2 2 0 01-2-2V7a2 2 0 012-2h2a2 2 0 012 2m0 10a2 2 0 002 2h2a2 2 0 002-2M9 7a2 2 0 012-2h2a2 2 0 012 2m0 10V7m0 10a2 2 0 002 2h2a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
            </svg>
            Tabel <?php echo e($heading); ?>

        </h2>
    </div>
    
    <!-- Table Content -->
    <div class="overflow-x-auto">
        <table class="w-full" id="table-statistik">
            <thead class="bg-gray-50">
                <tr class="border-b border-gray-200">
                    <th rowspan="2" class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No</th>
                    <th rowspan="2" class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kelompok</th>
                    <th colspan="2" class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider border-b">Jumlah</th>
                    <th colspan="2" class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider border-b">Laki-laki</th>
                    <th colspan="2" class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider border-b">Perempuan</th>
                </tr>
                <tr class="border-b border-gray-200">
                    <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">n</th>
                    <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">%</th>
                    <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">n</th>
                    <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">%</th>
                    <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">n</th>
                    <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">%</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                <!-- Table rows will be populated by JavaScript -->
            </tbody>
        </table>
    </div>
    
    <!-- Table Footer -->
    <div class="px-6 py-4 border-t border-gray-200 bg-gray-50">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <p class="text-sm text-red-600 flex items-center">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                Diperbarui pada: <?php echo e(tgl_indo($last_update)); ?>

            </p>
            <div class="flex gap-2">
                <button class="inline-flex items-center px-4 py-2 bg-green-500 hover:bg-green-600 text-white text-sm font-medium rounded-xs transition-colors button-more" id="showData">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                    </svg>
                    Selengkapnya
                </button>
                <button id="showZero" class="inline-flex items-center px-4 py-2 bg-gray-500 hover:bg-gray-600 text-white text-sm font-medium rounded-xs transition-colors">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                    </svg>
                    Tampilkan Nol
                </button>
            </div>
        </div>
    </div>
</div>

<?php if(setting('daftar_penerima_bantuan') && $bantuan): ?>
<!-- Beneficiary List Section -->
<div class="bg-white  shadow-sm border border-gray-200">
    <!-- Section Header -->
    <div class="px-6 py-4 border-b border-gray-200">
        <h2 class="text-xl font-semibold text-gray-900 flex items-center">
            <svg class="w-5 h-5 mr-2 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
            </svg>
            Daftar <?php echo e($heading); ?>

        </h2>
    </div>
    
    <!-- Table Content -->
    <div class="overflow-x-auto">
        <table class="w-full" id="peserta_program">
            <thead class="bg-gray-50">
                <tr class="border-b border-gray-200">
                    <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No</th>
                    <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Program</th>
                    <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama Peserta</th>
                    <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Alamat</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                <!-- Table rows will be populated by JavaScript -->
            </tbody>
        </table>
    </div>
</div>

<script>
    const bantuanUrl = '<?php echo e(ci_route('internal_api.peserta_bantuan', $key)); ?>?filter[tahun]=<?php echo e($selected_tahun ?? ''); ?>'
</script>
<input id="stat" type="hidden" value="<?php echo e($key); ?>">
<?php endif; ?>

<?php $__env->startPush('styles'); ?>
<style>
    .btn-switch {
        color: #6b7280;
        background-color: transparent;
    }
    .btn-switch.is-active {
        background-color: #10b981;
        color: white;
        box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.1), 0 1px 2px 0 rgba(0, 0, 0, 0.06);
    }
    .btn-switch:hover:not(.is-active) {
        background-color: #f3f4f6;
        color: #374151;
    }
    
    .more {
        display: none;
    }
    
    .zero {
        opacity: 0.5;
    }
    
    /* Mobile responsiveness for table */
    @media (max-width: 640px) {
        .table-mobile {
            display: block;
        }
        .table-mobile thead,
        .table-mobile tbody,
        .table-mobile th,
        .table-mobile td,
        .table-mobile tr {
            display: block;
        }
        .table-mobile thead tr {
            position: absolute;
            top: -9999px;
            left: -9999px;
        }
        .table-mobile tr {
            border: 1px solid #e5e7eb;
            margin-bottom: 10px;
            padding: 10px;
            border-radius: 8px;
        }
        .table-mobile td {
            border: none;
            position: relative;
            padding-left: 50% !important;
            padding-top: 8px;
            padding-bottom: 8px;
        }
        .table-mobile td:before {
            content: attr(data-label) ": ";
            position: absolute;
            left: 6px;
            width: 45%;
            padding-right: 10px;
            white-space: nowrap;
            font-weight: 600;
            color: #374151;
        }
    }
</style>
<?php $__env->stopPush(); ?>

<?php $__env->startPush('scripts'); ?>
<script>
    let dataStats = [];
    
    $(function() {
        $.ajax({
            url: `<?php echo e(ci_route('internal_api.statistik', $key)); ?>?filter[tahun]=<?php echo e($selected_tahun ?? ''); ?>`,
            method: 'get',
            data: {},
            beforeSend: function() {
                $('#showData').hide()
            },
            success: function(json) {
                dataStats = json.data.map(item => {
                    const { id } = item;
                    const { nama, jumlah, laki, perempuan, persen, persen1, persen2 } = item.attributes;
                    return { id, nama, jumlah, laki, perempuan, persen, persen1, persen2 };
                });

                const table = document.getElementById('table-statistik')
                const tbody = table.querySelector('tbody')
                let _showBtnSelengkapnya = false
                
                // Populate table rows
                dataStats.forEach((item, index) => {
                    const row = document.createElement('tr');
                    row.className = 'hover:bg-gray-50 transition-colors';
                    
                    if (index > 11 && !['666', '777', '888'].includes(item['id'])) {
                        row.classList.add('more');
                        _showBtnSelengkapnya = true
                    }
                    
                    // Create cells with proper styling
                    const cells = [
                        { key: 'id', value: ['666', '777', '888'].includes(item['id']) ? '' : index + 1, class: 'text-center font-medium', label: 'No' },
                        { key: 'nama', value: item['nama'], class: 'text-left font-medium text-gray-900', label: 'Kelompok' },
                        { key: 'jumlah', value: item['jumlah'], class: 'text-right', label: 'Jumlah (n)' },
                        { key: 'persen', value: item['persen'], class: 'text-right', label: 'Jumlah (%)' },
                        { key: 'laki', value: item['laki'], class: 'text-right', label: 'Laki-laki (n)' },
                        { key: 'persen1', value: item['persen1'], class: 'text-right', label: 'Laki-laki (%)' },
                        { key: 'perempuan', value: item['perempuan'], class: 'text-right', label: 'Perempuan (n)' },
                        { key: 'persen2', value: item['persen2'], class: 'text-right', label: 'Perempuan (%)' }
                    ];
                    
                    cells.forEach(cellData => {
                        const cell = document.createElement('td');
                        cell.className = `px-6 py-4 whitespace-nowrap text-sm ${cellData.class}`;
                        cell.setAttribute('data-label', cellData.label);
                        cell.textContent = cellData.value;
                        
                        if (cellData.key === 'jumlah' && item[cellData.key] <= 0) {
                            if (!['666', '777', '888'].includes(item['id'])) {
                                cell.classList.add('zero');
                            }
                        }
                        
                        row.appendChild(cell);
                    });

                    tbody.appendChild(row);
                });
                
                if (_showBtnSelengkapnya) {
                    $('#showData').show()
                }
                $('#statistics').trigger('change')
            },
        })
        
        $('#tahun').change(function() {
            const current_url = window.location.href.split('?')[0]
            window.location.href = `${current_url}?tahun=${$(this).val()}`;
        })

        const _chartType = '<?php echo e($default_chart_type ?? 'pie'); ?>';

        if (_chartType == 'column') {
            setTimeout(function() {
                $('.btn-switch[data-type=column]').click()
            }, 1000)
        }
    })
</script>
<?php $__env->stopPush(); ?><?php /**PATH /Users/akmalfadli/Developer/desa-digital/wiradesa//storage/app/themes/perwira/resources/views/partials/statistik/default.blade.php ENDPATH**/ ?>