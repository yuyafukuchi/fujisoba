<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * MonthlyTimeCards Model
 *
 * @property \App\Model\Table\EmployeesTable|\Cake\ORM\Association\BelongsTo $Employees
 *
 * @method \App\Model\Entity\MonthlyTimeCard get($primaryKey, $options = [])
 * @method \App\Model\Entity\MonthlyTimeCard newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\MonthlyTimeCard[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\MonthlyTimeCard|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\MonthlyTimeCard patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\MonthlyTimeCard[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\MonthlyTimeCard findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class MonthlyTimeCardsTable extends Table
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

        $this->setTable('monthly_time_cards');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');
        $this->addBehavior('Muffin/Footprint.Footprint');
        $this->addBehavior('Search.Search');

        $this->belongsTo('Employees', [
            'foreignKey' => 'employee_id',
            'joinType' => 'INNER'
        ]);

        $this->searchManager()
            ->add('deleted', 'Search.Callback', [
                'callback' => function ($query, $args, $type) {
                    $query->where(['MonthlyTimeCards.deleted' => $args['deleted']]);
                    return $query;
                }
            ])
            ->add('retired', 'Search.Callback', [
                'callback' => function ($query, $args, $type) {
                    if($args['retired'] =='0'){
                        $query->where([
                            'OR' => [
                                ['Employees.retired is' => null],
                                ['Employees.retired >=' => date('Y-m-d 00:00:00', strtotime('+1 day'))],
                            ],
                        ]);
                    }

                    return $query;
                }
            ])
            ->add('dateQuery', 'Search.Callback', [
                'callback' => function ($query, $args, $type) {
                    $query->where([
                            'AND' => [
                                ['MonthlyTimeCards.date >=' => $args['dateQuery']],
                                ['MonthlyTimeCards.date <' => date('Y-m-d', strtotime($args['dateQuery'] . ' +1 month'))],
                            ],
                        ]);

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
                    $query->where([
                        'OR' => [
                            ['Employees.name_last LIKE' => '%'.$args['name'].'%'],
                            ['Employees.name_first LIKE' => '%'.$args['name'].'%'],
                            ['Employees.name_last_kana LIKE' => '%'.$args['name'].'%'],
                            ['Employees.name_first_kana LIKE' => '%'.$args['name'].'%'],
                        ],
                    ]);
                    return $query;
                }
            ])

            ->add('store_id', 'Search.Callback', [
                'callback' => function ($query, $args, $type) {
                    //$query->where(['Employees.store_id' => $args['store_id']]);
                    return $query;
                }
            ])
            ->add('code', 'Search.Callback', [
                'callback' => function ($query, $args, $type) {
                    $query->where(['Employees.code LIKE' => '%' . $args['code'] . '%']);
                    return $query;
                }
            ])
            ->add('printed', 'Search.Callback', [
                'callback' => function ($query, $args, $type) {
                    if($args['printed'] === '1'){
                        $query->where(['MonthlyTimeCards.printed' => false]);
                    }
                    return $query;
                }
            ])
            ->add('approved', 'Search.Callback', [
                'callback' => function ($query, $args, $type) {
                    if($args['approved'] === '1'){
                        $query->where(['MonthlyTimeCards.approved' => false]);
                    }
                    return $query;
                }
            ])
            ->add('csv_exported', 'Search.Callback', [
                'callback' => function ($query, $args, $type) {
                    if($args['csv_exported'] === '1'){
                        $query->where(['MonthlyTimeCards.csv_exported' => false]);
                    }
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
            ->date('date')
            ->requirePresence('date', 'create')
            ->notEmpty('date');

        $validator
            ->dateTime('latest_emboss_day')
            ->allowEmpty('latest_emboss_day');

        $validator
            ->boolean('finished');

        $validator
            ->boolean('printed');

        $validator
            ->boolean('approved');

        $validator
            ->boolean('csv_exported');

        $validator
            ->boolean('deleted');

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
        $rules->add($rules->existsIn(['employee_id'], 'Employees'));

        return $rules;
    }
}
