<?php
if (isset($_GET['page'])) {
	if ($_GET['page'] == 'beranda') {
		$act1 = "active";
	} else if ($_GET['page'] == 'barang_masuk') {
		$gudang = "active";
		$act2 = "active";
		$sub_act2_1 = "active";
		$sub_act2_1_1_0 = "active";
		$sub_act2_1_1 = "active";
		$bagian_keuangan = "active";
		$po = "active";
		$list_barang = "active";
		$list_barang1 = "active";
	} else if ($_GET['page'] == 'ubah_barang_demo' or $_GET['page'] == 'barang_demo' or $_GET['page'] == 'tambah_brg_demo' or $_GET['page'] == 'tambah_brg_demo2') {
		$gudang = "active";
		$act2 = "active";
		$barang_demo = "active";
		$barang_demo1 = "active";
	} else if (preg_match("/peminjaman_barang/", $_GET['page']) or preg_match("/pilih_no_seri_pinjam/", $_GET['page'])) {
		$gudang = "active";
		$act2 = "active";
		$peminjaman_barang = "active";
		$peminjaman_barang1 = "active";
	} else if (preg_match("/kirim_pinjam_barang/", $_GET['page'])) {
		$gudang = "active";
		$act2 = "active";
		$peminjaman_barang = "active";
		$peminjaman_barang2 = "active";
	} else if (preg_match("/kembali_pinjam_barang/", $_GET['page'])) {
		$gudang = "active";
		$act2 = "active";
		$peminjaman_barang = "active";
		$peminjaman_barang3 = "active";
	} else if ($_GET['page'] == 'ubah_barang_kirim_demo' or $_GET['page'] == 'pilih_no_seri_demo' or $_GET['page'] == 'kirim_barang_demo' or $_GET['page'] == 'tambah_brg_demo') {
		$gudang = "active";
		$act2 = "active";
		$barang_demo = "active";
		$barang_demo2 = "active";
	} else if ($_GET['page'] == 'opname_awal' or $_GET['page'] == 'opname' or $_GET['page'] == 'opname_awal_detail') {
		$gudang = "active";
		$act2 = "active";
		$opname = "active";
	} else if ($_GET['page'] == 'pilih_barang_demo_kembali' or $_GET['page'] == 'kembali_barang_demo_detail' or $_GET['page'] == 'kembali_barang_demo' or $_GET['page'] == 'tambah_brg_demo') {
		$gudang = "active";
		$act2 = "active";
		$barang_demo = "active";
		$barang_demo3 = "active";
	} else if ($_GET['page'] == 'barang_set' or $_GET['page'] == 'tambah_barang_set' or $_GET['page'] == 'simpan_tambah_barang_set' or $_GET['page'] == 'simpan_tambah_barang_set2' or $_GET['page'] == 'simpan_tambah_barang_set3' or $_GET['page'] == 'simpan_tambah_barang_set4' or $_GET['page'] == 'ubah_barang_set' or $_GET['page'] == 'ubah_barang_set2' or $_GET['page'] == 'ubah_barang_set3') {
		$gudang = "active";
		$barang_set = "active";
		$barang_set1 = "active";
		$bagian_keuangan = "active";
		$sub_act2_1 = "active";
		$sub_act2_1_1 = "active";
		$ber_set = "active";
		$po = "active";
		$list_barang = "active";
		$list_barang2 = "active";
	} else if ($_GET['page'] == 'penjualan_barang_set' or $_GET['page'] == 'jual_barang_set2' or $_GET['page'] == 'jual_barang_set' or $_GET['page'] == 'simpan_jual_barang_set2' or $_GET['page'] == 'ubah_barang_jual_set' or $_GET['page'] == 'simpan_jual_barang_set') {
		$gudang = "active";
		$barang_set = "active";
		$barang_set2 = "active";
		$act2_2 = "active";
		$sub_act2_4 = "active";
		$bagian_keuangan = "active";
		$sub_act2_1_1 = "active";
		$ber_set = "active";
	} else if ($_GET['page'] == 'simpan_kirim_barang_set' or $_GET['page'] == 'detail_jual_barang_set' or $_GET['page'] == 'pengiriman_barang_set' or $_GET['page'] == 'riwayat_panggilan_set' or $_GET['page'] == 'ubah_barang_kirim_set') {
		$gudang = "active";
		$barang_set = "active";
		$barang_set3 = "active";
		$bagian_keuangan = "active";
		$kirim_barang_uang = "active";
		$kirim_barang_uang3 = "active";
	} else if ($_GET['page'] == 'barang_rusak' or $_GET['page'] == 'barang_rusak_detail') {
		$bagian_teknisi = "active";
		$barang_gudang_rusak = "active";
		$act2 = "active";
		$barang_rusak = "active";
		$rusak = "active";
		$belum_terjual = "active";
		$pengembalian_barang = "active";
		$gudang = "active";
	} else if ($_GET['page'] == 'buku_kas' or $_GET['page'] == 'lihat_ringkasan_kas') {
		$bagian_keuangan = "active";
		$buku_kas = "active";
	} else if ($_GET['page'] == 'buku_bank' or $_GET['page'] == 'tambah_buku_bank' or $_GET['page'] == 'lihat_ringkasan_bank') {
		$bagian_keuangan = "active";
		$buku_bank = "active";
	} else if ($_GET['page'] == 'dokumen_kontrak' or $_GET['page'] == 'tambah_dokumen_kontrak' or $_GET['page'] == 'ubah_dokumen_kontrak') {
		$bagian_keuangan = "active";
		$kontrak = "active";
		$kontrak1 = "active";
	} else if ($_GET['page'] == 'tagihan_kontrak' or $_GET['page'] == 'tambah_tagihan_kontrak' or $_GET['page'] == 'ubah_tagihan_kontrak') {
		$bagian_keuangan = "active";
		$kontrak = "active";
		$kontrak2 = "active";
	} else if ($_GET['page'] == 'pembayaran_kontrak' or $_GET['page'] == 'tambah_pembayaran_kontrak' or $_GET['page'] == 'ubah_pembayaran_kontrak') {
		$bagian_keuangan = "active";
		$kontrak = "active";
		$kontrak3 = "active";
	} else if ($_GET['page'] == 'ringkasan' or $_GET['page'] == 'lihat_ringkasan' or $_GET['page'] == 'lihat_ringkasan_ekuitas' or $_GET['page'] == 'lihat_ringkasan_kewajiban' or $_GET['page'] == 'lihat_ringkasan_aset') {
		$bagian_keuangan = "active";
		$ringkasan = "active";
	} else if ($_GET['page'] == 'deposit' or $_GET['page'] == 'tambah_deposit') {
		$bagian_keuangan = "active";
		$deposit = "active";
	} else if ($_GET['page'] == 'deposit_wali') {
		$deposit_saldo = "active";
		$deposit_saldo_wali = "active";
	} else if ($_GET['page'] == 'deposit_guru') {
		$deposit_saldo = "active";
		$deposit_saldo_guru = "active";
	} else if ($_GET['page'] == 'biaya_lain' or $_GET['page'] == 'tambah_biaya_lain' or $_GET['page'] == 'ubah_biaya_lain') {
		$bagian_keuangan = "active";
		$biaya_lain = "active";
	} else if ($_GET['page'] == 'pemasok' or $_GET['page'] == 'tambah_pemasok') {
		$bagian_keuangan = "active";
		$pemasok = "active";
	} else if ($_GET['page'] == 'karyawan' or $_GET['page'] == 'tambah_karyawan' or $_GET['page'] == 'ubah_karyawan') {
		$bagian_keuangan = "active";
		$karyawan = "active";
	} else if ($_GET['page'] == 'monitoring_penjualan') {
		$bagian_keuangan = "active";
		$monitoring_penjualan = "active";
	} else if ($_GET['page'] == 'reimburse' or $_GET['page'] == 'tambah_reimburse' or $_GET['page'] == 'ubah_reimburse') {
		$bagian_keuangan = "active";
		$reimburse = "active";
	} else if ($_GET['page'] == 'slip_gaji' or $_GET['page'] == 'tambah_slip_gaji' or $_GET['page'] == 'ubah_slip_gaji' or $_GET['page'] == 'ubah_gaji_karyawan' or $_GET['page'] == 'tambah_gaji_karyawan' or $_GET['page'] == 'gaji_karyawan' or $_GET['page'] == 'detail_gaji' or $_GET['page'] == 'pilih_gaji') {
		$bagian_keuangan = "active";
		$slip_gaji = "active";
	} else if ($_GET['page'] == 'master_gaji' or $_GET['page'] == 'tambah_master_gaji' or $_GET['page'] == 'ubah_master_gaji') {
		$bagian_keuangan = "active";
		$pengaturan_akun = "active";
		$master_gaji = "active";
	} else if ($_GET['page'] == 'tambah_buku_kas') {
		$bagian_keuangan = "active";
		$buku_kas = "active";
		$buku_bank = "active";
	} else if ($_GET['page'] == 'ubah_buku_kas' or $_GET['page'] == 'detail_buku_kas') {
		$bagian_keuangan = "active";
		$buku_kas = "active";
		$buku_bank = "active";
	} else if ($_GET['page'] == 'ubah_buku_bank' or $_GET['page'] == 'detail_buku_kas') {
		$bagian_keuangan = "active";
		$buku_bank = "active";
	} else if ($_GET['page'] == 'tambah_barang_rusak') {
		$bagian_teknisi = "active";
		$barang_gudang_rusak = "active";
		$act2 = "active";
		$barang_rusak = "active";
		$barang_kembali1 = "active";
		$gudang = "active";
	} else if ($_GET['page'] == 'ubah_barang_rusak') {
		$bagian_teknisi = "active";
		$barang_gudang_rusak = "active";
	} else if ($_GET['page'] == 'progress_rusak_dalam') {
		$bagian_teknisi = "active";
		$progress_dalam = "active";
	} else if ($_GET['page'] == 'progress_rusak_dalam_detail') {
		$bagian_teknisi = "active";
		$progress_dalam = "active";
	} else if ($_GET['page'] == 'tambah_progress_rusak_dalam') {
		$bagian_teknisi = "active";
		$progress_dalam = "active";
	} else if ($_GET['page'] == 'tambah_progress_rusak_dalam2') {
		$bagian_teknisi = "active";
		$progress_dalam = "active";
	} else if ($_GET['page'] == 'barang_gudang1' or $_GET['page'] == 'mutasi' or $_GET['page'] == 'simpan_tambah_ke_stok' or $_GET['page'] == 'simpan_tambah_ke_stok2' or $_GET['page'] == 'detail_mutasi') {
		$act2 = "active";
		$pemesanan = "active";
		$pemesanan1 = "active";
		$gudang = "active";
		$sub_act2_1_1 = "active";
		$bagian_keuangan = "active";
		$pembelian = "active";
		$pembelian1 = "active";
		$pembelian1_1 = "active";
	} else if ($_GET['page'] == 'detail_barang_gudang1' or $_GET['page'] == 'kelola_barang_gudang1') {
		$act2 = "active";
		$pemesanan = "active";
		$pemesanan1 = "active";
		$gudang = "active";
		$sub_act2_1_1 = "active";
		$bagian_keuangan = "active";
		$pembelian = "active";
		$pembelian1 = "active";
		$pembelian1_1 = "active";
	} else if ($_GET['page'] == 'barang_set1' or $_GET['page'] == 'mutasi_set' or $_GET['page'] == 'mutasi_set_1' or $_GET['page'] == 'simpan_tambah_barang_set33') {
		$barang_set = "active";
		$barang_set0 = "active";
		$gudang = "active";
		$bagian_keuangan = "active";
		$pembelian = "active";
		$pembelian1 = "active";
		$pembelian1_2 = "active";
	} else if ($_GET['page'] == 'aksesoris1' or $_GET['page'] == 'mutasi_akse' or $_GET['page'] == 'simpan_tambah_ke_stok_akse' or $_GET['page'] == 'simpan_tambah_ke_stok_akse2') {
		$akse = "active";
		$akse0 = "active";
		$gudang = "active";
		$bagian_keuangan = "active";
		$pembelian = "active";
		$pembelian2 = "active";
	} else if ($_GET['page'] == 'barang_gudang1_set' or $_GET['page'] == 'mutasi_set' or $_GET['page'] == 'simpan_tambah_ke_stok_set' or $_GET['page'] == 'simpan_tambah_ke_stok2_set') {
		$act2 = "active";
		$gudang_set = "active";
		$gudang = "active";
		$sub_act2_1_1 = "active";
		$bagian_keuangan = "active";
		$pembelian = "active";
	} else if ($_GET['page'] == 'simpan_tambah_barang_masuk') {
		$act2 = "active";
		$sub_act2_1 = "active";
		$gudang = "active";
		$bagian_keuangan = "active";
	} else if ($_GET['page'] == 'simpan_tambah_barang_masuk2') {
		$act2 = "active";
		$sub_act2_1 = "active";
		$gudang = "active";
		$bagian_keuangan = "active";
	} else if ($_GET['page'] == 'simpan_tambah_barang_masuk3') {
		$act2 = "active";
		$sub_act2_1 = "active";
		$gudang = "active";
		$bagian_keuangan = "active";
	} else if ($_GET['page'] == 'simpan_tambah_barang_masuk4') {
		$act2 = "active";
		$sub_act2_1 = "active";
		$gudang = "active";
		$bagian_keuangan = "active";
	} else if ($_GET['page'] == 'simpan_tambah_barang_masuk5') {
		$act2 = "active";
		$sub_act2_1 = "active";
		$gudang = "active";
		$bagian_keuangan = "active";
	} else if ($_GET['page'] == 'simpan_tambah_barang_masuk6') {
		$act2 = "active";
		$sub_act2_1 = "active";
		$gudang = "active";
		$bagian_keuangan = "active";
	} else if ($_GET['page'] == 'pembelian_alkes' or $_GET['page'] == 'ubah_pembelian_alkes' or $_GET['page'] == 'tambah_po_alkes' or $_GET['page'] == 'ubah_po_alkes' or $_GET['page'] == 'tambah_pembelian_alkes' or $_GET['page'] == 'tambah_pembelian_alkes_sudah_ada' or $_GET['page'] == 'simpan_tambah_pemesanan_alkes' or $_GET['page'] == 'simpan_tambah_pemesanan_alkes_sudah_ada' or $_GET['page'] == 'simpan_tambah_aksesoris_pesan') {
		$act2 = "active";
		$sub_act2_pesan = "active";
		$pil1 = "active";
		$po = "active";
	} else if ($_GET['page'] == 'pembelian_inventory' or $_GET['page'] == 'ubah_pembelian_inventory' or $_GET['page'] == 'tambah_po_inventory' or $_GET['page'] == 'ubah_po_inven' or $_GET['page'] == 'tambah_pembelian_inven' or $_GET['page'] == 'tambah_pembelian_inven_sudah_ada' or $_GET['page'] == 'simpan_tambah_pemesanan_inven' or $_GET['page'] == 'simpan_tambah_pemesanan_inven_sudah_ada' or $_GET['page'] == 'simpan_tambah_aksesoris_pesan') {
		$act2 = "active";
		$po_inventory = "active";
		$po_inventory1 = "active";
		$po = "active";
	} else if ($_GET['page'] == 'pembelian_inventory2' or $_GET['page'] == 'ubah_pembelian_inventory2' or $_GET['page'] == 'tambah_po_inventory2' or $_GET['page'] == 'ubah_po_inven2' or $_GET['page'] == 'tambah_pembelian_inven2' or $_GET['page'] == 'tambah_pembelian_inven2_sudah_ada' or $_GET['page'] == 'simpan_tambah_pemesanan_inven2' or $_GET['page'] == 'simpan_tambah_pemesanan_inven2_sudah_ada' or $_GET['page'] == 'simpan_tambah_aksesoris_pesan') {
		$act2 = "active";
		$po_inventory = "active";
		$po_inventory2 = "active";
		$po = "active";
	} else if ($_GET['page'] == 'pembelian_akse' or $_GET['page'] == 'ubah_pembelian_akse' or $_GET['page'] == 'tambah_po_akse' or $_GET['page'] == 'ubah_po_akse' or $_GET['page'] == 'tambah_pembelian_akse' or $_GET['page'] == 'tambah_pembelian_akse_sudah_ada' or $_GET['page'] == 'simpan_tambah_pemesanan_akse' or $_GET['page'] == 'simpan_tambah_pemesanan_akse_sudah_ada' or $_GET['page'] == 'simpan_tambah_aksesoris_pesan') {
		$act2 = "active";
		$po_aksesoris1 = "active";
		$po_aksesoris = "active";
		$po = "active";
	} else if ($_GET['page'] == 'pembelian_akse2' or $_GET['page'] == 'ubah_pembelian_akse2' or $_GET['page'] == 'tambah_po_akse2' or $_GET['page'] == 'ubah_po_akse2' or $_GET['page'] == 'tambah_pembelian_akse2' or $_GET['page'] == 'tambah_pembelian_akse2_sudah_ada' or $_GET['page'] == 'simpan_tambah_pemesanan_akse2' or $_GET['page'] == 'simpan_tambah_pemesanan_akse2_sudah_ada' or $_GET['page'] == 'simpan_tambah_akse2soris_pesan') {
		$act2 = "active";
		$po_aksesoris2 = "active";
		$po_aksesoris = "active";
		$po = "active";
	} else if ($_GET['page'] == 'pembelian_alkes2' or $_GET['page'] == 'ubah_pembelian_alkes2' or $_GET['page'] == 'tambah_po_alkes2' or $_GET['page'] == 'ubah_po_alkes2' or $_GET['page'] == 'tambah_pembelian_alkes2' or $_GET['page'] == 'tambah_pembelian_alkes2_sudah_ada' or $_GET['page'] == 'simpan_tambah_pemesanan_alkes2' or $_GET['page'] == 'simpan_tambah_pemesanan_alkes2_sudah_ada' or $_GET['page'] == 'simpan_tambah_aksesoris_pesan2') {
		$act2 = "active";
		$sub_act2_pesan = "active";
		$pil2 = "active";
		$po = "active";
		$po_no_seri = "active";
	} else if ($_GET['page'] == 'pembelian_alkes_set' or $_GET['page'] == 'ubah_pembelian_alkes_set' or $_GET['page'] == 'tambah_po_alkes_set' or $_GET['page'] == 'ubah_po_alkes_set' or $_GET['page'] == 'tambah_pembelian_alkes_set' or $_GET['page'] == 'tambah_pembelian_alkes_sudah_ada_set' or $_GET['page'] == 'simpan_tambah_pemesanan_alkes_set' or $_GET['page'] == 'simpan_tambah_pemesanan_alkes_sudah_ada_set' or $_GET['page'] == 'simpan_tambah_aksesoris_pesan_set') {
		$act2 = "active";
		$po_barang_set = "active";
		$po_barang_set1 = "active";
		$po = "active";
	} else if ($_GET['page'] == 'pembelian_alkes2_set' or $_GET['page'] == 'ubah_pembelian_alkes2_set' or $_GET['page'] == 'tambah_po_alkes2_set' or $_GET['page'] == 'detail_set2' or $_GET['page'] == 'detail_set1' or $_GET['page'] == 'detail_set1_sudah_ada' or $_GET['page'] == 'ubah_po_alkes2_set' or $_GET['page'] == 'tambah_pembelian_alkes2_set' or $_GET['page'] == 'tambah_pembelian_alkes2_set_sudah_ada' or $_GET['page'] == 'simpan_tambah_pemesanan_alkes2_set' or $_GET['page'] == 'simpan_tambah_pemesanan_alkes2_set_sudah_ada' or $_GET['page'] == 'simpan_tambah_aksesoris_pesan2_set') {
		$act2 = "active";
		$sub_act2_pesan = "active";
		$pil2 = "active";
		$po = "active";
		$po_set = "active";
	} else if ($_GET['page'] == 'simpan_tambah_aksesoris') {
		$act2 = "active";
		$sub_act2_1 = "active";
		$gudang = "active";
		$bagian_keuangan = "active";
	} else if ($_GET['page'] == 'simpan_tambah_spesifikasi') {
		$act2 = "active";
		$sub_act2_1 = "active";
		$gudang = "active";
	} else if ($_GET['page'] == 'barang_kembali' or $_GET['page'] == 'tambah_retur' or $_GET['page'] == 'simpan_tambah_retur') {
		$act2 = "active";
		$rusak = "active";
		$sudah_terjual = "active";
		$pengembalian_barang = "active";
		$barang_kembali = "active";
		$gudang = "active";
	} else if ($_GET['page'] == 'barang_kembali_tidak_rusak' or $_GET['page'] == 'tambah_retur_tidak_rusak' or $_GET['page'] == 'simpan_tambah_retur_tidak_rusak') {
		$act2 = "active";
		$tidak_rusak = "active";
		$sudah_terjual2 = "active";
		$pengembalian_barang = "active";
		$barang_kembali = "active";
		$gudang = "active";
	} else if ($_GET['page'] == 'ubah_barang_kembali') {
		$act2 = "active";
		$barang_kembali = "active";
		$gudang = "active";
	} else if ($_GET['page'] == 'aksesoris') {
		$akse = "active";
		$akse1 = "active";
		$gudang = "active";
		$bagian_keuangan = "active";
		$sub_act2_1 = "active";
		$sub_act2_1_2 = "active";
		$po = "active";
		$list_barang = "active";
		$list_barang3 = "active";
	} else if ($_GET['page'] == 'barang_inventory' or $_GET['page'] == 'tambah_barang_inventory' or $_GET['page'] == 'ubah_barang_inventory') {
		$inventory = "active";
		$inven2 = "active";
		$gudang = "active";
		$bagian_keuangan = "active";
		$sub_act2_1 = "active";
		$sub_act2_1_3 = "active";
		$po = "active";
		$list_barang = "active";
		$list_barang4 = "active";
	} else if ($_GET['page'] == 'penjualan_inventory_kirim') {
		$gudang = "active";
		$inventory = "active";
		$inven3 = "active";
	} else if ($_GET['page'] == 'kirim_inventory') {
		$gudang = "active";
		$inventory = "active";
		$inven4 = "active";
	} else if ($_GET['page'] == 'barang_inventory1' or $_GET['page'] == 'mutasi_inventory' or $_GET['page'] == 'mutasi_inventory2') {
		$inventory = "active";
		$inven1 = "active";
		$gudang = "active";
		$bagian_keuangan = "active";
		$pembelian = "active";
		$pembelian3 = "active";
	} else if ($_GET['page'] == 'detail_penjualan_aksesoris' or $_GET['page'] == 'penjualan_aksesoris' or $_GET['page'] == 'pilih_no_seri_akse') {
		$akse = "active";
		$akse2 = "active";
		$gudang = "active";
		$bagian_keuangan = "active";
	} else if ($_GET['page'] == 'pengiriman_aksesoris') {
		$akse = "active";
		$akse3 = "active";
		$gudang = "active";
		$bagian_keuangan = "active";
		$kirim_barang_uang = "active";
		$kirim_barang_uang2 = "active";
	} else if ($_GET['page'] == 'kirim_inventory_uang') {
		$bagian_keuangan = "active";
		$kirim_barang_uang = "active";
		$kirim_barang_uang3 = "active";
	} else if ($_GET['page'] == 'ubah_pengiriman_aksesoris') {
		$akse = "active";
		$akse3 = "active";
		$gudang = "active";
	} else if ($_GET['page'] == 'pembeli' or $_GET['page'] == 'ubah_pembeli' or $_GET['page'] == 'tambah_user') {
		$pengaturan_gudang = "active";
		$pengaturan_pembeli = "active";
		$gudang = "active";
		$bagian_keuangan = "active";
		$pembeli = "active";
		$bagian_cs = "active";
		$akun_user = "active";
		$bagian_teknisi = "active";
		$act_user = "active";
	} else if ($_GET['page'] == 'simpan_kirim_aksesoris') {
		$akse = "active";
		$akse3 = "active";
		$gudang = "active";
	}
	//else if ($_GET['page']=='jual_akse') { $akse="active"; $akse2="active"; $gudang="active"; $bagian_keuangan="active";}
	//else if ($_GET['page']=='simpan_jual_akse') { $akse="active"; $akse2="active"; $gudang="active"; $bagian_keuangan="active";}
	else if ($_GET['page'] == 'simpan_tambah_akse_masuk') {
		$akse = "active";
		$akse1 = "active";
		$gudang = "active";
	} else if ($_GET['page'] == 'simpan_tambah_akse_masuk2') {
		$akse = "active";
		$akse1 = "active";
		$gudang = "active";
	} else if ($_GET['page'] == 'simpan_tambah_akse_masuk3') {
		$akse = "active";
		$akse1 = "active";
		$gudang = "active";
	} else if ($_GET['page'] == 'simpan_tambah_akse_masuk4') {
		$akse = "active";
		$akse1 = "active";
		$gudang = "active";
	} else if ($_GET['page'] == 'simpan_tambah_akse5') {
		$akse = "active";
		$akse1 = "active";
		$gudang = "active";
	} else if ($_GET['page'] == 'simpan_tambah_akse6') {
		$akse = "active";
		$akse1 = "active";
		$gudang = "active";
	} else if ($_GET['page'] == 'tambah_akse') {
		$akse = "active";
		$akse1 = "active";
		$gudang = "active";
		$bagian_keuangan = "active";
		$sub_act2_1 = "active";
		$sub_act2_1_2 = "active";
	} else if ($_GET['page'] == 'ubah_akse2') {
		$akse = "active";
		$akse1 = "active";
		$gudang = "active";
	} else if ($_GET['page'] == 'ubah_akse_jual2') {
		$act2 = "active";
		$akse = "active";
		$gudang = "active";
	} else if ($_GET['page'] == 'ubah_barang_masuk' or $_GET['page'] == 'ubah_barang_masuk_terjual' or $_GET['page'] == 'ubah_barang_masuk_rusak' or $_GET['page'] == 'ubah_barang_masuk_tidak_layak') {
		$act2 = "active";
		$sub_act2_1 = "active";
		$gudang = "active";
		$bagian_keuangan = "active";
	} else if ($_GET['page'] == 'tambah_barang_masuk') {
		$act2 = "active";
		$sub_act2_1 = "active";
		$gudang = "active";
		$bagian_keuangan = "active";
	} else if ($_GET['page'] == 'jual_barang3') {
		$act2 = "active";
		$sub_act2_1 = "active";
		$gudang = "active";
	}
	//else if ($_GET['page']=='jual_alkes') { $act2="active"; $sub_act2_2="active"; $bagian_keuangan="active";}
	//else if ($_GET['page']=='jual_alkes2') { $act2="active"; $sub_act2_2="active"; $bagian_keuangan="active";}
	else if ($_GET['page'] == 'jual_barang2') {
		$act2 = "active";
		$sub_act2_1 = "active";
		$gudang = "active";
	} else if ($_GET['page'] == 'detail_jual_barang' or $_GET['page'] == 'jual_barang' or $_GET['page'] == 'pilih_no_seri' or $_GET['page'] == 'kirim_data') {
		$act2 = "active";
		$sub_act2_2 = "active";
		$gudang = "active";
	} else if ($_GET['page'] == 'jual_barang_uang' or $_GET['page'] == 'ubah_barang_jual2_uang' or $_GET['page'] == 'ubah_jual_barang_uang' or $_GET['page'] == 'jual_alkes' or $_GET['page'] == 'jual_alkes2' or $_GET['page'] == 'simpan_jual_alkes2' or $_GET['page'] == 'simpan_jual_alkes3' or $_GET['page'] == 'simpan_jual_alkes') {
		$act2_2 = "active";
		$sub_act2_2 = "active";
		$sub_act2_2_1 = "active";
		$bagian_keuangan = "active";
	} else if ($_GET['page'] == 'penjualan_aksesoris_uang' or $_GET['page'] == 'jual_akse' or $_GET['page'] == 'simpan_jual_akse' or $_GET['page'] == 'ubah_akse_jual_uang' or $_GET['page'] == 'ubah_jual_akse_uang') {
		$act2_2 = "active";
		$sub_act2_3 = "active";
		$bagian_keuangan = "active";
	} else if ($_GET['page'] == 'penjualan_inventory' or $_GET['page'] == 'jual_inventory' or $_GET['page'] == 'jual_inventory2' or $_GET['page'] == 'simpan_jual_inventory2' or $_GET['page'] == 'simpan_jual_inventory' or $_GET['page'] == 'ubah_jual_inventory_uang') {
		$act2_2 = "active";
		$sub_act2_4 = "active";
		$bagian_keuangan = "active";
	} else if ($_GET['page'] == 'akun_manajer_gudang') {
		$act10 = "active";
		$manajer = "active";
		$manajer_gudang = "active";
	} else if ($_GET['page'] == 'akun_manajer_teknisi') {
		$act10 = "active";
		$manajer = "active";
		$manajer_teknisi = "active";
	} else if ($_GET['page'] == 'akun_manajer_keuangan') {
		$act10 = "active";
		$manajer = "active";
		$manajer_keuangan = "active";
	} else if ($_GET['page'] == 'akun_manajer_marketing' or $_GET['page'] == 'ubah_manajer_marketing') {
		$act10 = "active";
		$manajer = "active";
		$manajer_marketing = "active";
	} else if ($_GET['page'] == 'ubah_barang_jual2') {
		$act2 = "active";
		$sub_act2_2 = "active";
		$gudang = "active";
		$bagian_keuangan = "active";
	} else if ($_GET['page'] == 'tambah_barang_jual') {
		$act2 = "active";
		$sub_act2_2 = "active";
		$gudang = "active";
	} else if ($_GET['page'] == 'tambah_barang_jual_banyak') {
		$act2 = "active";
		$sub_act2_2 = "active";
		$gudang = "active";
	} else if ($_GET['page'] == 'kirim_barang' or $_GET['page'] == 'riwayat_panggilan' or $_GET['page'] == 'kartu_garansi') {
		$act2 = "active";
		$sub_act2_3 = "active";
		$gudang = "active";
		$bagian_cs = "active";
		$kirim_barang_cs = "active";
		$bagian_keuangan = "active";
		$kirim_barang_uang = "active";
		$kirim_barang_uang1 = "active";
		$kirim_barang_uang1_1 = "active";
		$kirim_teknisi = "active";
		$bagian_teknisi = "active";
	} else if ($_GET['page'] == 'simpan_kirim_barang') {
		$act2 = "active";
		$sub_act2_3 = "active";
		$gudang = "active";
	} else if ($_GET['page'] == 'spi' or $_GET['page'] == 'tambah_spk_masuk' or $_GET['page'] == 'tambah_spk_masuk2') {
		$act2 = "active";
		$sub_act2_3_3 = "active";
		$gudang = "active";
	} else if ($_GET['page'] == 'kirim_barang_pengganti' or $_GET['page'] == 'pilih_no_seri_pengganti') {
		$act2 = "active";
		$kirim_barang_pengganti = "active";
		$gudang = "active";
	} else if ($_GET['page'] == 'ubah_barang_kirim') {
		$act2 = "active";
		$sub_act2_3 = "active";
		$gudang = "active";
	} else if ($_GET['page'] == 'tambah_barang_kirim') {
		$act2 = "active";
		$sub_act2_3 = "active";
		$gudang = "active";
	} else if ($_GET['page'] == 'kasbon_perjalanan_dinas' or $_GET['page'] == 'tambah_kasbon_perjalanan_dinas' or $_GET['page'] == 'ubah_kasbon_perjalanan_dinas') {
		$bagian_teknisi = "active";
		$kasbon = "active";
		$kasbon_perjalanan_dinas = "active";
	} else if ($_GET['page'] == 'kasbon_pembelian') {
		$bagian_teknisi = "active";
		$kasbon = "active";
		$kasbon_pembelian = "active";
	} else if ($_GET['page'] == 'uji_fungsi_instalasi') {
		$bagian_teknisi = "active";
		$act3 = "active";
	} else if ($_GET['page'] == 'simpan_tambah_uji') {
		$bagian_teknisi = "active";
		$act3 = "active";
	} else if ($_GET['page'] == 'tambah_uji') {
		$act3 = "active";
	} else if ($_GET['page'] == 'ubah_uji') {
		$bagian_teknisi = "active";
		$act3 = "active";
	} else if ($_GET['page'] == 'pelatihan_alat' or $_GET['page'] == 'pilih_alat_pelatihan'  or $_GET['page'] == 'tambah_pelatihan2' or $_GET['page'] == 'tambah_peserta_pelatihan2') {
		$bagian_teknisi = "active";
		$act4 = "active";
	} else if ($_GET['page'] == 'rekapan_instalasi') {
		$bagian_teknisi = "active";
		$rekapan_instalasi = "active";
	} else if ($_GET['page'] == 'pelatihan_alat_lama') {
		$bagian_teknisi = "active";
		$act4 = "active";
	} else if ($_GET['page'] == 'tambah_pelatihan') {
		$bagian_teknisi = "active";
		$act4 = "active";
	} else if ($_GET['page'] == 'ubah_latih') {
		$bagian_teknisi = "active";
		$act4 = "active";
	} else if ($_GET['page'] == 'tambah_peserta_pelatihan') {
		$act4 = "active";
		$bagian_teknisi = "active";
	} else if ($_GET['page'] == 'sertifikat') {
		$bagian_teknisi = "active";
		$act4 = "active";
	} else if ($_GET['page'] == 'barang') {
		$bagian_teknisi = "active";
		$act5 = "active";
	} else if ($_GET['page'] == 'tambah_barang') {
		$act5 = "active";
	} else if ($_GET['page'] == 'ubah_barang') {
		$act5 = "active";
	} else if ($_GET['page'] == 'laporan_kerusakan') {
		$bagian_teknisi = "active";
		$bagian_cs = "active";
		$act6 = "active";
	} else if ($_GET['page'] == 'laporan_kerusakan_lama' or $_GET['page'] == 'pilih_no_seri_teknisi') {
		$bagian_teknisi = "active";
		$act6 = "active";
	} else if ($_GET['page'] == 'detail_laporan_kerusakan_lama') {
		$bagian_teknisi = "active";
		$act6 = "active";
	} else if ($_GET['page'] == 'tambah_laporan' or $_GET['page'] == 'simpan_tambah_laporan') {
		$bagian_teknisi = "active";
		$act6 = "active";
	} else if ($_GET['page'] == 'ubah_laporan') {
		$bagian_teknisi = "active";
		$act6 = "active";
	} else if ($_GET['page'] == 'barang_kembali_teknisi' or $_GET['page'] == 'barang_kembali_pilih_teknisi') {
		$bagian_teknisi = "active";
		$barang_kembali_teknisi = "active";
	} else if ($_GET['page'] == 'progress_barang_kembali' or $_GET['page'] == 'progress_barang_kembali_detail' or $_GET['page'] == 'tambah_progress_barang_kembali' or $_GET['page'] == 'tambah_progress_barang_kembali2') {
		$bagian_teknisi = "active";
		$progress_barang_kembali = "active";
	} else if ($_GET['page'] == 'detail_laporan_kerusakan_cs') {
		$bagian_teknisi = "active";
		$act7 = "active";
	} else if ($_GET['page'] == 'pembuatan_spk') {
		$bagian_teknisi = "active";
		$act7 = "active";
	} else if ($_GET['page'] == 'pembuatan_spk2') {
		$bagian_teknisi = "active";
		$act7 = "active";
	} else if ($_GET['page'] == 'detail_pembuatan_spk2') {
		$bagian_teknisi = "active";
		$act7 = "active";
	} else if ($_GET['page'] == 'buat_spk') {
		$bagian_teknisi = "active";
		$act7 = "active";
	} else if ($_GET['page'] == 'tambah_spk') {
		$bagian_teknisi = "active";
		$act7 = "active";
	} else if ($_GET['page'] == 'ubah_spk') {
		$bagian_teknisi = "active";
		$act7 = "active";
	} else if ($_GET['page'] == 'progress_pengerjaan') {
		$bagian_teknisi = "active";
		$act8 = "active";
	} else if ($_GET['page'] == 'progress_pengerjaan2') {
		$bagian_teknisi = "active";
		$act8 = "active";
	} else if ($_GET['page'] == 'progress_pengerjaan3') {
		$bagian_teknisi = "active";
		$act8 = "active";
	} else if ($_GET['page'] == 'progress_pengerjaan4') {
		$bagian_teknisi = "active";
		$act8 = "active";
	} else if ($_GET['page'] == 'progress_pengerjaan5') {
		$bagian_teknisi = "active";
		$act8 = "active";
	} else if ($_GET['page'] == 'detail_progress') {
		$bagian_teknisi = "active";
		$act8 = "active";
	} else if ($_GET['page'] == 'tambah_progress') {
		$bagian_teknisi = "active";
		$act8 = "active";
	} else if ($_GET['page'] == 'replacement') {
		$bagian_teknisi = "active";
		$act8 = "active";
	} else if ($_GET['page'] == 'teknisi') {
		$act10 = "active";
		$akun = "active";
		$teknisi = "active";
	} else if ($_GET['page'] == 'tambah_teknisi') {
		$act10 = "active";
		$akun = "active";
		$teknisi = "active";
	} else if ($_GET['page'] == 'ubah_teknisi') {
		$act10 = "active";
		$akun = "active";
		$teknisi = "active";
	} else if ($_GET['page'] == 'akun_admin') {
		$act10 = "active";
		$administrator = "active";
	} else if ($_GET['page'] == 'riwayat_login') {
		$act10 = "active";
		$riwayat_login = "active";
	} else if ($_GET['page'] == 'akun_admin_gudang') {
		$act10 = "active";
		$akun = "active";
		$admin_gudang = "active";
	} else if ($_GET['page'] == 'akun_admin_po_dalam' or $_GET['page'] == 'tambah_admin_po_dalam') {
		$act10 = "active";
		$akun = "active";
		$admin_po_dalam = "active";
	} else if ($_GET['page'] == 'akun_admin_po_luar' or $_GET['page'] == 'tambah_admin_po_luar') {
		$act10 = "active";
		$akun = "active";
		$admin_po_luar = "active";
	} else if ($_GET['page'] == 'akun_admin_keuangan') {
		$act10 = "active";
		$akun = "active";
		$admin_keuangan = "active";
	} else if ($_GET['page'] == 'akun_cs') {
		$act10 = "active";
		$akun = "active";
		$cs = "active";
	} else if ($_GET['page'] == 'pjt' or $_GET['page'] == 'tambah_pjt' or $_GET['page'] == 'ubah_pjt') {
		$act10 = "active";
		$akun = "active";
		$pjt = "active";
	} else if ($_GET['page'] == 'sales_admin' or $_GET['page'] == 'tambah_sales_admin' or $_GET['page'] == 'ubah_sales_admin') {
		$act10 = "active";
		$akun = "active";
		$sales_admin = "active";
	} else if ($_GET['page'] == 'akun_admin_teknisi') {
		$act10 = "active";
		$akun = "active";
		$admin_teknisi = "active";
	} else if ($_GET['page'] == 'akun_admin') {
		$act10 = "active";
		$administrator = "active";
	} else if ($_GET['page'] == 'akun_admin') {
		$act10 = "active";
		$administrator = "active";
	} else if ($_GET['page'] == 'akun_user') {
		$bagian_cs = "active";
		$akun_user = "active";
		$bagian_teknisi = "active";
		$act_user = "active";
	}
	//else if ($_GET['page']=='kirim_barang_cs') {$bagian_cs="active"; $kirim_barang_cs="active"; }
	else if ($_GET['page'] == 'data_riwayat_panggilan') {
		$bagian_cs = "active";
		$riwayat_kirim_barang_cs = "active";
	} else if ($_GET['page'] == 'laporan_kerusakan_cs' or $_GET['page'] == 'tambah_laporan_cs' or $_GET['page'] == 'simpan_tambah_laporan_cs' or $_GET['page'] == 'laporan_kerusakan_lama_cs') {
		$bagian_cs = "active";
		$laporan_kerusakan_cs = "active";
	} else if ($_GET['page'] == 'ubah_user') {
		$bagian_teknisi = "active";
		$act_user = "active";
	} else if ($_GET['page'] == 'pemusnahan_alkes') {
		$act11 = "active";
	} else if ($_GET['page'] == 'laporan_barang_masuk') {
		$act12 = "active";
		$act12_1 = "active";
	} else if ($_GET['page'] == 'laporan_jual_barang') {
		$act12 = "active";
		$act12_2 = "active";
	} else if ($_GET['page'] == 'laporan_kerusakan_barang') {
		$act12 = "active";
		$act12_3 = "active";
	} else if ($_GET['page'] == 'laporan_penjualan_alkes') {
		$act12 = "active";
		$act_lap_akes = "active";
	} else if ($_GET['page'] == 'laporan_pembelian_alkes1') {
		$act12 = "active";
		$act_lap_beli_akes = "active";
		$dalam_negeri = "active";
	} else if ($_GET['page'] == 'laporan_pembelian_alkes2') {
		$act12 = "active";
		$act_lap_beli_akes = "active";
		$luar_negeri = "active";
	} else if ($_GET['page'] == 'laporan_spk') {
		$act12 = "active";
		$act12_4 = "active";
	} else if ($_GET['page'] == 'laporan_teknisi') {
		$act12 = "active";
		$act12_5 = "active";
	} else if ($_GET['page'] == 'spk_masuk' or $_GET['page'] == 'pilih_teknisi') {
		$act_spk_masuk = "active";
		$bagian_teknisi = "active";
	} else if ($_GET['page'] == 'ubah_spk_masuk') {
		$act_spk_masuk = "active";
		$bagian_teknisi = "active";
	} else if ($_GET['page'] == 'penyebaran_alkes') {
		$act_penyebaran_alkes = "active";
		// $act2 = "active";
		$gudang = "active";
	} else if ($_GET['page'] == 'grafik_in_out') {
		$grafik_in_out = "active";
		// $act2 = "active";
		$gudang = "active";
	} else if ($_GET['page'] == 'deposit_ke_gudang') {
		$act_deposit = "active";
	} else if ($_GET['page'] == 'pengeluaran') {
		$act_pengeluaran = "active";
	} else if ($_GET['page'] == 'tambah_pengeluaran') {
		$act_pengeluaran = "active";
	} else if ($_GET['page'] == 'ubah_pengeluaran') {
		$act_pengeluaran = "active";
	} else if ($_GET['page'] == 'utang' or $_GET['page'] == 'tambah_utang' or $_GET['page'] == 'ubah_utang' or $_GET['page'] == 'bayar_utang') {
		$utang_piutang = "active";
		$utang_piutang1 = "active";
		$dagang = "active";
		$utang = "active";
		$bagian_keuangan = "active";
	} else if ($_GET['page'] == 'utang_set' or $_GET['page'] == 'tambah_utang_set' or $_GET['page'] == 'ubah_utang_set' or $_GET['page'] == 'bayar_utang_set') {
		$utang_piutang = "active";
		$utang_piutang1_1 = "active";
		$dagang = "active";
		$utang_set = "active";
		$bagian_keuangan = "active";
	} else if ($_GET['page'] == 'utang_aksesoris' or $_GET['page'] == 'tambah_utang_aksesoris' or $_GET['page'] == 'ubah_utang_aksesoris' or $_GET['page'] == 'bayar_utang_aksesoris') {
		$dagang = "active";
		$utang_piutang = "active";
		$utang_piutang2 = "active";
		$utang_akse = "active";
		$bagian_keuangan = "active";
	} else if ($_GET['page'] == 'utang_inventory' or $_GET['page'] == 'tambah_utang_inventory' or $_GET['page'] == 'ubah_utang_inventory' or $_GET['page'] == 'bayar_utang_inventory') {
		$inventoris = "active";
		$utang_piutang = "active";
		$utang_piutang2 = "active";
		$inventoris1 = "active";
		$bagian_keuangan = "active";
	} else if ($_GET['page'] == 'piutang_inventory' or $_GET['page'] == 'tambah_piutang_inventory' or $_GET['page'] == 'ubah_piutang_inventory' or $_GET['page'] == 'bayar_piutang_inventory') {
		$inventoris = "active";
		$utang_piutang = "active";
		$utang_piutang2 = "active";
		$inventoris2 = "active";
		$bagian_keuangan = "active";
	} else if ($_GET['page'] == 'piutang' or $_GET['page'] == 'tambah_piutang' or $_GET['page'] == 'ubah_piutang' or $_GET['page'] == 'bayar_piutang') {
		$utang_piutang = "active";
		$dagang = "active";
		$utang_piutang1 = "active";
		$piutang = "active";
		$bagian_keuangan = "active";
	} else if ($_GET['page'] == 'piutang_aksesoris' or $_GET['page'] == 'tambah_piutang_aksesoris' or $_GET['page'] == 'ubah_piutang_aksesoris' or $_GET['page'] == 'bayar_piutang_aksesoris') {
		$utang_piutang = "active";
		$utang_piutang2 = "active";
		$piutang_akse = "active";
		$dagang = "active";
		$bagian_keuangan = "active";
	} else if ($_GET['page'] == 'laporan_kas_harian') {
		$laporan_kas = "active";
		$harian = "active";
		$bagian_keuangan = "active";
	} else if ($_GET['page'] == 'nasabah') {
		$nasabah = "active";
		$simpan_pinjam = "active";
	} else if ($_GET['page'] == 'tabungan' || $_GET['page'] == 'detail_tabungan') {
		$tabungan = "active";
		$simpan_pinjam = "active";
	} else if ($_GET['page'] == 'pinjaman' || $_GET['page'] == 'detail_pinjaman') {
		$pinjaman = "active";
		$simpan_pinjam = "active";
	} else if ($_GET['page'] == 'laporan_neraca') {
		$laporan_kas = "active";
		$laporan_neraca = "active";
		$bagian_keuangan = "active";
	} else if ($_GET['page'] == 'laporan_laba_rugi') {
		$laporan_kas = "active";
		$laporan_laba_rugi = "active";
		$bagian_keuangan = "active";
	} else if ($_GET['page'] == 'laporan_kas_bulanan') {
		$laporan_kas = "active";
		$bulanan = "active";
		$bagian_keuangan = "active";
	} else if ($_GET['page'] == 'laporan_kas_tahunan') {
		$laporan_kas = "active";
		$tahunan = "active";
		$bagian_keuangan = "active";
	} else if ($_GET['page'] == 'kategori' or $_GET['page'] == 'tambah_kategori' or $_GET['page'] == 'ubah_kategori') {
		$pengaturan_akun = "active";
		$kategori = "active";
		$bagian_keuangan = "active";
	} else if ($_GET['page'] == 'mata_uang' or $_GET['page'] == 'ubah_mata_uang' or $_GET['page'] == 'tambah_mata_uang') {
		$pengaturan_akun = "active";
		$mata_uang = "active";
		$bagian_keuangan = "active";
	} else if ($_GET['page'] == 'marketing' or $_GET['page'] == 'ubah_marketing' or $_GET['page'] == 'tambah_marketing') {
		$pengaturan_akun = "active";
		$marketing = "active";
		$bagian_keuangan = "active";
	} else if ($_GET['page'] == 'riwayat_pemasukan' or $_GET['page'] == 'detail_riwayat_pemasukan') {
		$pengaturan_akun = "active";
		$riwayat_pemasukan = "active";
		$bagian_keuangan = "active";
	} else if ($_GET['page'] == 'riwayat_pengeluaran' or $_GET['page'] == 'detail_riwayat_pengeluaran') {
		$pengaturan_akun = "active";
		$riwayat_pengeluaran = "active";
		$bagian_keuangan = "active";
	} else {
		$act1 = "active";
	}
}
