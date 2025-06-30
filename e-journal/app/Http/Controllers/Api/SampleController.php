<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Jurnal;
use Illuminate\Http\Request;

class SampleController extends Controller
{
    /**
     * Generate sample journals with different view counts for demo
     */
    public function generateSampleData()
    {
        try {
            // Clear existing data
            Jurnal::truncate();

            $sampleJournals = [
                [
                    'judul' => 'Machine Learning for Healthcare Diagnosis',
                    'deskripsi' => 'Comprehensive study on implementing machine learning algorithms for early disease detection and medical diagnosis.',
                    'akreditasi' => 'Sinta 1',
                    'link_akreditasi' => 'https://sinta.ristekbrin.go.id',
                    'subject' => 'Teknologi Informasi',
                    'penerbit' => 'International Journal of Medical AI',
                    'link_penerbit' => 'https://example.com/medical-ai',
                    'penulis' => 'Dr. Ahmad Santoso',
                    'views' => 2500,
                ],
                [
                    'judul' => 'Sustainable Energy Solutions for Smart Cities',
                    'deskripsi' => 'Research on renewable energy integration in urban environments for sustainable city development.',
                    'akreditasi' => 'Scopus',
                    'link_akreditasi' => 'https://scopus.com',
                    'subject' => 'Lingkungan',
                    'penerbit' => 'Green Technology Journal',
                    'link_penerbit' => 'https://example.com/green-tech',
                    'penulis' => 'Prof. Siti Rahayu',
                    'views' => 1800,
                ],
                [
                    'judul' => 'Economic Impact of Digital Transformation',
                    'deskripsi' => 'Analysis of how digital technologies are reshaping economic structures and business models.',
                    'akreditasi' => 'Sinta 2',
                    'link_akreditasi' => 'https://sinta.ristekbrin.go.id',
                    'subject' => 'Ekonomi',
                    'penerbit' => 'Digital Economy Review',
                    'link_penerbit' => 'https://example.com/digital-economy',
                    'penulis' => 'Dr. Budi Prasetyo',
                    'views' => 1500,
                ],
                [
                    'judul' => 'Advanced Manufacturing Processes in Industry 4.0',
                    'deskripsi' => 'Study on implementation of smart manufacturing technologies in modern industrial processes.',
                    'akreditasi' => 'Sinta 1',
                    'link_akreditasi' => 'https://sinta.ristekbrin.go.id',
                    'subject' => 'Teknik Industri',
                    'penerbit' => 'Manufacturing Technology Today',
                    'link_penerbit' => 'https://example.com/manufacturing',
                    'penulis' => 'Ir. Dewi Lestari',
                    'views' => 1200,
                ],
                [
                    'judul' => 'Blockchain Technology in Financial Services',
                    'deskripsi' => 'Comprehensive analysis of blockchain implementation in banking and financial institutions.',
                    'akreditasi' => 'Scopus',
                    'link_akreditasi' => 'https://scopus.com',
                    'subject' => 'Teknologi Informasi',
                    'penerbit' => 'FinTech Innovation Journal',
                    'link_penerbit' => 'https://example.com/fintech',
                    'penulis' => 'Dr. Andi Wijaya',
                    'views' => 1000,
                ],
                [
                    'judul' => 'Water Quality Assessment Using IoT Sensors',
                    'deskripsi' => 'Real-time water quality monitoring system using Internet of Things sensors and data analytics.',
                    'akreditasi' => 'Sinta 2',
                    'link_akreditasi' => 'https://sinta.ristekbrin.go.id',
                    'subject' => 'Lingkungan',
                    'penerbit' => 'Environmental Monitoring Journal',
                    'link_penerbit' => 'https://example.com/env-monitoring',
                    'penulis' => 'Dr. Maya Sari',
                    'views' => 800,
                ],
                [
                    'judul' => 'Microfinance and Rural Economic Development',
                    'deskripsi' => 'Impact assessment of microfinance institutions on rural community economic empowerment.',
                    'akreditasi' => 'Sinta 3',
                    'link_akreditasi' => 'https://sinta.ristekbrin.go.id',
                    'subject' => 'Ekonomi',
                    'penerbit' => 'Rural Development Quarterly',
                    'link_penerbit' => 'https://example.com/rural-dev',
                    'penulis' => 'Prof. Joko Susilo',
                    'views' => 600,
                ],
                [
                    'judul' => 'Lean Manufacturing Implementation Case Study',
                    'deskripsi' => 'Practical implementation of lean manufacturing principles in small and medium enterprises.',
                    'akreditasi' => 'Sinta 2',
                    'link_akreditasi' => 'https://sinta.ristekbrin.go.id',
                    'subject' => 'Teknik Industri',
                    'penerbit' => 'Industrial Engineering Today',
                    'link_penerbit' => 'https://example.com/industrial-eng',
                    'penulis' => 'Dr. Rini Handayani',
                    'views' => 450,
                ],
                [
                    'judul' => 'Artificial Intelligence in Education Technology',
                    'deskripsi' => 'Exploring the potential of AI-powered educational tools and personalized learning systems.',
                    'akreditasi' => 'Sinta 1',
                    'link_akreditasi' => 'https://sinta.ristekbrin.go.id',
                    'subject' => 'Teknologi Informasi',
                    'penerbit' => 'Educational Technology Review',
                    'link_penerbit' => 'https://example.com/edtech',
                    'penulis' => 'Dr. Fajar Nugroho',
                    'views' => 300,
                ],
                [
                    'judul' => 'Climate Change Adaptation Strategies',
                    'deskripsi' => 'Regional strategies for climate change adaptation and environmental resilience building.',
                    'akreditasi' => 'Scopus',
                    'link_akreditasi' => 'https://scopus.com',
                    'subject' => 'Lingkungan',
                    'penerbit' => 'Climate Research International',
                    'link_penerbit' => 'https://example.com/climate',
                    'penulis' => 'Prof. Retno Wulandari',
                    'views' => 200,
                ],
                [
                    'judul' => 'Digital Marketing Strategies for SMEs',
                    'deskripsi' => 'Effective digital marketing approaches for small and medium enterprises in the digital age.',
                    'akreditasi' => 'Sinta 3',
                    'link_akreditasi' => 'https://sinta.ristekbrin.go.id',
                    'subject' => 'Ekonomi',
                    'penerbit' => 'Small Business Marketing Journal',
                    'link_penerbit' => 'https://example.com/sme-marketing',
                    'penulis' => 'Dr. Eko Prasetyo',
                    'views' => 150,
                ],
                [
                    'judul' => 'Quality Control in Manufacturing Using Six Sigma',
                    'deskripsi' => 'Implementation of Six Sigma methodology for quality improvement in manufacturing processes.',
                    'akreditasi' => 'Sinta 2',
                    'link_akreditasi' => 'https://sinta.ristekbrin.go.id',
                    'subject' => 'Teknik Industri',
                    'penerbit' => 'Quality Management Review',
                    'link_penerbit' => 'https://example.com/quality-mgmt',
                    'penulis' => 'Ir. Bambang Utomo',
                    'views' => 100,
                ],
            ];

            foreach ($sampleJournals as $journal) {
                Jurnal::create($journal);
            }

            return response()->json([
                'success' => true,
                'message' => 'Sample data generated successfully',
                'data' => [
                    'total_journals' => count($sampleJournals),
                    'subjects' => ['Teknologi Informasi', 'Lingkungan', 'Ekonomi', 'Teknik Industri'],
                    'akreditasi' => ['Sinta 1', 'Sinta 2', 'Sinta 3', 'Scopus'],
                    'view_range' => '100 - 2500 views'
                ]
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to generate sample data',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Get statistics about current data
     */
    public function getStats()
    {
        try {
            $totalJournals = Jurnal::count();
            $totalViews = Jurnal::sum('views');
            $avgViews = $totalJournals > 0 ? round($totalViews / $totalJournals, 2) : 0;
            
            $topJournal = Jurnal::orderBy('views', 'desc')->first();
            $subjects = Jurnal::distinct('subject')->pluck('subject');
            $akreditasi = Jurnal::distinct('akreditasi')->pluck('akreditasi');

            return response()->json([
                'success' => true,
                'message' => 'Statistics retrieved successfully',
                'data' => [
                    'total_journals' => $totalJournals,
                    'total_views' => $totalViews,
                    'average_views' => $avgViews,
                    'top_journal' => $topJournal ? [
                        'id' => $topJournal->id,
                        'judul' => $topJournal->judul,
                        'views' => $topJournal->views
                    ] : null,
                    'subjects' => $subjects,
                    'akreditasi' => $akreditasi,
                ]
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to get statistics',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
