<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ApiController extends Controller
{
    public function consultaDni(Request $request)
    {
        $numero = $request->query('numero');
        $token = 'apis-token-11237.TUWaxB94ABwTOpen3yBEMEptzT2Fh7EG'; // Asegúrate de establecer tu token aquí

        // Validar el número
        if (empty($numero) || !is_numeric($numero)) {
            return response()->json(['success' => false, 'message' => 'Número de DNI inválido.']);
        }

        $client = new Client(['base_uri' => 'https://api.apis.net.pe', 'verify' => false]);
        $parameters = [
            'headers' => [
                'Accept' => 'application/json',
                'Authorization' => 'Bearer ' . $token, // Se agregó 'Bearer'
            ],
            'query' => ['numero' => $numero]
        ];

        try {
            $res = $client->request('GET', '/v2/reniec/dni', $parameters);
            $response = json_decode($res->getBody()->getContents(), true);

            // Log de la respuesta
            Log::info('Respuesta de la API:', $response);

            // Verificar si la respuesta contiene los datos esperados
            if (isset($response['nombres'])) {
                return response()->json([
                    'success' => true,
                    'nombres' => $response['nombres'],
                    'apellidoPaterno' => $response['apellidoPaterno'],
                    'apellidoMaterno' => $response['apellidoMaterno'],
                    'numeroDocumento' => $response['numeroDocumento'],
                    'digitoVerificador' => $response['digitoVerificador'],
                ]);
            } else {
                // Manejar caso donde no se encontraron datos
                return response()->json(['success' => false, 'message' => $response['message'] ?? 'No se encontraron datos.']);
            }
        } catch (\Exception $e) {
            Log::error('Error en la consulta:', ['message' => $e->getMessage()]);
            return response()->json(['success' => false, 'message' => 'Error en la consulta: ' . $e->getMessage()]);
        }
    }
}
