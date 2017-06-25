<?php
namespace PMMigration\Tables;

/**
 * Description of NewsTable
 *
 * @author Aydoom
 */
class NewsTable extends \PMMigration\Core\DefTable {
	
    public $name = 'news';
    public $fields = [];

    /**
     * 
     * @param type $name
     */
    public function __construct($name = false) {
        parent::__construct($name);
        
        $this->defId("id");
        $this->defVarchars(["title", "keywords"]);
        $this->addField("shortText", "text")->len(1028)->def("NULL");
        $this->defDates("registerDate");
    }
    
    public function write() {
        $fields = ['title', 'keywords', 'shortText', 'registerDate'];

        
        for ($i = 1; $i < 81; $i++) {
            $this->setInsert($fields, 
                    [$this->getTitle(), $this->getKeywords(), $this->getText(),
                        '2017-06-24 22:22:16']);
        }
    }
    
    public function getKeywords() {
        $keywords = ['Lorem', 'ipsum', 'dolor', 'sit', 'amet', 'consectetur',
            'adipiscing','elit', 'Sed', 'egestas', 'vel', 'ante', 'interdum',
            'Duis', 'vitae'];
        $cKeywords = count($keywords);
        $cK = rand(2, $cKeywords / 2);
        $output = [];
        for ($k = 0; $k < $cK; $k++) {
            $key = rand(0, $cKeywords - 1);
            $random = $keywords[$key];
            if (in_array($random, $output)) {
                $k--;
            } else {
                $output[] = $random;
            }
        }
        
        return implode(",", $output) . ',';
    }
    
    public function getTitle() {
        $keywords = ['test', 'angular', 'js', 'javascript', 'for', 'work',
            'develop','template', 'article', 'articles'];
            $cKeywords = count($keywords);
        $cK = rand(2, $cKeywords/2);
        $output = [];
        for ($k = 0; $k < $cK; $k++) {
            $key = rand(0, $cKeywords - 1);
            $random = $keywords[$key];
            if (in_array($random, $output)) {
                $k--;
            } else {
                $output[] = $random;
            }
        }
        
        return implode(" ", $output);
        
    }
    
    public function getText() {
        return 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. '
        . 'Nam rutrum, elit eu ultricies sollicitudin, elit libero aliquam '
                . 'nulla, vitae dapibus sapien dui vel metus. Mauris lacus '
                . 'erat, eleifend ac laoreet quis, tempus et lectus. Etiam ut '
                . 'fringilla dui. Morbi orci lorem, tincidunt vel mi placerat, '
                . 'sodales elementum sem. Vestibulum nec dictum tellus. '
                . 'Suspendisse non tellus nisi. Duis sit amet convallis magna. '
                . 'Quisque in turpis a lacus iaculis rutrum vel eu dolor. '
                . 'Maecenas faucibus lorem sed nisl hendrerit, quis congue nibh '
                . 'auctor. Mauris mollis ex in orci scelerisque, sit amet '
                . 'tempor purus maximus. Pellentesque risus urna, pulvinar non '
                . 'tincidunt id, elementum in massa. Vestibulum elementum, mi '
                . 'sed dignissim vestibulum, urna ligula elementum lorem, vitae '
                . 'dapibus ipsum orci eget magna. Cras sit amet sem fermentum, '
                . 'commodo metus sed, gravida arcu. Class aptent taciti '
                . 'sociosqu ad litora torquent per conubia nostra, per '
                . 'inceptos himenaeos.';
    }
}
