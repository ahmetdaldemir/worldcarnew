<?php namespace App\Abstracts;

use App\Models\RemoteApiLog;
use App\Traits\HasErrors;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\BadResponseException;
use GuzzleHttp\Exception\ClientException;
use SoapClient;
use SoapHeader;

class RemoteRestRequest
{
    use HasErrors;

    protected $statusCode = 200;
    protected $errorMessage = '';
    protected $result = true;

    protected $content;
    protected $log;

    protected $base_uri;
    protected $type;
    protected $path;
    protected $method = 'GET';
    protected $options;

    public function __construct()
    {
        $this->prepareRequest();
        $log = new RemoteApiLog();
        $log->user_id = auth()->id() ?? 0;
        $log->request_class = static::class;
        $log->remote_path = $this->base_uri . '/' . $this->path;

        $requestObjectForLog = $this->options;
        if (
            isset($requestObjectForLog['headers'], $requestObjectForLog['headers']['content-type'])
            && $requestObjectForLog['headers']['content-type'] == 'application/json'
        ) {
            if (isset($requestObjectForLog['body'])) {
                $requestObjectForLog['body'] = json_decode($requestObjectForLog['body']);
            }
        }

        $log->request = json_encode($requestObjectForLog);
        $log->save();

        try {
            if ($this->type == 'soap') {
                $headers = $requestObjectForLog['headers'];
                $auth = $requestObjectForLog['auth'];

                $connection = $this->connect($auth, $headers, $this->base_uri . $this->uri);

                $method = $this->path;
                $params = $this->objToArray(json_decode($this->body, true));

                $response = $connection->{$method}($params);

                $this->setContent($response);
                $this->setStatusCode($this->soapStatusCode($connection));
            } else {

                $client = new Client(['base_uri' => $this->base_uri]);
                $response = $client->request($this->method, $this->path, $this->options);
                $this->setContent($response->getBody()->getContents());
                $this->setStatusCode($response->getStatusCode());
            }
        } catch (ClientException $exception) {
            $this->addError($exception->getMessage());
            $this->setStatusCode($exception->getResponse()->getStatusCode());
            $this->setContent($exception->getResponse()->getBody()->getContents());
        } catch (BadResponseException $exception) {
            $this->addError($exception->getMessage());
            $this->setStatusCode($exception->getResponse()->getStatusCode());
            $this->setContent($exception->getResponse()->getBody()->getContents());
        } catch (\Exception $exception) {
            $this->addError($exception->getMessage(), $exception->getTrace());
            $this->setStatusCode(404);
        }

        $log->response = $this->ensureJson($this->getContent());

        $log->http_status = $this->getStatusCode() ?? 0;


        if ($this->hasErrors()) {
            $log->failed = true;
            $log->errors = json_encode($this->getErrors());
            $this->onError();
        } else {
            $log->failed = false;
            $this->onSuccess();
        }


        $log->save();
        $this->setLog($log);
        $this->onComplete();
    }

    public function __destruct()
    {
        if ($this->hasErrors()) {
            $errors = json_encode($this->getErrors(), JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
            SendAlert::dev("Request (log id: {$this->log->id}) ended with errors: " . $errors);
        }
    }

    /**
     * @return mixed
     */
    public function getStatusCode()
    {
        return $this->statusCode;
    }

    /**
     * @return mixed
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * Return the log Model for the request.
     */
    public function getLog(): ?RemoteApiLog
    {
        return $this->log;
    }


    public function connect($auth, $headers, $base_uri): SoapClient
    {
        $opts = [
            'ssl' => ['verify_peer' => false, 'verify_peer_name' => false],
        ];
        $client = new SoapClient($base_uri, ['trace' => 1, 'exceptions' => 0, 'stream_context' => stream_context_create($opts)]);
        $AuthHeader = $auth;
        $header = new SoapHeader($headers['url'], $headers['Authentication'], $AuthHeader, false);
        $client->__setSoapHeaders([$header]);
        return $client;
    }
    private function soapStatusCode(SoapClient $client){
        $clientHeader = $client->__getLastResponseHeaders();
        preg_match("/HTTP\/\d\.\d\s*\K[\d]+/", $clientHeader,$matches);
        return $matches[0];
    }

    protected function onSuccess(): void
    {
    }

    protected function onError(): void
    {
    }

    protected function onComplete(): void
    {
    }

    protected function prepareRequest(): void
    {
    }

    protected function objToArray($obj)
    {
        if (!is_object($obj) && !is_array($obj)) {
            return $obj;
        }
        foreach ($obj as $key => $value) {
            $arr[$key] = $this->objToArray($value);
        }

        return $arr;
    }


    private function ensureJson($input)
    {
        if (
            is_string($input)
            && (
                $input == 'null'
                || json_decode($input) !== null
            )
        ) {
            return $input;
        }

        return json_encode($input);
    }

    /**
     * @param mixed $statusCode
     */
    private function setStatusCode($statusCode): void
    {
        $this->statusCode = $statusCode;
    }

    /**
     * @param mixed $content
     */
    private function setContent($content): void
    {
        $this->content = $content;
    }

    /**
     * @param null $log
     */
    private function setLog($log): void
    {
        $this->log = $log;
    }
}
