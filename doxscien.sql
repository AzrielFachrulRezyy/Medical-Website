-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 12 Jul 2023 pada 03.38
-- Versi server: 10.4.27-MariaDB
-- Versi PHP: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `doxscien`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `dokter`
--

CREATE TABLE `dokter` (
  `id_dokter` int(11) NOT NULL,
  `nama_dokter` varchar(100) NOT NULL,
  `jadwal_praktek` varchar(100) NOT NULL,
  `foto_dokter` text NOT NULL,
  `id_spesialis` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `dokter`
--

INSERT INTO `dokter` (`id_dokter`, `nama_dokter`, `jadwal_praktek`, `foto_dokter`, `id_spesialis`) VALUES
(11, 'Dr. John Doe', 'Senin - Jumat, 08:00 - 16:00', '6485ab6fe93e0d3.jpg', 2),
(12, 'Dr. Jane Smith', 'Selasa - Sabtu, 09:00 - 17:00', '6485ab6688f43d2.jpg', 3),
(13, 'Dr. David Johnson', 'Senin - Kamis, 10:00 - 18:00', '6485ab5de9a69d1.jpg', 4),
(14, 'Dr. Lisa Brown', 'Rabu - Jumat, 09:00 - 17:00', '6485ab7d2ba2dt2.jpg', 5),
(15, 'Dr. Michael Lee', 'Kamis - Minggu, 08:00 - 16:00', '6485ab8a6c073t4.jpg', 6);

-- --------------------------------------------------------

--
-- Struktur dari tabel `konsultasi`
--

CREATE TABLE `konsultasi` (
  `id_konsultasi` int(11) NOT NULL,
  `gejala_pasien` text NOT NULL,
  `tanggal_daftar` datetime NOT NULL,
  `status_konsultasi` enum('BELUM DITANGGAPI','SUDAH DITANGGAPI','SUDAH DIKONFIRMASI','SELESAI','DIBATALKAN') NOT NULL,
  `id_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `obat`
--

CREATE TABLE `obat` (
  `id_obat` int(11) NOT NULL,
  `nama_obat` varchar(100) NOT NULL,
  `deskripsi_obat` text NOT NULL,
  `foto_obat` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `obat`
--

INSERT INTO `obat` (`id_obat`, `nama_obat`, `deskripsi_obat`, `foto_obat`) VALUES
(1, 'Paracetamol', '&lt;p&gt;Paracetamol adalah obat yang umum digunakan untuk meredakan nyeri ringan hingga sedang dan menurunkan demam. Obat ini juga dikenal dengan nama acetaminophen. Paracetamol bekerja dengan mengurangi produksi zat dalam tubuh yang menyebabkan rasa sakit dan demam.&lt;/p&gt;&lt;p&gt;Dosis yang direkomendasikan untuk Paracetamol biasanya tergantung pada usia dan kondisi kesehatan seseorang. Dalam penggunaan umum, berikut adalah beberapa pedoman dosis Paracetamol:&lt;/p&gt;&lt;ul&gt;&lt;li&gt;Untuk dewasa: Dosis umum dewasa adalah 500 mg hingga 1 gram, yang dapat diulang setiap 4 hingga 6 jam sesuai kebutuhan. Namun, penting untuk tidak melebihi dosis maksimal 4 gram dalam 24 jam.&lt;/li&gt;&lt;li&gt;Untuk anak-anak: Dosis Paracetamol pada anak-anak berdasarkan berat badan dan usia. Biasanya, dosis berkisar antara 10 hingga 15 mg per kilogram berat badan, dengan batas dosis maksimal 60 mg per kilogram berat badan dalam 24 jam. Disarankan untuk selalu berkonsultasi dengan dokter atau mengikuti petunjuk dosis yang tertera pada kemasan obat untuk anak-anak.&lt;/li&gt;&lt;li&gt;Untuk bayi: Paracetamol untuk bayi umumnya tersedia dalam bentuk sirup khusus dengan dosis yang lebih rendah. Dosis harus disesuaikan dengan berat badan bayi dan disarankan untuk selalu mengikuti petunjuk dosis yang diberikan oleh dokter atau yang tertera pada kemasan obat.&lt;/li&gt;&lt;/ul&gt;&lt;p&gt;Penting untuk membaca dan mengikuti instruksi yang tertera pada kemasan obat, dan jika Anda memiliki kekhawatiran atau pertanyaan, sebaiknya berkonsultasi dengan dokter atau apoteker terlebih dahulu sebelum menggunakan Paracetamol. Selalu perhatikan dosis yang tepat dan tidak melebihi dosis maksimal yang direkomendasikan.&lt;/p&gt;', '6485abce7a1ffparacetamoll.png'),
(2, 'Amoxicillin', '&lt;p&gt;Amoxicillin adalah sejenis antibiotik yang sering digunakan untuk mengobati berbagai infeksi bakteri. Obat ini termasuk dalam kelas antibiotik beta-laktam dan bekerja dengan cara menghambat pertumbuhan dan penyebaran bakteri yang menyebabkan infeksi.&lt;/p&gt;&lt;p&gt;Dosis Amoxicillin dapat bervariasi tergantung pada jenis infeksi, beratnya infeksi, usia pasien, serta kondisi kesehatan secara keseluruhan. Dalam pengobatan infeksi umum, dosis Amoxicillin yang umum diberikan adalah sebagai berikut:&lt;/p&gt;&lt;ol&gt;&lt;li&gt;Infeksi saluran pernapasan atas: 250 mg hingga 500 mg amoxicillin, 3 kali sehari, selama 7 hingga 10 hari.&lt;/li&gt;&lt;li&gt;Infeksi saluran pernapasan bawah, seperti pneumonia: 500 mg hingga 875 mg amoxicillin, 2 atau 3 kali sehari, selama 7 hingga 14 hari.&lt;/li&gt;&lt;li&gt;Infeksi saluran kemih: 250 mg hingga 500 mg amoxicillin, 3 kali sehari, selama 3 hingga 7 hari.&lt;/li&gt;&lt;li&gt;Infeksi kulit dan jaringan lunak: 250 mg hingga 500 mg amoxicillin, 3 kali sehari, selama 7 hingga 14 hari.&lt;/li&gt;&lt;li&gt;Infeksi gigi: 250 mg hingga 500 mg amoxicillin, 3 kali sehari, selama 5 hingga 7 hari.&lt;/li&gt;&lt;/ol&gt;&lt;p&gt;Penting untuk mengikuti dosis yang diresepkan oleh dokter Anda dan untuk melengkapi seluruh durasi pengobatan, bahkan jika gejalanya sudah membaik. Jangan menghentikan penggunaan Amoxicillin secara tiba-tiba tanpa berkonsultasi dengan dokter.&lt;/p&gt;&lt;p&gt;Namun, perlu dicatat bahwa dosis Amoxicillin dapat bervariasi tergantung pada kondisi pasien dan instruksi dokter yang merawat. Oleh karena itu, penting untuk selalu mengikuti petunjuk dan dosis yang direkomendasikan oleh dokter Anda untuk mendapatkan hasil yang optimal dan mencegah efek samping yang tidak diinginkan.&lt;/p&gt;', '6485ac0dd7012amoxcilin.jpg'),
(3, 'Loratadine', '&lt;p&gt;Loratadine adalah obat antihistamin yang digunakan untuk mengurangi gejala alergi, seperti pilek, bersin, gatal-gatal, dan mata berair. Obat ini bekerja dengan menghalangi efek histamin dalam tubuh.&lt;/p&gt;&lt;p&gt;Dosis loratadine yang umum untuk orang dewasa dan anak di atas 12 tahun adalah 10 mg sekali sehari. Untuk anak-anak antara usia 2-12 tahun, dosis yang direkomendasikan adalah 5 mg sekali sehari. Namun, selalu penting untuk mengikuti petunjuk dosis yang diberikan oleh dokter atau yang tertera pada kemasan obat.&lt;/p&gt;&lt;p&gt;Penting untuk diingat bahwa dosis loratadine dapat bervariasi tergantung pada kondisi kesehatan individu, respons tubuh terhadap obat, dan petunjuk dari dokter. Jika Anda memiliki kondisi medis tertentu, seperti gangguan hati atau ginjal, atau jika Anda sedang mengonsumsi obat-obatan lain, sebaiknya berkonsultasi dengan dokter sebelum mengonsumsi loratadine.&lt;/p&gt;&lt;p&gt;Selain itu, penting juga untuk membaca dan mengikuti instruksi yang tertera pada kemasan obat. Jika gejala alergi tidak membaik atau bahkan memburuk setelah mengonsumsi loratadine, segera hubungi dokter Anda.&lt;/p&gt;', '6485ac334918eLoratadine.jpg'),
(4, 'Omeprazole', '&lt;p&gt;Omeprazole adalah obat yang termasuk dalam kelas inhibitor pompa proton (PPI) yang digunakan untuk mengurangi produksi asam lambung dalam sistem pencernaan. Obat ini digunakan untuk mengobati kondisi seperti tukak lambung, penyakit refluks gastroesofageal (GERD), serta sindrom Zollinger-Ellison.&lt;/p&gt;&lt;p&gt;Dosis omeprazole yang direkomendasikan dapat bervariasi tergantung pada kondisi medis individu. Namun, dosis umum untuk pengobatan tukak lambung atau GERD pada orang dewasa adalah 20 mg omeprazole sekali sehari selama 4-8 minggu. Dalam beberapa kasus yang lebih parah, dosis dapat ditingkatkan menjadi 40 mg omeprazole sekali sehari.&lt;/p&gt;&lt;p&gt;Untuk pengobatan sindrom Zollinger-Ellison atau kondisi lain yang memerlukan pengurangan produksi asam lambung yang signifikan, dosis omeprazole bisa lebih tinggi dan disesuaikan secara individual berdasarkan respons pasien. Dokter Anda akan memberikan dosis yang tepat sesuai dengan kebutuhan Anda.&lt;/p&gt;&lt;p&gt;Penting untuk mengikuti petunjuk penggunaan yang diberikan oleh dokter atau apoteker Anda. Omeprazole umumnya diminum dengan segelas air setidaknya 30-60 menit sebelum makan pagi. Hindari menghancurkan atau mengunyah tablet omeprazole, tapi telanlah utuh.&lt;/p&gt;&lt;p&gt;Perlu dicatat bahwa dosis dan petunjuk penggunaan yang tepat dapat bervariasi tergantung pada kondisi medis individu, respons terhadap pengobatan, dan rekomendasi dari dokter Anda. Selalu konsultasikan dengan tenaga medis yang berkualifikasi sebelum mengonsumsi obat ini dan jangan mengubah dosis tanpa petunjuk dokter.&lt;/p&gt;', '6485ac5fe35ebOmeprazole.jpg'),
(5, 'Simvastatin', '&lt;p&gt;Simvastatin adalah obat yang termasuk dalam kelas statin, yang digunakan untuk mengurangi kadar kolesterol dalam darah. Obat ini digunakan sebagai bagian dari program pengobatan yang melibatkan perubahan gaya hidup, seperti diet rendah lemak dan olahraga rutin, untuk mengendalikan kadar kolesterol tinggi.&lt;/p&gt;&lt;p&gt;Dosis simvastatin biasanya disesuaikan dengan kebutuhan individual pasien dan berdasarkan rekomendasi dokter. Namun, berikut adalah dosis umum yang mungkin diberikan:&lt;/p&gt;&lt;ul&gt;&lt;li&gt;Dosis awal: Biasanya 10-20 mg sekali sehari pada saat tidur, tergantung pada tingkat keparahan kolesterol tinggi dan faktor risiko kardiovaskular.&lt;/li&gt;&lt;li&gt;Dosis pemeliharaan: Dalam kebanyakan kasus, dosis pemeliharaan berkisar antara 10-40 mg sekali sehari pada saat tidur.&lt;/li&gt;&lt;/ul&gt;&lt;p&gt;Penting untuk mengikuti dosis yang diresepkan oleh dokter Anda dan tidak mengubah dosis atau menghentikan penggunaan obat tanpa berkonsultasi terlebih dahulu. Simvastatin biasanya diminum dengan atau tanpa makanan, tetapi perlu dipastikan untuk mengikuti petunjuk yang diberikan oleh dokter atau pada informasi yang terlampir di kemasan obat.&lt;/p&gt;&lt;p&gt;Seperti semua obat, simvastatin juga memiliki efek samping yang mungkin terjadi, meskipun tidak semua orang mengalaminya. Efek samping yang umum termasuk sakit kepala, nyeri otot atau sendi, gangguan pencernaan, dan peningkatan kadar enzim hati. Jarang, tetapi efek samping yang serius dapat terjadi, seperti masalah hati, rabdomiolisis (kerusakan otot yang berpotensi mengancam nyawa), dan reaksi alergi. Jika Anda mengalami efek samping yang mengkhawatirkan atau tidak biasa, segera hubungi dokter Anda.&lt;/p&gt;&lt;p&gt;Penting juga untuk memberi tahu dokter Anda tentang semua obat atau suplemen lain yang sedang Anda konsumsi, karena simvastatin dapat berinteraksi dengan beberapa obat lain dan meningkatkan risiko efek samping.&lt;/p&gt;&lt;p&gt;Perlu diingat bahwa informasi ini hanya sebagai panduan umum. Selalu ikuti petunjuk dokter Anda dan baca dengan teliti informasi yang terlampir di kemasan obat. Jika Anda memiliki pertanyaan atau kekhawatiran lebih lanjut tentang penggunaan Simvastatin, segera hubungi dokter Anda atau profesional kesehatan terpercaya.&lt;/p&gt;', '6485ac88620ddSimvastatin.jpg');

-- --------------------------------------------------------

--
-- Struktur dari tabel `penyakit`
--

CREATE TABLE `penyakit` (
  `id_penyakit` int(11) NOT NULL,
  `nama_penyakit` varchar(100) NOT NULL,
  `deskripsi_penyakit` text NOT NULL,
  `id_obat` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `penyakit`
--

INSERT INTO `penyakit` (`id_penyakit`, `nama_penyakit`, `deskripsi_penyakit`, `id_obat`) VALUES
(1, 'Influenza', 'Infeksi virus pernapasan', 1),
(2, 'Infeksi Saluran Kemih', 'Infeksi pada saluran kemih', 2),
(3, 'Hipertensi', 'Tekanan darah tinggi', 5),
(4, 'Diabetes Mellitus', 'Gangguan metabolisme gula darah', 4),
(5, 'Asma', '&lt;p&gt;Asma adalah penyakit peradangan kronis pada saluran pernapasan yang ditandai dengan pembengkakan dan penyempitan bronkioli, yaitu cabang-cabang kecil pada saluran udara di paru-paru. Kondisi ini dapat menyebabkan kesulitan bernapas, napas mengi, batuk, dan rasa tertekan di dada.&lt;/p&gt;&lt;p&gt;Pada individu dengan asma, saluran pernapasan menjadi lebih sensitif terhadap rangsangan tertentu, seperti alergen (misalnya debu, serbuk sari, tungau), polusi udara, udara dingin, infeksi saluran pernapasan, dan faktor stres. Kontak dengan faktor pencetus tersebut dapat menyebabkan peradangan pada saluran pernapasan, yang menyebabkan penyempitan dan kesulitan aliran udara.&lt;/p&gt;&lt;p&gt;Gejala asma dapat bervariasi dari ringan hingga parah, dan sering kali muncul dalam serangan yang disebut eksaserbasi. Gejala yang umum meliputi:&lt;/p&gt;&lt;p&gt;1. Kesulitan bernapas: Nafas pendek, napas terengah-engah, atau rasa sesak di dada.&lt;/p&gt;&lt;p&gt;2. Napas mengi: Bunyi berdering saat bernapas, terutama saat mengeluarkan napas.&lt;/p&gt;&lt;p&gt;3. Batuk: Terutama pada malam hari atau dini hari, dapat menjadi batuk yang terus-menerus atau berulang.&lt;/p&gt;&lt;p&gt;4. Rasa tertekan di dada: Sensasi berat atau tekanan pada dada.&lt;/p&gt;&lt;p&gt;Pengelolaan asma bertujuan untuk mengontrol gejala, mencegah serangan, dan mempertahankan fungsi paru yang normal. Ini melibatkan pendekatan yang terpadu, termasuk:&lt;/p&gt;&lt;p&gt;1. Obat-obatan: Inhaler atau nebulizer digunakan untuk memberikan obat-obatan yang meredakan peradangan dan membuka saluran pernapasan, seperti bronkodilator (misalnya albuterol) dan kortikosteroid inhalasi.&lt;/p&gt;&lt;p&gt;2. Penghindaran pemicu: Mengenali dan menghindari faktor pencetus yang memicu gejala, seperti alergen atau polusi udara.&lt;/p&gt;&lt;p&gt;3. Rencana tindakan darurat: Mengetahui langkah-langkah untuk mengatasi serangan asma yang memburuk, termasuk penggunaan obat penenang (misalnya inhaler dengan bronkodilator cepat).&lt;/p&gt;&lt;p&gt;4. Pendidikan dan manajemen: Memahami kondisi asma, memantau gejala, dan menjaga komunikasi dengan dokter untuk pengaturan perawatan yang tepat.&lt;/p&gt;&lt;p&gt;Penting untuk mengkonsultasikan kondisi asma dengan dokter atau profesional kesehatan yang berpengalaman dalam perawatan asma. Dengan manajemen yang tepat, kebanyakan orang dengan asma dapat menjalani kehidupan yang aktif dan sehat.&lt;/p&gt;', 3);

-- --------------------------------------------------------

--
-- Struktur dari tabel `riwayat`
--

CREATE TABLE `riwayat` (
  `id_riwayat` int(11) NOT NULL,
  `isi_riwayat` text NOT NULL,
  `tanggal_riwayat` datetime NOT NULL,
  `id_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `riwayat`
--

INSERT INTO `riwayat` (`id_riwayat`, `isi_riwayat`, `tanggal_riwayat`, `id_user`) VALUES
(1, 'User Berhasil login!', '2023-06-08 15:46:14', 1),
(2, 'Spesialis Kandungan Berhasil ditambahkan!', '2023-06-08 15:46:44', 1),
(3, 'User Berhasil logout!', '2023-06-08 16:00:14', 1),
(4, 'User Berhasil login!', '2023-06-08 16:01:15', 1),
(5, 'User Berhasil login!', '2023-06-08 19:27:55', 1),
(6, 'User Berhasil login!', '2023-06-09 16:07:34', 1),
(7, 'User Berhasil login!', '2023-06-11 17:57:27', 1),
(8, 'Konsultasi Azriel Berhasil dihapus!', '2023-06-11 18:05:57', 1),
(9, 'Dokter Dr. David Johnson Berhasil diubah!', '2023-06-11 18:09:17', 1),
(10, 'Dokter Dr. Jane Smith Berhasil diubah!', '2023-06-11 18:09:26', 1),
(11, 'Dokter Dr. John Doe Berhasil diubah!', '2023-06-11 18:09:35', 1),
(12, 'Dokter Dr. Lisa Brown Berhasil diubah!', '2023-06-11 18:09:49', 1),
(13, 'Dokter Dr. Michael Lee Berhasil diubah!', '2023-06-11 18:10:02', 1),
(14, 'Obat Paracetamol Berhasil diubah!', '2023-06-11 18:11:10', 1),
(15, 'Obat Amoxicillin Berhasil diubah!', '2023-06-11 18:12:13', 1),
(16, 'Obat Loratadine Berhasil diubah!', '2023-06-11 18:12:51', 1),
(17, 'Obat Omeprazole Berhasil diubah!', '2023-06-11 18:13:35', 1),
(18, 'Obat Simvastatin Berhasil diubah!', '2023-06-11 18:14:16', 1),
(19, 'Obat Amoxicillin Berhasil diubah!', '2023-06-11 18:15:29', 1),
(20, 'Obat Loratadine Berhasil diubah!', '2023-06-11 18:16:53', 1),
(21, 'Obat Amoxicillin Berhasil diubah!', '2023-06-11 18:17:04', 1),
(22, 'Obat Omeprazole Berhasil diubah!', '2023-06-11 18:18:38', 1),
(23, 'Obat Paracetamol Berhasil diubah!', '2023-06-11 18:21:31', 1),
(24, 'Obat Simvastatin Berhasil diubah!', '2023-06-11 18:23:54', 1),
(25, 'Obat Amoxicillin Berhasil diubah!', '2023-06-11 18:27:03', 1),
(26, 'Penyakit Asma Berhasil diubah!', '2023-06-11 18:30:21', 1),
(27, 'User Berhasil login!', '2023-06-11 21:01:47', 1),
(28, 'User Berhasil logout!', '2023-06-11 21:06:16', 1),
(29, 'User Berhasil login!', '2023-06-11 21:06:58', 1),
(30, 'Tanggapan Azriel Berhasil ditambahkan!', '2023-06-11 21:07:16', 1),
(31, 'User Berhasil logout!', '2023-06-11 21:08:26', 1),
(32, 'User Berhasil login!', '2023-07-11 07:09:17', 1),
(33, 'User Berhasil logout!', '2023-07-11 07:09:52', 1),
(34, 'User Berhasil login!', '2023-07-11 07:37:07', 5),
(35, 'Konsultasi Andri Firman Saputra Berhasil ditambahkan!', '2023-07-11 08:17:43', 5),
(36, 'User Berhasil logout!', '2023-07-11 08:20:10', 5),
(37, 'User Berhasil login!', '2023-07-11 08:26:18', 5),
(38, 'User Berhasil logout!', '2023-07-11 10:00:03', 7),
(39, 'User Berhasil login!', '2023-07-11 10:00:09', 5),
(40, 'User Berhasil logout!', '2023-07-11 10:20:46', 5),
(41, 'User Berhasil login!', '2023-07-11 10:21:00', 5),
(42, 'User Berhasil login!', '2023-07-11 16:25:59', 5),
(43, 'User Berhasil login!', '2023-07-11 16:36:05', 5),
(44, 'User Berhasil login!', '2023-07-12 06:55:26', 5),
(45, 'User Berhasil logout!', '2023-07-12 07:05:48', 5),
(46, 'User Berhasil login!', '2023-07-12 07:06:10', 1),
(47, 'User Berhasil logout!', '2023-07-12 07:07:45', 1),
(48, 'User Berhasil login!', '2023-07-12 07:07:52', 5),
(49, 'Konsultasi Andri Firman Saputra telah dibatalkan!', '2023-07-12 07:23:19', 5),
(50, 'Konsultasi Andri Firman Saputra Berhasil ditambahkan!', '2023-07-12 07:27:59', 5),
(51, 'User Berhasil logout!', '2023-07-12 07:31:19', 5),
(52, 'User Berhasil login!', '2023-07-12 07:31:26', 1),
(53, 'User Berhasil logout!', '2023-07-12 07:32:09', 1),
(54, 'User Berhasil login!', '2023-07-12 07:32:19', 5),
(55, 'Konsultasi Andri Firman Saputra Berhasil ditambahkan!', '2023-07-12 08:00:53', 5),
(56, 'Konsultasi Andri Firman Saputra Berhasil ditambahkan!', '2023-07-12 08:00:58', 5),
(57, 'Konsultasi Andri Firman Saputra Berhasil ditambahkan!', '2023-07-12 08:02:36', 5),
(58, 'Konsultasi Andri Firman Saputra Berhasil diubah!', '2023-07-12 08:02:40', 5),
(59, 'Konsultasi Andri Firman Saputra telah dibatalkan oleh pengguna!', '2023-07-12 08:02:46', 5),
(60, 'Konsultasi Andri Firman Saputra Berhasil ditambahkan!', '2023-07-12 08:04:42', 5),
(61, 'User Berhasil logout!', '2023-07-12 08:04:45', 5),
(62, 'User Berhasil login!', '2023-07-12 08:04:52', 1),
(63, 'User Berhasil logout!', '2023-07-12 08:14:11', 1),
(64, 'User Berhasil login!', '2023-07-12 08:14:17', 1),
(65, 'Tanggapan Andri Firman Saputra Berhasil ditambahkan!', '2023-07-12 08:34:20', 1),
(66, 'Konsultasi  sudah dikonfirmasi!', '2023-07-12 08:34:32', 1),
(67, 'Konsultasi  Selesai!', '2023-07-12 08:34:55', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `spesialis`
--

CREATE TABLE `spesialis` (
  `id_spesialis` int(11) NOT NULL,
  `spesialis` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `spesialis`
--

INSERT INTO `spesialis` (`id_spesialis`, `spesialis`) VALUES
(2, 'Dokter Umum'),
(3, 'Dokter Gigi'),
(4, 'Dokter Spesialis Mata'),
(5, 'Dokter Spesialis Kulit'),
(6, 'Dokter Spesialis Bedah');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tanggapan`
--

CREATE TABLE `tanggapan` (
  `id_tanggapan` int(11) NOT NULL,
  `id_konsultasi` int(11) NOT NULL,
  `id_dokter` int(11) NOT NULL,
  `tanggal_konsultasi` datetime NOT NULL,
  `keterangan` text DEFAULT NULL,
  `id_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `nama_lengkap` varchar(100) NOT NULL,
  `jenis_kelamin` enum('L','P') NOT NULL,
  `no_whatsapp` varchar(20) NOT NULL,
  `alamat` text NOT NULL,
  `role` enum('administrator','operator','pasien') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id_user`, `username`, `password`, `nama_lengkap`, `jenis_kelamin`, `no_whatsapp`, `alamat`, `role`) VALUES
(1, 'admin', '$2y$10$uhFanjJHWe6AYEkdDGbsie91JzMScS0IkCExvR5E4d3Eqcyk97N2K', 'Admin', 'L', '08123456789', 'Admin', 'administrator');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `dokter`
--
ALTER TABLE `dokter`
  ADD PRIMARY KEY (`id_dokter`),
  ADD KEY `id_spesialis` (`id_spesialis`);

--
-- Indeks untuk tabel `konsultasi`
--
ALTER TABLE `konsultasi`
  ADD PRIMARY KEY (`id_konsultasi`),
  ADD KEY `id_user` (`id_user`);

--
-- Indeks untuk tabel `obat`
--
ALTER TABLE `obat`
  ADD PRIMARY KEY (`id_obat`);

--
-- Indeks untuk tabel `penyakit`
--
ALTER TABLE `penyakit`
  ADD PRIMARY KEY (`id_penyakit`),
  ADD KEY `id_obat` (`id_obat`);

--
-- Indeks untuk tabel `riwayat`
--
ALTER TABLE `riwayat`
  ADD PRIMARY KEY (`id_riwayat`),
  ADD KEY `id_user` (`id_user`);

--
-- Indeks untuk tabel `spesialis`
--
ALTER TABLE `spesialis`
  ADD PRIMARY KEY (`id_spesialis`);

--
-- Indeks untuk tabel `tanggapan`
--
ALTER TABLE `tanggapan`
  ADD PRIMARY KEY (`id_tanggapan`),
  ADD KEY `id_dokter` (`id_dokter`),
  ADD KEY `id_konsultasi` (`id_konsultasi`),
  ADD KEY `id_user` (`id_user`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `dokter`
--
ALTER TABLE `dokter`
  MODIFY `id_dokter` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT untuk tabel `konsultasi`
--
ALTER TABLE `konsultasi`
  MODIFY `id_konsultasi` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `obat`
--
ALTER TABLE `obat`
  MODIFY `id_obat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `penyakit`
--
ALTER TABLE `penyakit`
  MODIFY `id_penyakit` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `riwayat`
--
ALTER TABLE `riwayat`
  MODIFY `id_riwayat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;

--
-- AUTO_INCREMENT untuk tabel `spesialis`
--
ALTER TABLE `spesialis`
  MODIFY `id_spesialis` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `tanggapan`
--
ALTER TABLE `tanggapan`
  MODIFY `id_tanggapan` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `dokter`
--
ALTER TABLE `dokter`
  ADD CONSTRAINT `dokter_ibfk_1` FOREIGN KEY (`id_spesialis`) REFERENCES `spesialis` (`id_spesialis`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `konsultasi`
--
ALTER TABLE `konsultasi`
  ADD CONSTRAINT `konsultasi_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `penyakit`
--
ALTER TABLE `penyakit`
  ADD CONSTRAINT `penyakit_ibfk_1` FOREIGN KEY (`id_obat`) REFERENCES `obat` (`id_obat`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `tanggapan`
--
ALTER TABLE `tanggapan`
  ADD CONSTRAINT `tanggapan_ibfk_1` FOREIGN KEY (`id_dokter`) REFERENCES `dokter` (`id_dokter`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tanggapan_ibfk_2` FOREIGN KEY (`id_konsultasi`) REFERENCES `konsultasi` (`id_konsultasi`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tanggapan_ibfk_3` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
