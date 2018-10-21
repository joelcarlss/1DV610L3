<?php
namespace encrypt\view;

class InformationView {

  private $title = 'About Caecar Cipher';
  
  public function __construct () {
}
  
  public function render() : string {
    return '
          <h3> ' . $this->title .' </h3>
            <div>
            ' . $this->getAboutText() . '
            </div>
            <br><br>
            <div>
            ' . $this->getHowToText() . '
            </div>
            <br><br>
            <div>
            ' . $this->getSourcesLinks() . '
            </div>
    ';
  }

  private function getAboutText() : string {
    return '
    Caesar Cipher is an old encryption method named after Julius Caesar who allegedly used this sipher to communicate with his army.
    <br>
    Though the cipher is probably before his time.
    ';
  }
  private function getHowToText() : string {
      return '
      The cipher is simple.
      <br>
      What happens is actually just that the entered letter is added with the cey, counting upwards in the alphabet
      <br>
      Example: ABC with key 1 = BCD
      It simply jumps up one letter. Key 2 makes two letters. A = C, and so forth.
      ';
  }
  private function getSourcesLinks () : string {
      return '
      <a href="https://www.cia.gov/news-information/featured-story-archive/2007-featured-story-archive/cracking-the-code.html">
      CIA - Cracking the code</a>
      
      ';
  }
}
