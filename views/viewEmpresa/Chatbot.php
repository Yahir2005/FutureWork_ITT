<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Futurework ITT - Asistente de Reclutamiento IA</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Estilos personalizados para los globos de chat */
        .chat-box {
            height: 60vh;
            overflow-y: auto;
            background-color: #f8f9fa;
            display: flex;
            flex-direction: column;
        }
        .chat-bubble {
            max-width: 80%;
            padding: 12px 16px;
            border-radius: 15px;
            margin-bottom: 10px;
            font-size: 0.95rem;
            line-height: 1.4;
        }
        .bot-bubble {
            background-color: #ffffff;
            color: #333;
            border: 1px solid #dee2e6;
            border-bottom-left-radius: 2px;
            align-self: flex-start;
        }
        .user-bubble {
            background-color: #0d6efd;
            color: #ffffff;
            border-bottom-right-radius: 2px;
            align-self: flex-end;
        }
        /* Pequeña animación para cuando la IA "piensa" */
        .typing-indicator {
            font-style: italic;
            color: #6c757d;
            font-size: 0.85rem;
            display: none;
        }
    </style>
</head>
<body class="bg-light">

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6">
            
            <div class="card shadow-sm border-0">
                <div class="card-header bg-primary text-white d-flex align-items-center p-3">
                    <div class="me-3">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-robot" viewBox="0 0 16 16">
                            <path d="M6 12.5a.5.5 0 0 1 .5-.5h3a.5.5 0 0 1 0 1h-3a.5.5 0 0 1-.5-.5ZM3 8.062C3 6.76 4.235 5.765 5.53 5.889a28.04 28.04 0 0 1 4.94 0C11.765 5.765 13 6.76 13 8.062v1.157a.933.933 0 0 1-.765.935c-.845.147-2.34.346-4.235.346-1.895 0-3.39-.2-4.235-.346A.933.933 0 0 1 3 9.219V8.062Zm4.542-.827a.25.25 0 0 0-.217.068l-.92.9a24.767 24.767 0 0 1-1.871-.183.25.25 0 0 0-.068.495c.55.076 1.232.149 2.02.193a.25.25 0 0 0 .189-.071l.754-.736.847 1.71a.25.25 0 0 0 .404.062l.932-.97a25.286 25.286 0 0 0 1.922-.188.25.25 0 0 0-.068-.495c-.538.074-1.208.145-1.98.189a.25.25 0 0 0-.166.076l-.754.785-.842-1.7a.25.25 0 0 0-.182-.135Z"/>
                            <path d="M8.5 1.866a1 1 0 1 0-1 0V3h-2A4.5 4.5 0 0 0 2 7.5V8a1 1 0 0 0-1 1v2a1 1 0 0 0 1 1v1a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2v-1a1 1 0 0 0 1-1V9a1 1 0 0 0-1-1v-.5A4.5 4.5 0 0 0 10.5 3h-2V1.866ZM14 7.5V13a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V7.5A3.5 3.5 0 0 1 5.5 4h5A3.5 3.5 0 0 1 14 7.5Z"/>
                        </svg>
                    </div>
                    <div>
                        <h5 class="mb-0">Klivify IA</h5>
                        <small class="text-white-50">Buscador de Talento Semántico</small>
                    </div>
                </div>

                <div class="card-body chat-box p-4" id="chatWindow">
                    <div class="chat-bubble bot-bubble shadow-sm">
                        ¡Hola! Soy la IA de reclutamiento. Dime qué tipo de perfil estás buscando y encontraré a los mejores postulantes en nuestra base de datos.
                    </div>
                </div>

                <div class="px-4 pb-2 typing-indicator" id="typingIndicator">
                    La IA está analizando ...
                </div>

                <div class="card-footer bg-white p-3 border-0">
                    <div class="input-group">
                        <input type="text" id="userInput" class="form-control" placeholder="Ej. Desarrollador web con bases de datos..." aria-label="Mensaje">
                        <button class="btn btn-primary" type="button" id="sendBtn">Enviar</button>
                    </div>
                </div>
            </div>
            
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<script>
    const chatWindow = document.getElementById('chatWindow');
    const userInput = document.getElementById('userInput');
    const sendBtn = document.getElementById('sendBtn');
    const typingIndicator = document.getElementById('typingIndicator');

    // Cambia esto a la IP de tu servidor si no estás en local
    const API_URL = 'http://127.0.0.1:8000/chat/reclutador'; 

    function appendMessage(text, sender) {
        const bubble = document.createElement('div');
        bubble.classList.add('chat-bubble', sender === 'user' ? 'user-bubble' : 'bot-bubble', 'shadow-sm');
        
        // Formatear saltos de línea para que la respuesta de la IA se vea bien
        bubble.innerHTML = text.replace(/\n/g, '<br>');
        
        chatWindow.appendChild(bubble);
        // Scroll automático hacia abajo
        chatWindow.scrollTop = chatWindow.scrollHeight;
    }

    async function sendMessage() {
        const message = userInput.value.trim();
        if (!message) return;

        // 1. Mostrar el mensaje del usuario
        appendMessage(message, 'user');
        userInput.value = '';
        
        // 2. Mostrar indicador de "escribiendo"
        typingIndicator.style.display = 'block';

        try {
            // 3. Hacer la petición a FastAPI
            const response = await fetch(API_URL, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                // CORRECCIÓN 1: Cambiado 'mensaje' por 'message' para que Pydantic lo acepte
                body: JSON.stringify({ message: message })
            });

            if (!response.ok) {
                throw new Error('Error en el servidor');
            }

            const data = await response.json();
            
            // 4. Ocultar indicador y mostrar la respuesta de la IA
            typingIndicator.style.display = 'none';
            
            // CORRECCIÓN 2: Cambiado 'data.respuesta' por 'data.response' que es lo que manda tu Python
            appendMessage(data.response, 'bot');

        } catch (error) {
            console.error('Error:', error);
            typingIndicator.style.display = 'none';
            appendMessage('Hubo un error al conectar con la IA. Asegúrate de que el servidor FastAPI esté encendido.', 'bot');
        }
    }

    // Eventos para el botón y la tecla Enter
    sendBtn.addEventListener('click', sendMessage);
    userInput.addEventListener('keypress', function (e) {
        if (e.key === 'Enter') {
            sendMessage();
        }
    });
</script>

</body>
</html>