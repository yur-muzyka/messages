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
        $result = mysql_query("SELECT * FROM USERS WHERE login='$login'") or die(mysql_error());
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
}
?>
