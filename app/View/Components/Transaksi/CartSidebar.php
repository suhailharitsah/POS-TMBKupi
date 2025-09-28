<?php

namespace App\View\Components\Transaksi;

use Illuminate\View\Component;
use Illuminate\View\View;

class CartSidebar extends Component
{
  /**
   * Create a new component instance.
   */
  public function __construct()
  {
    // Komponen ini tidak memerlukan data dari server,
    // karena semua interaksi data ditangani oleh Alpine.js.
  }

  /**
   * Get the view / contents that represent the component.
   */
  public function render(): View
  {
    return view('components.transaksi.cart-sidebar');
  }
}
