<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Book Entity
 *
 * @property int $id
 * @property string $asbn
 * @property int $status
 * @property string $title
 * @property int $author_id
 * @property string $cover
 * @property string $description
 * @property string $short_description
 * @property string $gender_id
 * @property \Cake\I18n\FrozenTime $publish_date
 * @property string $files
 * @property string $reviewer_id
 * @property int $views
 * @property string $options
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $last_access
 *
 * @property \App\Model\Entity\Author $author
 * @property \App\Model\Entity\Gender $gender
 * @property \App\Model\Entity\Reviewer $reviewer
 */
class Book extends Entity
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
        'asbn' => true,
        'status' => true,
        'title' => true,
        'author_id' => true,
        'cover' => true,
        'description' => true,
        'short_description' => true,
        'gender_id' => true,
        'publish_date' => true,
        'files' => true,
        'reviewer_id' => true,
        'views' => true,
        'options' => true,
        'created' => true,
        'last_access' => true,
        'author' => true,
        'gender' => true,
        'reviewer' => true
    ];
}
