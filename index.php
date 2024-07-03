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
                <div class="row">
                    <div class="col-12">
                        <h4 class="mb-5">List Sales</h4>
                        <form method="GET" action="">
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label for="search_produk">Cari Nama Produk:</label>
                                        <input type="text" class="form-control" id="search_produk" name="search_produk" placeholder="Masukkan nama produk">
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label for="search_sales">Cari Nama Sales:</label>
                                        <input type="text" class="form-control" id="search_sales" name="search_sales" placeholder="Masukkan nama sales">
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label for="search_bulan">Cari Berdasarkan Bulan:</label>
                                        <input type="month" class="form-control" id="search_bulan" name="search_bulan">
                                    </div>
                                </div>
                                <div class="col">
                                    <button type="submit" class="btn btn-primary mt-4">Cari</button>
                                </div>
                            </div>
                        </form>

                        <div class="container mt-5">
                            <table class="table table-bordered rounded">
                                <thead class="table-primary">
                                    <tr>
                                        <th scope="col">No</th>
                                        <th scope="col">ID Input</th>
                                        <th scope="col">Tanggal</th>
                                        <th scope="col">Sales</th>
                                        <th scope="col">Produk</th>
                                        <th scope="col">Nama Leads</th>
                                        <th scope="col">No Wa</th>
                                        <th scope="col">Kota</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    include 'dbconn.php';

                                    $sql = "SELECT leads.id, leads.tanggal, sales.nama_sales, produk.nama_produk, leads.nama_lead, leads.no_wa, leads.kota 
                                            FROM leads 
                                            INNER JOIN sales ON leads.id_sales = sales.id 
                                            INNER JOIN produk ON leads.id_produk = produk.id";

                                    // Filter berdasarkan pencarian nama produk
                                    if (isset($_GET['search_produk']) && !empty($_GET['search_produk'])) {
                                        $search_produk = $_GET['search_produk'];
                                        $sql .= " WHERE produk.nama_produk LIKE '%$search_produk%'";
                                    }

                                    // Filter berdasarkan pencarian nama sales
                                    if (isset($_GET['search_sales']) && !empty($_GET['search_sales'])) {
                                        $search_sales = $_GET['search_sales'];
                                        if (strpos($sql, 'WHERE') !== false) {
                                            $sql .= " AND sales.nama_sales LIKE '%$search_sales%'";
                                        } else {
                                            $sql .= " WHERE sales.nama_sales LIKE '%$search_sales%'";
                                        }
                                    }

                                    // Filter berdasarkan pencarian bulan
                                    if (isset($_GET['search_bulan']) && !empty($_GET['search_bulan'])) {
                                        $search_bulan = $_GET['search_bulan'];
                                        $bulan = date('m', strtotime($search_bulan));
                                        $tahun = date('Y', strtotime($search_bulan));
                                        if (strpos($sql, 'WHERE') !== false) {
                                            $sql .= " AND MONTH(leads.tanggal) = $bulan AND YEAR(leads.tanggal) = $tahun";
                                        } else {
                                            $sql .= " WHERE MONTH(leads.tanggal) = $bulan AND YEAR(leads.tanggal) = $tahun";
                                        }
                                    }

                                    $result = $conn->query($sql);

                                    if ($result->num_rows > 0) {
                                        $no = 1;
                                        while ($row = $result->fetch_assoc()) {
                                            echo "<tr>";
                                            echo "<td>" . $no++ . "</td>";
                                            echo "<td>" . $row['id'] . "</td>";
                                            echo "<td>" . $row['tanggal'] . "</td>";
                                            echo "<td>" . $row['nama_sales'] . "</td>";
                                            echo "<td>" . $row['nama_produk'] . "</td>";
                                            echo "<td>" . $row['nama_lead'] . "</td>";
                                            echo "<td>" . $row['no_wa'] . "</td>";
                                            echo "<td>" . $row['kota'] . "</td>";
                                            echo "</tr>";
                                        }
                                    } else {
                                        echo "<tr><td colspan='8'>Tidak ada data</td></tr>";
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </main>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>