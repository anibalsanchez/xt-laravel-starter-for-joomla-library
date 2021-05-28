<?php
/* This file has been prefixed by <PHP-Prefixer> for "XT Laravel Starter for Joomla" */

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Extly\Symfony\Component\HttpKernel\DataCollector;

use Extly\Symfony\Component\VarDumper\Caster\CutStub;
use Extly\Symfony\Component\VarDumper\Caster\ReflectionCaster;
use Extly\Symfony\Component\VarDumper\Cloner\ClonerInterface;
use Extly\Symfony\Component\VarDumper\Cloner\Data;
use Extly\Symfony\Component\VarDumper\Cloner\Stub;
use Extly\Symfony\Component\VarDumper\Cloner\VarCloner;

/**
 * DataCollector.
 *
 * Children of this class must store the collected data in the data property.
 *
 * @author Fabien Potencier <fabien@symfony.com>
 * @author Bernhard Schussek <bschussek@symfony.com>
 */
abstract class DataCollector implements DataCollectorInterface
{
    /**
     * @var array|Data
     */
    protected $data = [];

    /**
     * @var ClonerInterface
     */
    private $cloner;

    /**
     * Converts the variable into a serializable Data instance.
     *
     * This array can be displayed in the template using
     * the VarDumper component.
     *
     * @param mixed $var
     *
     * @return Data
     */
    protected function cloneVar($var)
    {
        if ($var instanceof Data) {
            return $var;
        }
        if (null === $this->cloner) {
            $this->cloner = new VarCloner();
            $this->cloner->setMaxItems(-1);
            $this->cloner->addCasters($this->getCasters());
        }

        return $this->cloner->cloneVar($var);
    }

    /**
     * @return callable[] The casters to add to the cloner
     */
    protected function getCasters()
    {
        $casters = [
            '*' => function ($v, array $a, Stub $s, $isNested) {
                if (!$v instanceof Stub) {
                    foreach ($a as $k => $v) {
                        if (\is_object($v) && !$v instanceof \DateTimeInterface && !$v instanceof Stub) {
                            $a[$k] = new CutStub($v);
                        }
                    }
                }

                return $a;
            },
        ] + ReflectionCaster::UNSET_CLOSURE_FILE_INFO;

        return $casters;
    }

    /**
     * @return array
     */
    public function __sleep()
    {
        return ['data'];
    }

    public function __wakeup()
    {
    }

    /**
     * @internal to prevent implementing \Serializable
     */
    final protected function serialize()
    {
    }

    /**
     * @internal to prevent implementing \Serializable
     */
    final protected function unserialize($data)
    {
    }
}
