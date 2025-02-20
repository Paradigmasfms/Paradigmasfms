<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página 2 - Conflicto Armado en Guatemala</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            text-align: center;
            background: linear-gradient(45deg, #ffcccc, #ffb3ff, #d9b3ff);
            height: 100vh;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }
        .container {
            background: rgba(255, 255, 255, 0.8);
            padding: 30px;
            border-radius: 15px;
            width: 70%;
            max-width: 800px;
        }
        h1 {
            font-size: 1.8em;
            margin-bottom: 15px;
        }
        .instructions {
            font-size: 1.2em;
            margin-bottom: 20px;
        }
        .input-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 15px;
            margin-bottom: 20px;
        }
        .input-group {
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        .input-group label {
            font-size: 1.2em;
            margin-bottom: 5px;
        }
        .input-group input {
            width: 80%;
            padding: 10px;
            font-size: 1em;
            border: 2px solid #999;
            border-radius: 10px;
            text-align: center;
        }
        .btn {
            display: inline-block;
            padding: 15px 30px;
            font-size: 1.2em;
            color: white;
            background: #b300b3;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            text-decoration: none;
            transition: 0.3s;
        }
        .btn:hover {
            background: #800080;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Recorre los ocho lugares que nos recuerdan <br>
        <span style="color: red;">   "La dignificación del conflicto armado en Guatemala" </span><br>
        y descubre las ocho palabras claves.</h1>
        <p class="instructions">Cada mural está enumerado, coloca en su número la palabra descubierta.</p>
        
        <div class="input-grid">
            <div class="input-group">
                <label for="word1">1</label>
                <input type="text" id="word1">
            </div>
            <div class="input-group">
                <label for="word2">2</label>
                <input type="text" id="word2">
            </div>
            <div class="input-group">
                <label for="word3">3</label>
                <input type="text" id="word3">
            </div>
            <div class="input-group">
                <label for="word4">4</label>
                <input type="text" id="word4">
            </div>
            <div class="input-group">
                <label for="word5">5</label>
                <input type="text" id="word5">
            </div>
            <div class="input-group">
                <label for="word6">6</label>
                <input type="text" id="word6">
            </div>
            <div class="input-group">
                <label for="word7">7</label>
                <input type="text" id="word7">
            </div>
            <div class="input-group">
                <label for="word8">8</label>
                <input type="text" id="word8">
            </div>
        </div><br>
        <button class="btn" onclick="validateAnswers()">VALIDAR LAS RESPUESTAS</button>
    </div>

<script>
    function validateAnswers() {
        const correctAnswers = [
            'volar1', 
            'volar2', 
            'volar3', 
            'liderazgo', 
            'paz1', 
            'paz2', 
            'paz3', 
            'paz4'  
        ];

        let feedbackMessages = [];
        let allCorrect = true;

        for (let i = 0; i < correctAnswers.length; i++) {
            const userInput = document.getElementById(`word${i + 1}`).value.trim(); // Sin conversión a minúsculas
            if (userInput.toLowerCase() === correctAnswers[i].toLowerCase()) { // Comparación insensible a mayúsculas
                feedbackMessages.push(`Palabra ${i + 1} correcta.`);
            } else {
                feedbackMessages.push(`Palabra ${i + 1} incorrecta.`);
                allCorrect = false; // Si hay alguna incorrecta, marcamos que no todas son correctas
            }
        }

        // Muestra todas las respuestas en la alerta
        alert(feedbackMessages.join("\n"));

        // Borra el contenido de las casillas
        for (let i = 0; i < correctAnswers.length; i++) {
            document.getElementById(`word${i + 1}`).value = '';
        }

        // Redirige a la página 3 solo si todas las respuestas son correctas
        if (allCorrect) {
            window.location.href = 'pagina3.php'; 
        }
    }

    // Función para manejar el evento de presionar "Enter"
    function handleKeyPress(event) {
        if (event.key === 'Enter') {
            event.preventDefault(); // Evita el comportamiento por defecto
            validateAnswers(); // Llama a la función de validación
        }
    }

    // Añade el evento de "keypress" a cada input
    window.onload = function() {
        for (let i = 1; i <= 8; i++) {
            document.getElementById(`word${i}`).addEventListener('keypress', handleKeyPress);
        }

        // También agrega el evento al botón de validación
        document.getElementById('validateButton').addEventListener('click', validateAnswers); // Cambia 'validateButton' por el ID de tu botón
    };
</script>
</body>
</html>