<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2014 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Portfolio\Controller;

use Zend\View\Model\ViewModel;
// use Zend\Db\Sql\Expression;
// use Portfolio\Controller\AbstractController;

use Portfolio\Service\PortfolioServiceInterface;
use Zend\Mvc\Controller\AbstractActionController;

class PortfolioController extends AbstractActionController {

    // protected $portfolioTable;

    /**
    * @var \Portfolio\Service\PostServiceInterface
    */
    protected $portfolioService;

    public function __construct(PortfolioServiceInterface $portfolioService) {
        $this->portfolioService = $portfolioService;
    }

    public function indexAction() {
        // @TODO includeHidden parameter
        return new ViewModel(array(
            'portfolios' => $this->portfolioService->findAll()
        ));
    }

    public function viewAction() {
        $title = $this->params()->fromRoute('title');

        try {
            $portfolio = $this->portfolioService->findByTitle($title);
        } catch (\InvalidArgumentException $ex) {
            return $this->redirect()->toRoute('portfolio');
        }

        return new ViewModel(array(
            'portfolio' => $portfolio
        ));
    }
}
