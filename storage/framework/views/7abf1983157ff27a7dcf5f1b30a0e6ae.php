<div class="tab-pane active">
    <div class="row" id="list-paket">
        <?php echo form_open(ci_route('plugin.hapus'), 'id="mainform" name="mainform"'); ?>

        <input type="hidden" name="name" value="">
        <?php if(!$paket_terpasang): ?>
            <div class="col-md-12">
                <div class="alert alert-warning">Belum ada paket yang terpasang</div>
            </div>
        <?php endif; ?>
        </form>
    </div>
</div>
<?php $__env->startPush('scripts'); ?>
    <script>
        $(function() {
            let paketTerpasang = <?php echo $paket_terpasang; ?>


            function loadModule() {
                let cardView = [],
                    disabledPaket, buttonInstall, versionCheck, templateTmp
                let urlModule = '<?php echo e($url_marketplace); ?>'
                const templateCard = `<?php echo $__env->make('admin.plugin.item', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>`

                $.ajax({
                    url: urlModule,
                    data: {
                        per_page: 10000,
                        list_module: paketTerpasang
                    },
                    type: 'GET',
                    contentType: 'application/json',
                    headers: {
                        'Authorization': 'Bearer <?php echo e($token_layanan); ?>',
                        'Accept': 'application/json'
                    },
                    error: function(response) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal Memuat Data',
                            text: response.responseJSON.message
                        })
                    },
                    success: function(response) {
                        const data = response.data
                        for (let i in data) {
                            templateTmp = templateCard
                            disabledPaket = ''
                            buttonInstall = `<button type="button" name="pasang" value="${data[i].name}" class="btn btn-danger">Hapus</button>`

                            templateTmp = templateTmp.replace('__name__', data[i].name)
                            templateTmp = templateTmp.replace('__description__', data[i].description)
                            templateTmp = templateTmp.replace('__button__', buttonInstall)
                            templateTmp = templateTmp.replace('__thumbnail__', data[i].thumbnail)
                            templateTmp = templateTmp.replace('__price__', data[i].price)
                            templateTmp = templateTmp.replace('__totalInstall__', data[i].totalInstall)
                            cardView.push(templateTmp)
                        }

                        $('#mainform').append(cardView.join(''))
                        $('#mainform button:button').click(function(e) {
                            e.preventDefault();

                            Swal.fire({
                                title: 'Apakah anda sudah melakukan backup database dan folder desa ?',
                                showDenyButton: true,
                                confirmButtonText: 'Sudah',
                                denyButtonText: `Belum`,
                            }).then((result) => {
                                /* Read more about isConfirmed, isDenied below */
                                if (result.isConfirmed) {
                                    Swal.fire({
                                        title: 'Sedang Memproses',
                                        allowOutsideClick: false,
                                        allowEscapeKey: false,
                                        showConfirmButton: false,
                                        didOpen: () => {
                                            Swal.showLoading()
                                        }
                                    });
                                    // csrf tidak sama, coba update manual saja
                                    $(e.currentTarget).closest('form').find('input[name=sidcsrf]').val(getCsrfToken())
                                    $(e.currentTarget).closest('form').find('input[name=name]').val($(e.currentTarget).val())
                                    $(e.currentTarget).closest('form').submit()
                                }
                            })
                        })
                    }
                })
            }

            if (paketTerpasang) {
                loadModule()
            }
        })
    </script>
<?php $__env->stopPush(); ?>
<?php /**PATH /Users/akmalfadli/Developer/desa-digital/wiradesa/resources/views/admin/plugin/paket_terinstall.blade.php ENDPATH**/ ?>