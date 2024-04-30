    <?php

    require_once __DIR__ . '/vendor/autoload.php';
    require_once __DIR__ . '/AESController.php'; // Include the AESController class


    use Slim\Factory\AppFactory;

    AppFactory::setSlimHttpDecoratorsAutomaticDetection(false);
    $app = AppFactory::create();


    // Define your RESTful API endpoint
// Define your RESTful API endpoint
// Define your RESTful API endpoint
$app->post('/encryptData', function ($request, $response, $args) {

    // Get the data to be encrypted from the request body
    $parsedBody = $request->getParsedBody();
    $data = $parsedBody['data'] ?? null;

    if ($data === null) {
        // Handle the case when 'data' parameter is missing
        $response->getBody()->write(json_encode(['error' => 'Missing data parameter']));
        return $response->withStatus(400)->withHeader('Content-Type', 'application/json');
    }

    // Define your secret passphrase
    $passphrase = 'abcdefghijuklmno0123456789012345';

    // Encrypt the data using AES encryption
    $encryptedData = AESController::encrypt($data, $passphrase);

    // Write the JSON response manually
    $response->getBody()->write(json_encode(['encrypted_data' => $encryptedData]));

    // Set appropriate headers
    $response = $response->withHeader('Content-Type', 'application/json');

    return $response;
});


    // Run the Slim application
    $app->run();
    ?>
