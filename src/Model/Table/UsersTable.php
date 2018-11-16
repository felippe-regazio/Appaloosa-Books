<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\Utility\Security;
use Cake\I18n\Time;

/**
 * Users Model
 *
 * @method \App\Model\Entity\User get($primaryKey, $options = [])
 * @method \App\Model\Entity\User newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\User[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\User|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\User patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\User[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\User findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class UsersTable extends Table
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

        $this->setTable('users');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->hasOne('authors', [
            'foreignKey' => 'author_id',
            'dependent' => true
        ]);        
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
            ->integer('id')
            ->allowEmpty('id', 'create');

        $validator
            ->scalar('role')
            ->maxLength('role', 10)
            ->allowEmpty('role');

        $validator
            ->integer('status')
            ->allowEmpty('status');

        $validator
            ->scalar('first_name')
            ->maxLength('first_name', 50)
            ->allowEmpty('first_name');

        $validator
            ->scalar('last_name')
            ->maxLength('last_name', 50)
            ->allowEmpty('last_name');

        $validator
            ->email('email')
            ->allowEmpty('email');

        $validator
            ->scalar('pass')
            ->maxLength('pass', 100)
            ->allowEmpty('pass');

        $validator
            ->date('birth')
            ->allowEmpty('birth');

        $validator
            ->scalar('image')
            ->maxLength('image', 200)
            ->allowEmpty('image');

        $validator
            ->scalar('options')
            ->allowEmpty('options');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules)
    {
        $rules->add($rules->isUnique(['email']));

        return $rules;
    }

    /*
        Get user credentials by email,
        Return @array with id, status, user, pass
    */
    public function getCredentialsByEmail( $email ){
        return $query = $this->find( 'all', array(
                'fields' => ['id', 'status', 'email', 'pass'],
                'conditions'=> array('users.email' => $email)
            )
        )->first();
    }

    /*
        Get user data searching by email,
        Return @array with user data, or null
    */
    public function getDataByEmail( $email ){
        return $query = $this->find( 'all', array(
                'conditions'=> array('users.email' => $email)
            )
        )->first();
    }

    /*
        Get user data with all inner joins
        Searching by id
    */
    public function getAllUserDataById($id){
        $query = $this->get($id, [
            'contain' => ['authors']
        ]);
        return $query;
    }

    /*
        Update user data by id, receives, an array 
        of data ('field' => 'value') and the id
    */
    public function updateUserData( $data, $id ){
        $this->query()->update()
        ->set( $data )
        ->where(['id'=>$id])
        ->execute();
    }

    /*
        Update user pass by email
    */
    public function setNewPass( $email, $rawpass ){
        $newpass = Security::hash( $rawpass, 'sha1', true );
        $this->query()->update()
        ->set(['pass' => $newpass])
        ->where(['email' => $email])
        ->execute();
    }

    /*
        bring all users
    */
    public function listAll(){
        $result = $this->find()
        ->contain('authors')
        ->select([
            'users.id',
            'users.role',
            'users.first_name',
            'users.last_name',
            'users.email',
            'users.status',
            'authors.author_first_name',
            'authors.author_last_name',
            'authors.author_email',
        ])
        ->all();
        return $result;
    }    
}
