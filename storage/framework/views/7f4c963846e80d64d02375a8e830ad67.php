<form id="validasi" action="<?php echo e($form_action); ?>" method="POST" enctype="multipart/form-data">
    <div class="modal-body">
        <div class="form-group">
            <label for="judul">Judul</label>
            <input
                type="text"
                class="form-control input-sm required"
                id="judul"
                name="judul"
                value="<?php echo e($main->judul); ?>"
                placeholder="Judul"
                <?= ($main->kirim) ? 'disabled' : ''; ?>
            />
        </div>

        <div class="form-group">
            <label for="tahun">Tahun</label>
            <input
                type="number"
                class="form-control input-sm required"
                id="tahun"
                name="tahun"
                value="<?php echo e($main->tahun); ?>"
                placeholder="Tahun"
                <?= ($main->kirim) ? 'disabled' : ''; ?>
                min="1945"
                max="2030"
            />
        </div>

        <div class="form-group">
            <label for="semester">Semester</label>
            <select class="form-control input-sm select2 required" id="semester" name="semester" <?= ($main->kirim) ? 'disabled' : ''; ?>>
                <option value="1" <?= (1 == $main->semester) ? 'selected' : ''; ?>>1</option>
                <option value="2" <?= (2 == $main->semester) ? 'selected' : ''; ?>>2</option>
            </select>
        </div>

        <div class="form-group">
            <label for="file">File : <code>(.pdf)</code></label>
            <div class="input-group input-group-sm">
                <input type="text" class="form-control" id="file_path" name="satuan">
                <input type="file" class="hidden <?php if(!$main): ?> <?php echo e('required'); ?> <?php endif; ?>" id="file" name="nama_file" accept=".pdf" />
                <span class="input-group-btn">
                    <button type="button" class="btn btn-info" id="file_browser"><i class="fa fa-search"></i> Browse</button>
                </span>
            </div>
            <span class="help-block"><code>Kosongkan jika tidak ingin mengubah dokumen. Ukuran maksimal <strong><?php echo e(max_upload()); ?> MB</strong>.</code></span>
        </div>
    </div>

    <div class="modal-footer">
        <?php echo batal(); ?>

        <button type="submit" class="btn btn-social btn-info btn-sm" id="aksi"><i class="fa fa-check"></i> Simpan</button>
    </div>
</form>
<?php echo $__env->make('admin.layouts.components.validasi_form', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php /**PATH /Users/akmalfadli/Developer/desa-digital/wiradesa/resources/views/admin/opendk/form_laporan_apbdes.blade.php ENDPATH**/ ?>