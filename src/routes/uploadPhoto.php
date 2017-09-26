<?php

$app->post('/api/500px/uploadPhoto', function ($request, $response) {

    $settings = $this->settings;
    $checkRequest = $this->validation;
    $validateRes = $checkRequest->validate($request, ['apiKey', 'token', 'uploadKey', 'photoId', 'file', 'name', 'description', 'category']);

    if (!empty($validateRes) && isset($validateRes['callback']) && $validateRes['callback'] == 'error') {
        return $response->withHeader('Content-type', 'application/json')->withStatus(200)->withJson($validateRes);
    } else {
        $post_data = $validateRes;
    }

    $requiredParams = ['apiKey' => 'consumer_key', 'token' => 'access_key', 'uploadKey' => 'upload_key', 'photoId' => 'photo_id',
        'file' => 'file', 'name' => 'name', 'description' => 'description', 'category' => 'category'];
    $optionalParams = ['shutterSpeed' => 'shutter_speed', 'focalLength' => 'focal_length', 'aperture' => 'aperture', 'iso' => 'iso',
        'camera' => 'camera', 'lens' => 'lens', 'coordinates' => 'coordinates', 'privacy' => 'privacy', 'crop' => 'crop'];


    $data = \Models\Params::createParams($requiredParams, $optionalParams, $post_data['args']);
    $body[] = [
        'name' => 'photo_id',
        'contents' => $post_data['args']['photoId']
    ];
    $body[] = [
        'name' => 'file',
        'contents' => fopen($post_data['args']['file'], 'r')
    ];
    $body[] = [
        'name' => 'name',
        'contents' => $post_data['args']['name']
    ];
    $body[] = [
        'name' => 'description',
        'contents' => $post_data['args']['description']
    ];
    $body[] = [
        'name' => 'category',
        'contents' => $post_data['args']['category']
    ];
    $body[] = [
        'name' => 'shutterSpeed',
        'contents' => $post_data['args']['shutter_speed']
    ];
    $body[] = [
        'name' => 'focalLength',
        'contents' => $post_data['args']['focal_length']
    ];
    $body[] = [
        'name' => 'aperture',
        'contents' => $post_data['args']['aperture']
    ];
    $body[] = [
        'name' => 'camera',
        'contents' => $post_data['args']['camera']
    ];
    $body[] = [
        'name' => 'lens',
        'contents' => $post_data['args']['lens']
    ];
    $body[] = [
        'name' => 'latitude',
        'contents' => explode(',', $post_data['args']['coordinates'])[0]
    ];
    $body[] = [
        'name' => 'longitude',
        'contents' => explode(',', $post_data['args']['coordinates'])[1]
    ];
    $body[] = [
        'name' => 'privacy',
        'contents' => $post_data['args']['privacy']
    ];
    $body[] = [
        'name' => 'privacy',
        'contents' => $post_data['args']['crop']
    ];
    $body[] = [
        'name' => 'consumer_key',
        'contents' => $post_data['args']['apiKey']
    ];
    $body[] = [
        'name' => 'access_key',
        'contents' => $post_data['args']['token']
    ];

    $client = new GuzzleHttp\Client();
    $query_str = "https://upload.500px.com/v1/upload";

    $requestParam['multipart'] = $body;
    try {
        $resp = $client->post($query_str, $requestParam);
        $responseBody = $resp->getBody()->getContents();

        if (in_array($resp->getStatusCode(), ['200', '201', '202', '203', '204'])) {
            $result['callback'] = 'success';
            $result['contextWrites']['to'] = is_array($responseBody) ? $responseBody : json_decode($responseBody);
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