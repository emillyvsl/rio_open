<x-app-layout>


    <div class="min-h-screen bg-cover bg-center" style="background-image: url('{{ asset('images/fundo.png') }}');">
        {{-- Botão de Novo Cadastro --}}
        <div class="flex justify-between items-center max-w-7xl mx-auto px-6 py-6">
            <button id="openModalButton" class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700">
                + Novo cadastro
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
        {{-- Tabela de Cadastros --}}
        <div class="max-w-7xl mx-auto px-6">
            <div class="bg-[#161515] text-white rounded-lg shadow-lg overflow-hidden">
                <div class="p-4 flex justify-between items-center border-b border-gray-700">
                    <h2 class="text-lg font-semibold">Cadastros</h2>
                    <input type="number" id="searchInput" placeholder="Procurar por CPF"
                        class="bg-white text-black px-4 py-2 rounded-full shadow-md w-4/12">
                </div>

                <table class="w-full text-sm text-left text-white border-collapse border-spacing-0">
                    <thead class="bg-[#161515] text-white uppercase">
                        <tr>
                            <th class="px-6 py-3 border-b border-gray-700">CPF</th>
                            <th class="px-6 py-3 border-b border-gray-700">Nome completo</th>
                            <th class="px-6 py-3 border-b border-gray-700">Tempo pirâmide</th>
                            <th class="px-6 py-3 border-b border-gray-700">Tempo Quiz</th>
                            <th class="px-6 py-3 border-b border-gray-700">Ativação</th>
                        </tr>
                    </thead>
                    <tbody id="cadastroTable">
                        @foreach ($participantes as $participante)
                            <tr class="border-b border-gray-700">
                                <td class="px-6 py-4 cpf">{{ $participante->cpf }}</td>
                                <td class="px-6 py-4 nome">{{ $participante->nome }}</td>

                                <!-- Tempo do Jogo Pirâmide -->
                                <td class="px-6 py-4">
                                    @php
                                        $piramide = $participante->jogos->where('tipo_jogo', 'PIRAMIDE')->first();
                                    @endphp
                                    {{ $piramide ? $piramide->tempo : '--:--:--' }}
                                </td>

                                <!-- Tempo do Jogo Perguntas -->
                                <td class="px-6 py-4">
                                    @php
                                        $perguntas = $participante->jogos->where('tipo_jogo', 'PERGUNTAS')->first();
                                    @endphp
                                    {{ $perguntas ? $perguntas->tempo : '--:--:--' }}
                                </td>

                                <!-- Botões de Ativação -->
                                <td class="px-6 py-4">
                                    <div class="flex space-x-4 items-center">
                                        <!-- Botão Piramide -->
                                        <a href="{{ route('piramide.index', ['id' => $participante->id]) }}"
                                            style="{{ $piramide ? 'pointer-events: none; opacity: 0.1;' : '' }}">
                                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M12 2C10.0605 2.00369 8.16393 2.57131 6.54128 3.63374C4.91862 4.69617 3.63994 6.20754 2.86099 7.98377C2.08204 9.76 1.83643 11.7244 2.15408 13.6378C2.47173 15.5511 3.33893 17.3308 4.65005 18.76L4.74005 18.86C5.6745 19.8465 6.80021 20.6322 8.04843 21.1692C9.29666 21.7061 10.6412 21.9831 12 21.9831C13.3589 21.9831 14.7034 21.7061 15.9517 21.1692C17.1999 20.6322 18.3256 19.8465 19.26 18.86L19.35 18.76C20.6612 17.3308 21.5284 15.5511 21.846 13.6378C22.1637 11.7244 21.9181 9.76 21.1391 7.98377C20.3602 6.20754 19.0815 4.69617 17.4588 3.63374C15.8362 2.57131 13.9396 2.00369 12 2ZM5.61005 16.79C4.56535 15.4116 3.99992 13.7295 3.99992 12C3.99992 10.2705 4.56535 8.58836 5.61005 7.21C6.35143 7.76925 6.95287 8.49297 7.36703 9.32416C7.78119 10.1554 7.99675 11.0713 7.99675 12C7.99675 12.9287 7.78119 13.8446 7.36703 14.6758C6.95287 15.507 6.35143 16.2307 5.61005 16.79ZM12 20C10.1793 20.003 8.41334 19.3779 7.00005 18.23C7.93081 17.4802 8.68173 16.5314 9.19765 15.4533C9.71357 14.3752 9.98137 13.1952 9.98137 12C9.98137 10.8048 9.71357 9.6248 9.19765 8.5467C8.68173 7.46859 7.93081 6.51978 7.00005 5.77C8.41506 4.62532 10.18 4.00082 12 4.00082C13.8201 4.00082 15.585 4.62532 17 5.77C16.0693 6.51978 15.3184 7.46859 14.8024 8.5467C14.2865 9.6248 14.0187 10.8048 14.0187 12C14.0187 13.1952 14.2865 14.3752 14.8024 15.4533C15.3184 16.5314 16.0693 17.4802 17 18.23C15.5868 19.3779 13.8208 20.003 12 20ZM18.39 16.79C17.6487 16.2307 17.0472 15.507 16.6331 14.6758C16.2189 13.8446 16.0033 12.9287 16.0033 12C16.0033 11.0713 16.2189 10.1554 16.6331 9.32416C17.0472 8.49297 17.6487 7.76925 18.39 7.21C19.4347 8.58836 20.0002 10.2705 20.0002 12C20.0002 13.7295 19.4347 15.4116 18.39 16.79Z"
                                                    fill="#2FD762" />
                                            </svg>
                                        </a>

                                        <!-- Botão Perguntas -->
                                        <a href="{{ route('pergunta.index', ['id' => $participante->id]) }}"
                                            style="{{ $perguntas ? 'pointer-events: none; opacity: 0.1;' : '' }}">
                                            <svg width="20" height="20" viewBox="0 0 20 20" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M19.7082 2.72079L17.2782 0.290793C17.0908 0.104542 16.8374 0 16.5732 0C16.309 0 16.0555 0.104542 15.8682 0.290793L10.2882 5.87079C10.1955 5.96423 10.1222 6.07505 10.0724 6.19689C10.0227 6.31872 9.99743 6.44919 9.99819 6.58079V9.00079C9.99819 9.26601 10.1035 9.52036 10.2911 9.7079C10.4786 9.89544 10.733 10.0008 10.9982 10.0008H13.4182C13.5498 10.0016 13.6803 9.97633 13.8021 9.92656C13.9239 9.8768 14.0347 9.80347 14.1282 9.71079L19.7082 4.13079C19.8944 3.94343 19.999 3.68998 19.999 3.42579C19.999 3.16161 19.8944 2.90815 19.7082 2.72079ZM12.9982 8.00079H11.9982V7.00079L16.5782 2.42079L17.5782 3.42079L12.9982 8.00079ZM16.9982 10.0008C16.733 10.0008 16.4786 10.1061 16.2911 10.2937C16.1035 10.4812 15.9982 10.7356 15.9982 11.0008C15.9982 12.8573 15.2607 14.6378 13.9479 15.9505C12.6352 17.2633 10.8547 18.0008 8.99819 18.0008H3.40819L4.04819 17.3708C4.14192 17.2778 4.21631 17.1672 4.26708 17.0454C4.31785 16.9235 4.34399 16.7928 4.34399 16.6608C4.34399 16.5288 4.31785 16.3981 4.26708 16.2762C4.21631 16.1544 4.14192 16.0438 4.04819 15.9508C3.06912 14.9718 2.40235 13.7245 2.13221 12.3666C1.86207 11.0086 2.0007 9.60109 2.53055 8.32194C3.06041 7.0428 3.95769 5.94951 5.10893 5.18034C6.26017 4.41118 7.61364 4.00069 8.99819 4.00079C9.2634 4.00079 9.51776 3.89544 9.70529 3.7079C9.89283 3.52036 9.99819 3.26601 9.99819 3.00079C9.99819 2.73558 9.89283 2.48122 9.70529 2.29369C9.51776 2.10615 9.2634 2.00079 8.99819 2.00079C7.30565 2.00636 5.64899 2.48907 4.21837 3.39353C2.78776 4.29799 1.64118 5.58752 0.910255 7.11411C0.179332 8.64069 -0.106305 10.3424 0.0861309 12.024C0.278567 13.7056 0.941278 15.2988 1.99819 16.6208L0.288186 18.2908C0.149429 18.4314 0.0554325 18.61 0.0180584 18.804C-0.0193158 18.998 0.0016069 19.1987 0.0781863 19.3808C0.153206 19.5634 0.280604 19.7197 0.444325 19.8301C0.608045 19.9404 0.800761 19.9998 0.998186 20.0008H8.99819C10.1801 20.0008 11.3504 19.768 12.4423 19.3157C13.5343 18.8634 14.5264 18.2005 15.3621 17.3648C16.1979 16.529 16.8608 15.5369 17.3131 14.4449C17.7654 13.353 17.9982 12.1827 17.9982 11.0008C17.9982 10.7356 17.8928 10.4812 17.7053 10.2937C17.5178 10.1061 17.2634 10.0008 16.9982 10.0008Z"
                                                    fill="white" />
                                            </svg>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- Modal --}}
    <div id="modal" class="fixed inset-0 bg-black bg-opacity-50 flex justify-center items-center z-50 hidden"
        x-data="cpfHandler()">
        <div class="bg-white w-[90%] sm:w-[400px] rounded-lg shadow-lg p-6">
            <h3 class="text-lg font-semibold mb-4 text-[#003F8E]">Novo Cadastro</h3>

            {{-- Formulário para Envio --}}
            <form action="{{ route('participante.store') }}" method="POST" class="space-y-4">
                @csrf

                <div>
                    <label for="cpf" class="block text-sm font-medium text-[#003F8E]">CPF</label>
                    <input type="text" name="cpf" id="cpf"
                        class="mt-1 block w-full border rounded-md shadow-sm focus:ring-[#003F8E] focus:ring-opacity-50"
                        required>
                </div>
                <div>
                    <label for="nome" class="block text-sm font-medium text-[#003F8E]">Nome completo</label>
                    <input type="text" name="nome" id="nome"
                        class="mt-1 block w-full border rounded-md shadow-sm focus:ring-[#003F8E] focus:ring-opacity-50"
                        required>
                </div>
                <div>
                    <label for="email" class="block text-sm font-medium text-[#003F8E]">E-mail</label>
                    <input type="email" name="email" id="email"
                        class="mt-1 block w-full border rounded-md shadow-sm focus:ring-[#003F8E] focus:ring-opacity-50"
                        required>
                </div>
                <div>
                    <label for="data_nascimento" class="block text-sm font-medium text-[#003F8E]">Data de
                        Nascimento</label>
                    <input type="date" name="data_nascimento" id="data_nascimento"
                        class="mt-1 block w-full border rounded-md shadow-sm focus:ring-[#003F8E] focus:ring-opacity-50"
                        required>
                </div>
                <div>
                    <label for="tipo_queijo" class="block text-sm font-medium text-[#003F8E]">Queijo premium</label>
                    <select name="tipo_queijo" id="tipo_queijo"
                        class="mt-1 block w-full border rounded-md shadow-sm focus:ring-[#003F8E] focus:ring-opacity-50"
                        required>
                        <option value="" disabled selected>SELECIONE</option>
                        <option value="BRIE">BRIE</option>
                        <option value="CAMEMBERT">CAMEMBERT</option>
                        <option value="GORGONZOLA">GORGONZOLA</option>
                        <option value="EMMENTAL">EMMENTAL</option>
                        <option value="GRUYERE">GRUYERE</option>
                        <option value="GOUDA">GOUDA</option>
                        <option value="PARMESÃO">PARMESÃO</option>
                        <option value="REINO">REINO</option>
                    </select>
                </div>
                <div>
                    <label class="inline-flex items-center space-x-2">
                        <input type="checkbox" name="termos_aceitos" value="1"
                            class="rounded border-gray-300 text-[#003F8E] shadow-sm focus:ring-[#003F8E] focus:ring-opacity-50"
                            required>
                        <span class="text-sm text-[#003F8E] font-semibold">
                            <a href="https://www.vigor.com.br/politica-de-privacidade" class="underline">
                                ESTOU DE ACORDO COM OS TERMOS DA VIGOR
                            </a>
                        </span>
                    </label>

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

    {{-- JavaScript para Máscara de CPF e Modal --}}
    <script>
        // Máscara para CPF com Inputmask
        const cpfInput = document.getElementById('cpf');
        const maskCpf = new Inputmask('999.999.999-99');
        maskCpf.mask(cpfInput);

        document.getElementById('openModalButton').addEventListener('click', function() {
            document.getElementById('modal').classList.remove('hidden');
        });

        document.getElementById('closeModalButton').addEventListener('click', function() {
            document.getElementById('modal').classList.add('hidden');
        });

        // Filtro na tabela por CPF ou Nome
        document.getElementById('searchInput').addEventListener('keyup', function() {
            let searchValue = this.value.toLowerCase();
            let rows = document.querySelectorAll("#cadastroTable tr");

            rows.forEach(row => {
                let cpf = row.querySelector(".cpf").textContent.toLowerCase();
                {{--  let nome = row.querySelector(".nome").textContent.toLowerCase();  --}}

                if (cpf.includes(searchValue)) {
                    row.style.display = "";
                } else {
                    row.style.display = "none";
                }
            });
        });
    </script>
</x-app-layout>
