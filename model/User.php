<?
class User {
    public $id;
    public $login;
    public $password;
    public $location;

    public static function find_all() {
        $users = array();
        $result = mysql_query("SELECT * FROM USERS") or die(mysql_error());
        while ($raw = mysql_fetch_array($result)) {
            $user = new User();
            $user->id = $raw["id"];
            $user->login = $raw["login"];
            $user->password = $raw["password"];
            $user->location = $raw["location"];
            $users[] = $user;
        }
        return $users;
    }

    public static function find_by_login($login) {
        $result = mysql_query("SELECT * FROM users WHERE login='$login'") or die(mysql_error());
        if (mysql_num_rows($result) == 0) {
            return null;
        }
        $raw = mysql_fetch_array($result);
        $user = new User();
        $user->id = $raw["id"];
        $user->login = $raw["login"];
        $user->password = $raw["password"];
        $user->location = $raw["location"];
        return $user;
    }

    public static function find($id) {
        $result = mysql_query("SELECT * FROM users WHERE id='$id'");
        if (mysql_num_rows($result) == 0) {
            return null;
        }
        $raw = mysql_fetch_array($result);
        $user = new User();
        $user->id = $raw["id"];
        $user->login = $raw["login"];
        $user->password = $raw["password"];
        $user->location = $raw["location"];
        return $user;
    }

    public static function create($login, $password) {
        mysql_query("INSERT INTO users VALUES (0, '$login', '$password', null)") or die(mysql_error());
    }

    public function save() {
        mysql_query("UPDATE users SET login='$this->login', password='$this->password', location='$this->location'
            WHERE id='$this->id'");
    }

    public function get_messages($recipient_id) {
        $result = mysql_query("SELECT * FROM messages WHERE author_id='$this->id' AND recipient_id='$recipient_id'
                               UNION ALL
                               SELECT * FROM messages WHERE author_id='$recipient_id' AND recipient_id='$this->id'
                               ORDER BY id");
        $messages = array();
        while ($raw = mysql_fetch_array($result)) {
            $message = new Message();
            $message->id = $raw["id"];
            $message->text = $raw["text"];
            $message->author_id = $raw["author_id"];
            $message->recipient_id = $raw["recipient_id"];
            $messages[] = $message;
        }
        return $messages;
    }
}
?>
