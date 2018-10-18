<?php
namespace encrypt\view;

class CaesarView {

    private $textInput = 'EncryptionView::TextInput';
    private $alphabet = 'EncryptionView::Alphabet';
    private $encrypt = 'EncryptionView::Encrypt';

    private $title = 'Encryption';
    private $caesarView;
  
    public function render() {
        return '
                <div>
                
                </div>
        ';
    }
    private function generateInputForm () {
        return '
        <form method="post" > 
            <fieldset>
                
                <label for="' . $this->textInput . '">Username :</label>
                <input type="text" id="' . $this->textInput . '" name="' . $this->textInput . '" value="' . $this->getRequestTextInput() . '" />

                <select name="' . $this->alphabet . '">
                    <option value="english">English</option>
                    <option value="swedish">Swedish</option>
                </select>
                
                <input type="submit" name="' . $this->encrypt . '" value="login" />
            </fieldset>
        </form>
    ';
    }

    public function getTextInput () {
        $text = getRequestTextInput();
        if ($this->stringNotEmpty($text)) {
            return $text;
        } else {
            throw new Exception('No text entered');
        }
    }
    private function getRequestTextInput() : string {
        if (isset($_POST[$this->textInput])) {
            return $_POST[$this->textInput];
        } else {
            return '';
        }
    }
    private function stringNotEmpty ($string) : bool {
        return (strlen($string) > 0);
    }
}
