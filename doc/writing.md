##### [������� ��������](../readme.md)

# �������� ������

������ ������ �������� ������ ����� ���������� ���������� ��������� ���������� ������������ � ������, ���������� ��� ����� ������ ������, �� �� �� ������� ��� ������ ��������������.

## ����������� ��������� ������ (������)

�������� ����� ������������ ��������� ������ � �������� ��������. ��� ��� ����������� � �������� ��������� ������, � �������� ������ ����� � ����� ��������� ����������� �������� �������� �������. ��� ��������� ������ ����� ��������� ����� ���������� � �����������������. ������ �������� ����� ������ ���������� � ����� �������� � ����� ����� �������� ```TestCase```. ��� �������� ������ �������� ������������ �� �������� ������ ```\WS\BUnit\Cases\BaseCase```. ������������ ���������� ��� ����������� ������ �������� �������� � ������������ � ������.

*������ ���������� ��������� ������*

```php
<?php

/**
 * @label component
 * @author Maxim Sokolovsky <sokolovsky@worksolutions.ru>
 */
class TestingTestCase extends \WS\BUnit\Cases\BaseCase {

    public function setUp() {
        // ������� �������� ��� ������� �������� �������
    }

    /**
     * @test
     */
    public function isTrue() {
        $this->getAssert()->asEmpty(false);
    }

    /**
     * @skip
     * @test
     */
    public function useResultModifier() {
        $rm = new \WS\BUnit\Invokers\ResultModifierInvoker("project:test.with.class");
        $rm->setArResult(array('id' => 10));
        $rm->execute();
        $this->getAssert()->equal($rm->getArResultValue("id"), 10, "Params are not equal");
    }

    /**
     * @throws Exception
     * @label main
     * @test
     */
    public function throwsException() {
        throw new LogicException();
    }

    public function paramsForTest() {
        return array(
            array(false, 10),
            array(false, 20),
            array(true, 30),
        );
    }

    /**
     * Tests whether data more than 25
     * @test
     * @dataProvider paramsForTest
     */
    public function testDataProvider($expected, $number) {
        $actual = $number > 25;
        $this->getAssert()->equal($actual, $expected);
    }

    /**
     * @test
     */
    public function useDB() {
        CModule::IncludeModule("iblock");
        $dbResult = CIBlock::getList(array(), array());
        $this->getAssert()->asTrue($dbResult->AffectedRowsCount() > 0, "Count of iblocks should be more than 0");
    }

    public function tearDown() {
        // ������� ��������� ��������
    }
}

```

��� ������� ��������� ������ ������������ ��� ����������� ������ ```setUp``` � ```tearDown```. ������ ���������� ����� ������� ������� ������ � ������, ������� ����� ��������� ������ ���������� ����� ������. ����� ������������ ���������� � �������� ������.

## ����������� ������

�������� ���������� ����� �������� �������� �������� ������������� ����������� ��������. ����� ���� ���� ���������� ��� ��� ����� ������, � ������ ���� �������� ������ ���� �������� �������� ��� ���� ������ �������� ���������� ������ �����������. ������ �������� ������������ ������ ����������� ������������ �������� �������. �������� ����� � ������ ������ ��������� �������� ```@test```, ������ �� ����� ������� ���� ����� ����� ����������� ��� ����� ������� ������, ��������� ������ �������� ���������������� ��� ���������� ��� ������ ��������� ������.

#### ��������
������ ����� ������ �������� �������� ���� ��������� �������� � �� ��� ������� ���������� ����������. ���� ��������� �� ���������� ���� ���� �� ���� �������� ��������� ������.

*������ ��������*

```php

    // .....

    $this->getAssert()->asTrue($a == 10, "��������� ������� �������� � ������ ���� �������� ����� �� ��������");

    // .....
```

���������� ��������� ������� ��������:

