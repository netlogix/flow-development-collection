<?php
namespace TYPO3\Eel\Tests\Unit\FlowQuery\Operations;

/*
 * This file is part of the TYPO3.Eel package.
 *
 * (c) Contributors of the Neos Project - www.neos.io
 *
 * This package is Open Source Software. For the full copyright and license
 * information, please view the LICENSE file which was distributed with this
 * source code.
 */

use TYPO3\Eel\FlowQuery\Operations\SliceOperation;

/**
 * SliceOperation test
 */
class SliceOperationTest extends \TYPO3\Flow\Tests\UnitTestCase
{
    public function sliceExamples()
    {
        return array(
            'no argument' => array(array('a', 'b', 'c'), array(), array('a', 'b', 'c')),
            'empty array' => array(array(), array(1), array()),
            'empty array with end' => array(array(), array(1, 5), array()),
            'slice in bounds' => array(array('a', 'b', 'c', 'd'), array(1, 3), array('b', 'c')),
            'positive start' => array(array('a', 'b', 'c', 'd'), array(2), array('c', 'd')),
            'negative start' => array(array('a', 'b', 'c', 'd'), array(-1), array('d')),
            'end out of bounds' => array(array('a', 'b', 'c', 'd'), array(3, 10), array('d')),
            'negative start and end' => array(array('a', 'b', 'c', 'd'), array(-3, -1), array('b', 'c')),
        );
    }

    /**
     * @test
     * @dataProvider sliceExamples
     */
    public function evaluateSetsTheCorrectPartOfTheContextArray($value, $arguments, $expected)
    {
        $flowQuery = new \TYPO3\Eel\FlowQuery\FlowQuery($value);

        $operation = new SliceOperation();
        $operation->evaluate($flowQuery, $arguments);

        $this->assertEquals($expected, $flowQuery->getContext());
    }
}
