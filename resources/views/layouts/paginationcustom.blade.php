@if ($paginator->hasPages())
<nav class="flex justify-end items-center -space-x-px h-10 text-base">
  @if ($paginator->onFirstPage())
  <a class="pointer-events-none flex items-center justify-center px-4 h-10 ml-0 leading-tight text-gray-500 bg-white border border-gray-300 rounded-l-lg hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white" href="#">
    <span aria-hidden="true">«</span>
    <span class="sr-only">Previous</span>
  </a>
  @else
  <a class="flex items-center justify-center px-4 h-10 ml-0 leading-tight text-gray-500 bg-white border border-gray-300 rounded-l-lg hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white" href="{{ $paginator->previousPageUrl() }}{{ request()->has('sort') ? '&sort=' . request()->input('sort') : '' }}{{ request()->has('order') ? '&order=' . request()->input('order') : '' }}">
    <span aria-hidden="true">«</span>
    <span class="sr-only">Previous</span>
  </a>
  @endif
  @foreach ($elements as $element)
    @if (is_string($element))
    <a class="w-10 h-10 bg-blue-500 text-white p-4 inline-flex items-center text-sm font-medium rounded-lg" href="#" aria-current="page">{{ $element }}</a>
    @endif
    @if (is_array($element))
      @foreach ($element as $page => $url)
        @if ($page == $paginator->currentPage())
        <a class="z-10 flex items-center justify-center px-4 h-10 leading-tight text-blue-600 border border-blue-300 bg-blue-50 hover:bg-blue-100 hover:text-blue-700 dark:border-gray-700 dark:bg-gray-700 dark:text-white" href="#" aria-current="page">{{ $page }}</a>
        @else
        <a class="flex items-center justify-center px-4 h-10 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white" href="{{ $url }}{{ request()->has('sort') ? '&sort=' . request()->input('sort') : '' }}{{ request()->has('order') ? '&order=' . request()->input('order') : '' }}">{{ $page }}</a>
        @endif
      @endforeach
    @endif
  @endforeach
  @if ($paginator->hasMorePages())
  <a class="flex items-center justify-center px-4 h-10 leading-tight text-gray-500 bg-white border border-gray-300 rounded-r-lg hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white" href="{{ $paginator->nextPageUrl() }}{{ request()->has('sort') ? '&sort=' . request()->input('sort') : '' }}{{ request()->has('order') ? '&order=' . request()->input('order') : '' }}">
    <span class="sr-only">Next</span>
    <span aria-hidden="true">»</span>
  </a>
  @else
  <a class="pointer-events-none flex items-center justify-center px-4 h-10 leading-tight text-gray-500 bg-white border border-gray-300 rounded-r-lg hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white" href="#">
    <span class="sr-only">Next</span>
    <span aria-hidden="true">»</span>
  </a>
  @endif
</nav>
@endif
