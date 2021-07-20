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

namespace Extly\Symfony\Component\VarDumper\Cloner;

use Extly\Symfony\Component\VarDumper\Caster\Caster;
use Extly\Symfony\Component\VarDumper\Exception\ThrowingCasterException;

/**
 * AbstractCloner implements a generic caster mechanism for objects and resources.
 *
 * @author Nicolas Grekas <p@tchwork.com>
 */
abstract class AbstractCloner implements ClonerInterface
{
    public static $defaultCasters = [
        '__PHP_Incomplete_Class' => ['Extly\Symfony\Component\VarDumper\Caster\Caster', 'castPhpIncompleteClass'],

        'Extly\Symfony\Component\VarDumper\Caster\CutStub' => ['Extly\Symfony\Component\VarDumper\Caster\StubCaster', 'castStub'],
        'Extly\Symfony\Component\VarDumper\Caster\CutArrayStub' => ['Extly\Symfony\Component\VarDumper\Caster\StubCaster', 'castCutArray'],
        'Extly\Symfony\Component\VarDumper\Caster\ConstStub' => ['Extly\Symfony\Component\VarDumper\Caster\StubCaster', 'castStub'],
        'Extly\Symfony\Component\VarDumper\Caster\EnumStub' => ['Extly\Symfony\Component\VarDumper\Caster\StubCaster', 'castEnum'],

        'Closure' => ['Extly\Symfony\Component\VarDumper\Caster\ReflectionCaster', 'castClosure'],
        'Generator' => ['Extly\Symfony\Component\VarDumper\Caster\ReflectionCaster', 'castGenerator'],
        'ReflectionType' => ['Extly\Symfony\Component\VarDumper\Caster\ReflectionCaster', 'castType'],
        'ReflectionAttribute' => ['Extly\Symfony\Component\VarDumper\Caster\ReflectionCaster', 'castAttribute'],
        'ReflectionGenerator' => ['Extly\Symfony\Component\VarDumper\Caster\ReflectionCaster', 'castReflectionGenerator'],
        'ReflectionClass' => ['Extly\Symfony\Component\VarDumper\Caster\ReflectionCaster', 'castClass'],
        'ReflectionClassConstant' => ['Extly\Symfony\Component\VarDumper\Caster\ReflectionCaster', 'castClassConstant'],
        'ReflectionFunctionAbstract' => ['Extly\Symfony\Component\VarDumper\Caster\ReflectionCaster', 'castFunctionAbstract'],
        'ReflectionMethod' => ['Extly\Symfony\Component\VarDumper\Caster\ReflectionCaster', 'castMethod'],
        'ReflectionParameter' => ['Extly\Symfony\Component\VarDumper\Caster\ReflectionCaster', 'castParameter'],
        'ReflectionProperty' => ['Extly\Symfony\Component\VarDumper\Caster\ReflectionCaster', 'castProperty'],
        'ReflectionReference' => ['Extly\Symfony\Component\VarDumper\Caster\ReflectionCaster', 'castReference'],
        'ReflectionExtension' => ['Extly\Symfony\Component\VarDumper\Caster\ReflectionCaster', 'castExtension'],
        'ReflectionZendExtension' => ['Extly\Symfony\Component\VarDumper\Caster\ReflectionCaster', 'castZendExtension'],

        'Doctrine\Common\Persistence\ObjectManager' => ['Extly\Symfony\Component\VarDumper\Caster\StubCaster', 'cutInternals'],
        'Doctrine\Common\Proxy\Proxy' => ['Extly\Symfony\Component\VarDumper\Caster\DoctrineCaster', 'castCommonProxy'],
        'Doctrine\ORM\Proxy\Proxy' => ['Extly\Symfony\Component\VarDumper\Caster\DoctrineCaster', 'castOrmProxy'],
        'Doctrine\ORM\PersistentCollection' => ['Extly\Symfony\Component\VarDumper\Caster\DoctrineCaster', 'castPersistentCollection'],
        'Doctrine\Persistence\ObjectManager' => ['Extly\Symfony\Component\VarDumper\Caster\StubCaster', 'cutInternals'],

        'DOMException' => ['Extly\Symfony\Component\VarDumper\Caster\DOMCaster', 'castException'],
        'DOMStringList' => ['Extly\Symfony\Component\VarDumper\Caster\DOMCaster', 'castLength'],
        'DOMNameList' => ['Extly\Symfony\Component\VarDumper\Caster\DOMCaster', 'castLength'],
        'DOMImplementation' => ['Extly\Symfony\Component\VarDumper\Caster\DOMCaster', 'castImplementation'],
        'DOMImplementationList' => ['Extly\Symfony\Component\VarDumper\Caster\DOMCaster', 'castLength'],
        'DOMNode' => ['Extly\Symfony\Component\VarDumper\Caster\DOMCaster', 'castNode'],
        'DOMNameSpaceNode' => ['Extly\Symfony\Component\VarDumper\Caster\DOMCaster', 'castNameSpaceNode'],
        'DOMDocument' => ['Extly\Symfony\Component\VarDumper\Caster\DOMCaster', 'castDocument'],
        'DOMNodeList' => ['Extly\Symfony\Component\VarDumper\Caster\DOMCaster', 'castLength'],
        'DOMNamedNodeMap' => ['Extly\Symfony\Component\VarDumper\Caster\DOMCaster', 'castLength'],
        'DOMCharacterData' => ['Extly\Symfony\Component\VarDumper\Caster\DOMCaster', 'castCharacterData'],
        'DOMAttr' => ['Extly\Symfony\Component\VarDumper\Caster\DOMCaster', 'castAttr'],
        'DOMElement' => ['Extly\Symfony\Component\VarDumper\Caster\DOMCaster', 'castElement'],
        'DOMText' => ['Extly\Symfony\Component\VarDumper\Caster\DOMCaster', 'castText'],
        'DOMTypeinfo' => ['Extly\Symfony\Component\VarDumper\Caster\DOMCaster', 'castTypeinfo'],
        'DOMDomError' => ['Extly\Symfony\Component\VarDumper\Caster\DOMCaster', 'castDomError'],
        'DOMLocator' => ['Extly\Symfony\Component\VarDumper\Caster\DOMCaster', 'castLocator'],
        'DOMDocumentType' => ['Extly\Symfony\Component\VarDumper\Caster\DOMCaster', 'castDocumentType'],
        'DOMNotation' => ['Extly\Symfony\Component\VarDumper\Caster\DOMCaster', 'castNotation'],
        'DOMEntity' => ['Extly\Symfony\Component\VarDumper\Caster\DOMCaster', 'castEntity'],
        'DOMProcessingInstruction' => ['Extly\Symfony\Component\VarDumper\Caster\DOMCaster', 'castProcessingInstruction'],
        'DOMXPath' => ['Extly\Symfony\Component\VarDumper\Caster\DOMCaster', 'castXPath'],

        'XMLReader' => ['Extly\Symfony\Component\VarDumper\Caster\XmlReaderCaster', 'castXmlReader'],

        'ErrorException' => ['Extly\Symfony\Component\VarDumper\Caster\ExceptionCaster', 'castErrorException'],
        'Exception' => ['Extly\Symfony\Component\VarDumper\Caster\ExceptionCaster', 'castException'],
        'Error' => ['Extly\Symfony\Component\VarDumper\Caster\ExceptionCaster', 'castError'],
        'Extly\Symfony\Bridge\Monolog\Logger' => ['Extly\Symfony\Component\VarDumper\Caster\StubCaster', 'cutInternals'],
        'Extly\Symfony\Component\DependencyInjection\ContainerInterface' => ['Extly\Symfony\Component\VarDumper\Caster\StubCaster', 'cutInternals'],
        'Extly\Symfony\Component\EventDispatcher\EventDispatcherInterface' => ['Extly\Symfony\Component\VarDumper\Caster\StubCaster', 'cutInternals'],
        'Extly\Symfony\Component\HttpClient\CurlHttpClient' => ['Extly\Symfony\Component\VarDumper\Caster\SymfonyCaster', 'castHttpClient'],
        'Extly\Symfony\Component\HttpClient\NativeHttpClient' => ['Extly\Symfony\Component\VarDumper\Caster\SymfonyCaster', 'castHttpClient'],
        'Extly\Symfony\Component\HttpClient\Response\CurlResponse' => ['Extly\Symfony\Component\VarDumper\Caster\SymfonyCaster', 'castHttpClientResponse'],
        'Extly\Symfony\Component\HttpClient\Response\NativeResponse' => ['Extly\Symfony\Component\VarDumper\Caster\SymfonyCaster', 'castHttpClientResponse'],
        'Extly\Symfony\Component\HttpFoundation\Request' => ['Extly\Symfony\Component\VarDumper\Caster\SymfonyCaster', 'castRequest'],
        'Extly\Symfony\Component\VarDumper\Exception\ThrowingCasterException' => ['Extly\Symfony\Component\VarDumper\Caster\ExceptionCaster', 'castThrowingCasterException'],
        'Extly\Symfony\Component\VarDumper\Caster\TraceStub' => ['Extly\Symfony\Component\VarDumper\Caster\ExceptionCaster', 'castTraceStub'],
        'Extly\Symfony\Component\VarDumper\Caster\FrameStub' => ['Extly\Symfony\Component\VarDumper\Caster\ExceptionCaster', 'castFrameStub'],
        'Extly\Symfony\Component\VarDumper\Cloner\AbstractCloner' => ['Extly\Symfony\Component\VarDumper\Caster\StubCaster', 'cutInternals'],
        'Extly\Symfony\Component\ErrorHandler\Exception\SilencedErrorContext' => ['Extly\Symfony\Component\VarDumper\Caster\ExceptionCaster', 'castSilencedErrorContext'],

        'Imagine\Image\ImageInterface' => ['Extly\Symfony\Component\VarDumper\Caster\ImagineCaster', 'castImage'],

        'Ramsey\Uuid\UuidInterface' => ['Extly\Symfony\Component\VarDumper\Caster\UuidCaster', 'castRamseyUuid'],

        'ProxyManager\Proxy\ProxyInterface' => ['Extly\Symfony\Component\VarDumper\Caster\ProxyManagerCaster', 'castProxy'],
        'PHPUnit_Framework_MockObject_MockObject' => ['Extly\Symfony\Component\VarDumper\Caster\StubCaster', 'cutInternals'],
        'PHPUnit\Framework\MockObject\MockObject' => ['Extly\Symfony\Component\VarDumper\Caster\StubCaster', 'cutInternals'],
        'PHPUnit\Framework\MockObject\Stub' => ['Extly\Symfony\Component\VarDumper\Caster\StubCaster', 'cutInternals'],
        'Prophecy\Prophecy\ProphecySubjectInterface' => ['Extly\Symfony\Component\VarDumper\Caster\StubCaster', 'cutInternals'],
        'Mockery\MockInterface' => ['Extly\Symfony\Component\VarDumper\Caster\StubCaster', 'cutInternals'],

        'PDO' => ['Extly\Symfony\Component\VarDumper\Caster\PdoCaster', 'castPdo'],
        'PDOStatement' => ['Extly\Symfony\Component\VarDumper\Caster\PdoCaster', 'castPdoStatement'],

        'AMQPConnection' => ['Extly\Symfony\Component\VarDumper\Caster\AmqpCaster', 'castConnection'],
        'AMQPChannel' => ['Extly\Symfony\Component\VarDumper\Caster\AmqpCaster', 'castChannel'],
        'AMQPQueue' => ['Extly\Symfony\Component\VarDumper\Caster\AmqpCaster', 'castQueue'],
        'AMQPExchange' => ['Extly\Symfony\Component\VarDumper\Caster\AmqpCaster', 'castExchange'],
        'AMQPEnvelope' => ['Extly\Symfony\Component\VarDumper\Caster\AmqpCaster', 'castEnvelope'],

        'ArrayObject' => ['Extly\Symfony\Component\VarDumper\Caster\SplCaster', 'castArrayObject'],
        'ArrayIterator' => ['Extly\Symfony\Component\VarDumper\Caster\SplCaster', 'castArrayIterator'],
        'SplDoublyLinkedList' => ['Extly\Symfony\Component\VarDumper\Caster\SplCaster', 'castDoublyLinkedList'],
        'SplFileInfo' => ['Extly\Symfony\Component\VarDumper\Caster\SplCaster', 'castFileInfo'],
        'SplFileObject' => ['Extly\Symfony\Component\VarDumper\Caster\SplCaster', 'castFileObject'],
        'SplHeap' => ['Extly\Symfony\Component\VarDumper\Caster\SplCaster', 'castHeap'],
        'SplObjectStorage' => ['Extly\Symfony\Component\VarDumper\Caster\SplCaster', 'castObjectStorage'],
        'SplPriorityQueue' => ['Extly\Symfony\Component\VarDumper\Caster\SplCaster', 'castHeap'],
        'OuterIterator' => ['Extly\Symfony\Component\VarDumper\Caster\SplCaster', 'castOuterIterator'],
        'WeakReference' => ['Extly\Symfony\Component\VarDumper\Caster\SplCaster', 'castWeakReference'],

        'Redis' => ['Extly\Symfony\Component\VarDumper\Caster\RedisCaster', 'castRedis'],
        'RedisArray' => ['Extly\Symfony\Component\VarDumper\Caster\RedisCaster', 'castRedisArray'],
        'RedisCluster' => ['Extly\Symfony\Component\VarDumper\Caster\RedisCaster', 'castRedisCluster'],

        'DateTimeInterface' => ['Extly\Symfony\Component\VarDumper\Caster\DateCaster', 'castDateTime'],
        'DateInterval' => ['Extly\Symfony\Component\VarDumper\Caster\DateCaster', 'castInterval'],
        'DateTimeZone' => ['Extly\Symfony\Component\VarDumper\Caster\DateCaster', 'castTimeZone'],
        'DatePeriod' => ['Extly\Symfony\Component\VarDumper\Caster\DateCaster', 'castPeriod'],

        'GMP' => ['Extly\Symfony\Component\VarDumper\Caster\GmpCaster', 'castGmp'],

        'MessageFormatter' => ['Extly\Symfony\Component\VarDumper\Caster\IntlCaster', 'castMessageFormatter'],
        'NumberFormatter' => ['Extly\Symfony\Component\VarDumper\Caster\IntlCaster', 'castNumberFormatter'],
        'IntlTimeZone' => ['Extly\Symfony\Component\VarDumper\Caster\IntlCaster', 'castIntlTimeZone'],
        'IntlCalendar' => ['Extly\Symfony\Component\VarDumper\Caster\IntlCaster', 'castIntlCalendar'],
        'IntlDateFormatter' => ['Extly\Symfony\Component\VarDumper\Caster\IntlCaster', 'castIntlDateFormatter'],

        'Memcached' => ['Extly\Symfony\Component\VarDumper\Caster\MemcachedCaster', 'castMemcached'],

        'Ds\Collection' => ['Extly\Symfony\Component\VarDumper\Caster\DsCaster', 'castCollection'],
        'Ds\Map' => ['Extly\Symfony\Component\VarDumper\Caster\DsCaster', 'castMap'],
        'Ds\Pair' => ['Extly\Symfony\Component\VarDumper\Caster\DsCaster', 'castPair'],
        'Extly\Symfony\Component\VarDumper\Caster\DsPairStub' => ['Extly\Symfony\Component\VarDumper\Caster\DsCaster', 'castPairStub'],

        'CurlHandle' => ['Extly\Symfony\Component\VarDumper\Caster\ResourceCaster', 'castCurl'],
        ':curl' => ['Extly\Symfony\Component\VarDumper\Caster\ResourceCaster', 'castCurl'],

        ':dba' => ['Extly\Symfony\Component\VarDumper\Caster\ResourceCaster', 'castDba'],
        ':dba persistent' => ['Extly\Symfony\Component\VarDumper\Caster\ResourceCaster', 'castDba'],

        'GdImage' => ['Extly\Symfony\Component\VarDumper\Caster\ResourceCaster', 'castGd'],
        ':gd' => ['Extly\Symfony\Component\VarDumper\Caster\ResourceCaster', 'castGd'],

        ':mysql link' => ['Extly\Symfony\Component\VarDumper\Caster\ResourceCaster', 'castMysqlLink'],
        ':pgsql large object' => ['Extly\Symfony\Component\VarDumper\Caster\PgSqlCaster', 'castLargeObject'],
        ':pgsql link' => ['Extly\Symfony\Component\VarDumper\Caster\PgSqlCaster', 'castLink'],
        ':pgsql link persistent' => ['Extly\Symfony\Component\VarDumper\Caster\PgSqlCaster', 'castLink'],
        ':pgsql result' => ['Extly\Symfony\Component\VarDumper\Caster\PgSqlCaster', 'castResult'],
        ':process' => ['Extly\Symfony\Component\VarDumper\Caster\ResourceCaster', 'castProcess'],
        ':stream' => ['Extly\Symfony\Component\VarDumper\Caster\ResourceCaster', 'castStream'],

        'OpenSSLCertificate' => ['Extly\Symfony\Component\VarDumper\Caster\ResourceCaster', 'castOpensslX509'],
        ':OpenSSL X.509' => ['Extly\Symfony\Component\VarDumper\Caster\ResourceCaster', 'castOpensslX509'],

        ':persistent stream' => ['Extly\Symfony\Component\VarDumper\Caster\ResourceCaster', 'castStream'],
        ':stream-context' => ['Extly\Symfony\Component\VarDumper\Caster\ResourceCaster', 'castStreamContext'],

        'XmlParser' => ['Extly\Symfony\Component\VarDumper\Caster\XmlResourceCaster', 'castXml'],
        ':xml' => ['Extly\Symfony\Component\VarDumper\Caster\XmlResourceCaster', 'castXml'],

        'RdKafka' => ['Extly\Symfony\Component\VarDumper\Caster\RdKafkaCaster', 'castRdKafka'],
        'RdKafka\Conf' => ['Extly\Symfony\Component\VarDumper\Caster\RdKafkaCaster', 'castConf'],
        'RdKafka\KafkaConsumer' => ['Extly\Symfony\Component\VarDumper\Caster\RdKafkaCaster', 'castKafkaConsumer'],
        'RdKafka\Metadata\Broker' => ['Extly\Symfony\Component\VarDumper\Caster\RdKafkaCaster', 'castBrokerMetadata'],
        'RdKafka\Metadata\Collection' => ['Extly\Symfony\Component\VarDumper\Caster\RdKafkaCaster', 'castCollectionMetadata'],
        'RdKafka\Metadata\Partition' => ['Extly\Symfony\Component\VarDumper\Caster\RdKafkaCaster', 'castPartitionMetadata'],
        'RdKafka\Metadata\Topic' => ['Extly\Symfony\Component\VarDumper\Caster\RdKafkaCaster', 'castTopicMetadata'],
        'RdKafka\Message' => ['Extly\Symfony\Component\VarDumper\Caster\RdKafkaCaster', 'castMessage'],
        'RdKafka\Topic' => ['Extly\Symfony\Component\VarDumper\Caster\RdKafkaCaster', 'castTopic'],
        'RdKafka\TopicPartition' => ['Extly\Symfony\Component\VarDumper\Caster\RdKafkaCaster', 'castTopicPartition'],
        'RdKafka\TopicConf' => ['Extly\Symfony\Component\VarDumper\Caster\RdKafkaCaster', 'castTopicConf'],
    ];

