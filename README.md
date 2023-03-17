jQuery QueryBuilder Extension for Yii 2
=======================================

This is the jQuery QueryBuilder extension for Yii 2. It encapsulates QueryBuilder component in terms of Yii widgets,
and thus makes using QueryBuilder component in Yii applications extremely easy

[![Yii2](https://img.shields.io/badge/Powered_by-Yii_Framework-green.svg?style=flat)](http://www.yiiframework.com/)
[![Latest Stable Version](https://poser.pugx.org/riskivy/yii2-querybuilder/v/stable.png)](https://packagist.org/packages/riskivy/yii2-querybuilder)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/riskivy/yii2-querybuilder/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/riskivy/yii2-querybuilder/?branch=master)
[![Code Coverage](https://scrutinizer-ci.com/g/riskivy/yii2-querybuilder/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/riskivy/yii2-querybuilder/?branch=master)
[![Build Status](https://travis-ci.org/riskivy/yii2-querybuilder.svg?branch=master)](https://travis-ci.org/riskivy/yii2-querybuilder)
[![Code Climate](https://codeclimate.com/github/riskivy/yii2-querybuilder/badges/gpa.svg)](https://codeclimate.com/github/riskivy/yii2-querybuilder)
[![Total Downloads](https://poser.pugx.org/riskivy/yii2-querybuilder/downloads.png)](https://packagist.org/packages/riskivy/yii2-querybuilder)


Installation
------------

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```
php composer.phar require --prefer-dist riskivy/yii2-querybuilder "*"
```

or add

```
"riskivy/yii2-querybuilder": "*"
```

to the require section of your `composer.json` file.

How to use
----------

The extension depends the bootstrap css then is necessary adds it in `AppAsset`:

```php
class AppAsset extends AssetBundle {

    ...

    public $depends = [
        ...
        'yii\bootstrap\BootstrapAsset', // or 'yii\bootstrap4\BootstrapAsset'
    ];

}
```

**View**:

```php

use riskivy\querybuilder\QueryBuilderForm;

<?php QueryBuilderForm::begin([
    'rules' => $rules,
    'builder' => [
        'id' => 'query-builder',
        'pluginOptions' => [
            'filters' => [
                ['id' => 'id', 'label' => 'Id', 'type' => 'integer'],
                ['id' => 'name', 'label' => 'Name', 'type' => 'string'],
                ['id' => 'lastName', 'label' => 'Last Name', 'type' => 'string']
            ]
        ]
    ]
 ])?>

    <?= Html::submitButton('Apply'); ?>
    <?= Html::resetButton('Reset'); ?>

<?php QueryBuilderForm::end() ?>
```

**Controller**:

```php

use riskivy\querybuilder\Translator;

public function actionIndex()
{
    $query = Customer::find();
    $rules = Json::decode(Yii::$app->request->get('rules'));
    if ($rules) {
        $translator = new Translator($rules);
        $query->andWhere($translator->where())
              ->addParams($translator->params());
    }

    $dataProvider = new ActiveDataProvider([
        'query' => $query,
    ]);

    return $this->render('index', [
        'dataProvider' => $dataProvider,
        'rules' => $rules
    ]);
}
```
