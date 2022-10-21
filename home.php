    
        <div class="card animated slideInRight">
            <div class="body">
                    <h4 class="text-center">
                    Selamat datang di <?= $config['app']['nama'] ?> <br> <?= $config['app']['sekolah']['nama'] ?>
                    </h4>
            </div>
        </div>

            <!-- Widgets -->
            <div class="row clearfix">
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box bg-indigo hover-expand-effect  animated slideInUp">
                        <div class="icon">
                            <i class="material-icons">group</i>
                        </div>
                        <div class="content">
                            <div class="text"> JUMLAH GURU</div>
                            <div class="number count-to" data-from="0" data-to="125" data-speed="15" data-fresh-interval="20" style="position:relative; top:10px;">
                                <?php $g = $conn->query("SELECT COUNT(*) AS jml_guru FROM tbl_guru")->fetch_object(); echo $g->jml_guru;?>                                
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box bg-blue hover-expand-effect  animated slideInUp">
                        <div class="icon">
                            <i class="material-icons">group</i>
                        </div>
                        <div class="content">
                            <div class="text"> JUMLAH SISWA</div>
                            <div class="number count-to" data-from="0" data-to="125" data-speed="15" data-fresh-interval="20" style="position:relative; top:10px;">
                                <?php $s = $conn->query("SELECT COUNT(*) AS jml_siswa FROM tbl_siswa")->fetch_object(); echo $s->jml_siswa;?>                                
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box bg-pink hover-expand-effect  animated slideInUp">
                        <div class="icon">
                            <i class="material-icons">library_books</i>
                        </div>
                        <div class="content">
                            <div class="text"> JUMLAH PAKET</div>
                            <div class="number count-to" data-from="0" data-to="125" data-speed="15" data-fresh-interval="20" style="position:relative; top:10px;">
                                <?php $p = $conn->query("SELECT COUNT(*) AS jml_paket FROM tbl_paket")->fetch_object(); echo $p->jml_paket;?>                                
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box bg-green hover-expand-effect  animated slideInUp">
                        <div class="icon">
                            <i class="material-icons">help</i>
                        </div>
                        <div class="content">
                            <div class="text"> PERTANYAAN</div>
                            <div class="number count-to" data-from="0" data-to="125" data-speed="15" data-fresh-interval="20" style="position:relative; top:10px;">
                                <?php $s = $conn->query("SELECT COUNT(*) AS soal FROM tbl_banksoal")->fetch_object(); echo $s->soal;?>                                
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box bg-orange hover-expand-effect  animated slideInUp">
                        <div class="icon">
                            <i class="material-icons">poll</i>
                        </div>
                        <div class="content">
                            <div class="text"> JUMLAH MAPEL</div>
                            <div class="number count-to" data-from="0" data-to="125" data-speed="15" data-fresh-interval="20" style="position:relative; top:10px;">
                                <?php $m = $conn->query("SELECT COUNT(*) AS jml_mapel FROM tbl_mapel")->fetch_object(); echo $m->jml_mapel;?>                                
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box bg-teal hover-expand-effect  animated slideInUp">
                        <div class="icon">
                            <i class="material-icons">directions</i>
                        </div>
                        <div class="content">
                            <div class="text"> JUMLAH JURUSAN</div>
                            <div class="number count-to" data-from="0" data-to="125" data-speed="15" data-fresh-interval="20" style="position:relative; top:10px;">
                                <?php $j = $conn->query("SELECT COUNT(*) AS jml_jurusan FROM tbl_jurusan")->fetch_object(); echo $j->jml_jurusan;?>                                
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box bg-cyan hover-expand-effect  animated slideInUp">
                        <div class="icon">
                            <i class="material-icons">pages</i>
                        </div>
                        <div class="content">
                            <div class="text"> JUMLAH KELAS</div>
                            <div class="number count-to" data-from="0" data-to="125" data-speed="15" data-fresh-interval="20" style="position:relative; top:10px;">
                                <?php $k = $conn->query("SELECT COUNT(*) AS jml_kelas FROM tbl_kelas")->fetch_object(); echo $k->jml_kelas;?>                                
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box bg-black hover-expand-effect  animated slideInUp">
                        <div class="icon">
                            <i class="material-icons">timer</i>
                        </div>
                        <div class="content">
                            <div class="text"> <span id="tgl">Rabu, 23-03-2010</span></div>
                            <div class="number count-to" data-from="0" data-to="125" data-speed="15" data-fresh-interval="20" style="position:relative; top:10px;">
                                <span id="waktu">00:00:00</span>
                            </div>
                        </div>
                    </div>
                </div>


            </div>
            <!-- #END# Widgets -->



<div class="card">
    <div class="body">
        <marquee><code>
            <?php 
                foreach ($config['dev'] as $key => $value) {
                    echo $key ." | ".$value ." | ";
                }

            ?>
        </code></marquee>
    </div>
</div>
