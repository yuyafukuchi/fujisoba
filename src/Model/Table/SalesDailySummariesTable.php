<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * SalesDailySummaries Model
 *
 * @property \App\Model\Table\StoresTable|\Cake\ORM\Association\BelongsTo $Stores
 *
 * @method \App\Model\Entity\SalesDailySummary get($primaryKey, $options = [])
 * @method \App\Model\Entity\SalesDailySummary newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\SalesDailySummary[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\SalesDailySummary|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\SalesDailySummary patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\SalesDailySummary[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\SalesDailySummary findOrCreate($search, callable $callback = null, $options = [])
 */
class SalesDailySummariesTable extends Table
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

        $this->setTable('sales_daily_summaries');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('Stores', [
            'foreignKey' => 'store_id'
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
            ->date('transaction_date')
            ->allowEmpty('transaction_date');

        $validator
            ->integer('cash_sales_amount')
            ->allowEmpty('cash_sales_amount');

        $validator
            ->integer('sales_amount')
            ->allowEmpty('sales_amount');

        $validator
            ->integer('pasumo_sales_amount')
            ->allowEmpty('pasumo_sales_amount');

        $validator
            ->integer('early_shift_amount')
            ->allowEmpty('early_shift_amount');

        $validator
            ->integer('middle_shift_amount')
            ->allowEmpty('middle_shift_amount');

        $validator
            ->integer('late_shift_amount')
            ->allowEmpty('late_shift_amount');

        $validator
            ->integer('sales_amount_correct')
            ->allowEmpty('sales_amount_correct');

        $validator
            ->integer('pasumo_sales_amount_correct')
            ->allowEmpty('pasumo_sales_amount_correct');

        $validator
            ->integer('early_shift_amount_correct')
            ->allowEmpty('early_shift_amount_correct');

        $validator
            ->integer('middle_shift_amount_correct')
            ->allowEmpty('middle_shift_amount_correct');

        $validator
            ->integer('late_shift_amount_correct')
            ->allowEmpty('late_shift_amount_correct');

        $validator
            ->scalar('note')
            ->allowEmpty('note');

        $validator
            ->integer('vendor_no1_amount')
            ->allowEmpty('vendor_no1_amount');

        $validator
            ->integer('vendor_no2_amount')
            ->allowEmpty('vendor_no2_amount');

        $validator
            ->integer('amount_7to8')
            ->allowEmpty('amount_7to8');

        $validator
            ->integer('amount_8to9')
            ->allowEmpty('amount_8to9');

        $validator
            ->integer('amount_9to10')
            ->allowEmpty('amount_9to10');

        $validator
            ->integer('amount_10to11')
            ->allowEmpty('amount_10to11');

        $validator
            ->integer('amount_11to12')
            ->allowEmpty('amount_11to12');

        $validator
            ->integer('amount_12to13')
            ->allowEmpty('amount_12to13');

        $validator
            ->integer('amount_13to14')
            ->allowEmpty('amount_13to14');

        $validator
            ->integer('amount_14to15')
            ->allowEmpty('amount_14to15');

        $validator
            ->integer('amount_15to16')
            ->allowEmpty('amount_15to16');

        $validator
            ->integer('amount_16to17')
            ->allowEmpty('amount_16to17');

        $validator
            ->integer('amount_17to18')
            ->allowEmpty('amount_17to18');

        $validator
            ->integer('amount_18to19')
            ->allowEmpty('amount_18to19');

        $validator
            ->integer('amount_19to20')
            ->allowEmpty('amount_19to20');

        $validator
            ->integer('amount_20to21')
            ->allowEmpty('amount_20to21');

        $validator
            ->integer('amount_21to22')
            ->allowEmpty('amount_21to22');

        $validator
            ->integer('amount_22to23')
            ->allowEmpty('amount_22to23');

        $validator
            ->integer('amount_23to24')
            ->allowEmpty('amount_23to24');

        $validator
            ->integer('amount_24to1')
            ->allowEmpty('amount_24to1');

        $validator
            ->integer('amount_1to2')
            ->allowEmpty('amount_1to2');

        $validator
            ->integer('amount_2to3')
            ->allowEmpty('amount_2to3');

        $validator
            ->integer('amount_3to4')
            ->allowEmpty('amount_3to4');

        $validator
            ->integer('amount_4to5')
            ->allowEmpty('amount_4to5');

        $validator
            ->integer('amount_5to6')
            ->allowEmpty('amount_5to6');

        $validator
            ->integer('amount_6to7')
            ->allowEmpty('amount_6to7');

        $validator
            ->integer('created_by')
            ->allowEmpty('created_by');

        $validator
            ->dateTime('created_date')
            ->allowEmpty('created_date');

        $validator
            ->integer('updated_by')
            ->allowEmpty('updated_by');

        $validator
            ->dateTime('updated_date')
            ->allowEmpty('updated_date');

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
        $rules->add($rules->existsIn(['store_id'], 'Stores'));

        return $rules;
    }
}
