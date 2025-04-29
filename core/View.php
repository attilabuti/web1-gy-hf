<?php

class View {

    public static function render(string $template, array $data = []): string {
        $template = self::getView($template);

        extract($data, EXTR_SKIP);

        ob_start();

        try {
            require $template;
        } catch (\Throwable $e) {
            ob_end_clean();
            throw $e;
        }

        return ob_get_clean();
    }

    private static function getView(string $view)  {
        $ext = (string) Config::get('app.views.ext', '.view.php');
        if (strpos($view, $ext) === false) {
            $view .= $ext;
        }

        $viewPath = Path::join(Path::base(), Config::get('app.views.path', 'app/View/'), $view);

        if (!file_exists($viewPath)) {
            throw new Exception("The file $view could not be found.");
        }

        return $viewPath;
    }

}
