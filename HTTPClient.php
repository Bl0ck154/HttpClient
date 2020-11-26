<?php

class HTTPClient
{
    private string $host;
    private string $username;
    private string $password;

    // Написать класс HTTPClient, который в конструкторе принимает параметры: Адрес сервера, Имя пользователя, Пароль
    public function __construct(string $host, string $username, string $password)
    {
        $this->host = $host;
        $this->username = $username;
        $this->password = $password;
    }

    // Метод класса run, принимает параметры: Название метода, Параметры (объект)
    public function run(string $method, object $params) : object
    {
        // Метод использует curl для выполнения HTTP запроса.
       //$ch = curl_init($this->host . '/v3/' . $method); // Адрес запроса формируется следующим образом: http://адресСервера/v3/названиеМетода
        $ch = curl_init($this->host . '/' . $method);

        // Данные отправлять и получать в json
        $json = json_encode($params);

        $headers = [
            'Content-Type: application/json'
        ];

        curl_setopt_array($ch, [
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POST => true,
            CURLOPT_HTTPHEADER => $headers,
            CURLOPT_USERPWD => $this->username . ':' . $this->password, // Использовать basic авторизацию.
            CURLOPT_POSTFIELDS => $json
        ]);

        // Метод run() должен возвращать объект с результатом запроса и выводить в консоль
        $response = curl_exec($ch);
        curl_close($ch);
        return json_decode($response);
    }
}