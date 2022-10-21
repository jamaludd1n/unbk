
            <!-- Menu -->
            <div class="menu">
                <ul class="list">
                    <li class="active">
                        <a href="<?= site_url('beranda')?>">
                            <i class="material-icons">home</i>
                            <span>Home</span>
                        </a>
                    </li>
                    <li>
                        <a href="<?= site_url('help')?>">
                            <i class="material-icons">help</i>
                            <span>Petunjuk</span>
                        </a>
                    </li>
                    <?php if(strval($_SESSION['SES_LOGIN_LEVEL']) === "admin"):?>
                    <li>
                        <a href="<?= site_url('data-guru')?>">
                            <i class="material-icons">group</i>
                            <span>Data Guru</span>
                        </a>
                    </li>
                    <li>
                        <a href="<?= site_url('data-siswa')?>">
                            <i class="material-icons">group</i>
                            <span>Data Siswa</span>
                        </a>
                    </li>
                    <li>
                        <a href="<?= site_url("bank-soal")?>">
                            <i class="material-icons">filter_2</i>
                            <span>Paket/Bank Soal</span>
                        </a>
                    </li>
                    <li>
                        <a href="<?= site_url("data-ujian")?>">
                            <i class="material-icons">pages</i>
                            <span>Kelas Ujian</span>
                        </a>
                    </li>
                    <li>
                        <a href="javascript:void(0);" class="menu-toggle waves-effect waves-block toggled">
                            <i class="material-icons">map</i>
                            <span>Data Master</span>
                        </a>
                        <ul class="ml-menu" style="display: block;">
		                    <li>
		                        <a href="<?= site_url("kelas")?>">
		                            <i class="material-icons">layers</i>
		                            <span>Kelas</span>
		                        </a>
		                    </li>
                            <li>
                                <a href="<?= site_url("mapel")?>">
                                    <i class="material-icons">layers</i>
                                    <span>Mapel</span>
                                </a>
                            </li>
                            <li>
                                <a href="<?= site_url("jurusan")?>">
                                    <i class="material-icons">layers</i>
                                    <span>Jurusan</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <?php else: ?>
                        <li>
                            <a href="<?= site_url('data-guru')?>">
                                <i class="material-icons">group</i>
                                <span>Data Guru</span>
                            </a>
                        </li>
                        <li>
                            <a href="<?= site_url('data-siswa')?>">
                                <i class="material-icons">group</i>
                                <span>Data Siswa</span>
                            </a>
                        </li>
                        <li>
                            <a href="<?= site_url("bank-soal")?>">
                                <i class="material-icons">filter_2</i>
                                <span>Paket/Bank Soal</span>
                            </a>
                        </li>
                    <?php endif; ?>
                    <li>
                        <a href="<?= site_url('logout')?>">
                            <i class="material-icons">input</i>
                            <span>Logout</span>
                        </a>
                    </li>
                    <li>
                        <a href="<?=current_url()?>" onclick="return window.localStorage.clear()">
                            <i class="material-icons">clear</i>
                            <span>Clear Storage</span>
                        </a>
                    </li>
                </ul>
            </div>
            <!-- #Menu -->

