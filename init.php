<?php 

$this->event->listen(['location', 'view', 'data', 'main', 'personnel_index'], function($event){
  if(!empty($event['data']['depts'])){
    foreach($event['data']['depts'] as $d_id => $dept){
      if(!empty($dept['pos'])){
        foreach($dept['pos'] as $p_id => $pos){
          if(!empty($pos['chars'])){
            foreach($pos['chars'] as $c_id => $char){
              $character = $this->char->get_character($char['char_id']);
              if ($character->images > '')
        			{
        				// get the images
        				$images = explode(',', $character->images);
        				$images_count = count($images);
        				
        				$src = (strstr($images[0], 'http://') !== false)
        					? $images[0]
        					: base_url().Location::asset('images/characters', trim($images[0]));
                $event['data']['depts'][$d_id]['pos'][$p_id]['chars'][$c_id]['name'] .= '<span data-src="'.$src.'" style="display:none;" class="char_image"></span>';
              }
            }
          }
        }
      }
      
      if(!empty($dept['sub'])){
        foreach($dept['sub'] as $s_id => $sub_dept){
          if(!empty($sub_dept['pos'])){
            foreach($sub_dept['pos'] as $p_id => $pos){
              if(!empty($pos['chars'])){
                foreach($pos['chars'] as $c_id => $char){
                  $character = $this->char->get_character($char['char_id']);
                  if ($character->images > '')
            			{
            				// get the images
            				$images = explode(',', $character->images);
            				$images_count = count($images);
            				
            				$src = (strstr($images[0], 'http://') !== false)
            					? $images[0]
            					: base_url().Location::asset('images/characters', trim($images[0]));
                    $event['data']['depts'][$d_id]['sub'][$s_id]['pos'][$p_id]['chars'][$c_id]['name'] .= '<span data-src="'.$src.'" style="display:none;" class="char_image"></span>';
                  }
                }
              }
            }
          }
        }
      }
      
      
    }
  }
});

$this->event->listen(['location', 'view', 'output', 'main', 'personnel_index'], function($event){
    
    include(dirname(__FILE__).'/config.php');
    
    $this->config->load('extensions');
    $extensionsConfig = $this->config->item('extensions');
    if(isset($extensionsConfig['manifest_char_images']['blend'])){
        $blend = $extensionsConfig['manifest_char_images']['blend'];
    }else{
        $blend = null;
    }
    
    if(!empty($blend) && !empty($EXTENSION__MANIFEST_CHAR_IMAGES__CONFIG['blendOptions'][$blend])){
        $blend = $EXTENSION__MANIFEST_CHAR_IMAGES__CONFIG['blendOptions'][$blend];
        $event['output'] .= '<script type="text/javascript">
        $(".char_image").each(function(){
        var src = $(this).attr("data-src");
        $(this).closest("tr").find("img[src*=\'ranks\']").before(
          $("<div>").css("display","inline-block").css("height","120px").css("width","144px").css("background", "url(\'"+src+"\') 0 0 no-repeat, linear-gradient(to right, '.$blend['left'].', '.$blend['right'].' '.$blend['width'].')").css("background-blend-mode", "'.$blend['mode'].'").css("background-size", "cover")
        ).closest("td").css("text-align","right");
        });
        </script>';
    }else{
        $event['output'] .= '<script type="text/javascript">
        $(".char_image").each(function(){
        var src = $(this).attr("data-src");
        $(this).closest("tr").find("img[src*=\'ranks\']").before(
          $("<div>").css("display","inline-block").css("height","120px").css("width","144px").css("background", "url(\'"+src+"\') 0 0 no-repeat").css("background-size", "cover")
        ).closest("td").css("text-align","right");
        });
        </script>';
    }
    
    
});
