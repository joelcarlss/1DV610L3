<?php
namespace encrypt\model;

class EncryptionModel {

    private $key; // User input key that will be used for encryption

    private $englishAlphabet;

    private $spaceCharacter = ' '; // TODO Make this changeable for user ex. all spaces = y etc

    public function __construct (\encrypt\model\EnglishAlphabet $ea) {
        $this->englishAlphabet = $ea;
    }

    public function setKey(int $key) {
        $this->key = $key;
    }

    /**
     * Encrypts string with key.
     */
    public function encryptStringWithKey(string $string) : string {
        $stringAsArray = str_split($string);
        $encryptedMessage = '';
        if (isset($this->key)) {
            foreach ($stringAsArray as $key => $value) {
                $encryptedLetter = '';
                if ($this->characterIsSpace($value)) { // Handle for space characters
                    $encryptedLetter .= $this->spaceCharacter;
                } else { // Encryption of character
                    $encryptedLetter .= $this->encryptCharacterWithKey($value);
                    
                }
                $encryptedMessage .= $encryptedLetter;
            }
        }
        return $encryptedMessage;
    }

    private function encryptCharacterWithKey(string $character) : string {
        $characterIndex = $this->englishAlphabet->getIndexByCharacter($character);
        $newCalculatedIndex = $this->getCalculatedIndexByKeyAndIndex($characterIndex);
        $encryptedLetter = $this->englishAlphabet->getCharacterByIndex($newCalculatedIndex);
        return $encryptedLetter;
    }

    private function characterIsSpace(string $character) {
        return ($character == ' ');
    }

    /**
     * Calculates index by adding key value to characters index value
     * If the value exceeds length of alphabet value will restart by removing the length from key
     * Meaning: If alphabet has length 23: (1 + 1 = 2; 23 + 1 = 0)
     * @return integer
     */
    private function getCalculatedIndexByKeyAndIndex ($index) : int {
        $alphabetLength = $this->englishAlphabet->getLength();
        $newCalculatedIndex =  ($this->key + $index);
        if ($newCalculatedIndex >= $alphabetLength) {
            $newCalculatedIndex -= $alphabetLength;
        }
        return $newCalculatedIndex;
    }
}