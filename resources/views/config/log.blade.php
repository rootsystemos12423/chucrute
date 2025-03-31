<x-app-layout>
      <x-slot name="header">
          <h2 class="font-semibold text-xl text-gray-800 leading-tight">
              Detalhes do Log #{{ $log->id }}
          </h2>
      </x-slot>
  
      <div class="py-12">
          <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
              <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                  <div class="p-6 bg-white border-b border-gray-200">
                      
                      <!-- Informações Básicas -->
                      <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                          <div>
                              <h3 class="text-lg font-medium text-gray-900 mb-2">Informações do Erro</h3>
                              <div class="space-y-2">
                                  <p><span class="font-semibold">Data:</span> {{ $log->created_at->format('d/m/Y H:i:s') }}</p>
                                  <p><span class="font-semibold">Tipo:</span> {{ $log->exception }}</p>
                                  <p><span class="font-semibold">Código:</span> {{ $log->code }}</p>
                                  <p><span class="font-semibold">Arquivo:</span> {{ $log->file }}</p>
                                  <p><span class="font-semibold">Linha:</span> {{ $log->line }}</p>
                              </div>
                          </div>
                          <div>
                              <h3 class="text-lg font-medium text-gray-900 mb-2">Contexto</h3>
                              <div class="space-y-2">
                                  <p><span class="font-semibold">Usuário:</span> {{ $log->user?->name ?? 'Não autenticado' }}</p>
                                  <p><span class="font-semibold">URL:</span> {{ $log->request_uri }}</p>
                                  <p><span class="font-semibold">Método:</span> {{ $log->request_method }}</p>
                                  <p><span class="font-semibold">IP:</span> {{ $log->ip_address }}</p>
                                  <p><span class="font-semibold">User Agent:</span> {{ $log->user_agent }}</p>
                              </div>
                          </div>
                      </div>
  
                      <!-- Mensagem Completa -->
                      <div class="mb-8">
                          <h3 class="text-lg font-medium text-gray-900 mb-2">Mensagem Completa</h3>
                          <div class="bg-gray-50 p-4 rounded">
                              <code class="whitespace-pre-wrap">{{ $log->message }}</code>
                          </div>
                      </div>
  
                      <!-- Stack Trace -->
                      <div>
                          <h3 class="text-lg font-medium text-gray-900 mb-2">Stack Trace</h3>
                          <div class="bg-gray-800 text-gray-100 p-4 rounded overflow-x-auto">
                              <pre class="text-sm">{{ $log->trace }}</pre>
                          </div>
                      </div>
  
                      <!-- Botão Voltar -->
                      <div class="mt-6">
                          <a href="route('logs')" class="p-2 bg-pink-500 text-white font-bold ">
                              Voltar para a lista
                          </a>
                      </div>
                  </div>
              </div>
          </div>
      </div>
  </x-app-layout>