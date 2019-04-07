Conversion of inactive links in the text
================

A small extension to convert active links in the text to active (clickable).
It can convert html or text, it is possible to convert on the client (js) as well as on the backend (php).

Небольшое расширение для преобразования активных ссылок в тексте в активные (кликабельные).
Может преобразовывать html или текст, возможно преобразовывать на клиенте (js) а так же на бэкенде (php).

Installation
------------

```sh
$ composer require skeeks/text-to-active-links "^0.0.3"
```

Or add this to your `composer.json` file:

```json
{
    "require": {
        "skeeks/text-to-active-links": "^0.0.3"
    }
}
```

Client replace (on js)
-----

```php
<?
\skeeks\yii2\linkActivation\assets\TextHandlerAsset::register($this);
$this->registerJs(<<<JS
new sx.classes.LinkActivation(".description");
JS
);
?>
```
```html
<div class="description">
Каокй то текст со ссылками https://test.ru,
http:://google.ru/search
</div>
```


Backend replace
-----

```php
<?
    $handler = new \skeeks\yii2\linkActivation\TextHandler();
    $handler->short_link_max_length = 45;
    echo $handler->replace($yourText);
?>
```

```php
<?= (new \skeeks\yii2\linkActivation\TextHandler())->replace($yourText); ?>
```





https://cms.skeeks.com/~crm/crm/crm-task/view?pk=440
https://cms.skeeks.com/~crm/crm/crm-task/view?pk=407
https://skeeks.com/~crm/crm/crm-task/view?pk=464 - пропадает первая ссылка
https://skeeks.com/~crm/crm/crm-task/view?pk=456 - лишний слеш
https://skeeks.com/~crm/crm/crm-task/view?pk=335 - 

___

> [![skeeks!](https://skeeks.com/img/logo/logo-no-title-80px.png)](https://skeeks.com)  
<i>SkeekS CMS (Yii2) — quickly, easily and effectively!</i>  
[skeeks.com](https://skeeks.com) | [cms.skeeks.com](https://cms.skeeks.com)

