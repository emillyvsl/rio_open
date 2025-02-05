<x-app-layout>
    <!-- Container com a Moldura -->
    <div class="min-h-screen bg-cover bg-center flex justify-center items-center relative  bg-moldura"
      style="object-fit: cover; background-image: url('{{ asset('images/fundo.png') }}'); background-size: cover;">
      <!-- Área Interna com Fundo Preto -->
      <div id="contentContainer"
        class="relative flex flex-col justify-center items-center w-full sm:w-[90%] md:w-[80%] lg:w-[60%] h-full sm:h-[90%] md:h-[80%] lg:h-[70%] bg-opacity-75 rounded-lg p-8">
        <!-- Área do Timer e Botões -->
        <div class="flex flex-col items-center space-y-4 w-full" id="timerArea">
          <button id="startButton"
            class="bg-[#003F8E] text-white px-6 py-2 rounded-md w-40 text-lg font-semibold hover:bg-blue-700 transition">
            INICIAR
          </button>
          <div id="timerDisplay"
            class="text-white text-4xl sm:text-6xl md:text-8xl font-bold py-16 sm:py-20 md:py-32">
            00:00:00
          </div>
          <button id="stopButton"
            class="bg-gray-500 text-white px-6 py-2 rounded-md w-40 text-lg font-semibold hover:bg-gray-600 transition"
            disabled>
            PARAR
          </button>
        </div>
      </div>
    </div>

    <script>
      let timer;
      let startTime;
      let running = false;

      const startButton = document.getElementById('startButton');
      const stopButton = document.getElementById('stopButton');
      const timerDisplay = document.getElementById('timerDisplay');
      const contentContainer = document.getElementById('contentContainer');
      const timerArea = document.getElementById('timerArea');

      // Atualiza o display do cronômetro
      function updateDisplay() {
        if (!startTime) return;
        const elapsedTime = Date.now() - startTime;

        const mins = String(Math.floor((elapsedTime / 60000) % 60)).padStart(2, '0');
        const secs = String(Math.floor((elapsedTime / 1000) % 60)).padStart(2, '0');
        const centis = String(Math.floor((elapsedTime % 1000) / 10)).padStart(2, '0');

        timerDisplay.innerText = `${mins}:${secs}:${centis}`;

        // Se atingir 1 minuto ou mais, para o cronômetro e exibe o feedback
        if (elapsedTime >= 60000) {
          stopTimerAndShowFeedback();
        }
      }

      // Atualiza os estilos dos botões de iniciar/parar
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

      // Para o cronômetro e exibe o feedback diretamente na tela
      function stopTimerAndShowFeedback() {
        if (running) {
          running = false;
          clearInterval(timer);
          updateButtonStyles();

          // Calcula o tempo final
          const elapsedTime = Date.now() - startTime;
          const mins = String(Math.floor((elapsedTime / 60000) % 60)).padStart(2, '0');
          const secs = String(Math.floor((elapsedTime / 1000) % 60)).padStart(2, '0');
          const centis = String(Math.floor((elapsedTime % 1000) / 10)).padStart(2, '0');
          const formattedTime = `${mins}:${secs}:${centis}`;

          // Esconde a área do timer (cronômetro e botões)
          timerArea.style.display = "none";

          // Define a mensagem de feedback conforme o tempo final
          let feedbackHTML = `
            <div class="flex flex-col items-center justify-center py-32 text-center text-white">
              <p class="text-3xl pb-6">Tempo gasto: <strong>${formattedTime}</strong></p>
              ${ elapsedTime < 60000 ?
                `<h1 class="text-4xl font-bold">Parabéns! Você é o campeão dessa partida.</h1>` :
                `<h1 class="text-4xl font-bold">Não foi dessa vez, obrigada pela sua participação.</h1>`
              }
              <button onclick="window.location.href='/home'"
                class="bg-[#003F8E] hover:bg-[#003F8E] text-white font-bold text-xl w-3/4 py-3 px-6 py-2 rounded mt-32">
                Encerrar Pirâmide de bolinhas
              </button>
            </div>
          `;

          // Atualiza o conteúdo da área principal para exibir o feedback
          contentContainer.innerHTML = feedbackHTML;

          // Dados para enviar ao backend (se necessário)
          const data = {
            participanteId: @json($participanteId),
            tempo: formattedTime
          };

          // Envia os dados para o backend (opcional)
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
              if (!data.success) {
                console.error('Erro ao salvar o tempo:', data.message);
              }
            })
            .catch(error => {
              console.error('Erro:', error);
            });
        }
      }

      // Inicia o cronômetro
      startButton.addEventListener('click', function() {
        if (!running) {
          running = true;
          startTime = Date.now();
          updateButtonStyles();
          timer = setInterval(updateDisplay, 10); // Atualiza a cada 10ms para maior precisão
        }
      });

      // Para o cronômetro quando o botão "PARAR" é clicado
      stopButton.addEventListener('click', function() {
        stopTimerAndShowFeedback();
      });

      // Atualiza o display inicialmente
      updateDisplay();
    </script>
  </x-app-layout>
