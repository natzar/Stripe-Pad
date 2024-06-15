<?
class Histogram{
	var $histo;
	var $max;
	var $stats;
	var $freq;

	function __construct($text){
		$context = trim(mb_strtolower($text));
		$common_words = array("","\n"," a "," as "," his "," her ", " to ", " he ", " of ", " in "," on "," and "," the "," de ", " en ", " y ", " con ", " el ", " la ", " del ", " que ", " al "," un ", " por ");
		$context = str_ireplace($common_words,""," ".$context." ");
		$context = preg_replace("/(\-|\.|\,|\:|\+|\?|\!|\¿|\¡|\"|\[|\])/", "",$context);
		$context = preg_replace("/\s{2}/", " ",$context);
		$aux = explode(" ",$context);
		$counter = array();
		
		foreach($aux as $p){
			if (!empty(trim($p))){
				if (isset($counter[$p])){
					$counter[$p]++;
				}else{
					$counter[$p] = 1;
				}
			}
		}
		
		arsort($counter);
		$this->histo = $counter;
		$this->findMax();
		$this->countStats();
	}
	public function findMax(){
		$this->max = 0;
		
		foreach($this->histo as $k => $w){
			
			if ($w > $this->max){
				$this->max = $w;
			}

		}

	}
	public function countStats(){
		$this->freq = array();
		$this->stats = array("lwords" => array(),"mwords" => array(),"twords" => array() );
		$bp = round(($this->max / 2) - 1);
		$totalWords = count($this->histo);

		foreach ($this->histo as $k => $w){
			if ($w == 1){
				//$this->stats['lwords'][] = $k;
			}else if ($w > 1 and $w < $bp){
				$this->stats['mwords'][] = $k;
			}else if ($w >= $bp){
				$this->stats['twords'][] = $k;
			}
			$this->freq[$k]=($totalWords / $w); 
		}
		arsort($this->freq);

	}

	public function report(){
		

		return array(
			"max" => $this->max,
			"totalWords" => count($this->histo),
			"topWords" => $this->stats['twords'],
			"middleWords"  => $this->stats['mwords'],
			"lowWords"  => $this->stats['lwords'],
			"freqs" => $this->freq
		);

	}
}