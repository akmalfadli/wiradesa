<div class="box box-primary box-solid items-center">
    <div class="bg-green-600 flex items-center justify-center py-3 px-6 mb-1">
        <h3 class="text-md font-semibold text-white text-center">
            <?php echo e(strtoupper($judul_widget)); ?>

        </h3>
    </div>
    <div class="h-1 bg-green-500 mb-2"></div>
    <p class="text-sm text-gray-600 mb-6 leading-relaxed text-center">
        Aparatur desa memiliki peran penting dalam melaksanakan berbagai tugas dan tanggung jawab mereka.
    </p>
    
    <?php if(isset($aparatur_desa['daftar_perangkat']) && count($aparatur_desa['daftar_perangkat']) > 0): ?>
        <!-- Carousel Container -->
        <div class="relative mb-6">
            <div class="overflow-hidden rounded-2xl">
                <div id="aparatur-carousel" class="flex transition-transform duration-500 ease-in-out">
                    <?php $__currentLoopData = $aparatur_desa['daftar_perangkat']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="w-full flex-shrink-0 px-4" data-slide="<?php echo e($index); ?>">
                            <div class="text-center">
                                <!-- Photo -->
                                <div class="w-32 h-32 bg-gradient-to-br from-primary-100 to-primary-200 rounded-3xl mx-auto mb-4 overflow-hidden relative">
                                    <?php if(!empty($data['foto'])): ?>
                                        <img src="<?php echo e($data['foto']); ?>" 
                                             alt="<?php echo e($data['nama']); ?>" 
                                             class="w-full h-full object-cover object-center"
                                             onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
                                        <!-- Fallback when image fails -->
                                        <div class="w-full h-full bg-primary-200 flex items-center justify-center" style="display: none;">
                                            <i data-lucide="user" class="w-16 h-16 text-primary-600"></i>
                                        </div>
                                    <?php else: ?>
                                        <!-- Default avatar when no photo -->
                                        <div class="w-full h-full bg-primary-200 flex items-center justify-center">
                                            <i data-lucide="user" class="w-16 h-16 text-primary-600"></i>
                                        </div>
                                    <?php endif; ?>
                                    
                                    
                                    <?php if($data['kehadiran'] == 1): ?>
                                        <?php if($data['status_kehadiran'] == 'hadir'): ?>
                                            <div class="absolute top-2 right-2 w-6 h-6 bg-green-500 rounded-full flex items-center justify-center">
                                                <i data-lucide="check" class="w-4 h-4 text-white"></i>
                                            </div>
                                        <?php elseif($data['tanggal'] == date('Y-m-d') && $data['status_kehadiran'] != 'hadir'): ?>
                                            <div class="absolute top-2 right-2 w-6 h-6 bg-red-500 rounded-full flex items-center justify-center">
                                                <i data-lucide="x" class="w-4 h-4 text-white"></i>
                                            </div>
                                        <?php elseif($data['tanggal'] != date('Y-m-d')): ?>
                                            <div class="absolute top-2 right-2 w-6 h-6 bg-gray-400 rounded-full flex items-center justify-center">
                                                <i data-lucide="clock" class="w-4 h-4 text-white"></i>
                                            </div>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                </div>
                                
                                <!-- Information -->
                                <?php if(getWidgetSetting('aparatur_desa', 'overlay') == true): ?>
                                    <div class="space-y-2 text-center">
                                        <h4 class="text-lg font-semibold text-gray-900"><?php echo e($data['nama']); ?></h4>
                                        <p class="text-sm text-gray-600"><?php echo e($data['jabatan']); ?></p>
                                        
                                        <?php if($data['pamong_niap']): ?>
                                            <p class="text-sm text-gray-500"><?php echo e(setting('sebutan_nip_desa')); ?>: <?php echo e($data['pamong_niap']); ?></p>
                                        <?php endif; ?>
                                        
                                        
                                        <?php if($data['kehadiran'] == 1): ?>
                                            <div class="mt-3">
                                                <?php if($data['status_kehadiran'] == 'hadir'): ?>
                                                    <span class="inline-block px-4 py-2 bg-green-100 text-green-700 text-sm rounded-full font-medium">
                                                        Hadir
                                                    </span>
                                                <?php elseif($data['tanggal'] == date('Y-m-d') && $data['status_kehadiran'] != 'hadir'): ?>
                                                    <span class="inline-block px-4 py-2 bg-red-100 text-red-700 text-sm rounded-full font-medium">
                                                        <?php echo e(ucwords($data['status_kehadiran'])); ?>

                                                    </span>
                                                <?php elseif($data['tanggal'] != date('Y-m-d')): ?>
                                                    <span class="inline-block px-4 py-2 bg-red-100 text-red-700 text-sm rounded-full font-medium">
                                                        Belum Rekam Kehadiran
                                                    </span>
                                                <?php endif; ?>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                <?php else: ?>
                                    <!-- Simple view without overlay -->
                                    <div class="space-y-1 text-center">
                                        <h4 class="text-lg font-semibold text-gray-900"><?php echo e($data['nama']); ?></h4>
                                        <p class="text-sm text-gray-600"><?php echo e($data['jabatan']); ?></p>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
            
            <!-- Navigation Arrows -->
            <?php if(count($aparatur_desa['daftar_perangkat']) > 1): ?>
                <button onclick="previousSlide()" 
                        class="absolute left-2 top-1/2 transform -translate-y-1/2 w-10 h-10 bg-white rounded-full shadow-lg flex items-center justify-center hover:bg-gray-50 transition-colors">
                    <i data-lucide="chevron-left" class="w-5 h-5 text-gray-600"></i>
                </button>
                
                <button onclick="nextSlide()" 
                        class="absolute right-2 top-1/2 transform -translate-y-1/2 w-10 h-10 bg-white rounded-full shadow-lg flex items-center justify-center hover:bg-gray-50 transition-colors">
                    <i data-lucide="chevron-right" class="w-5 h-5 text-gray-600"></i>
                </button>
            <?php endif; ?>
        </div>
        
        <!-- Dots Indicator -->
        <?php if(count($aparatur_desa['daftar_perangkat']) > 1): ?>
            <div class="flex justify-center space-x-2 mb-6">
                <?php $__currentLoopData = $aparatur_desa['daftar_perangkat']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <button onclick="goToSlide(<?php echo e($index); ?>)" 
                            class="dot w-3 h-3 rounded-full transition-colors <?php echo e($index == 0 ? 'bg-primary-700' : 'bg-gray-300'); ?>"
                            data-dot="<?php echo e($index); ?>">
                    </button>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        <?php endif; ?>
    
    <?php else: ?>
        
        <div class="text-center py-8">
            <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                <i data-lucide="users" class="w-8 h-8 text-gray-400"></i>
            </div>
            <h4 class="text-lg font-medium text-gray-900 mb-2">Belum Ada Data Aparatur</h4>
            <p class="text-gray-600">Data aparatur desa belum tersedia.</p>
        </div>
    <?php endif; ?>