- ```asTrue($actual, $message = "")``` - �������� ����������� �������� �� ����������;
- ```asFalse($actual, $message = "")``` - �������� ����������� �������� �� ���������;
- ```same($actual, $expected, $message = "")``` - ������� ��������� ���� ��������, ��� �������� ������ ������ ��������� �� ���� � ��� �� ������, ��� ������� ����� ������ - ��������� ���������� �� ���� � ��������;
- ```equal($actual, $expected, $message = "")``` - ��������� ��������� ��������;
- ```notEqual($actual, $expected, $message = "")``` - �������� �������� �� ��������;
- ```asEmpty($actual, $message = "")``` - �������� �������� �� �������;
- ```fail($message = "")``` - ����� �������� ������� ������, � �������� ������������ � ���� � �������� ���������� ��� �������� ����������:
```php

    // ...

    } catch (Exception $e) {
        $this->fail("����� ���������� �������� �������� ��������� �����������");
    }
```

����� � ������ ����� ������������� ������� ���������� � � ����������� ������ �������� �� �������������� �������� ����������� ���������� � ���������� �������. ������ ���� ��������� �������������� �������� � ������ ���������� ������������� ���������� - ���� ��������� ���������. �������� ���������� ����������� ��������� ```@throws``` � ����������� � ��������� ������.
```php

    /**
     * @throws Exception
     * @test
     */
    public function throwsException() {
        // ���� ����� �������, ��� ��� ��������� ������ ����������
        throw new LogicException();
    }

    /**
     * @throws InvalidArgumentException
     * @test
     */
    public function excptionInDepth() {
        $object = new SomeObject();
        $object->setArray(10);
    }
```

## ��������� ������ � ������
��� ����������� ������������� ������� ������ ����� �������������� �����, ������������ ��� �������� ������ � �������� �������. ����� �������� ��������� ```@label``` ����� � ����������� � ��������� ������ ��� ��������� ������ (������) �������. ������ ����� ������ ������ ������������ �� ��� �����. ����� ����� ��������������� ������������� ��� ������� �����. ����� ���������� ��������� ����� ��� ������ � �������.

```php

    /**
     * @test
     *
     * @throws InvalidArgumentException
     *
     * @label nagative
     * @label core
     */
    public function excptionInDepth() {
        $object = new SomeObject();
        $object->setArray(10);
    }

```

## ������� ���������� ������
������ ����� ������������� ������� ���������� ������ ��� ����������. ��� ������ ����� ���������� �������� ��� ���� ���� ������ �� ����� ��� ��������� ��������� ������ ��� ������� �����������. �������� ```@skip``` ��������� �� ��, ��� ���� ��� ������� ����� ������ ����������. ��� �� ����� ���������� � �������� �����.

```php

    /**
     * @test
     * @skip ���� �� ����� �������� ��������� ����������
     *
     * @throws InvalidArgumentException
     *
     * @label nagative
     * @label core
     */
    public function excptionInDepth() {
        $object = new SomeObject();
        $object->setArray(10);
    }
```

## ���������� ������������ � ������������� ������� (��������� ������)
��� ���������� ������ � ���� �� ��������� ������������ � ������� ������� ���������� ���������� ```��������� ������``` ��� ���������� �������� ���� ����������� ��������� ��� � ������� �������.

```php

    /**
     * Data provider for testMoreThan25
     */
    public function listOfData() {
        return array(
            // ������ ������� - ���������, ��������� ���������
            array(false, 10),
            array(false, 20),
            array(true, 30),
        );
    }

    /**
     * Tests whether data more than 25
     * @test
     * @dataProvider listOfData
     */
    public function testMoreThan25($expected, $number) {
        $actual = $number > 25;
        $this->getAssert()->equal($actual, $expected);
    }
```

