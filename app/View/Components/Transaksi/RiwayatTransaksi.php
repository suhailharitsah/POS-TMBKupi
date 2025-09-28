<?php

namespace App\View\Components\Transaksi;

use Illuminate\View\Component;
use Illuminate\View\View;
use Illuminate\Database\Eloquent\Collection;

class RiwayatTransaksi extends Component
{
  /**
   * The collection of transactions.
   *
   * @var Collection
   */
  public $transaksis;

  /**
   * Create a new component instance.
   *
   * @param  Collection|array  $transaksis
   * @return void
   */
  public function __construct($transaksis)
  {
    $this->transaksis = $transaksis;
  }

  /**
   * Get the view / contents that represent the component.
   */
  public function render(): View
  {
    return view('components.transaksi.riwayat-transaksi');
  }
}
