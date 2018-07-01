<?php

class Images {
    
    protected $url;
    
    protected $curl_data;
    
    protected $images;
    
    protected $img_list;


    public function __construct($url) {
        $this->url = $url;
        $this->setData();
        $this->setImages();
        $this->setImageList();

    }

    //pobieranie curl z podanej strony
    protected function setData() {
        $ch = curl_init();
        $timeout = 10;
        curl_setopt($ch, CURLOPT_URL, $this->url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
        curl_setopt($ch,CURLOPT_USERAGENT,'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.13) Gecko/20080311 Firefox/2.0.0.13');
        $this->curl_data = curl_exec($ch);
        curl_close($ch);
    }
    
    //wyciągnięcie obrazów z curl
    protected function setImages() {
        $dom = new DOMDocument;
        $dom->loadHTML($this->curl_data);
        
        $this->images = $dom->getElementsByTagName('img');
    }
    
    //utworzenie listy obrazów jako linków z target="_blank"
    protected function setImageList() {
        $i=0;
        
        foreach ($this->images as $im) {
            $source = $im->getAttribute('src');
            
            //sprawdzenie czy adres obrazu jest linkiem i jeśli nie to dodanie adresu URL
            if (filter_var($source, FILTER_VALIDATE_URL)) { 
                $link = $source;
                $this->img_list[$i] = '<a href="'.$link.'" target="_blank" class="py-1 list-group-item list-group-item-action">'.$link.'</a>';
            } else {
                $link = $this->url.$source;
                if (filter_var($link, FILTER_VALIDATE_URL)) {
                    $this->img_list[$i] = '<a href="'.$link.'" target="_blank" class="py-1 list-group-item list-group-item-action">'.$link.'</a>';
                } else {
                    $this->img_list[$i] = 'Obraz nieczytelny';
                }
            }
            $i++;
        }
    }
    
    //sprawdzenie czy na stronie są obrazy i wyświetlenie ich
    public function getImageList() {
        echo '<h2>Obrazy ze strony '. $this->url.'</h2>';

        if(isset($this->img_list[0])) {
            foreach ($this->img_list as $img) {
                echo $img;
            }
        } else {
            echo '<div class="alert alert-warning">Brak obrazów na stronie.</div>';
        }
    } 
    
}
