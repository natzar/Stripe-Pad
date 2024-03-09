<? 
include "cors.php";
include "bd.php"; 

if (!isset($_GET['id'])) die();

$q = $bd->prepare("SELECT * from users where hash = :e limit 1" );
$q->bindParam(":e",$_GET['id']);
$q->execute();
$user = $q->fetch();

$settings = json_decode($user['settings'],true);

function __($t){
  return $t;
} ?>

<style>

/*Animation*/
#refboost_trigger{
   
    
    transition-property: -moz-transform;
    transition-duration: 1s;
    animation-name: grow;
    animation-duration: 2.3s;
    animation-iteration-count: infinite;
    animation-timing-function: linear;
}

@keyframes grow {
     0% {
         transform:scale(0.8);
    }
    49% {
      transform:scale(0.9);
    }
   
    100% {
            transform:scale(0.8);
    }


}

 #available_text{
    color:#444;
}
 .flex {
     display: flex;
}
 .justify-center {
     justify-content: center;
}
 .ring-white {
     --tw-ring-opacity: 1;
     --tw-ring-color: rgb(255 255 255/var(--tw-ring-opacity));
}
 .ring-2 {
     --tw-ring-offset-shadow: var(--tw-ring-inset) 0 0 0 var(--tw-ring-offset-width) var(--tw-ring-offset-color);
     --tw-ring-shadow: var(--tw-ring-inset) 0 0 0 calc(2px + var(--tw-ring-offset-width)) var(--tw-ring-color);
}
 .-space-x-4>:not([hidden])~:not([hidden]) {
     --tw-space-x-reverse: 0;
     margin-right: calc(-1rem*var(--tw-space-x-reverse));
     margin-left: calc(-1rem*(1 - var(--tw-space-x-reverse)));
}
 #conversation img{
    max-width:100%;
    height:auto !important;
    .margin-left:12px;
}
 .topbar-text,.topbar-title {
}
 .tobar-title{
    padding:10px;
}
 #refboost_chat{
    z-index:999999;
    display:none;
    width:348px;
    height: 85vh;
    position: fixed;
    right:20px;
    bottom:20px;
    border:none;
    background: #fff;
     border-radius: 10px;
    
     transition: height 600ms;
     box-shadow: rgba(0,0,0,.16) 0 0 12px;
     font-family: Arial
}
 @media screen and (min-device-width: 680px) {
     #refboost_trigger{
         display:block !important
    }
     #refboost_chat{
      height: auto;
       overflow: hidden;
     }
}
 #refboost_form{
     padding: 11px;
     
     background: #fafafa;
     height: 100%;
/*     background: url(https://refboost.com/widget/back_pat.png);*/
     margin-bottom: 0px;
    
}
 #refboost_chat #form-content{
     width: 100%;
     color: #666;
     margin: 0px;
    font-size: 13px;
}
 #submit_button:hover{
     background:orange;
     color:black;
     cursor: pointer;
     z-index: 99999;
}
 #refboost_refboost #form-content input[type="email"], #refboost_refboost #form-content input[type="text"]{
     padding-right:15px;
     padding-left:15px;
     padding-top:11px;
     font-size:15px;
     margin-bottom:9px;
     padding-bottom:11px;
     width: 100%;
     color:#222;
     border-radius: 10px;
     border-color: transparent;
     border:none;
     box-shadow: rgba(0,0,0,.16) 0 0 12px;
}
 .slideUp {
     height: 65vh;
     animation-name: slideUpAnimation;
     animation-iteration-count: 1;
     animation-timing-function: ease-in;
     animation-duration: 0.3s;
     display: block !important;
}
 @keyframes slideUpAnimation {
     0% {
         height:0px;
    }
     100% {
         height: 65vh;
    }
}
 .fadeIn {
     opacity: 1;
     animation-name: fadeInOpacity;
     animation-iteration-count: 1;
     animation-timing-function: ease-in;
     animation-duration: 0.3s;
     display: block !important;
}
 @keyframes fadeInOpacity {
     0% {
         opacity: 0;
    }
     100% {
         opacity: 1;
    }
}
 #refboost_trigger{
     
     
     
     color: white;
     display: none;
     background: linear-gradient(90deg, <?= $settings['primary_color']; ?> 5%, <?= $settings['primary_color']; ?> 100%);
    
     z-index: 999999;
    border: 1px solid rgb(231, 231, 231);
    box-shadow: rgb(0 0 0 / 16%) 0px 0px 12px;
    border-radius: 14px;
    position: fixed;
    right: 20px;
    bottom: 20px;
    width: auto;
    padding-left: 20px;
    padding-right: 20px;        
    height: 55px;
    border-radius: 40px;
    text-align: center;
    vertical-align: middle;
    line-height: 52px;
    font-family: Arial;

}
 .profile-img {
     width: 34px;
     height: 34px;
     margin-left: -16px;
     border-radius:17px;
     border:2px solid white;
}
 #refboost_trigger svg{
    width: 31px;
    vertical-align: middle;
    display: inline;
 }
 #refboost_trigger a{
     vertical-align: middle;
     text-align: center;
     font-size: 40px;
     text-decoration: none;
    display:block;
    width: 100%;
    font-weight: bold;
    text-align: center;
    letter-spacing: -1px;
    color:white;
    font-size: 18px;
}
 #refboost_submit_button{
     cursor: pointer;     
     color:white;
     background: <?= $settings['primary_color']; ?>;
     background: linear-gradient(90deg, <?= $settings['primary_color']; ?> 5%, <?= $settings['primary_color']; ?> 100%);
     text-align: center;
     width: 100%;
     color: white;
     padding: 19px;
     font-weight: bold;
     border-radius:10px;
     bottom: 20px;
     left: 0px;
     border: none;
     font-size: 15px;
}
 #refboost_submit_button:hover{
     background: linear-gradient(90deg, <?= $settings['primary_color']; ?> 120%, <?= $settings['primary_color']; ?> 200%); 
}
 .inline-block {
     display: inline-block;
}
 #branding{
     display: block;
     text-align: center;
    padding:3px;
    padding-bottom: 4px;
  
     width: 100%;
}
 #branding a{
     text-decoration: none;
     font-size: 11px;
     color: #cdcdcd;
  
}
 #branding a:hover{
     font-weight: bold;
}
 #deal_title{
     display: block;
     font-size: 33px;
     font-weight: 100;
     margin-bottom: 8px;
     color: white;
     margin-top:22px;
}
 #deal_description{
     font-size: 17px;
     line-height: 25px;
     font-weight: 400;
}
 #chatheader{
    background:white;
    padding:46px;
    position: relative;
     padding-bottom: 30px;
    color:white;
    background: rgb(2,0,36);
     background: linear-gradient(90deg, <?= $settings['primary_color']; ?> 35%, <?= $settings['primary_color']; ?> 100%);
}
 #chatheader_content{
     padding: 7px;
     position: absolute;
     top: 14px;
     left: 14px;
}
.red-border{
  border:2px solid <?= $settings['primary_color']; ?>  !important;
}
.hide{
  display: none;
}
#refboost_success_msg{
      font-size: 150px;
    text-align: center;
}
#refboost_loading{
      text-align: center;
    font-size: 20px;
    font-weight: bold;
}
</style>

