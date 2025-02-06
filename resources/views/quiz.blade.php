<x-app-layout>
    <head>
      <meta name="csrf-token" content="{{ csrf_token() }}">
    </head>
    <div class="min-h-screen flex flex-col justify-between items-center p-4 bg-cover bg-center "
      style="background-image: url('{{ asset('images/fundo.png') }}');">
      <!-- Container principal do quiz -->
      <div id="quizContainer" class="w-full max-w-3xl bg-opacity-80 p-6 rounded-lg shadow-lg">
        <!-- Timer -->
        <div class="text-center text-7xl font-bold text-white py-10">
          <span id="timer">00:00:00</span>
        </div>

        <!-- Espaço para a pergunta e mensagem de resultado (serão exibidos um ou outro) -->
        <h2 id="questionText" class="text-2xl font-semibold text-center text-white"></h2>
        <p id="questionHint" class="text-gray-400 text-center mb-6"></p>

        <!-- Alternativas -->
        <div id="optionsContainer" class="space-y-3 flex flex-col items-center text-white"></div>

        <!-- Barra de Progresso (histórico de respostas) -->
        <!-- Alteramos para space-x-4 para maior espaçamento -->
        <div class="flex justify-center mt-6 space-x-4" id="progressContainer"></div>

        <!-- Exibição do número da questão -->
        <div id="questionNumber" class="text-center text-white text-xl mt-4"></div>

        <!-- Container de botões de ação -->
        <div id="actionContainer" class="flex justify-center mt-6 space-x-2 pt-10">
          <button id="verifyBtn" onclick="verifyAnswer()"
            class="bg-[#003F8E] hover:bg-[#003F8E] text-white font-bold text-xl w-3/4 py-3 px-4 rounded">
            Verificar Pergunta
          </button>
          <button id="nextBtn" onclick="nextQuestion()"
            class="hidden bg-[#003F8E] hover:bg-[#003F8E] text-white font-bold text-xl w-3/4 py-3 px-4 rounded">
            Próxima Pergunta
          </button>
        </div>
      </div>
    </div>

    <script>
      let questions = @json($perguntas);
      questions = questions.map(question => ({
        id: question.id, // ID da pergunta
        text: question.pergunta,
        hint: question.dicas,
        options: question.respostas.map(resp => ({
          id: resp.id, // ID da alternativa
          text: resp.alternativa
        })),
        correct: question.respostas.findIndex(resp => resp.is_correta) // Índice da resposta correta
      }));

      let currentIndex = 0;
      let selectedAnswer = null;
      let progressHistory = Array(questions.length).fill(null);
      let startTime = Date.now();
      let userAnswers = []; // Array para armazenar as respostas do usuário
      let timerInterval; // Variável para controlar o intervalo do timer

      // Função para atualizar o timer
      function updateTimer() {
        let elapsedTime = Date.now() - startTime;
        let seconds = Math.floor(elapsedTime / 1000);
        let minutes = Math.floor(seconds / 60);
        let remainingSeconds = seconds % 60;
        let milliseconds = Math.floor((elapsedTime % 1000) / 10);

        document.getElementById("timer").textContent =
          `${minutes.toString().padStart(2, '0')}:${remainingSeconds.toString().padStart(2, '0')}:${milliseconds.toString().padStart(2, '0')}`;

        // Envia os resultados automaticamente após 1 minuto e 10 segundos
        if (minutes >= 1 && remainingSeconds >= 10) {
          clearInterval(timerInterval); // Para o timer
          markUnansweredQuestionsAsWrong(); // Marca perguntas não respondidas como erradas
          sendResults(); // Envia os resultados
        }
      }

      // Função para marcar perguntas não respondidas como erradas
      function markUnansweredQuestionsAsWrong() {
        questions.forEach((question, index) => {
          if (progressHistory[index] === null) {
            progressHistory[index] = false; // Marca como errada
            userAnswers.push({
              questionId: question.id, // ID da pergunta
              selectedAnswerId: null, // Nenhuma alternativa selecionada
              isCorrect: false // Resposta errada
            });
          }
        });
      }

      // Função para parar o timer
      function stopTimer() {
        clearInterval(timerInterval);
      }

      // Função para carregar a pergunta atual
      function loadQuestion() {
        let question = questions[currentIndex];
        document.getElementById("questionText").textContent = question.text;
        document.getElementById("questionHint").textContent = question.hint;

        let optionsContainer = document.getElementById("optionsContainer");
        optionsContainer.innerHTML = "";

        question.options.forEach((option, index) => {
          let button = document.createElement("button");
          button.className =
            "w-3/4 py-3 px-4 rounded-full text-left transition-colors duration-300 border-2 border-gray-100 flex items-center justify-start space-x-4 bg-gray-800 hover:bg-[#003F8E]";
          button.innerHTML =
            `<span class="w-10 h-10 flex items-center justify-center text-white font-bold rounded-full border-2 border-gray-400">
                ${String.fromCharCode(65 + index)}
              </span>
              <span>${option.text}</span>`;
          button.onclick = () => selectAnswer(index, button);
          button.dataset.index = index;
          optionsContainer.appendChild(button);
        });

        document.getElementById("verifyBtn").classList.remove("hidden");
        document.getElementById("nextBtn").classList.add("hidden");

        // Altera o texto do botão "Próxima Pergunta" para "Concluir" na última pergunta
        if (currentIndex === questions.length - 1) {
          document.getElementById("nextBtn").textContent = "Concluir";
        }

        updateProgress();
        // Atualiza o número da questão (ex: "Questão 2/5")
        document.getElementById("questionNumber").textContent = ` ${currentIndex + 1}/${questions.length}`;
      }

      // Função para selecionar uma resposta
      function selectAnswer(index, button) {
        let question = questions[currentIndex];
        selectedAnswer = question.options[index].id; // Armazena o ID da alternativa selecionada

        // Remove a seleção anterior
        document.querySelectorAll("#optionsContainer button").forEach(btn => {
          btn.classList.remove("bg-[#003F8E]", "bg-gray-800", "bg-opacity-50");
          btn.classList.add("bg-gray-800", "bg-opacity-50");
        });

        // Destaca o botão clicado
        button.classList.remove("bg-gray-800", "bg-opacity-50");
        button.classList.add("bg-[#003F8E]");
      }

      // Função para verificar a resposta selecionada
      function verifyAnswer() {
        if (selectedAnswer === null) return;

        let question = questions[currentIndex];
        let buttons = document.querySelectorAll("#optionsContainer button");

        buttons.forEach((btn, index) => {
          let optionId = question.options[index].id; // Obtém o ID da alternativa
          if (optionId === question.options[question.correct].id) {
            btn.classList.add("bg-green-500"); // Resposta correta
          } else if (optionId === selectedAnswer) {
            btn.classList.add("bg-red-500"); // Resposta errada
          }
          btn.disabled = true;
        });

        // Armazena o progresso e a resposta do usuário
        progressHistory[currentIndex] = selectedAnswer === question.options[question.correct].id;
        userAnswers.push({
          questionId: question.id, // ID da pergunta
          selectedAnswerId: selectedAnswer, // ID da alternativa selecionada
          isCorrect: selectedAnswer === question.options[question.correct].id
        });

        document.getElementById("verifyBtn").classList.add("hidden");
        document.getElementById("nextBtn").classList.remove("hidden");

        // Altera o texto do botão "Próxima Pergunta" para "Concluir" na última pergunta
        if (currentIndex === questions.length - 1) {
          document.getElementById("nextBtn").textContent = "Concluir";
        }

        updateProgress();
      }

      // Função para avançar para a próxima pergunta ou concluir o quiz
      function nextQuestion() {
        if (currentIndex < questions.length - 1) {
          currentIndex++;
          selectedAnswer = null;
          loadQuestion();
        } else {
          sendResults(); // Envia os resultados ao final do quiz
        }
      }

      // Função para enviar os resultados e atualizar a interface final
      function sendResults() {
        stopTimer(); // Para o timer

        let elapsedTime = Date.now() - startTime; // Tempo total gasto
        let correctAnswers = userAnswers.filter(answer => answer.isCorrect).length;
        let wrongAnswers = userAnswers.length - correctAnswers;

        // Formata o tempo gasto
        let seconds = Math.floor(elapsedTime / 1000);
        let minutes = Math.floor(seconds / 60);
        let remainingSeconds = seconds % 60;
        let milliseconds = Math.floor((elapsedTime % 1000) / 10);
        let formattedTime = `${minutes.toString().padStart(2, '0')}:${remainingSeconds.toString().padStart(2, '0')}:${milliseconds.toString().padStart(2, '0')}`;

        // Determina se todas as questões foram respondidas corretamente
        const allCorrect = userAnswers.every(answer => answer.isCorrect);

        // Oculta elementos que não serão mais exibidos
        document.getElementById("timer").style.display = "none";
        document.getElementById("questionHint").style.display = "none";
        document.getElementById("optionsContainer").style.display = "none";

        // Exibe a mensagem de resultado (centralizada) no lugar da pergunta
        document.getElementById("questionText").innerHTML = `
            <div class="flex flex-col items-center justify-center py-32">
              <p class="mt-4 text-3xl pb-6">Tempo gasto: <strong>${formattedTime}</strong></p>
              <h1 class="text-4xl font-bold">
                ${allCorrect ? 'Parabéns! Você é o campeão dessa partida.' : 'Não foi dessa vez, obrigada pela sua participação.'}
              </h1>
            </div>
          `;

        // Atualiza o container de botões para exibir o botão "Encerrar Quiz"
        let actionContainer = document.getElementById("actionContainer");
        actionContainer.innerHTML = `
            <button onclick="window.location.href='/home'" class="bg-[#003F8E] hover:bg-[#003F8E] text-white font-bold text-xl w-3/4 py-3 px-4 rounded">
              Encerrar Quiz
            </button>
          `;

        // Os ícones do histórico de respostas (progressContainer) permanecem visíveis

        // Envia os resultados para o servidor
        let results = {
          participanteId: @json($participanteId),
          answers: userAnswers,
          totalTime: elapsedTime
        };

        fetch('/quiz/salvar', {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
          },
          body: JSON.stringify(results)
        })
        .then(response => response.json())
        .then(data => {
          if (!data.success) {
            console.error('Erro ao salvar os resultados:', data.message);
          }
        })
        .catch(error => {
          console.error('Erro:', error);
        });
      }

      // Função para atualizar a barra de progresso (histórico de respostas)
      function updateProgress() {
        let progressContainer = document.getElementById("progressContainer");
        progressContainer.innerHTML = "";

        for (let i = 0; i < questions.length; i++) {
          let svgContainer = document.createElement("div");
          svgContainer.className = "svg-container";

          let fillColor = progressHistory[i] === true ? "#2FD762" : progressHistory[i] === false ? "#FF0000" : "#C4C4C4";
          let svgHTML = `
              <svg width="32" height="32" viewBox="0 0 24 24" fill="none"
                xmlns="http://www.w3.org/2000/svg">
                <path d="M12 2C10.0605 2.00369 8.16393 2.57131 6.54128 3.63374C4.91862 4.69617 3.63994 6.20754 2.86099 7.98377C2.08204 9.76 1.83643 11.7244 2.15408 13.6378C2.47173 15.5511 3.33893 17.3308 4.65005 18.76L4.74005 18.86C5.6745 19.8465 6.80021 20.6322 8.04843 21.1692C9.29666 21.7061 10.6412 21.9831 12 21.9831C13.3589 21.9831 14.7034 21.7061 15.9517 21.1692C17.1999 20.6322 18.3256 19.8465 19.26 18.86L19.35 18.76C20.6612 17.3308 21.5284 15.5511 21.846 13.6378C22.1637 11.7244 21.9181 9.76 21.1391 7.98377C20.3602 6.20754 19.0815 4.69617 17.4588 3.63374C15.8362 2.57131 13.9396 2.00369 12 2ZM5.61005 16.79C4.56535 15.4116 3.99992 13.7295 3.99992 12C3.99992 10.2705 4.56535 8.58836 5.61005 7.21C6.35143 7.76925 6.95287 8.49297 7.36703 9.32416C7.78119 10.1554 7.99675 11.0713 7.99675 12C7.99675 12.9287 7.78119 13.8446 7.36703 14.6758C6.95287 15.507 6.35143 16.2307 5.61005 16.79ZM12 20C10.1793 20.003 8.41334 19.3779 7.00005 18.23C7.93081 17.4802 8.68173 16.5314 9.19765 15.4533C9.71357 14.3752 9.98137 13.1952 9.98137 12C9.98137 10.8048 9.71357 9.6248 9.19765 8.5467C8.68173 7.46859 7.93081 6.51978 7.00005 5.77C8.41506 4.62532 10.18 4.00082 12 4.00082C13.8201 4.00082 15.585 4.62532 17 5.77C16.0693 6.51978 15.3184 7.46859 14.8024 8.5467C14.2865 9.6248 14.0187 10.8048 14.0187 12C14.0187 13.1952 14.2865 14.3752 14.8024 15.4533C15.3184 16.5314 16.0693 17.4802 17 18.23C15.5868 19.3779 13.8208 20.003 12 20ZM18.39 16.79C17.6487 16.2307 17.0472 15.507 16.6331 14.6758C16.2189 13.8446 16.0033 12.9287 16.0033 12C16.0033 11.0713 16.2189 10.1554 16.6331 9.32416C17.0472 8.49297 17.6487 7.76925 18.39 7.21C19.4347 8.58836 20.0002 10.2705 20.0002 12C20.0002 13.7295 19.4347 15.4116 18.39 16.79Z" fill="${fillColor}" />
              </svg>`;
          svgContainer.innerHTML = svgHTML;
          progressContainer.appendChild(svgContainer);
        }
      }

      // Inicializa o quiz quando a página é carregada
      window.onload = function() {
        loadQuestion();
        timerInterval = setInterval(updateTimer, 100); // Inicia o timer a cada 100ms
      };
    </script>
  </x-app-layout>