    protected $maxItems = 2500;
    protected $maxString = -1;
    protected $minDepth = 1;

    private $casters = [];
    private $prevErrorHandler;
    private $classInfo = [];
    private $filter = 0;

    /**
     * @param callable[]|null $casters A map of casters
     *
     * @see addCasters
     */
    public function __construct(array $casters = null)
    {
        if (null === $casters) {
            $casters = static::$defaultCasters;
        }
        $this->addCasters($casters);
    }

    /**
     * Adds casters for resources and objects.
     *
     * Maps resources or objects types to a callback.
     * Types are in the key, with a callable caster for value.
     * Resource types are to be prefixed with a `:`,
     * see e.g. static::$defaultCasters.
     *
     * @param callable[] $casters A map of casters
     */
    public function addCasters(array $casters)
    {
        foreach ($casters as $type => $callback) {
            $this->casters[$type][] = $callback;
        }
    }

    /**
     * Sets the maximum number of items to clone past the minimum depth in nested structures.
     */
    public function setMaxItems(int $maxItems)
    {
        $this->maxItems = $maxItems;
    }

    /**
     * Sets the maximum cloned length for strings.
     */
    public function setMaxString(int $maxString)
    {
        $this->maxString = $maxString;
    }

    /**
     * Sets the minimum tree depth where we are guaranteed to clone all the items.  After this
     * depth is reached, only setMaxItems items will be cloned.
     */
    public function setMinDepth(int $minDepth)
    {
        $this->minDepth = $minDepth;
    }

