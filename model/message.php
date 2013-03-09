<?
class Message {
    public $id;
    public $text;
    public $author_id;
    public $recipient_id;

    public static function create($text, $author_id, $recipient_id) {
        mysql_query("INSERT INTO messages VALUES (0, '$text', '$author_id', '$recipient_id')");
    }
}
?>
