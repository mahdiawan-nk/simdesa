<div class="container-xxl flex-grow-1 container-p-y">
    <div class="card">

        <div class="card-header">
            <h5 class="card-title">Data Pengguna </h5>
            <button class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#backDropModal">Tambah Pengguna</button>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table nowrap" id="table-data">
                    <thead class="table-dark">
                        <tr>
                            <th>No</th>
                            <th>Nama Pengguna</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Created</th>
                            <th>Status Akun</th>
                            <th>Act</th>
                        </tr>
                    </thead>
                    <tbody class="table-border">
                        <?php foreach ($data as $key => $list) : ?>
                            <tr>
                                <td><?= $key + 1 ?></td>
                                <td><?= $list->username ?></td>
                                <td><?= $list->email ?></td>
                                <td>
                                    <span class="badge bg-info" <?= $list->role == 1 ? '' : 'hidden' ?>>Administrator</span>
                                    <span class="badge bg-info" <?= $list->role == 2 ? '' : 'hidden' ?>>Kaur Pelayanan</span>
                                    <span class="badge bg-info" <?= $list->role == 3 ? '' : 'hidden' ?>>Kades</span>
                                </td>
                                <td><?= $list->created_at ?></td>
                                <td>
                                    <span class="badge bg-success" <?= $list->status_aktif == 1 ? '' : 'hidden' ?>>Aktif</span>
                                    <span class="badge bg-danger" <?= $list->status_aktif == 0 ? '' : 'hidden' ?>>Non-Aktif</span>
                                </td>
                                <td>
                                    <button type="button" class="btn btn-secondary btn-sm <?=$list->role == 1 ? 'btn-block':''?>" data-toggle="modal" data-target="#edit-<?= $list->id_admin ?>">Ubah</button>
                                    <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#delete-<?= $list->id_admin ?>" <?=$list->role == 1 ? 'hidden':''?>>Hapus</button>
                                </td>
                            </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</div>

<div class="modal fade" id="backDropModal" data-bs-backdrop="static" tabindex="-1" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <form class="modal-content" method="POST" action="<?= base_url('panel-admin/pengguna/save') ?>">
            <div class="modal-header">
                <h5 class="modal-title" id="backDropModalTitle">Tambah Pengguna</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col mb-3">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" id="username" name="username" class="form-control" placeholder="Enter Name" required>
                    </div>
                </div>
                <div class="row">
                    <div class="col mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" id="email" name="email" class="form-control" placeholder="Enter email" required>
                    </div>
                </div>
                <div class="row">
                    <div class="col mb-3">
                        <label for="password" class="form-label">Password</label>
                        <div class="input-group">
                            <input type="password" class="form-control" name="password" id="password" placeholder="············" required>
                            <span id="cp-a" class="input-group-text cursor-pointer"><i class="bx bx-hide icon-pass-a"></i></span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col mb-3">
                        <label for="confirm-password" class="form-label">Confirm Password</label>
                        <div class="input-group">
                            <input type="password" class="form-control" id="confirm-password" placeholder="············" required>
                            <span id="cp-b" class="input-group-text cursor-pointer"><i class="bx bx-hide icon-pass-b"></i></span>
                        </div>
                        <small id="passwordMessage"></small>
                    </div>
                </div>
                <div class="row">
                    <div class="col mb-3">
                        <label for="confirm-password" class="form-label d-block">Role</label>
                        <div class="form-check form-check-inline mt-3">
                            <input class="form-check-input" type="radio" name="role" id="radio-1" value="1" required>
                            <label class="form-check-label" for="radio-1">Administrator</label>
                        </div>
                        <div class="form-check form-check-inline mt-3">
                            <input class="form-check-input" type="radio" name="role" id="radio-2" value="2" required>
                            <label class="form-check-label" for="radio-2">KAUR Pelayanan</label>
                        </div>
                        <div class="form-check form-check-inline mt-3">
                            <input class="form-check-input" type="radio" name="role" id="radio-3" value="3" required>
                            <label class="form-check-label" for="radio-3">Kepala Desa</label>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col mb-3">
                        <label for="confirm-password" class="form-label d-block">Status Akun</label>
                        <div class="form-check form-check-inline mt-3">
                            <input class="form-check-input" type="radio" name="status_aktif" id="aktif" value="1" required>
                            <label class="form-check-label" for="aktif">Aktif</label>
                        </div>
                        <div class="form-check form-check-inline mt-3">
                            <input class="form-check-input" type="radio" name="status_aktif" id="noaktif" value="0" required>
                            <label class="form-check-label" for="noaktif">Non Aktif</label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                    Close
                </button>
                <button type="submit" class="btn btn-primary">Save</button>
            </div>
        </form>
    </div>
</div>

