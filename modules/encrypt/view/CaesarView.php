<?php
namespace encrypt\view;

class CaesarView {

    private $textInput = 'EncryptionView::TextInput';
    private $alphabet = 'EncryptionView::Alphabet';
    private $encrypt = 'EncryptionView::Encrypt';

    private $title = 'Encryption';
    private $encryptedMessage = '';


    private $caesarView;
  
    public function render() {
        return '
                <div>
                ' . $this->generateInputForm() . '
                </div>
                <div>
                ' . $this->generateOutputField() . '
                </div>
        ';
    }
    private function generateInputForm () {
        return '
        <form method="post" > 
            <fieldset>
                
                <label for="' . $this->textInput . '">Enter your text here: :</label>
                <input type="text" id="' . $this->textInput . '" name="' . $this->textInput . '" value="' . $this->getRequestTextInput() . '" />

                <label for="' . $this->alphabet . '">Choose alphabet: </label>
                <select name="' . $this->alphabet . '">
                    <option value="english">English</option>
                    <option value="swedish">Swedish</option>
                </select>
                
                <input type="submit" name="' . $this->encrypt . '" value="Generate encrypted message" />
            </fieldset>
        </form>
    ';
    }

    private function generateOutputField () : string {
        if ($this->stringNotEmpty($this->encryptedMessage)) {
            return '
                <h3>Encrypted Message:</h3>
                <p>' . $this->encryptedMessage . '</p>
            ';
        } else {
            return '';
        }
    }

    public function setEncryptedMessage ($encryptedMessage) : void {
        $this->encryptedMessage = $encryptedMessage;
    }

    public function isEncryptionPost () {
        return isset($_POST[$this->encrypt]);
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
