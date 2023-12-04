<x-app-layout>
  <div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
      <div class="bg-gray-200 dark:bg-gray-800 overflow-hidden rounded-lg">
        <div class="p-8 text-gray-900 dark:text-gray-200">
          <section>
            <header class="max-w-xl">
              <h2 class="text-gray-800 text-lg font-semibold dark:text-gray-200">
                {{ __('List of Permissions') }}
              </h2>
              <p class="mt-2 text-sm text-gray-700 dark:text-gray-300">
                {{ __('This list lists all the permissions available in the system.') }}
              </p>
            </header>
            {{-- <hr class="h-px my-8 bg-gray-200 border-0 dark:bg-gray-700"> --}}
            <div class="flex justify-between items-center mt-7">
              <div>
                @can('permission create')
                <a class="border border-gray-500/40 text-gray-700 dark:text-gray-200 hover:text-sky-600 dark:hover:text-sky-50 bg-gray-50 dark:bg-gray-600 focus:ring-2 ring-offset-2 ring-offset-gray-200 dark:ring-offset-gray-900 focus:ring-sky-500 rounded text-sm font-semibold px-5 py-2.5 mr-2 mb-2 focus:outline-none dark:focus:ring-gray-500 focus:transition focus:ease-in focus:duration-75" href="{{ route('permission.create') }}">
                  {{ __('Add a New Permission') }}
                </a>
                <a class="border border-gray-500/40 text-gray-700 dark:text-gray-200 hover:text-sky-600 dark:hover:text-sky-50 bg-gray-50 dark:bg-gray-600 focus:ring-2 ring-offset-2 ring-offset-gray-200 dark:ring-offset-gray-900 focus:ring-sky-500 rounded text-sm font-semibold px-5 py-2.5 mr-2 mb-2 focus:outline-none dark:focus:ring-gray-500 focus:transition focus:ease-in focus:duration-75" href="{{ route('permission.trash') }}">
                  {{ __('Archived Data') }}
                </a>
                @endcan
                
              </div>
              <form class="w-4/12" action="{{ route('permission.index') }}" method="GET">   
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
                    <th scope="col" class="px-6 py-3 whitespace-nowrap">
                      {{ __('#') }}
                    </th>
                    <th scope="col" class="px-6 py-3 whitespace-nowrap">
                      <a href="{{ route('permission.index', ['sort' => ($sort === 'name' ? '-name' : 'name'), 'page' => $permissions->currentPage()]) }}">
                        {{ __('Permission Name') }} {!! ($sort === 'name' ? '<span class="text-sky-600 ml-1">&#9650;</span>' : '<span class="text-sky-600 ml-1">&#9660;</span>') !!}
                      </a>
                    </th>
                    <th scope="col" class="px-6 py-3 whitespace-nowrap">
                      <a href="{{ route('permission.index', ['order' => ($order === 'oldest' ? 'latest' : 'oldest'), 'page' => $permissions->currentPage()]) }}">
                        {{ __('Created at') }} {!! ($order === 'oldest' ? '<span class="text-sky-600 ml-1">&#9650;</span>' : '<span class="text-sky-600 ml-1">&#9660;</span>') !!}
                      </a>
                    </th>
                    <th scope="col" class="px-6 py-3 whitespace-nowrap">
                      {{ __('Modified at') }}
                    </th>
                    @canany(['permission edit', 'permission delete'])
                    <th scope="col" class="px-6 py-3 whitespace-nowrap">
                      {{ __('Action') }}
                    </th>
                    @endcanany
                  </tr>
                </thead>
                <tbody>
                  @foreach ($permissions as $permission)
                  <tr class="border-b border-gray-500/30 dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-200/70 dark:hover:bg-gray-800/60">
                    <td scope="row" class="px-6 py-3 whitespace-nowrap">
                      {{ $startNumber++ }}
                    </td>
                    <td scope="row" class="px-6 py-3 whitespace-nowrap">
                      {{ $permission->name }}
                    </td>
                    <td class="px-6 py-3 whitespace-nowrap">
                      {{ Carbon\Carbon::parse($permission->created_at)->format('l, d F Y, H:i A') }}
                    </td>
                    <td class="px-6 py-3 whitespace-nowrap">
                      {{ Carbon\Carbon::parse($permission->updated_at)->format('l, d F Y, H:i A') }}
                    </td>
                    <td class="flex items-center px-6 py-3 whitespace-nowrap space-x-3">
                      @canany(['permission edit', 'permission delete'])
                      <a href="{{ route('permission.edit', $permission->id) }}" class="text-sm border border-gray-500/40 dark:border-gray-500 dark:hover:border-gray-400 hover:border-gray-400 px-1 py-0.5 rounded-lg">
                        {{ __('Edit') }}
                      </a>
                      <button class="text-sm border border-gray-500/40 dark:border-gray-500 dark:hover:border-gray-400 hover:border-gray-400 px-1 py-0.5 rounded-lg" data-modal-toggle="popup-modal{{ $permission->id }}" data-modal-target="popup-modal{{ $permission->id }}">
                        {{ __('Delete') }}
                      </button>
                      @endcanany
                    </td>
                    {{-- <td class="flex items-center px-6 py-3 whitespace-nowrap space-x-3">
                      @canany(['permission edit', 'permission delete'])
                      <a href="{{ route('permission.edit', $permission->id) }}" class="uppercase text-sky-700 font-semibold hover:underline decoration-2 underline-offset-2">
                        {{ __('Edit') }}
                      </a>
                      <button class="uppercase text-sky-700 font-semibold hover:underline decoration-2 underline-offset-2" data-modal-toggle="popup-modal{{ $permission->id }}" data-modal-target="popup-modal{{ $permission->id }}">
                        {{ __('Delete') }}
                      </button>
                      @endcanany
                    </td> --}}
                  </tr>
                  @endforeach
                </tbody>
              </table>              
            </div>
            <div class="mt-4">
              {{ $permissions->links('.layouts.paginationcustom') }}
            </div>        
          </section>
        </div>
      </div>
    </div>
  </div>
  {{-- Modal --}}
  @foreach ($permissions as $permission)
  <div id="popup-modal{{ $permission->id }}" tabindex="-1" class="fixed top-0 left-0 right-0 z-50 hidden p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative w-full max-w-md max-h-full">
      <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
        <button type="button" class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ml-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="popup-modal{{ $permission->id }}">
          <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
          </svg>
          <span class="sr-only">Close modal</span>
        </button>
        <div class="p-6 text-center">
          <svg class="mx-auto mb-4 text-gray-400 w-12 h-12 dark:text-gray-200" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
          </svg>
          <h3 class="mb-5 font-normal text-gray-500 dark:text-gray-300"><span class="font-bold uppercase text-yellow-500">Warning</span>: This action will archive the data. Are you sure you want to archive the data with the name "<span class="font-bold underline text-gray-700 dark:text-gray-200">{{ $permission->name }}</span>"?</h3>
          <div class="inline-flex">
            <form method="POST" action="{{ route('permission.destroy', $permission->id) }}">
              @csrf
              @method('DELETE')
              <button class="text-gray-600 dark:text-gray-300 hover:bg-red-700 dark:hover:bg-red-800 hover:text-white dark:hover:text-white focus:ring-4 focus:outline-none focus:ring-red-500 dark:focus:ring-red-800 rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center mr-2">
                Yes, I'm sure
              </button>
            </form>     
            <button data-modal-hide="popup-modal{{ $permission->id }}" type="button" class="text-gray-700 dark:text-gray-300 bg-gray-300 hover:bg-gray-400 focus:ring-4 focus:ring-gray-300 rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-gray-600 dark:hover:bg-gray-800 focus:outline-none dark:focus:ring-gray-800">No, cancel</button>
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