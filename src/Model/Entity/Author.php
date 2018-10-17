<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Author Entity
 *
 * @property int $author_id
 * @property int $author_status
 * @property string $author_first_name
 * @property string $author_last_name
 * @property string $author_email
 * @property string $author_links
 * @property string $author_about
 * @property string $author_image
 * @property string $author_options
 * @property \Cake\I18n\FrozenTime $author_created
 * @property \Cake\I18n\FrozenTime $author_modified
 */
class Author extends Entity
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
        'author_status' => true,
        'author_first_name' => true,
        'author_last_name' => true,
        'author_email' => true,
        'author_links' => true,
        'author_about' => true,
        'author_image' => true,
        'author_options' => true,
        'author_created' => true,
        'author_modified' => true
    ];
}
