@if ($paginator->hasPages())
<nav class="flex justify-center items-center -space-x-px h-10 text-base">
  @if ($paginator->onFirstPage())
  <a class="pointer-events-none border border-gray-500/30 flex items-center justify-center px-4 h-10 ml-0 leading-tight text-gray-700 bg-gray-50 rounded-l hover:text-gray-900 dark:bg-gray-800 dark:dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white" href="#">
    <span aria-hidden="true">
      <svg class="w-3 h-3 text-gray-700 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 12 10">
        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 1 1 5l4 4m6-8L7 5l4 4"/>
      </svg>
    </span>
    <span class="sr-only">Previous</span>
  </a>
  @else
  <a class="flex border border-gray-500/30 items-center justify-center px-4 h-10 ml-0 leading-tight text-gray-700 bg-gray-50 rounded-l hover:text-gray-900 dark:bg-gray-800 dark:dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white" href="{{ $paginator->previousPageUrl() }}{{ request()->has('sort') ? '&sort=' . request()->input('sort') : '' }}{{ request()->has('order') ? '&order=' . request()->input('order') : '' }}">
    <span aria-hidden="true"><svg class="w-3 h-3 text-gray-700 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 12 10">
      <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 1 1 5l4 4m6-8L7 5l4 4"/>
    </svg></span>
    <span class="sr-only">Previous</span>
  </a>
  @endif
  @foreach ($elements as $element)
    @if (is_string($element))
    <a class="w-10 h-10 border border-gray-500/30 bg-blue-500 text-white p-4 inline-flex items-center text-sm font-medium rounded-lg" href="#" aria-current="page">{{ $element }}</a>
    @endif
    @if (is_array($element))
      @foreach ($element as $page => $url)
        @if ($page == $paginator->currentPage())
        <a class="border border-gray-500/30  border-b-4 border-b-sky-700 z-10 flex items-center justify-center px-4 h-10 leading-tight text-gray-900 font-bold bg-gray-100 hover:bg-gray-50 dark:dark:bg-gray-700 dark:text-white" href="#" aria-current="page">{{ $page }}</a>
        @else
        <a class="border border-gray-500/30 flex items-center justify-center px-4 h-10 leading-tight text-gray-700 bg-gray-50 hover:text-gray-900 dark:bg-gray-800 dark:dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white" href="{{ $url }}{{ request()->has('sort') ? '&sort=' . request()->input('sort') : '' }}{{ request()->has('order') ? '&order=' . request()->input('order') : '' }}">{{ $page }}</a>
        @endif
      @endforeach
    @endif
  @endforeach
  @if ($paginator->hasMorePages())
  <a class="flex border border-gray-500/30 items-center justify-center px-4 h-10 leading-tight text-gray-700 bg-gray-50 rounded-r hover:text-gray-900 dark:bg-gray-800 dark:dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white" href="{{ $paginator->nextPageUrl() }}{{ request()->has('sort') ? '&sort=' . request()->input('sort') : '' }}{{ request()->has('order') ? '&order=' . request()->input('order') : '' }}">
    <span class="sr-only">Next</span>
    <span aria-hidden="true">
      <svg class="w-3 h-3 text-gray-700 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 12 10">
        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m7 9 4-4-4-4M1 9l4-4-4-4"/>
      </svg>
    </span>
  </a>
  @else
  <a class="border border-gray-500/30 pointer-events-none flex items-center justify-center px-4 h-10 leading-tight text-gray-700 bg-gray-50 rounded-r hover:text-gray-900 dark:bg-gray-800 dark:dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white" href="#">
    <span class="sr-only">Next</span>
    <span aria-hidden="true">
      <svg class="w-3 h-3 text-gray-700 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 12 10">
        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m7 9 4-4-4-4M1 9l4-4-4-4"/>
      </svg>
    </span>
  </a>
  @endif
</nav>
@endif
