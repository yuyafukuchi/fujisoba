<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Employees Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Companies
 * @property \Cake\ORM\Association\BelongsTo $Stores
 * @property \Cake\ORM\Association\HasMany $TimeCards
 *
 * @method \App\Model\Entity\Employee get($primaryKey, $options = [])
 * @method \App\Model\Entity\Employee newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Employee[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Employee|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Employee patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Employee[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Employee findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class EmployeesTable extends Table
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

        $this->table('employees');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');
        
        $this->addBehavior('Search.Search');

        $this->belongsTo('Companies', [
            'foreignKey' => 'company_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Stores', [
            'foreignKey' => 'store_id',
            'joinType' => 'INNER'
        ]);
        $this->hasMany('TimeCards', [
            'foreignKey' => 'employee_id'
        ]);
        
        $this->searchManager()
            ->add('deleted', 'Search.Callback', [
                'callback' => function ($query, $args, $type) {
                    $query->where(['Employees.deleted' => $args['deleted']]);
                    return $query;
                }
            ])
           ->add('retired', 'Search.Callback', [
                'callback' => function ($query, $args, $type) {
                    if($args['retired'] =='0'){
                        $query->where(['Employees.retired is' =>null ]);
                    }
                    return $query;
                }
            ])
            ->add('company_id', 'Search.Callback', [
                'callback' => function ($query, $args, $type) {
                    $query->where(['Employees.company_id' => $args['company_id']]);
                    return $query;
                }
            ])
            ->add('name', 'Search.Callback', [
                'callback' => function ($query, $args, $type) {
                    $query->where(['OR' => [['Employees.name_last LIKE' => '%'.$args['name'].'%'], ['Employees.name_first LIKE' => '%'.$args['name'].'%']]]);
                    return $query;
                }
            ])
            
            ->add('store_id', 'Search.Callback', [
                'callback' => function ($query, $args, $type) {
                    $query->where(['Employees.store_id' => $args['store_id']]);
                    return $query;
                }
            ])
            ->add('code', 'Search.Callback', [
                'callback' => function ($query, $args, $type) {
                    $query->where(['Employees.code' => $args['code']]);
                    return $query;
                }
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
            ->requirePresence('code', 'create')
            ->notEmpty('code')
            ->add('code', 'unique', ['rule' => 'validateUnique', 'provider' => 'table']);

        $validator
            ->requirePresence('name_last', 'create')
            ->notEmpty('name_last');

        $validator
            ->requirePresence('name_first', 'create')
            ->notEmpty('name_first');

        $validator
            ->requirePresence('name_last_kana', 'create')
            ->notEmpty('name_last_kana');

        $validator
            ->requirePresence('name_first_kana', 'create')
            ->notEmpty('name_first_kana');

        $validator
            ->requirePresence('company_id', 'create')
            ->notEmpty('company_id');
        
        $validator
            ->requirePresence('store_id', 'create')
            ->notEmpty('store_id');
            
        $validator
            ->requirePresence('contact_type', 'create')
            ->notEmpty('contact_type');

        $validator
            ->dateTime('joined')
            ->allowEmpty('joined');

        $validator
            ->dateTime('retired')
            ->allowEmpty('retired');

        $validator
            ->boolean('deleted')
            ->requirePresence('deleted', 'create')
            ->notEmpty('deleted');

        $validator
            ->allowEmpty('note');

        $validator
            ->boolean('flag')
            ->allowEmpty('flag');

        $validator
            ->integer('regular_amount')
            ->allowEmpty('regular_amount');

        $validator
            ->integer('midnight_amount')
            ->allowEmpty('midnight_amount');

        $validator
            ->integer('other1_amount')
            ->allowEmpty('other1_amount');

        $validator
            ->integer('other2_amount')
            ->allowEmpty('other2_amount');

        $validator
            ->allowEmpty('employee_shift');

        $validator
            ->integer('othershift_start')
            ->allowEmpty('othershift_start');

        $validator
            ->integer('othershift_end')
            ->allowEmpty('othershift_end');

        $validator
            ->integer('created_by')
            ->allowEmpty('created_by');

        $validator
            ->integer('modified_by')
            ->allowEmpty('modified_by');

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
        $rules->add($rules->existsIn(['company_id'], 'Companies'));
        $rules->add($rules->existsIn(['store_id'], 'Stores'));

        return $rules;
    }
}
