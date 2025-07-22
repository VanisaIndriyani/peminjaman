<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Mobil;
use App\Models\User;
use App\Models\Peminjaman;
use App\Models\Pesan;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $jumlahMobil = Mobil::count();
        $jumlahPengguna = User::where('role', 'user')->count();
        $jumlahPeminjaman = Peminjaman::count();
        $jumlahPesan = class_exists(Pesan::class) ? Pesan::count() : 0;

        // Statistik peminjaman per bulan (data asli)
        $statistik = Peminjaman::selectRaw('MONTH(tanggal_pinjam) as bulan, COUNT(*) as total')
            ->groupBy('bulan')
            ->orderBy('bulan')
            ->pluck('total', 'bulan')
            ->toArray();
        $dataStatistik = [];
        for ($i = 1; $i <= 12; $i++) {
            $dataStatistik[] = $statistik[$i] ?? 0;
        }

        // Statistik peminjaman per minggu (12 minggu terakhir)
        $weeklyData = $this->getWeeklyData();

        // Aktivitas terbaru
        $recentPeminjaman = \App\Models\Peminjaman::with('user', 'mobil')
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();
        $recentPengembalian = \App\Models\Pengembalian::with('peminjaman.user', 'peminjaman.mobil')
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();
        $recentPengguna = User::where('role', 'user')->orderBy('created_at', 'desc')->limit(5)->get();
        $recentPesan = class_exists(Pesan::class) ? Pesan::orderBy('created_at', 'desc')->limit(5)->get() : collect();

        return view('admin.dashboard', compact(
            'jumlahMobil', 'jumlahPengguna', 'jumlahPeminjaman', 'jumlahPesan', 'dataStatistik', 'weeklyData',
            'recentPeminjaman', 'recentPengembalian', 'recentPengguna', 'recentPesan'
        ));
    }

    /**
     * Get weekly statistics data
     */
    private function getWeeklyData()
    {
        $weeklyData = [];
        
        // Get data for last 12 weeks
        for ($i = 11; $i >= 0; $i--) {
            $startOfWeek = Carbon::now()->subWeeks($i)->startOfWeek();
            $endOfWeek = Carbon::now()->subWeeks($i)->endOfWeek();
            
            $count = Peminjaman::whereBetween('tanggal_pinjam', [$startOfWeek, $endOfWeek])
                ->count();
            
            $weeklyData[] = $count;
        }
        
        return $weeklyData;
    }

    /**
     * API endpoint untuk mengambil data statistik real-time
     */
    public function getStatistics(Request $request)
    {
        $period = $request->get('period', 'month');
        
        if ($period === 'month') {
            // Data bulanan
            $statistik = Peminjaman::selectRaw('MONTH(tanggal_pinjam) as bulan, COUNT(*) as total')
                ->groupBy('bulan')
                ->orderBy('bulan')
                ->pluck('total', 'bulan')
                ->toArray();
            
            $data = [];
            for ($i = 1; $i <= 12; $i++) {
                $data[] = $statistik[$i] ?? 0;
            }
            
            $labels = ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'];
            
        } else {
            // Data mingguan
            $data = $this->getWeeklyData();
            $labels = [];
            
            for ($i = 11; $i >= 0; $i--) {
                $weekStart = Carbon::now()->subWeeks($i)->startOfWeek();
                $labels[] = 'Minggu ' . $weekStart->format('d/m');
            }
        }
        
        return response()->json([
            'success' => true,
            'data' => $data,
            'labels' => $labels,
            'period' => $period
        ]);
    }

    /**
     * Get dashboard summary statistics
     */
    public function getDashboardStats()
    {
        // Total statistics
        $totalMobil = Mobil::count();
        $totalPengguna = User::where('role', 'user')->count();
        $totalPeminjaman = Peminjaman::count();
        $totalPesan = class_exists(Pesan::class) ? Pesan::count() : 0;

        // Monthly growth (compare with last month)
        $currentMonth = Carbon::now()->month;
        $lastMonth = Carbon::now()->subMonth()->month;
        
        $currentMonthPeminjaman = Peminjaman::whereRaw('MONTH(tanggal_pinjam) = ?', [$currentMonth])->count();
        $lastMonthPeminjaman = Peminjaman::whereRaw('MONTH(tanggal_pinjam) = ?', [$lastMonth])->count();
        
        $peminjamanGrowth = $lastMonthPeminjaman > 0 ? 
            round((($currentMonthPeminjaman - $lastMonthPeminjaman) / $lastMonthPeminjaman) * 100, 1) : 0;

        // Recent activities
        $recentPeminjaman = Peminjaman::with('user', 'mobil')
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();

        $recentPengguna = User::where('role', 'user')
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();

        return response()->json([
            'success' => true,
            'stats' => [
                'totalMobil' => $totalMobil,
                'totalPengguna' => $totalPengguna,
                'totalPeminjaman' => $totalPeminjaman,
                'totalPesan' => $totalPesan,
                'peminjamanGrowth' => $peminjamanGrowth
            ],
            'recentPeminjaman' => $recentPeminjaman,
            'recentPengguna' => $recentPengguna
        ]);
    }

    /**
     * Get real-time chart data with filters
     */
    public function getChartData(Request $request)
    {
        $period = $request->get('period', 'month');
        $year = $request->get('year', Carbon::now()->year);
        
        if ($period === 'month') {
            // Data bulanan untuk tahun tertentu
            $data = DB::table('peminjamans')
                ->selectRaw('MONTH(tanggal_pinjam) as bulan, COUNT(*) as total')
                ->whereRaw('YEAR(tanggal_pinjam) = ?', [$year])
                ->groupBy('bulan')
                ->orderBy('bulan')
                ->pluck('total', 'bulan')
                ->toArray();
            
            $chartData = [];
            for ($i = 1; $i <= 12; $i++) {
                $chartData[] = $data[$i] ?? 0;
            }
            
            $labels = ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'];
            
        } else {
            // Data mingguan untuk 12 minggu terakhir
            $chartData = $this->getWeeklyData();
            $labels = [];
            
            for ($i = 11; $i >= 0; $i--) {
                $weekStart = Carbon::now()->subWeeks($i)->startOfWeek();
                $labels[] = 'Minggu ' . $weekStart->format('d/m');
            }
        }
        
        return response()->json([
            'success' => true,
            'data' => $chartData,
            'labels' => $labels,
            'period' => $period,
            'year' => $year
        ]);
    }
} 