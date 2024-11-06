<?php

require __DIR__ . "/controller/get_all_data.php";
$result = getAllData();

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Peminjaman Perpustakaan</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
    <main class="container">
        <h1 class="fw-bold">Sistem Peminjaman Buku Perpustakaan</h1>
        <br><br>
        <button type="button" class="btn btn-primary">Buat Peminjaman Baru</button>
        <br><br>
        <table class="table">
            <thead>
                <tr>
                    <th>ID Peminjaman</th>
                    <th>Peminjam</th>
                    <th>Buku yang dipinjam</th>
                    <th>Waktu pengembalian</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($result as $key => $row) { ?>
                    <tr>
                        <td class="id-peminjaman-col"><?php echo $row['id'] ?></td>
                        <td class="peminjam-col"><?php echo $row['nama'] ?></td>
                        <td class="buku-dipinjam-col"><?php echo $row['judul'] ?></td>
                        <td class="pengembalian-col"><?php echo $row['waktu_pengembalian'] ?></td>
                        <td class="aksi-col">
                            <button 
                                class="edit-btn btn btn-success" 
                                data-bs-toggle="modal"
                                data-bs-target="#edit-modal"
                            >Edit
                            </button>
                            <button 
                                class="delete-btn btn btn-danger"
                                data-bs-toggle="modal"
                                data-bs-target="#delete-modal"
                            >Hapus
                            </button>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </main>


    <!-- BOOTSTRAP MODAL -->
    <div class="modal fade" id="delete-modal" tabindex="-1" aria-labelledby="delete-modal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="delete-modal-title">Konfirmasi Hapus data</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-center">
                    <p>Apakah anda yakin ingin menghapus data ini?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" id="konfirmasi-delete-data-btn" class="btn btn-danger">Iya</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batalkan</button>
                </div>
            </div>
        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.min.js"></script>
    <script>
        $(document).ready(() => {
            let idDataTerpilih = -1

            $('.delete-btn').click(function() {
                idDataTerpilih = parseInt($(this).closest('tr').find('.id-peminjaman-col').text(), 10)
            })

            $('#konfirmasi-delete-data-btn').click(function() {
                $.ajax({
                    url: 'controller/hapus_data.php',
                    type: 'DELETE',
                    data: JSON.stringify({ id: idDataTerpilih }),
                    success: function(response) {
                        console.log('Delete successful:', response);
                        location.reload()
                    },
                    error: function(xhr, status, error) {
                        console.error('Error:', status, error);
                    }
                })
            })
        })
    </script>
</body>

</html>