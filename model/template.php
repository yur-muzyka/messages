<?
class Template {
    public $values = array();
    private $tpl;
    public $html;

    public function get_tpl($name) {
        if (empty($name) || !file_exists($name)) {
            return false;
        } else {
            $this->tpl = join('', file($name));
            $this->html = $this->tpl;
        }
    }

    public function set_value($key, $var) {
        $key = '{' . $key . '}';
        $this->values[$key] = $var;
    }

    public function tpl_parse() {
        $this->html = $this->tpl;
        foreach ($this->values as $find => $replace) {
            $this->html = str_replace($find, $replace, $this->html);
        }
    }
}
?>
