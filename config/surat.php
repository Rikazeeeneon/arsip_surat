<?php

return [

    /*
    |--------------------------------------------------------------------------
    | ASAL SURAT
    |--------------------------------------------------------------------------
    */
    'asal_surat' => [
        'Mendagri',
        'Kemendagri',
        'Kemenlu',
        'Provinsi Se Indonesia',
        'Kabupaten Se Indonesia',
        'Badan Siber dan Sandi Negara',
        'Lainnya',
    ],

    /*
    |--------------------------------------------------------------------------
    | TUJUAN SURAT (GUB, WAGUB, SEKDA, OPD)
    |--------------------------------------------------------------------------
    */
    'tujuan_surat' => [
        'Gubernur Sulawesi Selatan',
        'Wakil Gubernur Sulawesi Selatan',
        'Sekretaris Daerah Provinsi Sulawesi Selatan',
        'Badan Kesatuan Bangsa dan Politik Provinsi Sulawesi Selatan',
        'Badan Keuangan dan Aset Daerah Provinsi Sulawesi Selatan',
        'Badan Kepegawaian Daerah Provinsi Sulawesi Selatan',
        'Badan Penanggulangan Bencana Daerah Provinsi Sulawesi Selatan',
        'Badan Pendapatan Daerah Provinsi Sulawesi Selatan',
        'Badan Pengembangan Sumber Daya Manusia Provinsi Sulawesi Selatan',
        'Badan Penghubung Provinsi Sulawesi Selatan',
        'Badan Perencanaan, Pembangunan, Penelitian dan Pengembangan Daerah Provinsi Sulawesi Selatan',
        'Biro Umum Setda Provinsi Sulawesi Selatan',
        'Biro Hukum Setda Provinsi Sulawesi Selatan',
        'Biro Organisasi Setda Provinsi Sulawesi Selatan',
        'Biro Pengadaan Barang dan Jasa Setda Provinsi Sulawesi Selatan',
        'Biro Ekonomi dan Administrasi Pembangunan Setda Provinsi Sulawesi Selatan',
        'Biro Pemerintahan dan Otonomi Daerah Setda Provinsi Sulawesi Selatan',
        'Biro Kesejahteraan Setda Provinsi Sulawesi Selatan',
        'Dinas Kominfo Statistik dan Persandian Provinsi Sulawesi Selatan',
        'Dinas Kependudukan dan Pencatatan Sipil Provinsi Sulawesi Selatan',
        'Dinas Lingkungan Hidup dan Kehutanan Provinsi Sulawesi Selatan',
        'Dinas Pendidikan Provinsi Sulawesi Selatan',
        'Dinas Kesehatan Provinsi Sulawesi Selatan',
        'Dinas Tenaga Kerja dan Transmigrasi Provinsi Sulawesi Selatan',
        'Dinas Perhubungan Provinsi Sulawesi Selatan',
        'Dinas Kepemudaan dan Olahraga Provinsi Sulawesi Selatan',
        'Dinas Perpustakaan dan Kearsipan Provinsi Sulawesi Selatan',
        'Dinas Pemberdayaan Masyarakat dan Desa Provinsi Sulawesi Selatan',
        'DPMPTSP Provinsi Sulawesi Selatan',
        'Dinas Sosial Provinsi Sulawesi Selatan',
        'Dinas Energi dan Sumber Daya Mineral Provinsi Sulawesi Selatan',
        'Dinas SDA Cipta Karya dan Tata Ruang Provinsi Sulawesi Selatan',
        'Dinas Bina Marga dan Bina Konstruksi Provinsi Sulawesi Selatan',
        'Dinas Perumahan Kawasan Permukiman dan Pertanahan Provinsi Sulawesi Selatan',
        'Dinas Koperasi dan UMKM Provinsi Sulawesi Selatan',
        'Dinas Peternakan dan Kesehatan Hewan Provinsi Sulawesi Selatan',
        'Dinas Kelautan dan Perikanan Provinsi Sulawesi Selatan',
        'Dinas Perindustrian dan Perdagangan Provinsi Sulawesi Selatan',
        'Dinas Kebudayaan dan Kepariwisataan Provinsi Sulawesi Selatan',
        'Dinas Tanaman Pangan Hortikultura dan Perkebunan Provinsi Sulawesi Selatan',
        'Dinas Ketahanan Pangan Provinsi Sulawesi Selatan',
        'DP3A Dalduk KB Provinsi Sulawesi Selatan',
        'Satuan Polisi Pamong Praja Provinsi Sulawesi Selatan',
        'Inspektorat Provinsi Sulawesi Selatan',
        'Sekretariat DPRD Provinsi Sulawesi Selatan',
        'Lainnya',
    ],

    /*
    |--------------------------------------------------------------------------
    | TEMBUSAN SURAT (OPD)
    |--------------------------------------------------------------------------
    */
    'tembusan_surat' => [
        // ISINYA SAMA DENGAN TUJUAN, TAPI DIPISAH SECARA LOGIKA
        // (sengaja dipisah untuk kejelasan data)
        ...[
            'Gubernur Sulawesi Selatan',
            'Wakil Gubernur Sulawesi Selatan',
            'Sekretaris Daerah Provinsi Sulawesi Selatan',
           'Badan Kesatuan Bangsa dan Politik Provinsi Sulawesi Selatan',
        'Badan Keuangan dan Aset Daerah Provinsi Sulawesi Selatan',
        'Badan Kepegawaian Daerah Provinsi Sulawesi Selatan',
        'Badan Penanggulangan Bencana Daerah Provinsi Sulawesi Selatan',
        'Badan Pendapatan Daerah Provinsi Sulawesi Selatan',
        'Badan Pengembangan Sumber Daya Manusia Provinsi Sulawesi Selatan',
        'Badan Penghubung Provinsi Sulawesi Selatan',
        'Badan Perencanaan, Pembangunan, Penelitian dan Pengembangan Daerah Provinsi Sulawesi Selatan',
        'Biro Umum Setda Provinsi Sulawesi Selatan',
        'Biro Hukum Setda Provinsi Sulawesi Selatan',
        'Biro Organisasi Setda Provinsi Sulawesi Selatan',
        'Biro Pengadaan Barang dan Jasa Setda Provinsi Sulawesi Selatan',
        'Biro Ekonomi dan Administrasi Pembangunan Setda Provinsi Sulawesi Selatan',
        'Biro Pemerintahan dan Otonomi Daerah Setda Provinsi Sulawesi Selatan',
        'Biro Kesejahteraan Setda Provinsi Sulawesi Selatan',
        'Dinas Kominfo Statistik dan Persandian Provinsi Sulawesi Selatan',
        'Dinas Kependudukan dan Pencatatan Sipil Provinsi Sulawesi Selatan',
        'Dinas Lingkungan Hidup dan Kehutanan Provinsi Sulawesi Selatan',
        'Dinas Pendidikan Provinsi Sulawesi Selatan',
        'Dinas Kesehatan Provinsi Sulawesi Selatan',
        'Dinas Tenaga Kerja dan Transmigrasi Provinsi Sulawesi Selatan',
        'Dinas Perhubungan Provinsi Sulawesi Selatan',
        'Dinas Kepemudaan dan Olahraga Provinsi Sulawesi Selatan',
        'Dinas Perpustakaan dan Kearsipan Provinsi Sulawesi Selatan',
        'Dinas Pemberdayaan Masyarakat dan Desa Provinsi Sulawesi Selatan',
        'DPMPTSP Provinsi Sulawesi Selatan',
        'Dinas Sosial Provinsi Sulawesi Selatan',
        'Dinas Energi dan Sumber Daya Mineral Provinsi Sulawesi Selatan',
        'Dinas SDA Cipta Karya dan Tata Ruang Provinsi Sulawesi Selatan',
        'Dinas Bina Marga dan Bina Konstruksi Provinsi Sulawesi Selatan',
        'Dinas Perumahan Kawasan Permukiman dan Pertanahan Provinsi Sulawesi Selatan',
        'Dinas Koperasi dan UMKM Provinsi Sulawesi Selatan',
        'Dinas Peternakan dan Kesehatan Hewan Provinsi Sulawesi Selatan',
        'Dinas Kelautan dan Perikanan Provinsi Sulawesi Selatan',
        'Dinas Perindustrian dan Perdagangan Provinsi Sulawesi Selatan',
        'Dinas Kebudayaan dan Kepariwisataan Provinsi Sulawesi Selatan',
        'Dinas Tanaman Pangan Hortikultura dan Perkebunan Provinsi Sulawesi Selatan',
        'Dinas Ketahanan Pangan Provinsi Sulawesi Selatan',
        'DP3A Dalduk KB Provinsi Sulawesi Selatan',
        'Satuan Polisi Pamong Praja Provinsi Sulawesi Selatan',
        'Inspektorat Provinsi Sulawesi Selatan',
        'Sekretariat DPRD Provinsi Sulawesi Selatan',
        'Lainnya',
        ]
    ],

    /*
    |--------------------------------------------------------------------------
    | TUJUAN KABUPATEN / KOTA SE SULSEL
    |--------------------------------------------------------------------------
    */
    'kabkota' => [
        '24 Kab Kota Se Sulsel',
        'Kota Makassar',
        'Kabupaten Gowa',
        'Kabupaten Takalar',
        'Kabupaten Jeneponto',
        'Kabupaten Bantaeng',
        'Kabupaten Bulukumba',
        'Kabupaten Kepulauan Selayar',
        'Kabupaten Sinjai',
        'Kota Parepare',
        'Kabupaten Maros',
        'Kabupaten Pangkep',
        'Kabupaten Barru',
        'Kabupaten Sidrap',
        'Kabupaten Bone',
        'Kabupaten Soppeng',
        'Kabupaten Wajo',
        'Kota Palopo',
        'Kabupaten Pinrang',
        'Kabupaten Enrekang',
        'Kabupaten Luwu',
        'Kabupaten Luwu Utara',
        'Kabupaten Luwu Timur',
        'Kabupaten Tana Toraja',
        'Kabupaten Toraja Utara',
    ],
];
