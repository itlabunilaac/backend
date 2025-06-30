
CREATE TABLE `admins` (
  `id` bigint UNSIGNED NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `admins`
--

INSERT INTO `admins` (`id`, `username`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'imam', 'imamariadi775@gmail.com', NULL, '$2y$12$nwcSNXWyonMv7sJWIM.YwulgRYcVZX0tkdDUdwzaLIATqqDiMnE/m', NULL, '2025-06-29 23:25:53', '2025-06-30 01:38:20');

-- --------------------------------------------------------

--
-- Struktur dari tabel `admin_tokens`
--

CREATE TABLE `admin_tokens` (
  `id` bigint UNSIGNED NOT NULL,
  `admin_id` bigint UNSIGNED NOT NULL,
  `token` varchar(80) NOT NULL,
  `name` varchar(255) NOT NULL DEFAULT 'API Token',
  `expires_at` timestamp NOT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `cache`
--

INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('laravel_cache_admin_token_ca434f53ff7bfe766f37e38f6ceb90ff5127faabcb8909f0523aa5f95d93304513ffd67dcc243e46', 'a:4:{s:8:\"admin_id\";i:1;s:4:\"name\";s:11:\"admin-token\";s:10:\"expires_at\";s:19:\"2025-07-01 07:01:09\";s:12:\"last_used_at\";s:19:\"2025-06-30 07:01:09\";}', 1751353269),
('laravel_cache_admin_token_fa168b44a04ca9afa5b1d7e8da887477ac1b580c7aa1ec7da1c0ffe8b840f888ef26912d85e0e69f', 'a:4:{s:8:\"admin_id\";i:1;s:4:\"name\";s:11:\"admin-token\";s:10:\"expires_at\";O:25:\"Illuminate\\Support\\Carbon\":3:{s:4:\"date\";s:26:\"2025-07-01 06:53:37.144541\";s:13:\"timezone_type\";i:3;s:8:\"timezone\";s:3:\"UTC\";}s:12:\"last_used_at\";O:25:\"Illuminate\\Support\\Carbon\":3:{s:4:\"date\";s:26:\"2025-06-30 06:53:37.144627\";s:13:\"timezone_type\";i:3;s:8:\"timezone\";s:3:\"UTC\";}}', 1751352817);

-- --------------------------------------------------------

--
-- Struktur dari tabel `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint UNSIGNED NOT NULL,
  `reserved_at` int UNSIGNED DEFAULT NULL,
  `available_at` int UNSIGNED NOT NULL,
  `created_at` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `jurnals`
--

CREATE TABLE `jurnals` (
  `id` bigint UNSIGNED NOT NULL,
  `foto` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deskripsi` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `akreditasi` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `link_akreditasi` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `subject` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `penerbit` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `link_penerbit` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `judul` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `views` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `jurnals`
--

INSERT INTO `jurnals` (`id`, `foto`, `deskripsi`, `akreditasi`, `link_akreditasi`, `subject`, `penerbit`, `link_penerbit`, `judul`, `views`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'journals/1751272749_logo ejurnal.jpg', 'asdsada', 'Sinta 1', 'https://sinta.com', 'Teknik Informatika', 'imam', 'https://publisher.com', 'membaca puisi', 2, '2025-06-30 01:39:09', '2025-06-30 01:52:42', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2024_12_30_000001_create_admins_table', 1),
(5, '2024_12_30_000002_create_jurnals_table', 1),
(6, '2024_12_30_000003_add_soft_deletes_to_jurnals_table', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('0Cx3oIlHSIw1Dgtd5TkwMgCRttLvZ948TtFl9BeN', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Code/1.101.2 Chrome/134.0.6998.205 Electron/35.5.1 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoieHNHS3NUWmNEcThtcWliVm5BVnRVeFpnd2VjdkRjclplbmEwVU93MiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6OTk6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9kZW1vP2lkPTdhYWI2NTY4LTcxMTctNDc3My04MDFkLWU3MzA1ZWI4YmZkMiZ2c2NvZGVCcm93c2VyUmVxSWQ9MTc1MTI3MzEzNTg3NiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1751273136),
('7npLlK1kordYi9BbB3eWTWfQU26HUXYBxPzvJzzH', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Code/1.101.2 Chrome/134.0.6998.205 Electron/35.5.1 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiNkVHZlpDR29EQnBLakwwWElXTndqU2dodDMwQ0ZFRjJFSE42ckxwRSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6OTk6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9kZW1vP2lkPTdhYWI2NTY4LTcxMTctNDc3My04MDFkLWU3MzA1ZWI4YmZkMiZ2c2NvZGVCcm93c2VyUmVxSWQ9MTc1MTI2NjgxOTc2MyI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1751266821),
('cMwL6CdQd1IYk7sfh9J1RgYj8uJYetXbKHSj6i1l', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Code/1.101.2 Chrome/134.0.6998.205 Electron/35.5.1 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiMHJuU1FqakNmSXloSlpaNFJaNVpEYzdCNVI3OVNVTUphS0xicHV4MiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6OTk6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9kZW1vP2lkPTdhYWI2NTY4LTcxMTctNDc3My04MDFkLWU3MzA1ZWI4YmZkMiZ2c2NvZGVCcm93c2VyUmVxSWQ9MTc1MTI2NjU3ODg1NiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1751266580),
('dVr4F0fcPJvwXjbT3WaWR2ItNxpj3f7GnRpKPpBF', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Code/1.101.2 Chrome/134.0.6998.205 Electron/35.5.1 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiYVRTbHJPbHN6b3NMVGdUOFNBdHRXSTFvU0phMFUwUENhZFdXTlRIRSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6OTk6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9kZW1vP2lkPTdhYWI2NTY4LTcxMTctNDc3My04MDFkLWU3MzA1ZWI4YmZkMiZ2c2NvZGVCcm93c2VyUmVxSWQ9MTc1MTI3MjMzMTEwNSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1751272333),
('gFUV0WOhmqvCNMnC75P8sa61MgLo6PRqnriM7UTz', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiMTZmdXpLaVFvVUt1VGs1SlpGdVo0cVRNTGIydHJRb0QwdGc3S1NHSCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjY6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9kZW1vIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1751273545),
('gOXZ8aTwTyzDuogI7KS7EHdA00B7ZAtglurp3NPf', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Code/1.101.2 Chrome/134.0.6998.205 Electron/35.5.1 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiMWFNSGMyZEFZa3NOak1RRzE1eHhrcXdxSWQ4b2dORnVxQnZlZTJnWCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6OTk6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9kZW1vP2lkPTkyNzBhNmZmLTU1ZmQtNDlkYi1hMmM1LTUxOTA0ZjIxYmQxMyZ2c2NvZGVCcm93c2VyUmVxSWQ9MTc1MTI2NTA2MDQyMyI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1751265063),
('NZe5koHePrSGwzvYN9hA4gV4vk5KNl84SUnFtPvn', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Code/1.101.2 Chrome/134.0.6998.205 Electron/35.5.1 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiaVZOeU9PV00yT3QyR2pMaGNrNUUyUlk5T0Y1OEZWcm9pbFBlM2xzTSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6OTk6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9kZW1vP2lkPTdhYWI2NTY4LTcxMTctNDc3My04MDFkLWU3MzA1ZWI4YmZkMiZ2c2NvZGVCcm93c2VyUmVxSWQ9MTc1MTI3MjAyNzE2MyI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1751272028),
('o5ZrhmoxkTMFLL4c4RlEg2wvewRddfssUH2w5fFg', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Code/1.101.2 Chrome/134.0.6998.205 Electron/35.5.1 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiSVNiQ1JITHFMSFlmRmFBUXEzUnJ4ZUV5cWI2MU5vWXk5VGdyeTNFUyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6OTk6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9kZW1vP2lkPTkyNzBhNmZmLTU1ZmQtNDlkYi1hMmM1LTUxOTA0ZjIxYmQxMyZ2c2NvZGVCcm93c2VyUmVxSWQ9MTc1MTI2NTIxMjIwNSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1751265213),
('p0kLrn0F42FtIBtpqCuYk4gYXv37y7fxKPTSSo5o', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Code/1.101.2 Chrome/134.0.6998.205 Electron/35.5.1 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiMWp6akk2clJLS2VuQ2pBSWNNcWk1a01ZU2MxbUcxU2dUWXFDeE1SdiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6OTk6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9kZW1vP2lkPTdhYWI2NTY4LTcxMTctNDc3My04MDFkLWU3MzA1ZWI4YmZkMiZ2c2NvZGVCcm93c2VyUmVxSWQ9MTc1MTI2NTkzMDgzNSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1751265932),
('PrqXWc4O1XiDYBrlFVhrQtpPHvvhhprFCjlBzrrF', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Code/1.101.2 Chrome/134.0.6998.205 Electron/35.5.1 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiS1F6ekpGbkNHb0M2dzRjaWFsZGF5WllmdU9xMmhFaTV1bDdUdGFkaiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6OTk6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9kZW1vP2lkPTdhYWI2NTY4LTcxMTctNDc3My04MDFkLWU3MzA1ZWI4YmZkMiZ2c2NvZGVCcm93c2VyUmVxSWQ9MTc1MTI3MzQwMDkwMiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1751273402),
('rhWuz40JjC2R2ourqzL6rS1GAElj1QAPnSRPbJje', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Code/1.101.2 Chrome/134.0.6998.205 Electron/35.5.1 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiN3QwRGx2RTEwaVA3Z0JzcXJoa2Rsb3BHQ2hYcGtEeldWb21mamh5ZyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6OTk6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9kZW1vP2lkPTdhYWI2NTY4LTcxMTctNDc3My04MDFkLWU3MzA1ZWI4YmZkMiZ2c2NvZGVCcm93c2VyUmVxSWQ9MTc1MTI3MTk1NTI3NyI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1751271957),
('ST2z0xl7gL0nSHQwuefePUzJBaCp0nMS1ne8tNgE', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Code/1.101.2 Chrome/134.0.6998.205 Electron/35.5.1 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiZWZENXFPQnlURjYzYms0UUVjN0xiT3VUTGt4RWpTdXdqV1pBbUxyNSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6OTk6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9kZW1vP2lkPTkyNzBhNmZmLTU1ZmQtNDlkYi1hMmM1LTUxOTA0ZjIxYmQxMyZ2c2NvZGVCcm93c2VyUmVxSWQ9MTc1MTI2NTMyMTA4NSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1751265321),
('ZdD0W7DnYMnuUQwKI0M79lh1AKW4ssEEralWpx5G', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Code/1.101.2 Chrome/134.0.6998.205 Electron/35.5.1 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiVDBCeFJiU3VpUjIyeXgwNEJHVmRXTGNMeEE3ZFVzb1VWR291bVl3eCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6OTk6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9kZW1vP2lkPTdhYWI2NTY4LTcxMTctNDc3My04MDFkLWU3MzA1ZWI4YmZkMiZ2c2NvZGVCcm93c2VyUmVxSWQ9MTc1MTI3MjYxMTQ3OCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1751272613);

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Test User', 'test@example.com', '2025-06-29 22:35:56', '$2y$12$rx.4pwpoPfhs9QzzJzLwCuD4X/O302q45floRMWoUP60xyMdgsp7.', 'oiRsProOR1', '2025-06-29 22:35:57', '2025-06-29 22:35:57');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `admins_username_unique` (`username`),
  ADD UNIQUE KEY `admins_email_unique` (`email`);

--
-- Indeks untuk tabel `admin_tokens`
--
ALTER TABLE `admin_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `token` (`token`),
  ADD KEY `admin_id` (`admin_id`);

--
-- Indeks untuk tabel `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indeks untuk tabel `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indeks untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indeks untuk tabel `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indeks untuk tabel `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `jurnals`
--
ALTER TABLE `jurnals`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indeks untuk tabel `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `admins`
--
ALTER TABLE `admins`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `admin_tokens`
--
ALTER TABLE `admin_tokens`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `jurnals`
--
ALTER TABLE `jurnals`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `admin_tokens`
--
ALTER TABLE `admin_tokens`
  ADD CONSTRAINT `admin_tokens_ibfk_1` FOREIGN KEY (`admin_id`) REFERENCES `admins` (`id`) ON DELETE CASCADE;
COMMIT;

