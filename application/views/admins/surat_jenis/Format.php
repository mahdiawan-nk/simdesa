<div class="container-xxl flex-grow-1 container-p-y">
    <div class="card">

        <div class="card-header">
            <h5 class="card-title">Data Fields Form </h5>
            <button class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#backDropModal">Tambah Fields Form</button>
        </div>
        <div class="card-body">
            <div class="table-responsive text-nowrap">
                <table class="table" id="table-data">
                    <thead class="table-dark">
                        <tr>
                            <th>No</th>
                            <th>Type</th>
                            <th>data</th>
                            <th>Act</th>
                        </tr>
                    </thead>
                    <tbody class="table-border">
                    <?php foreach ($data as $key => $item) : ?>
                            <?php $item = (object)$item ?>
                            <?php foreach ($item as $items) : ?>
                            <tr>
                                <td><?= $key + 1 ?></td>
                                <td><?= $items->type ?></td>
                                <td>
                                    <?= json_encode($items)?>
                                </td>
                                <td>
                                    <button class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#update-<?= $key ?>">Edit</button>
                                    <button class="btn btn-sm btn-danger" data-toggle="modal" data-target="#delete-<?= $key ?>">Hapus</button>
                                </td>
                            </tr>

                        <?php endforeach ?>
                        <?php endforeach ?>

                    </tbody>
                </table>
            </div>
        </div>

    </div>
</div>