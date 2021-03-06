<?php

$app->post('/api/500px/getAccessToken', function ($request, $response) {

    $settings = $this->settings;
    $checkRequest = $this->validation;
    $validateRes = $checkRequest->validate($request, ['apiKey', 'apiSecret', 'token', 'tokenSecret', 'username', 'password']);

    if (!empty($validateRes) && isset($validateRes['callback']) && $validateRes['callback'] == 'error') {
        return $response->withHeader('Content-type', 'application/json')->withStatus(200)->withJson($validateRes);
    } else {
        $post_data = $validateRes;
    }

    $requiredParams = ['apiKey' => 'apiKey', 'apiSecret' => 'apiSecret', 'token' => 'token', 'tokenSecret' => 'tokenSecret', 'username' => 'x_auth_username', 'password' => 'x_auth_password', 'x_auth_mode' => 'x_auth_mode'];
    $optionalParams = [];
    $bodyParams = [
        'form_params' => ['x_auth_username', 'x_auth_password', 'x_auth_mode']
    ];
    $data = \Models\Params::createParams($requiredParams, $optionalParams, $post_data['args']);
    $data['x_auth_mode'] = 'client_auth';
    $stack = GuzzleHttp\HandlerStack::create();
    $middleware = new GuzzleHttp\Subscriber\Oauth\Oauth1([
        'consumer_key' => $data['apiKey'],
        'consumer_secret' => $data['apiSecret'],
        'token' => $data['token'],
        'token_secret' => $data['tokenSecret']
    ]);

    $stack->push($middleware);
    $client = new GuzzleHttp\Client([
        'handler' => $stack,
        'auth' => 'oauth'
    ]);

    $requestParams = \Models\Params::createRequestBody($data, $bodyParams);
    $query_str = "https://api.500px.com/v1/oauth/access_token";

    try {
        $resp = $client->post($query_str, $requestParams);
        $responseBody = $resp->getBody()->getContents();

        if (in_array($resp->getStatusCode(), ['200', '201', '202', '203', '204'])) {
            $result['callback'] = 'success';
            $output = explode('&', $responseBody);
            foreach ($output as $value) {
                $line = explode('=', $value);
                $finalResponse[$line[0]] = $line[1];
            }
            $result['contextWrites']['to'] = $finalResponse;
            if (empty($result['contextWrites']['to'])) {
                $result['contextWrites']['to']['status_msg'] = "Api return no results";
            }
        } else {
            $result['callback'] = 'error';
            $result['contextWrites']['to']['status_code'] = 'API_ERROR';
            $result['contextWrites']['to']['status_msg'] = json_decode($responseBody);
        }

    } catch (\GuzzleHttp\Exception\ClientException $exception) {

        $responseBody = $exception->getResponse()->getBody()->getContents();
        $responseBody = $exception->getMessage();
        if (empty(json_decode($responseBody))) {
            $out = $responseBody;
        } else {
            $out = json_decode($responseBody);
        }
        $result['callback'] = 'error';
        $result['contextWrites']['to']['status_code'] = 'API_ERROR';
        $result['contextWrites']['to']['status_msg'] = $out;

    } catch (GuzzleHttp\Exception\ServerException $exception) {

        $responseBody = $exception->getResponse()->getBody()->getContents();
        if (empty(json_decode($responseBody))) {
            $out = $responseBody;
        } else {
            $out = json_decode($responseBody);
        }
        $result['callback'] = 'error';
        $result['contextWrites']['to']['status_code'] = 'API_ERROR';
        $result['contextWrites']['to']['status_msg'] = $out;

    } catch (GuzzleHttp\Exception\ConnectException $exception) {
        $result['callback'] = 'error';
        $result['contextWrites']['to']['status_code'] = 'INTERNAL_PACKAGE_ERROR';
        $result['contextWrites']['to']['status_msg'] = 'Something went wrong inside the package.';

    }

    return $response->withHeader('Content-type', 'application/json')->withStatus(200)->withJson($result);

});