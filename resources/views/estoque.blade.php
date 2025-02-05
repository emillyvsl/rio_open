<x-app-layout>
    {{-- Fundo com Imagem --}}
    <div class="min-h-screen bg-cover bg-center" style="background-image: url('{{ asset('images/fundo-tab.png') }}');">
        {{-- Botões de Novo Cadastro e Remover Item --}}
        <div class="flex justify-between items-center max-w-7xl mx-auto px-6 py-6">
            <button id="openModalButton" class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700">
                + Novo cadastro
            </button>

            <!-- Botão de Remover Item -->
            <button id="openRemoveModalButton" class="bg-red-600 text-white px-4 py-2 rounded-md hover:bg-red-700">
                Retirar prêmio
            </button>
        </div>

        @if (session('success') || session('error'))
            <script>
                document.addEventListener("DOMContentLoaded", function() {
                    Swal.fire({
                        icon: '{{ session('success') ? 'success' : 'error' }}',
                        title: '{{ session('success') ? 'Sucesso!' : 'Erro!' }}',
                        text: '{{ session('success') ?? session('error') }}',
                        background: '#003F8E',
                        color: '#ffffff',
                        confirmButtonColor: '#000'
                    });
                });
            </script>
        @endif

        {{-- Exibindo os Itens --}}
        <div class="max-w-7xl mx-auto px-6 py-6">
            <div class="space-y-6">
                <!-- Títulos e quadrados alinhados -->
                <div class="flex flex-col items-center">
                    <div class="flex flex-row gap-4 w-full justify-center">
                        <div class="bg-transparent text-white rounded-lg p-4 shadow-lg text-center flex-1">
                            <span class="text-lg font-semibold text-white mb-2"></span>
                        </div>
                        <div class="bg-transparent text-white rounded-lg p-4 shadow-lg text-center flex-1">
                            <span class="text-lg font-semibold text-white mb-2">Estoque Inicial</span>
                        </div>
                        <div class="bg-transparent text-white rounded-lg p-4 shadow-lg text-center flex-1">
                            <span class="text-lg font-semibold text-white mb-2">Prêmios Entregues</span>
                        </div>
                        <div class="bg-transparent text-white rounded-lg p-4 shadow-lg text-center flex-1">
                            <span class="text-lg font-semibold text-white mb-2">Saldo</span>
                        </div>
                    </div>
                </div>

                {{-- Iteração para mostrar os itens --}}
                @foreach ($estoque as $item)
                    <div class="flex flex-col items-center">
                        <div class="flex flex-row gap-4 w-full justify-center">
                            <!-- Nome do Item com Ícone de Lixeira -->
                            <div class="bg-transparent text-white rounded-lg p-4 shadow-lg text-center flex-1">
                                <div class="flex items-center justify-center gap-2">
                                    <span class="text-lg font-semibold text-white mb-2">{{ $item->nome }}</span>
                                    <!-- Ícone de Lixeira com botão de remoção -->
                                    <form action="{{ route('estoque.remover') }}" method="POST" id="removeForm{{ $item->id }}">
                                        @csrf
                                        @method('DELETE')
                                        <input type="hidden" name="item" value="{{ $item->id }}">
                                        <button type="button" onclick="confirmarRemocao({{ $item->id }})" class="text-red-500 hover:text-red-700">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                                <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" />
                                            </svg>
                                        </button>
                                    </form>
                                </div>
                            </div>

                            <!-- Estoque Inicial -->
                            <div class="bg-[#161515] text-white rounded-lg p-8 shadow-lg text-center flex-1">
                                <div class="text-xl font-semibold">{{ $item->quantidade }}</div>
                            </div>

                            <!-- Prêmios Entregues -->
                            <div class="bg-[#161515] text-white rounded-lg p-8 shadow-lg text-center flex-1">
                                <div class="text-xl font-semibold">{{ $item->premios_entregues ?? 0 }}</div>
                            </div>

                            <!-- Saldo (Estoque Inicial - Prêmios Entregues) -->
                            <div class="bg-[#161515] text-white rounded-lg p-8 shadow-lg text-center flex-1">
                                <div class="text-xl font-semibold">{{ $item->quantidade - ($item->premios_entregues ?? 0) }}</div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    {{-- SweetAlert - Confirmar remoção --}}
    <script>
        // Função para confirmar a remoção de um item
        function confirmarRemocao(itemId) {
            Swal.fire({
                title: 'Tem certeza?',
                text: "Você não poderá reverter isso!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#003F8E', // Cor do botão "Sim"
                cancelButtonColor: '#d33', // Cor do botão "Cancelar"
                confirmButtonText: 'Sim, remover!',
                background: '#003F8E', // Fundo azul
                color: '#ffffff', // Texto branco
                confirmButtonColor: '#000', // Cor do texto do botão "Sim"
            }).then((result) => {
                if (result.isConfirmed) {
                    // Enviar o formulário para remover o item
                    document.getElementById('removeForm' + itemId).submit();
                }
            });
        }
    </script>

    {{-- Modal para Cadastro de Novo Item --}}
    <div id="newItemModal" class="fixed inset-0 bg-black bg-opacity-50 flex justify-center items-center z-50 hidden">
        <div class="bg-white w-[90%] sm:w-[400px] rounded-lg shadow-lg p-6">
            <h3 class="text-lg font-semibold mb-4 text-[#003F8E]">Novo Cadastro de Item</h3>
            <form action="{{ route('estoque.store') }}" method="POST" class="space-y-4">
                @csrf
                <label for="item_name" class="block text-sm font-medium text-[#003F8E]">Nome do Item</label>
                <input type="text" name="item_name" id="item_name"
                    class="mt-1 block w-full border rounded-md shadow-sm focus:ring-[#003F8E] focus:ring-opacity-50"
                    required>

                <label for="quantity" class="block text-sm font-medium text-[#003F8E]">Quantidade Inicial</label>
                <input type="number" name="quantity" id="quantity"
                    class="mt-1 block w-full border rounded-md shadow-sm focus:ring-[#003F8E] focus:ring-opacity-50"
                    required>

                <div class="flex justify-between">
                    <button id="closeNewItemModalButton" type="button"
                        class="text-[#003F8E] font-semibold hover:underline">
                        Cancelar
                    </button>
                    <button type="submit" class="bg-[#003F8E] text-white px-4 py-2 rounded-md hover:bg-blue-700">
                        Salvar
                    </button>
                </div>
            </form>
        </div>
    </div>

    {{-- Modal para Remover Item --}}
    <div id="removeModal" class="fixed inset-0 bg-black bg-opacity-50 flex justify-center items-center z-50 hidden">
        <div class="bg-white w-[90%] sm:w-[400px] rounded-lg shadow-lg p-6">
            <h3 class="text-lg font-semibold mb-4 text-[#003F8E]">Remover Item</h3>
            <form action="{{ route('estoque.remover') }}" method="POST" class="space-y-4">
                @csrf
                <label for="item" class="block text-sm font-medium text-[#003F8E]">Item</label>
                <select name="item" id="item"
                    class="mt-1 block w-full border rounded-md shadow-sm focus:ring-[#003F8E] focus:ring-opacity-50">
                    <option value="">Selecione</option>

                    @foreach ($estoque as $item)
                        <option value="{{ $item->id }}">{{ $item->nome }}</option>
                    @endforeach
                </select>

                <label for="quantidade" class="block text-sm font-medium text-[#003F8E]">Quantidade Removida</label>
                <input type="number" name="quantidade" id="quantidade"
                    class="mt-1 block w-full border rounded-md shadow-sm focus:ring-[#003F8E] focus:ring-opacity-50"
                    required>

                <div class="flex justify-between">
                    <button id="closeRemoveModalButton" type="button"
                        class="text-[#003F8E] font-semibold hover:underline">
                        Cancelar
                    </button>
                    <button type="submit" class="bg-[#003F8E] text-white px-4 py-2 rounded-md hover:bg-blue-700">
                        Remover
                    </button>
                </div>
            </form>
        </div>
    </div>

    {{-- JavaScript para Modais e Remoção --}}
    <script>
        // Abrir o modal de cadastro de novo item
        document.getElementById('openModalButton').addEventListener('click', function() {
            document.getElementById('newItemModal').classList.remove('hidden');
        });

        // Fechar o modal de cadastro de novo item
        document.getElementById('closeNewItemModalButton').addEventListener('click', function() {
            document.getElementById('newItemModal').classList.add('hidden');
        });

        // Abrir o modal de remover item
        document.getElementById('openRemoveModalButton').addEventListener('click', function() {
            document.getElementById('removeModal').classList.remove('hidden');
        });

        // Fechar o modal de remover item
        document.getElementById('closeRemoveModalButton').addEventListener('click', function() {
            document.getElementById('removeModal').classList.add('hidden');
        });
    </script>
</x-app-layout>
