<?php

return array(
    'name' => 'WS BUnit',
    'description' => '��������� ������������ �������� CMS Bitrix.',
    'partner' => array(
        'name' => '������� �������',
        'url' => 'http://www.worksolutions.ru'
    ),
    'setup' => array(
        'up' => '��������� ������ bunit',
        'down' => '������������ ������ bunit'
    ),
    'install' => array(
        'error' => array(
            'files' => '�� ������� ����������� ����� � ����������� `bitrix/php_interface` � `bitrix/tools`, ��������� ����������� ������ ������'
        ),
        'success' => '������ bunit ����������. ������� �������.'
    ),
    'uninstall' => array(
        'error' => array(
            'files' => '�� ������� ������� ����� �� ���������� `bitrix/tools`, ��������� ����������� �������� ������'
        ),
        'success' => '������ ������� ������ �� �������'
    )
);