</div>

<script>
let currentSlide = 0;
const totalSlides = <?php echo e(isset($aparatur_desa['daftar_perangkat']) ? count($aparatur_desa['daftar_perangkat']) : 0); ?>;

function updateCarousel() {
    const carousel = document.getElementById('aparatur-carousel');
    const dots = document.querySelectorAll('.dot');
    
    if (carousel && totalSlides > 0) {
        const translateX = -currentSlide * 100;
        carousel.style.transform = `translateX(${translateX}%)`;
        
        // Update dots
        dots.forEach((dot, index) => {
            if (index === currentSlide) {
                dot.classList.remove('bg-gray-300');
                dot.classList.add('bg-primary-700');
            } else {
                dot.classList.remove('bg-primary-700');
                dot.classList.add('bg-gray-300');
            }
        });
    }
}

function nextSlide() {
    if (totalSlides > 0) {
        currentSlide = (currentSlide + 1) % totalSlides;
        updateCarousel();
    }
}

function previousSlide() {
    if (totalSlides > 0) {
        currentSlide = (currentSlide - 1 + totalSlides) % totalSlides;
        updateCarousel();
    }
}

function goToSlide(index) {
    if (totalSlides > 0 && index >= 0 && index < totalSlides) {
        currentSlide = index;
        updateCarousel();
    }
}

// Auto-advance carousel every 5 seconds
let autoSlideInterval;
function startAutoSlide() {
    if (totalSlides > 1) {
        autoSlideInterval = setInterval(nextSlide, 5000);
    }
}

function stopAutoSlide() {
    clearInterval(autoSlideInterval);
}

// Initialize carousel when page loads
document.addEventListener('DOMContentLoaded', function() {
    updateCarousel();
    startAutoSlide();
    
    // Pause auto-slide on hover
    const carouselContainer = document.querySelector('.relative.mb-6');
    if (carouselContainer) {
        carouselContainer.addEventListener('mouseenter', stopAutoSlide);
        carouselContainer.addEventListener('mouseleave', startAutoSlide);
    }
});

// Touch/swipe support for mobile
let startX = 0;
let currentX = 0;
let isDragging = false;

document.addEventListener('touchstart', function(e) {
    startX = e.touches[0].clientX;
    isDragging = true;
    stopAutoSlide();
});

document.addEventListener('touchmove', function(e) {
    if (!isDragging) return;
    currentX = e.touches[0].clientX;
});

document.addEventListener('touchend', function(e) {
    if (!isDragging) return;
    isDragging = false;
    
    const diffX = startX - currentX;
    
    if (Math.abs(diffX) > 50) { // Minimum swipe distance
        if (diffX > 0) {
            nextSlide();
        } else {
            previousSlide();
        }
    }
    
    startAutoSlide();
});
</script><?php /**PATH /Users/akmalfadli/Developer/desa-digital/wiradesa//storage/app/themes/perwira/resources/views/widgets/aparatur_desa.blade.php ENDPATH**/ ?>