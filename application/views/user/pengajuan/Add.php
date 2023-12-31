<div class="container-xxl flex-grow-1 container-p-y">
    <div class="card">
        <div class="card-header">
            <h5 class="card-title">Form Pengajuan <?= $surat->nama_surat ?></h5>
        </div>
        <div class="card-body">
            <form method="post" action="<?= base_url('suratuser/save/' . $surat->slug) ?>" enctype="multipart/form-data">
                <input type="hidden" value="<?= $metadata->id_metadata ?>" name="id_metadata">
                <input type="hidden" value="<?= $surat->id_surat_jenis ?>" name="id_surat">
                <?php foreach ($metadata->fields as $field) : ?>
                    <div class="mb-3">
                        <label class="form-label d-block" for="basic-default-fullname"><?= $field->label ?></label>
                        <?php switch ($field->type) {
                            case 'select':
                                $opsi = '';
                                foreach ($field->options as $item) {
                                    $opsi = $opsi . '<option value="' . $item . '">' . $item . '</option>';
                                }
                                $select = '<select class="form-select" id="exampleFormControlSelect1" aria-label="" name="' . $field->name . '" required>' . $opsi . '</select>';
                                echo $select;
                                break;
                            case 'radio':
                                $radio = '';
                                foreach ($field->options as $key => $item) {
                                    $radio = $radio . '<div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="' . $field->name . '" id="inlineRadio' . $key . '" value="' . $item . '" required>
                                        <label class="form-check-label" for="inlineRadio' . $key . '">' . $item . '</label>
                                    </div>';
                                }

                                echo $radio;
                                break;
                            case 'textarea':
                                echo '<textarea id="basic-default-message" class="form-control" name="' . $field->name . '" required></textarea>';
                                break;
                            case 'date':
                                echo '<input type="date" class="form-control" id="basic-default-fullname" name="' . $field->name . '" required>';
                                break;
                            default:
                                echo '<input type="text" class="form-control" id="basic-default-fullname" name="' . $field->name . '" required>';
                                break;
                        } ?>

                    </div>
                <?php endforeach ?>
                <div class="divider">
                    <div class="divider-text">Upload File Persyaratan</div>
                </div>
                <?php foreach($syarat as $list): ?>
                <div class="mb-3">
                    <label for="formFile" class="form-label"><?=$list->nama_syarat?></label>
                    <input class="form-control" type="file" id="formFile" name="files[][<?=$list->id_syarat_surat?>]">
                </div>
                <?php endforeach ?>
                <button type="submit" class="btn btn-primary">Send</button>
                <a href="<?= base_url('panel-user/surat') ?>" class="btn btn-secondary">Cancel</a>
            </form>
        </div>
    </div>
</div>