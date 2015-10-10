<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2014 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Portfolio\Controller;

use Portfolio\Service\PortfolioServiceInterface;
use Portfolio\Model\Portfolio;
use \Portfolio\View\Helper\PortfolioUrl;
use Zend\Form\FormInterface;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use \Zend\File\Transfer\Adapter\Http;

class AdminController extends AbstractActionController {

    protected $portfolioService;
    protected $portfolioForm;

    public function __construct(
        PortfolioServiceInterface $portfolioService,
        FormInterface $portfolioForm
        ) {
        $this->portfolioService = $portfolioService;
        $this->portfolioForm = $portfolioForm;
        // $helper = $this->getServiceLocator()->get('viewhelpermanager')->get('HeadScript');
        // $helper->appendFile('/js/tinymce/jscripts/tiny_mce/tiny_mce.js');
        // $helper->appendFile('/js/tinymce_config.js');
        // $this->layout()->setVariables(array(
        //     'bodyId' => 'portfolio',
        //     )
        // );
    }

    public function indexAction() {
        $portfolios = $this->portfolioService->findAll(true);

        $viewModel = new ViewModel(array(
            'portfolios' => $portfolios
            )
        );

        return $viewModel;
    }

    public function addAction() {
        $heading = 'Add New Portfolio';
        $request = $this->getRequest();
        $portfolio = new Portfolio();
        $this->portfolioForm->bind($portfolio);

        if ($request->isPost()) {
            $this->portfolioForm->setData($request->getPost());

            if ($this->portfolioForm->isValid()) {

                $this->processPortfolioForm($request, $portfolio);

                $portfolioUrl = new \Portfolio\View\Helper\PortfolioUrl($request); // TODO
                $url = $portfolioUrl($portfolio->getShortTitle());
                $link = 'Added: <a href="' . $url . '">' . $portfolio->getTitle() . '</a>';
                // $this->flashmessenger()->addSuccessMessage($link);
                // return $this->redirect()->toRoute('blog');
                $heading = $link . ' - Add Another New Portfolio';
                $portfolio = new Portfolio();
                $this->portfolioForm->bind($portfolio);
            }
        }

        return new ViewModel(array(
            'heading' => $heading,
            'form' => $this->portfolioForm
        ));
    }

    public function editAction() {
        $heading = 'Edit Portfolio';
        $portfolio = $this->portfolioService->find($this->params('id'));
        $this->portfolioForm->bind($portfolio);
        $request = $this->getRequest();

        if ($request->isPost()) {
            $this->processPortfolioForm($request, $portfolio);
            $portfolioUrl = new \Portfolio\View\Helper\PortfolioUrl($request); // TODO
            $url = $portfolioUrl($portfolio->getShortTitle());
            $heading = 'Edited: <a href="' . $url . '">' . $portfolio->getTitle() . '</a>';
            // $this->flashmessenger()->addSuccessMessage($link);

           // return $this->redirect()->toRoute('admin', array(
           //      'controller' => 'portfolio-admin-controller',
           //      'action' => 'edit',
           //      'id' => $this->params('id')
           //  ));

            // } else {
            //     foreach ($form->getMessages() as $messageId => $message) {
            //         $this->flashmessenger()->addErrorMessage(
            //             "Validation failure '$messageId': $message\n");
            //     }
            //     // flash messenger sends message to next request, so we need a redirect
            //     return $this->redirect()->toRoute('admin/portfolio/edit', array('action'=>'edit', 'id'=>$id));
            // }
        }

        $view = new ViewModel(array(
           'heading' => $heading,
            'form' => $this->portfolioForm
        ));
        $view->setTemplate('portfolio/admin/add.phtml');

        return $view;
    }

    public function hideAction() {
        $portfolio = $this->portfolioService->find($this->params('id'));
        $portfolio->setHide(1);
        $this->portfolioService->save($portfolio);
        return $this->redirect()->toRoute('admin');
    }

    public function showAction() {
        $portfolio = $this->portfolioService->find($this->params('id'));
        $portfolio->setHide(0);
        $this->portfolioService->save($portfolio);
        return $this->redirect()->toRoute('admin');
    }

    public function processPortfolioForm($request, $portfolio) {
        $this->portfolioForm->setData($request->getPost());

        if ($this->portfolioForm->isValid()) {
            $adapter = new Http();
            // Save all the the files to this destination.
            $adapter->setDestination(__DIR__ . '/../../../../../../public_lilypad/lilypad.net/images/portfolio');
            // $size = new \Zend\Validator\File\Size(array('min' => 1 )); // minimum bytes filesize, max too..
            // $extension = new \Zend\Validator\File\Extension(array('extension' => array('pdf', 'txt')));
            // $adapter->setValidators(array($size, $extension), $fileArr['name']);
            $files  = $adapter->getFileInfo();

            foreach($files as $file => $fileInfo) {
                /**
                 * Valid Upload
                 */
                if ($adapter->isUploaded($file)) {
                    if ($adapter->isValid($file)) {
                        if ($adapter->receive($file)) {
                            // Get the name of the image.
                            $filename = $adapter->getFileName($file, false);
                            // // $file is a string in the format portfoliofieldset_{name}_
                            $property = explode('_', $file)[0];
                            $setter = 'set' . ucfirst($property);
                            // Update the portfolio object.
                            $portfolio->$setter($filename);
                            // Update the hidden value in the form.
                            $this->portfolioForm->get('portfoliofieldset')->get($property)->setValue($filename);
                        }
                    }
                }
            }

            // Instead of actually doing $form->getData() we simply use the
            // previous $portfolio-variable since it will be updated with the latest
            // data from the form thanks to the data-binding. And that’s all there is
            // to it.
            $this->portfolioService->save($portfolio);
        }
    }
}
