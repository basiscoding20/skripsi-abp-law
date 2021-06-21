<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Breadcrumb extends Component
{
    public $title;
    public $label;
    public $labelActive;
    public $url;
    public $breadcrumbs = [];

    public function __construct($title, $label = null, $labelActive = null, $url = '#')
    {
        $this->title = $title;
        $this->label = $label;
        $this->labelActive = $labelActive;
        $this->url = $url;

        if($label != null){
            $crumb = new \stdClass();
            $crumb->label = $this->label;
            $crumb->url = $this->url;
            $crumb->active = false;
            $this->breadcrumbs[] = $crumb;
        }
        
        if($labelActive != null){
            $crumb = new \stdClass();
            $crumb->label = $this->labelActive;
            $crumb->url = false;
            $crumb->active = true;
            $this->breadcrumbs[] = $crumb;
        }
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view('components.breadcrumb');
    }
}
