@if ($paginator->hasPages())
  <nav class="flex justify-center mt-6">
    <ul class="inline-flex -space-x-px text-sm">
      {{-- Tombol Previous --}}
      @if ($paginator->onFirstPage())
        <li>
          <span
            class="px-3 py-2 ml-0 leading-tight text-gray-400 bg-white border border-gray-300 rounded-l-lg cursor-not-allowed">
            &laquo;
          </span>
        </li>
      @else
        <li>
          <a href="{{ $paginator->previousPageUrl() }}" rel="prev"
            class="px-3 py-2 ml-0 leading-tight text-gray-500 bg-white border border-gray-300 rounded-l-lg hover:bg-gray-100 hover:text-gray-700">
            &laquo;
          </a>
        </li>
      @endif

      {{-- Nomor Halaman --}}
      @foreach ($elements as $element)
        @if (is_string($element))
          <li>
            <span
              class="px-3 py-2 leading-tight text-gray-500 bg-white border border-gray-300">{{ $element }}</span>
          </li>
        @endif

        @if (is_array($element))
          @foreach ($element as $page => $url)
            @if ($page == $paginator->currentPage())
              <li>
                <span
                  class="px-3 py-2 leading-tight text-white bg-blue-600 border border-blue-600 hover:bg-blue-700 hover:text-white">
                  {{ $page }}
                </span>
              </li>
            @else
              <li>
                <a href="{{ $url }}"
                  class="px-3 py-2 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700">
                  {{ $page }}
                </a>
              </li>
            @endif
          @endforeach
        @endif
      @endforeach

      {{-- Tombol Next --}}
      @if ($paginator->hasMorePages())
        <li>
          <a href="{{ $paginator->nextPageUrl() }}" rel="next"
            class="px-3 py-2 leading-tight text-gray-500 bg-white border border-gray-300 rounded-r-lg hover:bg-gray-100 hover:text-gray-700">
            &raquo;
          </a>
        </li>
      @else
        <li>
          <span
            class="px-3 py-2 leading-tight text-gray-400 bg-white border border-gray-300 rounded-r-lg cursor-not-allowed">
            &raquo;
          </span>
        </li>
      @endif
    </ul>
  </nav>
@endif
