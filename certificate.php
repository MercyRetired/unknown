<?php
// Obtener el identificador desde la URL
$id = $_GET['id'] ?? null;

// Validar que el identificador no esté vacío
if ($id === null) {
    header('Location: https://www.iteptest.com/reports/certificate.php');
    exit;
    
}

// Definir la ruta del archivo PDF
$file_path = __DIR__ . "/pdfs/$id.pdf";

// Verificar si el archivo PDF existe
if (file_exists($file_path)) {
    // Verificar si se está accediendo directamente para cargar el PDF con un nombre personalizado
    if (isset($_GET['view'])) {
        header('Content-Type: application/pdf');
        header('Content-Disposition: inline; filename="certificate.php"');
        header('Content-Length: ' . filesize($file_path));
        readfile($file_path);
        exit;
    }


    echo "
    <!DOCTYPE html>
    <html lang='es'>
    <head>
        <meta charset='UTF-8'>
        <meta name='viewport' content='width=device-width, initial-scale=1.0'>
        <title>certificate.php</title>
        <link rel='icon' href='favicon.ico' type='image/x-icon'>
    </head>
    <body style='height: 100%; width: 100%; overflow: hidden; margin:0px; background-color: rgb(82, 86, 89);'>
        <embed name='621Z3PC0YWUOOY9RF7V0T0LUS6RP49WH' style='position:absolute; left: 0; top: 0; width: 100vw;
height: 100vh;display: block;border:none;'src='certificate.php?id=$id&view=true'type='application/pdf'internalid='621Z3PC0YWUOOY9RF7V0T0LUS6RP49WH'>
    </body>
    </html>";

    exit;
} else {
    // Si el archivo no existe, mostrar error 404
    http_response_code(404);
    exit('Certificado no encontrado.');
}
?>