    /**
     * Clones a PHP variable.
     *
     * @param mixed $var    Any PHP variable
     * @param int   $filter A bit field of Caster::EXCLUDE_* constants
     *
     * @return Data The cloned variable represented by a Data object
     */
    public function cloneVar($var, int $filter = 0)
    {
        $this->prevErrorHandler = set_error_handler(function ($type, $msg, $file, $line, $context = []) {
            if (\E_RECOVERABLE_ERROR === $type || \E_USER_ERROR === $type) {
                // Cloner never dies
                throw new \ErrorException($msg, 0, $type, $file, $line);
            }

            if ($this->prevErrorHandler) {
                return ($this->prevErrorHandler)($type, $msg, $file, $line, $context);
            }

            return false;
        });
        $this->filter = $filter;

        if ($gc = gc_enabled()) {
            gc_disable();
        }
        try {
            return new Data($this->doClone($var));
        } finally {
            if ($gc) {
                gc_enable();
            }
            restore_error_handler();
            $this->prevErrorHandler = null;
        }
    }

    /**
     * Effectively clones the PHP variable.
     *
     * @param mixed $var Any PHP variable
     *
     * @return array The cloned variable represented in an array
     */
    abstract protected function doClone($var);

    /**
     * Casts an object to an array representation.
     *
     * @param bool $isNested True if the object is nested in the dumped structure
     *
     * @return array The object casted as array
     */
    protected function castObject(Stub $stub, bool $isNested)
    {
        $obj = $stub->value;
        $class = $stub->class;

        if (\PHP_VERSION_ID < 80000 ? "\0" === ($class[15] ?? null) : false !== strpos($class, "@anonymous\0")) {
            $stub->class = get_debug_type($obj);
        }
        if (isset($this->classInfo[$class])) {
            [$i, $parents, $hasDebugInfo, $fileInfo] = $this->classInfo[$class];
        } else {
            $i = 2;
            $parents = [$class];
            $hasDebugInfo = method_exists($class, '__debugInfo');

            foreach (class_parents($class) as $p) {
                $parents[] = $p;
                ++$i;
            }
            foreach (class_implements($class) as $p) {
                $parents[] = $p;
                ++$i;
            }
            $parents[] = '*';

            $r = new \ReflectionClass($class);
            $fileInfo = $r->isInternal() || $r->isSubclassOf(Stub::class) ? [] : [
                'file' => $r->getFileName(),
                'line' => $r->getStartLine(),
            ];

            $this->classInfo[$class] = [$i, $parents, $hasDebugInfo, $fileInfo];
        }

        $stub->attr += $fileInfo;
        $a = Caster::castObject($obj, $class, $hasDebugInfo, $stub->class);

        try {
            while ($i--) {
                if (!empty($this->casters[$p = $parents[$i]])) {
                    foreach ($this->casters[$p] as $callback) {
                        $a = $callback($obj, $a, $stub, $isNested, $this->filter);
                    }
                }
            }
        } catch (\Exception $e) {
            $a = [(Stub::TYPE_OBJECT === $stub->type ? Caster::PREFIX_VIRTUAL : '').'⚠' => new ThrowingCasterException($e)] + $a;
        }

        return $a;
    }

    /**
     * Casts a resource to an array representation.
     *
     * @param bool $isNested True if the object is nested in the dumped structure
     *
     * @return array The resource casted as array
     */
    protected function castResource(Stub $stub, bool $isNested)
    {
        $a = [];
        $res = $stub->value;
        $type = $stub->class;

        try {
            if (!empty($this->casters[':'.$type])) {
                foreach ($this->casters[':'.$type] as $callback) {
                    $a = $callback($res, $a, $stub, $isNested, $this->filter);
                }
            }
        } catch (\Exception $e) {
            $a = [(Stub::TYPE_OBJECT === $stub->type ? Caster::PREFIX_VIRTUAL : '').'⚠' => new ThrowingCasterException($e)] + $a;
        }

        return $a;
    }
}
