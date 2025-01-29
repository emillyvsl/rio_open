<x-app-layout>
    {{-- Container com a Moldura --}}
    <div class="min-h-screen bg-cover bg-center flex justify-center items-center relative" style="background-image: url('{{ asset('images/fundo-moldura.png') }}');">

        {{-- Área Interna com Fundo Preto --}}
        <div class="relative flex flex-col justify-center items-center w-[80%] h-[85%] bg-cover bg-center" >


            {{-- Timer --}}
            <div class="flex flex-col items-center space-y-4">
                <button id="startButton" class="bg-[#003F8E] text-white px-6 py-2 rounded-md w-40 text-lg font-semibold hover:bg-blue-700 transition">
                    INICIAR
                </button>

                <div id="timerDisplay" class="text-white text-8xl font-bold py-32">00:00:00</div>

                <button id="stopButton" class="bg-gray-500 text-white px-6 py-2 rounded-md w-40 text-lg font-semibold hover:bg-gray-600 transition" disabled>
                    PARAR
                </button>
            </div>

        </div>
    </div>

    {{-- Script do Timer --}}
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

        startButton.addEventListener('click', function () {
            if (!running) {
                running = true;
                startTime = Date.now();
                updateButtonStyles();
                timer = setInterval(updateDisplay, 10); // Atualiza a cada 10ms para precisão nos centésimos
            }
        });

        stopButton.addEventListener('click', function () {
            if (running) {
                running = false;
                clearInterval(timer);
                updateButtonStyles();
            }
        });

        updateDisplay();
    </script>
</x-app-layout>
