<style>
    .modal.product-modal .modal-content{
        background: white;
        border: 1px solid rgba(0,0,0,.2);
        border-radius: 6px;
        -webkit-box-shadow: 0 5px 15px rgba(0,0,0,.5);
        box-shadow: 0 5px 15px rgba(0,0,0,.5);
    }
    .modal.product-modal .modal-header{
        background: #fff;
        border: none;
        padding: 10px;
    }
    .modal.product-modal .modal-header h3{
        font-size: 20px;
        line-height: 24px;
    }
    .modal.product-modal .modal-dialog:not(.normal-dialog) {
        width: 950px;
        max-width: 90%;
    }
    .modal.product-modal img{
        max-width: 100%;
    }
    #view-product-modal div[class*="col-"],
    #fruit-box-modal div[class*="col-"] {
        margin-bottom: 15px;
    }
    #view-product-modal .product-image-container {
        position: relative;
        display: inline-block;
    }

    .half-circle-ribbon {
        background: #9BC90D;
        color: #fff !important;
        height: 40px;
        width: 40px;
        padding-top: 15px;
        padding-right: 2px;
        position: absolute;
        top: 0;
        right: 0;
        border-radius: 0 0 0 100%;
        border: 1px dashed #fff;
        box-shadow: 0 0 0 3px #9BC90D;
        font-size: 15px;
        text-align: right;
        font-weight: bold;
        z-index: 1;
    }
    .y-grid-card.animate .half-circle-ribbon{
        opacity: 0.6;
    }
    .y-grid-card.animate:hover .half-circle-ribbon{
        opacity: 0.8;
    }

    .menu-items .half-circle-ribbon, .product-image-container .half-circle-ribbon{
        padding-top: 8px;
        font-size: 13px;
    }

    .half-circle-ribbon.ribbon-left{
        right: auto;
        left: 0;
        border-radius: 0 0 100% 0;
        text-align: left;
        padding-left: 2px;
        padding-right: 0;
    }

    .ribbon {
        position: absolute;
        right: 0; top: 0;
        z-index: 1;
        overflow: hidden;
        width: 100px; height: 100px;
        text-align: right;
    }
    .ribbon span {
        font-size: 12px;
        font-weight: bold;
        color: #FFF;
        text-transform: uppercase;
        text-align: center;
        line-height: 20px;
        transform: rotate(45deg);
        -webkit-transform: rotate(45deg);
        width: 120px;
        display: block;
        background: #79A70A;
        background: linear-gradient(#9BC90D 0%, #79A70A 100%);
        box-shadow: 0 3px 10px -5px rgba(0, 0, 0, 1);
        position: absolute;
        top: 25px; right: -25px;
    }

    .ribbon.ribbon-left{
        right: auto;
        left: 0;
    }

    .ribbon.ribbon-left span {
        transform: rotate(-45deg);
        -webkit-transform: rotate(-45deg);
        left: -25px;
        right: auto;
    }
    .modal.product-modal .inline-block{
        display: inline-block;
    }
    .modal.product-modal .nopadding {
        padding: 0;
    }
    .custom-checkbox-with-tick [type="checkbox"]:not(:checked) + label,
    .custom-checkbox-with-tick [type="checkbox"]:checked + label {
        font-weight: normal;
    }
    #fruit-free-choices-modal .custom-checkbox-with-tick label,
    #fruit-free-choices-modal .custom-radio-with-tick label {
        color: white !important;
    }

    #fruit-free-choices-modal .fruit-btn{
        margin: 0 0 10px 10px;
    }
    #fruit-free-choices-modal .badge{
        margin: 5px;
        font-size: 13px;
        background: none !important;
        padding: 10px;
    }
    #fruit-free-choices-modal .today-fruit-list span:last-child span.commas{display: none;}
    #fruit-free-choices-modal .modal-dialog .close{color: #f4b04f;}
    #fruit-free-choices-modal .modal-dialog span.badge {
        border: none !important;
    }
    #fruit-free-choices-modal .modal-dialog .close {
        font-size: 20px;
        margin-right: 5px;
        opacity: 0.7;
        text-shadow: unset;
    }
    .modal.product-modal h1,
    .modal.product-modal h2,
    .modal.product-modal h3,
    .modal.product-modal h4,
    .modal.product-modal h5,
    .modal.product-modal h6 {
        font-weight: normal;
        margin: 0;
        padding-top: 0;
        padding-right: 0;
    }

    .pxajs .wizard-pane {
        display: none;
    }
    .wizard-wrapper + .wizard-content.panel {
        margin-top: -1px;
    }
    .wizard.freeze .wizard-steps > li {
        cursor: default !important;
    }
    .modal-content > .wizard .wizard-wrapper {
        border-left: none;
        border-radius: 0;
        border-right: none;
        border-top: none;
    }
    .wizard-wrapper {
        border: 1px solid #e4e4e4;
        border-radius: 2px;
        white-space: nowrap;
        width: auto;
        position: relative;
        overflow: hidden;
    }
    .wizard-steps {
        cursor: default;
        display: block !important;
        float: left;
        margin: 0;
        padding: 0;
        position: relative;
        white-space: nowrap;
        -webkit-transition: left 0.3s;
        transition: left 0.3s;
        -webkit-touch-callout: none;
        -webkit-user-select: none;
        -khtml-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
    }
    .wizard-steps > li {
        display: inline-block;
        list-style: none;
        margin: 0 0 0;
        padding: 0 10px 0 50px;
        vertical-align: middle;
    }
    .wizard-steps > li + li:before {
        background: #e4e4e4;
        bottom: 0;
        content: "";
        margin-left: -51px;
        position: absolute;
        top: 0;
        width: 1px;
    }
    .wizard-steps > li.completed {
        cursor: pointer;
    }
    .wizard-steps > li.active .wizard-step-caption,
    .wizard-steps > li.completed .wizard-step-caption {
        color: #555555;
    }
    .wizard-steps > li.active .wizard-step-description,
    .wizard-steps > li.completed .wizard-step-description {
        color: #888;
    }
    .wizard-steps > li.active .wizard-step-number,
    .wizard-steps > li.completed .wizard-step-number {
        border-color: #555555;
        color: #555555;
    }
    .wizard-steps .wizard-step-number:after {
        display: none;
    }
    .wizard-step-number,
    .wizard-steps > li.completed .wizard-step-number:after {
        background: #fff;
        border-radius: 9999px;
        display: block;
        font-size: 14px;
        line-height: 26px;
        position: absolute;
        text-align: center;
    }
    .wizard-step-number {
        border: 2px solid #bbbbbb;
        color: #bbb;
        font-weight: 700;
        height: 30px;
        margin-left: -40px;
        margin-top: -15px;
        top: 50%;
        width: 30px;
    }
    .wizard-steps > li.completed .wizard-step-number {
        font-size: 0;
    }
    .wizard-steps > li.completed .wizard-step-number:after {
        content: '\f00c';
        font-family: FontAwesome;
        font-size: 13px;
        font-weight: 400;
        height: 26px;
        left: 0;
        width: 26px;
        top: 0;
    }
    .wizard-step-caption,
    .wizard-step-description {
        color: #bbb;
        display: inline-block;
        line-height: 14px;
        white-space: normal;
    }
    .wizard-step-caption {
        font-weight: 600;
        margin-bottom: 15px;
        margin-top: 15px;
        vertical-align: middle;
    }
    .wizard-step-description {
        display: block;
        font-size: 12px;
        font-weight: 400;
        margin-top: 4px;
        position: relative;
    }
    .wizard-content {
        padding: 20px;
    }
    .wizard-content:before,
    .wizard-content:after {
        content: " ";
        display: table;
    }
    .wizard-content:after {
        clear: both;
    }
</style>
<?php include(get_theme_dir()."partials/product-modals.php");?>