<?php

class Yelp {

    public function yelpSearchResults ($destinationsearch){
        $params = ['location', 'categories'];

        $url = 'https://api.yelp.com/v3/businesses/search/' . $destinationsearch;



        // $urlpath = $this->appendParametersToUrl('/v3/businesses/search' . $destinationsearch, $params);
        // $request = $this->getRequest('GET', $url, $this->getDefaultHeaders());

        return $this->processRequest($request);
    }
}