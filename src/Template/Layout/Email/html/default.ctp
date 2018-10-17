<?php
/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link          https://cakephp.org CakePHP(tm) Project
 * @since         0.10.0
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 */
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <title><title><?= $this->fetch('title') ?></title></title>
    </head>
    <body>
        <table border="0" cellpadding="14" cellspacing="0" height="100%" width="100%" style="max-width: 800px">
            <tr> 
                <td style="
                    font-weight: 700; 
                    font-size: 20px; 
                    background: #000000;
                    color: #FFFFFF;
                    text-align: center;">
                    APPALOOSA BOOKS<br/>
                </td>
            </tr>
            <tr>
                <td width="100%" align="left" valign="top" >                
                    <?= $this->fetch('content') ?>
                </td>
            </tr>
            <tr> 
                <td style="
                    background: #000000;
                    color: #FFFFFF;
                    text-align: center;">
                    Appaloosa Books : <?= Date('Y') ?> &copy; All Rights Reserved
                </td>
            </tr>
        </table>
    </body>
</html>