<style type="text/css">
    .application-body {
        background: white;
    }

    a {
        color: #58b720;
        cursor: pointer;
        text-decoration: none;
        transition: color 150ms ease-in 0s;
    }

    a:hover {
        color: #58b720;
        /* text-decoration: underline; */
    }

    a:active {
        color: #aaa;
    }

    [lang="en"] .efruit-vi,
    [lang="vi"] .efruit-en,
    .en .efruit-vi,
    .vi .efruit-en,
    .efruitjs {
        display: none !important;
    }

    .green-text {
        color: #51bd36;
    }

    .m10 {
        margin: 10px;
    }

    .mt10 {
        margin-top: 10px;
    }

    .mb10 {
        margin-bottom: 10px;
    }

    .full-width {
        width: 100%;
    }

    .inline-block {
        display: inline-block;
    }

    .glyphicon-info-sign {
        cursor: pointer;
    }

    .modal {
        overflow-y: auto;
    }

    .share-btn {
        background: rgba(0, 0, 0, 0) linear-gradient(#4c69ba, #3b55a0) repeat scroll 0 0;
        border: medium none;
        border-radius: 2px;
        color: #fff !important;
        cursor: pointer;
        font-weight: bold;
        height: 20px;
        line-height: 20px;
        padding: 5px 10px;
        white-space: nowrap;
    }

    .share-btn:hover {
        background: rgba(0, 0, 0, 0) linear-gradient(#5b7bd5, #4864b1) repeat scroll 0 0;
        border-color: #5874c3 #4961a8 #41599f;
        box-shadow: 0 0 1px #607fd6 inset;
        text-decoration: none !important;
    }

    #loading {
        background: rgba(0, 0, 0, 0.8) none repeat scroll 0 0 !important;
        height: 100%;
        left: 0;
        opacity: 1;
        position: fixed;
        top: 0;
        width: 100%;
        z-index: 10001;
    }

    #loading>div {
        background: transparent none repeat scroll 0 0 !important;
        display: block;
        height: 120px;
        left: 50%;
        margin-left: -60px;
        margin-top: -60px;
        position: absolute;
        top: 50%;
        width: 120px;
        text-align: center;
    }

    #loading .spinner {
        width: 50px;
        height: 40px;
        text-align: center;
        font-size: 10px;
        display: inline-block;
    }

    .spinner>div {
        background-color: #51bd36;
        height: 100%;
        width: 6px;
        display: inline-block;

        -webkit-animation: sk-stretchdelay 1.2s infinite ease-in-out;
        animation: sk-stretchdelay 1.2s infinite ease-in-out;
    }

    .spinner .rect2 {
        -webkit-animation-delay: -1.1s;
        animation-delay: -1.1s;
    }

    .spinner .rect3 {
        -webkit-animation-delay: -1.0s;
        animation-delay: -1.0s;
    }

    .spinner .rect4 {
        -webkit-animation-delay: -0.9s;
        animation-delay: -0.9s;
    }

    .spinner .rect5 {
        -webkit-animation-delay: -0.8s;
        animation-delay: -0.8s;
    }

    @-webkit-keyframes sk-stretchdelay {

        0%,
        40%,
        100% {
            -webkit-transform: scaleY(0.4)
        }

        20% {
            -webkit-transform: scaleY(1.0)
        }
    }

    @keyframes sk-stretchdelay {

        0%,
        40%,
        100% {
            transform: scaleY(0.4);
            -webkit-transform: scaleY(0.4);
        }

        20% {
            transform: scaleY(1.0);
            -webkit-transform: scaleY(1.0);
        }
    }

    .center {
        text-align: center;
    }

    .honey {
        display: none;
    }

    /* Header */
    .navigation .y-flex {
        position: relative;
    }

    .hotline-number {
        line-height: 56px;
        color: #51bd36;
        font-weight: bold;
        position: absolute !important;
        right: 0;
        padding-right: 20px;
    }

    .hotline-number a:hover,
    .hotline-number a:focus,
    .hotline-number a:active {
        text-decoration: none;
        color: #51bd36;
    }

    /*---Cup CSS---*/
    #cupcontainer {
        position: relative;
        overflow: hidden;
        background: none;
        margin: 0 auto;
    }

    img.loadpic {
        margin: 0;
    }

    .free-choice-price,
    .fruit-box-price {
        width: 194px;
        text-align: center;
        color: #51bd36;
        font-size: 20px;
        margin: 5px auto;
    }

    .select2-results {
        margin: 0;
    }

    .select2-results .select2-highlighted {
        color: #555;
    }

    .select2-container-multi .select2-choices .select2-search-choice {
        background: #5ebd5e;
    }

    .select2-container-multi.select2-dropdown-open .select2-choices,
    .select2-drop-active {
        border: 1px solid #5ebd5e;
    }

    input[id^="s2id_autogen"] {
        min-width: 200px;
    }

    .modal-dialog:not(.normal-dialog) {
        width: 950px;
        max-width: 90%;
    }

    #modal-subscribe .modal-dialog {
        width: 400px;
    }

    .sub_product {
        font-size: 90%;
        font-style: italic;
    }

    .nopadding {
        padding: 0;
    }

    #ui-wizard-modal .wizard-content .table-responsive {
        height: 450px;
        overflow: auto;
        margin-bottom: 5px;
    }

    #ui-wizard-modal h3 {
        color: #51bd36;
    }

    #ui-wizard-modal h2 .datetimepicker2 {
        color: #000;
    }

    #ui-wizard-modal .input-group-addon.get-distance {
        background: none;
        border: medium none;
        padding: 0 0 0 5px;
    }

    #ui-wizard-modal .input-group-addon.free-ship {
        background: rgba(81, 189, 54, 0.8);
        border: medium none;
        padding: 5px;
        color: #fff;
    }

    #ui-wizard-modal .block-add-address .input-group .fa {
        color: #fff;
        font-size: 12px;
        position: absolute;
        top: 5px;
        left: 0;
        background-color: #959595;
        width: 22px;
        text-align: center;
        height: 22px;
        border-radius: 50%;
        line-height: 22px;
    }

    #ui-wizard-modal .block-add-address .input-group select {
        text-indent: -2px;
    }

    #ui-wizard-modal .block-add-address .input-group input,
    #ui-wizard-modal .block-add-address .input-group select {
        padding: 0 0 0 30px;
        width: 100%;
        font-size: 14px;
        height: 35px;
        border: none;
        border-bottom: 1px solid #959595;
        box-shadow: none;
        background: none;
    }

    #ui-wizard-modal .block-add-address .input-group .ng-invalid,
    #ui-wizard-modal .block-add-address .input-group .error {
        border-bottom: 1px solid #cf2127;
    }

    #ui-wizard-modal .block-add-address .input-group {
        width: 100%;
        margin-bottom: 10px;
    }

    #ui-wizard-modal .block-add-address .input-group .ng-valid:not(.error) {
        border-bottom: 1px solid #51bd36;
    }

    #ui-wizard-modal .block-add-address .input-group .ng-valid:not(.error)+.fa {
        background-color: #51bd36;
    }

    #ui-wizard-modal .block-add-address .input-group label.error {
        margin-bottom: 0;
    }

    #ui-wizard-modal .block-add-address .input-group .find-local {
        font-size: 14px;
        color: #0288d1;
        cursor: pointer;
        border: 0;
        background-color: transparent;
        position: absolute;
        bottom: 12px;
        right: 0;
    }

    .pac-container {
        z-index: 1051 !important;
    }

    span.strike {
        text-decoration: none;
        /*we're replacing the default line-through*/
        position: relative;
        display: inline-block;
        /* don't wrap to multiple lines */
    }

    span.strike:after {
        border-top: 3px solid rgb(255, 0, 0);
        bottom: 0;
        content: "";
        height: 45%;
        left: 0;
        position: absolute;
        width: 100%;
        transform: rotateZ(-5deg);
    }

    /* Menu */
    .ninja-menu a,
    .ninja-menu a:hover,
    .ninja-menu a:focus {
        text-decoration: none;
        color: #58b720;
    }

    .nav-sidebar {
        background: #515151;
    }

    .nav-sidebar li {
        border-top: 1px solid #424242;
        border-bottom: 1px solid #424242;
    }

    .nav-sidebar li+li {
        border-top: medium none;
    }

    .nav-sidebar li:not(.active) a:hover,
    .menu-items .products table.product-container:not(.active) a:hover {
        background: none;
        color: #58b720;

    }

    .nav-sidebar li.active a:hover,
    .menu-items .products table.product-container a:hover {
        background: none;
    }

    .nav-sidebar li a:focus,
    .menu-items .products table.product-container a:focus {
        background: none;
        color: #58b720;
    }

    .nav-sidebar li.active {
        background: #2a2a2a;
    }

    .nav-sidebar li.active a {
        color: #ddd;
    }

    .nav-sidebar li.active::after {
        -moz-border-bottom-colors: none;
        -moz-border-left-colors: none;
        -moz-border-right-colors: none;
        -moz-border-top-colors: none;
        border-color: #2a2a2a transparent transparent;
        border-image: none;
        border-style: solid;
        border-width: 10px;
        bottom: auto;
        content: "";
        height: 0;
        left: 100%;
        margin-left: 0px;
        position: absolute;
        right: auto;
        top: 30%;
        width: 0;
        -webkit-transform: rotate(270deg);
        -moz-transform: rotate(270deg);
        -o-transform: rotate(270deg);
        -ms-transform: rotate(270deg);
    }

    .nav-sidebar li a .badge,
    .menu-items .products table.product-container a .badge {
        background-color: #6cc957;
        color: #ddd;
        border: medium none;
    }

    .sidebar.top-inline {
        z-index: 11;
    }

    .sidebar.top-inline .nav-sidebar {
        background: white;
    }

    .sidebar.top-inline .nav-sidebar li {
        display: inline-block;
        border: none;
    }

    .sidebar.top-inline .nav-sidebar li>a {
        color: #383838;
        padding: 5px 10px;
    }

    .sidebar.top-inline .nav-sidebar li.active {
        background: none;
    }

    .sidebar.top-inline .nav-sidebar li.active>a {
        color: #58b720;
        border-bottom: 3px solid;
    }

    .sidebar.top-inline .nav-sidebar li.active::after {
        display: none;
    }

    .sidebar.top-inline #efruit-menu.fixed {
        position: fixed;
        top: 0;
        left: 0;
        margin: 0;
        padding: 10px;
        width: 100% !important;
        z-index: 100;
        text-align: center;
    }

    #menu-search {
        width: 300px;
        vertical-align: middle;
    }

    #menu-search:hover {
        background: none;
    }

    #menu-search input,
    .search-control input {
        display: inline;
        background: #fff url("<?= get_theme_assets_url() ?>img/search-icon.png") no-repeat scroll 5px center;
        background-size: 18px 18px;
        padding-left: 30px;
    }

    .search-control {
        margin: 10px;
    }


    .ui-autocomplete.ui-widget {
        font-size: 14px;
        z-index: 1080;
    }

    .ui-autocomplete.ui-widget li {
        padding: 6px 12px;
        cursor: pointer;
    }

    #navigation .affix {
        margin-top: 30px;
    }

    #navigation .affix li a {
        -moz-box-shadow: 0px 10px 14px -7px #3e7327;
        -webkit-box-shadow: 0px 10px 14px -7px #3e7327;
        box-shadow: 0px 6px 14px -7px #3e7327;
        background-color: #4cb64c;
        -moz-border-radius: 0 4px 4px 0;
        -webkit-border-radius: 0 4px 4px 0;
        border-radius: 0 4px 4px 0;
        display: block;
        cursor: pointer;
        color: #ffffff;
        font-family: Arial;
        font-size: 13px;
        font-weight: bold;
        padding: 6px 12px;
        text-decoration: none;
        text-shadow: 0px 1px 0px #5b8a3c;
    }

    #navigation .affix li a:hover {
        background-color: #72b352;
    }

    #navigation .affix li a:active {
        position: relative;
        top: 1px;
    }


    .fruit-btn {
        margin: 0 0 10px 10px;
    }

    .fruit-btn .badge {
        border: medium none;
        left: -8px;
        padding: 0 6px;
        position: absolute;
        top: -5px;
    }

    table.product-container.disabled img.sold_out {
        opacity: 1;
        position: absolute;
        left: 200px;
        -webkit-transform: rotate(350deg);
        -moz-transform: rotate(350deg);
        -o-transform: rotate(350deg);
        -ms-transform: rotate(350deg);
        height: 20px;
        top: 50px;
    }

    .menu-items {
        margin-left: 15px;
        margin-top: 20px;
    }

    .menu-items .products {
        padding: 0;
        margin: 0;
        overflow: hidden;
        max-width: 100%;
    }

    .menu-items .products table.product-container {
        position: relative;
        background: rgba(42, 42, 42, 0.75);
    }

    .menu-items .products table.product-container {
        width: 100%;
    }

    .menu-items .products table.product-container .td-image {
        width: 110px;
    }

    .menu-items .products table.product-container .td-price {
        padding-right: 10px;
        width: 120px;
    }

    .menu-items .products table.product-container a {
        padding: 10px 15px;
        color: #eee;
        list-style: outside none none;
        display: inline-block;
    }

    .menu-items .products table.product-container.disabled a {
        color: #888;
    }

    .menu-items .products table.product-container span.price {
        font-size: 90%;
        font-style: italic;
    }

    .menu-items .products table.product-container .product-price {
        display: inline-block;
        color: rgb(238, 238, 238);
        vertical-align: middle;
    }

    .menu-items .products table.product-container .product-price .btn-booking {
        background: #58B720;
        padding: 5px 8px;
        border-radius: 5px;
        cursor: pointer;
    }

    .menu-items .products table.product-container .product_description {
        padding-left: 15px;
        color: #eee;
        font-style: italic;
        font-size: 90%;
        margin-top: 0;
    }

    .menu-items .products table.product-container a.product-info {
        font-weight: bold;
        font-size: 14px;
    }

    .masonry-brick {
        display: none;
    }

    .masonry-brick.loaded {
        display: block;
    }

    #efruit-menu {
        margin: 10px 0;
    }

    #efruit-menu.fixed {
        position: fixed;
        top: 10px;
        left: 11px;
    }

    .nav.products {
        position: unset;
    }

    .frontend .marketing .print {
        padding: 0 16px;
    }

    .modal-dialog .close {

        font-size: 20px;
        margin-right: 5px;
        opacity: 0.7;
        text-shadow: unset;
    }

    .modal-dialog .close:hover {
        opacity: 1;
    }

    .modal-header {
        background: #fff;
        border: none;
        padding: 10px;
    }

    .modal-header+.modal-content {
        border-top-right-radius: 0;
        border-top-left-radius: 0;
    }

    #fruit-free-choices-modal .modal-dialog .close {
        color: #f4b04f;
    }

    .shipping_table {
        width: 100%;
    }

    .shipping_table th,
    .shipping_table td {
        padding: 2px 4px;
        border: 1px solid #fff;
        text-align: center;
    }

    .shipping_table th {
        background-color: rgb(146, 208, 80);
        color: #333;
    }

    .shipping_table td {
        background: #d2691e;
    }

    .shipping_table td.no-fee {
        background: none;
        color: #51bd36;
    }

    .shipping_table td.no-service {
        background: none;
    }

    .old-price {
        text-decoration: line-through;
        font-size: 12px;
        color: #ccc;
    }

    .new-price {
        font-size: 15px;
    }

    /* Mobile menu */
    .mobile-nav,
    .mobile-view {
        display: none;
    }

    ul.menu {
        padding-top: 56px;
        margin: 0;
    }

    ul.menu>li {
        position: relative;
        transition: all 150ms cubic-bezier(0.175, 0.885, 0.525, 1.2) 0s;
        -ms-transition: all 150ms cubic-bezier(0.175, 0.885, 0.525, 1.2) 0s;
        -webkit-transition: all 150ms cubic-bezier(0.175, 0.885, 0.525, 1.2) 0s;
        visibility: hidden;
        opacity: 0;
        top: -15px;
        width: 100%;
        height: 50px;
        display: none;
        list-style: none;
    }

    ul.menu>li>a {
        background: #fff;
        border-top: 1px solid #51bd36;
        color: #58b720;
        display: block;
        font-size: 18px;
        height: 35px;
        line-height: 35px;
        margin: 0;
        padding-left: 20px;
        position: relative;
        text-decoration: none;
        z-index: 1000;
        font-family: VPSHANO;
    }

    ul.menu li:last-child a {
        border-bottom: 1px solid #51bd36;
    }

    div.mobile-nav.items-visible ul.menu li {
        opacity: 1;
        top: 0;
        visibility: visible;
        height: auto;
    }

    div.mobile-nav ul.menu {
        z-index: 10000;
        position: relative;
    }

    .menu-bar.exit {
        animation: 0s ease 0s normal none 1 running none;
    }

    .menu-bar {
        transition: all 0.3s ease 0s;
        -ms-transition: all 0.3s ease 0s;
        -webkit-transition: all 0.3s ease 0s;
        animation: 4s ease 0s normal none infinite running blinkBackground;
        text-align: center;
        z-index: 10001;
        width: 30px;
        height: 30px;
        float: left;
        display: block;
        position: relative;
        left: 5px;
        top: 12px;
    }

    .menu-bar .ham {
        background: #51bd36;
        display: inline-block;
        height: 2px;
        position: relative;
        top: -2px;
        transition: all 0.3s ease 0s;
        -ms-transition: all 0.3s ease 0s;
        -webkit-transition: all 0.3s ease 0s;
        vertical-align: bottom;
        width: 23px;
    }

    .menu-bar .ham::after,
    .menu-bar .ham::before {
        background: #51bd36;
        content: "";
        display: inline-block;
        height: 2px;
        left: 0;
        outline: 1px solid transparent;
        position: absolute;
        transition: all 0.3s ease 0s;
        -ms-transition: all 0.3s ease 0s;
        -webkit-transition: all 0.3s ease 0s;
        width: 23px;
    }

    .menu-bar .ham::before {
        top: -8px;
    }

    .menu-bar .ham::after {
        top: 8px;
    }

    .menu-bar.exit .ham::before {
        transform: translateY(8px) rotateZ(-45deg);
        -ms-transform: translateY(8px) rotateZ(-45deg);
        /* IE 9 */
        -webkit-transform: translateY(8px) rotateZ(-45deg);
        /* Safari */
    }

    .menu-bar.exit .ham::after {
        transform: translateY(-8px) rotateZ(45deg);
        -ms-transform: translateY(-8px) rotateZ(45deg);
        /* IE 9 */
        -webkit-transform: translateY(-8px) rotateZ(45deg);
        /* Safari */
    }

    .menu-bar.exit .ham {
        background-color: transparent !important;
    }

    /* Product tabs */
    .y-select {
        background: #fff none repeat scroll 0 0;
        -webkit-border-radius: 3px;
        -moz-border-radius: 3px;
        border-radius: 3px;
    }

    .browse-tabs .tab-dropdown li {
        background: none;
    }

    .browse-tabs .tab-dropdown li .y-select.small select {
        width: 240px;
        font-size: 15px;
        line-height: 20px;
    }

    .y-foot {
        font-size: 14px;
    }

    .y-foot .wrapper {
        height: 240px;
    }

    #toTop {
        background: rgba(0, 0, 0, 0) url("<?= get_theme_assets_url() ?>img/totop.png") no-repeat scroll left top;
        background-size: 100% auto;
        border: medium none;
        bottom: 2px;
        display: none;
        height: 40px;
        overflow: hidden;
        position: fixed;
        right: 330px;
        text-decoration: none;
        text-indent: 100%;
        width: 40px;
        z-index: 1040;
    }

    #toTopHover {
        background: rgba(0, 0, 0, 0) url("<?= get_theme_assets_url() ?>img/totop.png") no-repeat scroll left -40px;
        background-size: 100% auto;
        display: block;
        float: left;
        height: 40px;
        opacity: 0;
        overflow: hidden;
        width: 40px;
    }

    .shipping_process>div {
        color: #eee;
    }

    .shipping_process>div p,
    .shipping_process>div h3 {
        text-align: center;
    }

    .shipping_process>div h3 {
        text-transform: uppercase;
    }

    .shipping_process>div:hover .shipping_step {
        background: #51bd36;
        text-align: center;
    }

    .shipping_process .shipping_step {
        border: 1px solid;
        -webkit-border-radius: 35px;
        -moz-border-radius: 35px;
        border-radius: 35px;
        height: 35px;
        line-height: 35px;
        margin: 20px auto 0;
        text-align: center;
        width: 35px;
        display: inline-block;
        font-size: 16px;
    }

    .y-grid-card.not_deliver .y-info {
        width: 90%;
    }

    .y-grid-card.not_deliver .add-to-cart {
        display: none;
    }

    .y-grid-card.compact .y-ingredients {
        -webkit-transition: all 2s;
        -moz-transition: all 2s;
        transition: all 2s;
        opacity: 1 !important;
    }

    .y-grid-card .sold_out {
        height: 24px;
        opacity: 1;
        position: absolute;
        transform: rotate(350deg);
        bottom: 5%;
        left: auto;
        right: 5%;
        top: auto;
    }


    .subscribe-frm {
        background: transparent;
        border: 0 none;
        bottom: 0;
        margin-bottom: 0;
        margin-right: 0;
        margin-top: 0;
        overflow: hidden;
        padding: 0;
        position: fixed;
        right: 10px;
        width: auto;
        z-index: 1041;
        -webkit-border-top-left-radius: 5px;
        -webkit-border-top-right-radius: 5px;
        -moz-border-radius-topleft: 5px;
        -moz-border-radius-topright: 5px;
        border-top-left-radius: 5px;
        border-top-right-radius: 5px;
    }

    .subscribe-frm .minimize {
        color: #fff;
        background: #51bd36;
        cursor: pointer;
    }

    .subscribe-frm .minimize .subscribe-icon {
        background: #51bd36;
        display: inline-block;
        padding: 5px 10px;
        border-right: 1px solid #ddd;
    }

    .subscribe-frm .minimize .subscribe-text {
        display: inline-block;
        padding: 5px 10px;
    }

    .subscribe-frm .maximize {
        display: none;
        background: #fff;
        max-width: 100%;
        width: 300px;
        border-left: 1px solid #51bd36;
        border-right: 1px solid #51bd36;
    }

    .subscribe-frm .maximize .frm-header {
        background: #51bd36;
        color: #fff;
        font-size: 16px;
        line-height: 30px;
        text-align: center;
        position: relative;
        cursor: pointer;
    }

    .subscribe-frm .maximize .minimize-btn {
        background-color: #fcfdfa;
        height: 2px;
        margin: auto;
        position: absolute;
        right: 10px;
        top: 14px;
        width: 10px;
    }

    .subscribe-frm .maximize #subscribe-form {
        padding: 10px 20px
    }

    .subscribe-frm .maximize input {
        display: block;
        margin: 5px auto;
        width: 100%;
    }

    .subscribe-frm .maximize #subscribe {
        -moz-appearance: none;
        background: #51bd36;
        border-color: #6ca900;
        border-radius: 3px;
        border-style: solid;
        border-width: 1px;
        color: #ffffff;
        cursor: pointer;
        font-weight: bold;
        overflow: hidden;
        padding: 6px 3px;
        text-overflow: ellipsis;
        white-space: nowrap;
        word-wrap: normal;
        opacity: 0.9;
    }

    .subscribe-frm .maximize #subscribe:hover {
        opacity: 1;
        background: #51bd36 !important;
    }

    .subscribe-frm.open .minimize {
        display: none;
    }

    .subscribe-frm.open .maximize {
        display: inherit;
    }

    /* Announcements */
    #modal-notices .message {
        padding-top: 20px;
    }

    #modal-notices .message:after {
        content: "";
        width: 70%;
        height: 1px;
        border-top: 1px solid #eee;
        margin: 0 auto;
    }

    #modal-notices .message:first-child {
        padding-top: 0;
    }

    #modal-notices .message:last-child:after {
        border-top: none;
    }

    #modal-notices .message p {
        color: #fff;
    }

    .modal.dark-bg p {
        color: #fff;
    }

    .datetimepicker .input-group-addon {
        cursor: pointer;
    }

    .datetimepicker .closeText:before {
        content: "OK";
    }

    .datetimepicker2 {
        width: auto;
        display: inline;
    }

    .datetimepicker2 .input-group-addon {
        width: auto;
        border: none;
        border-radius: 3px;
    }

    .promotion_section {
        margin-bottom: 10px;
    }

    .promotion_code_input {
        margin: 0;
        width: 150px;
        display: inline-block;
        padding: 3px 8px !important;
    }

    .promotion_code_input+a {
        padding: 3px 8px;
        margin-top: -3px;
    }

    .frontend .hero-wrapper>span {
        position: absolute;
        top: 0;
        left: 0;
        height: 0;
        width: 100%;
        opacity: 0;
        -webkit-transition: all 1s;
        -moz-transition: all 1s;
        -o-transition: all 1s;
        transition: all 1s;
    }

    .frontend .hero-wrapper.mutil-background>span {
        opacity: 1;
        height: 100%;
    }

    .nav-mobile-dropdown {
        display: block;
        background: #fff;
        list-style: none;
        padding-left: 40px;
    }

    .nav-mobile-dropdown li {
        font-size: 16px;
        border: none;
        padding: 2px 0;
    }

    .nav-mobile-dropdown li a:hover {
        text-decoration: none;
    }

    ul.menu li .nav-mobile-dropdown li:last-child a {
        border: none;
    }

    .sliderSp-list {
        overflow: hidden;
    }

    .sliderSp-list .owl-nav .owl-prev {
        position: absolute;
        top: calc(50% - 25px);
        left: -25px;
        text-align: right;
    }

    .sliderSp-list .owl-nav .owl-prev>i {
        margin-right: 10px;
    }

    .sliderSp-list .owl-nav .owl-next {
        position: absolute;
        top: calc(50% - 25px);
        right: -25px;
    }

    .sliderSp-list .owl-nav .owl-next>i {
        margin-left: -10px;
    }

    .sliderSp-list .owl-nav>button {
        width: 50px;
        height: 50px;
        line-height: 50px;
        border-radius: 50% !important;
        margin: 0 !important;
        background: #fff !important;
        color: #000 !important;
        font-size: 2em !important;
        padding: 0px !important;
        padding-right: 10px !important;
        box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.5);
        transition: all 0.3s;
    }

    .sliderSp-list .owl-nav>button:hover {
        background-color: #58B720 !important;
        color: #fff !important;
    }

    .sliderSp-list .banner-container {
        padding: 40px 70px 0 70px;
        min-height: 550px;
        background-position: center center;
        background-repeat: no-repeat;
        background-size: cover;
    }

    .sliderSp-list .banner-container .featured-content {
        padding: 40px;
        border-radius: 5px;
        -webkit-border-radius: 5px;
        color: #fff;
        position: relative;
    }

    .sliderSp-list .banner-container .featured-content p {
        color: #fff;
    }

    .sliderSp-list .banner-container .featured-content a {
        text-decoration: none;
    }

    @media screen and (min-width:1000px) {
        .featured-content {
            width: 30%;
            min-width: 360px;
            min-height: 360px;
        }

        .sliderSp-list .banner-container .featured-content p.more {
            position: absolute;
            bottom: 15%;
            text-align: center;
            width: 60%;
            left: 20%;
        }

        .sliderSp-list .banner-container .featured-content p.more a {
            display: inline-block;
            width: 100%;
        }

    }

    .featured-content h1 {
        margin: 0;
        font-size: 2em;
        font-weight: 300;
        line-height: 1em;
        text-transform: uppercase;
    }

    .featured-content p:not(.more) {
        margin: 1em 0;
    }

    .featured-content p.more+p.more {
        margin-top: 0;
        border-color: #35300c;
    }

    .featured-content p.more+p.more a {
        color: #35300c;
    }

    .featured-content p.more+p.more a:before {
        background: #35300c;
    }

    .featured-content p.more a:before {
        line-heigh: 18px;
    }

    .featured-gradient-red p.more,
    .featured-gradient-grey p.more {
        border-color: #48410d;
    }

    .featured-gradient-red p.more a,
    .featured-gradient-grey p.more a {
        color: #48410d;
    }

    .featured-gradient-red p.more a:before,
    .featured-gradient-grey p.more a:before {
        background: #48410d;
    }

    .featured-gradient-red p.more+p.more,
    .featured-gradient-grey p.more+p.more {
        border-color: #000;
    }

    .featured-gradient-red p.more+p.more a,
    .featured-gradient-grey p.more+p.more a {
        color: #000;
    }

    .featured-gradient-red p.more+p.more a:before,
    .featured-gradient-grey p.more+p.more a:before {
        background: #000;
    }

    .featured-gradient-green {
        background: #7ca421;
        background: rgba(124, 164, 33, 0.8);
        background: -webkit-linear-gradient(45deg, rgba(124, 164, 33, 0.8) 0%, rgba(201, 210, 0, 0.8) 100%);
        background: -moz-linear-gradient(45deg, rgba(124, 164, 33, 0.8) 0%, rgba(201, 210, 0, 0.8) 100%);
        background: linear-gradient(45deg, rgba(124, 164, 33, 0.8) 0%, rgba(201, 210, 0, 0.8) 100%);
    }

    .featured-gradient-orange {
        background: #f1d311;
        background: rgba(242, 214, 32, 0.9);
        background: -webkit-linear-gradient(45deg, rgba(242, 214, 32, 0.9) 0%, rgba(234, 109, 26, 0.9) 100%);
        background: -moz-linear-gradient(45deg, rgba(242, 214, 32, 0.9) 0%, rgba(234, 109, 26, 0.9) 100%);
        background: linear-gradient(45deg, rgba(242, 214, 32, 0.9) 0%, rgba(234, 109, 26, 0.9) 100%);
    }

    .featured-gradient-red {
        background: #e51010;
        background: rgba(229, 16, 16, 0.8);
        background: -webkit-linear-gradient(45deg, rgba(229, 16, 16, 0.8) 0%, rgba(246, 139, 149, 0.8) 100%);
        background: -moz-linear-gradient(45deg, rgba(229, 16, 16, 0.8) 0%, rgba(246, 139, 149, 0.8) 100%);
        background: linear-gradient(45deg, rgba(229, 16, 16, 0.8) 0%, rgba(246, 139, 149, 0.8) 100%);
    }

    .featured-gradient-yellow {
        background: #ffcc00;
        background: rgba(255, 204, 0, 0.9);
        background: -webkit-linear-gradient(45deg, rgba(245, 220, 81, 0.9) 0%, rgba(255, 204, 0, 0.9) 100%);
        background: -moz-linear-gradient(45deg, rgba(245, 220, 81, 0.9) 0%, rgba(255, 204, 0, 0.9) 100%);
        background: linear-gradient(45deg, rgba(245, 220, 81, 0.9) 0%, rgba(255, 204, 0, 0.9) 100%);
    }

    .featured-gradient-grey {
        background: #5c5930;
        background: rgba(92, 89, 48, 0.9);
        background: -webkit-linear-gradient(45deg, rgba(92, 89, 48, 0.9) 0%, rgba(185, 185, 147, 0.9) 100%);
        background: -moz-linear-gradient(45deg, rgba(92, 89, 48, 0.9) 0%, rgba(185, 185, 147, 0.9) 100%);
        background: linear-gradient(45deg, rgba(92, 89, 48, 0.9) 0%, rgba(185, 185, 147, 0.9) 100%);
    }

    .featured-gradient-green p.more a:before {
        color: #a9c143;
    }

    .featured-gradient-orange p.more a:before {
        color: #efa72b;
    }

    .featured-gradient-red p.more a:before {
        color: #e35454;
    }

    .featured-gradient-yellow p.more a:before {
        color: #f2eb4a;
    }

    .featured-gradient-grey p.more a:before {
        color: #878561;
    }

    .row.no-padding {
        margin: 0 !important;
    }

    .row.no-padding>div[class*='col-'] {
        padding: 0 !important;
    }

    .indexSanPham .thumbScale {
        overflow: hidden;
        max-height: 225px;
    }

    .indexSanPham .sanPham {
        position: relative;
        cursor: pointer;
    }

    .indexSanPham .sanPham .photo a {
        float: left;
    }

    .indexSanPham .sanPham .photo a:before {
        content: "";
        position: absolute;
        top: 0px;
        left: 0px;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0);
        transition: all 0.3s;
        z-index: 1;
    }

    .indexSanPham .sanPham .photo a:hover:before {
        background: rgba(0, 0, 0, 0.5);
    }

    .indexSanPham .sanPham:hover .photo a img {
        transform: scale(1.1);
        transition: transform 1s ease 0s, opacity 1s ease-out 0s;

    }

    .indexSanPham .sanPham .info {
        position: absolute;
        bottom: 0px;
        left: 0px;
        width: 100%;
        background: -moz-linear-gradient(top, rgba(255, 255, 255, 0) 0%, rgba(26, 66, 0, 0.6) 100%);
        background: -webkit-linear-gradient(top, rgba(255, 255, 255, 0) 0%, rgba(26, 66, 0, 0.6) 100%);
        background: linear-gradient(to bottom, rgba(255, 255, 255, 0) 0%, rgba(26, 66, 0, 0.6) 100%);
        filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#00ffffff', endColorstr='#1a4200', GradientType=0);
        z-index: 1;
    }

    .indexSanPham .sanPham .info a {
        width: 100%;
        height: 100%;
        color: #fff;
        padding: 35px;
        text-transform: uppercase;
        display: block;
    }

    .indexSanPham .sanPham .info a:hover {
        text-decoration: none;
    }

    .indexSanPham .sanPham .info p {
        color: #fff;
        margin: 0;
    }

    .indexSanPham .sanPham .info .title {
        font-size: 1.5em;
        font-weight: 800;
        padding-bottom: 5px;
        margin: 0px;
    }

    .switch-layout {
        float: right;
    }

    .switch-layout a {
        color: #888;
        font-size: 20px;
    }

    .switch-layout a.active,
    .switch-layout a:hover {
        color: white;
    }

    .efruit-cart .switch-layout {
        margin-top: 5px;
    }

    .efruit-cart .switch-layout a.active,
    .efruit-cart .switch-layout a:hover {
        color: #58b720;
    }

    .fancybox-lock .fancybox-overlay.fancybox-overlay-fixed {
        width: auto !important;
        height: 100vh !important;
        overflow: hidden !important;
        display: block;
        z-index: 1000 !important;
    }

    .fancybox-lock .fancybox-overlay.fancybox-overlay-fixed .fancybox-wrap.fancybox-desktop.fancybox-type-image.fancybox-opened {
        z-index: 1000 !important;
    }

    .frontend .marketing .title {
        margin-top: 24px;
    }

    .promotion-item {
        padding: 15px 0;
        border-top: 2px solid #ddd;
    }

    .promotion-item:first-child {
        border-top: none;
    }

    .promotion-item p {
        margin: 0 0 0.75em;
    }

    .promotion-item .promotion-image {
        width: 100%;
    }

    .assessment_star .star-box>div {
        display: inline-block;
    }

    .assessment_star input.input-hidden {
        display: none;
    }

    .assessment_star img.star-rate {
        margin: 0 5px;
        cursor: pointer;
        width: 30px;
    }

    .assessment_star img.star-rate.gray-star {
        filter: brightness(0) invert(0.5);
    }

    .criteria-list {
        text-align: center;
        margin-top: 10px;
    }

    .criteria-list a.btn {}

    .criteria-list a.btn.active {
        background: #5ebd5e !important;
        background-image: linear-gradient(to bottom, #62be62 0, #4cb64c 100%) !important;
        ;
        color: #fff;
    }

    span.bold {
        font-weight: bold;
    }

    span.badge {
        border: none !important;
    }

    span.badge.pending,
    span.badge.waiting_for_staff_confirm {
        background-color: #ffc107;
    }

    span.badge.in_process,
    span.badge.process_completed {
        color: #fff;
        background-color: #007bff;
    }

    span.badge.shipping {
        color: #fff;
        background-color: #17a2b8;
    }

    span.badge.completed {
        color: #fff;
        background-color: #28a745;
    }

    span.badge.on_hold,
    span.badge.failed {
        color: #fff;
        background-color: #dc3545;
    }

    .modal .product-image-container {
        position: relative;
        ;
    }

    .content-body.container {
        padding-top: 20px;
    }

    .bootbox.bootbox-form-alert .modal-dialog {
        max-width: 500px;
    }

    @media only screen and (max-width: 1050px) {
        #menu-search {
            display: none;
        }
    }

    @media screen and (max-width:991px) {
        .mx10-md {
            margin-left: 10px;
            margin-right: 10px;
        }

        .mb10-md {
            margin-bottom: 10px;
        }

        .y-foot .wrapper {
            height: auto;
        }

        .y-foot .column.contact {
            margin: 0 auto;
            width: 100%;
        }

        .frontend .hero-wrapper {
            background-size: cover !important;
        }

        .promotion-item .promotion-image {
            margin-bottom: 20px;
            max-width: 400px;
        }
    }

    @media screen and (max-width:820px) {
        .promotion_section {
            float: none;
        }
    }

    @media screen and (max-width:768px) {
        #toTop {
            bottom: 50px;
            right: 20px;
        }

        .nav-sidebar li.active::after {
            display: none;
        }

        .menu-items .products {
            margin-left: 0;
            width: 100%;
        }

        .menu-items .products table.product-container {
            width: 100%;
        }

        .frontend .marketing .title {
            font-size: 24px;
            line-height: 28px;
            margin-bottom: 20px;
            margin-top: 20px;
        }

        .frontend .marketing .block {
            margin-bottom: 28px;
            max-width: none;
            width: 100%;
        }

        .frontend .marketing .block.middle {
            border: medium none;
            width: 100%;
        }

        .frontend .marketing .block-icon {
            width: 100px;
        }

        .frontend .marketing .print {
            font-size: 14px;
            line-height: 20px;
            margin: 0;
            max-width: none;
            min-width: initial;
            padding: 0 0 0 10px;
            text-align: left;
            width: 300px;
        }

        .frontend .marketing .sign-up {
            margin-top: 0;
        }

        .frontend.views-home .hero {
            height: 300px;
        }

        .search-control {
            margin: 10px;
        }

        .sliderSp-list .banner-container {
            min-height: 400px;
        }

        .frontend .content-body table td {
            display: inline-block;
            width: 100% !important;
        }
    }

    @media screen and (max-width:710px) {
        .navigation .logo-wrap {
            text-align: left;
            width: 40px;
        }

        .navigation .logo-wrap .logo img {
            height: 35px;
        }

        .navigation .tel-wrap {
            width: 100px;
        }

        .navigation .nav-wrap {
            text-align: right;
        }

        .navigation .nav-wrap .badge {
            top: -10px;
        }

        .navigation .login-state {
            width: 50px;
        }

        .navigation .login-state .badge {
            top: 0;
        }

        .navigation table {
            margin-left: 45px;
            z-index: 1051;
        }

        #show-cart2 {
            position: absolute;
            right: 0;
            top: 13px;
        }

        #language_selector {
            right: 60px;
            top: 16px;
        }

        .navigation .y-flex {
            display: none;
        }

        .mobile-nav {
            display: block;
            position: fixed;
            width: 100%;
            top: 0;
            z-index: 1050;
        }

        div.mobile-nav ul.menu {
            overflow-y: auto;
            width: 100%;
            padding-top: 0;
            height: calc(100vh - 25px);
            margin-top: 56px;
            border-top: 1px solid #51bd36;
        }

        .mobile-view {
            display: block;
        }

        #header {
            display: none;
        }

        .menu-items .products {
            margin: 0 0 20px 0;
            width: 100%;
        }

        .menu-items .products table.product-container a {
            width: 80%;
        }

        .menu-items .products table.product-container span.price {
            right: -20%;
        }

        .menu-items .products div.backstretch {
            width: 100% !important;
        }

        .menu-items .products div.backstretch img {
            left: 0 !important;
        }

        .modal-dialog {
            max-width: 94% !important;
        }

        .btn-yum .yum,
        .btn-yum .count {
            opacity: 1;
        }

        .y-foot .wrapper {
            padding: 20px;
        }

        .y-foot .identity {
            float: none;
            text-align: center;
        }

        .y-foot .column {
            width: 100%;
            text-align: center;
        }

        .shipping_process>div>.des-wrapper {
            min-height: 0 !important;
        }

        .shipping_process>div {
            margin-bottom: 40px;
        }

        .menu-items .products table.product-container .td-image img {
            height: auto;
        }
    }

    @media screen and (max-width:480px) {
        #show-cart2 {
            right: 20px;
            top: 16px;
        }

        #language_selector {
            right: 45px;
            top: 19px;
        }

        .menu-items .products div.product-container {
            margin-bottom: 20px;
            background: none;
        }

        .menu-items .products table.product-container {}

        .menu-items .products table.product-container td {
            display: block;
            text-align: center;
        }

        .menu-items .products table.product-container .td-image {
            width: auto;
        }

        .menu-items .products table.product-container .td-image img {
            width: 200px;
            height: auto;
        }

        .menu-items .products table.product-container .td-price {
            margin: 0 auto;
        }

        .menu-items .products table.product-container a {
            padding: 5px 0;
        }

        .sliderSp-list .banner-container {
            min-height: 300px;
        }

        .new-price {
            font-size: 13px;
        }

        .old-price {
            display: block;
            font-size: 10px;
        }
    }

    @media screen and (max-width:420px) {
        .frontend .press {
            padding: 10px;
        }

        .frontend .press .asset {
            margin: 5px;
        }

        #change_captcha {
            display: block;
        }

        .shipping_table th,
        .shipping_table td {
            font-size: 10px;
        }
    }

    @media screen and (max-width:360px) {
        #show-cart2 {
            right: 28px;
        }

        .frontend .press .asset {
            max-width: 30%;
        }
    }

    @media screen and (max-width:320px) {

        .shipping_table th,
        .shipping_table td {
            font-size: 9px;
        }

        div.mobile-nav ul.menu {
            max-height: 454px;
            overflow: auto;
            width: 100%;
            padding-top: 26px;
        }
    }

    @media screen and (max-height:480px) {
        div.mobile-nav ul.menu {
            z-index: 10000;
            position: relative;
            max-height: 424px;
            overflow: auto;
            width: 100%;
            margin-top: 56px;
            padding: 0;
        }
    }

    @keyframes efruit-anim1 {
        0% {
            opacity: 0.1;
            transform: rotate(0deg) scale(0.5) skew(1deg);
        }

        30% {
            opacity: 0.5;
            transform: rotate(0deg) scale(0.7) skew(1deg);
        }

        100% {
            opacity: 0.6;
            transform: rotate(0deg) scale(1) skew(1deg);
        }
    }

    @keyframes efruit-anim2 {
        0% {
            opacity: 0.2;
            transform: rotate(0deg) scale(0.7) skew(1deg);
        }

        50% {
            opacity: 0.2;
            transform: rotate(0deg) scale(1) skew(1deg);
        }

        100% {
            opacity: 0.2;
            transform: rotate(0deg) scale(0.7) skew(1deg);
        }
    }

    @keyframes efruit-anim3 {
        0% {
            transform: rotate(0deg) scale(1) skew(1deg);
        }

        10% {
            transform: rotate(-25deg) scale(1) skew(1deg);
        }

        20% {
            transform: rotate(25deg) scale(1) skew(1deg);
        }

        30% {
            transform: rotate(-25deg) scale(1) skew(1deg);
        }

        40% {
            transform: rotate(25deg) scale(1) skew(1deg);
        }

        50% {
            transform: rotate(0deg) scale(1) skew(1deg);
        }

        100% {
            transform: rotate(0deg) scale(1) skew(1deg);
        }
    }
</style>