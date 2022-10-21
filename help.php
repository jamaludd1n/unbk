<div class="card  animated slideInUp">
	<div class="body">
	<p>
		Untuk dapat menjalankan applikasi ini dengan baik silahkan perhatikan user guide dibawah ini :
	</p>
	<ol>
		<?php foreach($config['spek'] as $row): ?>
			<li><?= $row ?></li>
		<?php endforeach; ?>
	</ol>
		<p>
			Dan selanjutnya perhatikan petunjuk dibawah ini : 
		</p>
		<ol>
			<?php foreach($config['petunjuk'] as $row): ?>
				<li><?= $row ?></li>
			<?php endforeach; ?>
			<li>Oh iya lupa , jika timer tidak muncul bersihkan LocalStorage dengan cara memilih menu clear storage disamping kiri sidebar. </li>
		</ol>
		<p>
			Note :
			<code>
				Sebaiknya sebelum pelaksanaan ujian online admin/petugas/pengawas harus memeriksa
				setiap perangkat termasuk applikasi browser, hapus terlebih dahulu semua cache, cookie, session dan history2 lainya
				selanjutnya usahakan tidak ada system/atau applikasi yang berjalan selain applikasi ujian online 
			</code>
		</p>
	</div>
</div>

<div class="card">
	<div class="body">
		<marquee direction="up" class="text-center" scrollamount="2"> 
		<code> | 
			<?php 
				foreach ($config['dev'] as $key => $value) {
					echo $value ." | ";
				}
			?>
		</code></marquee>
	</div>
</div>

<div class="card">
	<div class="body">
		<marquee> 
		<code>
			<?php 
				foreach ($config['envinfo'] as $key => $value) {
					echo ucfirst($key) ." | ".$value ." | ";
				}
			?>
		</code></marquee>
	</div>
</div>