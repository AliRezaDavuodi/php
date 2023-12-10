<?php
class Controller
{
    public function view($name, $data = [])
    {
        $path = 'View/' . $name . '.php';
        if (!file_exists($path)) {
            throw new Exception('Model Is Not exist');
        }

        require($path);
    }
}
