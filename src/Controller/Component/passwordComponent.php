<?php
namespace App\Controller\Component;

use Cake\Controller\Component;
use Cake\Controller\ComponentRegistry;

/**
 * UploadFile component
 */
class passwordComponent extends Component
{

    /**
     * Default configuration.
     *
     * @var array
     */
    protected $_defaultConfig = [];

 
    /**
     * Generates a random pass.
     *
     */
    public function generateRandomPass( $passLen = 8 ){
        // generates a random pass, saves it and sends by email
        $secret = array();
        $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
        $alphaLength = strlen($alphabet) - 1;
        for ($i = 0; $i < $passLen; $i++) {
            $n = rand(0, $alphaLength);
            $secret[] = $alphabet[$n];
        }
        return $pass = implode($secret);
    }
} 