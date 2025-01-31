<x-app-layout>
    {{-- Fundo com Imagem --}}
    <div class="min-h-screen bg-cover bg-center" style="background-image: url('{{ asset('images/fundo.png') }}');">
        {{-- Botão de Novo Cadastro --}}
        <div class="flex justify-between items-center max-w-7xl mx-auto px-6 py-6">
            <button id="openModalButton" class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700">
                + Novo cadastro
            </button>
        </div>

        {{-- Tabela de Estoque --}}
        <div class="max-w-7xl mx-auto px-6">
            <div class="bg-[#161515] text-white rounded-lg shadow-lg overflow-hidden">
                <div class="p-4 flex justify-between items-center border-b border-gray-700">
                    <h2 class="text-lg font-semibold">Estoque</h2>
                    <input type="text" id="searchInput" placeholder="Procurar por Prêmio"
                        class="bg-white text-black px-4 py-2 rounded-full shadow-md w-4/12">
                </div>

                <table class="w-full text-sm text-left text-white border-collapse border-spacing-0">
                    <thead class="bg-[#161515] text-white uppercase">
                        <tr>
                            <th class="px-6 py-3 border-b border-gray-700">Prêmio</th>
                            <th class="px-6 py-3 border-b border-gray-700">Estoque Inicial</th>
                            <th class="px-6 py-3 border-b border-gray-700">Prêmios Entregues</th>
                            <th class="px-6 py-3 border-b border-gray-700">Saldo</th>
                        </tr>
                    </thead>
                    <tbody id="estoqueTable">
                        <!-- Exemplo de dados -->
                        <tr class="border-b border-gray-700">
                            <td class="px-6 py-4">Brinde Top</td>
                            <td class="px-6 py-4">150</td>
                            <td class="px-6 py-4">2</td>
                            <td class="px-6 py-4">148</td>
                        </tr>
                        <tr class="border-b border-gray-700">
                            <td class="px-6 py-4">Brinde Médio</td>
                            <td class="px-6 py-4">150</td>
                            <td class="px-6 py-4">4</td>
                            <td class="px-6 py-4">146</td>
                        </tr>
                        <tr class="border-b border-gray-700">
                            <td class="px-6 py-4">Quelle Relado</td>
                            <td class="px-6 py-4">150</td>
                            <td class="px-6 py-4">23</td>
                            <td class="px-6 py-4">127</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- Modal de Cadastro --}}
    <div id="modal" class="fixed inset-0 bg-black bg-opacity-50 flex justify-center items-center z-50 hidden">
        <div class="bg-white w-[90%] sm:w-[400px] rounded-lg shadow-lg p-6">
            <h3 class="text-lg font-semibold mb-4 text-[#003F8E]">Novo Cadastro</h3>

            {{-- Formulário para Envio --}}
            <form action="{{ route('estoque.store') }}" method="POST" class="space-y-4">
                @csrf

                <div>
                    <label for="premio" class="block text-sm font-medium text-[#003F8E]">Prêmio</label>
                    <input type="text" name="premio" id="premio"
                        class="mt-1 block w-full border rounded-md shadow-sm focus:ring-[#003F8E] focus:ring-opacity-50"
                        required>
                </div>
                <div>
                    <label for="estoque_inicial" class="block text-sm font-medium text-[#003F8E]">Estoque Inicial</label>
                    <input type="number" name="estoque_inicial" id="estoque_inicial"
                        class="mt-1 block w-full border rounded-md shadow-sm focus:ring-[#003F8E] focus:ring-opacity-50"
                        required>
                </div>
                <div>
                    <label for="premios_entregues" class="block text-sm font-medium text-[#003F8E]">Prêmios Entregues</label>
                    <input type="number" name="premios_entregues" id="premios_entregues"
                        class="mt-1 block w-full border rounded-md shadow-sm focus:ring-[#003F8E] focus:ring-opacity-50"
                        required>
                </div>
                <div>
                    <label for="saldo" class="block text-sm font-medium text-[#003F8E]">Saldo</label>
                    <input type="number" name="saldo" id="saldo"
                        class="mt-1 block w-full border rounded-md shadow-sm focus:ring-[#003F8E] focus:ring-opacity-50"
                        required>
                </div>
                <div class="flex justify-between">
                    <button id="closeModalButton" type="button" class="text-[#003F8E] font-semibold hover:underline">
                        X CANCELAR
                    </button>
                    <button type="submit" class="bg-[#003F8E] text-white px-4 py-2 rounded-md hover:bg-blue-700">
                        SALVAR
                    </button>
                </div>
            </form>
        </div>
    </div>

    {{-- JavaScript para Modal e Filtro --}}
    <script>
        document.getElementById('openModalButton').addEventListener('click', function() {
            document.getElementById('modal').classList.remove('hidden');
        });

        document.getElementById('closeModalButton').addEventListener('click', function() {
            document.getElementById('modal').classList.add('hidden');
        });

        // Filtro na tabela por Prêmio
        document.getElementById('searchInput').addEventListener('keyup', function() {
            let searchValue = this.value.toLowerCase();
            let rows = document.querySelectorAll("#estoqueTable tr");

            rows.forEach(row => {
                let premio = row.querySelector("td").textContent.toLowerCase();

                if (premio.includes(searchValue)) {
                    row.style.display = "";
                } else {
                    row.style.display = "none";
                }
            });
        });
    </script>
</x-app-layout>