<div id="refboost_trigger">
  <a href="#" style="" onclick="refboost.init()">
   <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" >
  <path stroke-linecap="round" stroke-linejoin="round" d="M15.59 14.37a6 6 0 01-5.84 7.38v-4.8m5.84-2.58a14.98 14.98 0 006.16-12.12A14.98 14.98 0 009.631 8.41m5.96 5.96a14.926 14.926 0 01-5.841 2.58m-.119-8.54a6 6 0 00-7.381 5.84h4.8m2.581-5.84a14.927 14.927 0 00-2.58 5.84m2.699 2.7c-.103.021-.207.041-.311.06a15.09 15.09 0 01-2.448-2.448 14.9 14.9 0 01.06-.312m-2.24 2.39a4.493 4.493 0 00-1.757 4.306 4.493 4.493 0 004.306-1.758M16.5 9a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0z" />
</svg>
<span><?= empty($settings['trigger_cta']) ? $settings['button_cta'] :$settings['trigger_cta']  ?></span>
  </a>
</div>
<div id="refboost_chat">
  <div id="chatheader">
    <!-- Close button -->
    <a style="float:right;float: right;color: #e7e7e7;right: 10px; position: absolute;top:5px;cursor: pointer" onclick="refboost.close()">⤫</a>
    <!-- mini_icon -->
    <div style="     background: rgba(0,0,0,0.1);
    width: 34px;
    border-radius: 100%;
    position: absolute;
    top: 18px;
    margin-left:-7px;
    padding: 4px;
    padding-left: 6px;">
      <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
        <path stroke-linecap="round" stroke-linejoin="round" d="M6 12L3.269 3.126A59.768 59.768 0 0121.485 12 59.77 59.77 0 013.27 20.876L5.999 12zm0 0h7.5" />
      </svg>
    </div>
    <!-- Chatheader content -->
    <div class="chatheader_content">
      <!-- text chatheader content -->
      <span id="deal_title"><?= $settings['deal_title'] ?> 🎉 </span>
      <span id="deal_description">
        <?= $settings['deal_description'] ?></span>
    </div>
  </div>
  <form name="refboost_form" action="" id="refboost_form">
    <div id="form-content">
      <input type="text" name="name" id="firstField" placeholder="¿What's your Name?" autofocus required="required">
      <input type="email" name="email" id="firstEmail" placeholder="¿What's your Email?" autocomplete="email" required="required">
      <? for ($i=1;$i <= $settings['max_friends']; $i++): ?>
      <input type="email" name="friends[]" placeholder="email<?= $i ?>@domain.com" autocomplete="off" required="required">
      <? endfor; ?>
      <input id="refboost_submit_button" type="button" name="submit_button" value="<?= $settings['button_cta'] ?> &#10140;">
    </div>
    <!-- loading -->
    <div id="refboost_loading" class="hide" class="">
      
      <img src="https://refboost.com/widget/loading.gif">
<br>
      <span class="">Sending ...</span>
    </div>
  <!-- success -->
    <div id="refboost_success_msg" class="hide" >
    

      <span>&#9996;</span>
      </div>
      <!-- error -->
   <div id="refboost_error" class="hide" >
    

      <span>&#9888;</span>
      </div>
  </form>


  <small id="branding">
    <a href="https://refboost.com" rel="follow noopener">Referrals Widget by RefBoost</a>
  </small>
  <!-- <input type="text" id="clientinput" style="width: 100%;background: white;border: none;padding:15px;outline:none" placeholder="

   -->

</div>
