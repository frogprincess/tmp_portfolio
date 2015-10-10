<?php
 // Filename: /module/Portfolio/src/Portfolio/Service/PortfolioService.php
 namespace Portfolio\Service;

use Portfolio\Mapper\PortfolioMapper;
use Portfolio\Model\Portfolio;
use Zend\Db\Adapter\Adapter;
use Zend\Db\ResultSet\HydratingResultSet;
// use Zend\Db\Sql\Expression;
use Zend\Db\TableGateway\TableGateway;

class PortfolioService implements PortfolioServiceInterface {
    protected $dbAdapter;
    protected $tableGateway;
    protected $mapper;
    protected $hydrator;

    /**
     * @param PortfolioMapperInterface $portfolioMapper
     */
    public function __construct(Adapter $dbAdapter) {
        $this->dbAdapter = $dbAdapter;
        $this->mapper = new PortfolioMapper($dbAdapter);

        $this->hydrator = new HydratingResultSet(
            $this->mapper,
            new Portfolio
        );

        $this->tableGateway = new TableGateway(
            'portfolios',
            $dbAdapter,
            null,
            $this->hydrator
        );
    }

    /**
     * @param bool $includeHidden
     * @return array $portfolios array of Portfolio objects
     */
    public function findAll($includeHidden = false) {
        $select = $this->tableGateway->getSql()->select();

        if (!$includeHidden) {
            $select->where(array('hide' => 0));
        }

        $select->order('sort ASC, id DESC');
        $portfolios = $this->tableGateway->selectWith($select);
        return $portfolios;
    }

    /**
     * @param int|string $id
     * @return Portfolio $portfolio
     * @throws \InvalidArgumentException
     */
    public function find($id) {
        // The find() function looks really similar to the findAll() function. There’s just
        // three simple differences. Firstly we need to add a condition to the query to only
        // select one row. This is done using the where() function of the Sql object.
        $portfolioIterator = $this->tableGateway->select(array('id' => $id));

        if (!$portfolioIterator) {
            // @TODO catch these
            throw new \InvalidArgumentException("Portfolio with given Id:{$id} not found.");
        }

        $portfolio = $portfolioIterator->current();
        return $portfolio;
    }

    /**
     * @param string $title
     * @return Portfolio $portfolio
     * @throws \InvalidArgumentException
     */
    public function findByTitle($title) {
        $select = $this->tableGateway->getSql()->select();

        $select->where(array(
            "replace(lower(short_title), ' ', '') = ?" => $title,
            'hide' => 0
            )
        );

        $portfolioIterator = $this->tableGateway->selectWith($select);

        if (!$portfolioIterator) {
            throw new \InvalidArgumentException("Portfolio with given Title:{$title} not found.");
        }

        $portfolio = $portfolioIterator->current();
        return $portfolio;
    }

    /**
     *
     * @param Portfolio $portfolio
     * @return Portfolio
     * @throws \Exception
     */
    public function save(Portfolio $portfolio) {
        $portfolioData = $this->mapper->extract($portfolio);
        unset($portfolioData['id']); // Neither Insert nor Update needs the ID in the array

        if ($id = $portfolio->getId()) {
            // ID present, it's an Update
            $this->tableGateway->update($portfolioData, array('id' => $id));
        } else {
            // ID NOT present, it's an Insert
            $this->tableGateway->insert($portfolioData);
            $id = $this->tableGateway->getLastInsertValue();
        }

        return $this->find($id);
    }
}