<?
class User {
    public $id;
    public $login;
    public $password;

    public static function find_all() {
        $users = array();
        $result = mysql_query("SELECT * FROM users") or die(mysql_error());
        while ($raw = mysql_fetch_array($result)) {
            $user = new User();
            $user->id = $raw["id"];
            $user->login = $raw["login"];
            $user->password = $raw["password"];
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
        return $user;
    }

    public static function create($login, $password) {
        mysql_query("INSERT INTO users VALUES (0, '$login', '$password')") or die(mysql_error());
    }

    public function save() {
        mysql_query("UPDATE users SET login='$this->login', password='$this->password'
            WHERE id='$this->id'");
    }
}
?>
