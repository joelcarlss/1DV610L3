<?php
namespace encrypt\view;
require_once('modules/encrypt/model/customExceptions.php');

class CaesarView {

    private $textInput = 'EncryptionView::TextInput';
    private $key = 'EncryptionView::Key';
    private $encrypt = 'EncryptionView::Encrypt';
    private $decrypt = 'EncryptionView::Decrypt';
    private $caesarInformation = 'EncryptionView::CaesarInformation';

    private $title = 'Encryption';
    private $keyDefaultValue = 1;
    private $encryptedMessage = '';
    private $message = '';

    private $englishAlphabet;
    private $informationView;

    public function __construct (\encrypt\model\EnglishAlphabet $englishAlphabet, InformationView $informationView) {
        $this->englishAlphabet = $englishAlphabet;
        $this->informationView = $informationView;

    }
  
    public function render() : string {
        return '
            <h1>Ceasar Encryption</h1>
                <div>
                    ' . $this->generateInfoLink() . '
                </div>
                <div>
                    ' . $this->getPageToRender() . '
                </div>
                <div>
                    ' . $this->generateOutputField() . '
                </div>
        ';
    }
    private function generateInfoLink() : string {
        if ($this->isGetInformationPageRequest()) {
            return '<a href="?">Back to encryption</a>';
        } else {
            return '<a href="?' . $this->caesarInformation . '">Info about Caesar Cipher</a>';
        }
    }
    private function getPageToRender () : string {
        if ($this->isGetInformationPageRequest()) {
            return $this->informationView->render();
        } else {
            return $this->generateInputForm();
        }
    }
    private function generateInputForm () : string {
        return '
            <form method="post" > 
                <fieldset>
                    <p>' . $this->message . '</p>
                    <label for="' . $this->textInput . '">Enter your text here: :</label>
                    <input type="text" id="' . $this->textInput . '" name="' . $this->textInput . '" value="' . $this->getRequestTextInput() . '" />

                    <label for="' . $this->key . '">Choose key: </label>
                    <select name="' . $this->key . '">
                    ' . $this->generateDropDownValues() . '
                    </select>
                    
                    <input type="submit" name="' . $this->encrypt . '" value="Generate encrypted message" />

                    <input type="submit" name="' . $this->decrypt . '" value="Decrypt message" />
                </fieldset>
            </form>
        ';
    }

    private function generateOutputField () : string {
        if ($this->stringNotEmpty($this->encryptedMessage)) {
            return '
                <h3>Message:</h3>
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

    // SETS
    public function setMessage($message) : void {
        $this->message = $message;
    }
    public function setEncryptedMessage ($encryptedMessage) : void {
        $this->encryptedMessage = $encryptedMessage;
    }

    // GET REQUEST HANDLING
    public function isGetInformationPageRequest () : bool {
        if (!empty($_GET)) {
            if(isset($_GET[$this->caesarInformation])) {
            return true;
        }
    }
    return false;
    }

    // POST REQUEST HANDLING
    public function isEncryptionPost () : bool {
        return isset($_POST[$this->encrypt]);
    }

    public function isDecryptionPost () : bool {
        return isset($_POST[$this->decrypt]);
    }

    public function getRequestEncryptionKey() : int {
        if (isset($_POST[$this->key])) {
            return $this->stringToInt($_POST[$this->key]);
        } else {
            return $this->keyDefaultValue;
        }
    }

    public function getTextInput () : string {
        $text = $this->getRequestTextInput();
        if ($this->stringNotEmpty($text)) {
            return $text;
        } else {
            throw new \encrypt\model\EmptyStringException('No text entered');
        }
    }
    private function getRequestTextInput() : string {
        if (isset($_POST[$this->textInput])) {
            return $_POST[$this->textInput];
        } else {
            return '';
        }
    }

    // Other Low level functions
    private function stringToInt($string) : int {
        return (int)$string;
    }

    private function stringNotEmpty ($string) : bool {
        return (strlen($string) > 0);
    }
}
