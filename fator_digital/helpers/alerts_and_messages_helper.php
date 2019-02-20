<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class AlertsAndMessages extends CI_Controller {

    public function __construct()
    {

    }   

    public function defineAlert($config=false)
    {
        if (isset($config['tipoAlert'])) {
            $method = $config['tipoAlert'];
            $this->session->unset_userdata('alert');
            return $this->{$method}($config);            
        }
        return false;
    }

    public function rowMessage($config=false)
    {
        if ($config) {
            $html ='
                <div class="alert aam-row-message '.$config["class"].'">
                    <button class="close" data-close="alert"></button>
                    <span>'.$config["content"].'</span>
                </div>
            ';
            return $html;            
        }
        return false;
    }    

    public function modalAlert($configUser=false)
    {

        $config = array(
            'title' => 'Modal',
            'id' => 'my-modal',
            'content' => 'Descritivo padrão',
            'label_close' => 'Fechar',
            'class' => 'modal-primary',
            'class_header' => 'bg-primary text-white',
            'redirect' => ''
        );

        foreach ($config as $key => $value) {
            if (isset($configUser[$key]) && $configUser[$key]!='') {
                $config[$key]=$configUser[$key];
            }else{
                $config[$key]=$value;
            }
        }

        $v = '';
        if (isset($configUser['redirect'])) {
            $config['redirect'] = 'href="'.$config['redirect'].'"';
        }else{
            $v = 'data-dismiss="modal"';
        }

        $modal ='
        <div id="'.$config['id'].'" class="modal-cancel-alert modal fade show '.$config['class'].' tabindex="-1" role="dialog" style="display: block; padding-right: 17px;">
          <div class="modal-dialog" role="document">
            <!-- Modal content-->
            <div class="modal-content ">
              <div class="modal-header '.$config['class_header'].'">
                <h5 class="modal-title">'.$config['title'].'</h5>
              </div>
              <div class="modal-body">
                <p>'.$config['content'].'</p>
              </div>
              <div class="modal-footer">
                <a '.$config['redirect'].' id="modal-cancel-alert" class="btn btn-default" '.$v.' data-dismiss="modal" >'.$config['label_close'].'</a>
              </div>
            </div>
          </div>
        </div>';
        return $modal;    
    }

}

?>