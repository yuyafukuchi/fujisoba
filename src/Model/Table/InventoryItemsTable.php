<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * InventoryItems Model
 *
 * @property \Cake\ORM\Association\HasMany $InventoryItemHistories
 * @property \Cake\ORM\Association\HasMany $InventoryPurchaseTransactions
 * @property \Cake\ORM\Association\HasMany $StoreInventoryItemHistories
 *
 * @method \App\Model\Entity\InventoryItem get($primaryKey, $options = [])
 * @method \App\Model\Entity\InventoryItem newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\InventoryItem[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\InventoryItem|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\InventoryItem patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\InventoryItem[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\InventoryItem findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class InventoryItemsTable extends AppTable
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

        $this->table('inventory_items');
        $this->displayField('id');
        $this->primaryKey('id');

        

        $this->hasMany('InventoryItemHistories', [
            'foreignKey' => 'inventory_item_id'
        ]);
        $this->hasMany('InventoryPurchaseTransactions', [
            'foreignKey' => 'inventory_item_id'
        ]);
        $this->hasMany('StoreInventoryItemHistories', [
            'foreignKey' => 'inventory_item_id'
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
            ->integer('created_by')
            ->allowEmpty('created_by');

        $validator
            ->integer('modified_by')
            ->allowEmpty('modified_by');

        return $validator;
    }
}
