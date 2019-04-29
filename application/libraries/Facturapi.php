<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

/*
 * Librería de timbrado versión 3.3 API www.facturadigital.com.mx
 * Si utilizas Composer, deberás agregar la referencia de Guzzle de la siguiente manera:
 *
 *   "require": {
 *      "guzzlehttp/guzzle": "@stable"
 *   }
 *
 * De lo contrario, deberás descargar Guzzle (https://github.com/guzzle/guzzle) y descomprimirlo en la carpeta third_party
 * y posteriormente referenciarlo desde aquí.
 *
 * */

use GuzzleHttp\Client;
use GuzzleHttp\Psr7;
use GuzzleHttp\Exception\RequestException;

class Facturapi {

    protected $CI;
    private $client;
    private $api_usuario;
    private $api_password;

    public function __construct()
    {
        // Assign the CodeIgniter super-object
        $this->CI =& get_instance();

        $endpoint = 'https://app.facturadigital.com.mx/api/';
        $this->CI->api_usuario  = "demo33"; # usuario de la API (registrado en app.facturadigital.com.mx/registro)
        $this->CI->api_password = "demo"; # contraseña

        // $this->CI->api_usuario  = "AMM1406102C2"; # usuario de la API (registrado en app.facturadigital.com.mx/registro)
        // $this->CI->api_password = "11620157"; # contraseña

        # crea el cliente
        $this->CI->client = new GuzzleHttp\Client([
        	'base_uri' => $endpoint
        ]);
    }

    /**
     * @param array $d datos del CFDI en formato array
     * @param string $endpoint
     * @return mixed
     * @throws Exception
     */
    public function generar_cfdi( $d = array(), $endpoint = 'cfdi/generar' ) {
    	try {

			$cli = $this->CI->client;
			$headers = [
				'Accept' 		=> 'application/json',
				'api-usuario' 	=> $this->CI->api_usuario,
				'api-password' 	=> $this->CI->api_password
			];

			$response = $cli->request('POST', $endpoint, [
					'headers' => $headers,
					'form_params' => [
					'jsoncfdi' => json_encode($d)
					]
				]
			);
			
			$code 			= $response->getStatusCode(); # 200
			$reason 		= $response->getReasonPhrase(); # OK
			$json_response 	= json_decode($response->getBody()); # obtenemos la respuesta de timbrado

			if ( $code == 200 ) {
				return $json_response->cfdi;
			} else {
				throw new Exception( $json_response->mensaje , 1);
			}

    	} catch (RequestException $e) {

    		# loggeamos en base de datos y/o enviamos este error por mail al administrador
			$stringPeticion = Psr7\str($e->getRequest());

			# obtenemos la respuesta
			if ($e->hasResponse()) {
				$error_response = json_decode( $e->getResponse()->getBody()->getContents() );
				throw new Exception( $error_response->mensaje . "<br><small>Excepción en el método de Timbrado (1)</small>", 1);
			}
    	} catch (Exception $e) {
    		throw new Exception( $e->getMessage() . "<br><small>Excepción en el método de Timbrado (2)</small>" , 1);
    	}
    }


    /**
     * @param $uuid
     * @return mixed
     * @throws Exception
     */
    public function cancelar_cfdi( $uuid ) {
    	try {

			$cli = $this->CI->client;

			$headers = [
				'Accept' 		=> 'application/json',
				'api-usuario' 	=> $this->CI->api_usuario,
				'api-password' 	=> $this->CI->api_password,
				'uuid' 			=> $uuid
			];

			$response = $cli->request('POST', 'cfdi/cancelar', 
				['headers' => $headers]
			);
			
			$code 			= $response->getStatusCode(); # 200
			$reason 		= $response->getReasonPhrase(); # OK
			$json_response 	= json_decode($response->getBody()); # obtenemos la respuesta de cancelacion

			if ( $code == 200 ) {
				return $json_response;
			} else {
				throw new Exception( $json_response->mensaje , 1);
			}

    	} catch (RequestException $e) {

    		# loggeamos en base de datos y/o enviamos este error por mail al administrador
			$errorTimbreMail = Psr7\str($e->getRequest());

			# obtenemos la respuesta
			if ($e->hasResponse()) {
				$error_response = json_decode( $e->getResponse()->getBody()->getContents() );
				throw new Exception( $error_response->mensaje . "<br><small>RequestExceptionRest_Client (Cancelacion)</small>", 1);
			}
    	} catch (Exception $e) {
    		throw new Exception( $e->getMessage() . "<br><small>ExceptionREST_Client (Cancelacion)</small>" , 1);
    	}
    }

    /**
     * @param $uuid
     * @param $destinatario
     * @param $cco
     * @param $mensaje
     * @return mixed
     * @throws Exception
     */
    public function enviar_cfdi( $uuid, $destinatario, $cco, $mensaje ) {
    	try {

			$cli = $this->CI->client;

			$headers = [
				'Accept' 		=> 'application/json',
				'api-usuario' 	=> $this->CI->api_usuario,
				'api-password' 	=> $this->CI->api_password,
				'uuid' 			=> $uuid,
				'destinatario'	=> $destinatario,
				'cco'			=> $cco,
				'mensaje'		=> $mensaje
			];

			$response = $cli->request('POST', 'cfdi/correo', 
				['headers' => $headers]
			);
			
			$code 			= $response->getStatusCode(); # 200
			$reason 		= $response->getReasonPhrase(); # OK
			$json_response 	= json_decode($response->getBody()); # obtenemos la respuesta de cancelacion

			if ( $code == 200 ) {
				return $json_response;
			} else {
				throw new Exception( $json_response->mensaje , 1);
			}

    	} catch (RequestException $e) {

    		# loggeamos en base de datos y/o enviamos este error por mail al administrador
			$errorGuzzleMail = Psr7\str($e->getRequest());

			# obtenemos la respuesta
			if ($e->hasResponse()) {
				$error_response = json_decode( $e->getResponse()->getBody()->getContents() );
				throw new Exception( $error_response->mensaje . "<br><small>RequestExceptionRest_Client (Correo)</small>", 1);
			}
    	} catch (Exception $e) {
    		throw new Exception( $e->getMessage() . "<br><small>ExceptionREST_Client (Correo)</small>" , 1);
    	}
    }

    public function consultarCreditos() 
    {
    	try {
    		$cli = $this->CI->client;
			# preparamos las credenciales
			$headers = [
				'Accept' 		=> 'application/json',
				'api-usuario' 	=> $this->CI->api_usuario,
				'api-password' 	=> $this->CI->api_password
			];

			$response = $cli->request('POST', 'cfdi/creditos', 
				['headers' => $headers]
			);

			# hacemos la petición y enviamos los parametros
			$code 			= $response->getStatusCode(); # 200
			$reason 		= $response->getReasonPhrase(); # OK
			$json_response 	= json_decode($response->getBody()); # obtenemos la respuesta de cancelacion

			# si la respuesta es exitosa
			if ( $code == 200 ) {
				
				$creditos_disponibles = $json_response->creditos;

				if ( $creditos_disponibles < 100000 ) {
					return $creditos_disponibles;
					// echo "<script>";
					// echo "alert('ALERTA!! Tus timbres están por agotarse!! '); ";
					// echo "</script>";
				}
				
			} else {
				# imprimimos la respuesta (JSON)
				echo $response->raw_body;
			}

		} catch (Exception $e) {
			echo $e->getMessage();
		}
    }

}