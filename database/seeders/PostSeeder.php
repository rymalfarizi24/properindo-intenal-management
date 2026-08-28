<?php

namespace Database\Seeders;

use App\Models\Post;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Post::create([
            'title' => 'Pengantar Machine Learning: Mengapa Mesin Bisa Belajar?',
            'slug' => 'pengantar-machine-learning',
            'author_id' => 1,
            'category_id' => 1,
            'body' => 'Machine Learning (ML) adalah sub-bidang dari kecerdasan buatan (AI) yang memungkinkan sistem untuk belajar dari data, mengidentifikasi pola, dan membuat keputusan dengan intervensi manusia yang minimal. Intinya, kita tidak secara eksplisit memprogram mesin dengan setiap aturan yang mungkin; sebaliknya, kita memberinya banyak data dan membiarkannya menyusun aturannya sendiri.'
        ]);

        Post::create([
            'title' => 'Penerapan Machine Learning dalam Kehidupan Sehari-hari',
            'slug' => 'penerapan-machine-learning',
            'author_id' => 1,
            'category_id' => 1,
            'body' => 'Machine Learning (ML) mungkin terdengar seperti konsep futuristik, tetapi ML sudah tertanam dalam banyak aspek kehidupan digital kita sehari-hari. Ia bekerja di latar belakang, membuat pengalaman kita lebih cerdas, lebih cepat, dan lebih personal.'
        ]);

        Post::create([
            'title' => 'Tentang Ekonomi',
            'slug' => 'tentang-ekonomi',
            'author_id' => 1,
            'category_id' => 1,
            'image' => 'post-images/rIZ78bqIeqjmrPdBLvqxBw53iysJa6fUkoGj2cB1.png',
            'body' => '<div>Ekonomi adalah bidang yang sangat luas, namun pada intinya, ekonomi membahas tentang <strong>pilihan</strong>. Karena sumber daya di dunia ini terbatas (langka), sedangkan keinginan manusia tidak terbatas, kita harus memutuskan bagaimana cara terbaik untuk mengalokasikan apa yang kita miliki.</div><div>Berikut adalah ulasan singkat mengenai pilar utama dalam ekonomi:</div><div>1. Dua Cabang Utama Ekonomi</div><div>Secara umum, studi ekonomi dibagi menjadi dua kategori besar:</div><ul><li><strong>Mikroekonomi:</strong> Berfokus pada keputusan individu dan perusahaan. Contohnya, bagaimana sebuah keluarga mengatur anggaran bulanan atau bagaimana perusahaan menetapkan harga produk.</li><li><strong>Makroekonomi:</strong> Melihat gambaran besar suatu negara atau dunia. Ini mencakup topik seperti inflasi, tingkat pengangguran, pertumbuhan ekonomi (PDB), dan kebijakan pemerintah.</li></ul><div>2. Hukum Permintaan dan Penawaran</div><div>Ini adalah fondasi dari pasar bebas. Hukum ini menjelaskan hubungan antara harga dan ketersediaan barang:</div><ul><li><strong>Permintaan:</strong> Semakin tinggi harga, biasanya semakin sedikit orang yang ingin membeli.</li><li><strong>Penawaran:</strong> Semakin tinggi harga, produsen semakin bersemangat untuk menjual lebih banyak barang.</li></ul><div>Titik di mana permintaan dan penawaran bertemu disebut sebagai <strong>Harga Keseimbangan (Equilibrium)</strong>.</div><div>3. Pentingnya Pertumbuhan Ekonomi</div><div>Ekonomi yang sehat ditandai dengan pertumbuhan Produk Domestik Bruto (PDB) yang stabil. PDB adalah total nilai barang dan jasa yang dihasilkan suatu negara dalam periode tertentu. Pertumbuhan ini penting karena:</div><ol><li>Menciptakan lapangan kerja baru.</li><li>Meningkatkan standar hidup masyarakat.</li><li>Memberikan pemerintah sumber daya (pajak) untuk membangun infrastruktur.</li></ol><div>Kesimpulan</div><div>Memahami ekonomi membantu kita membuat keputusan yang lebih cerdas, baik dalam skala kecil (seperti menabung) maupun dalam memahami arah kebijakan sebuah negara. Di era globalisasi saat ini, ekonomi satu negara sangat bergantung pada negara lainnya, membuat pemahaman ekonomi dasar menjadi keterampilan yang sangat berharga.</div>'
        ]);
    }
}
