<x-app-layout>
  <div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
      <div class="bg-gray-50 dark:bg-gray-800 overflow-hidden rounded-lg">
        <div class="p-8 text-gray-900 dark:text-gray-200">
          <section>
            <header class="max-w-xl">
              <h2 class="text-gray-800 text-lg font-semibold dark:text-gray-200">
                {{ __('List of deleted Asset Categories') }}
              </h2>
              <p class="text-sm text-gray-700 dark:text-gray-300">
                {{ __('This list lists all the asset categorie are deleted in the system.') }}
              </p>
            </header>
            <div class="flex justify-between items-center mt-7">
              <div>
                <a class="border border-gray-500/40 text-gray-700 dark:text-gray-200 hover:text-sky-600 dark:hover:text-sky-50 bg-gray-50 dark:bg-gray-600 focus:ring-2 ring-offset-2 ring-offset-gray-200 dark:ring-offset-gray-900 focus:ring-sky-500 rounded text-sm font-semibold px-5 py-2.5 mr-2 mb-2 focus:outline-none dark:focus:ring-gray-500 focus:transition focus:ease-in focus:duration-75" href="{{ route('assetcategorie.index') }}">
                  {{ __('Back to All Active Asset Categorie') }}
                </a>
              </div>
              <form class="w-4/12" action="{{ route('assetcategorie.trash') }}" method="GET">   
                <label for="default-search" class="mb-2 text-sm text-gray-900 sr-only dark:text-white">Search</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                        <svg class="w-5 h-5 text-sky-700 dark:text-gray-200" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                        </svg>
                    </div>
                    <input name="search" type="search" value="{{ request()->input('search') }}" autofocus autocomplete="search" id="default-search" class="block w-full px-5 py-2.5 pl-10 text-sm text-gray-900 border border-gray-500/40 rounded bg-gray-50 focus:ring-gray-700 focus:border-gray-700 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 placeholder:italic dark:text-white dark:focus:ring-gray-400 dark:focus:border-gray-400" placeholder="Search data...">
                    <button type="submit" class="text-gray-700 dark:text-gray-200 hover:text-sky-50 font-semibold bg-gray-200 hover:bg-sky-600 absolute right-2.5 bottom-2 focus:ring-4 focus:outline-none focus:ring-sky-300 rounded text-sm px-2.5 py-1 dark:bg-gray-600 dark:hover:bg-sky-700 dark:focus:ring-sky-800">Search</button>
                </div>
              </form>
            </div>
            <div>
              
              @if (session()->has('message'))
              <div id="toast-success" class="z-20 fixed bottom-5 right-5 flex items-center w-full max-w-xs p-4 mb-4 text-gray-500 bg-white rounded-lg shadow dark:text-gray-400 dark:bg-gray-800" role="alert">
                <div class="inline-flex items-center justify-center flex-shrink-0 w-8 h-8 text-sky-500 bg-sky-100 rounded-lg dark:bg-sky-800 dark:text-sky-200">
                  <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z"/>
                  </svg>
                  <span class="sr-only">Check icon</span>
                </div>
                <div class="ml-3 text-sm font-normal">{!! session()->get('message') !!}</div>
                <button type="button" class="ml-auto -mx-1.5 -my-1.5 bg-white text-gray-400 hover:text-gray-900 rounded-lg focus:ring-2 focus:ring-gray-300 p-1.5 hover:bg-gray-100 inline-flex items-center justify-center h-8 w-8 dark:text-gray-500 dark:hover:text-white dark:bg-gray-800 dark:hover:bg-gray-700" data-dismiss-target="#toast-success" aria-label="Close">
                  <span class="sr-only">Close</span>
                  <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                  </svg>
                </button>
              </div>
              @endif
            </div>
            <div class="relative overflow-x-auto rounded mt-5">
              <table class="border border-gray-500/30 dark:border-gray-600 w-full text-sm text-left bg-gray-100 text-gray-700 dark:text-gray-400">
                <thead class="text-sm border-b border-gray-500/30 dark:bg-gray-700 dark:text-gray-400">
                  <tr>
                    <th scope="col" class="px-6 py-3">
                      {{ __('#') }}
                    </th>
                    <th scope="col" class="px-6 py-3">
                      <a href="{{ route('assetcategorie.trash', ['sort' => ($sort === 'name' ? '-name' : 'name'), 'page' => $asset_categories->currentPage()]) }}">
                        {{ __('Name') }} {!! ($sort === 'name' ? '<span class="text-sky-600 ml-1">&#9650;</span>' : '<span class="text-sky-600 ml-1">&#9660;</span>') !!}
                      </a>
                    </th>
                    <th scope="col" class="px-6 py-3">
                      {{ __('Description') }}
                    </th>
                    <th scope="col" class="px-6 py-3">
                      <a href="{{ route('assetcategorie.trash', ['order' => ($order === 'oldest' ? 'latest' : 'oldest'), 'page' => $asset_categories->currentPage()]) }}">
                        {{ __('Created at') }} {!! ($order === 'oldest' ? '<span class="text-sky-600 ml-1">&#9650;</span>' : '<span class="text-sky-600 ml-1">&#9660;</span>') !!}
                      </a>
                    </th>
                    <th scope="col" class="px-6 py-3">
                      {{ __('Modified at') }}
                    </th>
                    @canany(['asset categorie edit', 'asset categorie delete'])
                    <th scope="col" class="px-6 py-3">
                      {{ __('Action') }}
                    </th>
                    @endcanany
                  </tr>
                </thead>
                <tbody>
                  @foreach ($asset_categories as $asset_categorie)
                  <tr class="bg-gray-100 border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-200/70 dark:hover:bg-gray-800/60">
                    <td class="px-6 py-3 text-gray-900 whitespace-nowrap dark:text-white">
                      {{ $startNumber++ }}
                    </td>
                    <td class="px-6 py-3">
                      {{ $asset_categorie->name }}
                    </td>
                    <td class="px-6 py-3">
                      {{ $asset_categorie->description }}
                    </td>
                    <td class="px-6 py-3">
                      {{ Carbon\Carbon::parse($asset_categorie->created_at)->format('l, d F Y, H:i A') }}
                    </td>
                    <td class="px-6 py-3">
                      {{ Carbon\Carbon::parse($asset_categorie->deleted_at)->format('l, d F Y, H:i A') }}
                    </td>
                    <td class="flex items-center px-6 py-3 space-x-3">
                      @canany(['asset categorie create'])
                      <button class="text-sm border border-gray-500/40 dark:border-gray-500 dark:hover:border-gray-400 hover:border-gray-400 px-1 py-0.5 rounded-lg" data-modal-toggle="popup-modal-restore{{ $asset_categorie->id }}" data-modal-target="popup-modal-restore{{ $asset_categorie->id }}">
                        {{ __('Restore') }}
                      </button>
                      @endcanany
                      @canany(['asset categorie delete'])
                      <button class="text-sm border border-gray-500/40 dark:border-gray-500 dark:hover:border-gray-400 hover:border-gray-400 px-1 py-0.5 rounded-lg" data-modal-toggle="popup-modal-destroy{{ $asset_categorie->id }}" data-modal-target="popup-modal-destroy{{ $asset_categorie->id }}">
                        {{ __('Delete') }}
                      </button>
                      @endcanany
                    </td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
              <div class="mt-4">
                {{ $asset_categories->links('.layouts.paginationcustom') }}
              </div>
            </div>            
          </section>
        </div>
      </div>
    </div>
  </div>
  {{-- Modal --}}
  @foreach ($asset_categories as $asset_categorie)
  <div id="popup-modal-restore{{ $asset_categorie->id }}" tabindex="-1" class="fixed top-0 left-0 right-0 z-50 hidden p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full box-border">
    <div class="relative w-full max-w-xl max-h-full">
      <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
        <div>
          <div class="p-8">
            <h1 class="text-gray-800 dark:text-gray-300 text-md font-semibold mb-2">Restore this <span class="font-bold underline text-gray-950 dark:text-gray-200">{{ $asset_categorie->name }}</span>?</h1>
            <p class="text-sm text-gray-800 dark:text-gray-300">Performing this action will restore the data. Are you certain you wish to proceed with restoring the data associated with the specified name?</p>
          </div>
          <div>
            <div class="bg-gray-100 dark:bg-gray-700 border-t dark:border-t-gray-600 rounded-b-md">
              <div class="py-3 inline-flex w-full mt-3 gap-4 px-8">
                <div class="basis-1/2">
                  <a href="{{ route('assetcategorie.restore', $asset_categorie->id) }}" class="w-full border border-gray-500/40 text-gray-700 dark:text-gray-200 hover:text-green-600 dark:hover:text-green-50 bg-gray-50 dark:bg-gray-600 focus:ring-2 ring-offset-2 ring-offset-gray-200 dark:ring-offset-gray-900 focus:ring-green-500 rounded text-sm font-semibold px-5 py-2 mb-2 inline-flex items-center justify-center focus:outline-none dark:focus:ring-gray-500 focus:transition focus:ease-in focus:duration-75">
                    Yes, restore
                  </a>
                </div>
                <div class="basis-1/2">
                  <button data-modal-hide="popup-modal-restore{{ $asset_categorie->id }}" type="button" class="w-full border border-gray-500/40 text-gray-700 dark:text-gray-200 hover:text-sky-600 dark:hover:text-sky-50 bg-gray-50 dark:bg-gray-600 focus:ring-2 ring-offset-2 ring-offset-gray-200 dark:ring-offset-gray-900 focus:ring-sky-500 rounded text-sm font-semibold px-5 py-2 mb-2 inline-flex items-center justify-center focus:outline-none dark:focus:ring-gray-500 focus:transition focus:ease-in focus:duration-75">No, cancel</button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div id="popup-modal-destroy{{ $asset_categorie->id }}" tabindex="-1" class="fixed top-0 left-0 right-0 z-50 hidden p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative w-full max-w-xl max-h-full">
      <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
        <div>
          <div class="p-8">
            <h1 class="text-gray-800 dark:text-gray-300 text-md font-semibold mb-2">Delete this <span class="font-bold underline text-gray-950 dark:text-gray-200">{{ $asset_categorie->name }}</span>?</h1>
            <p class="text-sm text-gray-800 dark:text-gray-300">Performing this action will delete the data. Are you certain you wish to proceed with deleting the data associated with the specified name? Once the data is deleted, it cannot be recovered.</p>
          </div>
          <div class="text-center">
            <div class="bg-gray-100 dark:bg-gray-700 border-t dark:border-t-gray-600 rounded-b-md">
              <div class="py-3 inline-flex w-full mt-3 gap-4 px-8">
                <div class="basis-1/2">
                  <form method="POST" action="{{ route('assetcategorie.destroy-permanently', $asset_categorie->id) }}">
                    @csrf
                    @method('DELETE')
                    <button class="w-full border border-gray-500/40 text-gray-700 dark:text-gray-200 hover:text-red-600 dark:hover:text-red-50 bg-gray-50 dark:bg-gray-600 focus:ring-2 ring-offset-2 ring-offset-gray-200 dark:ring-offset-gray-900 focus:ring-red-500 rounded text-sm font-semibold px-5 py-2 mb-2 focus:outline-none dark:focus:ring-gray-500 focus:transition focus:ease-in focus:duration-75">
                      Yes, delete
                    </button>
                  </form>     
                </div>
                <div class="basis-1/2">
                  <button data-modal-hide="popup-modal-destroy{{ $asset_categorie->id }}" type="button" class="w-full border border-gray-500/40 text-gray-700 dark:text-gray-200 hover:text-sky-600 dark:hover:text-sky-50 bg-gray-50 dark:bg-gray-600 focus:ring-2 ring-offset-2 ring-offset-gray-200 dark:ring-offset-gray-900 focus:ring-sky-500 rounded text-sm font-semibold px-5 py-2 mb-2 focus:outline-none dark:focus:ring-gray-500 focus:transition focus:ease-in focus:duration-75">No, cancel</button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  @endforeach
  {{-- endModal --}}
  
  @push('scripts')

  @endpush
</x-app-layout>