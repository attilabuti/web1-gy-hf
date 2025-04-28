<?php

class Response {
    protected array  $headers    = [];
    protected string $body       = '';
    protected int    $statusCode = 200;
    protected bool   $isRedirect = false;

    public function addHeader(string $name, string $value) : void {
        $this->headers[$name] = $value;
    }

    public function body(string $content) : void {
        $this->body = $content;
    }

    protected function setDefaultHeaders() : void {
        if (empty($this->headers) && !$this->isRedirect) {
            $this->addHeader('Content-Type', 'text/html; charset=UTF-8');
            $this->addHeader('Cache-Control', 'no-cache, no-store, must-revalidate');
            $this->addHeader('Pragma', 'no-cache');
            $this->addHeader('Expires', '0');
        }

        $this->addHeader('Content-Length', (string) strlen($this->body));
    }

    public function setStatusCode(int $code): void {
        $this->statusCode = $code;
    }

    protected function sendHeaders() : void {
        http_response_code($this->statusCode);

        foreach ($this->headers as $name => $value) {
            header("$name: $value");
        }
    }

    public function redirect(string $url, int $statusCode = 302): void {
        $this->isRedirect = true;

        http_response_code($statusCode);
        header('Location: ' . $url);

        exit;
    }

    public function send() : void {
        $this->setDefaultHeaders();
        $this->sendHeaders();

        if (!$this->isRedirect) {
            echo $this->body;
        }
    }
}
