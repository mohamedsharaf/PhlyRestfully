<?php
/**
 * @link      https://github.com/weierophinney/PhlyRestfully for the canonical source repository
 * @copyright Copyright (c) 2013 Matthew Weier O'Phinney
 * @license   http://opensource.org/licenses/BSD-2-Clause BSD-2-Clause
 * @package   PhlyRestfully
 */

namespace PhlyRestfullyTest;

use PhlyRestfully\HalResource;
use PHPUnit_Framework_TestCase as TestCase;
use stdClass;

class HalResourceTest extends TestCase
{
    public function invalidResources()
    {
        return array(
            'null'       => array(null),
            'true'       => array(true),
            'false'      => array(false),
            'zero-int'   => array(0),
            'int'        => array(1),
            'zero-float' => array(0.0),
            'float'      => array(1.1),
            'string'     => array('string'),
        );
    }

    /**
     * @dataProvider invalidResources
     */
    public function testConstructorRaisesExceptionForNonObjectNonArrayResource($resource)
    {
        $this->setExpectedException('PhlyRestfully\Exception\InvalidResourceException');
        $hal = new HalResource($resource, 'id', 'route');
    }

    public function testPropertiesAreAccessibleAfterConstruction()
    {
        $resource = new stdClass;
        $hal  = new HalResource($resource, 'id', 'route', array('foo' => 'bar'));
        $this->assertSame($resource, $hal->resource);
        $this->assertEquals('id', $hal->id);
        $this->assertEquals('route', $hal->route);
        $this->assertEquals(array('foo' => 'bar'), $hal->routeParams);
    }
}
