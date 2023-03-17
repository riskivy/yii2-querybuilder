<?php

namespace riskivy\querybuilder;

/**
 * QueryBuilder renders a jQuery QueryBuilder component.
 *
 * @see http://mistic100.github.io/jQuery-QueryBuilder/
 * @author Leandro Gehlen <riskivy@gmail.com>
 */
class QueryBuilder extends \soluto\plugin\Widget {

    /**
     * @inheridoc
     */
    public $pluginName = 'queryBuilder';

    /**
     * @inheritdoc
     */
    protected function assets()
    {
        return [
            QueryBuilderAsset::className()
        ];
    }

}
