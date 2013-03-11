<?
class Message {
    public $id;
    public $text;
    public $author_id;
    public $recipient_id;
    public $author_status;
    public $recipient_status;

    public static function create($text, $author_id, $recipient_id) {
        mysql_query("INSERT INTO messages VALUES 
            (0, '$text', '$author_id', '$recipient_id', 'new', 'new')");
    }

    public static function get_messages($user_id, $opponent_id, $last_message_id) {
        $result = mysql_query("SELECT * FROM messages WHERE author_id='$user_id' AND recipient_id='$opponent_id' AND id>'$last_message_id'
            AND (('$user_id'=author_id AND author_status != 'delete') OR ('$user_id'=recipient_id AND recipient_status != 'delete')) 
            UNION ALL
            SELECT * FROM messages WHERE author_id='$opponent_id' AND recipient_id='$user_id' AND id>'$last_message_id'
            AND (('$user_id'=author_id AND author_status != 'delete') OR ('$user_id'=recipient_id AND recipient_status != 'delete')) 
            ORDER BY id");
        $messages = array();
        while ($raw = mysql_fetch_array($result)) {
            $message = new Message();
            $message->id = $raw["id"];
            $message->text = $raw["text"];
            $message->author_id = $raw["author_id"];
            $message->recipient_id = $raw["recipient_id"];
            $message->author_status = $raw["author_statuw"];
            $message->recipient_status = $raw["recipient_status"];
            $messages[] = $message;
        }
        return $messages;
    }

    public static function get_new_messages($author_id, $recipient_id) {
        $new_messages = array();
        $all_mess = Message::get_messages($author_id, $recipient_id, 0);
        foreach ($all_mess as $message) { if ($message->recipient_id == $author_id && 
                $message->recipient_status == "new") {
                    $new_messages[] = $message;
                }
        }
        return $new_messages;
    }

    public static function find($id) {
        $result = mysql_query("SELECT * FROM messages WHERE id='$id'");
        if (mysql_num_rows($result) == 0) {
            return null;
        }
        $raw = mysql_fetch_array($result);
        $message = new Message();
        $message->id = $raw["id"];
        $message->text = $raw["text"];
        $message->author_id = $raw["author_id"];
        $message->recipient_id = $raw["recipient_id"];
        $message->author_status = $raw["author_status"];
        $message->recipient_status = $raw["recipient_status"];
        return $message;
    }

    public function save() {
        mysql_query("UPDATE messages SET text='$this->text', author_id='$this->author_id', recipient_id='$this->recipient_id', 
            author_status='$this->author_status', recipient_status='$this->recipient_status'
            WHERE id='$this->id'");
    }

    public static function remove_from_db($id) {
        mysql_query("DELETE FROM messages WHERE id='$id'");
    }

    public static function delete($id, $user_id) {
        $message = Message::find($id);
        if ($message->author_status == "delete" || $message->recipient_status == "delete") {
            Message::remove_from_db($id);
        } else if ($message->author_id == $user_id) {
            $message->author_status = "delete";
            $message->save();
        } else if ($message->recipient_id == $user_id) {
            $message->recipient_status = "delete";
            $message->save();
        }

    }

}
?>
