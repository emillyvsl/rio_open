<x-app-layout>
    {{-- Container com a Moldura --}}
    <div class="min-h-screen bg-cover bg-center flex justify-center items-center relative" style="object-fit: cover; background-image: url('{{ asset('images/fundo-moldura.png') }}'); background-size: cover;">

        {{-- Área Interna com Fundo Preto --}}
        <div class="relative flex flex-col justify-center items-center w-full sm:w-[90%] md:w-[80%] lg:w-[60%] h-full sm:h-[90%] md:h-[80%] lg:h-[70%] bg-opacity-75 rounded-lg p-8">

            {{-- Timer --}}
            <div class="flex flex-col items-center space-y-4 w-full">
                <button id="startButton" class="bg-[#003F8E] text-white px-6 py-2 rounded-md w-40 text-lg font-semibold hover:bg-blue-700 transition">
                    INICIAR
                </button>

                <div id="timerDisplay" class="text-white text-4xl sm:text-6xl md:text-8xl font-bold py-16 sm:py-20 md:py-32">00:00:00</div>

                <button id="stopButton" class="bg-gray-500 text-white px-6 py-2 rounded-md w-40 text-lg font-semibold hover:bg-gray-600 transition" disabled>
                    PARAR
                </button>
            </div>

        </div>
    </div>

    {{-- Script do Timer e Requisição --}}
    <script>
        let timer;
        let startTime;
        let running = false;

        const startButton = document.getElementById('startButton');
        const stopButton = document.getElementById('stopButton');
        const timerDisplay = document.getElementById('timerDisplay');

        function updateDisplay() {
            if (!startTime) return;
            const elapsedTime = Date.now() - startTime;

            let mins = String(Math.floor((elapsedTime / 60000) % 60)).padStart(2, '0');
            let secs = String(Math.floor((elapsedTime / 1000) % 60)).padStart(2, '0');
            let centis = String(Math.floor((elapsedTime % 1000) / 10)).padStart(2, '0');

            timerDisplay.innerText = `${mins}:${secs}:${centis}`;

            // Verifica se o tempo atingiu 1 minuto
            if (mins >= 1) {
                stopTimerAndSendData();
            }
        }

        function updateButtonStyles() {
            if (running) {
                startButton.classList.replace("bg-[#003F8E]", "bg-gray-500");
                startButton.classList.replace("hover:bg-blue-700", "hover:bg-gray-600");
                startButton.disabled = true;

                stopButton.classList.replace("bg-gray-500", "bg-[#003F8E]");
                stopButton.classList.replace("hover:bg-gray-600", "hover:bg-blue-700");
                stopButton.disabled = false;
            } else {
                startButton.classList.replace("bg-gray-500", "bg-[#003F8E]");
                startButton.classList.replace("hover:bg-gray-600", "hover:bg-blue-700");
                startButton.disabled = false;

                stopButton.classList.replace("bg-[#003F8E]", "bg-gray-500");
                stopButton.classList.replace("hover:bg-blue-700", "hover:bg-gray-600");
                stopButton.disabled = true;
            }
        }

        function stopTimerAndSendData() {
            if (running) {
                running = false;
                clearInterval(timer);
                updateButtonStyles();

                // Captura o tempo final
                const elapsedTime = Date.now() - startTime;
                const mins = String(Math.floor((elapsedTime / 60000) % 60)).padStart(2, '0');
                const secs = String(Math.floor((elapsedTime / 1000) % 60)).padStart(2, '0');
                const centis = String(Math.floor((elapsedTime % 1000) / 10)).padStart(2, '0');
                const formattedTime = `${mins}:${secs}:${centis}`;

                // Dados para enviar
                const data = {
                    participanteId: @json($participanteId), // ID do participante
                    tempo: formattedTime // Tempo final
                };

                // Exibe o spinner enquanto os dados são enviados
                Swal.fire({
                    title: 'Salvando tempo...',
                    allowOutsideClick: false,
                    background: '#003F8E', // Fundo azul
                    color: '#FFFFFF', // Texto branco
                    confirmButtonColor: '#000000', // Botão preto
                    confirmButtonText: 'OK',
                    didOpen: () => {
                        Swal.showLoading();
                    }
                });

                // Envia os dados para o backend
                fetch('/tempo-piramide/salvar', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: JSON.stringify(data)
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        // Fecha o spinner
                        Swal.close();

                        // Exibe o modal com o tempo final
                        Swal.fire({
                            icon: 'success',
                            title: 'Tempo salvo!',
                            html: `
                                <div class="text-center">
                                    <p>Seu tempo final foi:</p>
                                    <p class="text-4xl font-bold">${formattedTime}</p>
                                </div>
                            `,
                            background: '#003F8E', // Fundo azul
                            color: '#FFFFFF', // Texto branco
                            confirmButtonColor: '#000000', // Botão preto
                            confirmButtonText: 'OK'
                        }).then(() => {
                            window.location.href = '/home'; // Redireciona para a página inicial
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Erro',
                            text: 'Ocorreu um erro ao salvar o tempo.',
                            background: '#003F8E', // Fundo azul
                            color: '#FFFFFF', // Texto branco
                            confirmButtonColor: '#000000', // Botão preto
                            confirmButtonText: 'OK'
                        });
                    }
                })
                .catch(error => {
                    console.error('Erro:', error);
                    Swal.fire({
                        icon: 'error',
                        title: 'Erro',
                        text: 'Ocorreu um erro ao enviar os dados.',
                        background: '#003F8E', // Fundo azul
                        color: '#FFFFFF', // Texto branco
                        confirmButtonColor: '#000000', // Botão preto
                        confirmButtonText: 'OK'
                    });
                });
            }
        }

        startButton.addEventListener('click', function () {
            if (!running) {
                running = true;
                startTime = Date.now();
                updateButtonStyles();
                timer = setInterval(updateDisplay, 10); // Atualiza a cada 10ms para precisão nos centésimos
            }
        });

        stopButton.addEventListener('click', function () {
            stopTimerAndSendData();
        });

        updateDisplay();
    </script>
</x-app-layout>
