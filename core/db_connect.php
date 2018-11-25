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
        $this->pdo = new PDO(
            'mysql:host=127.0.0.1;port=3307;dbname=forum',
            'forum_user',
            'forum_user',
            [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
        );
    }

    /**
     * @param $login
     * @param $email
     * @param $password
     * @throws Exception
     */
    public function insertUser($login, $email, $password) {
        try {
            $hash = $this->getHash($password);
            $result = $this->pdo->prepare(
                "INSERT INTO `forum`.`user` (login, email, hash)
              VALUES (:login, :email, :hash)"
            );
            $result->bindParam(":login", $login, PDO::PARAM_STR);
            $result->bindParam(":email", $email, PDO::PARAM_STR);
            $result->bindParam(":hash", $hash, PDO::PARAM_STR);
            $result->execute();
        } catch (PDOException $exception) {
            throw new Exception('Не удалось выполнить добавление такого пользователя', 2);
        }
    }

    /**
     * @param $email
     * @param $password
     * @return string
     * @throws Exception
     */
    function selectLogin($email, $password) {
        $hash = $this->getHash($password);

        $result = $this->pdo->prepare(
            "SELECT login FROM `forum`.`user` WHERE email = :email AND hash = :hash"
        );
        $result->bindParam(":email", $email, PDO::PARAM_STR);
        $result->bindParam(":hash", $hash, PDO::PARAM_STR);
        $result->execute();
        $user = $result->fetchAll(PDO::FETCH_ASSOC);

        if (empty($user) || !isset($user[0]['login'])) {
            throw new Exception('Пользователь не найден', 2);
        }

        return $user[0]['login'];
    }

    /**
     * @param $login
     * @return array
     * @throws Exception
     */
    function getPersonByLogin($login) {
        $result = $this->pdo->prepare(
            "SELECT login, email, description, createdAt FROM `forum`.`user` WHERE login = :login"
        );
        $result->bindParam(":login", $login, PDO::PARAM_STR);
        $result->execute();
        $person = $result->fetchAll(PDO::FETCH_ASSOC);

        if (empty($person) || !isset($person[0]['login'])) {
            throw new Exception('Пользователь не найден');
        }

        return $person[0];
    }

    /**
     * @param $password
     * @return bool|string
     */
    function getHash($password) {
        return password_hash($password, PASSWORD_DEFAULT, ['salt' => self::PASSPHRASE]);
    }
}