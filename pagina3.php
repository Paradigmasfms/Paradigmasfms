<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Pacifico&display=swap" rel="stylesheet">
    <title>Página 3 - Conflicto Armado en Guatemala</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.5.0-beta4/html2canvas.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Dancing+Script&display=swap" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
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
        .modal {
            display: none; 
            position: fixed; 
            z-index: 1; 
            left: 0;
            top: 0;
            width: 100%; 
            height: 100%; 
            overflow: auto; 
            background-color: rgba(0, 0, 0, 0.8); 
            justify-content: center;
            align-items: center;
        }
        .modal-content {
            position: relative;
            width: 80%; 
            max-width: 800px; 
            background-color: white;
            border-radius: 8px;
            padding: 20px;
            text-align: center;
        }
        .close {
            color: #aaa;
            position: absolute;
            top: 10px;
            right: 20px;
            font-size: 28px;
            font-weight: bold;
            cursor: pointer;
        }
        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
        }
        .diploma-container {
            position: relative;
            width: 100%;
            height: 0;
            padding-bottom: 77.27%; /* Proporción de una hoja carta (8.5/11 = 0.7727) */
            overflow: hidden;
        }
        .diploma-image {
            width: 100%;
            height: 100%;
            position: absolute;
            top: 0;
            left: 0;
            object-fit: contain;
        }
        .diploma-name {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            font-size: 24px;
            font-weight: bold;
            cursor: move;
            user-select: none;
        }
        .modal-buttons {
            margin-top: 20px;
        }
        button {
            margin: 5px;
            padding: 10px 20px;
            font-size: 1em;
            cursor: pointer;
        }


//nombre
        .name-controls {
            margin-top: 10px;
        }

        .name-controls button {
            padding: 5px 10px;
            margin: 0 5px;
            font-size: 16px;
        }

        #diplomaName {
        position: absolute;
        font-family: 'Dancing Script', cursive;
        font-size: 36px;
        color: #000080; /* Azul oscuro */
        text-align: left;
        white-space: nowrap;
        transform-origin: left top;
    }

    </style>
</head>
<body>
   <div class="container">
    <h1>
        <span style="font-family: 'Pacifico', cursive; color: red; font-size: 3em;">¡Felicidades!</span><br>
        <span style="font-family: 'arial', cursive; color: black; font-size: 42px;">Eres un buen investigador.</span><br>
        <span style="font-family: 'arial', cursive; color: black; font-size: 42px;">Has resuelto con agilidad e ingenio <br> 
        cada acertijo.</span><br><br>
        <span style="font-family: 'futura', cursive; color: blue; font-size: 30px;">Escribe tu nombre completo <br>
       </span><br>
    </h1>
    
    <div class="input-grid">
        <div class="input-group" style="width: 100%; display: flex; justify-content: center;">
            <center><input type="text" id="word1" placeholder="Escribe aquí el nombre completo" 
                   style="width: 300%; height: 100%; max-width: 600px; text-align: center;" 
                   onblur="capitalizeFirstLetter(this);"></center>
        </div>
    </div><br><br>

    <button class="btn" onclick="validateAnswers()">RECONOCIMIENTO</button>

    <!-- Modal -->
    <div id="myModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeModal()">&times;</span>
            <div id="diplomaContainer" class="diploma-container">
                <img src="img/dipoma.jpg" alt="Diploma" class="diploma-image">
                <div id="diplomaName" class="diploma-name"></div>
            </div>
            <div class="modal-buttons">
                <button onclick="downloadDiploma()">Descargar PDF</button>
            </div>
        </div>
    </div>

    <script>
        window.onload = function() {
            document.getElementById('word1').value = '';
        };

        function capitalizeFirstLetter(input) {
            const words = input.value.toLowerCase().split(' ');
            const formattedWords = words.map(word => 
                word.charAt(0).toUpperCase() + word.slice(1).toLowerCase()
            );
            input.value = formattedWords.join(' ');
        }

      function validateAnswers() {
    const name = document.getElementById('word1').value;
    document.getElementById('diplomaName').textContent = name;
    document.getElementById('myModal').style.display = 'flex';
    updateNamePosition();
}

function closeModal() {
    document.getElementById('myModal').style.display = 'none';
}

function downloadDiploma() {
    const { jsPDF } = window.jspdf;
    html2canvas(document.getElementById('diplomaContainer')).then(canvas => {
        const imgData = canvas.toDataURL('image/png');
        const pdf = new jsPDF('l', 'mm', 'letter');
        const imgProps = pdf.getImageProperties(imgData);
        const pdfWidth = pdf.internal.pageSize.getWidth();
        const pdfHeight = pdf.internal.pageSize.getHeight();
        const imgWidth = pdfWidth;
        const imgHeight = (imgProps.height * pdfWidth) / imgProps.width;
        pdf.addImage(imgData, 'PNG', 0, 0, imgWidth, imgHeight);
        pdf.save('diploma.pdf');
    });
}

// Variables para la posición del nombre
let nameX = 30;
let nameY = 57;

function updateNamePosition() {
    const diplomaName = document.getElementById('diplomaName');
    diplomaName.style.left = `${nameX}%`;
    diplomaName.style.top = `${nameY}%`;
}

function moveName(direction) {
    const step = 1; // Porcentaje de movimiento en cada paso
    switch(direction) {
        case 'up':
            nameY = Math.max(0, nameY - step);
            break;
        case 'down':
            nameY = Math.min(100, nameY + step);
            break;
        case 'left':
            nameX = Math.max(0, nameX - step);
            break;
        case 'right':
            nameX = Math.min(100, nameX + step);
            break;
    }
    updateNamePosition();
}
    </script>
</body>
</html>