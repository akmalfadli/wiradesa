<div class="mt-16 mb-16">
    <div class="bg-gray-100 rounded-lg p-6 sm:p-6 text-center">
        
        <div class="bg-green-600 text-white py-1 px-3 sm:px-4 rounded-full inline-block mb-4 text-sm">
            Aparatur Desa
        </div>
        
        <h2 class="text-xl sm:text-2xl font-bold mb-4">Aparatur Desa</h2>
        
        <p class="text-sm text-gray-700 mb-6 max-w-2xl mx-auto px-2">
            Dalam pelaksanaannya, aparatur desa memiliki peran yang sangat penting
            dalam melaksanakan berbagai tugas dan tanggung jawab mereka.
        </p>
        
        <!-- Mobile Carousel (hidden on sm and up) -->
        <div class="block sm:hidden">
            <div class="relative overflow-hidden">
                <div class="flex transition-transform duration-300 ease-in-out" id="carousel-container">
                    <?php $__currentLoopData = $aparatur_desa['daftar_perangkat']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="w-full flex-shrink-0 px-4">
                            <div class="flex flex-col items-center">
                                <div class="w-20 h-20 rounded-full overflow-hidden border-4 border-white shadow-lg">
                                    <img src="<?php echo e($data['foto']); ?>" 
                                         alt="<?php echo e($data['nama']); ?>" 
                                         class="w-full h-full object-cover">
                                </div>
                                
                                <h3 class="font-semibold mt-3 text-base text-center leading-tight">
                                    <?php echo e($data['nama']); ?>

                                </h3>
                                
                                <p class="text-sm text-gray-600 mb-3 text-center">
                                    <?php echo e($data['jabatan']); ?>

                                </p>
                                
                                <?php if($data['kehadiran'] == 1): ?>
                                    <?php if($data['status_kehadiran'] == 'hadir'): ?>
                                        <div class="inline-flex items-center px-2 py-1 rounded-full text-xs bg-green-100 text-yellow-700">
                                        <div class="w-2 h-2 bg-green-500 rounded-full mr-2"></div>
                                            Hadir
                                        </div>
                                    <?php endif; ?>
                                    <?php if($data['tanggal'] == date('Y-m-d') && $data['status_kehadiran'] != 'hadir'): ?>
                                        <div class="inline-flex items-center px-2 py-1 rounded-full text-xs bg-green-100 text-yellow-700">
                                        <div class="w-2 h-2 bg-green-500 rounded-full mr-2"></div>
                                            <?php echo e(ucwords($data['status_kehadiran'])); ?>

                                        </div>
                                    <?php endif; ?>
                                    <?php if($data['tanggal'] != date('Y-m-d')): ?>
                                        <div class="inline-flex items-center px-2 py-1 rounded-full text-xs bg-yellow-100 text-yellow-700">
                                        <div class="w-2 h-2 bg-yellow-500 rounded-full mr-2"></div>
                                            Belum Hadir
                                        </div>
                                    <?php endif; ?>
                                <?php endif; ?>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
                
                <!-- Navigation Buttons -->
                <button class="absolute left-2 top-1/2 transform -translate-y-1/2 bg-white rounded-full p-2 shadow-lg z-10" 
                        id="prev-btn" onclick="previousSlide()">
                    <svg class="w-4 h-4 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                    </svg>
                </button>
                
                <button class="absolute right-2 top-1/2 transform -translate-y-1/2 bg-white rounded-full p-2 shadow-lg z-10" 
                        id="next-btn" onclick="nextSlide()">
                    <svg class="w-4 h-4 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                </button>
            </div>
            
            <!-- Dots Indicator -->
            <div class="flex justify-center mt-4 space-x-2" id="dots-container">
                <?php $__currentLoopData = $aparatur_desa['daftar_perangkat']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <button class="w-2 h-2 rounded-full transition-colors duration-200 <?php echo e($index === 0 ? 'bg-green-600' : 'bg-gray-300'); ?>" 
                            onclick="goToSlide(<?php echo e($index); ?>)"></button>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
        
        <!-- Desktop Grid (hidden on mobile, visible on sm and up) -->
        <div class="hidden sm:grid sm:grid-cols-3 lg:flex lg:flex-wrap lg:justify-center gap-6 lg:gap-8">
            <?php $__currentLoopData = $aparatur_desa['daftar_perangkat']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="flex flex-col items-center">
                    <div class="w-20 h-20 rounded-full overflow-hidden border-4 border-white shadow-lg">
                        <img src="<?php echo e($data['foto']); ?>" 
                             alt="<?php echo e($data['nama']); ?>" 
                             class="w-full h-full object-cover">
                    </div>
                    
                    <h3 class="font-semibold mt-2 text-base text-center leading-tight">
                        <?php echo e($data['nama']); ?>

                    </h3>
                    
                    <p class="text-xs text-gray-600 mb-2 text-center">
                        <?php echo e($data['jabatan']); ?>

                    </p>
                    
                    <?php if($data['kehadiran'] == 1): ?>
                        <?php if($data['status_kehadiran'] == 'hadir'): ?>
                            <div class="inline-flex items-center px-2 py-1 rounded-full text-xs bg-green-100 text-yellow-700">
                            <div class="w-2 h-2 bg-green-500 rounded-full mr-2"></div>
                                Hadir
                            </div>
                        <?php endif; ?>
                        <?php if($data['tanggal'] == date('Y-m-d') && $data['status_kehadiran'] != 'hadir'): ?>
                            <div class="inline-flex items-center px-2 py-1 rounded-full text-xs bg-green-100 text-yellow-700">
                            <div class="w-2 h-2 bg-green-500 rounded-full mr-2"></div>
                                <?php echo e(ucwords($data['status_kehadiran'])); ?>

                            </div>
                        <?php endif; ?>
                        <?php if($data['tanggal'] != date('Y-m-d')): ?>
                            <div class="inline-flex items-center px-2 py-1 rounded-full text-xs bg-yellow-100 text-yellow-700">
                            <div class="w-2 h-2 bg-yellow-500 rounded-full mr-2"></div>
                                Belum Hadir
                            </div>
                        <?php endif; ?>
                    <?php endif; ?>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
