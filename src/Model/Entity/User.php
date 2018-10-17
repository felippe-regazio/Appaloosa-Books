<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * User Entity
 *
 * @property int $id
 * @property string $role
 * @property int $status
 * @property string $first_name
 * @property string $last_name
 * @property string $email
 * @property string $pass
 * @property \Cake\I18n\FrozenDate $birth
 * @property string $image
 * @property string $options
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 */
class User extends Entity
{

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array
     */
    protected $_accessible = [
        'role' => true,
        'status' => true,
        'first_name' => true,
        'last_name' => true,
        'email' => true,
        'pass' => true,
        'birth' => true,
        'image' => true,
        'options' => true,
        'created' => true,
        'modified' => true
    ];
}
