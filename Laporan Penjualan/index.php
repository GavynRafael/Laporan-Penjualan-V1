<?php
if(isset($_GET['tahun'])){
    
    $tahun = $_GET['tahun'];
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <style>
        td,
        th {
            font-size: 11px;
        }
    </style>
</head>

<body>
    <div class="container-fluid">
        <div class="card" style="margin: 2rem 0rem;">
            <div class="card-header">
                Laporan Penjualan
            </div>
            <div class="card-body">
                <form action="" method="get">
                    <div class="row">
                        <div class="col-2">
                            <div class="form-group">
                                <select id="my-select" class="form-control" name="tahun">
                                    <option value="2021" selected="">2021</option>
                                    <option value="2022">2022</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-4">
                            <button type="submit" class="btn btn-primary">
                                Tampilkan
                            </button>
                        </div>
                    </div>
                </form>
                <hr>
                <div class="table-responsive">
                    <table class="table table-hover table-bordered" style="margin: 0;">
                        <thead>
                            <tr class="table-primary">
                                <th rowspan="2" style="text-align:center;vertical-align: middle;width: 250px;">Menu</th>
                                <th colspan="12" style="text-align: center;">Laporan Periode <?= $tahun ?>
                                </th>
                                <th rowspan="2" style="text-align:center;vertical-align: middle;width:75px">Total</th>
                            </tr>
                            <tr class="table-primary">
                                <th style="text-align: center;width: 75px;">Jan</th>
                                <th style="text-align: center;width: 75px;">Feb</th>
                                <th style="text-align: center;width: 75px;">Mar</th>
                                <th style="text-align: center;width: 75px;">Apr</th>
                                <th style="text-align: center;width: 75px;">Mei</th>
                                <th style="text-align: center;width: 75px;">Jun</th>
                                <th style="text-align: center;width: 75px;">Jul</th>
                                <th style="text-align: center;width: 75px;">Ags</th>
                                <th style="text-align: center;width: 75px;">Sep</th>
                                <th style="text-align: center;width: 75px;">Okt</th>
                                <th style="text-align: center;width: 75px;">Nov</th>
                                <th style="text-align: center;width: 75px;">Des</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php 
                            $json_data = file_get_contents("menu.json");
                            $json_transaksi = file_get_contents("transaksi.json");
                            $menu = json_decode($json_data, true);
                            $transaksi = json_decode($json_transaksi, true);

                            function sumPerMenuMonth($menu, $transaksi, $tahun, $bulan){
                                for($a = 0, $z = 0; $z < count($transaksi);$z++){
                                    if($transaksi[$z]["menu"] == $menu){
                                        if($transaksi[$z]["tanggal"] == "$tahun-$bulan-01" || $transaksi[$z]["tanggal"] == "$tahun-$bulan-02" ||$transaksi[$z]["tanggal"] == "$tahun-$bulan-03" ||$transaksi[$z]["tanggal"] == "$tahun-$bulan-04" ||$transaksi[$z]["tanggal"] == "$tahun-$bulan-05" ||$transaksi[$z]["tanggal"] == "$tahun-$bulan-06" ||$transaksi[$z]["tanggal"] == "$tahun-$bulan-07" ||$transaksi[$z]["tanggal"] == "$tahun-$bulan-08" ||$transaksi[$z]["tanggal"] == "$tahun-$bulan-09" ||$transaksi[$z]["tanggal"] == "$tahun-$bulan-10" ||$transaksi[$z]["tanggal"] == "$tahun-$bulan-11" ||$transaksi[$z]["tanggal"] == "$tahun-$bulan-12" ){
                                            $a = $a + $transaksi[$z]["total"];
                                        }
                                    } 
                                }
                                return $a;
                            }
                            function sumPerMonth($transaksi, $tahun, $bulan){
                                for($a = 0, $z = 0; $z < count($transaksi);$z++){
                                        if($transaksi[$z]["tanggal"] == "$tahun-$bulan-01" || $transaksi[$z]["tanggal"] == "$tahun-$bulan-02" ||$transaksi[$z]["tanggal"] == "$tahun-$bulan-03" ||$transaksi[$z]["tanggal"] == "$tahun-$bulan-04" ||$transaksi[$z]["tanggal"] == "$tahun-$bulan-05" ||$transaksi[$z]["tanggal"] == "$tahun-$bulan-06" ||$transaksi[$z]["tanggal"] == "$tahun-$bulan-07" ||$transaksi[$z]["tanggal"] == "$tahun-$bulan-08" ||$transaksi[$z]["tanggal"] == "$tahun-$bulan-09" ||$transaksi[$z]["tanggal"] == "$tahun-$bulan-10" ||$transaksi[$z]["tanggal"] == "$tahun-$bulan-11" ||$transaksi[$z]["tanggal"] == "$tahun-$bulan-12" ){
                                            $a = $a + $transaksi[$z]["total"];
                                        }
                                }
                                return $a;
                            }
                            function sumPerMenu($menu, $transaksi){
                                for($a = 0, $z = 0; $z < count($transaksi);$z++){
                                        if($transaksi[$z]["menu"] == $menu){
                                            $a = $a + $transaksi[$z]["total"];
                                        }
                                }
                                return $a;
                            }
                            function sum($transaksi){
                                for($a = 0, $z = 0; $z < count($transaksi);$z++){
                                            $a = $a + $transaksi[$z]["total"];
                                        }
                                return $a;
                            }
                           ?>
                           <tr>
                            <td class="table-secondary" colspan="14" align = "center"><b>makanan</b></td>
                           </tr>
                           <?php
                                for($x = 0; $x < count($menu); $x++){  
                                    if($menu[$x]["kategori"]=="makanan"){
                           ?>
                           <tr>
                                <td><?=$menu[$x]["menu"]?></td>
                                <td><?php echo sumPerMenuMonth($menu[$x]["menu"], $transaksi, $tahun, "01") ?></td>
                                <td><?php echo sumPerMenuMonth($menu[$x]["menu"], $transaksi, $tahun, "02") ?></td>
                                <td><?php echo sumPerMenuMonth($menu[$x]["menu"], $transaksi, $tahun, "03") ?></td>
                                <td><?php echo sumPerMenuMonth($menu[$x]["menu"], $transaksi, $tahun, "04") ?></td>
                                <td><?php echo sumPerMenuMonth($menu[$x]["menu"], $transaksi, $tahun, "05") ?></td>
                                <td><?php echo sumPerMenuMonth($menu[$x]["menu"], $transaksi, $tahun, "06") ?></td>
                                <td><?php echo sumPerMenuMonth($menu[$x]["menu"], $transaksi, $tahun, "07") ?></td>
                                <td><?php echo sumPerMenuMonth($menu[$x]["menu"], $transaksi, $tahun, "08") ?></td>
                                <td><?php echo sumPerMenuMonth($menu[$x]["menu"], $transaksi, $tahun, "09") ?></td>
                                <td><?php echo sumPerMenuMonth($menu[$x]["menu"], $transaksi, $tahun, "10") ?></td>
                                <td><?php echo sumPerMenuMonth($menu[$x]["menu"], $transaksi, $tahun, "11") ?></td>
                                <td><?php echo sumPerMenuMonth($menu[$x]["menu"], $transaksi, $tahun, "12") ?></td>
                                <td><?php echo sumPerMenu($menu[$x]["menu"], $transaksi) ?></td>
                            </tr>
                           <?php } }?>
                           <tr>
                            <td class="table-secondary" colspan="14" align = "center"><b>minuman</b></td>
                           </tr>
                           <?php
                                for($x = 0; $x < count($menu); $x++){  
                                    if($menu[$x]["kategori"]=="minuman"){
                           ?>
                           <tr>
                                <td><?=$menu[$x]["menu"]?></td>
                                <td><?php echo sumPerMenuMonth($menu[$x]["menu"], $transaksi, $tahun, "01") ?></td>
                                <td><?php echo sumPerMenuMonth($menu[$x]["menu"], $transaksi, $tahun, "02") ?></td>
                                <td><?php echo sumPerMenuMonth($menu[$x]["menu"], $transaksi, $tahun, "03") ?></td>
                                <td><?php echo sumPerMenuMonth($menu[$x]["menu"], $transaksi, $tahun, "04") ?></td>
                                <td><?php echo sumPerMenuMonth($menu[$x]["menu"], $transaksi, $tahun, "05") ?></td>
                                <td><?php echo sumPerMenuMonth($menu[$x]["menu"], $transaksi, $tahun, "06") ?></td>
                                <td><?php echo sumPerMenuMonth($menu[$x]["menu"], $transaksi, $tahun, "07") ?></td>
                                <td><?php echo sumPerMenuMonth($menu[$x]["menu"], $transaksi, $tahun, "08") ?></td>
                                <td><?php echo sumPerMenuMonth($menu[$x]["menu"], $transaksi, $tahun, "09") ?></td>
                                <td><?php echo sumPerMenuMonth($menu[$x]["menu"], $transaksi, $tahun, "10") ?></td>
                                <td><?php echo sumPerMenuMonth($menu[$x]["menu"], $transaksi, $tahun, "11") ?></td>
                                <td><?php echo sumPerMenuMonth($menu[$x]["menu"], $transaksi, $tahun, "12") ?></td>
                                <td><?php echo sumPerMenu($menu[$x]["menu"], $transaksi) ?></td>
                            </tr>
                           <?php } }?>
                            <tr class="table-secondary">
                                <td>
                                    <b>total</b>
                                </td>
                                <td>
                                    <b><?php echo sumPerMonth($transaksi, $tahun, "01"); ?></b>     
                                </td>
                                <td>
                                    <b><?php echo sumPerMonth($transaksi, $tahun, "02"); ?></b>     
                                </td>
                                <td>
                                    <b><?php echo sumPerMonth($transaksi, $tahun, "03"); ?></b>     
                                </td>
                                <td>
                                    <b><?php echo sumPerMonth($transaksi, $tahun, "04"); ?></b>     
                                </td>
                                <td>
                                    <b><?php echo sumPerMonth($transaksi, $tahun, "05"); ?></b>     
                                </td>
                                <td>
                                    <b><?php echo sumPerMonth($transaksi, $tahun, "06"); ?></b>     
                                </td>
                                <td>
                                    <b><?php echo sumPerMonth($transaksi, $tahun, "07"); ?></b>     
                                </td>
                                <td>
                                    <b><?php echo sumPerMonth($transaksi, $tahun, "08"); ?></b>     
                                </td>
                                <td>
                                    <b><?php echo sumPerMonth($transaksi, $tahun, "09"); ?></b>     
                                </td>
                                <td>
                                    <b><?php echo sumPerMonth($transaksi, $tahun, "10"); ?></b>     
                                </td>
                                <td>
                                    <b><?php echo sumPerMonth($transaksi, $tahun, "11"); ?></b>     
                                </td>
                                <td>
                                    <b><?php echo sumPerMonth($transaksi, $tahun, "12"); ?></b>     
                                </td>
                                <td>
                                    <b><?php echo sum($transaksi); ?></b>     
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>


</body>

</html>