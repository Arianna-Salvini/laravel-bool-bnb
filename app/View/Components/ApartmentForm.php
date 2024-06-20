<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ApartmentForm extends Component
{

    public $route;
    public $method;
    public $nations;
    public $services;
    public $apartment;
    public $isEditForm;
    public $oldTitle;
    public $oldAddress;
    public $oldStreetNumber;
    public $oldCountry;
    public $oldCity;
    public $oldZip;
    public $oldSqm;
    public $oldRooms;
    public $oldBeds;
    public $oldBathrooms;
    public $oldVisibility;
    public $oldDescription;

    /**
     * Create a new component instance.
     */
    public function __construct($route, $method, $nations, $services, $apartment, $isEditForm, $oldTitle, $oldAddress, $oldStreetNumber, $oldCountry, $oldCity, $oldZip, $oldSqm, $oldRooms, $oldBeds, $oldBathrooms, $oldVisibility, $oldDescription)
    {
        $this->route = $route;
        $this->method = $method;
        $this->nations = $nations;
        $this->services = $services;
        $this->apartment = $apartment;
        $this->isEditForm = $isEditForm;
        $this->oldTitle = $oldTitle;
        $this->oldAddress = $oldAddress;
        $this->oldStreetNumber = $oldStreetNumber;
        $this->oldCountry = $oldCountry;
        $this->oldCity = $oldCity;
        $this->oldZip = $oldZip;
        $this->oldSqm = $oldSqm;
        $this->oldRooms = $oldRooms;
        $this->oldBeds = $oldBeds;
        $this->oldBathrooms = $oldBathrooms;
        $this->oldVisibility = $oldVisibility;
        $this->oldDescription = $oldDescription;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.apartment-form');
    }
}