</div>

<script>
    let currentSlide = 0;
    const totalSlides = <?php echo e(count($aparatur_desa['daftar_perangkat'])); ?>;
    
    function updateCarousel() {
        const container = document.getElementById('carousel-container');
        const dots = document.querySelectorAll('#dots-container button');
        
        if (container) {
            container.style.transform = `translateX(-${currentSlide * 100}%)`;
        }
        
        // Update dots
        dots.forEach((dot, index) => {
            if (index === currentSlide) {
                dot.classList.remove('bg-gray-300');
                dot.classList.add('bg-green-600');
            } else {
                dot.classList.remove('bg-green-600');
                dot.classList.add('bg-gray-300');
            }
        });
    }
    
    function nextSlide() {
        currentSlide = (currentSlide + 1) % totalSlides;
        updateCarousel();
    }
    
    function previousSlide() {
        currentSlide = (currentSlide - 1 + totalSlides) % totalSlides;
        updateCarousel();
    }
    
    function goToSlide(index) {
        currentSlide = index;
        updateCarousel();
    }
    
    // Auto-play carousel (optional)
    setInterval(nextSlide, 5000); // Change slide every 5 seconds
    
    // Touch/swipe support
    let startX = 0;
    let endX = 0;
    
    document.addEventListener('touchstart', function(e) {
        if (window.innerWidth < 640) { // Only on mobile
            startX = e.changedTouches[0].screenX;
        }
    });
    
    document.addEventListener('touchend', function(e) {
        if (window.innerWidth < 640) { // Only on mobile
            endX = e.changedTouches[0].screenX;
            handleSwipe();
        }
    });
    
    function handleSwipe() {
        const threshold = 50; // Minimum swipe distance
        const diff = startX - endX;
        
        if (Math.abs(diff) > threshold) {
            if (diff > 0) {
                nextSlide(); // Swipe left - next slide
            } else {
                previousSlide(); // Swipe right - previous slide
            }
        }
    }
</script><?php /**PATH /Users/akmalfadli/Developer/desa-digital/wiradesa//storage/app/themes/perwira/resources/views/widgets/aparatur_desa_home.blade.php ENDPATH**/ ?>