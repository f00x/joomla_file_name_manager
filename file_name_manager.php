<?php

defined('_JEXEC') or die;

class PlgSystemFile_name_manager extends JPlugin {

    public function onAfterInitialise() {
        $app = JFactory::getApplication();

        if (!($app instanceof JApplicationAdministrator))
            return true;
        
        foreach ($_FILES as &$file_input) {
            if(is_array($file_input['name'])){
            foreach ($file_input['name'] as &$name_file) {

                $name_file = $this->getNewName($name_file);
            }
        }else {
            $file_input['name']=$this->getNewName($file_input['name']);
            
//            
//            var_dump($file_input);
//         var_dump($_FILES);
//            exit;
        }
    }
    }
    private function getNewName($name) {

        $new_name = ru_RULocalise::transliterate($name);
        $new_name = preg_replace('/\s/ui', '_', $new_name);
        $new_name = (new DateTime)->format('Y_m_d').'_'.pathinfo($new_name, PATHINFO_FILENAME). '.' . pathinfo($new_name, PATHINFO_EXTENSION);
        return $new_name;
    }

}
