<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <nav id="sidebar" class="col-md-3 col-lg-2 d-md-block bg-light sidebar">
                <div class="sidebar-sticky">
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link active" href="index.php">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="sales.php">Sales</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="produk.php">Produk</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="addlead.php">Tambah Lead</a>
                        </li>
                    </ul>
                </div>
            </nav>

            <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h1 class="h2">Selamat Datang di Tambah Leads</h1>
                </div>


                <?php
                include 'function.php';
                ?>
                <div class="row">
                    <div class="col-12">
                        <h4>Tambah Lead</h4>
                        <div class="container mt-5 border border-secondary p-4 rounded-3">
                            <form action="addlead.php" method="POST">
                                <div class="row row-cols-3 g-4">
                                    <div class="col">
                                        <label for="tanggal">Tanggal</label>
                                        <input type="date" class="form-control" name="tanggal" required>
                                    </div>
                                    <div class="col">
                                        <label for="">Sales</label>
                                        <select class="form-select" name="sales_id" required>
                                            <option selected disabled>--Pilih Sales--</option>
                                            <?php
                                            $result = getSales($conn);
                                            while ($row = $result->fetch_assoc()) {
                                                echo "<option value='" . $row['id'] . "'>" . $row['nama_sales'] . "</option>";
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="col">
                                        <label for="nama_lead">Nama Lead</label>
                                        <input type="text" class="form-control" name="nama_lead" placeholder="Nama Lead" required>
                                    </div>
                                    <div class="col">
                                        <label for="">Produk</label>
                                        <select class="form-select" name="produk_id" required>
                                            <option selected disabled>--Pilih Produk--</option>
                                            <?php
                                            $result = getProduk($conn);
                                            while ($row = $result->fetch_assoc()) {
                                                echo "<option value='" . $row['id'] . "'>" . $row['nama_produk'] . "</option>";
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="col">
                                        <label for="">No Whatsapp</label>
                                        <input type="text" class="form-control" name="no_wa" placeholder="No Whatsapp" required>
                                    </div>
                                    <div class="col">
                                        <label for="">Kota</label>
                                        <input type="text" class="form-control" name="kota" placeholder="Asal Kota" required>
                                    </div>
                                </div>
                                <div class="text-center mt-5">
                                    <button class="btn btn-primary">Simpan</button>
                                    <button class="btn border ">Cancel</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>


            </main>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>