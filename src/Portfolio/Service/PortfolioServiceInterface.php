<?php
// Filename: /module/Portfolio/src/Portfolio/Service/PortfolioServiceInterface.php
namespace Portfolio\Service;

use Portfolio\Model\Portfolio;

interface PortfolioServiceInterface {
    /**
     * Should return a set of all portfolios that we can iterate over. Single entries of the array are supposed to be
     * implementing \Portfolio\Model\PortfolioInterface
     *
     * @param bool|bool $includeHidden
     * @return array|PortfolioInterface[]
     */
    public function findAll($includeHidden = false);

    /**
     * Should return a single portfolios
     *
     * @param  int $id Identifier of the Portfolio that should be returned
     * @return PortfolioInterface
     */
    public function find($id);

    /**
     * Should return a single portfolios
     *
     * @param string $title
     * @return PortfolioInterface
     * @throws \InvalidArgumentException
     */
    public function findByTitle($title);

    /**
     * Should save a given implementation of the PortfolioInterface and return it. If it is an existing Portfolio the Portfolio
     * should be updated, if it's a new Portfolio it should be created.
     *
     * @param  PortfolioInterface $portfolio
     * @return PortfolioInterface
     */
    public function save(Portfolio $portfolio);
}