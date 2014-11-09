<?
	$s="Pembuatan purchase order (PO) supplier, beserta pengelolaan hutang dan pelunasan hutang.";
	if (allow_mod('_40000')) add_shortcut('Pembelian','ico_purchase.png','#57CE57',1,$s);
	$s="Pembuatan sales order (SO) pelanggan, pengiriman, kartu piutang sampai pelunasan piutang.";
	if (allow_mod('_30000')) add_shortcut('Penjualan','ico_sales.png','#579CD1',2,$s);
	$s="Pengelolaan data stock meliputi penerimaan, pengeluaran, transfer, adjustment dan lainnya.";
	if (allow_mod('_80000')) add_shortcut('Inventory','ico_inventory.png','#C87CDB',3,$s);
	$s="Pencatatan kas masuk dan kas keluar diluar pelunasan hutang piutang.";
	if (allow_mod('_60000')) add_shortcut('Buku Kas','ico_bank.png','#D8EC70',4,$s);
	$s="Pengelolaan biaya penyusutan terhadap aktiva tetap seperti gedung, kendaraan dan lainnya.";
	if (allow_mod('_14000')) add_shortcut('Aktiva Tetap','ico_asset.png','#EC9A73',5,$s);
	$s="Proses pembuatan dari mulai bahan baku sampai penerimaan barang jadi di sebuah pabrik.";
	if (allow_mod('_11000')) add_shortcut('Manufacture','ico_manuf.png','#A1A8DD',6,$s);
	$s="Pengelollan data pegawai berupa absensi, shift, tunjangan, slip gaji dan lainnya.";
	if (allow_mod('_12000')) add_shortcut('Payroll','ico_payroll.png','#DFABE9',7,$s);
	$s="Pencatatan anggota koperasi beserta pinjaman, tabungan dan pelunasannya.";
	if (allow_mod('_13000')) add_shortcut('Koperasi','ico_koperasi.png','#DFABE9',11,$s);
	$s="Modul penjualan tunai / kasir, untuk melayani pelanggan secara cepat.";
	if (allow_mod("_30000.0")) add_shortcut('P.O.S','ico_pos.png','#DFAcE9',13,$s);
	$s="Modul buku besar dan jurnal-jurnal yang dihasilkan semua transaksi yang menghasilkan laporan neraca dan rugi laba.";
	if (allow_mod('_10000')) add_shortcut('Akuntansi','ico_akun.png','#D8EC70',10,$s);
	$s="Modul untuk usaha travel agent, meliputi jadwal pesawat pembuatan invoice dan pelunasan.";
	add_shortcut('Travel Agent','office.png','#D8EC70',15,$s);
	$s="Modul pengelolaan data transaksi untuk usaha hotel dan penginapan.";
	add_shortcut('Hotel','eog.png','#D8EC70',16,$s);
	$s="Modul untuk dipakai di restoran dan rumah makan.";
	add_shortcut('Restaurant','gazpacho.png','#D8EC70',17,$s);
	$s="Modul untuk laundry dan pencucian pakaian.";
	add_shortcut('Laundry','glob2-icon-48.png','#D8EC70',18,$s);
	$s="Modul untuk usaha leasing dan kredit kendaraan beserta angsurannya.";
	add_shortcut('Leasing','gnome-fs-network.png','#D8EC70',19,$s);
	$s="Modul untuk sekolah dan dunia pendidikan.";
	add_shortcut('Sekolah','gnome-db.png','#D8EC70',20,$s);

	$s="Seting user login, kelompok user atau job dan modul yang boleh di akses.";
	if (allow_mod('_00000')) add_shortcut('Setting','ico_setting.png','#A2B1A2',8,$s);
	
	function add_shortcut($label,$icon,$color='#cdc',$nomor='0',$content='') {
		echo "<div class='mxmod col-md-5 col-sm-5 col-xs-5' onclick='run_modul($nomor);'> 
			<div class='mxicon'>
				<img src='".base_url()."images/$icon' width='90' height='90'>
			</div>
			<div class='mxlabel'>$label</div>
			<div class='mxdesc'>$content</div>
		</div>";
	}

?>


<script>
	function run_modul(nomor) {
		var  url='purchase';
		switch(nomor){
		case 1:url='purchase';break;
		case 2:url='sales';break;
		case 3:url='inventory';break;
		case 4:url='bank';break;
		case 5:url='aktiva';break;
		case 6:url='manuf';break;
		case 7:url='payroll';break;
		case 8:url='admin';break;
		case 9:url='customer';break;
		case 10:url='gl';break;
		case 11:url='koperasi';break;
		case 13:url='pos';break;
		case 15:url='travel';break;
		case 16:url='hotel';break;
		case 17:url='resto';break;
		case 18:url='laundry';break;
		case 19:url='leasing';break;
		case 20:url='sekolah';break;
		}
		if(url!='') load_menu(url);
	}
</script>
<div class="clearfix"></div>