<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\I18n\Time;

/**
 * Authors Model
 *
 * @method \App\Model\Entity\Author get($primaryKey, $options = [])
 * @method \App\Model\Entity\Author newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Author[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Author|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Author patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Author[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Author findOrCreate($search, callable $callback = null, $options = [])
 */
class AuthorsTable extends Table
{

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->setTable('authors');
        $this->setDisplayField('author_id');
        $this->setPrimaryKey('author_id');
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator)
    {
        $validator
            ->integer('author_id')
            ->allowEmpty('author_id', 'create');

        $validator
            ->integer('author_status')
            ->allowEmpty('author_status');

        $validator
            ->scalar('author_first_name')
            ->maxLength('author_first_name', 50)
            ->allowEmpty('author_first_name');

        $validator
            ->scalar('author_last_name')
            ->maxLength('author_last_name', 50)
            ->allowEmpty('author_last_name');

        $validator
            ->scalar('author_email')
            ->maxLength('author_email', 50)
            ->allowEmpty('author_email');

        $validator
            ->scalar('author_links')
            ->allowEmpty('author_links');

        $validator
            ->scalar('author_about')
            ->allowEmpty('author_about');

        $validator
            ->scalar('author_image')
            ->maxLength('author_image', 200)
            ->allowEmpty('author_image');

        $validator
            ->scalar('author_options')
            ->allowEmpty('author_options');

        $validator
            ->dateTime('author_created')
            ->allowEmpty('author_created');

        $validator
            ->dateTime('author_modified')
            ->allowEmpty('author_modified');

        return $validator;
    }

    /*
        Get user data searching by email,
        Return @array with user data, or null
    */
    public function getDataById( $id ){
        $query = $this->find( 'all',
            array(
                'conditions'=> array('authors.author_id' => $id)
            )
        );
        return $query->first();
    }

    /*
        Creates a new author row based
        on an User account id
    */
    public function createAuthorProfile( $id ){
        $author = $this->newEntity();
        
        $author->author_id = $id;
        $author->author_created = Time::now();

        $this->save( $author );
    }

    /*
        Updates the author data by id
    */
    public function updateAuthorData( $data, $id ){
        $this->query()->update()
            ->set( $data )
            ->where(['author_id'=>$id])
            ->execute();        
    }

    /*
        bring all users
    */
    public function listAll(){
        $result = $this->find()->all();
        return $result;
    }

    /*
        get all author data by id
    */
    public function getAllAuthorDataById($id){
        $query = $this->get($id);
        return $query;
    }   

    /*
        get author email by id
    */
    public function getAuthorEmailById($id){
        $query = $this->find( "all", [
            "fields" => ["author_email", "author_first_name", "author_last_name"],
            "conditions" => [ "authors.author_id" => $id ]
        ])->toArray();
        $result = $query;
        return $result;
    }

    /*
        get allAuthorNames
    */
    public function getAuthorsNameList(){
        $result = $this->find()
        ->select(["author_id", "author_first_name", "author_last_name"])
        ->where(["author_status" => "1" ])
        ->order(["author_first_name"]);
        return $result;
    }       
}
