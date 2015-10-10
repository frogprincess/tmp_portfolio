<?php
namespace Portfolio\View\Helper;
use Zend\View\Helper\AbstractHelper;
use Zend\Http\Request;

class PortfolioUrl extends AbstractHelper {
    protected $request;

    public function __construct(Request $request) {
        $this->request = $request;
    }

    public function __invoke($short_title) {
        $url = 'http://' . $this->request->getUri()->getHost();
        $url .= '/portfolio/';
        $url .= strtolower(str_replace(' ', '', $short_title));
        return $url;
    }
}
