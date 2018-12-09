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
     * @param $login string
     * @param $email string
     * @param $password string
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
     * @param $theme_title string
     * @param $theme_description string
     * @param $person array
     * @throws Exception
     */
    public function insertThemeByPerson($theme_title, $theme_description, $person) {
        try {
            $result = $this->pdo->prepare(
                "INSERT INTO `forum`.`theme` (userId, title, description)
              VALUES (:userId, :title, :description)"
            );
            $result->bindParam(":userId", $person['id'], PDO::PARAM_INT);
            $result->bindParam(":title", $theme_title, PDO::PARAM_STR);
            $result->bindParam(":description", $theme_description, PDO::PARAM_STR);
            $result->execute();
        } catch (PDOException $exception) {
            throw new Exception('Не удалось выполнить добавление темы', 2);
        }
    }

    public function insertMessageByPerson($message, $theme_id, $person) {
        try {
            $result = $this->pdo->prepare(
                "INSERT INTO `forum`.`message` (userId, themeId, text)
              VALUES (:userId, :themeId, :text)"
            );
            $result->bindParam(":userId", $person['id'], PDO::PARAM_INT);
            $result->bindParam(":themeId", $theme_id, PDO::PARAM_STR);
            $result->bindParam(":text", $message, PDO::PARAM_STR);
            $result->execute();

            return $this->getMessageById($this->pdo->lastInsertId());
        } catch (PDOException $exception) {
            throw new Exception('Не удалось выполнить добавление сообщения', 2);
        }
    }

    /**
     * @param $email string
     * @param $password string
     * @return string
     * @throws Exception
     */
    public function selectLogin($email, $password) {
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
     * @param $login string
     * @return array
     * @throws Exception
     */
    public function getPersonByLogin($login) {
        $result = $this->pdo->prepare(
            "SELECT id, login, email, description, createdAt FROM `forum`.`user` WHERE login = :login"
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
     * @param $id int
     * @return array
     * @throws Exception
     */
    public function getPersonById($id) {
        $result = $this->pdo->prepare(
            "SELECT id, login, email, description, createdAt FROM `forum`.`user` WHERE id = :id"
        );
        $result->bindParam(":id", $id, PDO::PARAM_INT);
        $result->execute();
        $person = $result->fetchAll(PDO::FETCH_ASSOC);

        if (empty($person) || !isset($person[0]['login'])) {
            throw new Exception('Пользователь не найден');
        }

        return $person[0];
    }

    /**
     * @return array
     * @throws Exception
     */
    public function getAllThemes() {
        $result = $this->pdo->prepare(
            "SELECT u.login, t.id, t.title, t.createdAt FROM `forum`.`theme` t
                INNER JOIN `forum`.`user` u ON t.userId = u.id
                WHERE t.status = 'opened'"
        );
        $result->execute();
        $themes = $result->fetchAll(PDO::FETCH_ASSOC);

        if (empty($themes) || !isset($themes[0]['login'])) {
            throw new Exception('Пользователь не найден');
        }

        return $themes;
    }

    /**
     * @param $id
     * @return array
     * @throws Exception
     */
    public function getThemeById($id) {
        $result = $this->pdo->prepare(
            "SELECT t.id, userId, u.login, title, t.description, t.createdAt FROM `forum`.`theme` t
              INNER JOIN `forum`.`user` u ON t.userId = u.id
            WHERE t.id = :id"
        );
        $result->bindParam(":id", $id, PDO::PARAM_INT);
        $result->execute();
        $theme = $result->fetchAll(PDO::FETCH_ASSOC);

        if (empty($theme) || !isset($theme[0]['id'])) {
            throw new Exception('Тема не найден');
        }

        return $theme[0];
    }

    public function getMessageById($id) {
        $result = $this->pdo->prepare(
            "SELECT id, userId, themeId, text, createdAt FROM `forum`.`message`
            WHERE id = :id"
        );
        $result->bindParam(":id", $id, PDO::PARAM_INT);
        $result->execute();
        $msg = $result->fetchAll(PDO::FETCH_ASSOC);

        if (empty($msg) || !isset($msg[0]['id'])) {
            throw new Exception('Сообщение не найдено');
        }

        return $msg[0];
    }

    public function getMessagesByThemeId($themeId) {
        $result = $this->pdo->prepare(
            "SELECT id, userId AS user, themeId, text, createdAt FROM `forum`.`message`
            WHERE themeId = :themeId"
        );
        $result->bindParam(":themeId", $themeId, PDO::PARAM_INT);
        $result->execute();
        $messages = $result->fetchAll(PDO::FETCH_ASSOC);

        foreach ($messages as &$message) {
            $message['user'] = $this->getPersonById($message['user']);
        }

        return $messages;
    }

    /**
     * @param $password string
     * @return bool|string
     */
    function getHash($password) {
        return password_hash($password, PASSWORD_DEFAULT, ['salt' => self::PASSPHRASE]);
    }
}