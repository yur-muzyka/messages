<?
class User {
    public $id;
    public $login;
    public $password;

    public static function find_all() {
        $users = array();
        $result = mysql_query("SELECT * FROM USERS") or die(mysql_error());
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
        $result = mysql_query("SELECT * FROM USERS WHERE login='$login'") or die(mysql_error());
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
        mysql_query("INSERT INTO USERS VALUES (0, '$login', '$password')") or die(mysql_error());
    }
}
?>
