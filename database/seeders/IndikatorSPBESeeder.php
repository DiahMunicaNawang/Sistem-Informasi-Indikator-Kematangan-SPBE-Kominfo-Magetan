<?php

namespace Database\Seeders;

use Carbon\Carbon;
use App\Models\User;
use App\Models\IndikatorSPBE;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Faker\Factory as Faker;

class IndikatorSPBESeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();
        IndikatorSPBE::insert([
            // indikator 1
            [
                'name' => 'Tingkat Kematangan Kebijakan Internal Arsitektur SPBE Instansi Pusat/Pemerintah Daerah',
                'explanation' => '<ol type="a">
                                    <li>
                                        Arsitektur SPBE adalah kerangka dasar yang mendeskripsikan integrasi proses
                                        bisnis, data dan informasi, infrastruktur SPBE, aplikasi SPBE, dan keamanan
                                        SPBE untuk menghasilkan layanan SPBE yang terintegrasi.
                                    </li>
                                    <li>
                                        Kebijakan internal Arsitektur SPBE merupakan pengaturan mengenai Arsitektur
                                        SPBE di Instansi Pusat dan Pemerintah Daerah yang bertujuan untuk memberikan
                                        panduan dalam pelaksanaan integrasi Proses Bisnis, Data dan Informasi,
                                        Infrastruktur SPBE, Aplikasi SPBE, dan Keamanan SPBE untuk menghasilkan
                                        Layanan SPBE yang terpadu.
                                    </li>
                                    <li>
                                        Referensi Arsitektur dan Domain Arsitektur SPBE terdiri dari:
                                        <ol class="1">
                                        <li>Proses Bisnis</li>
                                        <li>Data dan Informasi</li>
                                        <li>Infrastruktur SPBE</li>
                                        <li>Aplikasi SPBE</li>
                                        <li>Keamanan SPBE</li>
                                        <li>Layanan SPBE</li>
                                        </ol>
                                    </li>
                                    </ol>',
                'rule_information' => 'PEDOMAN MENTERI PENDAYAGUNAAN APARATUR NEGARAN DAN REFORMASI BIROKRASI REPUBLIK INDONESIA',
                'criteria' => 'Penilaian dilakukan terhadap pengaturan/norma yang memenuhi keselarasan referensi Arsitektur SPBE Nasional dan 6 (enam) Domain Arsitektur SPBE melalui kebijakan yang telah ditetapkan.',
                'current_level' => 'Level 1 - Konsep kebijakan internal terkait Arsitektur SPBE Instansi Pusat/Pemerintah Daerah belum atau telah tersedia.',
                'target_level' => 'Level 5 - Kriteria tingkat 4 telah terpenuhi serta hasil reviu dan evaluasi kebijakan internal Arsitektur Instansi Pusat/Pemerintah Daerah SPBE telah ditindaklanjuti dengan kebijakan baru.',
                'related_documentation' => null,
                'person_in_charge' => $faker->name,
                'date_added' => Carbon::now(),
                'last_updated_date' => Carbon::now(),
                'status' => 'active',
            ],
            // indikator 2
            [
                'name' => 'Tingkat Kematangan Kebijakan Internal Peta Rencana SPBE Instansi Pusat/Pemerintah Daerah.',
                'explanation' => '<ol type="a">
                                    <li>
                                        Peta Rencana SPBE adalah dokumen yang mendeskripsikan arah dan langkah
                                        penyiapan serta pelaksanaan SPBE yang terintegrasi.
                                    </li>
                                    <li>
                                        Kebijakan internal Peta Rencana SPBE merupakan pengaturan mengenai Peta
                                        Rencana SPBE di Instansi Pusat/Pemerintah Daerah yang bertujuan untuk
                                        memberikan panduan arah dan langkah dalam penyiapan dan pelaksanaan SPBE di
                                        Instansi Pusat/Pemerintah Daerah.
                                    </li>
                                    <li>
                                        <ol type="a">
                                        <li>Tata Kelola SPBE</li>
                                        <li>Manajemen SPBE</li>
                                        <li>Layanan SPBE</li>
                                        <li>Infrastruktur SPBE</li>
                                        <li>Aplikasi SPBE</li>
                                        <li>Keamanan SPBE</li>
                                        <li>Audit TIK</li>
                                        </ol>
                                    </li>
                                    </ol>
                                    ',
                'rule_information' => 'PEDOMAN MENTERI PENDAYAGUNAAN APARATUR NEGARAN DAN REFORMASI BIROKRASI REPUBLIK INDONESIA',
                'criteria' => 'Penilaian dilakukan terhadap pengaturan/norma yang memenuhi 7 (tujuh) muatan Peta Rencana SPBE melalui kebijakan yang telah ditetapkan.',
                'current_level' => 'Level 1 - Konsep kebijakan internal terkait Peta Rencana SPBE Instansi Pusat/Pemerintah Daerah belum tersedia atau masih dalam bentuk draft.',
                'target_level' => 'Level 5 - Kriteria tingkat 4 telah terpenuhi serta hasil reviu dan evaluasi kebijakan internal Peta Rencana Instansi Pusat/Pemerintah Daerah SPBE telah ditindaklanjuti dengan kebijakan baru.',
                'related_documentation' => null,
                'person_in_charge' => $faker->name,
                'date_added' => Carbon::now(),
                'last_updated_date' => Carbon::now(),
                'status' => 'active',
            ],
            // Indikator 3
            [
                'name' => 'Tingkat Kematangan Kebijakan Internal Manajemen Data',
                'explanation' => '<ol type="a">
                            <li>Manajemen Data bertujuan untuk menjamin terwujudnya data yang akurat, mutakhir, terintegrasi, dan dapat diakses sebagai dasar perencanaan, pelaksanaan, evaluasi, dan pengendalian pembangunan nasional.</li>
                            <li>Manajemen Data dilakukan melalui serangkaian proses pengelolaan Arsitektur Data, Data Induk, Data Referensi, Basis Data, Kualitas Data, dan Interoperabilitas Data.</li>
                            <li>Kebijakan Internal Manajemen Data merupakan pengaturan mengenai Manajemen Data di Instansi Pusat dan Pemerintah Daerah.</li>
                        </ol>',
                'rule_information' => 'PEDOMAN MENTERI PENDAYAGUNAAN APARATUR NEGARA DAN REFORMASI BIROKRASI REPUBLIK INDONESIA',
                'criteria' => 'Penilaian dilakukan terhadap pengaturan/norma yang telah mengatur seluruh proses manajemen data melalui kebijakan yang telah ditetapkan.',
                'current_level' => 'Level 1 - Konsep kebijakan internal terkait Manajemen Data di Instansi Pusat/Pemerintah Daerah belum atau telah tersedia.',
                'target_level' => 'Level 5 - Kriteria tingkat 4 telah terpenuhi serta hasil reviu dan evaluasi kebijakan internal Manajemen Data di Instansi Pusat/Pemerintah Daerah telah ditindaklanjuti dengan kebijakan baru.',
                'related_documentation' => null,
                'person_in_charge' => $faker->name,
                'date_added' => Carbon::now(),
                'last_updated_date' => Carbon::now(),
                'status' => 'active',
            ],
            // Indikator 4
            [
                'name' => 'Tingkat Kematangan Kebijakan Internal Pembangunan Aplikasi SPBE',
                'explanation' => '<ol class="a">
                                    <li>Aplikasi SPBE adalah satu atau sekumpulan program komputer dan prosedur yang dirancang untuk melakukan tugas atau fungsi Layanan SPBE.</li>
                                    <li>Pembangunan Aplikasi SPBE merupakan suatu proses perancangan aplikasi melalui siklus pembangunan aplikasi.</li>
                                    <li>Kebijakan internal Aplikasi SPBE merupakan pengaturan mengenai Pembangunan Aplikasi SPBE di Instansi Pusat dan Pemerintah Daerah yang bertujuan untuk memberikan panduan dalam pelaksanaan pembangunan aplikasi SPBE untuk menghasilkan Layanan SPBE yang terpadu.</li>
                                    <li>Siklus Pembangunan Aplikasi terdiri dari:
                                        <ol type="1">
                                            <li>Analisis kebutuhan;</li>
                                            <li>Perencanaan;</li>
                                            <li>Rancang bangun;</li>
                                            <li>Implementasi;</li>
                                            <li>Pengujian kelaikan;</li>
                                            <li>Pemeliharaan; dan,</li>
                                            <li>Evaluasi.</li>
                                        </ol>
                                    </li>
                                    <li>Siklus bisa menggunakan salah satu framework yang sudah ada seperti SDLC, RAD, Waterfall, Agile Development Cycle (SCRUM).</li>
                                </ol>
                                ',
                'rule_information' => 'PEDOMAN MENTERI PENDAYAGUNAAN APARATUR NEGARA DAN REFORMASI BIROKRASI REPUBLIK INDONESIA',
                'criteria' => 'Penilaian dilakukan terhadap pengaturan/norma yang telah mengatur siklus pembangunan aplikasi melalui kebijakan yang telah ditetapkan.',
                'current_level' => 'Level 1 - Konsep kebijakan internal terkait siklus Pembangunan Aplikasi SPBE di Instansi Pusat/Pemerintah Daerah belum atau telah tersedia.',
                'target_level' => 'Level 5 - Kriteria tingkat 4 telah terpenuhi serta hasil reviu dan evaluasi kebijakan internal Pembangunan Aplikasi SPBE di Instansi Pusat/Pemerintah Daerah telah ditindaklanjuti dengan kebijakan baru.',
                'related_documentation' => null,
                'person_in_charge' => $faker->name,
                'date_added' => Carbon::now(),
                'last_updated_date' => Carbon::now(),
                'status' => 'active',
            ],
            // Indikator 5
            [
                'name' => 'Tingkat Kematangan Kebijakan Internal Layanan Pusat Data',
                'explanation' => '<ol class="a">
                                    <li>Layanan Pusat Data adalah penyediaan penyimpanan aplikasi dan data.</li>
                                    <li>Layanan Pusat Data bertujuan untuk menjamin ketersediaan penyimpanan data bagi Instansi Pusat dan Pemerintah Daerah.</li>
                                    <li>Pusat Data Nasional adalah sekumpulan pusat data yang digunakan secara bersama dan bagi pakai oleh Instansi Pusat dan Pemerintah Daerah, dan saling terhubung yang terdiri atas pusat data yang diselenggarakan oleh Instansi Pusat/Pemerintah Daerah dengan memenuhi persyaratan pusat data atau pusat data yang dibangun khusus untuk digunakan secara bersama dan bagi pakai oleh Instansi Pusat dan Pemerintah Daerah.</li>
                                    <li>Kebijakan Layanan Pusat Data merupakan pengaturan mengenai layanan pusat data di Instansi Pusat dan Pemerintah Daerah yang bertujuan untuk memberikan panduan dalam pelaksanaan layanan pusat data untuk menghasilkan Layanan SPBE yang terpadu.</li>
                                    <li>Instansi Pusat dan Pemerintah Daerah menyusun kebijakan internal layanan pusat data mengacu pada pedoman layanan pusat data.</li>
                                </ol>
                                ',
                'rule_information' => 'PEDOMAN MENTERI PENDAYAGUNAAN APARATUR NEGARA DAN REFORMASI BIROKRASI REPUBLIK INDONESIA',
                'criteria' => 'Penilaian dilakukan terhadap pengaturan/norma yang memenuhi kriteria muatan Layanan Pusat Data Instansi Pusat/Pemerintah Daerah melalui kebijakan yang telah ditetapkan.',
                'current_level' => 'Level 1 - Konsep kebijakan internal terkait Layanan Pusat Data yang digunakan di Instansi Pusat/Pemerintah Daerah belum atau telah tersedia.',
                'target_level' => 'Level 5 - Kriteria tingkat 4 telah terpenuhi serta hasil reviu dan evaluasi kebijakan internal terkait Layanan Pusat Data yang digunakan di Instansi Pusat/Pemerintah Daerah telah ditindaklanjuti dengan kebijakan baru.',
                'related_documentation' => null,
                'person_in_charge' => $faker->name,
                'date_added' => Carbon::now(),
                'last_updated_date' => Carbon::now(),
                'status' => 'active',
            ],
            // Indikator 6
            [
                'name' => 'Tingkat Kematangan Kebijakan Internal Layanan Jaringan Intra Instansi Pusat/Pemerintah Daerah',
                'explanation' => '<ol class="a">
                                    <li>Jaringan Intra adalah jaringan tertutup yang menghubungkan antar simpul jaringan dalam suatu organisasi.</li>
                                    <li>Jaringan Intra Instansi Pusat dan Pemerintah Daerah merupakan Jaringan Intra yang diselenggarakan oleh Instansi Pusat dan Pemerintah Daerah untuk menghubungkan antar simpul jaringan dalam Instansi Pusat/Pemerintah Daerah, dengan Jaringan Intra Pemerintah dan/atau Jaringan Intra Instansi Pusat/Pemerintah Daerah lain, yang selanjutnya terhubung dengan jaringan intra pemerintah.</li>
                                    <li>Penggunaan Jaringan Intra Instansi Pusat dan Pemerintah Daerah bertujuan untuk menjaga keamanan dalam melakukan pengiriman data dan informasi antar simpul jaringan dalam Instansi Pusat/Pemerintah Daerah, yang selanjutnya terhubung dengan jaringan intra pemerintah.</li>
                                    <li>Penyelenggaraan Jaringan Intra Instansi Pusat/Pemerintah Daerah sebagaimana dimaksud, dapat menggunakan jaringan fisik yang dibangun sendiri oleh Instansi Pusat/Pemerintah Daerah dan/atau yang dibangun oleh penyedia jasa layanan jaringan, yang selanjutnya terhubung dengan jaringan intra pemerintah.</li>
                                    <li>Kebijakan internal dalam hal ini mengatur pengoperasian jaringan intra Instansi Pusat/Pemerintah Daerah yang selanjutnya terhubung dengan jaringan intra pemerintah.</li>
                                    </ol>',
                'rule_information' => 'PEDOMAN MENTERI PENDAYAGUNAAN APARATUR NEGARA DAN REFORMASI BIROKRASI REPUBLIK INDONESIA',
                'criteria' => 'Penilaian dilakukan terhadap pengaturan/norma yang memenuhi kriteria muatan Jaringan Intra Instansi Pusat/Pemerintah Daerah melalui kebijakan yang telah ditetapkan.',
                'current_level' => 'Level 1 - Konsep kebijakan internal terkait Layanan Jaringan Intra Instansi Pusat/Pemerintah Daerah belum atau telah tersedia.',
                'target_level' => 'Level 5 - Kriteria tingkat 4 telah terpenuhi serta hasil reviu dan evaluasi kebijakan internal terkait Layanan Jaringan Intra Instansi Pusat/Pemerintah Daerah telah ditindaklanjuti dengan kebijakan baru.',
                'related_documentation' => null,
                'person_in_charge' => $faker->name,
                'date_added' => Carbon::now(),
                'last_updated_date' => Carbon::now(),
                'status' => 'active',
            ],
            // Indikator 7
            [
                'name' => 'Tingkat Kematangan Kebijakan Internal Penggunaan Sistem Penghubung Layanan Instansi Pusat/Pemerintah Daerah',
                'explanation' => '<ol type="a">
                            <li>Sistem Penghubung Layanan adalah perangkat integrasi/penghubung untuk melakukan pertukaran Layanan SPBE.</li>
                            <li>Kebijakan internal mengatur penerapan Sistem Penghubung Layanan Instansi Pusat/Pemerintah Daerah agar terintegrasi dengan Sistem Penghubung Layanan Pemerintah.</li>
                        </ol>',
                'rule_information' => 'PEDOMAN MENTERI PENDAYAGUNAAN APARATUR NEGARA DAN REFORMASI BIROKRASI REPUBLIK INDONESIA',
                'criteria' => 'Penilaian dilakukan terhadap pengaturan/norma yang memenuhi kriteria muatan Sistem Penghubung Layanan Instansi Pusat/Pemerintah Daerah melalui kebijakan yang telah ditetapkan.',
                'current_level' => 'Level 1 - Konsep kebijakan internal terkait Penggunaan Sistem Penghubung Layanan Instansi Pusat/Pemerintah Daerah belum atau telah tersedia.',
                'target_level' => 'Level 5 - Kriteria tingkat 4 telah terpenuhi serta hasil reviu dan evaluasi kebijakan internal terkait Penggunaan Sistem Penghubung Layanan Instansi Pusat/Pemerintah Daerah telah ditindaklanjuti dengan kebijakan baru.',
                'related_documentation' => null,
                'person_in_charge' => $faker->name,
                'date_added' => Carbon::now(),
                'last_updated_date' => Carbon::now(),
                'status' => 'active',
            ], // Indikator 8
            [
                'name' => 'Tingkat Kematangan Kebijakan Internal Manajemen Keamanan Informasi.',
                'explanation' => '<ol class="a">
    <li>Manajemen Keamanan Informasi dilakukan melalui serangkaian proses yang meliputi penetapan ruang lingkup, penetapan penanggung jawab, perencanaan, dukungan pengoperasian, evaluasi kinerja, dan perbaikan berkelanjutan terhadap keamanan informasi dalam SPBE.</li>
    <li>Manajemen Keamanan Informasi bertujuan untuk menjamin keberlangsungan SPBE dengan meminimalkan dampak risiko keamanan informasi.</li>
    <li>Kebijakan internal dalam hal ini mengatur terkait penerapan Manajemen Keamanan Informasi pada Instansi Pusat/Pemerintah Daerah.</li>
</ol>
',
                'rule_information' => 'PEDOMAN MENTERI PENDAYAGUNAAN APARATUR NEGARA DAN REFORMASI BIROKRASI REPUBLIK INDONESIA',
                'criteria' => 'Penilaian dilakukan terhadap pengaturan/norma yang telah mencakup keseluruhan proses Manajemen Keamanan Informasi melalui kebijakan yang telah ditetapkan.',
                'current_level' => 'Level 1 - Konsep kebijakan internal terkait Manajemen Keamanan Informasi telah tersedia.',
                'target_level' => 'Level 5 - Kriteria tingkat 4 telah terpenuhi serta hasil reviu dan evaluasi kebijakan internal terkait Manajemen Keamanan Informasi telah ditindaklanjuti dengan kebijakan baru.',
                'related_documentation' => null,
                'person_in_charge' => $faker->name,
                'date_added' => Carbon::now(),
                'last_updated_date' => Carbon::now(),
                'status' => 'active',
            ], // Indikator 9
            [
                'name' => 'Tingkat Kematangan Kebijakan Internal Audit TIK.',
                'explanation' => '<ol class="a">
    <li>Audit Teknologi Informasi dan Komunikasi (TIK) adalah proses yang sistematis untuk memperoleh dan mengevaluasi bukti secara objektif terhadap aset teknologi informasi dan komunikasi dengan tujuan untuk menetapkan tingkat kesesuaian antara teknologi informasi dan komunikasi dengan kriteria dan/atau standar yang telah ditetapkan.</li>
    <li>Audit TIK terdiri atas:
        <ol type="1">
            <li>Audit Infrastruktur SPBE;</li>
            <li>Audit Aplikasi SPBE;</li>
            <li>Audit Keamanan SPBE.</li>
        </ol>
    </li>
    <li>Audit Teknologi Informasi dan Komunikasi meliputi pemeriksaan hal pokok teknis pada:
        <ol type="1">
            <li>Penerapan tata kelola dan manajemen teknologi informasi dan komunikasi;</li>
            <li>Fungsionalitas teknologi informasi dan komunikasi;</li>
            <li>Kinerja teknologi informasi dan komunikasi yang dihasilkan;</li>
            <li>Aspek teknologi informasi dan komunikasi lainnya.</li>
        </ol>
    </li>
    <li>Kebijakan internal dalam hal ini mengatur terkait penerapan Audit TIK pada Instansi Pusat/Pemerintah Daerah.</li>
</ol>
',
                'rule_information' => 'PEDOMAN MENTERI PENDAYAGUNAAN APARATUR NEGARA DAN REFORMASI BIROKRASI REPUBLIK INDONESIA',
                'criteria' => 'Penilaian dilakukan terhadap pengaturan/norma yang
memenuhi kriteria muatan/ruang lingkup Audit TIK
melalui kebijakan yang telah ditetapkan.',
                'current_level' => 'Level 1 - Konsep kebijakan internal terkait Audit TIK belum atau telah tersedia.',
                'target_level' => 'Level 5 - Kriteria tingkat 4 telah terpenuhi, serta hasil reviu dan evaluasi kebijakan internal terkait Audit TIK telah ditindaklanjuti dengan kebijakan baru.',
                'related_documentation' => null,
                'person_in_charge' => $faker->name,
                'date_added' => Carbon::now(),
                'last_updated_date' => Carbon::now(),
                'status' => 'active',
            ], // Indikator 10
            [
                'name' => 'Tingkat Kematangan Kebijakan Internal Tim Koordinasi SPBE Instansi Pusat/Pemerintah Daerah.',
                'explanation' => '<ol class="a">
    <li>Tim Koordinasi SPBE Instansi Pusat/Pemerintah Daerah adalah para pejabat dalam tim yang diberi tugas untuk mengendalikan, mengarahkan, dan mengevaluasi SPBE, termasuk di dalamnya melaksanakan perumusan kebijakan dan penerapan SPBE di Instansi Pusat dan Pemerintah Daerah masing-masing.</li>
    <li>Tim Koordinasi SPBE Instansi Pusat/Pemerintah Daerah dipimpin oleh seorang koordinator yang ditetapkan oleh pimpinan Instansi Pusat/Kepala Daerah.</li>
    <li>Kebijakan internal dalam hal ini mengatur terkait penunjukkan dan pendelegasian tugas dan fungsi Tim Koordinasi SPBE Instansi Pusat/Pemerintah Daerah.</li>
</ol>
',
                'rule_information' => 'PEDOMAN MENTERI PENDAYAGUNAAN APARATUR NEGARA DAN REFORMASI BIROKRASI REPUBLIK INDONESIA',
                'criteria' => 'Penilaian dilakukan terhadap pengaturan yang
memenuhi kriteria untuk mendukung tugas dan fungsi
Tim Koordinasi SPBE Instansi Pusat/Pemerintah
Daerah, melalui kebijakan yang telah ditetapkan.',
                'current_level' => 'Level 1 - Konsep kebijakan internal terkait Tim Koordinasi SPBE Instansi Pusat/Pemerintah Daerah belum atau telah tersedia.',
                'target_level' => 'Level 5 - Kriteria tingkat 4 telah terpenuhi serta hasil reviu dan evaluasi kebijakan internal terkait Tim Koordinasi SPBE Instansi Pusat/Pemerintah Daerah telah ditindaklanjuti dengan kebijakan baru.',
                'related_documentation' => null,
                'person_in_charge' => $faker->name,
                'date_added' => Carbon::now(),
                'last_updated_date' => Carbon::now(),
                'status' => 'active',
            ], // Indikator 11
            [
                'name' => 'Tingkat Kematangan Arsitektur SPBE Instansi Pusat/Pemerintah Daerah.',
                'explanation' => '<ol class="a">
    <li>Arsitektur SPBE adalah kerangka dasar yang mendeskripsikan integrasi proses bisnis, data dan informasi, infrastruktur SPBE, aplikasi SPBE, dan keamanan SPBE untuk menghasilkan layanan SPBE yang terintegrasi.</li>
    <li>Arsitektur SPBE Nasional adalah Arsitektur SPBE yang diterapkan secara nasional.</li>
    <li>Arsitektur SPBE Instansi Pusat adalah Arsitektur SPBE yang diterapkan di Instansi Pusat.</li>
    <li>Arsitektur SPBE Pemerintah Daerah adalah Arsitektur SPBE yang diterapkan di Pemerintah Daerah.</li>
    <li>Referensi Arsitektur SPBE adalah kerangka dasar yang mendeskripsikan komponen dasar arsitektur baku yang digunakan sebagai acuan untuk penyusunan setiap Domain Arsitektur SPBE.</li>
    <li>Domain Arsitektur SPBE adalah kerangka dasar yang mendeskripsikan substansi arsitektur yang memuat domain arsitektur proses bisnis, domain arsitektur data dan informasi, domain arsitektur infrastruktur SPBE, domain arsitektur aplikasi SPBE, domain arsitektur keamanan SPBE, dan domain arsitektur layanan SPBE.</li>
</ol>
',
                'rule_information' => 'PEDOMAN MENTERI PENDAYAGUNAAN APARATUR NEGARA DAN REFORMASI BIROKRASI REPUBLIK INDONESIA',
                'criteria' => 'Penilaian dilakukan terhadap bukti dukung dokumen
Arsitektur SPBE yang memenuhi kriteria ruang
lingkup Referensi Arsitektur dan Domain Arsitektur
SPBE dan terdokumentasi secara formal.',
                'current_level' => 'Level 1 - Konsep dokumen Arsitektur SPBE belum atau telah tersedia.',
                'target_level' => 'Level 5 - Kriteria tingkat 4 telah terpenuhi dan dokumen Arsitektur SPBE Instansi Pusat/Pemerintah Daerah telah dilakukan pemutakhiran sebagai tindak lanjut hasil reviu dan evaluasi.',
                'related_documentation' => null,
                'person_in_charge' => $faker->name,
                'date_added' => Carbon::now(),
                'last_updated_date' => Carbon::now(),
                'status' => 'active',
            ], // Indikator 12
            [
                'name' => 'Tingkat Kematangan Peta Rencana SPBE Instansi Pusat/Pemerintah Daerah.',
                'explanation' => '<ol class="a">
    <li>Peta Rencana SPBE adalah dokumen yang mendeskripsikan arah dan langkah penyiapan dan pelaksanaan SPBE yang terintegrasi.</li>
    <li>Peta Rencana SPBE memuat:
        <ol type="1">
            <li>Tata Kelola SPBE;</li>
            <li>Manajemen SPBE;</li>
            <li>Layanan SPBE;</li>
            <li>Infrastruktur SPBE;</li>
            <li>Aplikasi SPBE;</li>
            <li>Keamanan SPBE;</li>
            <li>Audit TIK;</li>
        </ol>
    </li>
</ol>
',
                'rule_information' => 'PEDOMAN MENTERI PENDAYAGUNAAN APARATUR NEGARA DAN REFORMASI BIROKRASI REPUBLIK INDONESIA',
                'criteria' => 'Penilaian dilakukan terhadap bukti dukung dokumen
Peta Rencana SPBE yang memenuhi kriteria ruang
lingkup Peta Rencana SPBE dan terdokumentasi
secara formal.',
                'current_level' => 'Level 1 - Konsep dokumen Peta Rencana SPBE Instansi Pusat/Pemerintah Daerah belum atau telah tersedia.',
                'target_level' => 'Level 5 - Kriteria tingkat 4 telah terpenuhi dan dokumen Peta Rencana SPBE Instansi Pusat/Pemerintah Daerah telah dilakukan pemutakhiran sebagai tindak lanjut hasil reviu dan evaluasi.',
                'related_documentation' => null,
                'person_in_charge' => $faker->name,
                'date_added' => Carbon::now(),
                'last_updated_date' => Carbon::now(),
                'status' => 'active',
            ], // Indikator 13
            [
                'name' => 'Tingkat Kematangan Keterpaduan Rencana dan Anggaran SPBE.',
                'explanation' => '<ol class="a">
    <li>Rencana dan Anggaran SPBE adalah dokumen yang mendeskripsikan program, kegiatan dan pemanfaatan anggaran SPBE.</li>
    <li>Rencana dan Anggaran SPBE disusun sesuai dengan proses perencanaan dan penganggaran tahunan pemerintah.</li>
    <li>Rencana dan Anggaran SPBE Instansi Pusat/Pemerintah Daerah berpedoman pada Arsitektur SPBE Instansi Pusat/Pemerintah Daerah dan Peta Rencana SPBE Instansi Pusat/Pemerintah Daerah.</li>
</ol>
',
                'rule_information' => 'PEDOMAN MENTERI PENDAYAGUNAAN APARATUR NEGARA DAN REFORMASI BIROKRASI REPUBLIK INDONESIA',
                'criteria' => 'Penilaian dilakukan terhadap bukti dukung
Keterpaduan Rencana dan Anggaran SPBE yang
memenuhi kriteria ruang lingkup Rencana dan
Anggaran SPBE dan terdokumentasi secara formal.',
                'current_level' => 'Level 1 - Rencana dan Anggaran SPBE belum atau telah tertuang dalam rencana kerja dan anggaran tahunan.',
                'target_level' => 'Level 5 - Kriteria tingkat 4 telah terpenuhi serta Rencana dan Anggaran SPBE telah dilakukan revisi untuk tahun anggaran berikutnya sebagai tindak lanjut hasil reviu dan evaluasi.',
                'related_documentation' => null,
                'person_in_charge' => $faker->name,
                'date_added' => Carbon::now(),
                'last_updated_date' => Carbon::now(),
                'status' => 'active',
            ], // Indikator 14
            [
                'name' => 'Tingkat Kematangan Inovasi Proses Bisnis SPBE.',
                'explanation' => '<ol class="a">
    <li>Proses Bisnis adalah dokumen yang mendeskripsikan hubungan kerja yang efektif dan efisien antar unit organisasi untuk menghasilkan kinerja sesuai dengan tujuan pendirian organisasi agar menghasilkan keluaran yang bernilai tambah bagi pemangku kepentingan (PermenPANRB No 19 Tahun 2018).</li>
    <li>Penyusunan Proses Bisnis bertujuan untuk memberikan pedoman dalam penggunaan data dan informasi serta penerapan Aplikasi SPBE, Keamanan SPBE, dan Layanan SPBE.</li>
    <li>Instansi Pusat/Pemerintah Daerah menyusun Proses Bisnis yang selaras dengan Arsitektur SPBE Instansi Pusat/Pemerintah Daerah.</li>
</ol>
',
                'rule_information' => 'PEDOMAN MENTERI PENDAYAGUNAAN APARATUR NEGARA DAN REFORMASI BIROKRASI REPUBLIK INDONESIA',
                'criteria' => 'Penilaian dilakukan terhadap bukti dukung penerapan
Inovasi Proses Bisnis SPBE yang memenuhi kriteria
ruang lingkup Proses Bisnis SPBE dan terdokumentasi
secara formal.',
                'current_level' => 'Level 1 - Dokumen Proses Bisnis Instansi Pusat/Pemerintah Daerah belum atau telah tersedia. Kondisi: Dokumen Proses Bisnis Instansi Pusat/Pemerintah Daerah belum memenuhi standar.',
                'target_level' => 'Level 5 - Kriteria tingkat 4 telah terpenuhi dan telah melakukan perbaikan Inovasi Proses Bisnis yang diterapkan ke dalam Sistem elektronik sebagai tindak lanjut hasil reviu dan evaluasi.',
                'related_documentation' => null,
                'person_in_charge' => $faker->name,
                'date_added' => Carbon::now(),
                'last_updated_date' => Carbon::now(),
                'status' => 'active',
            ], // Indikator 15
            [
                'name' => 'Tingkat Kematangan Pembangunan Aplikasi SPBE.',
                'explanation' => '<ol class="a">
    <li>Aplikasi SPBE adalah satu atau sekumpulan program komputer dan prosedur yang dirancang untuk melakukan tugas atau fungsi Layanan SPBE.</li>
    <li>Pembangunan Aplikasi SPBE merupakan suatu proses perancangan aplikasi melalui siklus pembangunan aplikasi.</li>
    <li>Siklus Pembangunan Aplikasi terdiri dari:
        <ol type="1">
            <li>Analisis kebutuhan;</li>
            <li>Perencanaan;</li>
            <li>Rancang bangun;</li>
            <li>Implementasi;</li>
            <li>Pengujian kelaikan;</li>
            <li>Pemeliharaan;</li>
            <li>Evaluasi.</li>
        </ol>
    </li>
    <li>Siklus bisa menggunakan salah satu framework yang sudah ada seperti SDLC, RAD, Waterfall, Agile Development Cycle (SCRUM).</li>
</ol>',
                'rule_information' => 'PEDOMAN MENTERI PENDAYAGUNAAN APARATUR NEGARA DAN REFORMASI BIROKRASI REPUBLIK INDONESIA',
                'criteria' => 'Penilaian dilakukan terhadap bukti dukung
keterpaduan Pembangunan Aplikasi SPBE yang
memenuhi kriteria ruang lingkup proses
Pembangunan Aplikasi SPBE dan terdokumentasi
secara formal.',
                'current_level' => 'Level 1 - Proses pembangunan Aplikasi SPBE belum atau telah dilakukan secara adhoc (sewaktu-waktu, tidak terencana). Kondisi: Proses pembangunan Aplikasi SPBE belum memenuhi siklus pembangunan aplikasi.',
                'target_level' => 'Level 5 - Kriteria tingkat 4 telah terpenuhi dan Aplikasi SPBE telah dikembangkan secara optimal untuk meningkatkan efektivitas dan efisiensi terhadap perubahan lingkungan, teknologi, dan kebutuhan Instansi Pusat/Pemerintah Daerah sebagai tindak lanjut hasil reviu dan evaluasi.',
                'related_documentation' => null,
                'person_in_charge' => $faker->name,
                'date_added' => Carbon::now(),
                'last_updated_date' => Carbon::now(),
                'status' => 'active',
            ], // Indikator 16
            [
                'name' => 'Tingkat Kematangan Layanan Pusat Data.',
                'explanation' => '<ol class="a">
    <li>Pusat Data adalah fasilitas yang digunakan untuk penempatan sistem elektronik dan komponen terkait lainnya untuk keperluan penempatan, penyimpanan dan pengolahan data, dan pemulihan data baik yang dimiliki secara fisik dan non-fisik (cloud).</li>
    <li>Layanan Pusat Data adalah penyediaan penyimpanan aplikasi dan data.</li>
    <li>Layanan Pusat Data bertujuan untuk menjamin ketersediaan penyimpanan data bagi Instansi Pusat dan Pemerintah Daerah.</li>
    <li>Pusat Data Nasional adalah sekumpulan pusat data yang digunakan secara bersama dan bagi pakai oleh Instansi Pusat dan Pemerintah Daerah, dan saling terhubung yang terdiri atas pusat data yang...</li>
</ol>
',
                'rule_information' => 'PEDOMAN MENTERI PENDAYAGUNAAN APARATUR NEGARA DAN REFORMASI BIROKRASI REPUBLIK INDONESIA',
                'criteria' => 'Penilaian dilakukan terhadap bukti dukung penerapan
Layanan Pusat Data yang memenuhi kriteria ruang
lingkup pemanfaatan dan pengoperasian, serta
terdokumentasi secara formal',
                'current_level' => 'Level 1 - Layanan Pusat Data belum atau telah tersedia digunakan oleh Instansi Pusat/Pemerintah Daerah.',
                'target_level' => 'Level 5 - Kriteria tingkat 4 telah terpenuhi serta hasil reviu dan evaluasi penggunaan Layanan Pusat Data di Instansi Pusat/Pemerintah Daerah telah ditindaklanjuti dengan melakukan perbaikan terhadap Layanan Pusat Data.',
                'related_documentation' => null,
                'person_in_charge' => $faker->name,
                'date_added' => Carbon::now(),
                'last_updated_date' => Carbon::now(),
                'status' => 'active',
            ], // Indikator 17
            [
                'name' => 'Tingkat Kematangan Layanan Jaringan Intra Instansi Pusat/Pemerintah Daerah.',
                'explanation' => '<ol class="a">
    <li>Jaringan Intra adalah jaringan tertutup yang menghubungkan antar simpul jaringan dalam suatu organisasi.</li>
    <li>Jaringan Intra Instansi Pusat/Pemerintah Daerah merupakan Jaringan Intra yang diselenggarakan oleh Instansi Pusat/Pemerintah Daerah untuk menghubungkan antar simpul jaringan dalam Instansi Pusat/Pemerintah Daerah, dengan Jaringan Intra Pemerintah dan/atau Jaringan Intra Instansi Pusat/Pemerintah Daerah lain.</li>
    <li>Penggunaan Jaringan Intra Instansi Pusat/Pemerintah Daerah bertujuan untuk menjaga keamanan dalam melakukan pengiriman data dan informasi antar simpul jaringan dalam Instansi Pusat/Pemerintah Daerah.</li>
    <li>Penyelenggaraan Jaringan Intra Instansi Pusat/Pemerintah Daerah sebagaimana dimaksud, dapat menggunakan jaringan fisik yang dibangun sendiri oleh Instansi Pusat/Pemerintah Daerah dan/atau yang dibangun oleh penyedia jasa layanan jaringan.</li>
</ol>
',
                'rule_information' => 'PEDOMAN MENTERI PENDAYAGUNAAN APARATUR NEGARA DAN REFORMASI BIROKRASI REPUBLIK INDONESIA',
                'criteria' => 'Penilaian dilakukan terhadap bukti dukung
implementasi Jaringan Intra Instansi
Pusat/Pemerintah Daerah yang memenuhi kriteria ruang lingkup pemanfaatan, keterhubungan dan
akses, serta terdokumentasi secara formal.',
                'current_level' => 'Level 1 - Layanan Jaringan Intra Instansi Pusat/Pemerintah Daerah belum atau telah tersedia.',
                'target_level' => 'Level 5 - Kriteria tingkat 4 telah terpenuhi serta hasil reviu dan evaluasi Layanan Jaringan Intra Instansi Pusat/Pemerintah Daerah telah ditindaklanjuti dengan melakukan perbaikan terhadap Layanan Jaringan Intra Instansi Pusat/Pemerintah Daerah serta terhubung dengan Jaringan Intra Pemerintah di tingkat nasional.',
                'related_documentation' => null,
                'person_in_charge' => $faker->name,
                'date_added' => Carbon::now(),
                'last_updated_date' => Carbon::now(),
                'status' => 'active',
            ], // Indikator 18
            [
                'name' => 'Tingkat Kematangan Penggunaan Sistem Penghubung Layanan Instansi Pusat/Pemerintah Daerah.',
                'explanation' => '<ol class="a">
    <li>Sistem Penghubung Layanan adalah perangkat integrasi/penghubung untuk melakukan pertukaran Layanan SPBE.</li>
    <li>Penggunaan Sistem Penghubung Layanan Pemerintah bertujuan untuk memudahkan dalam melakukan integrasi antar Layanan SPBE.</li>
</ol>
',
                'rule_information' => 'PEDOMAN MENTERI PENDAYAGUNAAN APARATUR NEGARA DAN REFORMASI BIROKRASI REPUBLIK INDONESIA',
                'criteria' => 'Penilaian dilakukan terhadap bukti dukung penerapan
sistem penghubung layanan Instansi
Pusat/Pemerintah Daerah yang memenuhi kriteria
ruang lingkup pemanfaatan dan pengoperasian, serta
terdokumentasi secara formal.
',
                'current_level' => 'Level 1 - Sistem Penghubung Layanan Instansi Pusat/ Pemerintah Daerah belum atau telah tersedia.',
                'target_level' => 'Level 5 - Kriteria tingkat 4 telah terpenuhi serta hasil reviu dan evaluasi Sistem Penghubung Layanan Instansi Pusat/Pemerintah Daerah telah ditindaklanjuti dengan melakukan perbaikan serta terintegrasi dengan SPLP di tingkat nasional.',
                'related_documentation' => null,
                'person_in_charge' => $faker->name,
                'date_added' => Carbon::now(),
                'last_updated_date' => Carbon::now(),
                'status' => 'active',
            ], // Indikator 19
            [
                'name' => 'Tingkat Kematangan Tim Koordinasi SPBE Instansi Pusat/Pemerintah Daerah.',
                'explanation' => '<ol class="a">
    <li>Tim Koordinasi SPBE Instansi Pusat/Pemerintah Daerah adalah para pejabat dalam tim yang diberi tugas untuk mengendalikan, mengarahkan, dan mengevaluasi SPBE, termasuk di dalamnya melaksanakan perumusan kebijakan dan penerapan SPBE di Instansi Pusat dan Pemerintah Daerah masing-masing.</li>
    <li>Tim Koordinasi SPBE Instansi Pusat/Pemerintah Daerah dapat disejajarkan dengan Tim Pengarah TIK, Komite Pengarah TIK, ataupun Steering Committee yang mempunyai tugas seperti dimaksud pada huruf a.</li>
    <li>Tim Koordinasi SPBE Instansi Pusat/Pemerintah Daerah dikoordinasikan oleh Sekretaris Instansi Pusat/Pemerintah Daerah.</li>
</ol>
',
                'rule_information' => 'PEDOMAN MENTERI PENDAYAGUNAAN APARATUR NEGARA DAN REFORMASI BIROKRASI REPUBLIK INDONESIA',
                'criteria' => 'Penilaian dilakukan terhadap bukti dukung
pelaksanaan tugas/program kerja dari Tim Koordinasi
SPBE Instansi Pusat/Pemerintah Daerah yang
ditetapkan dalam tugas dan fungsi atau rencana
kerja/Peta Rencana SPBE, serta terdokumentasi
secara formal.',
                'current_level' => 'Level 1 - Tim Koordinasi SPBE Instansi Pusat/Pemerintah Daerah belum atau telah terbentuk. Kondisi: Tugas/program kerja Tim Koordinasi SPBE Instansi Pusat/Pemerintah Daerah dilaksanakan tanpa perencanaan.',
                'target_level' => 'Level 5 - Kriteria tingkat 4 telah terpenuhi dan hasil reviu dan evaluasi tugas/program kerja Tim Koordinasi SPBE Instansi Pusat/Pemerintah Daerah telah ditindaklanjuti melalui perbaikan tugas/program kerja Tim Koordinasi SPBE Instansi Pusat/Pemerintah Daerah dan pelaksanaannya.',
                'related_documentation' => null,
                'person_in_charge' => $faker->name,
                'date_added' => Carbon::now(),
                'last_updated_date' => Carbon::now(),
                'status' => 'active',
            ], // Indikator 20
            [
                'name' => 'Tingkat Kematangan Kolaborasi Penerapan SPBE.',
                'explanation' => '<ol class="a">
    <li>Forum Kolaborasi SPBE merupakan wadah informal untuk pertukaran informasi dan peningkatan kapasitas pelaksanaan SPBE bagi Instansi Pusat, Pemerintah Daerah, perguruan tinggi, lembaga penelitian, pelaku usaha, dan masyarakat.</li>
    <li>Forum Kolaborasi SPBE dapat dimanfaatkan untuk antara lain:
        <ol type="1">
            <li>penyampaian ide/gagasan SPBE;</li>
            <li>pengembangan infrastruktur dan Aplikasi SPBE dari kontribusi komunitas TIK;</li>
            <li>peningkatan kompetensi teknis;</li>
            <li>perbaikan kualitas Layanan SPBE;</li>
            <li>penelitian dan kajian pengembangan SPBE;</li>
            <li>penyelesaian masalah untuk kepentingan bersama.</li>
        </ol>
    </li>
    <li>Forum Kolaborasi SPBE dapat dilakukan dalam bentuk pertemuan informal dan pertemuan virtual.</li>
</ol>
',
                'rule_information' => 'PEDOMAN MENTERI PENDAYAGUNAAN APARATUR NEGARA DAN REFORMASI BIROKRASI REPUBLIK INDONESIA',
                'criteria' => 'Penilaian dilakukan terhadap bukti dukung
pelaksanaan Forum Kolaborasi SPBE Instansi
Pusat/Pemerintah Daerah yang memenuhi kriteria
ruang lingkup Kolaborasi Penerapan SPBE, serta
terdokumentasi secara formal.
',
                'current_level' => 'Level 1 - Kolaborasi antar unit kerja/perangkat daerah di Instansi Pusat/Pemerintah Daerah dalam penerapan SPBE belum atau telah dilaksanakan. Kondisi: Kolaborasi antar unit kerja/perangkat daerah di Instansi Pusat/ Pemerintah Daerah dalam penerapan SPBE dilaksanakan tanpa perencanaan.',
                'target_level' => 'Level 5 - Kriteria tingkat 4 telah terpenuhi dan hasil reviu dan evaluasi kolaborasi dalam penerapan SPBE telah ditindaklanjuti melalui perbaikan pelaksanaan kolaborasi dalam penerapan SPBE.',
                'related_documentation' => null,
                'person_in_charge' => $faker->name,
                'date_added' => Carbon::now(),
                'last_updated_date' => Carbon::now(),
                'status' => 'active',
            ], // Indikator 21
            [
                'name' => 'Tingkat Kematangan Penerapan Manajemen Risiko SPBE.',
                'explanation' => '<ol class="a">
    <li>Manajemen Risiko SPBE adalah pendekatan sistematis yang meliputi proses, pengukuran, struktur, dan budaya untuk menentukan tindakan terbaik terkait Risiko SPBE;</li>
    <li>Risiko SPBE adalah peluang terjadinya suatu peristiwa yang akan mempengaruhi keberhasilan terhadap pencapaian tujuan penerapan SPBE;</li>
    <li>Manajemen Risiko bertujuan untuk menjamin keberlangsungan SPBE dengan meminimalkan dampak risiko dalam SPBE;</li>
    <li>Instansi Pusat dan Pemerintah Daerah menerapkan manajemen risiko SPBE berdasarkan pedoman Manajemen Risiko SPBE.</li>
</ol>
',
                'rule_information' => 'PEDOMAN MENTERI PENDAYAGUNAAN APARATUR NEGARA DAN REFORMASI BIROKRASI REPUBLIK INDONESIA',
                'criteria' => 'Penilaian dilakukan terhadap bukti dukung penerapan
manajemen risiko Instansi Pusat/Pemerintah Daerah
yang memenuhi kriteria ruang lingkup, serta
terdokumentasi secara formal. ',
                'current_level' => 'Level 1 - Kegiatan Manajemen Risiko SPBE belum atau telah diterapkan. Kondisi: Kegiatan Manajemen Risiko SPBE diterapkan tanpa program kegiatan yang terarah dan terencana.',
                'target_level' => 'Level 5 - Kriteria tingkat 4 telah terpenuhi serta hasil reviu dan evaluasi Manajemen Risiko SPBE ditindaklanjuti melalui perbaikan penerapan Manajemen Risiko SPBE.',
                'related_documentation' => null,
                'person_in_charge' => $faker->name,
                'date_added' => Carbon::now(),
                'last_updated_date' => Carbon::now(),
                'status' => 'active',
            ], // Indikator 22
            [
                'name' => 'Tingkat Kematangan Penerapan Manajemen Keamanan Informasi.',
                'explanation' => '<ol class="a">
    <li>Manajemen Keamanan Informasi dilakukan melalui serangkaian proses yang meliputi penetapan ruang lingkup, penetapan penanggung jawab, perencanaan, dukungan pengoperasian, evaluasi kinerja, dan perbaikan berkelanjutan terhadap Keamanan Informasi dalam SPBE.</li>
    <li>Manajemen Keamanan Informasi bertujuan untuk menjamin keberlangsungan SPBE dengan meminimalkan dampak risiko Keamanan Informasi.</li>
    <li>Penerapan Keamanan Informasi berlandaskan penjaminan kerahasiaan, keutuhan, ketersediaan, keaslian, dan kenirsangkalan (non-repudiation) sumber daya terkait data dan informasi, Infrastruktur SPBE, dan aplikasi.</li>
</ol>
',
                'rule_information' => 'PEDOMAN MENTERI PENDAYAGUNAAN APARATUR NEGARA DAN REFORMASI BIROKRASI REPUBLIK INDONESIA',
                'criteria' => 'Penilaian dilakukan terhadap bukti dukung penerapan
manajemen Keamanan Informasi Instansi
Pusat/Pemerintah Daerah yang memenuhi kriteria
ruang lingkup, serta terdokumentasi secara formal.',
                'current_level' => 'Level 1 - Pengendalian Keamanan Informasi belum atau telah tersedia dalam tahap pembangunan.',
                'target_level' => 'Level 5 - Kriteria tingkat 4 telah terpenuhi serta hasil reviu dan evaluasi pengendalian Keamanan Informasi ditindaklanjuti melalui perbaikan penerapan proses pengendalian Keamanan Informasi.',
                'related_documentation' => null,
                'person_in_charge' => $faker->name,
                'date_added' => Carbon::now(),
                'last_updated_date' => Carbon::now(),
                'status' => 'active',
            ], // Indikator 23
            [
                'name' => 'Tingkat Kematangan Penerapan Manajemen Data.',
                'explanation' => '<ol class="a">
    <li>Manajemen Data dilakukan melalui serangkaian proses pengelolaan arsitektur data, data induk, data referensi, basis data, kualitas data dan interoperabilitas data.</li>
    <li>Manajemen Data bertujuan untuk menjamin terwujudnya data yang akurat, mutakhir, terintegrasi, dan dapat diakses sebagai dasar perencanaan, pelaksanaan, evaluasi, dan pengendalian pembangunan nasional.</li>
</ol>',
                'rule_information' => 'PEDOMAN MENTERI PENDAYAGUNAAN APARATUR NEGARA DAN REFORMASI BIROKRASI REPUBLIK INDONESIA',
                'criteria' => 'Penilaian dilakukan terhadap bukti dukung penerapan
Manajemen Data Instansi Pusat/Pemerintah Daerah
yang memenuhi kriteria ruang lingkup, serta
terdokumentasi secara formal.',
                'current_level' => 'Level 1 - Kegiatan Manajemen Data belum atau telah diterapkan. Kondisi: Kegiatan Manajemen Data diterapkan tanpa program kegiatan yang terarah dan terencana.',
                'target_level' => 'Level 5 - Kriteria tingkat 4 telah terpenuhi serta hasil reviu dan evaluasi Manajemen Data ditindaklanjuti melalui perbaikan penerapan Manajemen Data serta selaras dengan kerangka regulasi SDI.',
                'related_documentation' => null,
                'person_in_charge' => $faker->name,
                'date_added' => Carbon::now(),
                'last_updated_date' => Carbon::now(),
                'status' => 'active',
            ], // Indikator 24
            [
                'name' => 'Tingkat Kematangan Penerapan Manajemen Aset TIK.',
                'explanation' => '<ol class="a">
    <li>Manajemen aset teknologi informasi dan komunikasi dilakukan melalui serangkaian proses perencanaan, pengadaan, pengelolaan, dan penghapusan perangkat keras dan perangkat lunak yang digunakan dalam SPBE.</li>
    <li>Manajemen aset teknologi informasi dan komunikasi bertujuan untuk menjamin ketersediaan dan optimalisasi pemanfaatan aset teknologi informasi dan komunikasi dalam SPBE.</li>
    <li>Aset TIK mencakup perangkat lunak, perangkat keras, data dan informasi, infrastruktur, SDM, lisensi, data, SOP, outsource services, dan IT asset register.</li>
</ol>
',
                'rule_information' => 'PEDOMAN MENTERI PENDAYAGUNAAN APARATUR NEGARA DAN REFORMASI BIROKRASI REPUBLIK INDONESIA',
                'criteria' => 'Penilaian dilakukan terhadap bukti dukung penerapan
Manajemen Aset TIK Instansi Pusat/Pemerintah Daerah yang memenuhi kriteria ruang lingkup, serta
terdokumentasi secara formal.',
                'current_level' => 'Level 1 - Kegiatan Manajemen Aset TIK belum atau sudah diterapkan. Kondisi: Kegiatan Manajemen Aset TIK diterapkan tanpa program kegiatan yang terarah dan terencana.',
                'target_level' => 'Level 5 - Kriteria tingkat 4 telah terpenuhi serta hasil reviu dan evaluasi Manajemen Aset TIK ditindaklanjuti melalui perbaikan penerapan Manajemen Aset TIK.',
                'related_documentation' => null,
                'person_in_charge' => $faker->name,
                'date_added' => Carbon::now(),
                'last_updated_date' => Carbon::now(),
                'status' => 'active',
            ], // Indikator 25
            [
                'name' => 'Tingkat Kematangan Kompetensi Sumber Daya Manusia.',
                'explanation' => '<ol class="a">
    <li>Pemenuhan kompetensi Sumber Daya Manusia SPBE bertujuan untuk menjamin keberlangsungan dan peningkatan mutu layanan dalam SPBE.</li>
    <li>Pemenuhan kompetensi Sumber Daya Manusia SPBE dilakukan melalui perencanaan, peningkatan kapasitas, pendayagunaan, dan penilaian kompetensi (kesesuaian antara persyaratan kompetensi dengan pemenuhan kompetensi) Sumber Daya Manusia dalam SPBE.</li>
    <li>Kompetensi Sumber Daya Manusia SPBE meliputi 6 (enam) kompetensi, yaitu bidang Proses Bisnis Pemerintahan, Arsitektur SPBE, Data dan Informasi, Keamanan SPBE, Aplikasi SPBE, dan Infrastruktur SPBE.</li>
</ol>
',
                'rule_information' => 'PEDOMAN MENTERI PENDAYAGUNAAN APARATUR NEGARA DAN REFORMASI BIROKRASI REPUBLIK INDONESIA',
                'criteria' => 'Penilaian dilakukan terhadap bukti dukung
pemenuhan 6 (enam) kompetensi SDM SPBE Instansi
Pusat/Pemerintah Daerah yang terdokumentasi secara
formal',
                'current_level' => 'Level 1 - Pemenuhan kompetensi Sumber Daya Manusia belum atau telah diupayakan. Kondisi: Pemenuhan kompetensi Sumber Daya Manusia SPBE dilakukan tanpa perencanaan Sumber Daya Manusia.',
                'target_level' => 'Level 5 - Kriteria tingkat 4 telah terpenuhi serta hasil reviu dan evaluasi telah ditindaklanjuti melalui perbaikan perencanaan dan model kompetensi Sumber Daya Manusia SPBE.',
                'related_documentation' => null,
                'person_in_charge' => $faker->name,
                'date_added' => Carbon::now(),
                'last_updated_date' => Carbon::now(),
                'status' => 'active',
            ], // Indikator 26
            [
                'name' => 'Tingkat Kematangan Penerapan Manajemen Pengetahuan.',
                'explanation' => '<ol class="a">
    <li>Manajemen Pengetahuan adalah proses yang dilakukan untuk mendokumentasi pengalaman dan pengetahuan dalam perencanaan, implementasi, dan evaluasi SPBE guna meningkatkan kualitas Layanan SPBE dan mendukung proses pengambilan keputusan dalam SPBE.</li>
</ol>
',
                'rule_information' => 'PEDOMAN MENTERI PENDAYAGUNAAN APARATUR NEGARA DAN REFORMASI BIROKRASI REPUBLIK INDONESIA',
                'criteria' => 'Penilaian dilakukan terhadap bukti dukung penerapan
Manajemen Pengetahuan SPBE Instansi
Pusat/Pemerintah Daerah yang memenuhi kriteria
ruang lingkup, serta terdokumentasi secara formal.',
                'current_level' => 'Level 1 - Manajemen Pengetahuan SPBE belum atau telah diterapkan. Kondisi: Manajemen Pengetahuan SPBE dilaksanakan tanpa perencanaan.',
                'target_level' => 'Level 5 - Kriteria tingkat 4 telah terpenuhi serta hasil reviu dan evaluasi terhadap penerapan Manajemen Pengetahuan SPBE telah ditindaklanjuti melalui perbaikan Manajemen Pengetahuan SPBE.',
                'related_documentation' => null,
                'person_in_charge' => $faker->name,
                'date_added' => Carbon::now(),
                'last_updated_date' => Carbon::now(),
                'status' => 'active',
            ], // Indikator 27
            [
                'name' => 'Tingkat Kematangan Penerapan Manajemen Perubahan.',
                'explanation' => '<ol class="a">
    <li>Manajemen Perubahan dilakukan melalui serangkaian proses perencanaan, analisis, pengembangan, implementasi, pemantauan dan evaluasi terhadap perubahan SPBE.</li>
    <li>Manajemen Perubahan bertujuan untuk menjamin keberlangsungan dan meningkatkan kualitas Layanan SPBE melalui pengendalian perubahan yang terjadi dalam SPBE.</li>
    <li>Lingkup Manajemen Perubahan SPBE:
        <ol type="1">
            <li>Perubahan Aplikasi;</li>
            <li>Perubahan Perangkat Keras;</li>
            <li>Perubahan Perangkat Lunak;</li>
            <li>Perubahan Infrastruktur;</li>
            <li>Perubahan Proses Bisnis;</li>
            <li>Perubahan Lingkungan Organisasi;</li>
            <li>Perubahan Layanan;</li>
            <li>Perubahan Data;</li>
            <li>Perubahan Keamanan;</li>
            <li>Perubahan Arsitektur.</li>
        </ol>
    </li>
</ol>
',
                'rule_information' => 'PEDOMAN MENTERI PENDAYAGUNAAN APARATUR NEGARA DAN REFORMASI BIROKRASI REPUBLIK INDONESIA',
                'criteria' => 'Penilaian dilakukan terhadap bukti dukung penerapan
Manajemen Perubahan SPBE Instansi
Pusat/Pemerintah Daerah yang memenuhi kriteria
ruang lingkup, serta terdokumentasi secara formal.',
                'current_level' => 'Level 1 - Kegiatan Manajemen Perubahan SPBE belum atau telah dilaksanakan. Kondisi: Kegiatan Manajemen Perubahan SPBE dilaksanakan tanpa perencanaan.',
                'target_level' => 'Level 5 - Kriteria tingkat 4 telah terpenuhi serta hasil reviu dan evaluasi telah ditindaklanjuti melalui perbaikan Manajemen Perubahan SPBE.',
                'related_documentation' => null,
                'person_in_charge' => $faker->name,
                'date_added' => Carbon::now(),
                'last_updated_date' => Carbon::now(),
                'status' => 'active',
            ], // Indikator 28
            [
                'name' => 'Tingkat Kematangan Penerapan Manajemen Layanan SPBE.',
                'explanation' => '<ol class="a">
    <li>Manajemen Layanan merupakan serangkaian proses pelayanan kepada pengguna, pengoperasian layanan, dan pengelolaan Aplikasi SPBE agar Layanan SPBE dapat berjalan berkesinambungan dan berkualitas.</li>
    <li>Manajemen Layanan bertujuan untuk menjamin keberlangsungan dan meningkatkan kualitas Layanan SPBE kepada Pengguna SPBE.</li>
    <li>Penyelenggaraan Manajemen Layanan SPBE ditujukan untuk memberikan dukungan terhadap layanan publik berbasis elektronik dan layanan administrasi pemerintahan berbasis elektronik agar Layanan SPBE tersebut dapat berjalan secara berkesinambungan, berkualitas, responsif, dan adaptif.</li>
    <li>Penyelenggaraan Manajemen Layanan dapat diwujudkan dengan membangun portal pusat layanan untuk menjalankan proses:
        <ol type="1">
            <li>pengelolaan keluhan, gangguan, masalah, permintaan, dan perubahan Layanan SPBE dari pengguna;</li>
            <li>pendayagunaan dan pemeliharaan Infrastruktur SPBE dan Aplikasi SPBE;</li>
            <li>pembangunan dan pengembangan aplikasi yang berpedoman pada metodologi pembangunan dan pengembangan aplikasi.</li>
        </ol>
    </li>
</ol>
',
                'rule_information' => 'PEDOMAN MENTERI PENDAYAGUNAAN APARATUR NEGARA DAN REFORMASI BIROKRASI REPUBLIK INDONESIA',
                'criteria' => 'Penilaian dilakukan terhadap bukti dukung penerapan
Manajemen Layanan SPBE Instansi Pusat/Pemerintah
Daerah yang memenuhi kriteria ruang lingkup, serta
terdokumentasi secara formal.',
                'current_level' => 'Level 1 - Manajemen Layanan SPBE belum atau telah dilaksanakan. Kondisi: Manajemen Layanan SPBE dilaksanakan tanpa perencanaan.',
                'target_level' => 'Level 5 - Kriteria tingkat 4 telah terpenuhi serta hasil reviu dan evaluasi telah ditindaklanjuti melalui perbaikan Manajemen Layanan SPBE.',
                'related_documentation' => null,
                'person_in_charge' => $faker->name,
                'date_added' => Carbon::now(),
                'last_updated_date' => Carbon::now(),
                'status' => 'active',
            ], // Indikator 29
            [
                'name' => 'Tingkat Kematangan Pelaksanaan Audit Infrastruktur SPBE.',
                'explanation' => '<ol class="a">
    <li>Audit Infrastruktur SPBE Instansi Pusat dan Pemerintah Daerah dilaksanakan berdasarkan standar dan tata cara pelaksanaan Audit Infrastruktur SPBE.</li>
    <li>Objek Audit Infrastruktur SPBE Instansi Pusat/Pemerintah Daerah adalah infrastruktur SPBE yang dimiliki oleh Instansi Pusat/Pemerintah Daerah yang terdiri atas jaringan intra Instansi Pusat/Pemerintah Daerah dan Sistem Penghubung Layanan Instansi Pusat/Pemerintah Daerah. Audit Infrastruktur SPBE terdiri dari pemeriksaan hal pokok teknis antara lain:
        <ol type="1">
            <li>penerapan tata kelola;</li>
            <li>penerapan manajemen infrastruktur SPBE;</li>
            <li>Fungsional infrastruktur SPBE;</li>
            <li>kinerja yang dihasilkan infrastruktur SPBE;</li>
            <li>aspek infrastruktur SPBE lainnya.</li>
        </ol>
    </li>
</ol>
',
                'rule_information' => 'PEDOMAN MENTERI PENDAYAGUNAAN APARATUR NEGARA DAN REFORMASI BIROKRASI REPUBLIK INDONESIA',
                'criteria' => 'Penilaian dilakukan terhadap bukti dukung
pelaksanaan Audit Infrastruktur SPBE Instansi
Pusat/Pemerintah Daerah yang sesuai dengan
pedoman audit TIK..',
                'current_level' => 'Level 1 - Kegiatan Audit Infrastruktur SPBE belum atau telah dilaksanakan. Kondisi: Kegiatan Audit Infrastruktur dilaksanakan tanpa perencanaan yang berkesinambungan.',
                'target_level' => 'Level 5 - Kriteria tingkat 4 telah terpenuhi dan hasil audit Infrastruktur SPBE telah ditindaklanjuti melalui perbaikan penerapan Infrastruktur SPBE.',
                'related_documentation' => null,
                'person_in_charge' => $faker->name,
                'date_added' => Carbon::now(),
                'last_updated_date' => Carbon::now(),
                'status' => 'active',
            ], // Indikator 30
            [
                'name' => 'Tingkat Kematangan Pelaksanaan Audit Aplikasi SPBE.',
                'explanation' => '<ol type="a">
    <li>Audit Aplikasi SPBE Instansi Pusat dan Pemerintah Daerah dilaksanakan berdasarkan standar dan tata cara pelaksanaan Audit Aplikasi SPBE.</li>
    <li>Audit Aplikasi SPBE terdiri atas:</li>
    <ol>
        <li>Audit Aplikasi Umum</li>
        <li>Audit Aplikasi Khusus</li>
    </ol>
    <li>Standar/pedoman audit dapat berupa standar internal Instansi Pusat/Pemerintah Daerah, standar/pedoman nasional, atau standar/pedoman internasional.</li>
</ol>',
                'rule_information' => 'PEDOMAN MENTERI PENDAYAGUNAAN APARATUR NEGARA DAN REFORMASI BIROKRASI REPUBLIK INDONESIA',
                'criteria' => 'Penilaian dilakukan terhadap bukti dukung
pelaksanaan Audit Aplikasi SPBE Instansi
Pusat/Pemerintah Daerah yang memenuhi kriteria
ruang lingkup, serta terdokumentasi secara formal.
Bukti dukung yang memenuhi kriteria penilaian
merupakan bukti dukung pelaksanaan Audit Aplikasi
SPBE yang dilakukan dalam kurun waktu 2 (dua)
tahun terakhir.',
                'current_level' => 'Level 1 - Kegiatan Audit Aplikasi SPBE belum atau telah dilaksanakan. Kondisi: Kegiatan Audit Aplikasi dilaksanakan tanpa perencanaan yang berkesinambungan.',
                'target_level' => 'Level 5 - Kriteria tingkat 4 telah terpenuhi dan hasil audit Aplikasi SPBE telah ditindaklanjuti melalui perbaikan penerapan Aplikasi SPBE.',
                'related_documentation' => null,
                'person_in_charge' => $faker->name,
                'date_added' => Carbon::now(),
                'last_updated_date' => Carbon::now(),
                'status' => 'active',
            ], // Indikator 31
            [
                'name' => 'Tingkat Kematangan Pelaksanaan Audit Keamanan SPBE.',
                'explanation' => '<ol type="a">
    <li>Audit Keamanan SPBE Instansi Pusat dan Pemerintah Daerah dilaksanakan berdasarkan standar dan tata cara pelaksanaan Audit Keamanan SPBE.</li>
    <li>Audit Keamanan SPBE terdiri atas:</li>
    <ol>
        <li>Audit Keamanan Aplikasi</li>
        <li>Audit Keamanan Infrastruktur</li>
    </ol>
    <li>Standar/pedoman audit dapat berupa standar internal Instansi Pusat/Pemerintah Daerah, standar/pedoman nasional, atau standar/pedoman internasional.</li>
</ol>',
                'rule_information' => 'PEDOMAN MENTERI PENDAYAGUNAAN APARATUR NEGARA DAN REFORMASI BIROKRASI REPUBLIK INDONESIA',
                'criteria' => 'Penilaian dilakukan terhadap bukti dukung
pelaksanaan Audit Keamanan SPBE Instansi
Pusat/Pemerintah Daerah yang memenuhi kriteria
ruang lingkup, serta terdokumentasi secara formal.
Bukti dukung yang memenuhi kriteria penilaian
merupakan bukti dukung pelaksanaan Audit
Keamanan SPBE yang dilakukan dalam kurun waktu
2 (dua) tahun terakhir.',
                'current_level' => 'Level 1 - Kegiatan Audit Keamanan SPBE belum atau telah dilaksanakan. Kondisi: Kegiatan Audit Keamanan dilaksanakan tanpa perencanaan yang berkesinambungan.',
                'target_level' => 'Level 5 - Kriteria tingkat 4 telah terpenuhi dan hasil audit Keamanan SPBE telah ditindaklanjuti melalui perbaikan penerapan Keamanan SPBE.',
                'related_documentation' => null,
                'person_in_charge' => $faker->name,
                'date_added' => Carbon::now(),
                'last_updated_date' => Carbon::now(),
                'status' => 'active',
            ], // Indikator 32
            [
                'name' => 'Tingkat Kematangan Layanan Perencanaan.',
                'explanation' => '<ol type="a">
    <li>Perencanaan adalah serangkaian proses untuk menghasilkan pengelolaan perencanaan yang efektif, efisien, dan akuntabel.</li>
    <li>Layanan Perencanaan Berbasis Elektronik yang dimaksud merupakan keluaran yang dihasilkan 1 (satu) atau lebih aplikasi yang memberikan nilai manfaat dalam pengelolaan perencanaan Instansi Pusat dan/atau Pemerintah Daerah.</li>
</ol>',
                'rule_information' => 'PEDOMAN MENTERI PENDAYAGUNAAN APARATUR NEGARA DAN REFORMASI BIROKRASI REPUBLIK INDONESIA',
                'criteria' => 'Penilaian dilakukan terhadap kapabilitas fungsi/
kemampuan teknis yang dapat diberikan sistem
aplikasi/layanan perencanaan berbasis elektronik
kepada pengguna.',
                'current_level' => 'Level 1 - Layanan Perencanan Berbasis Elektronik hanya memberikan layanan informasi terkait perencanaan kegiatan pemerintah.',
                'target_level' => 'Level 5 - Kriteria tingkat 4 telah terpenuhi dan Layanan Perencanaan Berbasis Elektronik telah dilakukan perbaikan berdasarkan hasil reviu dan evaluasi terhadap perubahan lingkungan, peraturan perundang-undangan, teknologi atau kebutuhan Instansi Pusat/Pemerintah Daerah.',
                'related_documentation' => null,
                'person_in_charge' => $faker->name,
                'date_added' => Carbon::now(),
                'last_updated_date' => Carbon::now(),
                'status' => 'active',
            ], // Indikator 33
            [
                'name' => 'Tingkat Kematangan Layanan Penganggaran.',
                'explanation' => '<ol type="a">
    <li>Penganggaran adalah serangkaian proses untuk menghasilkan pengelolaan penganggaran yang efektif, efisien, dan akuntabel.</li>
    <li>Layanan Penganggaran Berbasis Elektronik yang dimaksud merupakan keluaran yang dihasilkan 1 (satu) atau lebih aplikasi yang memberikan nilai manfaat dalam pengelolaan penganggaran Instansi Pusat dan/atau Pemerintah Daerah.</li>
</ol>',
                'rule_information' => 'PEDOMAN MENTERI PENDAYAGUNAAN APARATUR NEGARA DAN REFORMASI BIROKRASI REPUBLIK INDONESIA',
                'criteria' => 'Penilaian dilakukan terhadap kapabilitas fungsi/
kemampuan teknis yang dapat diberikan sistem
aplikasi/layanan penganggaran berbasis elektronik
kepada pengguna.
',
                'current_level' => 'Level 1 - Layanan Penganggaran Berbasis Elektronik hanya memberikan layanan informasi terkait penganggaran kegiatan pemerintah.',
                'target_level' => 'Level 5 - Kriteria tingkat 4 telah terpenuhi dan Layanan Penganggaran Berbasis Elektronik telah dilakukan perbaikan berdasarkan hasil reviu dan evaluasi terhadap perubahan lingkungan, peraturan perundang-undangan, teknologi atau kebutuhan Instansi Pusat/Pemerintah Daerah.',
                'related_documentation' => null,
                'person_in_charge' => $faker->name,
                'date_added' => Carbon::now(),
                'last_updated_date' => Carbon::now(),
                'status' => 'active',
            ], // Indikator 34
            [
                'name' => 'Tingkat Kematangan Layanan Keuangan.',
                'explanation' => '<ol type="a">
    <li>Keuangan adalah serangkaian proses untuk menghasilkan pengelolaan keuangan yang efektif, efisien, dan akuntabel.</li>
    <li>Layanan Keuangan Berbasis Elektronik yang dimaksud merupakan keluaran yang dihasilkan 1 (satu) atau lebih aplikasi yang memberikan nilai manfaat dalam pengelolaan keuangan Instansi Pusat dan/atau Pemerintah Daerah.</li>
</ol>',
                'rule_information' => 'PEDOMAN MENTERI PENDAYAGUNAAN APARATUR NEGARA DAN REFORMASI BIROKRASI REPUBLIK INDONESIA',
                'criteria' => 'Penilaian dilakukan terhadap kapabilitas fungsi/
kemampuan teknis yang dapat diberikan sistem
aplikasi/layanan keuangan berbasis elektronik kepada
pengguna.',
                'current_level' => 'Level 1 - Layanan Keuangan Berbasis Elektronik hanya memberikan layanan informasi terkait keuangan di Instansi Pusat/Pemerintah Daerah.',
                'target_level' => 'Level 5 - Kriteria tingkat 4 telah terpenuhi dan Layanan Keuangan Berbasis Elektronik telah dilakukan perbaikan berdasarkan hasil reviu dan evaluasi terhadap perubahan lingkungan, peraturan perundang-undangan, teknologi atau kebutuhan Instansi Pusat/Pemerintah Daerah.',
                'related_documentation' => null,
                'person_in_charge' => $faker->name,
                'date_added' => Carbon::now(),
                'last_updated_date' => Carbon::now(),
                'status' => 'active',
            ], // Indikator 35
            [
                'name' => 'Tingkat Kematangan Layanan Pengadaan Barang dan Jasa.',
                'explanation' => '<ol type="a">
    <li>Pengadaan Barang/Jasa adalah serangkaian proses untuk menghasilkan pengelolaan Pengadaan barang/jasa yang efektif, efisien, dan akuntabel.</li>
    <li>Layanan Pengadaan Barang/Jasa Berbasis Elektronik yang dimaksud merupakan keluaran yang dihasilkan 1 (satu) atau lebih aplikasi yang memberikan nilai manfaat dalam pengelolaan pengadaan barang/jasa Instansi Pusat dan/atau Pemerintah Daerah.</li>
    <li>Katalog Elektronik Sektoral adalah Katalog Elektronik yang disusun dan dikelola oleh Kementerian/Lembaga.</li>
    <li>Katalog Elektronik Lokal adalah Katalog Elektronik yang disusun dan dikelola oleh Pemerintah Daerah.</li>
</ol>',
                'rule_information' => 'PEDOMAN MENTERI PENDAYAGUNAAN APARATUR NEGARA DAN REFORMASI BIROKRASI REPUBLIK INDONESIA',
                'criteria' => 'Penilaian dilakukan terhadap kapabilitas fungsi/
kemampuan teknis yang dapat diberikan sistem
aplikasi/layanan pengadaan barang dan jasa berbasis
elektronik kepada pengguna.',
                'current_level' => 'Level 1 - Layanan Pengadaan Barang dan Jasa Berbasis Elektronik hanya memberikan layanan informasi terkait pengadaan barang dan jasa di Instansi Pusat/Pemerintah Daerah.',
                'target_level' => 'Level 5 - Kriteria tingkat 4 telah terpenuhi dan Layanan Pengadaan Barang dan Jasa Berbasis Elektronik telah dilakukan perbaikan berdasarkan hasil reviu dan evaluasi terhadap perubahan lingkungan, peraturan perundang-undangan, teknologi atau kebutuhan Instansi Pusat/Pemerintah Daerah.',
                'related_documentation' => null,
                'person_in_charge' => $faker->name,
                'date_added' => Carbon::now(),
                'last_updated_date' => Carbon::now(),
                'status' => 'active',
            ], // Indikator 36
            [
                'name' => 'Tingkat Kematangan Layanan Kepegawaian.',
                'explanation' => '<ol type="a">
    <li>Kepegawaian adalah serangkaian proses untuk menghasilkan pengelolaan kepegawaian yang efektif, efisien, dan akuntabel.</li>
    <li>Layanan Kepegawaian Berbasis Elektronik yang dimaksud merupakan keluaran yang dihasilkan 1 (satu) atau lebih aplikasi yang memberikan nilai manfaat dalam pengelolaan kepegawaian Instansi Pusat dan/atau Pemerintah Daerah.</li>
</ol>',
                'rule_information' => 'PEDOMAN MENTERI PENDAYAGUNAAN APARATUR NEGARA DAN REFORMASI BIROKRASI REPUBLIK INDONESIA',
                'criteria' => 'Penilaian dilakukan terhadap kapabilitas fungsi/
kemampuan teknis yang dapat diberikan sistem
aplikasi/layanan kepegawaian.',
                'current_level' => 'Level 1 - Layanan Kepegawaian Berbasis Elektronik hanya memberikan layanan informasi terkait kepegawaian.',
                'target_level' => 'Level 5 - Kriteria tingkat 4 telah terpenuhi dan Layanan Kepegawaian Berbasis Elektronik telah dilakukan perbaikan berdasarkan hasil reviu dan evaluasi terhadap perubahan lingkungan, peraturan perundang-undangan, teknologi atau kebutuhan Instansi Pusat/Pemerintah Daerah.',
                'related_documentation' => null,
                'person_in_charge' => $faker->name,
                'date_added' => Carbon::now(),
                'last_updated_date' => Carbon::now(),
                'status' => 'active',
            ], // Indikator 37
            [
                'name' => 'Tingkat Kematangan Layanan Kearsipan Dinamis',
                'explanation' => '<ol type="a">
    <li>Kearsipan adalah serangkaian proses untuk menghasilkan pengelolaan kearsipan yang efektif, efisien, dan akuntabel.</li>
    <li>Arsip terbagi 2, yaitu Arsip Dinamis dan Arsip Statis.</li>
    <li>Arsip dinamis merupakan dokumen/naskah dinas yang masih digunakan.</li>
    <li>Arsip statis merupakan dokumen/naskah dinas yang telah melewati masa retensinya.</li>
    <li>Layanan Kearsipan Dinamis Berbasis Elektronik yang dimaksud merupakan keluaran yang dihasilkan 1 (satu) atau lebih aplikasi yang memberikan nilai manfaat dalam pengelolaan kearsipan dinamis Instansi Pusat dan/atau Pemerintah Daerah.</li>
</ol>',
                'rule_information' => 'PEDOMAN MENTERI PENDAYAGUNAAN APARATUR NEGARA DAN REFORMASI BIROKRASI REPUBLIK INDONESIA',
                'criteria' => 'Penilaian dilakukan terhadap kapabilitas fungsi/
kemampuan teknis yang dapat diberikan sistem
aplikasi/layanan kearsipan.',
                'current_level' => 'Level 1 - Layanan Kearsipan Berbasis Elektronik hanya memberikan layanan informasi terkait kearsipan.',
                'target_level' => 'Level 5 - Kriteria tingkat 4 telah terpenuhi dan Layanan Kearsipan Berbasis Elektronik telah dilakukan perbaikan berdasarkan hasil reviu dan evaluasi terhadap perubahan lingkungan, peraturan perundang-undangan, teknologi atau kebutuhan Instansi Pusat/Pemerintah Daerah.',
                'related_documentation' => null,
                'person_in_charge' => $faker->name,
                'date_added' => Carbon::now(),
                'last_updated_date' => Carbon::now(),
                'status' => 'active',
            ], // Indikator 38
            [
                'name' => 'Tingkat Kematangan Layanan Pengelolaan Barang Milik Negara/Daerah.',
                'explanation' => '<ol type="a">
    <li>Pengelolaan Barang Milik Negara/Daerah (BMN/BMD) adalah serangkaian proses untuk menghasilkan pengelolaan BMN yang efektif, efisien, dan akuntabel.</li>
    <li>Layanan Pengelolaan BMN/BMD Berbasis Elektronik yang dimaksud merupakan keluaran yang dihasilkan 1 (satu) atau lebih aplikasi yang memberikan nilai manfaat dalam pengelolaan BMN Instansi Pusat dan/atau BMD Pemerintah Daerah.</li>
</ol>',
                'rule_information' => 'PEDOMAN MENTERI PENDAYAGUNAAN APARATUR NEGARA DAN REFORMASI BIROKRASI REPUBLIK INDONESIA',
                'criteria' => 'Penilaian dilakukan terhadap kapabilitas fungsi/
kemampuan teknis yang dapat diberikan sistem
aplikasi/layanan pengelolaan barang milik
Negara/Daerah.',
                'current_level' => 'Level 1 - Layanan Pengelolaan Barang Milik Negara/Daerah Berbasis Elektronik hanya memberikan layanan informasi terkait pengelolaan barang milik negara/daerah.',
                'target_level' => 'Level 5 - Kriteria tingkat 4 telah terpenuhi dan Layanan Pengelolaan Barang Milik Negara/Daerah Berbasis Elektronik telah dilakukan perbaikan berdasarkan hasil reviu dan evaluasi terhadap perubahan lingkungan, peraturan perundang-undangan, teknologi atau kebutuhan Instansi Pusat/Pemerintah Daerah.',
                'related_documentation' => null,
                'person_in_charge' => $faker->name,
                'date_added' => Carbon::now(),
                'last_updated_date' => Carbon::now(),
                'status' => 'active',
            ], // Indikator 39
            [
                'name' => 'Tingkat Kematangan Layanan Pengawasan Internal terkait Pemerintah.',
                'explanation' => '<ol type="a">
    <li>Pengawasan Internal adalah serangkaian proses untuk menghasilkan pengelolaan pengawasan internal yang efektif, efisien, dan akuntabel.</li>
    <li>Layanan Pengawasan Internal Berbasis Elektronik yang dimaksud merupakan keluaran yang dihasilkan 1 (satu) atau lebih aplikasi yang memberikan nilai manfaat dalam pengelolaan Pengawasan Internal Instansi Pusat dan/atau Pemerintah Daerah.</li>
</ol>',
                'rule_information' => 'PEDOMAN MENTERI PENDAYAGUNAAN APARATUR NEGARA DAN REFORMASI BIROKRASI REPUBLIK INDONESIA',
                'criteria' => 'Penilaian dilakukan terhadap kapabilitas fungsi/
kemampuan teknis yang dapat diberikan sistem
aplikasi/layanan pengawasan internal terkait
pemerintah.
',
                'current_level' => 'Level 1 - Layanan Pengawasan Internal Pemerintah Berbasis Elektronik hanya memberikan layanan informasi terkait pengawasan internal pemerintah.',
                'target_level' => 'Level 5 - Kriteria tingkat 4 telah terpenuhi dan Layanan Pengawasan Internal Berbasis Elektronik telah dilakukan perbaikan berdasarkan hasil reviu dan evaluasi terhadap perubahan lingkungan, peraturan perundang-undangan, teknologi atau kebutuhan Instansi Pusat/Pemerintah Daerah.',
                'related_documentation' => null,
                'person_in_charge' => $faker->name,
                'date_added' => Carbon::now(),
                'last_updated_date' => Carbon::now(),
                'status' => 'active',
            ], // Indikator 40
            [
                'name' => 'Tingkat Kematangan Layanan Akuntabilitas Kinerja Organisasi.',
                'explanation' => '<ol type="a">
    <li>Akuntabilitas Kinerja Instansi Pusat/Pemerintah Daerah adalah serangkaian proses untuk menghasilkan pengelolaan Akuntabilitas Kinerja Instansi Pusat/Pemerintah Daerah yang efektif, efisien, dan akuntabel.</li>
    <li>Layanan Akuntabilitas Kinerja Instansi Pusat/Pemerintah Daerah Berbasis Elektronik yang dimaksud merupakan keluaran yang dihasilkan 1 (satu) atau lebih aplikasi yang memberikan nilai manfaat dalam pengelolaan Akuntabilitas Kinerja Instansi Pusat dan/atau Pemerintah Daerah.</li>
</ol>',
                'rule_information' => 'PEDOMAN MENTERI PENDAYAGUNAAN APARATUR NEGARA DAN REFORMASI BIROKRASI REPUBLIK INDONESIA',
                'criteria' => 'Penilaian dilakukan terhadap kapabilitas fungsi/
kemampuan teknis yang dapat diberikan sistem
aplikasi/layanan akuntabilitas kinerja organisasi.',
                'current_level' => 'Level 1 - Layanan Akuntabilitas Kinerja Instansi Pusat/Pemerintah Daerah Berbasis Elektronik hanya memberikan layanan informasi terkait akuntabilitas kinerja Instansi Pusat/Pemerintah Daerah.',
                'target_level' => 'Level 5 - Kriteria tingkat 4 telah terpenuhi dan Layanan Akuntabilitas Kinerja Instansi Pusat/Pemerintah Daerah Berbasis Elektronik telah dilakukan perbaikan berdasarkan hasil reviu dan evaluasi terhadap perubahan lingkungan, peraturan perundang-undangan, teknologi atau kebutuhan Instansi Pusat/Pemerintah Daerah.',
                'related_documentation' => null,
                'person_in_charge' => $faker->name,
                'date_added' => Carbon::now(),
                'last_updated_date' => Carbon::now(),
                'status' => 'active',
            ], // Indikator 41
            [
                'name' => 'Tingkat Kematangan Layanan Kinerja Pegawai.',
                'explanation' => '<ol type="a">
    <li>Kinerja Pegawai adalah serangkaian proses untuk menghasilkan pengelolaan kinerja pegawai Instansi Pusat/Pemerintah Daerah yang efektif, efisien, dan akuntabel.</li>
    <li>Layanan Kinerja Pegawai Instansi Pusat/Pemerintah Daerah Berbasis Elektronik yang dimaksud merupakan keluaran yang dihasilkan 1 (satu) atau lebih aplikasi yang memberikan nilai manfaat dalam pengelolaan kinerja pegawai di Instansi Pusat dan/atau Pemerintah Daerah.</li>
</ol>',
                'rule_information' => 'PEDOMAN MENTERI PENDAYAGUNAAN APARATUR NEGARA DAN REFORMASI BIROKRASI REPUBLIK INDONESIA',
                'criteria' => 'Penilaian dilakukan terhadap kapabilitas fungsi/
kemampuan teknis yang dapat diberikan sistem
aplikasi/layanan kinerja pegawai',
                'current_level' => 'Level 1 - Layanan Kinerja Pegawai Berbasis Elektronik hanya memberikan layanan informasi terkait kinerja pegawai.',
                'target_level' => 'Level 5 - Kriteria tingkat 4 telah terpenuhi dan Layanan Kinerja Pegawai Berbasis Elektronik telah dilakukan perbaikan berdasarkan hasil reviu dan evaluasi terhadap perubahan lingkungan, peraturan perundang-undangan, teknologi atau kebutuhan Instansi Pusat/Pemerintah Daerah.',
                'related_documentation' => null,
                'person_in_charge' => $faker->name,
                'date_added' => Carbon::now(),
                'last_updated_date' => Carbon::now(),
                'status' => 'active',
            ], // Indikator 42
            [
                'name' => 'Tingkat Kematangan Layanan Pengaduan Pelayanan Publik.',
                'explanation' => '<ol type="a">
    <li>Pengaduan Pelayanan Publik adalah serangkaian proses untuk menghasilkan pengelolaan pengaduan pelayanan publik Instansi Pusat/Pemerintah Daerah yang efektif, efisien, dan akuntabel.</li>
    <li>Layanan Pengaduan Pelayanan Publik Berbasis Elektronik yang dimaksud merupakan keluaran yang dihasilkan 1 (satu) atau lebih aplikasi yang memberikan nilai manfaat dalam pengelolaan pengaduan pelayanan publik di Instansi Pusat dan/atau Pemerintah Daerah.</li>
</ol>',
                'rule_information' => 'PEDOMAN MENTERI PENDAYAGUNAAN APARATUR NEGARA DAN REFORMASI BIROKRASI REPUBLIK INDONESIA',
                'criteria' => 'Penilaian dilakukan terhadap kapabilitas fungsi/
kemampuan teknis yang dapat diberikan sistem
aplikasi/layanan pengaduan publik.',
                'current_level' => 'Level 1 - Layanan Pengaduan Pelayanan Publik Berbasis Elektronik hanya memberikan layanan informasi terkait pengaduan pelayanan publik.',
                'target_level' => 'Level 5 - Kriteria tingkat 4 telah terpenuhi dan Layanan Pengaduan Pelayanan Publik Berbasis Elektronik telah dilakukan perbaikan berdasarkan hasil reviu dan evaluasi terhadap perubahan lingkungan, peraturan perundang-undangan, teknologi atau kebutuhan Instansi Pusat/Pemerintah Daerah.',
                'related_documentation' => null,
                'person_in_charge' => $faker->name,
                'date_added' => Carbon::now(),
                'last_updated_date' => Carbon::now(),
                'status' => 'active',
            ], // Indikator 43
            [
                'name' => 'Tingkat Kematangan Layanan Data Terbuka.',
                'explanation' => '<ol type="a">
    <li>Layanan Data Terbuka merupakan konsep berbagi pakai data sesuai dengan ketentuan Satu Data Indonesia.</li>
    <li>Satu Data Indonesia adalah kebijakan tata kelola data pemerintah untuk menghasilkan data akurat, mutakhir, terpadu, dan dapat dipertanggungjawabkan, serta mudah diakses dan dibagipakaikan antar Instansi Pusat dan Pemerintah Daerah melalui pemenuhan standar data, metadata, interoperabilitas data, dan menggunakan kode referensi dan data induk.</li>
    <li>Layanan Data Terbuka Berbasis Elektronik yang dimaksud merupakan keluaran yang dihasilkan satu atau lebih aplikasi yang memberikan nilai manfaat dalam pengelolaan data Instansi Pusat/Pemerintah Daerah dengan memanfaatkan portal Satu Data Indonesia.</li>
</ol>',
                'rule_information' => 'PEDOMAN MENTERI PENDAYAGUNAAN APARATUR NEGARA DAN REFORMASI BIROKRASI REPUBLIK INDONESIA',
                'criteria' => 'Penilaian dilakukan terhadap kapabilitas fungsi/
kemampuan teknis/pemanfaatan yang dapat
diberikan sistem aplikasi/layanan data terbuka.',
                'current_level' => 'Level 1 - Layanan Data Terbuka Berbasis Elektronik hanya memberikan layanan informasi terkait data terbuka.',
                'target_level' => 'Level 5 - Kriteria tingkat 4 telah terpenuhi dan Layanan Data Terbuka Berbasis Elektronik telah dilakukan perbaikan berdasarkan hasil reviu dan evaluasi terhadap perubahan lingkungan, peraturan perundang-undangan, teknologi atau kebutuhan Instansi Pusat/Pemerintah Daerah.',
                'related_documentation' => null,
                'person_in_charge' => $faker->name,
                'date_added' => Carbon::now(),
                'last_updated_date' => Carbon::now(),
                'status' => 'active',
            ], // Indikator 44
            [
                'name' => 'Tingkat Kematangan Layanan Jaringan Dokumentasi dan Informasi Hukum (JDIH).',
                'explanation' => '<ol type="a">
    <li>Jaringan Dokumentasi dan Informasi Hukum adalah serangkaian proses untuk menghasilkan pengelolaan jaringan dokumentasi dan informasi hukum Instansi Pusat/Pemerintah Daerah yang efektif, efisien, dan akuntabel.</li>
    <li>Layanan Jaringan Dokumentasi dan Informasi Hukum Berbasis Elektronik yang dimaksud merupakan keluaran yang dihasilkan 1 (satu) atau lebih aplikasi yang memberikan nilai manfaat dalam pengelolaan jaringan dokumentasi dan informasi hukum Instansi Pusat/Pemerintah Daerah Instansi Pusat dan/atau Pemerintah Daerah.</li>
</ol>',
                'rule_information' => 'PEDOMAN MENTERI PENDAYAGUNAAN APARATUR NEGARA DAN REFORMASI BIROKRASI REPUBLIK INDONESIA',
                'criteria' => 'Penilaian dilakukan terhadap kapabilitas fungsi/
kemampuan teknis yang dapat diberikan sistem
aplikasi/layanan jaringan dokumentasi dan informasi
hukum.',
                'current_level' => 'Level 1 - Layanan Jaringan Dokumentasi dan Informasi Hukum Berbasis Elektronik hanya memberikan layanan informasi terkait jaringan dokumentasi dan informasi hukum.',
                'target_level' => 'Level 5 - Kriteria tingkat 4 telah terpenuhi dan Layanan Jaringan Dokumentasi dan Informasi Hukum Berbasis Elektronik telah dilakukan perbaikan berdasarkan hasil reviu dan evaluasi terhadap perubahan lingkungan, peraturan perundang-undangan, teknologi atau kebutuhan Instansi Pusat/Pemerintah Daerah.',
                'related_documentation' => null,
                'person_in_charge' => $faker->name,
                'date_added' => Carbon::now(),
                'last_updated_date' => Carbon::now(),
                'status' => 'active',
            ], // Indikator 45
            [
                'name' =>'Tingkat Kematangan Layanan Publik Sektoral 1.',
                'explanation' => '<ol type="a">
    <li>Layanan Publik Sektor adalah serangkaian proses untuk menghasilkan pengelolaan tugas dan fungsi sektoral Instansi Pusat/Pemerintah Daerah yang efektif, efisien, dan akuntabel.</li>
    <li>Yang dimaksud layanan publik sektoral pada indikator ini adalah berupa layanan yang bersifat Government to Citizen (G to C), Government to Business (G to B), maupun Government to Government (G to G) sesuai dengan tugas pokok dan fungsi Instansi Pusat/Pemerintah Daerah.</li>
    <li>Layanan Publik Sektor Berbasis Elektronik yang dimaksud merupakan keluaran yang dihasilkan 1 (satu) atau lebih aplikasi yang memberikan nilai manfaat dalam pengelolaan Layanan Publik Sektoral Instansi Pusat/Pemerintah Daerah Instansi Pusat dan/atau Pemerintah Daerah.</li>
    <li>Layanan Publik Sektor yang dimaksud merupakan layanan sektoral selain pada indikator 32 – 44.</li>
</ol>',
                'rule_information' => 'PEDOMAN MENTERI PENDAYAGUNAAN APARATUR NEGARA DAN REFORMASI BIROKRASI REPUBLIK INDONESIA',
                'criteria' => 'Penilaian dilakukan terhadap kapabilitas fungsi/
kemampuan teknis yang dapat diberikan sistem
aplikasi/layanan publik sektoral yang dimiliki.',
                'current_level' => 'Level 1 - Layanan Publik Sektoral Berbasis Elektronik hanya memberikan layanan informasi terkait Publik Sektoral kegiatan pemerintah.',
                'target_level' => 'Level 5 - Kriteria tingkat 4 telah terpenuhi dan Layanan Publik Sektoral Berbasis Elektronik telah dilakukan perbaikan berdasarkan hasil reviu dan evaluasi terhadap perubahan lingkungan, peraturan perundang-undangan, teknologi dan kebutuhan Instansi Pusat/Pemerintah Daerah.',
                'related_documentation' => null,
                'person_in_charge' => $faker->name,
                'date_added' => Carbon::now(),
                'last_updated_date' => Carbon::now(),
                'status' => 'active',
            ], // Indikator 46
            [
                'name' => 'Tingkat Kematangan Layanan Publik Sektoral 2.',
                'explanation' => '<ol type="a">
    <li>Layanan Publik Sektor adalah serangkaian proses untuk menghasilkan pengelolaan tugas dan fungsi sektoral Instansi Pusat/Pemerintah Daerah yang efektif, efisien, dan akuntabel.</li>
    <li>Yang dimaksud layanan publik sektoral pada indikator ini adalah berupa layanan yang bersifat Government to Citizen (G to C), Government to Business (G to B), maupun Government to Government (G to G) sesuai dengan tugas pokok dan fungsi Instansi Pusat/Pemerintah Daerah.</li>
    <li>Layanan Publik Sektor Berbasis Elektronik yang dimaksud merupakan keluaran yang dihasilkan 1 (satu) atau lebih aplikasi yang memberikan nilai manfaat dalam pengelolaan Layanan Publik Sektoral Instansi Pusat/Pemerintah Daerah Instansi Pusat dan/atau Pemerintah Daerah.</li>
    <li>Layanan Publik Sektor yang dimaksud merupakan layanan sektoral selain pada indikator 32 – 44.</li>
</ol>',
                'rule_information' => 'PEDOMAN MENTERI PENDAYAGUNAAN APARATUR NEGARA DAN REFORMASI BIROKRASI REPUBLIK INDONESIA',
                'criteria' => 'Penilaian dilakukan terhadap kapabilitas fungsi/
kemampuan teknis yang dapat diberikan sistem
aplikasi/layanan publik sektoral yang dimiliki.
',
                'current_level' => 'Level 1 - Layanan Publik Sektoral Berbasis Elektronik hanya memberikan layanan informasi terkait Publik Sektoral kegiatan pemerintah.',
                'target_level' => 'Level 5 - Kriteria tingkat 4 telah terpenuhi dan Layanan Publik Sektoral Berbasis Elektronik telah dilakukan perbaikan berdasarkan hasil reviu dan evaluasi terhadap perubahan lingkungan, peraturan perundang-undangan, teknologi dan kebutuhan Instansi Pusat/Pemerintah Daerah.',
                'related_documentation' => null,
                'person_in_charge' => $faker->name,
                'date_added' => Carbon::now(),
                'last_updated_date' => Carbon::now(),
                'status' => 'active',
            ], // Indikator 47
            [
                'name' => 'Tingkat Kematangan Layanan Publik Sektoral 3.',
                'explanation' => '<ol type="a">
    <li>Layanan Publik Sektor adalah serangkaian proses untuk menghasilkan pengelolaan tugas dan fungsi sektoral Instansi Pusat/Pemerintah Daerah yang efektif, efisien, dan akuntabel.</li>
    <li>Yang dimaksud layanan publik sektoral pada indikator ini adalah berupa layanan yang bersifat Government to Citizen (G to C), Government to Business (G to B), maupun Government to Government (G to G) sesuai dengan tugas pokok dan fungsi Instansi Pusat/Pemerintah Daerah.</li>
    <li>Layanan Publik Sektor Berbasis Elektronik yang dimaksud merupakan keluaran yang dihasilkan 1 (satu) atau lebih aplikasi yang memberikan nilai manfaat dalam pengelolaan Layanan Publik Sektoral Instansi Pusat/Pemerintah Daerah Instansi Pusat dan/atau Pemerintah Daerah.</li>
    <li>Layanan Publik Sektor yang dimaksud merupakan layanan sektoral selain pada indikator 32 – 44.</li>
</ol>',
                'rule_information' => 'PEDOMAN MENTERI PENDAYAGUNAAN APARATUR NEGARA DAN REFORMASI BIROKRASI REPUBLIK INDONESIA',
                'criteria' => 'Penilaian dilakukan terhadap kapabilitas fungsi/
kemampuan teknis yang dapat diberikan sistem
aplikasi/layanan publik sektoral yang dimiliki.',
                'current_level' => 'Level 1 - Layanan Publik Sektoral Berbasis Elektronik hanya memberikan layanan informasi terkait Publik Sektoral kegiatan pemerintah.',
                'target_level' => 'Level 5 - Kriteria tingkat 4 telah terpenuhi dan Layanan Publik Sektoral Berbasis Elektronik telah dilakukan perbaikan berdasarkan hasil reviu dan evaluasi terhadap perubahan lingkungan, peraturan perundang-undangan, teknologi dan kebutuhan Instansi Pusat/Pemerintah Daerah.',
                'related_documentation' => null,
                'person_in_charge' => $faker->name,
                'date_added' => Carbon::now(),
                'last_updated_date' => Carbon::now(),
                'status' => 'active',
            ],
        ]);
    }
}