����� ������� ���� ```testMoreThan25``` ����� ������� 3 ���� (�� ����� ��������� ���������� ������ ```listOfData```). ������ �� ��������� ���������� ���������� ������ ������ ���� ��������. �������� ������� ����� �������� � �������� ���������� � �������� �����. ������� ������ ���������� ��������� ��������� ���������, ����� �������� ������. ��� �������� ��� ���� ����� ��� ��������� ������ �������� ������ �������� ���������� ������� ����������.

## ��� �������� �� ��������

CMS ������� ����� ���� ���������� ���������� ��������. �������� �� ��� ������� ��������� ������������ �������� �����, ���: ���������� �������, ����� � ������� �� ������� �������.

������ ��������� ������������ ��������� ������� � ��� ����������� ��� �������� �������� �������.

#### ������������ ������ ����������

��� ������ � ������������ ���� ���������� ������������ ����� ```\WS\BUnit\Invokers\ComponentInvoker```

������ ������:

- ```__constructor($componentName)``` - ������������� ������� ������� ����������, ��� ���������� ����� �� ��� � ������ ```CMain::IncludeComponent()``` ����;
- ```setParams($params)``` - ������������� ��������� ��� ������� ������������� ����������;
- ```execute()``` - ��������� ��������� �� ���������� (������ ��� ���� �� ������������);
- ```getResultValue($name)``` - ��������� �������� $arResult �� ����� $name;
- ```getArResult()``` - ��������� ������ $arResult ������ ����������;
- ```getExecuteResult()``` - ��������� ��������� ������ ����������, ����� � ���� ���������� ������������ �������� ������� ```return```.

```php

    // ...

    /**
     * @label component
     * @test
     */
    public function useComponentInvoker() {
        $component = new \WS\BUnit\Invokers\ComponentInvoker("project:test.component");
        $component->setParams(array('id' => 10));
        $component->execute();
        $this->getAssert()->equal($component->getResultValue("id"), 10, "��������� �� �����");
    }
```

#### ������������ ������ �������� �������� (result_modifier)

����������� result_modifier ������� ���������� ����� �������� ������ ```\WS\BUnit\Invokers\ResultModifierInvoker```.

������:

- ```__construct($componentName, $template)``` - ������������� �������, ��������� ��������� � ����������� ������ ```CMain::IncludeComponent()```;
- ```setArResult($arResult)``` - ������������� ��������� ���������� ��� �������� ��������;
- ```execute()``` - ������ �������� �� ����������;
- ```getArResult()``` - ��������� ������ ```$arResult``` ������ ��������;
- ```getArResultValue($name)``` - �������� ���������� ������ �������� �� ����� ```$name```;

```php

    /**
     * @label component
     * @test
     */
    public function modifierForSomeTemplate() {
        $rm = new \WS\BUnit\Invokers\ResultModifierInvoker("project:test.with.class", "list");
        $rm->setArResult(array('id' => 10));
        $rm->execute();
        $this->getAssert()->equal($rm->getArResultValue("id"), 10, "Params are not equal");
    }
```

#### ������������ ��������� �������

����� ```WS\BUnit\Invokers\EventInvoker``` ��������� ������������ ��������� �������.

������:

- ```__construct($module, $eventName)``` - ������������� ������� ������� �������, $module - ��� ������ ������� �������, $eventName - �������� �������;
- ```setExecuteParams($params)``` - ��������� ���������� ������� � ���� �������, ����� �������� � ��������� �������;
- ```execute()``` - ������ �������;
- ```countOfHandlers()``` - ��������� ���������� ������������ �������;
- ```getEvent()``` - ��������� ������� �������;

```php

    // ...

    /**
     * @test
     */
    public function handlersOfEventExist() {
        $eventInvoker = new \WS\BUnit\Invokers\EventInvoker("main", "OnPageStart");
        $eventInvoker->setExecuteParams(array(
            "IBLOCK_ID" => 12
        ));
        $eventInvoker->execute();

        $this->getAssert()->asTrue($eventInvoker->countOfHandlers() > 1);
    }
```