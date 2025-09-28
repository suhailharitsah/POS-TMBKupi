<?php

namespace App\View\Components\Pengeluaran;

use Illuminate\View\Component;
use App\Models\Pengeluaran;
use Carbon\Carbon;

class DataTableCard extends Component
{
    public $pengeluarans;
    public $totalBulanIni;
    public $periode;
    public $bulan;
    public $tahun;
    public $selectedDate; // baru

    public function __construct($pengeluarans)
    {
        $this->pengeluarans = $pengeluarans;

        // baca selected date (single) jika ada
        $this->selectedDate = request()->input('tanggal', null);

        if ($this->selectedDate) {
            // jika user memilih tanggal (single) gunakan tanggal itu untuk total
            try {
                $dt = Carbon::parse($this->selectedDate);
                $this->bulan = $dt->month;
                $this->tahun = $dt->year;
                // total untuk hari yang dipilih
                $this->totalBulanIni = Pengeluaran::whereDate('tanggal', $this->selectedDate)->sum('nominal');
            } catch (\Exception $e) {
                // fallback ke bulan sekarang kalau parsing gagal
                $this->bulan = request()->input('bulan', now()->month);
                $this->tahun = request()->input('tahun', now()->year);
                $this->totalBulanIni = Pengeluaran::whereMonth('tanggal', $this->bulan)->whereYear('tanggal', $this->tahun)->sum('nominal');
            }
        } else {
            // default: pakai bulan & tahun dari querystring atau sekarang
            $this->bulan = request()->input('bulan', now()->month);
            $this->tahun = request()->input('tahun', now()->year);
            $this->totalBulanIni = Pengeluaran::whereMonth('tanggal', $this->bulan)->whereYear('tanggal', $this->tahun)->sum('nominal');
        }

        // Data periode untuk dropdown (distinct bulan/tahun)
        $this->periode = Pengeluaran::selectRaw('MONTH(tanggal) as bulan, YEAR(tanggal) as tahun')->distinct()->orderBy('tahun', 'desc')->orderBy('bulan', 'desc')->get();
    }

    public function render()
    {
        return view('components.pengeluaran.data-table-card');
    }

    // optional helper
    public function formatPeriode($bulan, $tahun)
    {
        return Carbon::createFromDate($tahun, $bulan, 1)->translatedFormat('F Y');
    }
}
