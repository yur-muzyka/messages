<?

class Auth {

    public static function is_logged($login, $password) {
        $user = User::find_by_login($login);
        if ($password != null && $user->password == $password) {
            return true;
        } else {
            return false;
        }
    }

    public static function current_user() {
        $login = $_SESSION['login'];
        return User::find_by_login($login);
    }
}
?>
