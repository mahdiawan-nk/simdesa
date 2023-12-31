<?php $urlassets = $this->config->item('asset-admin') ?>
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="card mb-4">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Form Tambah Berita</h5>
            <small class="text-muted float-end">Form Tambah Berita</small>
        </div>
        <div class="card-body row justify-content-center">
            <div class="col-sm-6 ">
                <form method="post" action="<?=base_url('panel-admin/menu/save')?>">
                    <div class="row mb-3">
                        <label class="col-sm-3 col-form-label" for="basic-default-name">Nama Menu</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="basic-default-name" name="nama_menu" required>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-sm-3 col-form-label" for="basic-default-company">Is Dinamic Pages</label>
                        <div class="col-sm-2">
                            <div class="form-check">
                                <input name="dinamic_pages" class="form-check-input" type="radio" value="Y" id="defaultRadio1" required>
                                <label class="form-check-label" for="defaultRadio1"> Yes </label>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-check">
                                <input name="dinamic_pages" class="form-check-input" type="radio" value="N" id="defaultRadio1" required>
                                <label class="form-check-label" for="defaultRadio1"> No </label>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-sm-3 col-form-label" for="basic-default-company">Link Menu</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="basic-default-company" name="link_menu" required>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-sm-3 col-form-label" for="basic-default-company">Urutan Menu</label>
                        <div class="col-sm-9">
                            <input type="number" class="form-control" id="basic-default-company" name="urut" required >
                        </div>
                    </div>
                    <div class="row justify-content-end">
                        <div class="col-sm-9">
                            <button type="submit" class="btn btn-primary">Send</button>
                            <a href="<?=base_url('panel-admin/menu')?>" class="btn btn-secondary">Batal</a>
                        </div>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>