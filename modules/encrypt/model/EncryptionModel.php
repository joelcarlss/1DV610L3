<?php
namespace encrypt\model;

class EncryptionModel {

    private $key; // User input key that will be used for encryption

    private $englishAlphabet;

    private $spaceCharacter = ' '; // TODO Make this changeable for user ex. all spaces = y etc
    private $isDecryption = false;

    public function __construct (\encrypt\model\EnglishAlphabet $ea) {
        $this->englishAlphabet = $ea;
    }

    public function setKey(int $key) {
        $this->key = $key;
    }
    public function setIsDecryption(bool $isDecryption) {
        $this->isDecryption = $isDecryption;
    }

    /**
     * Encrypts string with key.
     */
    public function encryptStringWithKey(string $string) : string {
        $stringAsArray = str_split($string);
        $encryptedMessage = '';
        if (isset($this->key)) {
            foreach ($stringAsArray as $key => $value) {
                $encryptedLetter = $this->getEcryptedOrSpaceCharacter($value);
                $encryptedMessage .= $encryptedLetter;
            }
        }
        return $encryptedMessage;
    }

    private function getEcryptedOrSpaceCharacter ($character) {
        $encryptedLetter = '';
        if ($this->characterIsSpace($character)) { // Handle for space characters
            $encryptedLetter .= $this->spaceCharacter;
        } else { // Encryption of character
            $encryptedLetter .= $this->getEncryptedCharacter($character);   
        }
        return $encryptedLetter;
    }
    
    private function characterIsSpace(string $character) {
        return ($character == ' ');
    }

    private function getEncryptedCharacter(string $character) : string {
        $characterIndex = $this->englishAlphabet->getIndexByCharacter($character);
        $newCalculatedIndex = $this->getIndexForEncryptOrDecrypt($characterIndex);    
        $encryptedLetter = $this->englishAlphabet->getCharacterByIndex($newCalculatedIndex);
        return $encryptedLetter;
    }

    /**
     * Chooses if to get encrypt- or decrypt- index dy checking isDecryption bool.
     * @return integer
     */
    private function getIndexForEncryptOrDecrypt (string $characterIndex) : string {
        $newCalculatedIndex = '';
        if ($this->isDecryption) {
            $newCalculatedIndex = $this->getNegativeCalculatedIndexByKeyAndIndex($characterIndex);    
        } else {
            $newCalculatedIndex = $this->getPositiveCalculatedIndexByKeyAndIndex($characterIndex);
        }
        return $newCalculatedIndex;
    }


    /**
     * Calculates index by adding key value to characters index value
     * If the value exceeds length of alphabet value will restart by removing the length from key
     * Meaning: If alphabet has length 23: (1 + 1 = 2; 23 + 1 = 0)
     * @return integer
     */
    private function getPositiveCalculatedIndexByKeyAndIndex ($index) : int {
        $alphabetLength = $this->englishAlphabet->getLength();
        $newCalculatedIndex =  ($this->key + $index);
        if ($newCalculatedIndex >= $alphabetLength) {
            $newCalculatedIndex -= $alphabetLength;
        }
        return $newCalculatedIndex;
    }
    /**
     * Calculates index by removing key value to characters index value
     * If the value is lower than zero value will restart by adding the length of alphabet to key
     * Meaning: If alphabet has length 23: (1 - 1 = 0; 0 - 1 = 23)
     * @return integer
     */
    private function getNegativeCalculatedIndexByKeyAndIndex ($index) : int {
        $alphabetLength = $this->englishAlphabet->getLength();
        $newCalculatedIndex =  ($index - $this->key);
        if ($newCalculatedIndex < 0) {
            $newCalculatedIndex += $alphabetLength;
        }
        return $newCalculatedIndex;
    }
}