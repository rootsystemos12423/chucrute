<x-app-layout>
      <x-slot name="header">
          <h2 class="font-semibold text-xl text-gray-800 leading-tight">
              Logs de Erros do Sistema
          </h2>
      </x-slot>
  
      <div class="py-12">
          <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
              <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                  <div class="p-6 bg-white border-b border-gray-200">
                      
                      <!-- Filtros -->
                      <div class="mb-6">
                          <form method="GET" action="#">
                              <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                  <div>
                                      <x-label for="search" value="Pesquisar" />
                                      <x-input id="search" class="block mt-1 w-full" 
                                               type="text" name="search" 
                                               value="{{ request('search') }}" 
                                               placeholder="Mensagem ou arquivo" />
                                  </div>
                                  <div>
                                      <x-label for="exception" value="Tipo de Erro" />
                                      <select id="exception" name="exception" 
                                              class="block mt-1 w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm">
                                          <option value="">Todos</option>
                                          @foreach($exceptionTypes as $type)
                                              <option value="{{ $type }}" {{ request('exception') == $type ? 'selected' : '' }}>
                                                  {{ $type }}
                                              </option>
                                          @endforeach
                                      </select>
                                  </div>
                              </div>
                          </form>
                      </div>
  
                      <!-- Tabela de Logs -->
                      <div class="overflow-x-auto">
                          <table class="min-w-full divide-y divide-gray-200">
                              <thead class="bg-gray-50">
                                  <tr>
                                      <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Data</th>
                                      <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tipo</th>
                                      <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Mensagem</th>
                                      <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Usuário</th>
                                      <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Ações</th>
                                  </tr>
                              </thead>
                              <tbody class="bg-white divide-y divide-gray-200">
                                  @forelse($logs as $log)
                                      <tr class="{{ $log->code >= 500 ? 'bg-red-50' : '' }} hover:bg-gray-50">
                                          <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                              {{ $log->created_at->format('d/m/Y H:i') }}
                                          </td>
                                          <td class="px-6 py-4 whitespace-nowrap">
                                              <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                                  {{ $log->code >= 500 ? 'bg-red-100 text-red-800' : 'bg-yellow-100 text-yellow-800' }}">
                                                  {{ class_basename($log->exception) }} ({{ $log->code }})
                                              </span>
                                          </td>
                                          <td class="px-6 py-4">
                                              <div class="text-sm text-gray-900 max-w-xs truncate" title="{{ $log->message }}">
                                                  {{ $log->message }}
                                              </div>
                                              <div class="text-xs text-gray-500">
                                                  {{ basename($log->file) }}:{{ $log->line }}
                                              </div>
                                          </td>
                                          <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                              {{ $log->user?->name ?? 'Sistema' }}
                                          </td>
                                          <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                              <a href="{{ route('logs.show', $log->id) }}" 
                                                 class="text-indigo-600 hover:text-indigo-900 mr-3">
                                                  Detalhes
                                              </a>
                                          </td>
                                      </tr>
                                  @empty
                                      <tr>
                                          <td colspan="5" class="px-6 py-4 text-center text-sm text-gray-500">
                                              Nenhum log encontrado
                                          </td>
                                      </tr>
                                  @endforelse
                              </tbody>
                          </table>
                      </div>
  
                      <!-- Paginação -->
                      <div class="mt-4">
                          {{ $logs->withQueryString()->links() }}
                      </div>
                  </div>
              </div>
          </div>
      </div>
  </x-app-layout>