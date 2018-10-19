<?php
namespace encrypt\view;

class CaesarView {

    private $textInput = 'EncryptionView::TextInput';
    private $key = 'EncryptionView::Key';
    private $encrypt = 'EncryptionView::Encrypt';

    private $title = 'Encryption';
    private $encryptedMessage = '';

    private $englishAlphabet;

    public function __construct (\encrypt\model\EnglishAlphabet $englishAlphabet) {
        $this->englishAlphabet = $englishAlphabet;
    }
  
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

                <label for="' . $this->key . '">Choose key: </label>
                <select name="' . $this->key . '">
                ' . $this->generateDropDownValues() . '
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

    private function generateDropDownValues() : string {
        $alphabetLength = $this->englishAlphabet->getLength();
        $response = '';
        for ($i = 0; $i < $alphabetLength; $i++) {
            $response .= '<option ' . $this->generateOptionAttributes($i) . ' value="' . $i . '">' . $i . '</option>';
        }
        return $response;
    }

    private function generateOptionAttributes($i) : string {
        $response = '';
        if ($i == $this->getRequestEncryptionKey()) {
            $response .= 'selected="selected"';
        }
        return $response;
    }

    public function setEncryptedMessage ($encryptedMessage) : void {
        $this->encryptedMessage = $encryptedMessage;
    }

    public function isEncryptionPost () : bool {
        return isset($_POST[$this->encrypt]);
    }

    // TODO set type : int? : string?
    public function getRequestEncryptionKey() {
            return $this->stringToInt($_POST[$this->key]);
    }
    private function stringToInt($string) {
        return (int)$string;
    }

    public function getTextInput () {
        $text = $this->getRequestTextInput();
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
