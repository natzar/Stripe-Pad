<?

final class mp3 extends field{

	function view(){
		echo '<object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,0,0" width="165" height="38" id="niftyPlayer1" align=""><param name=movie value="lib/modules/niftyplayer/niftyplayer.swf?file=../data/files/'.$this->value.'&as=0"><param name=quality value=high><param name=bgcolor value=#FFFFFF><embed src="lib/modules/niftyplayer/niftyplayer.swf?file=betty.mp3&as=1" quality=high bgcolor=#FFFFFF width="165" height="38" name="niftyPlayer1" align="" type="application/x-shockwave-flash" pluginspage="http://www.macromedia.com/go/getflashplayer"></embed></object>';	
	}
	function bake_field (){
		}
		
	function exec_add () {
		
	}
	function exec_edit () {
	
	}

}

