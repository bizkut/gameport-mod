<?php

return [


    /*
    |--------------------------------------------------------------------------
    | Cookie Consent Lines
    |--------------------------------------------------------------------------
    */

    'cookie' => [
      'message' => "Your experience on this site will be improved by allowing cookies.",
      'agree' => "Allow cookies",
    ],

    /*
    |--------------------------------------------------------------------------
    | 404 Error Page Lines
    |--------------------------------------------------------------------------
    */

    '404' => [
      'whops' => "Whoops!",
      'couldnt_find' => "We couldn't find the page you <br /> were looking for.",
      'return' => "Return to the homepage",
    ],

    /*
    |--------------------------------------------------------------------------
    | Breadcrumbs Lines
    |--------------------------------------------------------------------------
    */

    'breadcrumbs' => [
      'profile' => ":Username's Profile",
      'listing' => ":Username's :Gamename (:Platform) Listing",
    ],

    /*
    |--------------------------------------------------------------------------
    | Sort / Filter Lines
    |--------------------------------------------------------------------------
    */

    'sortfilter' => [
      'filter' => 'Filter',
      'filter_options' => 'Options',
      'filter_platforms' => 'Platforms',
      'sort_by' => 'Sort by',
      /* Start new strings v1.4.1 */
      'sort_popularity' => 'Popularity',
      /* End new strings v1.4.1 */
      'sort_date' => 'Date',
      'sort_price' => 'Price',
      'sort_distance' => 'Distance',
      'sort_release' => 'Release',
      'sort_metascore' => 'Metascore',
      'sort_listings' => 'Listings',
    ],

    /*
    |--------------------------------------------------------------------------
    | Ads Lines
    |--------------------------------------------------------------------------
    */

    'ads' => [
      'buy_ref' => 'Buy on :Merchant',
    ],

    /*
    |--------------------------------------------------------------------------
    | Contact Form Language Lines
    |--------------------------------------------------------------------------
    */

    'contact' => [
      'name' => 'Your name',
      'email' => 'Your email address',
      'message' => 'Your message',
      'send' => 'Send Message',
      'successfully_sent' => 'Message sent! We try to respond as soon as possible.',
    ],

    /*
    |--------------------------------------------------------------------------
    | Carousel Language Lines
    |--------------------------------------------------------------------------
    */

    'carousel' => [
      'release_in' => 'Release tomorrow|Release in :days days',
      'starting_from' => 'Starting from <strong>:Price</strong> !',
      'no_listings' => 'No listing available.',
    ],

    /*
    |--------------------------------------------------------------------------
    | General Language Lines
    |--------------------------------------------------------------------------
    */

    'load_more' => 'Load more',
    'home' => 'Home',
    'theme' => 'Theme',
    'language' => 'Language',


    'listings' => 'Listings',
    'games' => 'Games',
    'products' => 'Products',
    'offers' => 'Offers',

    'delete' => 'Delete',
    'edit' => 'Edit',
    'details' => 'Details',
    'send' => 'Send',
    'save' => 'Save',

    'search' => 'Search',
    'close' => 'Close',
    'cancel' => 'Cancel',

    'blog' => 'Blog',


    /*
    |--------------------------------------------------------------------------
    | Navbar
    |--------------------------------------------------------------------------
    */
    'nav' => [
      'toggle_nav' => 'Toggle navigation',
      'current_generation' => 'Current Generation',
      'last_generation' => 'Last Generation',
      'handhelds' => 'Handhelds',
      'retro' => 'Retro',
      'search' => 'Search...',
      'search_empty' => 'Sorry, no game found.',
      'starting_from' => 'starting from',
      'toggle_search' => 'Toggle Search',
      'listing_add' => 'Add Listing',
      'user' => [
        'notifications_all' => 'All notifications',
        'notifications_push_subscribe' => 'Subscribe to Push Notifications',
        'notifications_more' => '+ :count more',
        'admin' => 'Admin Panel',
        'dashboard' => 'Dashboard',
        'listings' => 'Listings',
        'offers' => 'Offers',
        'notifications' => 'Notifications',
        'settings' => 'Settings',
        'profile' => 'Profile',
        'logout' => 'Logout',
      ]
    ],

    /*
    |--------------------------------------------------------------------------
    | SEO Site Titles
    |--------------------------------------------------------------------------
    */
    'title' => [
      'listing_buy' => 'Buy :Game_name (:Platform) for :Price - :User_name (:Place)',
      'listing_trade' => 'Trade :Game_name (:Platform) - :User_name (:Place)',
      'listing_edit' => 'Edit :Game_name (:Platform) listing',
      'listing_add' => 'Add new listing on :Page_name - :Sub_title',
      'listing_add_game' => 'Add new :Game_name (:Platform) listing on :Page_name',
      'listings_all' => 'All listings on :Page_name - :Sub_title',
      'listings_platform' => ':Platform listings on :Page_name - :Sub_title',
      'games_all' => 'All games on :Page_name - :Sub_title',
      'game' => ':Game_name (:Platform) listings on :Page_name',
      'game_add' => 'Add new game to :Page_name',
      'search_result' => 'Search results for :value on :Page_name - :Sub_title',
      'welcome' => 'Welcome to :Page_name » :Sub_title',
      'profile' => ":User_name's Profile on :Page_name » :Sub_title",
      'offer' => ":User_name's offer for :Game_name (:Platform) on :Page_name",
      'sign_in' => 'Sign in to :Page_name » :Sub_title',
    ],

    /*
    |--------------------------------------------------------------------------
    | SEO Descriptions
    |--------------------------------------------------------------------------
    */
    'description' => [
      'listing_buy' => 'Buy :Game_name (:Platform) for :Price from :User_name (:Place)! Only on :Page_name - :Sub_title',
      'listing_trade' => 'Trade :Game_name (:Platform) from :User_name (:Place)! Only on :Page_name - :Sub_title',
      'games_all' => 'Find the cheapest listings for over :games_count games! Only on :Page_name - :Sub_title',
      'listings_all' => 'There are over :listings_count active listings! Only on :Page_name - :Sub_title',
      'listings_platform' => 'There are over :listings_count active listings for :platform_name games! Only on :Page_name - :Sub_title',
      'profile' => ":User_name has :listings_count active listings - :Page_name » :Sub_title",
    ],

    /*
    |--------------------------------------------------------------------------
    | Share buttons text
    |--------------------------------------------------------------------------
    */
    'share' => [
      'twitter_listing_buy' => 'Buy :Game_name (:Platform) for :Price',
      'twitter_listing_trade' => 'Trade :Game_name (:Platform)',
      'twitter_game' => ':Game_name (:Platform) on :Page_name',
    ],


];
