<?php

/**
 * Class db_connect
 */
class dbConnect {

    const PASSPHRASE = 'very_hard_phrase_ever!';
    /**
     * @var PDO
     */
    private $pdo;

    /**
     * db_connect constructor.
     */
    public function __construct()
    {
        try {
            $connection_string = "mysql:host=127.0.0.1;port=3307;dbname=forum";
            $this->pdo = new PDO(
                $connection_string,
                'forum_user',
                'forum_user',
                [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
            );
        } catch (PDOException $e) {
            echo "Невозможно установить соединение с базой данных\n{$e->getMessage()}";
        }
    }

    /**
     * @param $email
     * @param $login
     * @param $password
     * @return bool
     */
    public function insertUser($email, $login, $password) {
        try {
            $hash = $this->getHash($password);
            $result = $this->pdo->prepare(
                "INSERT INTO `forum`.`user` (email, login, hash)
                  VALUES (:email, :login, :hash)"
            );
            $result->bindParam(":email", $email, PDO::PARAM_STR);
            $result->bindParam(":login", $login, PDO::PARAM_STR);
            $result->bindParam(":hash", $hash, PDO::PARAM_STR);
            $isSuccess = $result->execute();

            if (!$isSuccess) {
                echo 'Не удалось выполнить добавление такого пользователя.';
            } else {
                return true;
            }
        } catch (Exception $exception) {
            echo "Не удалось выполнить запрос на добавление пользователя\n{$exception->getMessage()}";
        }
        return false;
    }

    /**
     * @param $email
     * @param $password
     * @return bool
     */
    function selectUser($email, $password) {
        $hash = $this->getHash($password);

        $result = $this->pdo->prepare(
            "SELECT id FROM `forum`.`user` WHERE email = :email AND hash = :hash"
        );
        $result->bindParam(":email", $email, PDO::PARAM_STR);
        $result->bindParam(":hash", $hash, PDO::PARAM_STR);
        $result->execute();
        $user = $result->fetchAll(PDO::FETCH_ASSOC);

        if (empty($user) || !isset($user[0]['id'])) {
            return false;
        } else {
            return true;
        }
    }

    /**
     * @param $password
     * @return bool|string
     */
    function getHash($password) {
        return password_hash($password, PASSWORD_DEFAULT, ['salt' => self::PASSPHRASE]);
    }
}