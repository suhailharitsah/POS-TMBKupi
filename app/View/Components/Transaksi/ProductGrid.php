<?php

namespace App\View\Components\Transaksi;

use Illuminate\View\Component;
use Illuminate\View\View;
use Illuminate\Database\Eloquent\Collection;

class ProductGrid extends Component
{
  /**
   * The collection of all products.
   *
   * @var Collection
   */
  public $produks;

  /**
   * The collection of food products.
   *
   * @var Collection
   */
  public $makanan;

  /**
   * The collection of beverage products.
   *
   * @var Collection
   */
  public $minuman;

  /**
   * Create a new component instance.
   */
  public function __construct($produks)
  {
    $this->produks = $produks;
    $this->makanan = $produks->where('kategori', 'Makanan');
    $this->minuman = $produks->where('kategori', 'Minuman');
  }

  /**
   * Get the view / contents that represent the component.
   */
  public function render(): View
  {
    return view('components.transaksi.product-grid');
  }
}