<?php foreach ($data as $key => $list) : ?>
    <div class="modal fade" id="edit-<?=$list->id_admin?>" data-bs-backdrop="static" tabindex="-1" aria-hidden="true" style="display: none;">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <form class="modal-content" method="POST" action="<?= base_url('panel-admin/pengguna/update/'.$list->id_admin) ?>">
                <div class="modal-header">
                    <h5 class="modal-title" id="edit-<?=$list->id_admin?>">Tambah Pengguna</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col mb-3">
                            <label for="username<?=$key?>" class="form-label">Username</label>
                            <input type="text" id="username<?=$key?>" name="username" class="form-control" value="<?=$list->username?>" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col mb-3">
                            <label for="email<?=$key?>" class="form-label">Email</label>
                            <input type="email" id="email<?=$key?>" name="email" class="form-control" placeholder="Enter email" required value="<?=$list->email?>">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col mb-3">
                            <label for="password<?=$key?>" class="form-label">Password</label>
                            <div class="input-group">
                                <input type="password" class="form-control password" name="password" id="password<?=$key?>" placeholder="············">
                                <span  class="input-group-text cursor-pointer cp-a"><i class="bx bx-hide icon-pass-a"></i></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col mb-3">
                            <label for="confirm-password<?=$key?>" class="form-label">Confirm Password</label>
                            <div class="input-group">
                                <input type="password" class="form-control confirm-password" id="confirm-password<?=$key?>" placeholder="············" >
                                <span class="input-group-text cursor-pointer cp-b"><i class="bx bx-hide icon-pass-b"></i></span>
                            </div>
                            <small class="password-message"></small>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col mb-3">
                            <label for="confirm-password" class="form-label d-block">Role</label>
                            <div class="form-check form-check-inline mt-3">
                                <input class="form-check-input" type="radio" name="role" id="radio-1<?=$key?>" value="1" required <?=$list->role == 1 ? 'checked':''?>>
                                <label class="form-check-label" for="radio-1<?=$key?>">Administrator</label>
                            </div>
                            <div class="form-check form-check-inline mt-3">
                                <input class="form-check-input" type="radio" name="role" id="radio-2<?=$key?>" value="2" required <?=$list->role == 2 ? 'checked':''?>>
                                <label class="form-check-label" for="radio-2">KAUR Pelayanan</label>
                            </div>
                            <div class="form-check form-check-inline mt-3">
                                <input class="form-check-input" type="radio" name="role" id="radio-3<?=$key?>" value="3" required <?=$list->role == 3 ? 'checked':''?>>
                                <label class="form-check-label" for="radio-3<?=$key?>">Kepala Desa</label>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col mb-3">
                            <label for="confirm-password" class="form-label d-block">Status Akun</label>
                            <div class="form-check form-check-inline mt-3">
                                <input class="form-check-input" type="radio" name="status_aktif" id="aktif<?=$key?>" value="1" required <?=$list->status_aktif == 1 ? 'checked':''?>>
                                <label class="form-check-label" for="aktif<?=$key?>">Aktif</label>
                            </div>
                            <div class="form-check form-check-inline mt-3">
                                <input class="form-check-input" type="radio" name="status_aktif" id="noaktif<?=$key?>" value="0" required <?=$list->status_aktif == 0 ? 'checked':''?>>
                                <label class="form-check-label" for="noaktif<?=$key?>">Non Aktif</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                        Close
                    </button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>
    <div class="modal fade" id="delete-<?= $list->id_admin ?>" data-backdrop="static" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header ">
                </div>
                <div class="modal-body text-center">
                    <h1 class="p-3">
                        <i class="fa-sharp fa-solid fa-circle-question fa-2xl text-danger"></i>
                    </h1>
                    <p>
                        Anda Yakin Menghapus Data Ini?
                    </p>
                </div>
                <div class="modal-footer" style="justify-content: space-between;">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <a href="<?= base_url('panel-admin/pengguna/delete/' . $list->id_admin) ?>" class="btn btn-primary">Hapus</a>
                </div>
            </div>
        </div>
    </div>
<?php endforeach ?>

<script>
    $(function() {
        $('#table-data').DataTable({
            responsive: true
        });
        $('#cp-a').click(function() {
            var passwordField = $('#password');
            var fieldType = passwordField.attr('type');

            if (fieldType === 'password') {
                passwordField.attr('type', 'text');
                $('.icon-pass-a').removeClass('bx-hide').addClass('bx-show')
            } else {
                passwordField.attr('type', 'password');
                $('.icon-pass-a').removeClass('bx-show').addClass('bx-hide')
            }

        });
        $('.cp-a').click(function() {
            var passwordField = $('.password');
            var fieldType = passwordField.attr('type');

            if (fieldType === 'password') {
                passwordField.attr('type', 'text');
                $('.icon-pass-a').removeClass('bx-hide').addClass('bx-show')
            } else {
                passwordField.attr('type', 'password');
                $('.icon-pass-a').removeClass('bx-show').addClass('bx-hide')
            }

        });

        $('#cp-b').click(function() {
            var passwordField = $('#confirm-password');
            var fieldType = passwordField.attr('type');

            if (fieldType === 'password') {
                passwordField.attr('type', 'text');
                $('.icon-pass-b').removeClass('bx-hide').addClass('bx-show')
            } else {
                passwordField.attr('type', 'password');
                $('.icon-pass-b').removeClass('bx-show').addClass('bx-hide')
            }

        });

        $('.cp-b').click(function() {
            var passwordField = $('.confirm-password');
            var fieldType = passwordField.attr('type');

            if (fieldType === 'password') {
                passwordField.attr('type', 'text');
                $('.icon-pass-b').removeClass('bx-hide').addClass('bx-show')
            } else {
                passwordField.attr('type', 'password');
                $('.icon-pass-b').removeClass('bx-show').addClass('bx-hide')
            }

        });
        $('#confirm-password').on('keyup', function() {
            var password1 = $('#password').val();
            var password2 = $(this).val();
            if (password2 != '') {
                if (password1 !== password2) {
                    $('#passwordMessage').text('Passwords do not match!').css('color', 'red');
                } else {
                    $('#passwordMessage').text('Passwords match.').css('color', 'green');
                }
            } else {
                $('#passwordMessage').text('')

            }

        });

        $('.confirm-password').on('keyup', function() {
            var password1 = $('.password').val();
            var password2 = $(this).val();
            if (password2 != '') {
                if (password1 !== password2) {
                    $('.password-message').text('Passwords do not match!').css('color', 'red');
                } else {
                    $('.password-message').text('Passwords match.').css('color', 'green');
                }
            } else {
                $('.password-message').text('')

            }

        });
    });
</script>