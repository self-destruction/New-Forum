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
            $stmt = $this->pdo->prepare(
                "INSERT INTO `forum`.`user` (login, email, hash)
              VALUES (:login, :email, :hash)"
            );
            $stmt->bindParam(":login", $login, PDO::PARAM_STR);
            $stmt->bindParam(":email", $email, PDO::PARAM_STR);
            $stmt->bindParam(":hash", $hash, PDO::PARAM_STR);
            $stmt->execute();
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
            $stmt = $this->pdo->prepare(
                "INSERT INTO `forum`.`theme` (userId, title, description)
              VALUES (:userId, :title, :description)"
            );
            $stmt->bindParam(":userId", $person['id'], PDO::PARAM_INT);
            $stmt->bindParam(":title", $theme_title, PDO::PARAM_STR);
            $stmt->bindParam(":description", $theme_description, PDO::PARAM_STR);
            $stmt->execute();
        } catch (PDOException $exception) {
            throw new Exception('Не удалось выполнить добавление темы', 2);
        }
    }

    /**
     * @param $message
     * @param $theme_id
     * @param $person
     * @return array
     * @throws Exception
     */
    public function insertMessageByPerson($message, $theme_id, $person) {
        try {
            $stmt = $this->pdo->prepare(
                "INSERT INTO `forum`.`message` (userId, themeId, text)
              VALUES (:userId, :themeId, :text)"
            );
            $stmt->bindParam(":userId", $person['id'], PDO::PARAM_INT);
            $stmt->bindParam(":themeId", $theme_id, PDO::PARAM_STR);
            $stmt->bindParam(":text", $message, PDO::PARAM_STR);
            $stmt->execute();

            return $this->getMessageById($this->pdo->lastInsertId());
        } catch (PDOException $exception) {
            throw new Exception('Не удалось выполнить добавление сообщения', 2);
        }
    }

    /**
     * @param $theme_id
     */
    public function incrementThemeViewsById($theme_id) {
        $stmt = $this->pdo->prepare(
            "UPDATE `forum`.`theme` SET views = views + 1
              WHERE id = :theme_id"
        );
//        $stmt->bindParam(":theme_id", $theme_id, PDO::PARAM_INT);
        $stmt->execute(['theme_id' => $theme_id]);
    }

    /**
     * @param $email string
     * @param $password string
     * @return string
     * @throws Exception
     */
    public function selectLogin($email, $password) {
        $hash = $this->getHash($password);

        $stmt = $this->pdo->prepare(
            "SELECT login FROM `forum`.`user` WHERE email = :email AND hash = :hash"
        );
        $stmt->bindParam(":email", $email, PDO::PARAM_STR);
        $stmt->bindParam(":hash", $hash, PDO::PARAM_STR);
        $stmt->execute();
        $user = $stmt->fetchAll(PDO::FETCH_ASSOC);

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
        $stmt = $this->pdo->prepare(
            "SELECT id, login, email, description, createdAt FROM `forum`.`user` WHERE login = :login"
        );
        $stmt->bindParam(":login", $login, PDO::PARAM_STR);
        $stmt->execute();
        $person = $stmt->fetchAll(PDO::FETCH_ASSOC);

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
        $stmt = $this->pdo->prepare(
            "SELECT id, login, email, description, createdAt FROM `forum`.`user` WHERE id = :id"
        );
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        $stmt->execute();
        $person = $stmt->fetchAll(PDO::FETCH_ASSOC);

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
        $stmt = $this->pdo->prepare(
            "SELECT u.login, t.id, t.title, t.createdAt, t.views,
                  (SELECT COUNT(id) + 1 FROM `forum`.`message` m WHERE m.themeId = t.id) AS `answers` 
                FROM `forum`.`theme` t
                  INNER JOIN `forum`.`user` u ON t.userId = u.id
                WHERE t.status = 'opened'"
        );
        $stmt->execute();
        $themes = $stmt->fetchAll(PDO::FETCH_ASSOC);

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
        $stmt = $this->pdo->prepare(
            "SELECT t.id, userId, u.login, title, t.description, t.createdAt FROM `forum`.`theme` t
              INNER JOIN `forum`.`user` u ON t.userId = u.id
            WHERE t.id = :id"
        );
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        $stmt->execute();
        $theme = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if (empty($theme) || !isset($theme[0]['id'])) {
            throw new Exception('Тема не найден');
        }

        return $theme[0];
    }

    /**
     * @param $id
     * @return array
     * @throws Exception
     */
    public function getMessageById($id) {
        $stmt = $this->pdo->prepare(
            "SELECT id, userId, themeId, text, createdAt FROM `forum`.`message`
            WHERE id = :id"
        );
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        $stmt->execute();
        $msg = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if (empty($msg) || !isset($msg[0]['id'])) {
            throw new Exception('Сообщение не найдено');
        }

        return $msg[0];
    }

    /**
     * @param $themeId
     * @return array
     * @throws Exception
     */
    public function getMessagesByThemeId($themeId) {
        $stmt = $this->pdo->prepare(
            "SELECT id, userId AS user, themeId, text, createdAt FROM `forum`.`message`
            WHERE themeId = :themeId"
        );
        $stmt->bindParam(":themeId", $themeId, PDO::PARAM_INT);
        $stmt->execute();
        $messages = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if ($messages) {
            foreach ($messages as &$message) {
                $message['user'] = $this->getPersonById($message['user']);
            }
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