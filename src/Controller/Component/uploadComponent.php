<?php
namespace App\Controller\Component;

use Cake\Controller\Component;
use Cake\Controller\ComponentRegistry;

/**
 * UploadFile component
 */
class uploadComponent extends Component
{

    /**
     * Default configuration.
     *
     * @var array
     */
    protected $_defaultConfig = [];

    #this function uploads a file to any folder inside webroot
    public function uploadFile( $file, $dest, $maxSize, $newname = "" ){
        /* check if was passed a new name */
        empty($newname) ? $filename = $file['name'] : $filename = $newname;
        /* mount the dest */
        $uploaddir = WWW_ROOT;
        $uploadfile = $uploaddir . $dest . DS . basename($filename);
        /* validation */
        if( $file['size'] > $maxSize ) return 0;
        /* upload */
		if( move_uploaded_file($file['tmp_name'], $uploadfile) ) {
		    return true;
		} else {
			return false;
		}
    }
}
