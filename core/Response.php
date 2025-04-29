<?php

class Response {

    protected array  $headers    = [];
    protected string $body       = '';
    protected int    $statusCode = 200;
    protected bool   $isRedirect = false;

    public function addHeader(string $name, string $value) : Response {
        $this->headers[$name] = $value;

        return $this;
    }

    public function markup(string $content) : Response {
        $this->addHeader('Content-Type', 'text/html; charset=UTF-8');
        $this->addCacheControl();
        $this->body($content);

        return $this;
    }

    public function plain(string $content) : Response {
        $this->addHeader('Content-Type', 'text/plain; charset=UTF-8');
        $this->addCacheControl();
        $this->body($content);

        return $this;
    }

    public function body(string $content) : Response {
        $this->body = $content;

        return $this;
    }

    protected function addCacheControl() : void {
        $this
            ->addHeader('Cache-Control', 'no-cache, no-store, must-revalidate')
            ->addHeader('Pragma', 'no-cache')
            ->addHeader('Expires', '0');
    }

    public function setStatusCode(int $code) : Response {
        $this->statusCode = $code;

        return $this;
    }

    protected function sendHeaders() : void {
        http_response_code($this->statusCode);

        foreach ($this->headers as $name => $value) {
            header("$name: $value");
        }
    }

    public function redirect(string $url, int $statusCode = 302) : void {
        $this->isRedirect = true;

        http_response_code($statusCode);
        header('Location: ' . $url);

        exit;
    }

    public function send() : void {
        $this->addHeader('Content-Length', (string) strlen($this->body));
        $this->sendHeaders();

        if (!$this->isRedirect) {
            echo $this->body;
        }
    }

}
