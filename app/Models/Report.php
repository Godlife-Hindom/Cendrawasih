<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Report extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'sent_by',
        'title',
        'content',
        'approved',
        'status',
        'evaluation',
    ];

    protected $casts = [
        'approved' => 'boolean',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function sender()
    {
        return $this->belongsTo(User::class, 'sent_by');
    }

    public function alternatives()
    {
        return $this->belongsToMany(Alternative::class);
    }

    public function criteria()
    {
        return $this->belongsToMany(Criteria::class);
    }

    public function subcriteria()
    {
        return $this->belongsToMany(Subcriteria::class);
    }

    // SCOPE untuk mengambil hanya satu laporan per user (yang terbaru)
    public function scopeLatestPerUser($query)
    {
        return $query->select('reports.*')
                    ->join(DB::raw('(SELECT user_id, MAX(created_at) as max_created_at FROM reports GROUP BY user_id) as latest'), function($join) {
                        $join->on('reports.user_id', '=', 'latest.user_id')
                             ->on('reports.created_at', '=', 'latest.max_created_at');
                    });
    }

    // MODIFIKASI: Method untuk UPDATE atau CREATE laporan
    public static function updateOrCreateForUser($userId, $data)
    {
        $existingReport = self::where('user_id', $userId)->first();
        
        if ($existingReport) {
            // UPDATE laporan yang sudah ada
            $existingReport->update(array_merge($data, [
                'status' => 'pending',     // Reset status
                'approved' => null,        // Reset approval
                'evaluation' => null,      // Reset evaluation
            ]));
            
            return [
                'report' => $existingReport->fresh(),
                'action' => 'updated'
            ];
        } else {
            // CREATE laporan baru
            $newReport = self::create(array_merge($data, [
                'user_id' => $userId,
                'status' => 'pending'
            ]));
            
            return [
                'report' => $newReport,
                'action' => 'created'
            ];
        }
    }

    // Method untuk mendapatkan status badge HTML
    public function getStatusBadgeAttribute()
    {
        switch ($this->status) {
            case 'approved':
                return '<span class="badge bg-success bg-opacity-10 text-success border border-success px-3 py-2">
                            <i class="fas fa-check-circle me-1"></i>
                            Sudah Layak
                        </span>';
            case 'rejected':
                return '<span class="badge bg-danger bg-opacity-10 text-danger border border-danger px-3 py-2">
                            <i class="fas fa-times-circle me-1"></i>
                            Belum Layak
                        </span>';
            default:
                return '<span class="badge bg-warning bg-opacity-10 text-warning border border-warning px-3 py-2">
                            <i class="fas fa-clock me-1"></i>
                            Menunggu
                        </span>';
        }
    }

    // Method untuk mendapatkan laporan per user
    public static function getReportsPerUser()
    {
        return self::select('user_id', DB::raw('COUNT(*) as total_reports'))
                   ->groupBy('user_id')
                   ->with('user')
                   ->get();
    }

    // Method untuk mendapatkan laporan terbaru per user menggunakan Collection
    public static function getLatestPerUserCollection()
    {
        $allReports = self::with('user')->orderBy('created_at', 'desc')->get();
        
        return $allReports->groupBy('user_id')->map(function ($userReports) {
            return $userReports->first();
        })->values();
    }

    // Method untuk cek apakah user sudah punya laporan
    public static function userHasReport($userId)
    {
        return self::where('user_id', $userId)->exists();
    }

    // Method untuk mendapatkan laporan terakhir user
    public static function getUserLatestReport($userId)
    {
        return self::where('user_id', $userId)
                   ->latest()
                   ->first();
    }

    // TAMBAHAN: Method untuk mendapatkan laporan dengan format yang sudah siap untuk blade
    public static function getFormattedLatestPerUser()
    {
        $allReports = self::with('user')->orderBy('created_at', 'desc')->get();
        
        $laporan = $allReports->groupBy('user_id')->map(function ($userReports) {
            $report = $userReports->first();
            
            // Tambahkan informasi tambahan yang berguna untuk blade
            $report->formatted_date = $report->created_at->format('d M Y');
            $report->formatted_time = $report->created_at->format('H:i');
            $report->is_updated = $report->created_at != $report->updated_at;
            
            return $report;
        })->values();

        return $laporan;
    }

    // TAMBAHAN: Scope untuk filter berdasarkan status
    public function scopeByStatus($query, $status)
    {
        return $query->where('status', $status);
    }

    // TAMBAHAN: Method untuk mendapatkan statistik lengkap
    public static function getDetailedStats()
    {
        return [
            'total_reports' => self::count(),
            'unique_users' => self::distinct('user_id')->count(),
            'pending_reports' => self::where('status', 'pending')->count(),
            'approved_reports' => self::where('status', 'approved')->count(),
            'rejected_reports' => self::where('status', 'rejected')->count(),
            'reports_with_evaluation' => self::whereNotNull('evaluation')->count(),
            'reports_updated' => self::whereRaw('created_at != updated_at')->count(),
        ];
    }
}