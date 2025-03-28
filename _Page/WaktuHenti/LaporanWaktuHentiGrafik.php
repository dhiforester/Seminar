<div class="row">
    <div class="col-md-12">
        <h5 class="card-title">Grafik Kejadian Waktu Henti <span>/ <?php echo "$tahun-$bulan"; ?></span></h5>
        <div id="KejadianWaktuHenti">
            <!-- Line Chart -->
        </div>
        <script>
            document.addEventListener("DOMContentLoaded", () => {
            new ApexCharts(document.querySelector("#KejadianWaktuHenti"), {
                series: [{
                    name: 'Kejadian Waktu Henti Sistem',
                    data: [
                                <?php
                                    if($periode_laporan=="Tahunan"){
                                        $TahunBulan1="$tahun-01";
                                        $TahunBulan2="$tahun-02";
                                        $TahunBulan3="$tahun-03";
                                        $TahunBulan4="$tahun-04";
                                        $TahunBulan5="$tahun-05";
                                        $TahunBulan6="$tahun-06";
                                        $TahunBulan7="$tahun-07";
                                        $TahunBulan8="$tahun-08";
                                        $TahunBulan9="$tahun-09";
                                        $TahunBulan10="$tahun-10";
                                        $TahunBulan11="$tahun-11";
                                        $TahunBulan12="$tahun-12";
                                        //Menghitung jumlah kejadian
                                        $Jumlahkejadian1 = mysqli_num_rows(mysqli_query($Conn, "SELECT*FROM waktu_henti WHERE tanggal_mulai like '%$TahunBulan1%'"));
                                        $Jumlahkejadian2 = mysqli_num_rows(mysqli_query($Conn, "SELECT*FROM waktu_henti WHERE tanggal_mulai like '%$TahunBulan2%'"));
                                        $Jumlahkejadian3 = mysqli_num_rows(mysqli_query($Conn, "SELECT*FROM waktu_henti WHERE tanggal_mulai like '%$TahunBulan3%'"));
                                        $Jumlahkejadian4 = mysqli_num_rows(mysqli_query($Conn, "SELECT*FROM waktu_henti WHERE tanggal_mulai like '%$TahunBulan4%'"));
                                        $Jumlahkejadian5 = mysqli_num_rows(mysqli_query($Conn, "SELECT*FROM waktu_henti WHERE tanggal_mulai like '%$TahunBulan5%'"));
                                        $Jumlahkejadian6 = mysqli_num_rows(mysqli_query($Conn, "SELECT*FROM waktu_henti WHERE tanggal_mulai like '%$TahunBulan6%'"));
                                        $Jumlahkejadian7 = mysqli_num_rows(mysqli_query($Conn, "SELECT*FROM waktu_henti WHERE tanggal_mulai like '%$TahunBulan7%'"));
                                        $Jumlahkejadian8 = mysqli_num_rows(mysqli_query($Conn, "SELECT*FROM waktu_henti WHERE tanggal_mulai like '%$TahunBulan8%'"));
                                        $Jumlahkejadian9 = mysqli_num_rows(mysqli_query($Conn, "SELECT*FROM waktu_henti WHERE tanggal_mulai like '%$TahunBulan9%'"));
                                        $Jumlahkejadian10 = mysqli_num_rows(mysqli_query($Conn, "SELECT*FROM waktu_henti WHERE tanggal_mulai like '%$TahunBulan10%'"));
                                        $Jumlahkejadian11 = mysqli_num_rows(mysqli_query($Conn, "SELECT*FROM waktu_henti WHERE tanggal_mulai like '%$TahunBulan11%'"));
                                        $Jumlahkejadian12 = mysqli_num_rows(mysqli_query($Conn, "SELECT*FROM waktu_henti WHERE tanggal_mulai like '%$TahunBulan12%'"));
                                        echo ''.$Jumlahkejadian1.', ';
                                        echo ''.$Jumlahkejadian2.', ';
                                        echo ''.$Jumlahkejadian3.', ';
                                        echo ''.$Jumlahkejadian4.', ';
                                        echo ''.$Jumlahkejadian5.', ';
                                        echo ''.$Jumlahkejadian6.', ';
                                        echo ''.$Jumlahkejadian7.', ';
                                        echo ''.$Jumlahkejadian8.', ';
                                        echo ''.$Jumlahkejadian9.', ';
                                        echo ''.$Jumlahkejadian10.', ';
                                        echo ''.$Jumlahkejadian11.', ';
                                        echo ''.$Jumlahkejadian12.', ';
                                    }else{
                                        $jumHari = cal_days_in_month(CAL_GREGORIAN, $bulan, $tahun);
                                        for ( $i =1; $i<=$jumHari; $i++ ){
                                            $fzeropadded = sprintf("%02d", $i);
                                            $TahunBulan="$tahun-$bulan-$fzeropadded";
                                            //Menghitung jumlah kejadian
                                            $Jumlahkejadian = mysqli_num_rows(mysqli_query($Conn, "SELECT*FROM waktu_henti WHERE tanggal_mulai like '%$TahunBulan%'"));
                                            echo ''.$Jumlahkejadian.', ';
                                        }
                                    }
                                ?>
                                // 31, 40, 28, 51, 42, 82, 90
                            ],
                        }, 
                        // {
                        //     name: 'Revenue',
                        //     data: [11, 32, 45, 32, 34, 52, 41]
                        // }, 
                        // {
                        //     name: 'Customers',
                        //     data: [15, 11, 32, 18, 9, 24, 11]
                        // }
                    ],
                chart: {
                height: 350,
                type: 'bar',
                toolbar: {
                    show: false
                },
                },
                markers: {
                size: 4
                },
                colors: ['#4154f1', '#2eca6a', '#ff771d'],
                fill: {
                type: "gradient",
                gradient: {
                    shadeIntensity: 1,
                    opacityFrom: 0.3,
                    opacityTo: 0.4,
                    stops: [0, 90, 100]
                }
                },
                dataLabels: {
                enabled: false
                },
                stroke: {
                curve: 'smooth',
                width: 2
                },
                xaxis: {
                type: 'text',
                categories: [
                    <?php
                        if($periode_laporan=="Tahunan"){
                            echo '1, ';
                            echo '2, ';
                            echo '3, ';
                            echo '4, ';
                            echo '5, ';
                            echo '6, ';
                            echo '7, ';
                            echo '8, ';
                            echo '9, ';
                            echo '10, ';
                            echo '11, ';
                            echo '12 ';
                        }else{
                            $jumHari = cal_days_in_month(CAL_GREGORIAN, $bulan, $tahun);
                            for ( $i =1; $i<=$jumHari; $i++ ){
                                $fzeropadded = sprintf("%02d", $i);
                                echo ''.$fzeropadded.', ';
                            }
                        }
                    ?>
                    // "2018-09-19T00:00:00.000Z", 
                    // "2018-09-19T01:30:00.000Z", 
                    // "2018-09-19T02:30:00.000Z", 
                    // "2018-09-19T03:30:00.000Z", 
                    // "2018-09-19T04:30:00.000Z", 
                    // "2018-09-19T05:30:00.000Z", 
                    // "2018-09-19T06:30:00.000Z"
                ]
                },
                tooltip: {
                x: {
                    format: 'dd/MM/yy HH:mm'
                },
                }
            }).render();
            });
        </script>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="table table-responsive">
            <table class="table table-hover table-bordered">
                <thead>
                    <tr>
                        <th class="text-center"><b>No</b></th>
                        <th class="text-center"><b>Tanggal/Bulan</b></th>
                        <th class="text-center"><b>Jumlah Kejadian</b></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        if($periode_laporan=="Tahunan"){
                            $no=1;
                            for ( $i =1; $i<=12; $i++ ){
                                $fzeropadded = sprintf("%02d", $i);
                                $PeriodeTahun="$tahun-$fzeropadded";
                                $Strtotime=strtotime($PeriodeTahun);
                                $NamaBulan=date('F',$Strtotime);
                                $Jumlahkejadian= mysqli_num_rows(mysqli_query($Conn, "SELECT*FROM waktu_henti WHERE tanggal_mulai like '%$PeriodeTahun%'"));
                                if(!empty($Jumlahkejadian)){
                                    echo '<tr class="bg-success text-light">';
                                }else{
                                    echo '<tr>';
                                }
                                echo '  <td class="text-center">'.$no.'</td>';
                                echo '  <td class="text-left">'.$NamaBulan.' '.$tahun.'</td>';
                                echo '  <td class="text-right">'.$Jumlahkejadian.' Kejadian</td>';
                                echo '</tr>';
                            $no++;}
                        }else{
                            $JumlahHari = cal_days_in_month(CAL_GREGORIAN, $bulan, $tahun);
                            $no=1;
                            for ( $i =1; $i<=$JumlahHari; $i++ ){
                                $fzeropadded = sprintf("%02d", $i);
                                $PeriodeTahun="$tahun-$bulan-$fzeropadded";
                                $Strtotime=strtotime($PeriodeTahun);
                                $NamaBulan=date('d F Y',$Strtotime);
                                $Jumlahkejadian= mysqli_num_rows(mysqli_query($Conn, "SELECT*FROM waktu_henti WHERE tanggal_mulai like '%$PeriodeTahun%'"));
                                if(!empty($Jumlahkejadian)){
                                    echo '<tr class="bg-success text-light">';
                                }else{
                                    echo '<tr>';
                                }
                                echo '  <td class="text-center">'.$no.'</td>';
                                echo '  <td class="text-left">'.$NamaBulan.'</td>';
                                echo '  <td class="text-right">'.$Jumlahkejadian.' Kejadian</td>';
                                echo '</tr>';
                            $no++;}
                        }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>